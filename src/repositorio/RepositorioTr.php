<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioTr extends Repositorio {

    // ########################### ------------------  Repositorio do Master ---------- #################################

    function pesquisar($VO) {

        $codigoOrgaoSolicitante = explode('_', $VO->ID_ORGAO_ESTAGIO);

        $codigoOrgaoGestor = explode('_', $VO->ID_ORGAO_GESTOR_ESTAGIO);
        $query = "SELECT
                  S.ID_SOLICITACAO_TR,
                  B.ID_ORGAO_GESTOR_ESTAGIO ||'_'|| B.ID_UNIDADE_ORG ID_ORGAO_GESTOR_ESTAGIO,
                  C.ID_ORGAO_ESTAGIO || '_' || V_UNIDADE_ORG.NB_COD_UNIDADE ID_ORGAO_ESTAGIO,
                  S.TX_CODIGO,
                  S.TX_CARGO_AGENTE,
                  S.TX_EMAIL_AGENTE,
                  S.TX_TELEFONE_AGENTE,
                  TO_CHAR(S.DT_TERMINO_ESTAGIO,'DD/MM/YYYY HH24:MI:SS') DT_TERMINO_ESTAGIO,
                  S.ID_CONTRATO,
                  S.ID_SETORIAL_ESTAGIO,
                  TO_CHAR(S.DT_CADASTRO,'DD/MM/YYYY HH24:MI:SS') DT_CADASTRO,
                  TO_CHAR(S.DT_ATUALIZACAO,'DD/MM/YYYY HH24:MI:SS') DT_ATUALIZACAO,
                  S.ID_USUARIO_CADASTRO,
                  S.ID_USUARIO_ATUALIZACAO,
                  S.CS_SITUACAO,
                  D.TX_NOME,
                  D.NB_CPF,
                  T.TX_TIPO_VAGA_ESTAGIO,
                  I.TX_INSTITUICAO_ENSINO,
                  CE.TX_CURSO_ESTAGIO,
                  TX_ORGAO_GESTOR_ESTAGIO,
                  TX_ORGAO_ESTAGIO,
                  V_FUNCIONARIO_TOTAL2.TX_FUNCIONARIO SECRETARIO,
                  DECODE(A.CS_PERIODO, 1,'1º Ano', 2,'2º Ano', 3,'3º Ano', 4,'4º Ano', 5,'5º Ano', 6,'1º Periodo', 7,'2º Periodo',8,'3º Periodo',
                                       9,'4º Periodo', 10,'5º Periodo', 11,'6º Periodo', 12,'7º Periodo', 13,'8º Periodo', 14,'9º Periodo', 15,'10º Periodo') TX_PERIODO
                  ,SUBSTR(T.TX_TIPO_VAGA_ESTAGIO, 0, (CASE WHEN INSTR(T.TX_TIPO_VAGA_ESTAGIO, ' ') <> 0 THEN INSTR(T.TX_TIPO_VAGA_ESTAGIO, ' ') - 1 ELSE LENGTH(T.TX_TIPO_VAGA_ESTAGIO) END)) TX_NIVEL , A.TX_TCE,
                  V_FUNCIONARIO_TOTAL.TX_FUNCIONARIO TX_FUNCIONARIO_CADASTRO, V_FUNCIONARIO_TOTAL1.TX_FUNCIONARIO TX_FUNCIONARIO_ALTERACAO, S.TX_MOTIVO, S.TX_OBSERVACAO,
                  DECODE(S.CS_SITUACAO, 1,'ABERTA', 2,'FECHADA') TX_SITUACAO, E.TX_AGENCIA_ESTAGIO, A.TX_CODIGO TX_CODIGO_CONTRATO, V_FUNCIONARIO_TOTAL3.TX_FUNCIONARIO TX_AGENTE_SETORIAL

            FROM
                  SOLICITACAO_TR S,
                  CONTRATO_ESTAGIO A,
                  ORGAO_GESTOR_ESTAGIO B,
                  ORGAO_ESTAGIO C,
                  V_ESTAGIARIO D,
                  AGENCIA_ESTAGIO E ,
                  SELECAO_ESTAGIO F,
                  TIPO_VAGA_ESTAGIO T,
                  INSTITUICAO_ENSINO I,
                  CURSO_ESTAGIO CE,
                  USUARIO USUARIO,
                  USUARIO USUARIO1,
                  V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL ,
                  V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL1,
                  RESPONSAVEL_UNID_ORG RESP,
                  V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL2,
                  V_UNIDADE_ORG,
                  USUARIO USUARIO3,
                  V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL3,
                  AGENTE_SETORIAL_ESTAGIO AG
            WHERE
                  S.ID_CONTRATO = A.ID_CONTRATO
                  AND A.ID_AGENCIA_ESTAGIO            = E.ID_AGENCIA_ESTAGIO
                  AND B.ID_ORGAO_GESTOR_ESTAGIO       = A.ID_ORGAO_GESTOR_ESTAGIO
                  AND A.ID_ORGAO_ESTAGIO              = C.ID_ORGAO_ESTAGIO
                  AND A.ID_PESSOA_ESTAGIARIO          = D.ID_PESSOA_ESTAGIARIO
                  AND F.ID_SELECAO_ESTAGIO            = A.ID_SELECAO_ESTAGIO
                  AND A.CS_TIPO_VAGA_ESTAGIO          = T.CS_TIPO_VAGA_ESTAGIO
                  AND A.ID_INSTITUICAO_ENSINO         = I.ID_INSTITUICAO_ENSINO
                  AND A.ID_CURSO_ESTAGIO              = CE.ID_CURSO_ESTAGIO
                  AND S.ID_USUARIO_CADASTRO           = USUARIO.ID_USUARIO
                  AND S.ID_USUARIO_ATUALIZACAO        = USUARIO1.ID_USUARIO
                  AND USUARIO1.ID_UNIDADE_GESTORA     = V_FUNCIONARIO_TOTAL1.ID_UNIDADE_GESTORA
                  AND USUARIO1.ID_PESSOA_FUNCIONARIO  = V_FUNCIONARIO_TOTAL1.ID_PESSOA_FUNCIONARIO
                  AND USUARIO.ID_PESSOA_FUNCIONARIO   = V_FUNCIONARIO_TOTAL.ID_PESSOA_FUNCIONARIO
                  AND USUARIO.ID_UNIDADE_GESTORA      = V_FUNCIONARIO_TOTAL.ID_UNIDADE_GESTORA
                  AND B.ID_UNIDADE_ORG                = RESP.ID_UNIDADE_ORG(+)
                  AND RESP.ID_PESSOA_FUNCIONARIO      = V_FUNCIONARIO_TOTAL2.ID_PESSOA_FUNCIONARIO(+)
                  AND RESP.ID_UNIDADE_GESTORA         = V_FUNCIONARIO_TOTAL2.ID_UNIDADE_GESTORA(+)
                  AND V_UNIDADE_ORG.ID_UNIDADE_ORG    = C.ID_UNIDADE_ORG
                  AND S.ID_SETORIAL_ESTAGIO = AG.ID_SETORIAL_ESTAGIO
                  AND AG.ID_USUARIO = USUARIO3.ID_USUARIO
                  AND USUARIO3.ID_PESSOA_FUNCIONARIO = V_FUNCIONARIO_TOTAL3.ID_PESSOA_FUNCIONARIO
                  AND USUARIO3.ID_UNIDADE_GESTORA = V_FUNCIONARIO_TOTAL3.ID_UNIDADE_GESTORA
                  AND S.ID_SOLICITACAO_TR             = ".$_SESSION['ID_SOLICITACAO_TR'];

        return $this->sqlVetor($query);
    }

    function pesquisarSolicitacao($VO) {

        $codigoOrgaoSolicitante = explode('_', $VO->ID_ORGAO_ESTAGIO);

        $codigoOrgaoGestor = explode('_', $VO->ID_ORGAO_GESTOR_ESTAGIO);

        $query = "SELECT
                  S.ID_SOLICITACAO_TR,
                  S.TX_CODIGO,
                  S.TX_CARGO_AGENTE,
                  S.TX_EMAIL_AGENTE,
                  S.TX_TELEFONE_AGENTE,
                  S.DT_TERMINO_ESTAGIO,
                  S.ID_CONTRATO,
                  S.ID_SETORIAL_ESTAGIO,
                  S.ID_ORGAO_ESTAGIO,
                  S.DT_CADASTRO,
                  S.DT_ATUALIZACAO,
                  S.ID_USUARIO_CADASTRO,
                  S.ID_USUARIO_ATUALIZACAO,
                  S.CS_SITUACAO,
                  D.TX_NOME,
                  D.NB_CPF,
                  T.TX_TIPO_VAGA_ESTAGIO,
                  I.TX_INSTITUICAO_ENSINO,
                  CE.TX_CURSO_ESTAGIO,
                  TX_ORGAO_GESTOR_ESTAGIO,
                  TX_ORGAO_ESTAGIO,
                  V_FUNCIONARIO_TOTAL2.TX_FUNCIONARIO SECRETARIO,
                  DECODE(A.CS_PERIODO, 1,'1º Ano', 2,'2º Ano', 3,'3º Ano', 4,'4º Ano', 5,'5º Ano', 6,'1º Periodo', 7,'2º Periodo',8,'3º Periodo',
                                       9,'4º Periodo', 10,'5º Periodo', 11,'6º Periodo', 12,'7º Periodo', 13,'8º Periodo', 14,'9º Periodo', 15,'10º Periodo') PERIODO
                  ,SUBSTR(T.TX_TIPO_VAGA_ESTAGIO, 0, (CASE WHEN INSTR(T.TX_TIPO_VAGA_ESTAGIO, ' ') <> 0 THEN INSTR(T.TX_TIPO_VAGA_ESTAGIO, ' ') - 1 ELSE LENGTH(T.TX_TIPO_VAGA_ESTAGIO) END)) NIVEL , A.TX_TCE,
                  V_FUNCIONARIO_TOTAL.TX_FUNCIONARIO TX_FUNCIONARIO_CADASTRO, V_FUNCIONARIO_TOTAL1.TX_FUNCIONARIO TX_FUNCIONARIO_ALTERACAO, S.TX_MOTIVO, S.TX_OBSERVACAO,
                  E.TX_AGENCIA_ESTAGIO, DECODE(S.CS_SITUACAO, 1,'ABERTA', 2,'FECHADA') TX_SITUACAO
            FROM
                  SOLICITACAO_TR S,
                  CONTRATO_ESTAGIO A,
                  ORGAO_GESTOR_ESTAGIO B,
                  ORGAO_ESTAGIO C,
                  V_ESTAGIARIO D,
                  AGENCIA_ESTAGIO E ,
                  SELECAO_ESTAGIO F,
                  TIPO_VAGA_ESTAGIO T,
                  INSTITUICAO_ENSINO I,
                  CURSO_ESTAGIO CE,
                  USUARIO USUARIO,
                  USUARIO USUARIO1,
                  V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL ,
                  V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL1,
                  RESPONSAVEL_UNID_ORG RESP,
                  V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL2
            WHERE
                  S.ID_CONTRATO = A.ID_CONTRATO
                  AND A.ID_AGENCIA_ESTAGIO            = E.ID_AGENCIA_ESTAGIO
                  AND B.ID_ORGAO_GESTOR_ESTAGIO       = A.ID_ORGAO_GESTOR_ESTAGIO
                  AND A.ID_ORGAO_ESTAGIO              = C.ID_ORGAO_ESTAGIO
                  AND A.ID_PESSOA_ESTAGIARIO          = D.ID_PESSOA_ESTAGIARIO
                  AND F.ID_SELECAO_ESTAGIO            = A.ID_SELECAO_ESTAGIO
                  AND A.CS_TIPO_VAGA_ESTAGIO          = T.CS_TIPO_VAGA_ESTAGIO
                  AND A.ID_INSTITUICAO_ENSINO         = I.ID_INSTITUICAO_ENSINO
                  AND A.ID_CURSO_ESTAGIO              = CE.ID_CURSO_ESTAGIO
                  AND S.ID_USUARIO_CADASTRO           = USUARIO.ID_USUARIO
                  AND S.ID_USUARIO_ATUALIZACAO        = USUARIO1.ID_USUARIO
                  AND USUARIO1.ID_UNIDADE_GESTORA     = V_FUNCIONARIO_TOTAL1.ID_UNIDADE_GESTORA
                  AND USUARIO1.ID_PESSOA_FUNCIONARIO  = V_FUNCIONARIO_TOTAL1.ID_PESSOA_FUNCIONARIO
                  AND USUARIO.ID_PESSOA_FUNCIONARIO   = V_FUNCIONARIO_TOTAL.ID_PESSOA_FUNCIONARIO
                  AND USUARIO.ID_UNIDADE_GESTORA      = V_FUNCIONARIO_TOTAL.ID_UNIDADE_GESTORA
                  AND B.ID_UNIDADE_ORG                = RESP.ID_UNIDADE_ORG(+)
                  AND RESP.ID_PESSOA_FUNCIONARIO      = V_FUNCIONARIO_TOTAL2.ID_PESSOA_FUNCIONARIO(+)
                  AND RESP.ID_UNIDADE_GESTORA         = V_FUNCIONARIO_TOTAL2.ID_UNIDADE_GESTORA(+)
                  AND A.ID_ORGAO_ESTAGIO = " . $codigoOrgaoSolicitante[0] . "
                  AND A.ID_ORGAO_GESTOR_ESTAGIO = " . $codigoOrgaoGestor[0]. " ";

          $VO->ID_AGENCIA_ESTAGIO ? $query .= " AND A.ID_AGENCIA_ESTAGIO = ".$VO->ID_AGENCIA_ESTAGIO." " : false;
          $VO->NB_CPF ? $query .= " AND NB_CPF = '".$VO->NB_CPF."' " : false;
          $VO->TX_COD_SELECAO ? $query .= " AND UPPER(TX_COD_SELECAO) LIKE '%" . $VO->TX_COD_SELECAO . "%' " : false;
          $VO->TX_NOME ? $query .= " AND UPPER(TX_NOME) LIKE '%" . $VO->TX_NOME . "%' " : false;
          $VO->TX_CODIGO ? $query .= " AND UPPER(S.TX_CODIGO) LIKE '%" . $VO->TX_CODIGO . "%' " : false;

        if ($VO->Reg_quantidade){
            !$VO->Reg_inicio? $VO->Reg_inicio = 0: false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (".$query.") PAGING WHERE (ROWNUM <= ".($VO->Reg_quantidade+$VO->Reg_inicio)."))  WHERE (PAGING_RN > ".$VO->Reg_inicio.")";
        }

        return $this->sqlVetor($query);
    }

    function inserir($VO) {

        $codigoOrgaoSolicitante = explode('_', $VO->ID_ORGAO_ESTAGIO);

        $codigoOrgaoGestor = explode('_', $VO->ID_ORGAO_GESTOR_ESTAGIO);

        $codigoCandidato = explode('_', $VO->ID_PESSOA_ESTAGIARIO);

        $queryPK = "select SEMAD.F_G_PK_SOLICITACAO_TR() as ID_SOLICITACAO_TR from DUAL";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "INSERT INTO SOLICITACAO_TR
                 (
                  ID_SOLICITACAO_TR,
                  TX_CODIGO,
                  TX_CARGO_AGENTE,
                  TX_EMAIL_AGENTE,
                  TX_TELEFONE_AGENTE,
                  DT_TERMINO_ESTAGIO,
                  ID_CONTRATO,
                  ID_SETORIAL_ESTAGIO,
                  ID_ORGAO_ESTAGIO,
                  DT_CADASTRO,
                  DT_ATUALIZACAO,
                  ID_USUARIO_CADASTRO,
                  ID_USUARIO_ATUALIZACAO,
                  CS_SITUACAO,
                  TX_MOTIVO,
                  TX_OBSERVACAO
                 )
                  VALUES
                 (
                  '".$CodigoPK['ID_SOLICITACAO_TR'][0]."',
                  SEMAD.F_G_COD_SOLICITACAO_TR(),
                  '" . $VO->TX_CARGO_AGENTE . "',
                  '" . $VO->TX_EMAIL_AGENTE . "',
                  '" . $VO->TX_TELEFONE_AGENTE . "',
                  TO_DATE('" . $VO->DT_TERMINO_ESTAGIO . "','DD/MM/YYYY'),
                  '" . $VO->ID_CONTRATO . "',
                  '" . $VO->ID_SETORIAL_ESTAGIO . "',
                  '" . $codigoOrgaoSolicitante[0] . "',
                  SYSDATE,
                  SYSDATE,
                  '".$_SESSION['ID_USUARIO']."',
                  '".$_SESSION['ID_USUARIO']."',
                  1,
                  '" . $VO->TX_MOTIVO . "',
                  '" . $VO->TX_OBSERVACAO . "'
                 )
   ";
        $retorno = $this->sql($query);

        return $retorno ? '' : $CodigoPK['ID_SOLICITACAO_TR'][0];
    }

    function alterar($VO) {
        $query = "UPDATE SOLICITACAO_TR SET
                  ID_CONTRATO = ".$VO->ID_CONTRATO." ,
                  ID_SETORIAL_ESTAGIO = ".$VO->ID_SETORIAL_ESTAGIO." ,
                  TX_CARGO_AGENTE = '".$VO->TX_CARGO_AGENTE."' ,
                  TX_TELEFONE_AGENTE = '".$VO->TX_TELEFONE_AGENTE."' ,
                  TX_EMAIL_AGENTE = '".$VO->TX_EMAIL_AGENTE."' ,
                  DT_TERMINO_ESTAGIO = TO_DATE('".$VO->DT_TERMINO_ESTAGIO."', 'DD/MM/YYYY HH24:MI:SS') ,
                  DT_ATUALIZACAO = SYSDATE ,
                  ID_USUARIO_ATUALIZACAO =".$_SESSION['ID_USUARIO'].",
                  CS_SITUACAO = ".$VO->CS_SITUACAO.",
                  TX_MOTIVO = '".$VO->TX_MOTIVO."',
                  TX_OBSERVACAO = '".$VO->TX_OBSERVACAO."'
                  WHERE ID_SOLICITACAO_TR =".$VO->ID_SOLICITACAO_TR;

        return $this->sql($query);
    }

    function excluir($VO) {
        $query = "DELETE FROM SOLICITACAO_TR
                  WHERE ID_SOLICITACAO_TR = ".$VO->ID_SOLICITACAO_TR;

        return $this->sql($query);
    }

    function buscarAgenteSetorial($VO) {

        $codigo = explode('_', $VO->ID_ORGAO_ESTAGIO);

        $query = "SELECT
                    C.ID_SETORIAL_ESTAGIO  CODIGO,
                    A.TX_FUNCIONARIO  TX_FUNCIONARIO
                FROM
                    V_FUNCIONARIO_TOTAL A,
                    USUARIO B ,
                    AGENTE_SETORIAL_ESTAGIO  C,
                    ORGAO_AGENTE_SETORIAL O
                    WHERE B.ID_USUARIO = C.ID_USUARIO
                    AND A.ID_UNIDADE_GESTORA = B.ID_UNIDADE_GESTORA
                    AND A.ID_PESSOA_FUNCIONARIO = B.ID_PESSOA_FUNCIONARIO
                    AND C.ID_SETORIAL_ESTAGIO = O.ID_SETORIAL_ESTAGIO
                    AND O.ID_ORGAO_ESTAGIO = NVL('" .$codigo[0]."',0)";

        return $this->sqlVetor($query);
    }

    function buscarDadosContrato($VO) {
        $query = "SELECT
                  A.ID_CONTRATO CODIGO,
                  A.ID_CONTRATO,
                  D.TX_NOME || '_' ||
                  D.NB_CPF || '_' ||
                  T.TX_TIPO_VAGA_ESTAGIO || '_' ||
                  I.TX_INSTITUICAO_ENSINO || '_' ||
                  CE.TX_CURSO_ESTAGIO
                  || '_' || DECODE(A.CS_PERIODO, 1,'1º Ano', 2,'2º Ano', 3,'3º Ano', 4,'4º Ano', 5,'5º Ano', 6,'1º Periodo', 7,'2º Periodo',8,'3º Periodo',
                                       9,'4º Periodo', 10,'5º Periodo', 11,'6º Periodo', 12,'7º Periodo', 13,'8º Periodo', 14,'9º Periodo', 15,'10º Periodo')
                  || '_' ||  SUBSTR(T.TX_TIPO_VAGA_ESTAGIO, 0, (CASE WHEN INSTR(T.TX_TIPO_VAGA_ESTAGIO, ' ') <> 0 THEN INSTR(T.TX_TIPO_VAGA_ESTAGIO, ' ') - 1 ELSE LENGTH(T.TX_TIPO_VAGA_ESTAGIO) END)) || '_' || A.TX_TCE || '_' || E.TX_AGENCIA_ESTAGIO TUDO
            FROM
                  CONTRATO_ESTAGIO A,
                  ORGAO_GESTOR_ESTAGIO B,
                  ORGAO_ESTAGIO C,
                  V_ESTAGIARIO D,
                  AGENCIA_ESTAGIO E ,
                  SELECAO_ESTAGIO F,
                  TIPO_VAGA_ESTAGIO T,
                  INSTITUICAO_ENSINO I,
                  CURSO_ESTAGIO CE
            WHERE
                      A.ID_AGENCIA_ESTAGIO      = E.ID_AGENCIA_ESTAGIO
                  AND B.ID_ORGAO_GESTOR_ESTAGIO = A.ID_ORGAO_GESTOR_ESTAGIO
                  AND A.ID_ORGAO_ESTAGIO        = C.ID_ORGAO_ESTAGIO
                  AND A.ID_PESSOA_ESTAGIARIO    = D.ID_PESSOA_ESTAGIARIO
                  AND F.ID_SELECAO_ESTAGIO      = A.ID_SELECAO_ESTAGIO
                  AND A.CS_TIPO_VAGA_ESTAGIO    = T.CS_TIPO_VAGA_ESTAGIO
                  AND A.ID_INSTITUICAO_ENSINO   = I.ID_INSTITUICAO_ENSINO
                  AND A.ID_CURSO_ESTAGIO        = CE.ID_CURSO_ESTAGIO ";

        $VO->ID_CONTRATO ? $query .= " AND ID_CONTRATO = " . $VO->ID_CONTRATO . " " : false;

        return $this->sqlVetor($query);
    }

    function buscarAgenteIntegracao($VO) {
        // função que busca no banco todas as agencias de integração
        // utilizada no arrays.php
        $query = "SELECT
                    ID_AGENCIA_ESTAGIO,
                    ID_AGENCIA_ESTAGIO CODIGO,
                    TX_AGENCIA_ESTAGIO
                  FROM
                    AGENCIA_ESTAGIO";

        return $this->sqlVetor($query);
    }

    function buscarContrato($VO) {

        $query = "SELECT ID_CONTRATO CODIGO, ID_CONTRATO, TX_CODIGO FROM CONTRATO_ESTAGIO ORDER BY TX_CODIGO";
        return $this->sqlVetor($query);
    }

    function buscarOrgaoGestor($VO) {

        $query = "SELECT
                    ID_ORGAO_GESTOR_ESTAGIO ,
                    ID_ORGAO_GESTOR_ESTAGIO ||'_'||ID_UNIDADE_ORG CODIGO,
                    TX_ORGAO_GESTOR_ESTAGIO,
                    ID_UNIDADE_ORG
                  FROM
                    ORGAO_GESTOR_ESTAGIO";
        return $this->sqlVetor($query);
    }

    function buscarOrgaoSolicitante($VO) {

        $query = "SELECT DISTINCT
                    C.ID_ORGAO_ESTAGIO ||'_'|| V_UNIDADE_ORG.NB_COD_UNIDADE CODIGO,
                    C.TX_ORGAO_ESTAGIO,
                    C.ID_ORGAO_ESTAGIO,
                    V_UNIDADE_ORG.NB_COD_UNIDADE,
                    C.ID_UNIDADE_ORG

                  FROM
                    AGENTE_SETORIAL_ESTAGIO A ,
                    ORGAO_AGENTE_SETORIAL B,
                    ORGAO_ESTAGIO C,
                    V_Unidade_org
                  WHERE
                    A.ID_SETORIAL_ESTAGIO = B.ID_SETORIAL_ESTAGIO
                    AND C.ID_ORGAO_ESTAGIO = B.ID_ORGAO_ESTAGIO
                    and V_UNidade_org.ID_UNIDADE_ORG =C.ID_UNIDADE_ORG
                    AND A.ID_USUARIO=" . $_SESSION['ID_USUARIO'];

        return $this->sqlVetor($query);
    }

    function buscarSecretarioOrgaoGestor($VO) {

        // função responasvel o Secretario do orgão gestor
        // Função utilizada no acaos.php
        $query = "select
                    FUNC.TX_FUNCIONARIO
                  from
                    responsavel_unid_org resp, v_funcionario_total func
                  where
                    resp.id_pessoa_funcionario = func.id_pessoa_funcionario
                    and resp.id_unidade_gestora = func.id_unidade_gestora
                    and id_unidade_org =" . $VO->ID_UNIDADE_ORG;
        return $this->sqlVetor($query);
    }

      function atualizarInf($VO) {

          $query = "UPDATE SOLICITACAO_TR SET
              DT_ATUALIZACAO = SYSDATE,
              ID_USUARIO_ATUALIZACAO = ".$_SESSION['ID_USUARIO'];
              $VO->EFETIVAR ? $query .= " ,CS_SITUACAO = 2 " : false;
              $query .= "WHERE ID_SOLICITACAO_TR = " . $_SESSION['ID_SOLICITACAO_TR'];

          $this->sql($query);

          $data = "SELECT TO_CHAR(SOLICITACAO_TR.DT_ATUALIZACAO,'DD/MM/YYYY HH24:MI:SS') DT_ATUALIZACAO,
                   V_FUNCIONARIO_TOTAL.TX_FUNCIONARIO TX_FUNCIONARIO_ALT,
                   DECODE(SOLICITACAO_TR.CS_SITUACAO,1,'ABERTA',2,'FECHADA') TX_SITUACAO
                   FROM SEMAD.SOLICITACAO_TR, SEMAD.USUARIO,SEMAD.V_FUNCIONARIO_TOTAL
                   WHERE USUARIO.ID_USUARIO                           = SOLICITACAO_TR.ID_USUARIO_ATUALIZACAO
                   AND USUARIO.ID_PESSOA_FUNCIONARIO                  = V_FUNCIONARIO_TOTAL.ID_PESSOA_FUNCIONARIO
                   AND USUARIO.ID_UNIDADE_GESTORA                     = V_FUNCIONARIO_TOTAL.ID_UNIDADE_GESTORA
                   AND ID_SOLICITACAO_TR = " . $_SESSION['ID_SOLICITACAO_TR'];

          $this->sqlVetor($data);
          $datahora = $this->getVetor();

          return $datahora;

      }

}
?>