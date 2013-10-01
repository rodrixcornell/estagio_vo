<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioOrgao_solicitante extends Repositorio {

    function pesquisarOrgaoSolicitante($VO) {

        $query = "select ID_UNIDADE_ORG CODIGO, TX_SIGLA_UNIDADE ||' - '|| TX_UNIDADE_ORG TX_UNIDADE_ORG
			FROM UNIDADE_ORG WHERE ID_SISTEMA_GESTAO = 2
                        AND CS_ATIVA = 0 AND LENGTH(NB_CODIGO_UNIDADE) = 5
                        AND CS_TIPO_UNID_ORG = 1 ORDER BY TX_UNIDADE_ORG";

        return $this->sqlVetor($query);
    }
    
        
    function pesquisar($VO) {

        $query = "SELECT A.ID_ORGAO_ESTAGIO,
                         A.TX_ORGAO_ESTAGIO,
                         TO_CHAR(A.DT_CADASTRO, 'DD/MM/YYYY HH24:MI:SS') DT_CADASTRO,
                         TO_CHAR(A.DT_ATUALIZACAO, 'DD/MM/YYYY HH24:MI:SS') DT_ATUALIZACAO,
                         B.TX_UNIDADE_ORG,
                         A.CS_STATUS,
                         DECODE(CS_STATUS, 1,'ATIVADO', 2,'DESATIVADO')TX_STATUS
                    FROM ORGAO_ESTAGIO A,
                         UNIDADE_ORG B
                   WHERE A.ID_UNIDADE_ORG = B.ID_UNIDADE_ORG ";

        ($VO->ID_UNIDADE_ORG) ? $query .= " AND a.ID_UNIDADE_ORG = '" . $VO->ID_UNIDADE_ORG . "' " : false;
        ($VO->TX_ORGAO_ESTAGIO) ? $query .= " AND upper(a.TX_ORGAO_ESTAGIO) like upper('%" . $VO->TX_ORGAO_ESTAGIO . "%') " : false;
        ($VO->CS_STATUS) ? $query .= " AND a.CS_STATUS = '" . $VO->CS_STATUS . "' " : false;

        $query .= "order by A.TX_ORGAO_ESTAGIO";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }
        
       return $this->sqlVetor($query);
    }

    function inserir($VO) {

        $queryPK = "select SEMAD.F_G_PK_ORGAO_ESTAGIO() as ID_ORGAO_ESTAGIO from DUAL";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();


        $query = "INSERT INTO SEMAD.ORGAO_ESTAGIO
                 (ID_ORGAO_ESTAGIO,
                  TX_ORGAO_ESTAGIO,
                  CS_STATUS,
                  DT_CADASTRO,
                  DT_ATUALIZACAO,
                  ID_UNIDADE_ORG,
                  ID_USUARIO_CADASTRO,
                  ID_USUARIO_ATUALIZACAO)

values  (" . $CodigoPK['ID_ORGAO_ESTAGIO'][0] . ",

        '" . $VO->TX_ORGAO_ESTAGIO . "',
        1,
         SYSDATE,
         SYSDATE,
        " . $VO->ID_UNIDADE_ORG . ",
        " . $_SESSION['ID_USUARIO'] . ",
        " . $_SESSION['ID_USUARIO'] . ")";
             $retorno = $this->sql($query);

        return !$retorno ? $CodigoPK['ID_ORGAO_ESTAGIO'][0] : FALSE;
    }

    function buscar($VO) {

        $query = "SELECT OE.ID_ORGAO_ESTAGIO,
       OE.TX_ORGAO_ESTAGIO,
       TO_CHAR(OE.DT_CADASTRO, 'DD/MM/YYYY hh24:mi:ss') DT_CADASTRO,
       TO_CHAR(OE.DT_ATUALIZACAO, 'DD/MM/YYYY hh24:mi:ss') DT_ATUALIZACAO,
       OE.ID_UNIDADE_ORG,
       OE.CS_STATUS, DECODE(CS_STATUS, 1,'ATIVADO', 2,'DESATIVADO')TX_STATUS,
       OE.ID_USUARIO_CADASTRO,
       OE.ID_USUARIO_ATUALIZACAO,
       (UO.TX_SIGLA_UNIDADE || ' - ' || UO.TX_UNIDADE_ORG) TX_UNIDADE_ORGANIZACIONAL,
       P_CAD.TX_NOME TX_USUARIO_CAD,
       P_ALT.TX_NOME TX_USUARIO_ALT,
       U_CAD.tx_login TX_LOGIN_CAD,
       U_ALT.tx_login TX_LOGIN_ALT
  FROM ORGAO_ESTAGIO OE,
       UNIDADE_ORG UO,
       USUARIO U_CAD,
       USUARIO U_ALT,
       PESSOA P_CAD,
       PESSOA P_ALT
 WHERE OE.ID_UNIDADE_ORG = UO.ID_UNIDADE_ORG
       AND OE.ID_USUARIO_CADASTRO = U_CAD.ID_USUARIO
       AND OE.ID_USUARIO_ATUALIZACAO = U_ALT.ID_USUARIO
       AND U_CAD.ID_PESSOA_FUNCIONARIO = P_CAD.ID_PESSOA
       AND U_ALT.ID_PESSOA_FUNCIONARIO = P_ALT.ID_PESSOA
       AND OE.ID_ORGAO_ESTAGIO =" . $_SESSION['ID_ORGAO_ESTAGIO'];

        return $this->sqlVetor($query);
    }

//BUSCA AS INFORMAÇÕES DO DETAIL

    function buscarAgenteSetorial($VO) {

        $query = "SELECT U.TX_LOGIN TX_USUARIO,
       VFT.TX_FUNCIONARIO,
       TO_CHAR(ASE.DT_CADASTRO, 'DD/MM/YYYY hh24:mi:ss') DT_CADASTRO,
       TO_CHAR(OAS.DT_ATUALIZACAO, 'DD/MM/YYYY hh24:mi:ss') DT_ATUALIZACAO
  FROM ORGAO_ESTAGIO OE,
       ORGAO_AGENTE_SETORIAL OAS,
       AGENTE_SETORIAL_ESTAGIO ASE,
       USUARIO U,
       V_FUNCIONARIO_TOTAL VFT
 WHERE OE.ID_ORGAO_ESTAGIO = OAS.ID_ORGAO_ESTAGIO
       AND OAS.ID_SETORIAL_ESTAGIO = ASE.ID_SETORIAL_ESTAGIO
       AND ASE.ID_USUARIO = U.ID_USUARIO
       AND U.ID_PESSOA_FUNCIONARIO = VFT.ID_PESSOA_FUNCIONARIO
       AND OE.ID_ORGAO_ESTAGIO =  " . $_SESSION['ID_ORGAO_ESTAGIO'];

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

    function alterar($VO) {

        $query = "UPDATE ORGAO_ESTAGIO
                        SET TX_ORGAO_ESTAGIO = '" . $VO->TX_ORGAO_ESTAGIO . "',
                            ID_UNIDADE_ORG =  '" . $VO->ID_UNIDADE_ORG . "',
                            CS_STATUS = '" . $VO->CS_STATUS . "',
                            ID_USUARIO_ATUALIZACAO =  '" . $_SESSION['ID_USUARIO'] . "',
                            DT_ATUALIZACAO = SYSDATE
                      WHERE ID_ORGAO_ESTAGIO = '" . $VO->ID_ORGAO_ESTAGIO . "'";

       
       return $this->sql($query);
    }

    function excluir($VO) {

        $query = "
			  delete from orgao_estagio
			  where ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . "
			  ";

        return $this->sql($query);
    }

}

?>