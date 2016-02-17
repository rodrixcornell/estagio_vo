<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioS_TA extends Repositorio {

    // ------------------  Repositorio do Master -------------------------

    function buscarOrgaoGestor($VO) {
        $query = "select ID_ORGAO_GESTOR_ESTAGIO ||'_'||ID_UNIDADE_ORG CODIGO,
                    ID_ORGAO_GESTOR_ESTAGIO,
                    ID_UNIDADE_ORG,
                    TX_ORGAO_GESTOR_ESTAGIO
               from ORGAO_GESTOR_ESTAGIO
              order by TX_ORGAO_GESTOR_ESTAGIO";

        return $this->sqlVetor($query);
    }

//----------------buscar Orgao Solicitante---------------------------------------
    function buscarOrgaoSolicitante($VO) {
        $query = "select distinct
                    C.ID_ORGAO_ESTAGIO ||'_'|| B.ID_SETORIAL_ESTAGIO ||'_'|| D.NB_COD_UNIDADE CODIGO,
                    C.ID_ORGAO_ESTAGIO,
                    C.ID_UNIDADE_ORG,
                    B.ID_SETORIAL_ESTAGIO,
                    D.NB_COD_UNIDADE,
                    C.TX_ORGAO_ESTAGIO
               from AGENTE_SETORIAL_ESTAGIO A,
                    ORGAO_AGENTE_SETORIAL B,
                    ORGAO_ESTAGIO C,
                    V_UNIDADE_ORG D
              where A.ID_SETORIAL_ESTAGIO = B.ID_SETORIAL_ESTAGIO
                and C.ID_ORGAO_ESTAGIO = B.ID_ORGAO_ESTAGIO
                and D.ID_UNIDADE_ORG = C.ID_UNIDADE_ORG
                and A.ID_USUARIO = " . $_SESSION['ID_USUARIO'] . "
              order by C.TX_ORGAO_ESTAGIO ";

        return $this->sqlVetor($query);
    }

//------------buscarSecretario---------------------------
    function buscarSecretarioOrgaoGestor($VO) {

        $query = "select
                    FUNC.TX_FUNCIONARIO
                  from
                    responsavel_unid_org resp, v_funcionario_total func
                  where
                    resp.id_pessoa_funcionario = func.id_pessoa_funcionario
                    and resp.id_unidade_gestora = func.id_unidade_gestora
                    and id_unidade_org = " . $VO->ID_UNIDADE_ORG . " ";
        return $this->sqlVetor($query);
    }

//-----------------busca iel--------------------------------------------------
    function buscarAgenteIntegracao($VO) {

        $query = "SELECT ID_CONTRATO ||'_'||  C.ID_AGENCIA_ESTAGIO CODIGO,
                   TX_CODIGO,
                   A.TX_AGENCIA_ESTAGIO
              FROM CONTRATO_ESTAGIO C,
                   AGENCIA_ESTAGIO A
             WHERE C.ID_AGENCIA_ESTAGIO = A.ID_AGENCIA_ESTAGIO
            ORDER BY TX_CODIGO DESC";

        return $this->sqlVetor($query);
    }

//-------------------buscarContrato--------------------
    function buscarContrato($VO) {

        $codigoContrato = explode('_', $VO->ID_AGENCIA_ESTAGIO);

        $query = "select ID_CONTRATO ||'_'|| CE.ID_AGENCIA_ESTAGIO CODIGO,
                    TX_CODIGO
               from CONTRATO_ESTAGIO CE,
                    AGENCIA_ESTAGIO AE
              where CE.ID_AGENCIA_ESTAGIO = AE.ID_AGENCIA_ESTAGIO
           order by TX_CODIGO DESC";

        return $this->sqlVetor($query);
    }

//-------------buscarAgenteSetorial  OSMUNDO------------------
    function buscarASetorial($VO) {

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
                    AND O.ID_ORGAO_ESTAGIO = NVL('" . $codigo[0] . "',0)";

        return $this->sqlVetor($query);
    }

//-----------------pesquisa principal-------------------------------------------
    function pesquisarSolicitacao($VO) {

        $codigoOrgaoSolicitante = explode('_', $VO->ID_ORGAO_ESTAGIO);

        $codigoOrgaoGestor = explode('_', $VO->ID_ORGAO_GESTOR_ESTAGIO);



        $query = "SELECT ST.ID_SOLICITACAO_TA,
                            B.ID_ORGAO_GESTOR_ESTAGIO,
                            B.ID_UNIDADE_ORG,
                            C.ID_ORGAO_ESTAGIO,
                            V_UNIDADE_ORG.NB_COD_UNIDADE,
                            D.TX_NOME,
                            D.NB_CPF,
                            T.TX_TIPO_VAGA_ESTAGIO,
                            I.TX_INSTITUICAO_ENSINO,
                            CE.TX_CURSO_ESTAGIO,
                            B.TX_ORGAO_GESTOR_ESTAGIO,
                            C.TX_ORGAO_ESTAGIO,
                            V_FUNCIONARIO_TOTAL2.TX_FUNCIONARIO SECRETARIO,
                            DECODE(A.CS_PERIODO, 1,'1º ANO', 2,'2º ANO', 3,'3º ANO', 4,'4º ANO', 5,'5º ANO', 6,'1º PERIODO', 7,'2º PERIODO',8,'3º PERIODO',
                                                            9,'4º PERIODO', 10,'5º PERIODO', 11,'6º PERIODO', 12,'7º PERIODO', 13,'8º PERIODO', 14,'9º PERIODO', 15,'10º PERIODO') TX_PERIODO,
                            SUBSTR(T.TX_TIPO_VAGA_ESTAGIO, 0, (CASE WHEN INSTR(T.TX_TIPO_VAGA_ESTAGIO, ' ') <> 0 THEN INSTR(T.TX_TIPO_VAGA_ESTAGIO, ' ') - 1 ELSE LENGTH(T.TX_TIPO_VAGA_ESTAGIO) END)) TX_NIVEL,
                            A.TX_TCE,
                            V_FUNCIONARIO_TOTAL.TX_FUNCIONARIO TX_FUNCIONARIO_CADASTRO,
                            V_FUNCIONARIO_TOTAL1.TX_FUNCIONARIO TX_FUNCIONARIO_ALTERACAO,
                            E.TX_AGENCIA_ESTAGIO,
                            A.TX_CODIGO TX_CODIGO_CONTRATO,
                            V_FUNCIONARIO_TOTAL3.TX_FUNCIONARIO TX_AGENTE_SETORIAL,
                            ST.TX_CODIGO  TX_CODIGO_SOLICITACAO,
                            TO_CHAR(ST.DT_CADASTRO,'DD/MM/YYYY HH24:MI:SS') DT_CADASTRO,
                            TO_CHAR(ST.DT_ATUALIZACAO,'DD/MM/YYYY HH24:MI:SS') DT_ATUALIZACAO,
                            ST.TX_FONE_AGENTE,
                            ST.TX_CARGO_AGENTE,
                            ST.TX_EMAIL_AGENTE,
                            TO_CHAR(ST.DT_INICIO_PRORROGACAO,'DD/MM/YYYY') DT_INICIO_PRORROGACAO,
                            TO_CHAR(ST.DT_FIM_PRORROGACAO,'DD/MM/YYYY') DT_FIM_PRORROGACAO,
                            TO_CHAR(ST.DT_INICIO_RECESSO,'DD/MM/YYYY') DT_INICIO_RECESSO,
                            TO_CHAR(ST.DT_FIM_RECESSO,'DD/MM/YYYY') DT_FIM_RECESSO,
                            TO_CHAR(ST.DT_INICIO_JORNADA,'DD/MM/YYYY')DT_INICIO_JORNADA,
                            ST.TX_HORAS_JORNADA,
                            ST.TX_INICIO_HORARIO,
                            ST.TX_FIM_HORARIO,
                            ST.NB_VALOR_BOLSA,
                            TO_CHAR(ST.DT_INICIO_PAG_BOLSA,'DD/MM/YYYY') DT_INICIO_PAG_BOLSA,
                            ST.CS_SITUACAO,
                            ST.TX_MOTIVO_SITUACAO,
                            ST.TX_OUTRAS_ALTERACOES,
                            ST.ID_USUARIO_ATUALIZACAO,
                            ST.ID_CONTRATO,
                            ST.ID_USUARIO_CADASTRO,
                            ST.ID_AGENCIA_ESTAGIO,
                            ST.ID_ORGAO_ESTAGIO,
                            ST.ID_ORGAO_GESTOR_ESTAGIO,
                            ST.ID_SETORIAL_ESTAGIO,
                             DECODE(ST.CS_SITUACAO, 1,'ABERTA', 2,'FECHADA') TX_SITUACAO
                       FROM SOLICITACAO_TA ST,
                            CONTRATO_ESTAGIO A,
                            ORGAO_GESTOR_ESTAGIO B,
                            ORGAO_ESTAGIO C,
                            V_ESTAGIARIO D,
                            AGENCIA_ESTAGIO E,
                            SELECAO_ESTAGIO F,
                            TIPO_VAGA_ESTAGIO T,
                            INSTITUICAO_ENSINO I,
                            CURSO_ESTAGIO CE,
                            USUARIO USUARIO,
                            USUARIO USUARIO1,
                            V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL,
                            V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL1,
                            RESPONSAVEL_UNID_ORG RESP,
                            V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL2,
                            V_UNIDADE_ORG,
                            USUARIO USUARIO3,
                            V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL3,
                            AGENTE_SETORIAL_ESTAGIO AG
                      WHERE ST.ID_CONTRATO = A.ID_CONTRATO
                            AND A.ID_AGENCIA_ESTAGIO            = E.ID_AGENCIA_ESTAGIO
                            AND ST.ID_ORGAO_GESTOR_ESTAGIO       = B.ID_ORGAO_GESTOR_ESTAGIO
                            AND ST.ID_ORGAO_ESTAGIO              = C.ID_ORGAO_ESTAGIO
                            AND A.ID_PESSOA_ESTAGIARIO          = D.ID_PESSOA_ESTAGIARIO
                            AND F.ID_SELECAO_ESTAGIO(+)         = A.ID_SELECAO_ESTAGIO
                            AND A.CS_TIPO_VAGA_ESTAGIO          = T.CS_TIPO_VAGA_ESTAGIO
                            AND A.ID_INSTITUICAO_ENSINO         = I.ID_INSTITUICAO_ENSINO
                            AND A.ID_CURSO_ESTAGIO              = CE.ID_CURSO_ESTAGIO
                            AND ST.ID_USUARIO_CADASTRO           = USUARIO.ID_USUARIO
                            AND ST.ID_USUARIO_ATUALIZACAO        = USUARIO1.ID_USUARIO
                            AND USUARIO1.ID_UNIDADE_GESTORA     = V_FUNCIONARIO_TOTAL1.ID_UNIDADE_GESTORA
                            AND USUARIO1.ID_PESSOA_FUNCIONARIO  = V_FUNCIONARIO_TOTAL1.ID_PESSOA_FUNCIONARIO
                            AND USUARIO.ID_PESSOA_FUNCIONARIO   = V_FUNCIONARIO_TOTAL.ID_PESSOA_FUNCIONARIO
                            AND USUARIO.ID_UNIDADE_GESTORA      = V_FUNCIONARIO_TOTAL.ID_UNIDADE_GESTORA
                            AND B.ID_UNIDADE_ORG                = RESP.ID_UNIDADE_ORG(+)
                            AND RESP.ID_PESSOA_FUNCIONARIO      = V_FUNCIONARIO_TOTAL2.ID_PESSOA_FUNCIONARIO(+)
                            AND RESP.ID_UNIDADE_GESTORA         = V_FUNCIONARIO_TOTAL2.ID_UNIDADE_GESTORA(+)
                            AND V_UNIDADE_ORG.ID_UNIDADE_ORG    = C.ID_UNIDADE_ORG
                            AND ST.ID_SETORIAL_ESTAGIO           = AG.ID_SETORIAL_ESTAGIO
                            AND AG.ID_USUARIO                   = USUARIO3.ID_USUARIO
                            AND USUARIO3.ID_PESSOA_FUNCIONARIO  = V_FUNCIONARIO_TOTAL3.ID_PESSOA_FUNCIONARIO
                            AND USUARIO3.ID_UNIDADE_GESTORA     = V_FUNCIONARIO_TOTAL3.ID_UNIDADE_GESTORA
                            AND ST.ID_ORGAO_ESTAGIO = " . $codigoOrgaoSolicitante[0] . "
                            AND ST.ID_ORGAO_GESTOR_ESTAGIO = " . $codigoOrgaoGestor[0] . "
                         ";

        // $VO->ID_ORGAO_GESTOR_ESTAGIO ? $query .= "  AND ST.ID_ORGAO_GESTOR_ESTAGIO = ".$VO->ID_ORGAO_GESTOR_ESTAGIO." " : false;
        //$VO->ID_ORGAO_ESTAGIO ? $query .= "  AND ST.ID_ORGAO_ESTAGIO = ".$VO->ID_ORGAO_ESTAGIO." " : false;
        $VO->ID_AGENCIA_ESTAGIO ? $query .= " AND  ST.ID_AGENCIA_ESTAGIO = " . $VO->ID_AGENCIA_ESTAGIO . " " : false;
        $VO->TX_CODIGO_CONTRATO ? $query .= " AND UPPER(TX_CODIGO_CONTRATO) LIKE '%" . $VO->TX_CODIGO_CONTRATO . "%' " : false;
        $VO->TX_NOME ? $query .= " AND UPPER(TX_NOME) LIKE '%" . $VO->TX_NOME . "%' " : false;
        $VO->NB_CPF ? $query .= " AND NB_CPF = '" . $VO->NB_CPF . "' " : false;
        $VO->TX_CODIGO_SOLICITACAO ? $query .= " AND UPPER(TX_CODIGO_SOLICITACAO) LIKE '%" . $VO->TX_CODIGO_SOLICITACAO . "%' " : false;

        $query .=" ORDER BY TX_CODIGO_SOLICITACAO";



        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

//----------------------
//----------------pesquisa MASTER -----------------------
    function pesquisar($VO) {

        $codigoOrgaoSolicitante = explode('_', $VO->ID_ORGAO_ESTAGIO);

        $codigoOrgaoGestor = explode('_', $VO->ID_ORGAO_GESTOR_ESTAGIO);

        $codigoContrato = explode('_', $VO->ID_CONTRATO);

        $query = "SELECT ST.ID_SOLICITACAO_TA,
                        B.ID_ORGAO_GESTOR_ESTAGIO ||'_'|| B.ID_UNIDADE_ORG ID_ORGAO_GESTOR_ESTAGIO,
                        C.ID_ORGAO_ESTAGIO || '_' || V_UNIDADE_ORG.NB_COD_UNIDADE ID_ORGAO_ESTAGIO,
                        ST.ID_CONTRATO ||'_'|| ST.ID_AGENCIA_ESTAGIO CODIGO,
                        D.TX_NOME,
                        D.NB_CPF,
                        T.TX_TIPO_VAGA_ESTAGIO,
                        I.TX_INSTITUICAO_ENSINO,
                        CE.TX_CURSO_ESTAGIO,
                        B.TX_ORGAO_GESTOR_ESTAGIO,
                        C.TX_ORGAO_ESTAGIO,
                        V_FUNCIONARIO_TOTAL2.TX_FUNCIONARIO SECRETARIO,
                        DECODE(A.CS_PERIODO, 1,'1º ANO', 2,'2º ANO', 3,'3º ANO', 4,'4º ANO', 5,'5º ANO', 6,'1º PERIODO', 7,'2º PERIODO',8,'3º PERIODO',
                                                        9,'4º PERIODO', 10,'5º PERIODO', 11,'6º PERIODO', 12,'7º PERIODO', 13,'8º PERIODO', 14,'9º PERIODO', 15,'10º PERIODO') TX_PERIODO,
                        /*SUBSTR(T.TX_TIPO_VAGA_ESTAGIO, 0, (CASE WHEN INSTR(T.TX_TIPO_VAGA_ESTAGIO, ' ') <> 0 THEN INSTR(T.TX_TIPO_VAGA_ESTAGIO, ' ') - 1 ELSE LENGTH(T.TX_TIPO_VAGA_ESTAGIO) END)) TX_NIVEL,*/
                        A.TX_TCE,
                        V_FUNCIONARIO_TOTAL.TX_FUNCIONARIO TX_FUNCIONARIO_CADASTRO,
                        V_FUNCIONARIO_TOTAL1.TX_FUNCIONARIO TX_FUNCIONARIO_ALTERACAO,
                        E.TX_AGENCIA_ESTAGIO,
                        A.TX_CODIGO TX_CODIGO_CONTRATO,
                        V_FUNCIONARIO_TOTAL3.TX_FUNCIONARIO TX_AGENTE_SETORIAL,
                        ST.TX_CODIGO TX_CODIGO_SOLICITACAO,
                        TO_CHAR(ST.DT_CADASTRO,'DD/MM/YYYY HH24:MI:SS') DT_CADASTRO,
                        TO_CHAR(ST.DT_ATUALIZACAO,'DD/MM/YYYY HH24:MI:SS') DT_ATUALIZACAO,
                        ST.TX_FONE_AGENTE,
                        ST.TX_CARGO_AGENTE,
                        ST.TX_EMAIL_AGENTE,
                        TO_CHAR(ST.DT_INICIO_PRORROGACAO,'DD/MM/YYYY') DT_INICIO_PRORROGACAO,
                        TO_CHAR(ST.DT_FIM_PRORROGACAO,'DD/MM/YYYY') DT_FIM_PRORROGACAO,
                        TO_CHAR(ST.DT_INICIO_RECESSO,'DD/MM/YYYY') DT_INICIO_RECESSO,
                        TO_CHAR(ST.DT_FIM_RECESSO,'DD/MM/YYYY') DT_FIM_RECESSO,
                        TO_CHAR(ST.DT_INICIO_JORNADA,'DD/MM/YYYY')DT_INICIO_JORNADA,
                        ST.TX_HORAS_JORNADA,
                        ST.TX_INICIO_HORARIO,
                        ST.TX_FIM_HORARIO,
                        ST.NB_VALOR_BOLSA,
                        TO_CHAR(ST.DT_INICIO_PAG_BOLSA,'DD/MM/YYYY') DT_INICIO_PAG_BOLSA,
                        DECODE(ST.CS_SITUACAO, 1,'ABERTA', 2,'FECHADA') TX_SITUACAO,
                        ST.TX_MOTIVO_SITUACAO,
                        ST.TX_OUTRAS_ALTERACOES,
                        ST.ID_USUARIO_ATUALIZACAO,
                        ST.ID_ORGAO_ESTAGIO,
                        ST.ID_USUARIO_CADASTRO,

                        ST.ID_ORGAO_ESTAGIO,
                        ST.ID_ORGAO_GESTOR_ESTAGIO,
                        ST.ID_SETORIAL_ESTAGIO,
                        ST.CS_SITUACAO
                   FROM SOLICITACAO_TA ST,
                        CONTRATO_ESTAGIO A,
                        ORGAO_GESTOR_ESTAGIO B,
                        ORGAO_ESTAGIO C,
                        V_ESTAGIARIO D,
                        AGENCIA_ESTAGIO E,
                        SELECAO_ESTAGIO F,
                        TIPO_VAGA_ESTAGIO T,
                        INSTITUICAO_ENSINO I,
                        CURSO_ESTAGIO CE,
                        USUARIO USUARIO,
                        USUARIO USUARIO1,
                        V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL,
                        V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL1,
                        RESPONSAVEL_UNID_ORG RESP,
                        V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL2,
                        V_UNIDADE_ORG,
                        USUARIO USUARIO3,
                        V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL3,
                        AGENTE_SETORIAL_ESTAGIO AG
                  WHERE ST.ID_CONTRATO = A.ID_CONTRATO
                        AND A.ID_AGENCIA_ESTAGIO            = E.ID_AGENCIA_ESTAGIO
                        AND ST.ID_ORGAO_GESTOR_ESTAGIO       = B.ID_ORGAO_GESTOR_ESTAGIO
                        AND ST.ID_ORGAO_ESTAGIO              = C.ID_ORGAO_ESTAGIO
                        AND A.ID_PESSOA_ESTAGIARIO          = D.ID_PESSOA_ESTAGIARIO
                        AND F.ID_SELECAO_ESTAGIO(+)         = A.ID_SELECAO_ESTAGIO
                        AND A.CS_TIPO_VAGA_ESTAGIO          = T.CS_TIPO_VAGA_ESTAGIO
                        AND A.ID_INSTITUICAO_ENSINO         = I.ID_INSTITUICAO_ENSINO
                        AND A.ID_CURSO_ESTAGIO              = CE.ID_CURSO_ESTAGIO
                        AND ST.ID_USUARIO_CADASTRO           = USUARIO.ID_USUARIO
                        AND ST.ID_USUARIO_ATUALIZACAO        = USUARIO1.ID_USUARIO
                        AND USUARIO1.ID_UNIDADE_GESTORA     = V_FUNCIONARIO_TOTAL1.ID_UNIDADE_GESTORA
                        AND USUARIO1.ID_PESSOA_FUNCIONARIO  = V_FUNCIONARIO_TOTAL1.ID_PESSOA_FUNCIONARIO
                        AND USUARIO.ID_PESSOA_FUNCIONARIO   = V_FUNCIONARIO_TOTAL.ID_PESSOA_FUNCIONARIO
                        AND USUARIO.ID_UNIDADE_GESTORA      = V_FUNCIONARIO_TOTAL.ID_UNIDADE_GESTORA
                        AND B.ID_UNIDADE_ORG                = RESP.ID_UNIDADE_ORG(+)
                        AND RESP.ID_PESSOA_FUNCIONARIO      = V_FUNCIONARIO_TOTAL2.ID_PESSOA_FUNCIONARIO(+)
                        AND RESP.ID_UNIDADE_GESTORA         = V_FUNCIONARIO_TOTAL2.ID_UNIDADE_GESTORA(+)
                        AND V_UNIDADE_ORG.ID_UNIDADE_ORG    = C.ID_UNIDADE_ORG
                        AND ST.ID_SETORIAL_ESTAGIO           = AG.ID_SETORIAL_ESTAGIO
                        AND AG.ID_USUARIO                   = USUARIO3.ID_USUARIO
                        AND USUARIO3.ID_PESSOA_FUNCIONARIO  = V_FUNCIONARIO_TOTAL3.ID_PESSOA_FUNCIONARIO
                        AND USUARIO3.ID_UNIDADE_GESTORA     = V_FUNCIONARIO_TOTAL3.ID_UNIDADE_GESTORA
                        AND ST.ID_SOLICITACAO_TA         = " . $_SESSION['ID_SOLICITACAO_TA'];

        return $this->sqlVetor($query);
    }

//-----------inserir------------------------------------------------
    function inserir($VO) {


        $codigoOrgaoSolicitante = explode('_', $VO->ID_ORGAO_ESTAGIO);

        $codigoOrgaoGestor = explode('_', $VO->ID_ORGAO_GESTOR_ESTAGIO);

        $codigoContrato = explode('_', $VO->ID_CONTRATO);

        $codigoAgencia = explode('_', $VO->ID_AGENCIA_ESTAGIO);

        $queryPK = "select SEMAD.F_G_PK_SOLICITACAO_TA() as ID_SOLICITACAO_TA from DUAL";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "INSERT
                    INTO SOLICITACAO_TA(
                    ID_SOLICITACAO_TA,
                    TX_CODIGO,
                    DT_CADASTRO,
                    DT_ATUALIZACAO,
                    TX_FONE_AGENTE,
                    TX_CARGO_AGENTE,
                    TX_EMAIL_AGENTE,
                    DT_INICIO_PRORROGACAO,
                    DT_FIM_PRORROGACAO,
                    DT_INICIO_RECESSO,
                    DT_FIM_RECESSO,
                    DT_INICIO_JORNADA,
                    TX_HORAS_JORNADA,
                    TX_INICIO_HORARIO,
                    TX_FIM_HORARIO,
                    NB_VALOR_BOLSA,
                    DT_INICIO_PAG_BOLSA,
                    ID_USUARIO_ATUALIZACAO,
                    ID_CONTRATO,
                    ID_USUARIO_CADASTRO,
                    ID_AGENCIA_ESTAGIO,
                    ID_ORGAO_ESTAGIO,
                    ID_ORGAO_GESTOR_ESTAGIO,
                    ID_SETORIAL_ESTAGIO,
                    CS_SITUACAO,
                    TX_MOTIVO_SITUACAO,
                    TX_OUTRAS_ALTERACOES)
            VALUES(
                  '" . $CodigoPK['ID_SOLICITACAO_TA'][0] . "',
                     SEMAD.F_G_COD_SOLICITACAO_TA(),
                     SYSDATE,
                     SYSDATE,
                  '" . $VO->TX_FONE_AGENTE . "',
                  '" . $VO->TX_CARGO_AGENTE . "',
                  '" . $VO->TX_EMAIL_AGENTE . "',
                  TO_DATE('" . $VO->DT_INICIO_PRORROGACAO . "','DD/MM/YYYY'),
                  TO_DATE('" . $VO->DT_FIM_PRORROGACAO . "','DD/MM/YYYY'),
                  TO_DATE('" . $VO->DT_INICIO_RECESSO . "','DD/MM/YYYY'),
                  TO_DATE('" . $VO->DT_FIM_RECESSO . "','DD/MM/YYYY'),
                  TO_DATE('" . $VO->DT_INICIO_JORNADA . "','DD/MM/YYYY'),
                  '" . $VO->TX_HORAS_JORNADA . "',
                  '" . $VO->TX_INICIO_HORARIO . "',
                  '" . $VO->TX_FIM_HORARIO . "',
                  '" . $VO->NB_VALOR_BOLSA . "',
                  TO_DATE('" . $VO->DT_INICIO_PAG_BOLSA . "','DD/MM/YYYY'),
                  '" . $_SESSION['ID_USUARIO'] . "',
                 '" . $codigoContrato[0] . "',
                  '" . $_SESSION['ID_USUARIO'] . "',
                  '" . $codigoAgencia[0] . "',
                  '" . $codigoOrgaoSolicitante[0] . "',
                  '" . $codigoOrgaoGestor[0] . "',
                  '" . $VO->ID_SETORIAL_ESTAGIO . "',
                  1,
                  '" . $VO->TX_MOTIVO_SITUACAO . "',
                  '" . $VO->TX_OUTRAS_ALTERACOES . "') ";


        $retorno = $this->sql($query);

        if (!$retorno)
            return $CodigoPK['ID_SOLICITACAO_TA'][0];
    }

//-------------------alterar-----------------------------------------------------
    function alterar($VO) {
        $query = "UPDATE SOLICITACAO_TA SET
                 DT_INICIO_PRORROGACAO  = TO_DATE('" . $VO->DT_INICIO_PRORROGACAO . "','DD/MM/YYYY'),
                 DT_FIM_PRORROGACAO     = TO_DATE('" . $VO->DT_FIM_PRORROGACAO . "','DD/MM/YYYY'),
                 DT_INICIO_RECESSO      = TO_DATE('" . $VO->DT_INICIO_RECESSO . "','DD/MM/YYYY'),
                 DT_FIM_RECESSO         = TO_DATE('" . $VO->DT_FIM_RECESSO . "','DD/MM/YYYY'),
                 DT_INICIO_JORNADA      = TO_DATE('" . $VO->DT_INICIO_JORNADA . "','DD/MM/YYYY'),
                 DT_INICIO_PAG_BOLSA    = TO_DATE('" . $VO->DT_INICIO_PAG_BOLSA . "','DD/MM/YYYY'),
                 TX_HORAS_JORNADA       = '" . $VO->TX_HORAS_JORNADA . "',
                 TX_INICIO_HORARIO      = '" . $VO->TX_INICIO_HORARIO . "',
                 TX_FIM_HORARIO         = '" . $VO->TX_FIM_HORARIO . "',
                 NB_VALOR_BOLSA         = '" . $VO->NB_VALOR_BOLSA . "',
                 TX_MOTIVO_SITUACAO     = '" . $VO->TX_MOTIVO_SITUACAO . "',
                 TX_OUTRAS_ALTERACOES   = '" . $VO->TX_OUTRAS_ALTERACOES . "',
                 DT_ATUALIZACAO         = SYSDATE,
                 ID_USUARIO_ATUALIZACAO =" . $_SESSION['ID_USUARIO'] . "
                 ";

        $VO->CS_SITUACAO ? $query .= " ,CS_SITUACAO = '" . $VO->CS_SITUACAO . "' " : false;
        $query .= " WHERE ID_SOLICITACAO_TA = " . $VO->ID_SOLICITACAO_TA . "  ";

        return $this->sql($query);
    }

//------------------------------------------
    function excluir($VO) {
        $query = "DELETE FROM SOLICITACAO_TA
              WHERE ID_SOLICITACAO_TA = " . $VO->ID_SOLICITACAO_TA . " ";

        return $this->sql($query);
    }

//-----------------buscarDadosContrato----------------------

    function buscarDadosContrato($VO) {
        $codigoOrgaoSolicitante = explode('_', $VO->ID_ORGAO_ESTAGIO);

        $codigoOrgaoGestor = explode('_', $VO->ID_ORGAO_GESTOR_ESTAGIO);

        $codigoContrato = explode('_', $VO->ID_AGENCIA_ESTAGIO);
        $query = "SELECT
                  A.ID_CONTRATO CODIGO,
                  A.ID_CONTRATO,
                  D.TX_NOME || '_' ||
                  D.NB_CPF || '_' ||
                  T.TX_TIPO_VAGA_ESTAGIO || '_' ||
                  I.TX_INSTITUICAO_ENSINO || '_' ||
                  CE.TX_CURSO_ESTAGIO || '_' ||
            DECODE(A.CS_PERIODO, 1,'1º Ano', 2,'2º Ano',
                                 3,'3º Ano', 4,'4º Ano',
                                 5,'5º Ano', 6,'1º Periodo',
                                 7,'2º Periodo',8,'3º Periodo',
                                 9,'4º Periodo', 10,'5º Periodo',
                                 11,'6º Periodo', 12,'7º Periodo',
                                 13,'8º Periodo', 14,'9º Periodo', 15,'10º Periodo')
              || '_' || A.TX_TCE || '_' || E.TX_AGENCIA_ESTAGIO TUDO
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
                  AND F.ID_SELECAO_ESTAGIO(+)   = A.ID_SELECAO_ESTAGIO
                  AND A.CS_TIPO_VAGA_ESTAGIO    = T.CS_TIPO_VAGA_ESTAGIO
                  AND A.ID_INSTITUICAO_ENSINO   = I.ID_INSTITUICAO_ENSINO
                  AND A.ID_CURSO_ESTAGIO        = CE.ID_CURSO_ESTAGIO
                 ";

        $VO->ID_CONTRATO ? $query .= " AND ID_CONTRATO = " . $VO->ID_CONTRATO . " " : false;

        return $this->sqlVetor($query);
    }

//----------------------------------------
    function atualizarInf($VO) {

        $query = "UPDATE SOLICITACAO_TA SET
              DT_ATUALIZACAO = SYSDATE,
              ID_USUARIO_ATUALIZACAO = " . $_SESSION['ID_USUARIO'];
        $VO->EFETIVAR ? $query .= " ,CS_SITUACAO = 2 " : false;
        $query .= "WHERE ID_SOLICITACAO_TA = " . $_SESSION['ID_SOLICITACAO_TA'];

        $this->sql($query);

        $data = "SELECT TO_CHAR(SOLICITACAO_TA.DT_ATUALIZACAO,'DD/MM/YYYY HH24:MI:SS') DT_ATUALIZACAO,
                   V_FUNCIONARIO_TOTAL.TX_FUNCIONARIO TX_FUNCIONARIO_ALT,
                   DECODE(SOLICITACAO_TA.CS_SITUACAO,1,'ABERTA',2,'FECHADA') TX_SITUACAO
                   FROM SEMAD.SOLICITACAO_TA, SEMAD.USUARIO,SEMAD.V_FUNCIONARIO_TOTAL
                   WHERE USUARIO.ID_USUARIO                           = SOLICITACAO_TA.ID_USUARIO_ATUALIZACAO
                   AND USUARIO.ID_PESSOA_FUNCIONARIO                  = V_FUNCIONARIO_TOTAL.ID_PESSOA_FUNCIONARIO
                   AND USUARIO.ID_UNIDADE_GESTORA                     = V_FUNCIONARIO_TOTAL.ID_UNIDADE_GESTORA
                   AND ID_SOLICITACAO_TA = " . $_SESSION['ID_SOLICITACAO_TA'];

        $this->sqlVetor($data);
        $datahora = $this->getVetor();

        return $datahora;
    }

}

?>