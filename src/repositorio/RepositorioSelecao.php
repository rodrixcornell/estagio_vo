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
                    e.TX_CODIGO, a.CS_SITUACAO, a.CS_SELECAO, b.NB_QUANTIDADE,
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

    function verficarGestor($VO) {

        $query = "
            SELECT
                GU.ID_USUARIO,
                GU.ID_GRUPO,
                U.TX_LOGIN,
                P.Tx_Nome
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
                P.Tx_Nome";

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
            select a.ID_PESSOA_ESTAGIARIO,
                    a.CS_SITUACAO,
                    a.TX_MOTIVO_SITUACAO,
                    upper(b.TX_NOME) TX_NOME,
                    b.NB_CPF
               from ESTAGIARIO_SELECAO a,
                    V_ESTAGIARIO b
              where a.ID_PESSOA_ESTAGIARIO = b.ID_PESSOA_ESTAGIARIO
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
                     '" . $VO->TX_EMAIL . "',
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
                        TX_EMAIL = '" . $VO->TX_EMAIL . "',
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
                V_E.TX_AGENCIA,
                V_E.TX_CONTA_CORRENTE,
                ES.ID_SELECAO_ESTAGIO,
                ES.ID_PESSOA_ESTAGIARIO,
                ES.CS_SITUACAO,
                ES.TX_MOTIVO_SITUACAO,
                ES.CS_ESCOLARIDADE,
                ES.ID_CURSO_ESTAGIO,
                ES.NB_PERIODO_ANO,
                ES.CS_TURNO,
                ES.ID_INSTITUICAO_ENSINO,
                ES.ID_ORGAO_ESTAGIO,
                ES.CS_TIPO_VAGA_ESTAGIO,
                ES.TX_HORA_INICIO,
                ES.TX_HORA_FINAL,
                ES.ID_BOLSA_ESTAGIO,
                ES.ID_PESSOA_SUPERVISOR
              FROM
                ESTAGIARIO_SELECAO ES,
                V_ESTAGIARIO V_E
              WHERE ES.ID_PESSOA_ESTAGIARIO = V_E.ID_PESSOA_ESTAGIARIO
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
                OV.ID_BOLSA_ESTAGIO
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
                'R$ ' || BE.NB_VALOR || ' - ' || BE.TX_BOLSA_ESTAGIO as TX_BOLSA_ESTAGIO
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
                TRIM(UPPER(P.TX_NOME)) TX_NOME,
                CP.TX_CONSELHO,
                CP.TX_SIGLA_CONSELHO
              FROM
                SUPERVISOR_ESTAGIO SU,
                CONSELHO_PROFISSIONAL CP,
                PESSOA P
              WHERE
                SU.ID_CONSELHO            = CP.ID_CONSELHO
              AND SU.ID_PESSOA_SUPERVISOR = P.ID_PESSOA ";

        ($VO->ID_PESSOA_SUPERVISOR) ? $query .= " AND SU.ID_PESSOA_SUPERVISOR = '".$VO->ID_PESSOA_SUPERVISOR."'" : FALSE;

        $query .= "
              ORDER BY
                TRIM(UPPER(P.TX_NOME))";

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
                ID_USUARIO_ATUALIZACAO = '" . $_SESSION['ID_USUARIO'] . "',
                DT_ATUALIZACAO = sysdate
              WHERE
                ID_SELECAO_ESTAGIO = '" . $VO->ID_SELECAO_ESTAGIO . "'
              AND ID_PESSOA_ESTAGIARIO = '" . $VO->ID_PESSOA_ESTAGIARIO."'";

        return $this->sql($query);
    }

    function efetivarSelecao($VO) {

        $query = "UPDATE SELECAO_ESTAGIO SET CS_SITUACAO = 2 WHERE ID_SELECAO_ESTAGIO = " . $_SESSION['ID_SELECAO_ESTAGIO'];

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