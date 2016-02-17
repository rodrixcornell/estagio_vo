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
            SELECT
                C.ID_ORGAO_ESTAGIO CODIGO,
                C.TX_ORGAO_ESTAGIO,
                C.ID_UNIDADE_ORG,
                D.TX_UNIDADE_ORG || ' - ' || D.TX_SIGLA_UNIDADE AS TX_UNIDADE_ORG
              FROM
                AGENTE_SETORIAL_ESTAGIO A,
                ORGAO_AGENTE_SETORIAL B,
                ORGAO_ESTAGIO C,
                UNIDADE_ORG D
              WHERE
                A.ID_SETORIAL_ESTAGIO = B.ID_SETORIAL_ESTAGIO
              AND B.ID_ORGAO_ESTAGIO  = C.ID_ORGAO_ESTAGIO
              AND C.ID_UNIDADE_ORG    = D.ID_UNIDADE_ORG
              AND A.ID_USUARIO = '" . $_SESSION['ID_USUARIO'] . "'
              ORDER BY C.TX_ORGAO_ESTAGIO";

        return $this->sqlVetor($query);
    }

    function buscarOfertaVaga($VO) {
        $query = "
            select ov.ID_OFERTA_VAGA CODIGO, ov.TX_CODIGO_OFERTA_VAGA
               from OFERTA_VAGA ov
              where ov.ID_ORGAO_ESTAGIO = '" . $VO->ID_ORGAO_ESTAGIO . "'
              AND OV.ID_OFERTA_VAGA NOT IN
                  (
                    SELECT ID_OFERTA_VAGA FROM SELECAO_ESTAGIO
                    where ID_OFERTA_VAGA is not null
                  )
              order by ov.TX_CODIGO_OFERTA_VAGA desc";
        print_r($query);
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
                    c.TX_ORGAO_GESTOR_ESTAGIO, d.TX_ORGAO_ESTAGIO, b.TX_CODIGO_OFERTA_VAGA, e.TX_CODIGO
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
                    e.TX_CODIGO, a.CS_SITUACAO, a.CS_SELECAO, b.NB_QUANTIDADE,
                    a.CS_SITUACAO,
                    a.CS_SELECAO,
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

    function verficarGestor($VO) {

        $query = "
            SELECT
                GU.ID_USUARIO,
                GU.ID_GRUPO,
                U.TX_LOGIN,
                P.TX_NOME
              FROM
                GRUPO_USUARIO GU,
                USUARIO U,
                PESSOA P
              WHERE GU.ID_USUARIO = U.ID_USUARIO
              AND U.ID_PESSOA_FUNCIONARIO = P.ID_PESSOA
              AND GU.ID_GRUPO = 458
              AND GU.ID_USUARIO = ".$_SESSION['ID_USUARIO']."
              ORDER BY
                U.TX_LOGIN,
                P.TX_NOME";

        return $this->sqlVetor($query);
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

    function buscarCandidatoVaga($VO) {

        $query = "
            SELECT
                A.ID_PESSOA_ESTAGIARIO,
                A.CS_SITUACAO,
                TRIM(A.TX_MOTIVO_SITUACAO) TX_MOTIVO_SITUACAO,
                TRIM(UPPER(B.TX_NOME)) TX_NOME,
                B.NB_CPF,
                C.CS_SITUACAO CS_SITUACAO_SELECAO
              FROM
                ESTAGIARIO_SELECAO A,
                SELECAO_ESTAGIO C,
                V_ESTAGIARIO B
              WHERE
                A.ID_PESSOA_ESTAGIARIO = B.ID_PESSOA_ESTAGIARIO
              AND A.ID_SELECAO_ESTAGIO = C.ID_SELECAO_ESTAGIO
              AND A.ID_SELECAO_ESTAGIO = '" . $VO->ID_SELECAO_ESTAGIO . "'
              ORDER BY CS_SITUACAO, TX_NOME
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
            select to_char(a.DT_ATUALIZACAO, 'DD/MM/YYYY hh24:mi:ss') DT_ATUALIZACAO, c.TX_FUNCIONARIO TX_FUNCIONARIO_ATUALIZACAO
               from SELECAO_ESTAGIO a, USUARIO b, V_FUNCIONARIO_USUARIO c
              where a.ID_SELECAO_ESTAGIO = '" . $VO->ID_SELECAO_ESTAGIO . "'
                and a.ID_USUARIO_ATUALIZACAO = b.ID_USUARIO
                and b.ID_PESSOA_FUNCIONARIO = c.ID_PESSOA_FUNCIONARIO
                and b.ID_UNIDADE_GESTORA = c.ID_UNIDADE_GESTORA";

        $this->sqlVetor($data);
        $datahora = $this->getVetor();

        return $datahora;
    }

    function checaCPF($VO) {

        $query = "
            SELECT P.ID_PESSOA
            FROM PESSOA P, PESSOA_FISICA PF
            WHERE P.ID_PESSOA = PF.ID_PESSOA
            AND REPLACE(REPLACE(PF.NB_CPF, '.',''),'-','') = REPLACE(REPLACE('" . $VO->NB_CPF . "','.',''),'-','')";

        return $this->sqlVetor($query);
    }

    function buscarCPF($VO) {

        $query = "
            SELECT P.ID_PESSOA, P.CS_TIPO_PESSOA, PF.CS_SEXO,
                E.ID_PESSOA_ESTAGIARIO, E.ID_PESSOA_FUNCIONARIO, E.NB_FUNCIONARIO,
                trim(upper(P.TX_NOME)) TX_NOME,
                to_char(PF.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
                replace(replace(PF.NB_RG, '.',''), '-','') NB_RG,
                replace(replace(PF.NB_CPF, '.',''), '-','') NB_CPF,
                to_char(PF.DT_NASCIMENTO, 'dd/mm/yyyy') DT_NASCIMENTO,
                replace(replace(E.TX_CEP, '.',''), '-','') TX_CEP,
                upper(E.TX_ENDERECO) TX_ENDERECO,
                replace(replace(E.NB_NUMERO, '.',''), '-','') NB_NUMERO,
                upper(E.TX_COMPLEMENTO) TX_COMPLEMENTO,
                upper(E.TX_BAIRRO) TX_BAIRRO,
                upper(E.TX_CONTATO) TX_CONTATO,
                upper(E.TX_EMAIL) TX_EMAIL,
                upper(E.TX_AGENCIA) TX_AGENCIA,
                upper(E.TX_CONTA_CORRENTE) TX_CONTA_CORRENTE
              FROM
                PESSOA P,
                PESSOA_FISICA PF,
                ESTAGIARIO E
              WHERE P.ID_PESSOA   = PF.ID_PESSOA
              AND P.ID_PESSOA = E.ID_PESSOA_ESTAGIARIO(+)
              AND REPLACE(REPLACE(PF.NB_CPF, '.', ''), '-', '') = REPLACE(REPLACE('" . $VO->NB_CPF . "','.',''),'-','')";

        return $this->sqlVetor($query);
    }

    function inserirEstagiario($VO) {

        $queryPK = "select SEMAD.F_G_PK_PESSOA() as ID_PESSOA_ESTAGIARIO from DUAL";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "
            insert
                into V_ESTAGIARIO
                    (ID_PESSOA_ESTAGIARIO, TX_NOME, CS_SEXO, NB_RG, NB_CPF, DT_NASCIMENTO, TX_CEP, TX_ENDERECO, NB_NUMERO,
                     TX_COMPLEMENTO, TX_BAIRRO, TX_CONTATO, TX_EMAIL, TX_AGENCIA, TX_CONTA_CORRENTE, DT_ATUALIZACAO, CS_TIPO_PESSOA)
                values
                    ('" . $CodigoPK['ID_PESSOA_ESTAGIARIO'][0]."',
                     trim(upper('" . $VO->TX_NOME . "')),
                     '" . $VO->CS_SEXO . "',
                     replace(replace('" . $VO->NB_RG . "','.',''),'-',''),
                     replace(replace('" . $VO->NB_CPF . "','.',''),'-',''),
                     to_date('" . $VO->DT_NASCIMENTO . "','DD/MM/YYYY'),
                     replace(replace('" . $VO->TX_CEP . "','.',''),'-',''),
                     '" . $VO->TX_ENDERECO . "',
                     replace(replace('" . $VO->NB_NUMERO . "','.',''),'-',''),
                     '" . $VO->TX_COMPLEMENTO . "',
                     '" . $VO->TX_BAIRRO . "',
                     '" . $VO->TX_CONTATO . "',
                     '" . mb_strtolower($VO->TX_EMAIL) . "',
                     replace(replace('" . $VO->TX_AGENCIA . "','.',''),'-',''),
                     replace(replace('" . $VO->TX_CONTA_CORRENTE . "','.',''),'-',''),
                     SYSDATE,
                     '0')";

        $retorno = $this->sql($query);
        return $retorno ? '' : $CodigoPK['ID_PESSOA_ESTAGIARIO'][0];
    }

    function alterarEstagiario($VO) {
        if(!$VO->ID_PESSOA_ESTAGIARIO){
            $query = "
                INSERT
                    INTO ESTAGIARIO
                        (ID_PESSOA_ESTAGIARIO)
                    values
                        ('" . $VO->ID_PESSOA . "')";

            $this->sql($query);
            $query = '';
        }

        $query = "
        	update V_ESTAGIARIO
                    set TX_NOME = trim(upper('" . $VO->TX_NOME . "')),
                        CS_SEXO = '" . $VO->CS_SEXO . "',
                        NB_RG = replace(replace('" . $VO->NB_RG . "', '.',''),'-',''),
                        NB_CPF = replace(replace('" . $VO->NB_CPF . "', '.',''),'-',''),
                        DT_NASCIMENTO = TO_DATE('" . $VO->DT_NASCIMENTO . "','DD/MM/YYYY'),
                        TX_CEP = replace(replace('" . $VO->TX_CEP . "', '.',''),'-',''),
                        TX_ENDERECO = '" . $VO->TX_ENDERECO . "',
                        NB_NUMERO = replace(replace('" . $VO->NB_NUMERO . "', '.',''),'-',''),
                        TX_COMPLEMENTO = '" . $VO->TX_COMPLEMENTO . "',
                        TX_BAIRRO = '" . $VO->TX_BAIRRO . "',
                        TX_CONTATO = '" . $VO->TX_CONTATO . "',
                        TX_EMAIL = '" . mb_strtolower($VO->TX_EMAIL) . "',
                        TX_AGENCIA = replace(replace('" . $VO->TX_AGENCIA . "', '.',''),'-',''),
                        TX_CONTA_CORRENTE = replace(replace('" . $VO->TX_CONTA_CORRENTE . "', '.',''),'-',''),
                        DT_ATUALIZACAO = SYSDATE,
                        CS_TIPO_PESSOA = '0'
                  where ID_PESSOA_ESTAGIARIO = '" . $VO->ID_PESSOA . "'";

        $retorno = $this->sql($query);
        $id['ID_PESSOA_ESTAGIARIO'][0] = $VO->ID_PESSOA;
        return $retorno ? '' : $id;
    }

    function inserirCandidato($VO) {
        $query = "
            insert
                into ESTAGIARIO_SELECAO
                    (ID_SELECAO_ESTAGIO,ID_PESSOA_ESTAGIARIO,CS_SITUACAO,ID_USUARIO_CADASTRO,ID_USUARIO_ATUALIZACAO,DT_CADASTRO,DT_ATUALIZACAO)
                values
                    ('" . $VO->ID_SELECAO_ESTAGIO . "',
                     '" . $VO->ID_PESSOA_ESTAGIARIO . "',
                     '1',
                     " . $_SESSION['ID_USUARIO'] . ",
                     " . $_SESSION['ID_USUARIO'] . ",
                     sysdate,
                     sysdate)";

        return $this->sql($query);
    }

    function excluirCandidato($VO) {

        $query = "
            delete
                from ESTAGIARIO_SELECAO
               where ID_SELECAO_ESTAGIO = " . $VO->ID_SELECAO_ESTAGIO . "
                 and ID_PESSOA_ESTAGIARIO = " . $VO->ID_PESSOA_ESTAGIARIO;

        return $this->sql($query);
    }

    function buscarCandidatoEstagiario($VO) {
        $query = "
            SELECT
                V_E.TX_NOME,
                V_E.NB_CPF,
                TRIM(V_E.TX_AGENCIA) TX_AGENCIA,
                TRIM(V_E.TX_CONTA_CORRENTE) TX_CONTA_CORRENTE,
                CE.TX_CURSO_ESTAGIO,
                IE.TX_INSTITUICAO_ENSINO
                || ' - '
                || IE.TX_SIGLA AS TX_INSTITUICAO_ENSINO,
                ES.ID_SELECAO_ESTAGIO,
                ES.ID_PESSOA_ESTAGIARIO,
                ES.CS_SITUACAO,
                TRIM(ES.TX_MOTIVO_SITUACAO) TX_MOTIVO_SITUACAO,
                ES.CS_ESCOLARIDADE,
                ES.ID_CURSO_ESTAGIO,
                TRIM(ES.NB_PERIODO_ANO) NB_PERIODO_ANO,
                ES.CS_TURNO,
                ES.ID_INSTITUICAO_ENSINO,
                ES.ID_ORGAO_ESTAGIO,
                ES.CS_TIPO_VAGA_ESTAGIO,
                TRIM(ES.TX_HORA_INICIO) TX_HORA_INICIO,
                TRIM(ES.TX_HORA_FINAL) TX_HORA_FINAL,
                ES.ID_BOLSA_ESTAGIO,
                ES.ID_PESSOA_SUPERVISOR,
                ES.CS_CARGA_HORARIA,
                TRIM(UPPER(ES.TX_ATIVIDADES)) TX_ATIVIDADES,
                TRIM(REPLACE(ES.NB_VALOR_TRANSPORTE,'.',',')) NB_VALOR_TRANSPORTE,
                TRIM(UPPER(ES.TX_LOCAL_ESTAGIO)) TX_LOCAL_ESTAGIO,
                TO_CHAR(ES.DT_INICIO, 'dd/mm/yyyy') DT_INICIO,
                TO_CHAR(ES.DT_FINAL, 'dd/mm/yyyy') DT_FINAL
              FROM
                ESTAGIARIO_SELECAO ES,
                V_ESTAGIARIO V_E,
                CURSO_ESTAGIO CE,
                INSTITUICAO_ENSINO IE
              WHERE
                ES.ID_PESSOA_ESTAGIARIO = V_E.ID_PESSOA_ESTAGIARIO
              AND ES.ID_CURSO_ESTAGIO   = CE.ID_CURSO_ESTAGIO(+)
              AND ES.ID_INSTITUICAO_ENSINO   = IE.ID_INSTITUICAO_ENSINO(+)
              AND ES.ID_SELECAO_ESTAGIO   = '" . $VO->ID_SELECAO_ESTAGIO . "'
              AND ES.ID_PESSOA_ESTAGIARIO = '" . $VO->ID_PESSOA_ESTAGIARIO."'";

        return $this->sqlVetor($query);
    }

    function buscarDadosOfertaVaga($VO) {
        $query = "
            SELECT
                SE.ID_SELECAO_ESTAGIO,
                SE.ID_OFERTA_VAGA,
                SE.ID_ORGAO_ESTAGIO,
                OV.CS_ESCOLARIDADE,
                OV.ID_CURSO_ESTAGIO,
                OV.NB_SEMESTRE,
                OV.CS_TIPO_VAGA_ESTAGIO,
                OV.TX_HORA_INICIO,
                OV.TX_HORA_FINAL,
                OV.ID_BOLSA_ESTAGIO,
                TRIM(UPPER(OV.TX_ATIVIDADES)) TX_ATIVIDADES,
                replace(OV.NB_VALOR_TRANSPORTE,'.',',') NB_VALOR_TRANSPORTE,
                TO_CHAR(SYSDATE, 'dd/mm/yyyy') DT_INICIO,
                TO_CHAR(SYSDATE+182, 'dd/mm/yyyy') DT_FINAL
              FROM
                SELECAO_ESTAGIO SE,
                OFERTA_VAGA OV
              WHERE
                SE.ID_OFERTA_VAGA = OV.ID_OFERTA_VAGA
              AND SE.ID_SELECAO_ESTAGIO   = '" . $VO->ID_SELECAO_ESTAGIO . "'";

        return $this->sqlVetor($query);
    }

    function buscarCursoEstagio($VO) {
        $query = "
            SELECT
                CE.ID_CURSO_ESTAGIO,
                CE.ID_CURSO_ESTAGIO CODIGO,
                CE.TX_CURSO_ESTAGIO,
                CE.CS_AREA_CONHECIMENTO,
                ACGE.TX_AREA_CONHECIMENTO
              FROM
                CURSO_ESTAGIO CE,
                AREA_CONHECIMENTO_GE ACGE
              WHERE
                CE.CS_AREA_CONHECIMENTO = ACGE.CS_AREA_CONHECIMENTO
              ORDER BY
                ACGE.TX_AREA_CONHECIMENTO,
                CE.TX_CURSO_ESTAGIO";

        return $this->sqlVetor($query);
    }

    function buscarTurno($VO) {
        $query = "
            SELECT
                TC.CS_TURNO_CURSO,
                TC.CS_TURNO_CURSO CODIGO,
                TC.TX_TURNO_CURSO
              FROM
                TURNO_CURSO TC
              /*ORDER BY
                TC.TX_TURNO_CURSO*/";

        return $this->sqlVetor($query);
    }

    function buscarInstituicaoEnsino($VO) {
        $query = "
            SELECT
                IE.ID_INSTITUICAO_ENSINO,
                IE.ID_INSTITUICAO_ENSINO CODIGO,
                IE.TX_SIGLA || ' - ' || IE.TX_INSTITUICAO_ENSINO AS TX_INSTITUICAO_ENSINO
              FROM
                INSTITUICAO_ENSINO IE
              ORDER BY
                IE.TX_INSTITUICAO_ENSINO";

        return $this->sqlVetor($query);
    }

    function buscarTipoVagaEstagio($VO) {
        $query = "
            SELECT
                TVE.CS_TIPO_VAGA_ESTAGIO,
                TVE.CS_TIPO_VAGA_ESTAGIO CODIGO,
                TVE.TX_TIPO_VAGA_ESTAGIO,
                TVE.ID_BOLSA_ESTAGIO
              FROM
                TIPO_VAGA_ESTAGIO TVE
              ORDER BY
                TVE.TX_TIPO_VAGA_ESTAGIO";

        return $this->sqlVetor($query);
    }

    function buscarBolsaEstagio($VO) {
        $query = "
            SELECT
                BE.ID_BOLSA_ESTAGIO,
                BE.ID_BOLSA_ESTAGIO CODIGO,
                'R$ ' || BE.NB_VALOR AS NB_VALOR,
                BE.TX_BOLSA_ESTAGIO
              FROM
                BOLSA_ESTAGIO BE
              ORDER BY
                BE.TX_BOLSA_ESTAGIO";

        return $this->sqlVetor($query);
    }

    function buscarSupervisorEstagio($VO) {
        $query = "
            SELECT
                SU.ID_PESSOA_SUPERVISOR,
                SU.ID_PESSOA_SUPERVISOR CODIGO,
                SU.ID_PESSOA_FUNCIONARIO,
                SU.ID_CONSELHO,
                SU.NB_INSCRICAO_CONSELHO,
                SU.TX_CARGO,
                SU.TX_FORMACAO,
                SU.TX_TEMPO_EXPERIENCIA,
                SU.TX_CURRICULO,
                TRIM(UPPER(SU.TX_EMAIL)) TX_EMAIL,
                TRIM(UPPER(P.TX_NOME)) TX_NOME,
                TRIM(UPPER(CP.TX_CONSELHO || ' - ' || CP.TX_SIGLA_CONSELHO)) TX_CONSELHO,
                MPE.TX_MATRICULA,
                VLPE.ORGAO TX_DEPARTAMENTO
              FROM
                SUPERVISOR_ESTAGIO SU,
                PESSOA P,
                IDENT_FUNCIONAL_PE IFPE,
                MATRICULA_PE MPE,
                V_LOTACAO_PE VLPE,
                CONSELHO_PROFISSIONAL CP
              WHERE
                SU.ID_PESSOA_SUPERVISOR    = P.ID_PESSOA
              AND SU.ID_PESSOA_FUNCIONARIO = IFPE.ID_PESSOA_FUNCIONARIO
              AND IFPE.ID_MATRICULA        = MPE.ID_MATRICULA
              AND SU.ID_CONSELHO           = CP.ID_CONSELHO
              AND IFPE.ID_UNIDADE_ORG      = VLPE.ID_LOTACAO ";

        ($VO->ID_PESSOA_SUPERVISOR) ? $query .= " AND SU.ID_PESSOA_SUPERVISOR = '".$VO->ID_PESSOA_SUPERVISOR."'" : FALSE;

        $query .= "
              ORDER BY
                P.TX_NOME";

        return $this->sqlVetor($query);
    }

    function alterarCandidatoComMotivo($VO) {
        $query = "
            UPDATE
                ESTAGIARIO_SELECAO
              SET
                CS_SITUACAO = '" . $VO->CS_SITUACAO . "',
                TX_MOTIVO_SITUACAO = TRIM('" . $VO->TX_MOTIVO_SITUACAO . "'),
                ID_USUARIO_ATUALIZACAO = '" . $_SESSION['ID_USUARIO'] . "',
                DT_ATUALIZACAO = sysdate
              WHERE
                ID_SELECAO_ESTAGIO = '" . $VO->ID_SELECAO_ESTAGIO . "'
              AND ID_PESSOA_ESTAGIARIO = '" . $VO->ID_PESSOA_ESTAGIARIO."'";

        return $this->sql($query);
    }

    function alterarCandidatoSemMotivo($VO) {
        //
        $query = "
            UPDATE
                V_ESTAGIARIO
              SET
                TX_AGENCIA = trim(replace(replace('" . $VO->TX_AGENCIA . "', '.',''),'-','')),
                TX_CONTA_CORRENTE = trim(replace(replace('" . $VO->TX_CONTA_CORRENTE . "', '.',''),'-','')),
                DT_ATUALIZACAO = SYSDATE
            WHERE ID_PESSOA_ESTAGIARIO = '" . $VO->ID_PESSOA_ESTAGIARIO . "'";

        $retorno = $this->sql($query);
        if($retorno)
            return $retorno;
        $query = "";

        //
        $query = "
            UPDATE
                ESTAGIARIO_SELECAO
              SET
                CS_SITUACAO = '" . $VO->CS_SITUACAO . "',
                TX_MOTIVO_SITUACAO = '',
                CS_ESCOLARIDADE = '" . $VO->CS_ESCOLARIDADE . "',
                ID_CURSO_ESTAGIO = '" . $VO->ID_CURSO_ESTAGIO . "',
                NB_PERIODO_ANO = TRIM('" . $VO->NB_PERIODO_ANO . "'),
                CS_TURNO = '" . $VO->CS_TURNO . "',
                ID_INSTITUICAO_ENSINO = '" . $VO->ID_INSTITUICAO_ENSINO . "',
                ID_ORGAO_ESTAGIO = '" . $VO->ID_ORGAO_ESTAGIO . "',
                CS_TIPO_VAGA_ESTAGIO = '" . $VO->CS_TIPO_VAGA_ESTAGIO . "',
                TX_HORA_INICIO = TRIM('" . $VO->TX_HORA_INICIO . "'),
                TX_HORA_FINAL = TRIM('" . $VO->TX_HORA_FINAL . "'),
                ID_BOLSA_ESTAGIO = '" . $VO->ID_BOLSA_ESTAGIO . "',
                ID_PESSOA_SUPERVISOR = '" . $VO->ID_PESSOA_SUPERVISOR . "',
                CS_CARGA_HORARIA = '" . $VO->CS_CARGA_HORARIA . "',
                ID_USUARIO_ATUALIZACAO = '" . $_SESSION['ID_USUARIO'] . "',
                DT_ATUALIZACAO = sysdate
              WHERE
                ID_SELECAO_ESTAGIO = '" . $VO->ID_SELECAO_ESTAGIO . "'
              AND ID_PESSOA_ESTAGIARIO = '" . $VO->ID_PESSOA_ESTAGIARIO."'";

        return $this->sql($query);
    }

    function efetivarSelecao($VO) {

        $query = "UPDATE SELECAO_ESTAGIO SET CS_SITUACAO = 2 WHERE ID_SELECAO_ESTAGIO = " . $VO->ID_SELECAO_ESTAGIO;

        return $this->sql($query);
    }

    function buscarSelecao($VO) {
        $query = "
            SELECT
                SE.ID_SELECAO_ESTAGIO,
                to_char(SE.DT_ATUALIZACAO, 'dd/mm/yyyy') DT_ATUALIZACAO,
                SE.TX_COD_SELECAO,
                OE.TX_ORGAO_ESTAGIO
              FROM
                SELECAO_ESTAGIO SE,
                ORGAO_ESTAGIO OE
              WHERE
                SE.ID_ORGAO_ESTAGIO = OE.ID_ORGAO_ESTAGIO
              AND SE.ID_SELECAO_ESTAGIO = ".$VO->ID_SELECAO_ESTAGIO;

        return $this->sqlVetor($query);
    }

    function buscarEmails($VO) {
        $query = "
            SELECT DISTINCT
                OGE.TX_EMAIL
              FROM
                SELECAO_ESTAGIO SE,
                ORGAO_GESTOR_EMAIL OGE
              WHERE
                SE.ID_ORGAO_GESTOR_ESTAGIO = OGE.ID_ORGAO_GESTOR_ESTAGIO
              AND SE.ID_SELECAO_ESTAGIO = ".$VO->ID_SELECAO_ESTAGIO;

        return $this->sqlVetor($query);
    }

    function encaminharSelecao($VO) {
        $query = "
            UPDATE
                SELECAO_ESTAGIO
              SET
                CS_SITUACAO = 3
              WHERE
                ID_SELECAO_ESTAGIO = " . $VO->ID_SELECAO_ESTAGIO;

        return $this->sql($query);
    }

    function autorizarSelecao($VO) {
        $query = "
            UPDATE
                ESTAGIARIO_SELECAO
              SET
                CS_SITUACAO = 5
              WHERE
                CS_SITUACAO = 2
              AND ID_SELECAO_ESTAGIO = " . $VO->ID_SELECAO_ESTAGIO;

        return $this->sql($query);
    }

    function buscarEmailAgencia($VO) {
        $query = "
            SELECT
                TX_EMAIL
              FROM
                AGENCIA_ESTAGIO
              WHERE
                ID_AGENCIA_ESTAGIO = ".$VO->ID_AGENCIA_ESTAGIO;

        return $this->sqlVetor($query);
    }

    function buscarAprovados($VO) {
        $query = "
            SELECT
                ES.ID_SELECAO_ESTAGIO, SE.TX_COD_SELECAO, OV.ID_AGENCIA_ESTAGIO, TO_CHAR(SE.DT_ATUALIZACAO, 'dd/mm/yyyy') DT_ATUALIZACAO, upper(trim(V_E.TX_NOME)) TX_NOME,
                TRANSLATE(TRIM(TO_CHAR(V_E.NB_CPF / 100, '000,000,000.00')), ',.', '.-') CPF_COM_MASCARA,
                REPLACE(REPLACE(TRIM(V_E.NB_CPF), '.', ''), '-', '') NB_CPF, UPPER(CE.TX_CURSO_ESTAGIO) TX_CURSO_ESTAGIO,
                UPPER(UO.TX_UNIDADE_ORG || ' - ' || UO.TX_SIGLA_UNIDADE) TX_UNIDADE_ORG,
                TVE.TX_TIPO_VAGA_ESTAGIO, BE.TX_BOLSA_ESTAGIO, BE.NB_VALOR,
                UPPER(IE.TX_INSTITUICAO_ENSINO || ' - ' || IE.TX_SIGLA) TX_INSTITUICAO_ENSINO,
                ES.NB_PERIODO_ANO, ES.TX_HORA_INICIO, ES.TX_HORA_FINAL, ES.CS_CARGA_HORARIA,
                TO_CHAR(ES.DT_INICIO, 'dd/mm/yyyy') DT_INICIO, TO_CHAR(ES.DT_FINAL, 'dd/mm/yyyy') DT_FINAL,
                ES.TX_ATIVIDADES, ES.TX_LOCAL_ESTAGIO, ES.NB_VALOR_TRANSPORTE,
                SUE.NB_INSCRICAO_CONSELHO, SUE.TX_CARGO, SUE.TX_FORMACAO, SUE.TX_TEMPO_EXPERIENCIA, SUE.TX_CURRICULO,
                TRIM(UPPER(SUE.TX_EMAIL)) TX_EMAIL, TRIM(UPPER(P.TX_NOME)) TX_NOME_SUPERVISOR,
                TRIM(UPPER(CP.TX_CONSELHO || ' - ' || CP.TX_SIGLA_CONSELHO)) TX_CONSELHO, MPE.TX_MATRICULA,
                VLPE.ORGAO TX_DEPARTAMENTO
              FROM
                ESTAGIARIO_SELECAO ES, SELECAO_ESTAGIO SE, OFERTA_VAGA OV, V_ESTAGIARIO V_E, CURSO_ESTAGIO CE, INSTITUICAO_ENSINO IE,
                ORGAO_ESTAGIO OE, UNIDADE_ORG UO, TIPO_VAGA_ESTAGIO TVE, BOLSA_ESTAGIO BE, SUPERVISOR_ESTAGIO SUE,
                PESSOA P, IDENT_FUNCIONAL_PE IFPE, MATRICULA_PE MPE, V_LOTACAO_PE VLPE, CONSELHO_PROFISSIONAL CP
              WHERE ES.ID_SELECAO_ESTAGIO       = SE.ID_SELECAO_ESTAGIO
              AND SE.ID_OFERTA_VAGA         = OV.ID_OFERTA_VAGA
              AND ES.ID_PESSOA_ESTAGIARIO   = V_E.ID_PESSOA_ESTAGIARIO
              AND ES.ID_CURSO_ESTAGIO       = CE.ID_CURSO_ESTAGIO
              AND ES.ID_INSTITUICAO_ENSINO  = IE.ID_INSTITUICAO_ENSINO
              AND ES.ID_ORGAO_ESTAGIO       = OE.ID_ORGAO_ESTAGIO
              AND OE.ID_UNIDADE_ORG         = UO.ID_UNIDADE_ORG
              AND ES.CS_TIPO_VAGA_ESTAGIO   = TVE.CS_TIPO_VAGA_ESTAGIO
              AND ES.ID_BOLSA_ESTAGIO       = BE.ID_BOLSA_ESTAGIO
              AND ES.ID_PESSOA_SUPERVISOR   = SUE.ID_PESSOA_SUPERVISOR
              AND SUE.ID_PESSOA_SUPERVISOR  = P.ID_PESSOA
              AND SUE.ID_PESSOA_FUNCIONARIO = IFPE.ID_PESSOA_FUNCIONARIO
              AND IFPE.ID_MATRICULA         = MPE.ID_MATRICULA
              AND SUE.ID_CONSELHO           = CP.ID_CONSELHO
              AND IFPE.ID_UNIDADE_ORG       = VLPE.ID_LOTACAO
              /*AND ES.CS_SITUACAO          = '2'*/
              AND ES.ID_SELECAO_ESTAGIO   = '".$VO->ID_SELECAO_ESTAGIO."' ";

        ($VO->ID_PESSOA_ESTAGIARIO) ? $query .= " AND ES.ID_PESSOA_ESTAGIARIO = '".$VO->ID_PESSOA_ESTAGIARIO."'" : FALSE;

        $query .= "
              ORDER BY TX_NOME";

        return $this->sqlVetor($query);
    }

    function alterarCandidatoAprovado($VO) {

        $query = "
            UPDATE
                ESTAGIARIO_SELECAO
              SET
                TX_MOTIVO_SITUACAO = '',
                TX_HORA_INICIO = TRIM('" . $VO->TX_HORA_INICIO . "'),
                TX_HORA_FINAL = TRIM('" . $VO->TX_HORA_FINAL . "'),
                CS_CARGA_HORARIA = '" . $VO->CS_CARGA_HORARIA . "',
                DT_INICIO = TO_DATE('" . $VO->DT_INICIO . "', 'dd/mm/yyyy'),
                DT_FINAL = TO_DATE('" . $VO->DT_FINAL . "', 'dd/mm/yyyy'),
                TX_ATIVIDADES = TRIM('" . $VO->TX_ATIVIDADES . "'),
                ID_BOLSA_ESTAGIO = '" . $VO->ID_BOLSA_ESTAGIO . "',
                NB_VALOR_TRANSPORTE = '". $VO->moeda($VO->NB_VALOR_TRANSPORTE) . "',
                ID_ORGAO_ESTAGIO = '" . $VO->ID_ORGAO_ESTAGIO . "',
                TX_LOCAL_ESTAGIO = TRIM('" . $VO->TX_LOCAL_ESTAGIO . "'),
                ID_PESSOA_SUPERVISOR = '" . $VO->ID_PESSOA_SUPERVISOR . "',
                ID_USUARIO_ATUALIZACAO = '" . $_SESSION['ID_USUARIO'] . "',
                DT_ATUALIZACAO = sysdate
              WHERE
                ID_SELECAO_ESTAGIO = '" . $VO->ID_SELECAO_ESTAGIO . "'
              AND ID_PESSOA_ESTAGIARIO = '" . $VO->ID_PESSOA_ESTAGIARIO."'";

        $retorno = $this->sql($query);
        return $retorno ? $retorno : FALSE;
    }

    function buscarAgencia($VO) {
        $query = "
            SELECT
                OV.ID_AGENCIA_ESTAGIO,
                SE.ID_SELECAO_ESTAGIO
              FROM
                SELECAO_ESTAGIO SE,
                OFERTA_VAGA OV
              WHERE
                SE.ID_OFERTA_VAGA = OV.ID_OFERTA_VAGA
              AND SE.ID_SELECAO_ESTAGIO = " . $VO->ID_SELECAO_ESTAGIO;

        return $this->sqlVetor($query);
    }

    function buscarAgenciaSemSelecao($VO){

        $query="SELECT 
                ID_AGENCIA_ESTAGIO,
                  ID_AGENCIA_ESTAGIO CODIGO,
                  TX_AGENCIA_ESTAGIO
                FROM 
                    AGENCIA_ESTAGIO ";
        return $this->sqlVetor($query);
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
}
?>