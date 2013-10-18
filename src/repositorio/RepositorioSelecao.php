<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioSelecao extends Repositorio {

    function buscarOrgaoGestor($VO) {
        $query = "
            SELECT ID_ORGAO_GESTOR_ESTAGIO,
                    ID_ORGAO_GESTOR_ESTAGIO CODIGO,
                    TX_ORGAO_GESTOR_ESTAGIO
               FROM ORGAO_GESTOR_ESTAGIO";
        return $this->sqlVetor($query);
    }

    function buscarSolicitante($VO) {
        $query = "
            select c.ID_ORGAO_ESTAGIO CODIGO, c.TX_ORGAO_ESTAGIO
               from AGENTE_SETORIAL_ESTAGIO a,
                    ORGAO_AGENTE_SETORIAL b,
                    ORGAO_ESTAGIO c
              where a.ID_SETORIAL_ESTAGIO = b.ID_SETORIAL_ESTAGIO
                and b.ID_ORGAO_ESTAGIO = c.ID_ORGAO_ESTAGIO
                and a.ID_USUARIO = '" . $_SESSION['ID_USUARIO'] . "'
              order by c.TX_ORGAO_ESTAGIO";

        return $this->sqlVetor($query);
    }

    function buscarOfertaVaga($VO) {
        $query = "
            select ov.ID_OFERTA_VAGA CODIGO, ov.TX_CODIGO_OFERTA_VAGA
               from OFERTA_VAGA ov
              where ov.ID_ORGAO_ESTAGIO = '" . $VO->ID_ORGAO_ESTAGIO . "'
              order by ov.TX_CODIGO_OFERTA_VAGA desc";

        return $this->sqlVetor($query);
    }

    function inserir($VO) {

        $queryPK = "select SEMAD.F_G_PK_Selecao_Estagio() as ID_SELECAO_ESTAGIO from DUAL";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "
            INSERT INTO SELECAO_ESTAGIO
                (ID_SELECAO_ESTAGIO,ID_ORGAO_GESTOR_ESTAGIO,ID_ORGAO_ESTAGIO,CS_SELECAO,ID_OFERTA_VAGA,CS_SITUACAO,ID_USUARIO_ATUALIZACAO,ID_USUARIO_CADASTRO,DT_ATUALIZACAO,DT_CADASTRO,TX_COD_SELECAO)
            VALUES
                (" . $CodigoPK['ID_SELECAO_ESTAGIO'][0]
                . ", '" . $VO->ID_ORGAO_GESTOR_ESTAGIO
                . "', '" . $VO->ID_ORGAO_ESTAGIO
                . "', '" . $VO->CS_SELECAO
                . "', '" . $VO->ID_OFERTA_VAGA
                . "', 1 "
                . ", '" . $_SESSION['ID_USUARIO']
                . "', '" . $_SESSION['ID_USUARIO']
                . "', SYSDATE "
                . ", SYSDATE "
                . ", SEMAD.F_G_COD_SELECAO_ESTAGIO())";

        $retorno = $this->sql($query);
        return $retorno ? '' : $CodigoPK['ID_SELECAO_ESTAGIO'][0];
    }

    function pesquisar($VO) {

        $query = "
            select a.ID_SELECAO_ESTAGIO, a.ID_ORGAO_GESTOR_ESTAGIO, a.ID_ORGAO_ESTAGIO, a.ID_OFERTA_VAGA, a.TX_COD_SELECAO, a.CS_SITUACAO, a.CS_SELECAO,
                    c.TX_ORGAO_GESTOR_ESTAGIO, d.TX_ORGAO_ESTAGIO, b.TX_CODIGO_OFERTA_VAGA, e.TX_CODIGO,
                    decode(a.CS_SITUACAO, 1, 'Aberto', 2, 'Fechado') TX_SITUACAO,
                    decode(a.CS_SELECAO, 1, 'Com Seleção', 2, 'Sem Seleção') TX_SELECAO
               from SELECAO_ESTAGIO a,
                    OFERTA_VAGA b,
                    QUADRO_VAGAS_ESTAGIO e,
                    ORGAO_GESTOR_ESTAGIO c,
                    ORGAO_ESTAGIO d
              where a.ID_OFERTA_VAGA = b.ID_OFERTA_VAGA(+)
                    and b.ID_QUADRO_VAGAS_ESTAGIO = e.ID_QUADRO_VAGAS_ESTAGIO(+)
                    and a.ID_ORGAO_GESTOR_ESTAGIO = C.ID_ORGAO_GESTOR_ESTAGIO
                    and a.ID_ORGAO_ESTAGIO = D.ID_ORGAO_ESTAGIO
        ";

        $VO->ID_ORGAO_GESTOR_ESTAGIO ? $query .= " and a.ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_GESTOR_ESTAGIO . "" : false;
        $VO->ID_ORGAO_ESTAGIO ? $query .= " and a.ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . "" : false;
        $VO->ID_OFERTA_VAGA ? $query .= " and a.ID_OFERTA_VAGA = " . $VO->ID_OFERTA_VAGA . "" : false;
        $VO->CS_SITUACAO ? $query .= " and a.CS_SITUACAO = " . $VO->CS_SITUACAO . "" : false;
        $VO->TX_COD_SELECAO ? $query .= " and upper(a.TX_COD_SELECAO) like upper('%" . $VO->TX_COD_SELECAO . "%')" : false;

        $query .= " ORDER by TX_COD_SELECAO desc ";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

    function buscar($VO) {

        $query = "
            select a.ID_SELECAO_ESTAGIO, a.TX_COD_SELECAO, c.TX_ORGAO_GESTOR_ESTAGIO, d.TX_ORGAO_ESTAGIO, b.TX_CODIGO_OFERTA_VAGA,
                    e.TX_CODIGO, a.CS_SITUACAO, a.CS_SELECAO,
                    decode(a.CS_SITUACAO, 1, 'Aberto', 2, 'Fechado') TX_SITUACAO,
                    decode(a.CS_SELECAO, 1, 'Com Seleção', 2, 'Sem Seleção') TX_SELECAO,
                    f_cad.TX_FUNCIONARIO TX_FUNCIONARIO_CADASTRO,
                    f_atua.TX_FUNCIONARIO TX_FUNCIONARIO_ATUALIZACAO,
                    TO_CHAR(a.DT_CADASTRO,'DD/MM/YYYY HH24:MI:SS')DT_CADASTRO,
                    TO_CHAR(a.DT_ATUALIZACAO,'DD/MM/YYYY HH24:MI:SS')DT_ATUALIZACAO
               from SELECAO_ESTAGIO a,
                    OFERTA_VAGA b,
                    QUADRO_VAGAS_ESTAGIO e,
                    ORGAO_GESTOR_ESTAGIO c,
                    ORGAO_ESTAGIO d,
                    USUARIO u_cad,
                    USUARIO u_atua,
                    V_FUNCIONARIO_TOTAL f_cad,
                    V_FUNCIONARIO_TOTAL f_atua
              where a.ID_OFERTA_VAGA = b.ID_OFERTA_VAGA(+)
                    and b.ID_QUADRO_VAGAS_ESTAGIO = e.ID_QUADRO_VAGAS_ESTAGIO(+)
                    and a.ID_ORGAO_GESTOR_ESTAGIO = C.ID_ORGAO_GESTOR_ESTAGIO
                    and a.ID_ORGAO_ESTAGIO = D.ID_ORGAO_ESTAGIO
                    and a.ID_USUARIO_CADASTRO = u_cad.ID_USUARIO
                    and a.ID_USUARIO_ATUALIZACAO = u_atua.ID_USUARIO

                    and u_cad.ID_PESSOA_FUNCIONARIO = f_cad.ID_PESSOA_FUNCIONARIO
                    and u_atua.ID_PESSOA_FUNCIONARIO = f_atua.ID_PESSOA_FUNCIONARIO
                    and u_cad.ID_UNIDADE_GESTORA = f_cad.ID_UNIDADE_GESTORA
                    and u_atua.ID_UNIDADE_GESTORA = f_atua.ID_UNIDADE_GESTORA";

        $VO->ID_SELECAO_ESTAGIO ? $query .= " and a.ID_SELECAO_ESTAGIO = " . $VO->ID_SELECAO_ESTAGIO . "" : false;

        return $this->sqlVetor($query);
    }

    function alterar($VO) {

        $query = "
            update SELECAO_ESTAGIO
                set
                    DT_ATUALIZACAO = SYSDATE,
                    /*DT_AGENDAMENTO = TO_DATE('" . $VO->DT_AGENDAMENTO . "', 'dd/mm/yyyy'),
                    DT_REALIZACAO = TO_DATE('" . $VO->DT_REALIZACAO . "', 'dd/mm/yyyy'),*/
                    ID_USUARIO_ATUALIZACAO =" . $_SESSION['ID_USUARIO'] . ",
                    CS_SITUACAO = " . $VO->CS_SITUACAO . "
              where
                    ID_SELECAO_ESTAGIO = " . $VO->ID_SELECAO_ESTAGIO;

        return $this->sql($query);
    }

    function excluir($VO) {

        $query = "
            DELETE
                FROM SELECAO_ESTAGIO
               WHERE ID_SELECAO_ESTAGIO = " . $VO->ID_SELECAO_ESTAGIO;

        return $this->sql($query);
    }

    function pesquisarCandidatos($VO) {
        $query = "
            select a.ID_PESSOA_ESTAGIARIO CODIGO, upper(a.TX_NOME) TX_NOME
               from V_ESTAGIARIO a
              where a.ID_PESSOA_ESTAGIARIO
                not in (select NB_CANDIDATO
                        from ESTAGIARIO_SELECAO
                        where ID_SELECAO_ESTAGIO = " . $VO->ID_SELECAO_ESTAGIO . ")
                and a.ID_PESSOA_ESTAGIARIO
                not in (select ID_PESSOA_ESTAGIARIO
                        from CONTRATO_ESTAGIO
                        where DT_DESLIGAMENTO is null)
              order by a.TX_NOME";

        return $this->sqlVetor($query);
    }

    function buscarCPF($VO) {

        $query = "
            select a.ID_PESSOA_ESTAGIARIO CODIGO, a.TX_NOME, a.NB_CPF
               from V_ESTAGIARIO a
              where a.ID_PESSOA_ESTAGIARIO = '" . $VO->NB_CANDIDATO . "'";

        return $this->sqlVetor($query);
    }

    function buscarCandidatoVaga($VO) {

        $query = "
            select a.NB_CANDIDATO,
                    a.CS_SITUACAO,
                    a.TX_MOTIVO_SITUACAO,
                    upper(b.TX_NOME) TX_NOME,
                    b.NB_CPF,
                    b.ID_PESSOA_ESTAGIARIO
               from ESTAGIARIO_SELECAO a,
                    V_ESTAGIARIO b
              where a.NB_CANDIDATO = b.ID_PESSOA_ESTAGIARIO
                and a.ID_SELECAO_ESTAGIO = '" . $VO->ID_SELECAO_ESTAGIO . "'
              order by b.TX_NOME
        ";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

    function atualizarInf($VO) {

        $query = "
            update SELECAO_ESTAGIO set
                    DT_ATUALIZACAO = sysdate,
                    ID_USUARIO_ATUALIZACAO = " . $_SESSION['ID_USUARIO'] . "
              where ID_SELECAO_ESTAGIO = " . $_SESSION[ID_SELECAO_ESTAGIO];

        $this->sql($query);

        $data = "
            select to_char(a.DT_ATUALIZACAO, 'DD/MM/YYYY hh24:mi:ss') DT_ATUALIZACAO, c.TX_FUNCIONARIO
               from SELECAO_ESTAGIO a, USUARIO b, V_FUNCIONARIO_USUARIO c
              where a.ID_SELECAO_ESTAGIO = '" . $VO->ID_SELECAO_ESTAGIO . "'
                and a.ID_USUARIO_ATUALIZACAO = b.ID_USUARIO
                and b.ID_PESSOA_FUNCIONARIO = c.ID_PESSOA_FUNCIONARIO
                and b.ID_UNIDADE_GESTORA = c.ID_UNIDADE_GESTORA";

        $this->sqlVetor($data);
        $datahora = $this->getVetor();

        return $datahora;
    }

    function inserirCandidato($VO) {
        $query = "
            insert
                into ESTAGIARIO_SELECAO
                    (ID_SELECAO_ESTAGIO, ID_USUARIO_SELECIONADOR, CS_SITUACAO, TX_MOTIVO_SITUACAO, ID_USUARIO, NB_CANDIDATO)
              values
                    (" . $VO->ID_SELECAO_ESTAGIO . ",
                     " . $_SESSION['ID_USUARIO'] . ",
                     '1',
                     '" . $VO->TX_MOTIVO_SITUACAO . "',
                     " . $_SESSION['ID_USUARIO'] . ",
                     " . $VO->NB_CANDIDATO . ")";

        return $this->sql($query);
    }

    function excluirCandidato($VO) {

        $query = "
            delete
                from ESTAGIARIO_SELECAO
               where ID_SELECAO_ESTAGIO = " . $VO->ID_SELECAO_ESTAGIO . "
                 and NB_CANDIDATO = " . $VO->NB_CANDIDATO;

        return $this->sql($query);
    }

    function alterarCandidato($VO) {

        $query = "UPDATE ESTAGIARIO_SELECAO SET
                    CS_SITUACAO = " . $VO->CS_SITUACAO . " ,
                    TX_MOTIVO_SITUACAO = '" . $VO->TX_MOTIVO_SITUACAO . "' ,
                    ID_USUARIO_SELECIONADOR = " . $_SESSION['ID_USUARIO'] . ",
                    DT_AGENDAMENTO = TO_DATE('" . $VO->DT_AGENDAMENTO . "','DD/MM/YYYY') ,
                    DT_REALIZACAO = TO_DATE('" . $VO->DT_REALIZACAO . "','DD/MM/YYYY')
                    WHERE ID_SELECAO_ESTAGIO = " . $VO->ID_SELECAO_ESTAGIO . "
                    AND ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO . "
                    AND NB_VAGAS_RECRUTAMENTO = " . $VO->NB_VAGAS_RECRUTAMENTO . "
                    AND NB_CANDIDATO = " . $VO->NB_CANDIDATO;

        return $this->sql($query);
    }

    function efetivar($VO) {

        $query = "UPDATE SELECAO_ESTAGIO SET CS_SITUACAO = 2 WHERE ID_SELECAO_ESTAGIO = " . $_SESSION['ID_SELECAO_ESTAGIO'];
        ;

        return $this->sql($query);
    }

    function verificarSituacaoAnalise($VO) {

        $query = "SELECT ESTAGIARIO_SELECAO.ID_SELECAO_ESTAGIO CONTADOR FROM ESTAGIARIO_SELECAO
                    WHERE CS_SITUACAO = 1 AND ID_SELECAO_ESTAGIO = " . $VO->ID_SELECAO_ESTAGIO;

        return $this->sqlVetor($query);
    }

    function verificarContrato($VO) {
        $query = "select ID_CONTRATO from CONTRATO_ESTAGIO where ID_SELECAO_ESTAGIO = '" . $VO->ID_SELECAO_ESTAGIO . "'";

        return $this->sqlVetor($query);
    }

    /*



      function buscarSelecao_Estagio($VO) {

      $query = "SELECT SELECAO_ESTAGIO.ID_SELECAO_ESTAGIO, TO_CHAR(SELECAO_ESTAGIO.DT_CADASTRO,'DD/MM/YYYY  HH24:MI:SS') DT_CADASTRO, TO_CHAR(SELECAO_ESTAGIO.DT_ATUALIZACAO,'DD/MM/YYYY HH24:MI:SS') DT_ATUALIZACAO,
      TO_CHAR(SELECAO_ESTAGIO.DT_REALIZACAO,'DD/MM/YYYY') DT_REALIZACAO, SELECAO_ESTAGIO.ID_ORGAO_ESTAGIO, SELECAO_ESTAGIO.ID_USUARIO_CADASTRO, SELECAO_ESTAGIO.TX_COD_SELECAO,
      SELECAO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO, SELECAO_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO, TO_CHAR(SELECAO_ESTAGIO.DT_AGENDAMENTO,'DD/MM/YYYY') DT_AGENDAMENTO, SELECAO_ESTAGIO.ID_USUARIO_ATUALIZACAO,
      ORGAO_ESTAGIO.TX_ORGAO_ESTAGIO, ORGAO_GESTOR_ESTAGIO.TX_ORGAO_GESTOR_ESTAGIO, RECRUTAMENTO_ESTAGIO.TX_COD_RECRUTAMENTO,
      V_FUNCIONARIO_TOTAL.TX_FUNCIONARIO TX_FUNCIONARIO_ALT, V_FUNCIONARIO_TOTAL1.TX_FUNCIONARIO AS TX_FUNCIONARIO_CAD, QUADRO_VAGAS_ESTAGIO.TX_CODIGO, DECODE(SELECAO_ESTAGIO.CS_SITUACAO,1,'ABERTA',2,'FECHADA') TX_SITUACAO, SELECAO_ESTAGIO.CS_SITUACAO
      FROM SEMAD.SELECAO_ESTAGIO, SEMAD.RECRUTAMENTO_ESTAGIO, SEMAD.ORGAO_GESTOR_ESTAGIO, SEMAD.USUARIO, SEMAD.USUARIO USUARIO1, SEMAD.ORGAO_ESTAGIO,
      SEMAD.V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL1, SEMAD.V_FUNCIONARIO_TOTAL, SEMAD.QUADRO_VAGAS_ESTAGIO

      WHERE RECRUTAMENTO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO = SELECAO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO
      AND ORGAO_GESTOR_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO   = SELECAO_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO
      AND USUARIO.ID_USUARIO                             = SELECAO_ESTAGIO.ID_USUARIO_ATUALIZACAO
      AND USUARIO1.ID_USUARIO                            = SELECAO_ESTAGIO.ID_USUARIO_CADASTRO
      AND ORGAO_ESTAGIO.ID_ORGAO_ESTAGIO                 = SELECAO_ESTAGIO.ID_ORGAO_ESTAGIO
      AND USUARIO1.ID_UNIDADE_GESTORA                    = V_FUNCIONARIO_TOTAL1.ID_UNIDADE_GESTORA
      AND USUARIO1.ID_PESSOA_FUNCIONARIO                 = V_FUNCIONARIO_TOTAL1.ID_PESSOA_FUNCIONARIO
      AND USUARIO.ID_PESSOA_FUNCIONARIO                  = V_FUNCIONARIO_TOTAL.ID_PESSOA_FUNCIONARIO
      AND USUARIO.ID_UNIDADE_GESTORA                     = V_FUNCIONARIO_TOTAL.ID_UNIDADE_GESTORA
      AND RECRUTAMENTO_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO   = QUADRO_VAGAS_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO
      ";

      $VO->ID_SELECAO_ESTAGIO ? $query .= " AND SELECAO_ESTAGIO.ID_SELECAO_ESTAGIO = ".$VO->ID_SELECAO_ESTAGIO."" : false;

      return $this->sqlVetor($query);
      }

      function buscarOrgaoSolicitante($VO) {

      // Função que pega todos os Orgãos Solicitantes a qual o Usuario pertence
      // Utilizada na Index chamada pelo arrays.php
      $query = "SELECT DISTINCT
      C.ID_ORGAO_ESTAGIO CODIGO,
      C.TX_ORGAO_ESTAGIO,
      C.ID_ORGAO_ESTAGIO
      FROM
      AGENTE_SETORIAL_ESTAGIO A ,
      ORGAO_AGENTE_SETORIAL B,
      ORGAO_ESTAGIO C
      WHERE
      A.ID_SETORIAL_ESTAGIO = B.ID_SETORIAL_ESTAGIO
      AND C.ID_ORGAO_ESTAGIO = B.ID_ORGAO_ESTAGIO
      AND A.ID_USUARIO=" . $_SESSION['ID_USUARIO'];
      return $this->sqlVetor($query);
      }




      function pesquisarCandidatos($VO) {

      $query = "SELECT
      C.ID_RECRUTAMENTO_ESTAGIO || '_' || C.NB_VAGAS_RECRUTAMENTO  || '_' || C.NB_CANDIDATO CODIGO
      ,D.TX_NOME
      FROM
      ESTAGIARIO_VAGA C,
      V_ESTAGIARIO D,
      RECRUTAMENTO_ESTAGIO R
      WHERE C.ID_PESSOA_ESTAGIARIO = D.ID_PESSOA_ESTAGIARIO
      AND C.ID_RECRUTAMENTO_ESTAGIO = R.ID_RECRUTAMENTO_ESTAGIO
      AND C.CS_SITUACAO = 1
      AND C.NB_CANDIDATO NOT IN (SELECT ESTAGIARIO_SELECAO.NB_CANDIDATO FROM ESTAGIARIO_SELECAO
      WHERE ESTAGIARIO_SELECAO.ID_RECRUTAMENTO_ESTAGIO = C.ID_RECRUTAMENTO_ESTAGIO
      )

      AND C.ID_RECRUTAMENTO_ESTAGIO = " . $_SESSION['ID_RECRUTAMENTO_ESTAGIO'] . "
      ";

      return $this->sqlVetor($query);
      }

      function pesquisar($VO) {

      $query = "SELECT ID_SELECAO_ESTAGIO, E.ID_RECRUTAMENTO_ESTAGIO, E.NB_VAGAS_RECRUTAMENTO, ID_USUARIO_SELECIONADOR,
      E.CS_SITUACAO, E.TX_MOTIVO_SITUACAO, U.ID_USUARIO, TO_CHAR(DT_AGENDAMENTO,'DD/MM/YYYY') DT_AGENDAMENTO, TO_CHAR(DT_REALIZACAO,'DD/MM/YYYY') DT_REALIZACAO, E.NB_CANDIDATO,D.TX_NOME,
      DECODE(E.CS_SITUACAO,1,'EM ANÁLISE',2,'APROVADO',3,'REPROVADO',4,'CANCELADO') TX_SITUACAO, T.TX_TIPO_VAGA_ESTAGIO, Q.TX_CODIGO,
      C.ID_RECRUTAMENTO_ESTAGIO || '_' || C.NB_VAGAS_RECRUTAMENTO  || '_' || C.NB_CANDIDATO ESTAGIARIO_SELECAO
      FROM ESTAGIARIO_SELECAO E,
      ESTAGIARIO_VAGA C,
      V_ESTAGIARIO D,
      RECRUTAMENTO_ESTAGIO R,
      USUARIO U,
      V_FUNCIONARIO_TOTAL V,
      USUARIO U1,
      V_FUNCIONARIO_TOTAL V1,
      TIPO_VAGA_ESTAGIO T,
      VAGAS_RECRUTAMENTO VR,
      QUADRO_VAGAS_ESTAGIO Q
      WHERE E.ID_RECRUTAMENTO_ESTAGIO = C.ID_RECRUTAMENTO_ESTAGIO
      AND E.NB_VAGAS_RECRUTAMENTO = C.NB_VAGAS_RECRUTAMENTO
      AND E.NB_CANDIDATO = C.NB_CANDIDATO
      AND C.ID_PESSOA_ESTAGIARIO = D.ID_PESSOA_ESTAGIARIO
      AND C.ID_RECRUTAMENTO_ESTAGIO = R.ID_RECRUTAMENTO_ESTAGIO
      AND C.CS_SITUACAO = 1
      AND E.ID_USUARIO_SELECIONADOR = U.ID_USUARIO
      AND U.ID_UNIDADE_GESTORA                    = V.ID_UNIDADE_GESTORA
      AND U.ID_PESSOA_FUNCIONARIO                 = V.ID_PESSOA_FUNCIONARIO
      AND E.ID_USUARIO = U1.ID_USUARIO
      AND U1.ID_UNIDADE_GESTORA                    = V1.ID_UNIDADE_GESTORA
      AND U1.ID_PESSOA_FUNCIONARIO                 = V1.ID_PESSOA_FUNCIONARIO
      AND C.ID_RECRUTAMENTO_ESTAGIO = VR.ID_RECRUTAMENTO_ESTAGIO
      AND C.NB_VAGAS_RECRUTAMENTO = VR.NB_VAGAS_RECRUTAMENTO
      AND VR.CS_TIPO_VAGA_ESTAGIO = T.CS_TIPO_VAGA_ESTAGIO
      AND R.ID_QUADRO_VAGAS_ESTAGIO = Q.ID_QUADRO_VAGAS_ESTAGIO
      ";

      $query .= " AND E.ID_SELECAO_ESTAGIO = " . $_SESSION[ID_SELECAO_ESTAGIO];

      //        $query .= " ORDER BY A.TX_FUNCIONARIO";


      if ($VO->Reg_quantidade){
      !$VO->Reg_inicio? $VO->Reg_inicio = 0: false;
      $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (".$query.") PAGING WHERE (ROWNUM <= ".($VO->Reg_quantidade+$VO->Reg_inicio)."))  WHERE (PAGING_RN > ".$VO->Reg_inicio.")";
      }

      return $this->sqlVetor($query);
      }


      function buscar($VO) {

      $query = "SELECT ID_SELECAO_ESTAGIO, E.ID_RECRUTAMENTO_ESTAGIO, E.NB_VAGAS_RECRUTAMENTO, ID_USUARIO_SELECIONADOR,
      E.CS_SITUACAO, E.TX_MOTIVO_SITUACAO, U.ID_USUARIO, TO_CHAR(DT_AGENDAMENTO,'DD/MM/YYYY') DT_AGENDAMENTO, TO_CHAR(DT_REALIZACAO,'DD/MM/YYYY') DT_REALIZACAO, E.NB_CANDIDATO,D.TX_NOME,
      DECODE(E.CS_SITUACAO,1,'EM ANÁLISE',2,'APROVADO',3,'REPROVADO',4,'CANCELADO') TX_SITUACAO, T.TX_TIPO_VAGA_ESTAGIO, Q.TX_CODIGO,
      C.ID_RECRUTAMENTO_ESTAGIO || '_' || C.NB_VAGAS_RECRUTAMENTO  || '_' || C.NB_CANDIDATO ESTAGIARIO_SELECAO
      FROM ESTAGIARIO_SELECAO E,
      ESTAGIARIO_VAGA C,
      V_ESTAGIARIO D,
      RECRUTAMENTO_ESTAGIO R,
      USUARIO U,
      V_FUNCIONARIO_TOTAL V,
      USUARIO U1,
      V_FUNCIONARIO_TOTAL V1,
      TIPO_VAGA_ESTAGIO T,
      VAGAS_RECRUTAMENTO VR,
      QUADRO_VAGAS_ESTAGIO Q
      WHERE E.ID_RECRUTAMENTO_ESTAGIO = C.ID_RECRUTAMENTO_ESTAGIO
      AND E.NB_VAGAS_RECRUTAMENTO = C.NB_VAGAS_RECRUTAMENTO
      AND E.NB_CANDIDATO = C.NB_CANDIDATO
      AND C.ID_PESSOA_ESTAGIARIO = D.ID_PESSOA_ESTAGIARIO
      AND C.ID_RECRUTAMENTO_ESTAGIO = R.ID_RECRUTAMENTO_ESTAGIO
      AND C.CS_SITUACAO = 1
      AND E.ID_USUARIO_SELECIONADOR = U.ID_USUARIO
      AND U.ID_UNIDADE_GESTORA                    = V.ID_UNIDADE_GESTORA
      AND U.ID_PESSOA_FUNCIONARIO                 = V.ID_PESSOA_FUNCIONARIO
      AND E.ID_USUARIO = U1.ID_USUARIO
      AND U1.ID_UNIDADE_GESTORA                    = V1.ID_UNIDADE_GESTORA
      AND U1.ID_PESSOA_FUNCIONARIO                 = V1.ID_PESSOA_FUNCIONARIO
      AND C.ID_RECRUTAMENTO_ESTAGIO = VR.ID_RECRUTAMENTO_ESTAGIO
      AND C.NB_VAGAS_RECRUTAMENTO = VR.NB_VAGAS_RECRUTAMENTO
      AND VR.NB_VAGAS_RECRUTAMENTO = T.CS_TIPO_VAGA_ESTAGIO
      AND R.ID_QUADRO_VAGAS_ESTAGIO = Q.ID_QUADRO_VAGAS_ESTAGIO
      AND E.ID_SELECAO_ESTAGIO = ".$_SESSION[ID_SELECAO_ESTAGIO]."
      AND E.NB_CANDIDATO = ".$VO->NB_CANDIDATO."
      AND E.NB_VAGAS_RECRUTAMENTO = ".$VO->NB_VAGAS_RECRUTAMENTO."
      AND E.ID_RECRUTAMENTO_ESTAGIO = ".$VO->ID_RECRUTAMENTO_ESTAGIO."
      ";

      return $this->sqlVetor($query);

      }



      function atualizarInf($VO) {

      $query = "UPDATE SELECAO_ESTAGIO SET
      DT_ATUALIZACAO = SYSDATE,
      ID_USUARIO_ATUALIZACAO = ".$_SESSION['ID_USUARIO'];
      $VO->EFETIVAR ? $query .= " ,CS_SITUACAO = 2 " : false;
      $query .= "WHERE ID_SELECAO_ESTAGIO = " . $_SESSION[ID_SELECAO_ESTAGIO];

      $this->sql($query);

      $data = "SELECT TO_CHAR(SELECAO_ESTAGIO.DT_ATUALIZACAO,'DD/MM/YYYY HH24:MI:SS') DT_ATUALIZACAO,
      V_FUNCIONARIO_TOTAL.TX_FUNCIONARIO TX_FUNCIONARIO_ALT, DECODE(SELECAO_ESTAGIO.CS_SITUACAO,1,'ABERTA',2,'FECHADA') TX_SITUACAO
      FROM SEMAD.SELECAO_ESTAGIO, SEMAD.RECRUTAMENTO_ESTAGIO, SEMAD.USUARIO,SEMAD.V_FUNCIONARIO_TOTAL
      WHERE RECRUTAMENTO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO = SELECAO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO
      AND USUARIO.ID_USUARIO                             = SELECAO_ESTAGIO.ID_USUARIO_ATUALIZACAO
      AND USUARIO.ID_PESSOA_FUNCIONARIO                  = V_FUNCIONARIO_TOTAL.ID_PESSOA_FUNCIONARIO
      AND USUARIO.ID_UNIDADE_GESTORA                     = V_FUNCIONARIO_TOTAL.ID_UNIDADE_GESTORA
      AND ID_SELECAO_ESTAGIO = " . $_SESSION[ID_SELECAO_ESTAGIO];

      $this->sqlVetor($data);
      $datahora = $this->getVetor();

      return $datahora;

      }







      function efetivar($VO) {

      $query = "
      SELECT (ESTAGIARIO_SELECAO.ID_SELECAO_ESTAGIO) CONTADOR FROM ESTAGIARIO_SELECAO
      WHERE CS_SITUACAO = 1
      AND ID_SELECAO_ESTAGIO = " . $VO->ID_SELECAO_ESTAGIO . "
      AND ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO ."
      ";

      return $this->sqlVetor($query);

      }

     */
}

?>