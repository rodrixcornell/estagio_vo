<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioAgente_setorial extends Repositorio {

    function pesquisarUsuario($VO) {

        $query = "SELECT DISTINCT
                            V_PERFIL_USUARIO.ID_USUARIO CODIGO,
                            V_PERFIL_USUARIO.ID_USUARIO ID_USUARIO_RESP,
                            PESSOA.TX_NOME TX_FUNCIONARIO,
                            USUARIO.TX_LOGIN
                        FROM
                            V_PERFIL_USUARIO,
                            USUARIO,
                            PESSOA 
                        WHERE
                            V_PERFIL_USUARIO.ID_USUARIO = USUARIO.ID_USUARIO
                            and USUARIO.ID_PESSOA_FUNCIONARIO = PESSOA.ID_PESSOA
                            AND V_PERFIL_USUARIO.ID_SISTEMA = 77 ";

        $VO->ID_USUARIO ? $query .= " AND V_PERFIL_USUARIO.ID_USUARIO = " . $VO->ID_USUARIO : false;

        return $this->sqlVetor($query);
    }

    /*
    function pesquisarUnidadeSolicitante($VO) {

        $query = "select distinct a.ID_UNIDADE_IRP CODIGO, B.TX_UNIDADE_IRP  
					from UNID_RESP_SOLIC a, UNIDADE_IRP B
					WHERE A.ID_UNIDADE_IRP = B.ID_UNIDADE_IRP";

        return $this->sqlVetor($query);
    }

    function pesquisar($VO) {

        $query = "select A.ID_RESP_UNID_IRP, D.TX_SIGLA_UNIDADE, C.TX_UNIDADE_IRP, F.TX_FUNCIONARIO, E.TX_LOGIN
				  from RESP_UNID_IRP a, UNID_RESP_SOLIC B, UNIDADE_IRP C, UNIDADE_ORG D, USUARIO E, V_FUNCIONARIO_TOTAL F
				  where a.ID_RESP_UNID_IRP = B.ID_RESP_UNID_IRP(+)
				  and B.ID_UNIDADE_IRP = C.ID_UNIDADE_IRP(+)
				  and C.ID_UNIDADE_ORG = D.ID_UNIDADE_ORG(+)
				  and a.ID_USUARIO = E.ID_USUARIO
				  and E.ID_PESSOA_FUNCIONARIO = F.ID_PESSOA_FUNCIONARIO
				  AND E.ID_UNIDADE_GESTORA = F.ID_UNIDADE_GESTORA ";

        ($VO->ID_USUARIO) ? $query .= " AND a.ID_USUARIO = '" . $VO->ID_USUARIO . "' " : false;
        ($VO->TX_FUNCIONARIO) ? $query .= " AND upper(F.TX_FUNCIONARIO) like upper('%" . $VO->TX_FUNCIONARIO . "%') " : false;
        ($VO->ID_UNIDADE_IRP) ? $query .= " AND C.ID_UNIDADE_IRP = '" . $VO->ID_UNIDADE_IRP . "' " : false;

        $query .= " ORDER BY D.TX_SIGLA_UNIDADE";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }
*/
    function inserir($VO) {

        $queryPK = "select SEMAD.F_G_PK_Agente_Setorial_Estagio as ID_RESP_UNID_IRP from DUAL";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "
            INSERT INTO RESP_UNID_IRP(ID_RESP_UNID_IRP, ID_USUARIO, DT_CADASTRO, DT_ATUALIZACAO) 
						values
								(" . $CodigoPK['ID_RESP_UNID_IRP'][0] . ", " . $VO->ID_USUARIO_RESP . ", SYSDATE, SYSDATE)
        ";

        $retorno = $this->sql($query);
        return $retorno ? '' : $CodigoPK['ID_RESP_UNID_IRP'][0];
    }
/*
    function buscar($VO) {

        $query = "select a.ID_USUARIO, a.ID_RESP_UNID_IRP, TO_CHAR(a.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO, TO_CHAR(a.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
					  B.TX_LOGIN, C.TX_FUNCIONARIO
					  from RESP_UNID_IRP a, USUARIO B, V_FUNCIONARIO_TOTAL C 
					  where a.ID_USUARIO = B.ID_USUARIO
					  and B.ID_PESSOA_FUNCIONARIO = C.ID_PESSOA_FUNCIONARIO
					  and B.ID_UNIDADE_GESTORA = C.ID_UNIDADE_GESTORA
					  and a.ID_RESP_UNID_IRP = " . $VO->ID_RESP_UNID_IRP;


        return $this->sqlVetor($query);
    }

    function buscarUnidades($VO) {

        $query = "select a.ID_UNIDADE_IRP, C.TX_SIGLA_UNIDADE, B.TX_UNIDADE_IRP, TO_CHAR(a.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO
					  from UNID_RESP_SOLIC a, UNIDADE_IRP B, UNIDADE_ORG C
					  where a.ID_UNIDADE_IRP = B.ID_UNIDADE_IRP
					  and B.ID_UNIDADE_ORG = C.ID_UNIDADE_ORG
					  and a.ID_RESP_UNID_IRP = " . $VO->ID_RESP_UNID_IRP;

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

    function pesquisarUnidade($VO) {

        $query = "select ID_UNIDADE_IRP CODIGO, TX_UNIDADE_IRP from unidade_irp";

        return $this->sqlVetor($query);
    }

    function inserirUnidade($VO) {

        $query = "
            INSERT INTO UNID_RESP_SOLIC(ID_RESP_UNID_IRP, ID_UNIDADE_IRP, DT_CADASTRO, DT_ATUALIZACAO) 
						values
								(" . $VO->ID_RESP_UNID_IRP . ", " . $VO->ID_UNIDADE_IRP . ", SYSDATE, SYSDATE)
        ";

        return $this->sql($query);
    }

    function atualizarInf($VO) {

        $query = "update RESP_UNID_IRP set
					DT_ATUALIZACAO = sysdate
				 where
 					ID_RESP_UNID_IRP = '" . $VO->ID_RESP_UNID_IRP . "'";

        $this->sql($query);

        $data = "SELECT TO_CHAR(RESP_UNID_IRP.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') AS DT_ATUALIZACAO 
					FROM RESP_UNID_IRP 
					WHERE ID_RESP_UNID_IRP = '" . $VO->ID_RESP_UNID_IRP . "'";

        $this->sqlVetor($data);
        $datahora = $this->getVetor();

        return $datahora;
    }

    function excluirUnidade($VO) {

        $query = "
            delete from UNID_RESP_SOLIC
                where ID_RESP_UNID_IRP = " . $VO->ID_RESP_UNID_IRP . " 
                  and ID_UNIDADE_IRP = " . $VO->ID_UNIDADE_IRP . "
        ";

        return $this->sql($query);
    }

    function alterar($VO) {

        $query = "update RESP_UNID_IRP set
					ID_USUARIO = " . $VO->ID_USUARIO_RESP . " ,
					DT_ATUALIZACAO = SYSDATE
				 where
 					ID_RESP_UNID_IRP = '" . $VO->ID_RESP_UNID_IRP . "'";

        return $this->sql($query);
    }

    function excluir($VO) {

        $query = "
            delete from RESP_UNID_IRP
                where ID_RESP_UNID_IRP = " . $VO->ID_RESP_UNID_IRP . " 
        ";

        return $this->sql($query);
    }
*/
}

?>