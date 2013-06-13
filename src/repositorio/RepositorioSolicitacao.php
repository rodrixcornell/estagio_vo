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

    function pesquisarQuadroVagasEstagio($VO) {
        $query = "
            select qve.ID_QUADRO_VAGAS_ESTAGIO CODIGO, qve.TX_CODIGO
               from QUADRO_VAGAS_ESTAGIO qve
              where qve.ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_GESTOR_ESTAGIO . "
                and qve.ID_AGENCIA_ESTAGIO = " . $VO->ID_AGENCIA_ESTAGIO . "
             order by TX_CODIGO desc
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
        $queryPK = "select SEMAD.F_G_PK_SOLICITACAO_ESTAGIO as ID_SOLICITACAO_ESTAGIO from dual";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $queryCodigo = "select SEMAD.F_G_COD_SOLICITACAO_ESTAGIO as TX_COD_SOLICITACAO from dual";
        $this->sqlVetor($queryCodigo);
        $Codigo = $this->getVetor();

        $query = "
            INSERT
                INTO SOLICITACAO_ESTAGIO
                (ID_SOLICITACAO_ESTAGIO, DT_CADASTRO, DT_ATUALIZACAO, TX_COD_SOLICITACAO, ID_USUARIO_ATUALIZACAO, ID_USUARIO_CADASTRO,
                 ID_ORGAO_ESTAGIO, ID_ORGAO_GESTOR_ESTAGIO, TX_JUSTIFICATIVA, CS_SITUACAO, ID_QUADRO_VAGAS_ESTAGIO, ID_AGENCIA_ESTAGIO)
                values
                (" . $CodigoPK['ID_SOLICITACAO_ESTAGIO'][0] . ",
                 SYSDATE,
                 SYSDATE,
                 '" . $Codigo['TX_COD_SOLICITACAO'][0] . "',
                 " . $_SESSION['ID_USUARIO'] . ",
                 " . $_SESSION['ID_USUARIO'] . ",
                 " . $VO->ID_ORGAO_ESTAGIO . ",
                 " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ",
                 '" . $VO->TX_JUSTIFICATIVA . "',
                 '1',
                 " . $VO->ID_QUADRO_VAGAS_ESTAGIO . ",
                 " . $VO->ID_AGENCIA_ESTAGIO . ")";

        $retorno = $this->sql($query);
        if (!$retorno) {
            return $CodigoPK['ID_SOLICITACAO_ESTAGIO'][0];
        }
    }

    function buscar($VO) {
        $query = "
            select se.ID_SOLICITACAO_ESTAGIO, se.ID_ORGAO_GESTOR_ESTAGIO, se.ID_AGENCIA_ESTAGIO, se.ID_ORGAO_ESTAGIO, se.CS_SITUACAO, se.ID_QUADRO_VAGAS_ESTAGIO,
                    se.TX_COD_SOLICITACAO, se.TX_JUSTIFICATIVA,
                    to_char(se.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,
                    to_char(se.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
                    se.ID_USUARIO_CADASTRO, se.ID_USUARIO_ATUALIZACAO,
                    oge.TX_ORGAO_GESTOR_ESTAGIO, ae.TX_AGENCIA_ESTAGIO, oe.TX_ORGAO_ESTAGIO, qve.TX_CODIGO,
                    vft_cad.TX_FUNCIONARIO TX_FUNCIONARIO_CAD, vft_atual.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL
               from SOLICITACAO_ESTAGIO se,
                    ORGAO_GESTOR_ESTAGIO oge,
                    AGENCIA_ESTAGIO ae,
                    ORGAO_ESTAGIO oe,
                    QUADRO_VAGAS_ESTAGIO qve,
                    USUARIO u_cad,
                    USUARIO u_atual,
                    V_FUNCIONARIO_TOTAL vft_cad,
                    V_FUNCIONARIO_TOTAL vft_atual
              where se.ID_ORGAO_GESTOR_ESTAGIO = oge.ID_ORGAO_GESTOR_ESTAGIO
                    and se.ID_AGENCIA_ESTAGIO = ae.ID_AGENCIA_ESTAGIO
                    and se.ID_ORGAO_ESTAGIO = oe.ID_ORGAO_ESTAGIO
                    and se.ID_QUADRO_VAGAS_ESTAGIO = qve.ID_QUADRO_VAGAS_ESTAGIO
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
                    ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ",
                    TX_JUSTIFICATIVA = '" . $VO->TX_JUSTIFICATIVA . "',
                    ID_AGENCIA_ESTAGIO = " . $VO->ID_AGENCIA_ESTAGIO . ",
                    ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . "
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

    function pesquisarTipoVaga($VO) {
        $query = "
            select (ve.CS_TIPO_VAGA_ESTAGIO ||'_'|| ve.ID_CURSO_ESTAGIO ||'_'|| ve.NB_QUANTIDADE) CODIGO, tve.TX_TIPO_VAGA_ESTAGIO
               from QUADRO_VAGAS_ESTAGIO qve,
                    VAGAS_ESTAGIO ve,
                    TIPO_VAGA_ESTAGIO tve
              where (qve.ID_QUADRO_VAGAS_ESTAGIO = ve.ID_QUADRO_VAGAS_ESTAGIO)
                and (ve.CS_TIPO_VAGA_ESTAGIO = tve.CS_TIPO_VAGA_ESTAGIO)
                and (ve.ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . ")
                and (qve.ID_AGENCIA_ESTAGIO = " . $VO->ID_AGENCIA_ESTAGIO . ")
                and (qve.ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . ")
                and (ve.CS_TIPO_VAGA_ESTAGIO
                    not in (select CS_TIPO_VAGA_ESTAGIO
                            from VAGAS_SOLICITACAO
                            where (ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . ")
                                and (ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . ")))
              order by tve.TX_TIPO_VAGA_ESTAGIO";

        return $this->sqlVetor($query);
    }

    function buscarQuantidade($VO) {
        $query = "
            select NB_QUANTIDADE
               from VAGAS_ESTAGIO
              where ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . "
                and ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . "
                and CS_TIPO_VAGA_ESTAGIO = " . $VO->CS_TIPO_VAGA_ESTAGIO . "
        ";

        return $this->sqlVetor($query);
    }

    function buscarCursos($VO) {
        $query = "
            select ID_CURSO_ESTAGIO CODIGO, TX_CURSO_ESTAGIO
               from CURSO_ESTAGIO
              order by TX_CURSO_ESTAGIO
        ";

        return $this->sqlVetor($query);
    }

    function pesquisarVagasSolicitadas($VO) {
        $query = "
            select vs.ID_SOLICITACAO_ESTAGIO,
                    vs.ID_ORGAO_ESTAGIO,
                    vs.ID_QUADRO_VAGAS_ESTAGIO,
                    vs.CS_TIPO_VAGA_ESTAGIO,
                    vs.ID_CURSO_ESTAGIO,
                    vs.NB_QUANTIDADE,
                    oe.TX_ORGAO_ESTAGIO,
                    ae.TX_AGENCIA_ESTAGIO,
                    tve.TX_TIPO_VAGA_ESTAGIO,
                    ce.TX_CURSO_ESTAGIO
               from VAGAS_SOLICITACAO vs,
                    QUADRO_VAGAS_ESTAGIO qve,
                    AGENCIA_ESTAGIO ae,
                    ORGAO_ESTAGIO oe,
                    TIPO_VAGA_ESTAGIO tve,
                    CURSO_ESTAGIO ce
              where (vs.ID_ORGAO_ESTAGIO = oe.ID_ORGAO_ESTAGIO)
                    and (vs.ID_QUADRO_VAGAS_ESTAGIO = qve.ID_QUADRO_VAGAS_ESTAGIO(+))
                    and (qve.ID_AGENCIA_ESTAGIO = ae.ID_AGENCIA_ESTAGIO(+))
                    and (vs.CS_TIPO_VAGA_ESTAGIO = tve.CS_TIPO_VAGA_ESTAGIO)
                    and (vs.ID_CURSO_ESTAGIO = ce.ID_CURSO_ESTAGIO)
                    and (vs.ID_SOLICITACAO_ESTAGIO = " . $VO->ID_SOLICITACAO_ESTAGIO . ")
                    and (vs.ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . ")
                    and (vs.ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . ")
              order by oe.TX_ORGAO_ESTAGIO,
                    ae.TX_AGENCIA_ESTAGIO
        ";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

    function inserirVagasSolicitadas($VO) {
        $query = "
            INSERT
                INTO VAGAS_SOLICITACAO
                (ID_SOLICITACAO_ESTAGIO, ID_ORGAO_ESTAGIO, ID_QUADRO_VAGAS_ESTAGIO, CS_TIPO_VAGA_ESTAGIO, ID_CURSO_ESTAGIO, NB_QUANTIDADE,
                 DT_CADASTRO, DT_ATUALIZACAO, ID_USUARIO_CADASTRO, ID_USUARIO_ATUALIZACAO)
                values
                (" . $VO->ID_SOLICITACAO_ESTAGIO . ",
                 " . $VO->ID_ORGAO_ESTAGIO . ",
                 " . $VO->ID_QUADRO_VAGAS_ESTAGIO . ",
                 '" . $VO->CS_TIPO_VAGA_ESTAGIO . "',
                 " . $VO->ID_CURSO_ESTAGIO . ",
                 " . $VO->NB_QUANTIDADE . ",
                 SYSDATE,
                 SYSDATE,
                 " . $_SESSION['ID_USUARIO'] . ",
                 " . $_SESSION['ID_USUARIO'] . ")
        ";

        return $this->sql($query);
    }

    function excluirVagasSolicitadas($VO) {
        $query = "
            delete
               from VAGAS_SOLICITACAO
              where (ID_SOLICITACAO_ESTAGIO = " . $VO->ID_SOLICITACAO_ESTAGIO . ")
                and (ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . ")
                and (ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . ")
                and (CS_TIPO_VAGA_ESTAGIO = " . $VO->CS_TIPO_VAGA_ESTAGIO . ")";

        return $this->sql($query);
    }

    function buscarVagasSolicitadas($VO) {
        $query = "
            select vs.ID_SOLICITACAO_ESTAGIO,
                    vs.ID_ORGAO_ESTAGIO,
                    vs.ID_QUADRO_VAGAS_ESTAGIO,
                    vs.CS_TIPO_VAGA_ESTAGIO,
                    vs.ID_CURSO_ESTAGIO,
                    vs.NB_QUANTIDADE,
                    tve.TX_TIPO_VAGA_ESTAGIO,
                    ce.TX_CURSO_ESTAGIO,
                    to_char(vs.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,
                    to_char(vs.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
                    vs.ID_USUARIO_CADASTRO,
                    vs.ID_USUARIO_ATUALIZACAO,
                    vft_cad.TX_FUNCIONARIO TX_FUNCIONARIO_CAD,
                    vft_atual.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL
               from VAGAS_SOLICITACAO vs,
                    TIPO_VAGA_ESTAGIO tve,
                    CURSO_ESTAGIO ce,
                    USUARIO u_cad,
                    USUARIO u_atual,
                    V_FUNCIONARIO_TOTAL vft_cad,
                    V_FUNCIONARIO_TOTAL vft_atual
              where (vs.CS_TIPO_VAGA_ESTAGIO = tve.CS_TIPO_VAGA_ESTAGIO)
                    and (vs.ID_CURSO_ESTAGIO = ce.ID_CURSO_ESTAGIO)
                    and (vs.ID_USUARIO_CADASTRO = u_cad.ID_USUARIO)
                    and (vs.ID_USUARIO_ATUALIZACAO = u_atual.ID_USUARIO)
                    and (u_cad.ID_PESSOA_FUNCIONARIO = vft_cad.ID_PESSOA_FUNCIONARIO)
                    and (u_cad.ID_UNIDADE_GESTORA = vft_cad.ID_UNIDADE_GESTORA)
                    and (u_atual.ID_PESSOA_FUNCIONARIO = vft_atual.ID_PESSOA_FUNCIONARIO)
                    and (u_atual.ID_UNIDADE_GESTORA = vft_atual.ID_UNIDADE_GESTORA)
                    and (vs.ID_SOLICITACAO_ESTAGIO = " . $VO->ID_SOLICITACAO_ESTAGIO . ")
                    and (vs.ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . ")
                    and (vs.ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . ")
                    and (vs.CS_TIPO_VAGA_ESTAGIO = " . $VO->CS_TIPO_VAGA_ESTAGIO . ")";

        return $this->sqlVetor($query);
    }

    function alterarVagasSolicitadas($VO) {
        $query = "
            update VAGAS_SOLICITACAO
                set DT_ATUALIZACAO = sysdate,
                    ID_USUARIO_ATUALIZACAO = " . $_SESSION['ID_USUARIO'] . ",
                    NB_QUANTIDADE = " . $VO->NB_QUANTIDADE . ",
                    ID_CURSO_ESTAGIO = " . $VO->ID_CURSO_ESTAGIO . "
              where (ID_SOLICITACAO_ESTAGIO = " . $VO->ID_SOLICITACAO_ESTAGIO . ")
                and (ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . ")
                and (ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . ")
                and (CS_TIPO_VAGA_ESTAGIO = " . $VO->CS_TIPO_VAGA_ESTAGIO . ")";

        return $this->sql($query);
    }

    function atualizarInf($VO) {

        $query = "
            update SOLICITACAO_ESTAGIO
                set DT_ATUALIZACAO = sysdate,
                    ID_USUARIO_ATUALIZACAO = " . $_SESSION['ID_USUARIO'] . "
              where ID_SOLICITACAO_ESTAGIO = " . $VO->ID_SOLICITACAO_ESTAGIO;

        $this->sql($query);

        $data = "
            select TO_CHAR(a.DT_ATUALIZACAO, 'DD/MM/YYYY hh24:mi:ss') DT_ATUALIZACAO, c.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL
               from SOLICITACAO_ESTAGIO a, USUARIO b, V_FUNCIONARIO_USUARIO c
              where a.ID_SOLICITACAO_ESTAGIO = '" . $VO->ID_SOLICITACAO_ESTAGIO . "'
                and a.ID_USUARIO_ATUALIZACAO = b.ID_USUARIO
                and b.ID_PESSOA_FUNCIONARIO = c.ID_PESSOA_FUNCIONARIO
                and b.ID_UNIDADE_GESTORA = c.ID_UNIDADE_GESTORA";

        $this->sqlVetor($data);
        $datahora = $this->getVetor();

        return $datahora;
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