<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioSolicitacao extends Repositorio {

    function pesquisarOrgaoGestor($VO) {
        $query = "
            select oge.ID_ORGAO_GESTOR_ESTAGIO CODIGO,
                    oge.TX_ORGAO_GESTOR_ESTAGIO
               from ORGAO_GESTOR_ESTAGIO oge
             order by TX_ORGAO_GESTOR_ESTAGIO
        ";

        return $this->sqlVetor($query);
    }

    function pesquisarOrgaoSolicitante($VO) {
        $query = "
            select distinct
                    oe.ID_ORGAO_ESTAGIO CODIGO,
                    oe.TX_ORGAO_ESTAGIO
               from AGENTE_SETORIAL_ESTAGIO ase,
                    ORGAO_AGENTE_SETORIAL oas,
                    ORGAO_ESTAGIO oe
              where (ase.ID_SETORIAL_ESTAGIO = oas.ID_SETORIAL_ESTAGIO)
                and (oe.ID_ORGAO_ESTAGIO = oas.ID_ORGAO_ESTAGIO)
                and (ase.ID_USUARIO = " . $_SESSION['ID_USUARIO'] . ")
             order by oe.TX_ORGAO_ESTAGIO
        ";

        return $this->sqlVetor($query);
    }

    function pesquisarAgenciaEstagio($VO) {
        $query = "
            select ae.ID_AGENCIA_ESTAGIO CODIGO,
                    ae.TX_AGENCIA_ESTAGIO
               from AGENCIA_ESTAGIO ae
             order by TX_AGENCIA_ESTAGIO
        ";

        return $this->sqlVetor($query);
    }

    function pesquisar($VO) {
        $query = "
            select se.ID_SOLICITACAO_ESTAGIO,
                    se.TX_COD_SOLICITACAO,
                    se.ID_ORGAO_ESTAGIO,
                    se.ID_ORGAO_GESTOR_ESTAGIO,
                    se.ID_AGENCIA_ESTAGIO,
                    se.CS_SITUACAO,
                    oe.TX_ORGAO_ESTAGIO,
                    oge.TX_ORGAO_GESTOR_ESTAGIO,
                    ae.TX_AGENCIA_ESTAGIO
               from SOLICITACAO_ESTAGIO se,
                    ORGAO_ESTAGIO oe,
                    ORGAO_GESTOR_ESTAGIO oge,
                    AGENCIA_ESTAGIO ae
              where (se.ID_ORGAO_ESTAGIO = oe.ID_ORGAO_ESTAGIO)
                and (se.ID_ORGAO_GESTOR_ESTAGIO = oge.ID_ORGAO_GESTOR_ESTAGIO)
                and (se.ID_AGENCIA_ESTAGIO = ae.ID_AGENCIA_ESTAGIO) ";

        ($VO->ID_ORGAO_ESTAGIO) ? $query .= " and (se.ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . ") " : false;
        ($VO->ID_ORGAO_GESTOR_ESTAGIO) ? $query .= " and (se.ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ") " : false;
        ($VO->ID_AGENCIA_ESTAGIO) ? $query .= " and (se.ID_AGENCIA_ESTAGIO = " . $VO->ID_AGENCIA_ESTAGIO . ") " : false;
        ($VO->CS_SITUACAO) ? $query .= " and (se.CS_SITUACAO = " . $VO->CS_SITUACAO . ") " : false;
        ($VO->TX_ORGAO_ESTAGIO) ? $query .= " and (se.TX_ORGAO_ESTAGIO like '%" . $VO->TX_ORGAO_ESTAGIO . "%') " : false;

        $query .= "
              order by se.DT_ATUALIZACAO,
                    se.DT_CADASTRO,
                    se.TX_COD_SOLICITACAO,
                    oe.TX_ORGAO_ESTAGIO,
                    oge.TX_ORGAO_GESTOR_ESTAGIO,
                    ae.TX_AGENCIA_ESTAGIO
        ";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

    function inserir($VO) {
        $queryPK = "select SEMAD.F_G_PK_SOLICITACAO_ESTAGIO as ID_SOLICITACAO_ESTAGIO from DUAL";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "
            INSERT
                INTO SOLICITACAO_ESTAGIO
                (ID_SOLICITACAO_ESTAGIO, DT_CADASTRO, DT_ATUALIZACAO, TX_COD_SOLICITACAO, ID_USUARIO_ATUALIZACAO, ID_USUARIO_CADASTRO,
                 ID_ORGAO_ESTAGIO, ID_ORGAO_GESTOR_ESTAGIO, TX_JUSTIFICATIVA, CS_SITUACAO, ID_AGENCIA_ESTAGIO)
                values
                (" . $CodigoPK['ID_SOLICITACAO_ESTAGIO'][0] . ",
                 SYSDATE,
                 SYSDATE,
                 '" . $VO->TX_COD_SOLICITACAO . "',
                 " . $_SESSION['ID_USUARIO'] . ",
                 " . $_SESSION['ID_USUARIO'] . ",
                 " . $VO->ID_ORGAO_ESTAGIO . ",
                 " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ",
                 '" . $VO->TX_JUSTIFICATIVA . "',
                 '" . $VO->CS_SITUACAO . "',
                 " . $VO->ID_AGENCIA_ESTAGIO . ")
        ";

        $retorno = $this->sql($query);
        if (!$retorno) {
            return $CodigoPK['ID_SOLICITACAO_ESTAGIO'][0];
        }
    }

    function buscar($VO) {
        $query = "
            select se.ID_SOLICITACAO_ESTAGIO,
                    se.ID_ORGAO_GESTOR_ESTAGIO,
                    se.ID_AGENCIA_ESTAGIO,
                    se.ID_ORGAO_ESTAGIO,
                    se.TX_COD_SOLICITACAO,
                    se.TX_JUSTIFICATIVA,
                    se.CS_SITUACAO,
                    to_char(se.DT_CADASTRO, 'dd/mm/yyyy') DT_CADASTRO,
                    to_char(se.DT_ATUALIZACAO, 'dd/mm/yyyy') DT_ATUALIZACAO,
                    se.ID_USUARIO_CADASTRO,
                    se.ID_USUARIO_ATUALIZACAO,
                    oge.TX_ORGAO_GESTOR_ESTAGIO,
                    ae.TX_AGENCIA_ESTAGIO,
                    oe.TX_ORGAO_ESTAGIO,
                    vft_cad.TX_FUNCIONARIO TX_FUNCIONARIO_CAD,
                    vft_atual.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL
               from SOLICITACAO_ESTAGIO se,
                    ORGAO_GESTOR_ESTAGIO oge,
                    AGENCIA_ESTAGIO ae,
                    ORGAO_ESTAGIO oe,
                    USUARIO u_cad,
                    USUARIO u_atual,
                    V_FUNCIONARIO_TOTAL vft_cad,
                    V_FUNCIONARIO_TOTAL vft_atual
              where se.ID_ORGAO_GESTOR_ESTAGIO = oge.ID_ORGAO_GESTOR_ESTAGIO
                and se.ID_AGENCIA_ESTAGIO = ae.ID_AGENCIA_ESTAGIO
                and se.ID_ORGAO_ESTAGIO = oe.ID_ORGAO_ESTAGIO
                and se.ID_USUARIO_CADASTRO = u_cad.ID_USUARIO
                and se.ID_USUARIO_ATUALIZACAO = u_atual.ID_USUARIO
                and u_cad.ID_PESSOA_FUNCIONARIO = vft_cad.ID_PESSOA_FUNCIONARIO
                and u_atual.ID_PESSOA_FUNCIONARIO = vft_atual.ID_PESSOA_FUNCIONARIO
                and se.ID_SOLICITACAO_ESTAGIO = " . $VO->ID_SOLICITACAO_ESTAGIO;

        return $this->sqlVetor($query);
    }

    function alterar($VO) {
        $query = "
            update SOLICITACAO_ESTAGIO
                set DT_ATUALIZACAO = SYSDATE,
                    TX_COD_SOLICITACAO = '" . $VO->TX_COD_SOLICITACAO . "',
                    ID_USUARIO_ATUALIZACAO = " . $_SESSION['ID_USUARIO'] . ",
                    ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . ",
                    ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . ",
                    TX_JUSTIFICATIVA = '" . $VO->TX_JUSTIFICATIVA . "',
                    CS_SITUACAO = '" . $VO->CS_SITUACAO . "',
                    ID_AGENCIA_ESTAGIO = " . $VO->ID_AGENCIA_ESTAGIO . "
              where ID_SOLICITACAO_ESTAGIO = " . $VO->ID_SOLICITACAO_ESTAGIO;

        return $this->sql($query);
    }

    function excluir($VO) {
        $query = "
            delete
               from SOLICITACAO_ESTAGIO
              where ID_SOLICITACAO_ESTAGIO = " . $VO->ID_SOLICITACAO_ESTAGIO;

        return $this->sql($query);
    }

    function pesquisarTipoVaga($VO){
        $query = "
            select tve.CS_TIPO_VAGA_ESTAGIO CODIGO,
                    tve.TX_TIPO_VAGA_ESTAGIO
               from TIPO_VAGA_ESTAGIO tve
              order by TX_TIPO_VAGA_ESTAGIO
        ";

        return $this->sqlVetor($query);
    }





    /*
      function pesquisarUsuario($VO){

      $query="SELECT DISTINCT V_PERFIL_USUARIO.ID_USUARIO CODIGO,
      PESSOA.TX_NOME TX_FUNCIONARIO,
      USUARIO.TX_LOGIN
      FROM V_PERFIL_USUARIO, USUARIO, PESSOA
      WHERE V_PERFIL_USUARIO.ID_USUARIO = USUARIO.ID_USUARIO
      and USUARIO.ID_PESSOA_FUNCIONARIO = PESSOA.ID_PESSOA
      AND V_PERFIL_USUARIO.ID_SISTEMA = 75";

      $query = "

      return $this->sqlVetor($query);
      }

      function pesquisarUnidadeSolicitante($VO){

      $query="select distinct a.ID_UNIDADE_IRP CODIGO, B.TX_UNIDADE_IRP
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

      ($VO->ID_USUARIO) ? $query .= " AND a.ID_USUARIO = '".$VO->ID_USUARIO."' "  : false;
      ($VO->TX_FUNCIONARIO) ? $query .= " AND upper(F.TX_FUNCIONARIO) like upper('%".$VO->TX_FUNCIONARIO."%') "  : false;
      ($VO->ID_UNIDADE_IRP) ? $query .= " AND C.ID_UNIDADE_IRP = '".$VO->ID_UNIDADE_IRP."' "  : false;

      $query .= " ORDER BY D.TX_SIGLA_UNIDADE";

      if ($VO->Reg_quantidade){
      !$VO->Reg_inicio? $VO->Reg_inicio = 0: false;
      $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (".$query.") PAGING WHERE (ROWNUM <= ".($VO->Reg_quantidade+$VO->Reg_inicio)."))  WHERE (PAGING_RN > ".$VO->Reg_inicio.")";
      }

      return $this->sqlVetor($query);
      }

      function inserir($VO){

      $queryPK = "select SEMAD.F_G_PK_RESP_UNID_IRP as ID_RESP_UNID_IRP from DUAL";
      $this->sqlVetor($queryPK);
      $CodigoPK = $this->getVetor();

      $query = "
      INSERT INTO RESP_UNID_IRP(ID_RESP_UNID_IRP, ID_USUARIO, DT_CADASTRO, DT_ATUALIZACAO)
      values
      (".$CodigoPK['ID_RESP_UNID_IRP'][0].", ".$VO->ID_USUARIO_RESP.", SYSDATE, SYSDATE)
      ";

      $retorno = $this->sql($query);
      return $retorno ? '' : $CodigoPK['ID_RESP_UNID_IRP'][0];
      }


      function buscar($VO) {

      $query = "select a.ID_USUARIO, a.ID_RESP_UNID_IRP, TO_CHAR(a.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO, TO_CHAR(a.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
      B.TX_LOGIN, C.TX_FUNCIONARIO
      from RESP_UNID_IRP a, USUARIO B, V_FUNCIONARIO_TOTAL C
      where a.ID_USUARIO = B.ID_USUARIO
      and B.ID_PESSOA_FUNCIONARIO = C.ID_PESSOA_FUNCIONARIO
      and B.ID_UNIDADE_GESTORA = C.ID_UNIDADE_GESTORA
      and a.ID_RESP_UNID_IRP = ".$VO->ID_RESP_UNID_IRP;


      return $this->sqlVetor($query);
      }

      function buscarUnidades($VO) {

      $query = "select a.ID_UNIDADE_IRP, C.TX_SIGLA_UNIDADE, B.TX_UNIDADE_IRP, TO_CHAR(a.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO
      from UNID_RESP_SOLIC a, UNIDADE_IRP B, UNIDADE_ORG C
      where a.ID_UNIDADE_IRP = B.ID_UNIDADE_IRP
      and B.ID_UNIDADE_ORG = C.ID_UNIDADE_ORG
      and a.ID_RESP_UNID_IRP = ".$VO->ID_RESP_UNID_IRP;

      if ($VO->Reg_quantidade){
      !$VO->Reg_inicio? $VO->Reg_inicio = 0: false;
      $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (".$query.") PAGING WHERE (ROWNUM <= ".($VO->Reg_quantidade+$VO->Reg_inicio)."))  WHERE (PAGING_RN > ".$VO->Reg_inicio.")";
      }

      return $this->sqlVetor($query);
      }

      function pesquisarUnidade($VO) {

      $query = "select ID_UNIDADE_IRP CODIGO, TX_UNIDADE_IRP from unidade_irp";

      return $this->sqlVetor($query);
      }


      function inserirUnidade($VO){

      $query = "
      INSERT INTO UNID_RESP_SOLIC(ID_RESP_UNID_IRP, ID_UNIDADE_IRP, DT_CADASTRO, DT_ATUALIZACAO)
      values
      (".$VO->ID_RESP_UNID_IRP.", ".$VO->ID_UNIDADE_IRP.", SYSDATE, SYSDATE)
      ";

      return $this->sql($query);
      }


      function atualizarInf($VO){

      $query = "update RESP_UNID_IRP set
      DT_ATUALIZACAO = sysdate
      where
      ID_RESP_UNID_IRP = '".$VO->ID_RESP_UNID_IRP."'";

      $this->sql($query);

      $data = "SELECT TO_CHAR(RESP_UNID_IRP.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') AS DT_ATUALIZACAO
      FROM RESP_UNID_IRP
      WHERE ID_RESP_UNID_IRP = '".$VO->ID_RESP_UNID_IRP."'";

      $this->sqlVetor($data);
      $datahora = $this->getVetor();

      return $datahora;
      }

      function excluirUnidade($VO){

      $query = "
      delete from UNID_RESP_SOLIC
      where ID_RESP_UNID_IRP = ".$VO->ID_RESP_UNID_IRP."
      and ID_UNIDADE_IRP = ".$VO->ID_UNIDADE_IRP."
      ";

      return $this->sql($query);
      }

      function alterar($VO){

      $query = "update RESP_UNID_IRP set
      ID_USUARIO = ".$VO->ID_USUARIO_RESP." ,
      DT_ATUALIZACAO = SYSDATE
      where
      ID_RESP_UNID_IRP = '".$VO->ID_RESP_UNID_IRP."'";

      return $this->sql($query);
      }


      function excluir($VO){

      $query = "
      delete from RESP_UNID_IRP
      where ID_RESP_UNID_IRP = ".$VO->ID_RESP_UNID_IRP."
      ";

      return $this->sql($query);
      }
     */
}
?>