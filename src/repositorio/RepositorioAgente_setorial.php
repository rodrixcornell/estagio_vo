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


    function pesquisar($VO) {

        $query = "SELECT
                    C.ID_USUARIO ID_USUARIO_RESP,
                    C.ID_SETORIAL_ESTAGIO  ID_SETORIAL_ESTAGIO,
                    B.TX_LOGIN  TX_LOGIN,
                    A.TX_FUNCIONARIO  TX_FUNCIONARIO,
                    to_char(C.DT_CADASTRO,'dd/mm/yyyy')  DT_CADASTRO,
                    to_char(C.DT_ATULIZACAO,'dd/mm/yyyy') DT_ATULIZACAO
                 FROM
                            V_FUNCIONARIO_TOTAl A,
                            USUARIO B ,
                            AGENTE_SETORIAL_ESTAGIO  C
                            WHERE B.ID_USUARIO = C.ID_USUARIO
                            AND A.ID_UNIDADE_GESTORA=B.ID_UNIDADE_GESTORA
                            and A.ID_PESSOA_FUNCIONARIO=B.ID_PESSOA_FUNCIONARIO

                            ";

        ($VO->ID_USUARIO_RESP) ? $query .= " AND B.ID_USUARIO = '" . $VO->ID_USUARIO_RESP . "' " : false;
        ($VO->TX_FUNCIONARIO) ? $query .= " AND upper(A.TX_FUNCIONARIO) like upper('%" . $VO->TX_FUNCIONARIO . "%') " : false;


        $query .= " ORDER BY c.DT_ATULIZACAO desc, c.DT_CADASTRO desc, A.TX_FUNCIONARIO";


        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

    function inserir($VO) {

        $queryPK = "select SEMAD.F_G_PK_Agente_Setorial_Estagio as ID_SETORIAL_ESTAGIO from DUAL";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "
            INSERT INTO AGENTE_SETORIAL_ESTAGIO
            (ID_SETORIAL_ESTAGIO,ID_USUARIO,DT_CADASTRO,DT_ATULIZACAO,ID_USUARIO_CADASTRO,ID_USUARIO_ATUALIZACAO,TX_EMAIL)
            VALUES
	(" . $CodigoPK['ID_SETORIAL_ESTAGIO'][0] . ", " . $VO->ID_USUARIO_RESP . ", SYSDATE, SYSDATE," . $_SESSION['ID_USUARIO'] . "," . $_SESSION['ID_USUARIO'] . ",'".mb_strtolower($VO->TX_EMAIL)."') ";


        $retorno = $this->sql($query);
        return $retorno ? '' : $CodigoPK['ID_SETORIAL_ESTAGIO'][0];
    }

    function buscar($VO) {

        $query = "SELECT
                    USUARIO.ID_USUARIO ID_USUARIO_RESP,
                    V_FUNCIONARIO_TOTAL.TX_FUNCIONARIO TX_FUNCIONARIO,
                    USUARIO.TX_LOGIN TX_LOGIN ,
                    USUARIO_ATUALIZACAO.TX_LOGIN TX_LOGIN_CAD,
                    USUARIO_CADASTRADO.TX_LOGIN TX_LOGIN_ATU,
                    AGENTE_SETORIAL_ESTAGIO.TX_EMAIL,
                    TO_CHAR(AGENTE_SETORIAL_ESTAGIO.DT_ATULIZACAO,'dd/mm/yyyy hh24:mi:ss') DT_ATULIZACAO,
                    to_char(AGENTE_SETORIAL_ESTAGIO.DT_CADASTRO,'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO
            FROM
                    AGENTE_SETORIAL_ESTAGIO  AGENTE_SETORIAL_ESTAGIO ,
                    USUARIO USUARIO ,
                    USUARIO USUARIO_CADASTRADO,
                    USUARIO USUARIO_ATUALIZACAO,
                    V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL
            WHERE AGENTE_SETORIAL_ESTAGIO.ID_USUARIO = USUARIO.ID_USUARIO
                    AND V_FUNCIONARIO_TOTAL.ID_PESSOA_FUNCIONARIO = USUARIO.ID_PESSOA_FUNCIONARIO
                    AND V_FUNCIONARIO_TOTAL.ID_UNIDADE_GESTORA = USUARIO.ID_UNIDADE_GESTORA
                    AND AGENTE_SETORIAL_ESTAGIO.ID_USUARIO_CADASTRO = USUARIO_CADASTRADO.ID_USUARIO
                    and AGENTE_SETORIAL_ESTAGIO.ID_USUARIO_ATUALIZACAO = USUARIO_ATUALIZACAO.ID_USUARIO
                    and AGENTE_SETORIAL_ESTAGIO.ID_SETORIAL_ESTAGIO =" . $VO->ID_SETORIAL_ESTAGIO;


        return $this->sqlVetor($query);
    }

    function buscarUnidades($VO) {

        $query = "SELECT
                    B.ID_SETORIAL_ESTAGIO ID_SETORIAL_ESTAGIO,
                    A.TX_UNIDADE_ORG,
                    C.ID_ORGAO_ESTAGIO ID_ORGAO_ESTAGIO,
                    C.TX_ORGAO_ESTAGIO,
                    TO_CHAR(B.DT_ATUALIZACAO,'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO
                    FROM ORGAO_ESTAGIO C ,ORGAO_AGENTE_SETORIAL B,UNIDADE_ORG A
                    WHERE C.ID_ORGAO_ESTAGIO =B.ID_ORGAO_ESTAGIO
                    and A.ID_UNIDADE_ORG = C.ID_UNIDADE_ORG
                    and B.ID_SETORIAL_ESTAGIO = " . $VO->ID_SETORIAL_ESTAGIO ."
                    order by TX_UNIDADE_ORG";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

    function pesquisarUnidade($VO) {

        $query = "SELECT TX_ORGAO_ESTAGIO,
            ID_ORGAO_ESTAGIO,
            ID_ORGAO_ESTAGIO CODIGO

            from ORGAO_ESTAGIO
            order by TX_ORGAO_ESTAGIO";

        return $this->sqlVetor($query);
    }


      function inserirOrgao($VO) {

      $query = "
      INSERT INTO ORGAO_AGENTE_SETORIAL(ID_SETORIAL_ESTAGIO, ID_ORGAO_ESTAGIO, DT_ATUALIZACAO)
      values
      (" . $VO->ID_SETORIAL_ESTAGIO . ", " . $VO->ID_ORGAO_ESTAGIO . ", SYSDATE)
      ";

      return $this->sql($query);
     }

      function atualizarInf($VO) {

      $query = "update AGENTE_SETORIAL_ESTAGIO set
      DT_ATULIZACAO = sysdate,
      id_usuario_atualizacao = ".$_SESSION['ID_USUARIO']."
      where
      ID_SETORIAL_ESTAGIO =" . $VO->ID_SETORIAL_ESTAGIO ;

      $this->sql($query);

      $data = "SELECT usuario.tx_login tx_login_atu,TO_CHAR(AGENTE_SETORIAL_ESTAGIO.DT_ATULIZACAO, 'dd/mm/yyyy hh24:mi:ss') AS DT_ATULIZACAO
      FROM AGENTE_SETORIAL_ESTAGIO,usuario
      WHERE usuario.id_usuario=agente_setorial_estagio.id_usuario and
      ID_SETORIAL_ESTAGIO = '" . $VO->ID_SETORIAL_ESTAGIO . "'";

      $this->sqlVetor($data);
      $datahora = $this->getVetor();

      return $datahora;
      }

      function excluirOrgao($VO) {

      $query = "
      delete from  orgao_agente_setorial
      where ID_SETORIAL_ESTAGIO = " . $VO->ID_SETORIAL_ESTAGIO . "
      and ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO ;

      return $this->sql($query);
      }

      function alterar($VO) {

      $query = "update AGENTE_SETORIAL_ESTAGIO set
      ID_USUARIO = " . $VO->ID_USUARIO_RESP . " ,
      DT_ATULIZACAO = SYSDATE ,
      ID_USUARIO_ATUALIZACAO =".$_SESSION['ID_USUARIO'].",
      TX_EMAIL = '".mb_strtolower($VO->TX_EMAIL)."'
      where
     ID_SETORIAL_ESTAGIO = " . $VO->ID_SETORIAL_ESTAGIO;
//      print_r($query);

      return $this->sql($query);
      }

      function excluir($VO) {

      $query = "
      delete from agente_setorial_estagio
      where ID_SETORIAL_ESTAGIO = " . $VO->ID_SETORIAL_ESTAGIO . "
      ";

      return $this->sql($query);
      }

}

?>