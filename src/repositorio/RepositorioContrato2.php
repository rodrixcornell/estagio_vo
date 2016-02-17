<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioContrato extends Repositorio {

    // ########################### ------------------  Repositorio do Master ---------- #################################

    function buscarCsSelecao($VO) {

        $query = "SELECT CS_SELECAO FROM CONTRATO_ESTAGIO
                where ID_CONTRATO = " . $VO->ID_CONTRATO;
        return $this->sqlVetor($query);
    }

    function pesquisar($VO) {


        $codigoOrgaoSolicitante = explode('_', $VO->ID_ORGAO_ESTAGIO);

        $codigoOrgaoGestor = explode('_', $VO->ID_ORGAO_GESTOR_ESTAGIO);

        if ($VO->CHECK_RESP == "true") {

            $query = "SELECT

                        A.ID_CONTRATO CODIGO,
                        A.ID_CONTRATO,
                        A.TX_CODIGO,
                        E.TX_AGENCIA_ESTAGIO,
                        C.TX_ORGAO_ESTAGIO,
                        B.TX_ORGAO_GESTOR_ESTAGIO,
                        D.TX_NOME,
                        D.NB_CPF,
						F.TX_COD_SELECAO,
						a.TX_TCE
                  FROM
                        CONTRATO_ESTAGIO A,
                        ORGAO_GESTOR_ESTAGIO B,
                        ORGAO_ESTAGIO C,
                        V_ESTAGIARIO D,
                        AGENCIA_ESTAGIO E ,
                        SELECAO_ESTAGIO F

                  WHERE
                        A.ID_AGENCIA_ESTAGIO=E.ID_AGENCIA_ESTAGIO
                        AND B.ID_ORGAO_GESTOR_ESTAGIO=A.ID_ORGAO_GESTOR_ESTAGIO
                        AND A.ID_ORGAO_ESTAGIO =C.ID_ORGAO_ESTAGIO
                        AND A.ID_PESSOA_ESTAGIARIO = D.ID_PESSOA_ESTAGIARIO
                        and F.ID_SELECAO_ESTAGIO = A.ID_SELECAO_ESTAGIO
						AND A.CS_SELECAO = 1
                        ";
            $VO->ID_ORGAO_ESTAGIO ? $query .= " And A.ID_ORGAO_ESTAGIO = " . $codigoOrgaoSolicitante[0] . " " : false;
            $VO->ID_ORGAO_GESTOR_ESTAGIO ? $query .= " And A.ID_ORGAO_GESTOR_ESTAGIO = " . $codigoOrgaoGestor[0] . " " : false;
            $VO->ID_SELECAO_ESTAGIO ? $query .= " And A.ID_SELECAO_ESTAGIO = " . $VO->ID_SELECAO_ESTAGIO . " " : false;
            $VO->TX_TCE ? $query .= " And upper(A.TX_TCE) like upper('%" . $VO->TX_TCE . "%') " : false;
            $VO->TX_NOME ? $query .= " And upper(D.TX_NOME) like upper('%" . $VO->TX_NOME . "%') " : false;
            $VO->NB_CPF ? $query .= " And upper(D.NB_CPF) like upper('%" . $VO->NB_CPF . "%') " : false;
        } else if ($VO->CHECK_RESP_2 == "true") {
            $query = "SELECT

                        A.ID_CONTRATO CODIGO,
                        A.ID_CONTRATO,
                        A.TX_CODIGO,
                        E.TX_AGENCIA_ESTAGIO,
                        C.TX_ORGAO_ESTAGIO,
                        B.TX_ORGAO_GESTOR_ESTAGIO,
                        D.TX_NOME,
                        D.NB_CPF,
                        a.TX_TCE
                  FROM
                        CONTRATO_ESTAGIO A,
                        ORGAO_GESTOR_ESTAGIO B,
                        ORGAO_ESTAGIO C,
                        V_ESTAGIARIO D,
                        AGENCIA_ESTAGIO E


                  WHERE
                        A.ID_AGENCIA_ESTAGIO=E.ID_AGENCIA_ESTAGIO
                        AND B.ID_ORGAO_GESTOR_ESTAGIO=A.ID_ORGAO_GESTOR_ESTAGIO
                        AND A.ID_ORGAO_ESTAGIO =C.ID_ORGAO_ESTAGIO
                        AND A.ID_PESSOA_ESTAGIARIO = D.ID_PESSOA_ESTAGIARIO
                        AND D.ID_PESSOA_ESTAGIARIO NOT IN (SELECT ID_PESSOA_ESTAGIARIO FROM estagiario_vaga)
                        ";
            $VO->ID_ORGAO_ESTAGIO ? $query .= " And A.ID_ORGAO_ESTAGIO = " . $codigoOrgaoSolicitante[0] . " " : false;
            $VO->ID_ORGAO_GESTOR_ESTAGIO ? $query .= " And A.ID_ORGAO_GESTOR_ESTAGIO = " . $codigoOrgaoGestor[0] . " " : false;
            $VO->TX_TCE ? $query .= " And upper(A.TX_TCE) like upper('%" . $VO->TX_TCE . "%') " : false;
            $VO->TX_NOME ? $query .= " And upper(D.TX_NOME) like upper('%" . $VO->TX_NOME . "%') " : false;
            $VO->NB_CPF ? $query .= " And upper(D.NB_CPF) like upper('%" . $VO->NB_CPF . "%') " : false;
        }

        return $this->sqlVetor($query);
    }

    function inserir($VO) {

        $queryPK = "select SEMAD.F_G_PK_Contrato_Estagio as ID_CONTRATO from DUAL";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();


        $codigoOrgaoSolicitante = explode('_', $VO->ID_ORGAO_ESTAGIO);

        $codigoOrgaoGestor = explode('_', $VO->ID_ORGAO_GESTOR_ESTAGIO);

        $codigoCandidato = explode('_', $VO->ID_PESSOA_ESTAGIARIO);



        $query = "INSERT INTO
                  CONTRATO_ESTAGIO
                    (
                        ID_PESSOA_ESTAGIARIO,
                        ID_CONTRATO,
                        ID_ORGAO_GESTOR_ESTAGIO,
                        ID_ORGAO_ESTAGIO,
                        ID_QUADRO_VAGAS_ESTAGIO,
                        ID_CURSO_ESTAGIO,
                        ID_PESSOA_SUPERVISOR,
                        ID_INSTITUICAO_ENSINO,
                        ID_BOLSA_ESTAGIO,
                        DT_CADASTRO,
                        DT_ATUALIZACAO,
                        DT_INICIO_VIGENCIA,
                        DT_FIM_VIGENCIA,
                        NB_INICIO_HORARIO,
                        NB_FIM_HORARIO,
                        TX_PLANO_ATIVIDADE,
                        CS_TIPO,
                        TX_TCE,
                        ID_UNIDADE_ORG,
                        ID_SELECAO_ESTAGIO,
                        ID_RECRUTAMENTO_ESTAGIO,
                        NB_VAGAS_RECRUTAMENTO,
                        NB_CANDIDATO,
                        CS_TIPO_VAGA_ESTAGIO,
                        CS_PERIODO,
                        CS_HORARIO_CURSO,
                        ID_AGENCIA_ESTAGIO,
                        TX_EMAIL,
                        TX_TELEFONE,
                        TX_ENDERECO,
                        TX_CODIGO,
                        ID_USUARIO_CADASTRO,
                        ID_USUARIO_ATUALIZACAO,
                        CS_SELECAO
                    )
                    VALUES
                    (
                        '" . $codigoCandidato[0] . "',
                        '" . $CodigoPK['ID_CONTRATO'][0] . "',
                        '" . $codigoOrgaoGestor[0] . "',
                        '" . $codigoOrgaoSolicitante[0] . "',
                        '" . $VO->ID_QUADRO_VAGAS_ESTAGIO . "',
                        '" . $VO->ID_CURSO_ESTAGIO . "',
                        '" . $VO->ID_PESSOA_SUPERVISOR . "',
                        '" . $VO->ID_INSTITUICAO_ENSINO . "',
                        '" . $VO->ID_BOLSA_ESTAGIO . "',
                        sysdate,
                        sysdate,
                        to_date('" . $VO->DT_INICIO_VIGENCIA . "','dd/mm/yyyy'),
                        to_date('" . $VO->DT_FIM_VIGENCIA . "','dd/mm/yyyy'),
                        '" . $VO->NB_INICIO_HORARIO . "',
                        '" . $VO->NB_FIM_HORARIO . "',
                        '" . $VO->TX_PLANO_ATIVIDADE . "',
                        '" . $VO->CS_TIPO . "',
                        '" . $VO->TX_TCE . "',
                        '" . $VO->ID_LOTACAO . "',
                        '" . $VO->ID_SELECAO_ESTAGIO . "',
                        '" . $codigoCandidato[3] . "',
                        '" . $codigoCandidato[2] . "',
                        '" . $codigoCandidato[1] . "',
                        '" . $VO->CS_TIPO_VAGA_ESTAGIO . "',
                        '" . $VO->CS_PERIODO . "',
                        '" . $VO->CS_HORARIO_CURSO . "',
                        '" . $VO->ID_AGENCIA_ESTAGIO . "',
                        '" . $VO->TX_EMAIL . "',
                        '" . $VO->TX_TELEFONE . "',
                        '" . $VO->TX_ENDERECO . "',
                        semad.f_g_cod_contrato_estagio(),
                        '" . $_SESSION['ID_USUARIO'] . "',
                        '" . $_SESSION['ID_USUARIO'] . "',
                        '" . $VO->CS_SELECAO . "'
                    )
                    ";
//        print_r($query);

        $retorno = $this->sql($query);
        if (!$retorno) {
            return $CodigoPK['ID_CONTRATO'][0];
        }
    }

    function buscar($VO) {

        if ($VO->CS_SELECAO == 1) {
            $query = "SELECT
                   DISTINCT
                        BOLSA_ESTAGIO.NB_VALOR,
                        QUADRO_VAGAS_estagio.TX_CODIGO TX_CODIGO_QUADRO_VAGAS,
                        contrato_estagio.cs_selecao cs_selecao,
                        V_UNIDADE_ORG_LOTACAO.ORGAO,
                        PESSOA.TX_NOME SUPERVISOR,
                        USUARIO_ATUALIZACAO_fun.TX_FUNCIONARIO FUNCIONARIO_CADASTRO,
                        USUARIO_CADASTRO_FUN.TX_FUNCIONARIO FUNCIONARIO_ATUALIZACAO,
                        FUNC.TX_FUNCIONARIO SECRETARIO,
                        FUNC.TX_FUNCIONARIO TX_FUNCIONARIO,
                        V_END_UNID_ORG.TX_ENDERECO TX_ENDERECO_ORG_GESTOR,
                        V_END_UNID_ORG.TX_ENDERECO TX_ENDERECO_SEC,
                        ORGAO_GESTOR_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO
                        ||'_'
                        ||ORGAO_GESTOR_ESTAGIO.ID_UNIDADE_ORG ID_ORGAO_GESTOR_ESTAGIO,
                        ORGAO_ESTAGIO.ID_ORGAO_ESTAGIO
                        ||'_'
                        || V_UNIDADE_ORG.NB_COD_UNIDADE ID_ORGAO_ESTAGIO,
                        V_ESTAGIARIO.ID_PESSOA_ESTAGIARIO
                        ||'_'
                        || ESTAGIARIO_VAGA.NB_CANDIDATO
                        ||'_'
                        || ESTAGIARIO_VAGA.NB_VAGAS_RECRUTAMENTO
                        ||'_'
                        || ESTAGIARIO_VAGA.ID_RECRUTAMENTO_ESTAGIO
                        ||'_'
                        || CONTRATO_ESTAGIO.CS_TIPO_VAGA_ESTAGIO
                        ||'_'
                        || TIPO_VAGA_ESTAGIO.TX_TIPO_VAGA_ESTAGIO
                        ID_PESSOA_ESTAGIARIO,
                        CONTRATO_ESTAGIO.ID_CONTRATO,
                        INSTITUICAO_ENSINO.ID_INSTITUICAO_ENSINO,
                        QUADRO_VAGAS_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO,
                        SELECAO_ESTAGIO.ID_SELECAO_ESTAGIO,
                        SELECAO_ESTAGIO.TX_COD_SELECAO,
                        CURSO_ESTAGIO.ID_CURSO_ESTAGIO,
                        SUPERVISOR_ESTAGIO.ID_PESSOA_SUPERVISOR,
                        SUPERVISOR_ESTAGIO.TX_CARGO,
                        AGENCIA_ESTAGIO.ID_AGENCIA_ESTAGIO,
                        AGENCIA_ESTAGIO.TX_AGENCIA_ESTAGIO,
                        BOLSA_ESTAGIO.ID_BOLSA_ESTAGIO,
                        TIPO_VAGA_ESTAGIO.CS_TIPO_VAGA_ESTAGIO,
                        ORGAO_GESTOR_ESTAGIO.TX_ORGAO_GESTOR_ESTAGIO,
                        ORGAO_ESTAGIO.TX_ORGAO_ESTAGIO,
                        CURSO_ESTAGIO.TX_CURSO_ESTAGIO,
                        TIPO_VAGA_ESTAGIO.TX_TIPO_VAGA_ESTAGIO,
                        AGENCIA_ESTAGIO.TX_AGENCIA_ESTAGIO,
                        INSTITUICAO_ENSINO.TX_INSTITUICAO_ENSINO,
                        QUADRO_VAGAS_ESTAGIO.TX_CODIGO TX_VAGAS,
                        V_ESTAGIARIO.TX_NOME TX_NOME_ESTAGIARIO,
                        CONTRATO_ESTAGIO.TX_TCE,
                        CONTRATO_ESTAGIO.CS_TIPO,
                        V_ESTAGIARIO.NB_RG,
                        V_ESTAGIARIO.NB_CPF,
                        contrato_estagio.NB_INICIO_HORARIO,
                        contrato_estagio.NB_FIM_HORARIO,
                        CONTRATO_ESTAGIO.TX_EMAIL,
                        CONTRATO_ESTAGIO.ID_UNIDADE_ORG ID_LOTACAO,
                        CONTRATO_ESTAGIO.ID_Quadro_vagas_estagio ID_Quadro_vagas_estagio,
                        CONTRATO_ESTAGIO.TX_TELEFONE,
                        CONTRATO_ESTAGIO.TX_ENDERECO,
                        CONTRATO_ESTAGIO.TX_CODIGO ,
                        CONTRATO_ESTAGIO.CS_PERIODO,
                        CONTRATO_ESTAGIO.CS_HORARIO_CURSO,
                        CONTRATO_ESTAGIO.TX_PLANO_ATIVIDADE,
                        TO_CHAR(CONTRATO_ESTAGIO.DT_CADASTRO,'dd/mm/yyyy') DT_CADASTRO,
                        TO_CHAR(CONTRATO_ESTAGIO.DT_ATUALIZACAO,'dd/mm/yyyy') DT_ATUALIZACAO,
                        TO_CHAR(CONTRATO_ESTAGIO.DT_DESLIGAMENTO,'dd/mm/yyyy') DT_DESLIGAMENTO,
                        TO_CHAR(CONTRATO_ESTAGIO.DT_INICIO_VIGENCIA,'dd/mm/yyyy') DT_INICIO_VIGENCIA,
                        TO_CHAR(CONTRATO_ESTAGIO.DT_FIM_VIGENCIA,'dd/mm/yyyy') DT_FIM_VIGENCIA

                    FROM
                        CONTRATO_ESTAGIO,
                        ORGAO_GESTOR_ESTAGIO,
                        CURSO_ESTAGIO,
                        INSTITUICAO_ENSINO,
                        QUADRO_VAGAS_ESTAGIO,
                        SELECAO_ESTAGIO,
                        ESTAGIARIO_SELECAO,
                        ESTAGIARIO_VAGA,
                        ORGAO_ESTAGIO,
                        V_ESTAGIARIO,
                        TIPO_VAGA_ESTAGIO,
                        SUPERVISOR_ESTAGIO,
                        AGENCIA_ESTAGIO,
                        V_UNIDADE_ORG V_UNIDADE_ORG,
                        BOLSA_ESTAGIO,
                        V_END_UNID_ORG,
                        RESPONSAVEL_UNID_ORG ,
                        V_FUNCIONARIO_TOTAL FUNC,
                        USUARIO USUARIO_CADASTRO,
                        USUARIO USUARIO_ATUALIZACAO,
                        V_FUNCIONARIO_TOTAL USUARIO_CADASTRO_FUN,
                        V_FUNCIONARIO_TOTAL USUARIO_ATUALIZACAO_fun,
                        PESSOA_FISICA ,
                        PESSOA ,
                        V_UNIDADE_ORG V_UNIDADE_ORG_LOTACAO,

                        VAGAS_RECRUTAMENTO
                    WHERE


                    VAGAS_RECRUTAMENTO.ID_RECRUTAMENTO_ESTAGIO = ESTAGIARIO_SELECAO.ID_RECRUTAMENTO_ESTAGIO
                    AND VAGAS_RECRUTAMENTO.NB_VAGAS_RECRUTAMENTO = ESTAGIARIO_SELECAO.NB_VAGAS_RECRUTAMENTO
                    AND VAGAS_RECRUTAMENTO.CS_TIPO_VAGA_ESTAGIO =TIPO_VAGA_ESTAGIO.CS_TIPO_VAGA_ESTAGIO
                    AND CONTRATO_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO = ORGAO_GESTOR_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO
                    AND CONTRATO_ESTAGIO.NB_VAGAS_RECRUTAMENTO     = ESTAGIARIO_VAGA.NB_VAGAS_RECRUTAMENTO
                    AND CONTRATO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO   = ESTAGIARIO_VAGA.ID_RECRUTAMENTO_ESTAGIO
                    AND CONTRATO_ESTAGIO.NB_CANDIDATO              = ESTAGIARIO_VAGA.NB_CANDIDATO
                    AND CURSO_ESTAGIO.ID_CURSO_ESTAGIO             = CONTRATO_ESTAGIO.ID_CURSO_ESTAGIO
                    AND CONTRATO_ESTAGIO.ID_INSTITUICAO_ENSINO     = INSTITUICAO_ENSINO.ID_INSTITUICAO_ENSINO
                    AND CONTRATO_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO   = QUADRO_VAGAS_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO
                    AND CONTRATO_ESTAGIO.ID_SELECAO_ESTAGIO        = SELECAO_ESTAGIO.ID_SELECAO_ESTAGIO
                    --AND CONTRATO_ESTAGIO.NB_VAGAS_RECRUTAMENTO          = SELECAO_ESTAGIO.ID_SELECAO_ESTAGIO
                    AND SELECAO_ESTAGIO.ID_SELECAO_ESTAGIO         = ESTAGIARIO_SELECAO.ID_SELECAO_ESTAGIO
                    AND CONTRATO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO   = ESTAGIARIO_SELECAO.ID_RECRUTAMENTO_ESTAGIO
                    AND ESTAGIARIO_SELECAO.ID_RECRUTAMENTO_ESTAGIO = ESTAGIARIO_VAGA.ID_RECRUTAMENTO_ESTAGIO
                    AND CONTRATO_ESTAGIO.ID_ORGAO_ESTAGIO          = ORGAO_ESTAGIO.ID_ORGAO_ESTAGIO
                    AND V_ESTAGIARIO.ID_PESSOA_ESTAGIARIO          = CONTRATO_ESTAGIO.ID_PESSOA_ESTAGIARIO
                    AND CONTRATO_ESTAGIO.CS_TIPO_VAGA_ESTAGIO      = TIPO_VAGA_ESTAGIO.CS_TIPO_VAGA_ESTAGIO
                    AND CONTRATO_ESTAGIO.ID_PESSOA_SUPERVISOR      = SUPERVISOR_ESTAGIO.ID_PESSOA_SUPERVISOR
                    AND CONTRATO_ESTAGIO.ID_AGENCIA_ESTAGIO        = AGENCIA_ESTAGIO.ID_AGENCIA_ESTAGIO
                    AND V_UNIDADE_ORG.ID_UNIDADE_ORG               = ORGAO_ESTAGIO.ID_UNIDADE_ORG
                    AND CONTRATO_ESTAGIO.ID_BOLSA_ESTAGIO          = BOLSA_ESTAGIO.ID_BOLSA_ESTAGIO
                    AND V_END_UNID_ORG.ID_UNIDADE_ORG              = ORGAO_GESTOR_ESTAGIO.ID_UNIDADE_ORG
                    AND RESPONSAVEL_UNID_ORG.ID_PESSOA_FUNCIONARIO = FUNC.ID_PESSOA_FUNCIONARIO
                    AND RESPONSAVEL_UNID_ORG.ID_UNIDADE_ORG        = ORGAO_GESTOR_ESTAGIO.ID_UNIDADE_ORG
                    AND USUARIO_CADASTRO.ID_USUARIO                = CONTRATO_ESTAGIO.ID_USUARIO_CADASTRO
                    AND USUARIO_CADASTRO.ID_PESSOA_FUNCIONARIO     = USUARIO_CADASTRO_FUN.ID_PESSOA_FUNCIONARIO
                    AND USUARIO_CADASTRO.ID_UNIDADE_GESTORA        = USUARIO_CADASTRO_FUN.ID_UNIDADE_GESTORA
                    AND USUARIO_ATUALIZACAO.ID_USUARIO             = CONTRATO_ESTAGIO.ID_USUARIO_CADASTRO
                    AND USUARIO_ATUALIZACAO.ID_PESSOA_FUNCIONARIO  = USUARIO_ATUALIZACAO_FUN .ID_PESSOA_FUNCIONARIO
                    AND USUARIO_ATUALIZACAO.ID_UNIDADE_GESTORA     = USUARIO_ATUALIZACAO_fun .ID_UNIDADE_GESTORA
                    AND SUPERVISOR_ESTAGIO.ID_PESSOA_SUPERVISOR    = PESSOA_FISICA.ID_PESSOA
                    AND PESSOA_FISICA.ID_PESSOA                    = PESSOA.ID_PESSOA
                    AND V_UNIDADE_ORG_LOTACAO.ID_UNIDADE_ORG       = CONTRATO_ESTAGIO.ID_UNIDADE_ORG
                        AND CONTRATO_ESTAGIO.ID_CONTRATO                    = " . $VO->ID_CONTRATO;
        } else if ($VO->CS_SELECAO == 2) {

            $query = "SELECT
                    BOLSA_ESTAGIO.NB_VALOR,
                    contrato_estagio.cs_selecao cs_selecao,
                    V_UNIDADE_ORG_LOTACAO.ORGAO,
                    PESSOA.TX_NOME SUPERVISOR,
                    USUARIO_ATUALIZACAO_fun.TX_FUNCIONARIO FUNCIONARIO_CADASTRO,
                    USUARIO_CADASTRO_FUN.TX_FUNCIONARIO FUNCIONARIO_ATUALIZACAO,
                    FUNC.TX_FUNCIONARIO SECRETARIO,
                    FUNC.TX_FUNCIONARIO TX_FUNCIONARIO,
                    V_END_UNID_ORG.TX_ENDERECO TX_ENDERECO_ORG_GESTOR,
                    V_END_UNID_ORG.TX_ENDERECO TX_ENDERECO_SEC,
                    ORGAO_GESTOR_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO
                    || '_'
                    || ORGAO_GESTOR_ESTAGIO.ID_UNIDADE_ORG ID_ORGAO_GESTOR_ESTAGIO,
                    ORGAO_ESTAGIO.ID_ORGAO_ESTAGIO
                    || '_'
                    || V_UNIDADE_ORG.NB_COD_UNIDADE ID_ORGAO_ESTAGIO,
                    CONTRATO_ESTAGIO.ID_CONTRATO,
                    INSTITUICAO_ENSINO.ID_INSTITUICAO_ENSINO,
                    CURSO_ESTAGIO.ID_CURSO_ESTAGIO,
                    SUPERVISOR_ESTAGIO.ID_PESSOA_SUPERVISOR,
                    SUPERVISOR_ESTAGIO.TX_CARGO,
                    AGENCIA_ESTAGIO.ID_AGENCIA_ESTAGIO,
                    AGENCIA_ESTAGIO.TX_AGENCIA_ESTAGIO,
                    BOLSA_ESTAGIO.ID_BOLSA_ESTAGIO,
                    TIPO_VAGA_ESTAGIO.CS_TIPO_VAGA_ESTAGIO,
                    ORGAO_GESTOR_ESTAGIO.TX_ORGAO_GESTOR_ESTAGIO,
                    ORGAO_ESTAGIO.TX_ORGAO_ESTAGIO,
                    CURSO_ESTAGIO.TX_CURSO_ESTAGIO,
                    TIPO_VAGA_ESTAGIO.TX_TIPO_VAGA_ESTAGIO,
                    AGENCIA_ESTAGIO.TX_AGENCIA_ESTAGIO,
                    INSTITUICAO_ENSINO.TX_INSTITUICAO_ENSINO,
                    QUADRO_VAGAS_ESTAGIO.TX_CODIGO TX_VAGAS,
                    V_ESTAGIARIO.TX_NOME TX_NOME_ESTAGIARIO,
                    CONTRATO_ESTAGIO.TX_TCE,
                    CONTRATO_ESTAGIO.CS_TIPO,
                    V_ESTAGIARIO.NB_RG,
                    V_ESTAGIARIO.NB_CPF,
                    CONTRATO_ESTAGIO.NB_INICIO_HORARIO,
                    CONTRATO_ESTAGIO.NB_FIM_HORARIO,
                    CONTRATO_ESTAGIO.TX_EMAIL,
                    CONTRATO_ESTAGIO.ID_UNIDADE_ORG ID_LOTACAO,
                        CONTRATO_ESTAGIO.ID_Quadro_vagas_estagio ID_Quadro_vagas_estagio_2,
                        CONTRATO_ESTAGIO.ID_PESSOA_ESTAGIARIO     ID_PESSOA_ESTAGIARIO    ,
                    CONTRATO_ESTAGIO.TX_TELEFONE,
                    CONTRATO_ESTAGIO.TX_ENDERECO,
                    CONTRATO_ESTAGIO.TX_CODIGO,
                    CONTRATO_ESTAGIO.CS_PERIODO,
                    CONTRATO_ESTAGIO.CS_HORARIO_CURSO,
                    CONTRATO_ESTAGIO.TX_PLANO_ATIVIDADE,
                    TO_CHAR(CONTRATO_ESTAGIO.DT_CADASTRO, 'dd/mm/yyyy') DT_CADASTRO,
                    TO_CHAR(CONTRATO_ESTAGIO.DT_ATUALIZACAO, 'dd/mm/yyyy') DT_ATUALIZACAO,
                    TO_CHAR(CONTRATO_ESTAGIO.DT_DESLIGAMENTO, 'dd/mm/yyyy') DT_DESLIGAMENTO,
                    TO_CHAR(CONTRATO_ESTAGIO.DT_INICIO_VIGENCIA, 'dd/mm/yyyy') DT_INICIO_VIGENCIA,
                    TO_CHAR(CONTRATO_ESTAGIO.DT_FIM_VIGENCIA, 'dd/mm/yyyy') DT_FIM_VIGENCIA
                    FROM CONTRATO_ESTAGIO,
                    ORGAO_GESTOR_ESTAGIO,
                    CURSO_ESTAGIO,
                    INSTITUICAO_ENSINO,
                    QUADRO_VAGAS_ESTAGIO,
                    ORGAO_ESTAGIO,
                    V_ESTAGIARIO,
                    TIPO_VAGA_ESTAGIO,
                    SUPERVISOR_ESTAGIO,
                    AGENCIA_ESTAGIO,
                    V_UNIDADE_ORG V_UNIDADE_ORG,
                    BOLSA_ESTAGIO,
                    V_END_UNID_ORG,
                    RESPONSAVEL_UNID_ORG,
                    V_FUNCIONARIO_TOTAL FUNC,
                    USUARIO USUARIO_CADASTRO,
                    USUARIO USUARIO_ATUALIZACAO,
                    V_FUNCIONARIO_TOTAL USUARIO_CADASTRO_FUN,
                    V_FUNCIONARIO_TOTAL USUARIO_ATUALIZACAO_fun,
                    PESSOA_FISICA,
                    PESSOA,
                    V_UNIDADE_ORG V_UNIDADE_ORG_LOTACAO
                    WHERE CONTRATO_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO = ORGAO_GESTOR_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO
                    AND CURSO_ESTAGIO.ID_CURSO_ESTAGIO             = CONTRATO_ESTAGIO.ID_CURSO_ESTAGIO
                    AND CONTRATO_ESTAGIO.ID_INSTITUICAO_ENSINO     = INSTITUICAO_ENSINO.ID_INSTITUICAO_ENSINO
                    AND CONTRATO_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO   = QUADRO_VAGAS_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO
                    AND CONTRATO_ESTAGIO.ID_ORGAO_ESTAGIO          = ORGAO_ESTAGIO.ID_ORGAO_ESTAGIO
                    AND V_ESTAGIARIO.ID_PESSOA_ESTAGIARIO          = CONTRATO_ESTAGIO.ID_PESSOA_ESTAGIARIO
                    AND CONTRATO_ESTAGIO.CS_TIPO_VAGA_ESTAGIO      = TIPO_VAGA_ESTAGIO.CS_TIPO_VAGA_ESTAGIO
                    AND CONTRATO_ESTAGIO.ID_PESSOA_SUPERVISOR      = SUPERVISOR_ESTAGIO.ID_PESSOA_SUPERVISOR
                    AND CONTRATO_ESTAGIO.ID_AGENCIA_ESTAGIO        = AGENCIA_ESTAGIO.ID_AGENCIA_ESTAGIO
                    AND V_UNIDADE_ORG.ID_UNIDADE_ORG               = ORGAO_ESTAGIO.ID_UNIDADE_ORG
                    AND CONTRATO_ESTAGIO.ID_BOLSA_ESTAGIO          = BOLSA_ESTAGIO.ID_BOLSA_ESTAGIO
                    AND V_END_UNID_ORG.ID_UNIDADE_ORG              = ORGAO_GESTOR_ESTAGIO.ID_UNIDADE_ORG
                    AND RESPONSAVEL_UNID_ORG.ID_PESSOA_FUNCIONARIO = FUNC.ID_PESSOA_FUNCIONARIO
                    AND RESPONSAVEL_UNID_ORG.ID_UNIDADE_ORG        = ORGAO_GESTOR_ESTAGIO.ID_UNIDADE_ORG
                    AND USUARIO_CADASTRO.ID_USUARIO                = CONTRATO_ESTAGIO.ID_USUARIO_CADASTRO
                    AND USUARIO_CADASTRO.ID_PESSOA_FUNCIONARIO     = USUARIO_CADASTRO_FUN.ID_PESSOA_FUNCIONARIO
                    AND USUARIO_CADASTRO.ID_UNIDADE_GESTORA        = USUARIO_CADASTRO_FUN.ID_UNIDADE_GESTORA
                    AND USUARIO_ATUALIZACAO.ID_USUARIO             = CONTRATO_ESTAGIO.ID_USUARIO_CADASTRO
                    AND USUARIO_ATUALIZACAO.ID_PESSOA_FUNCIONARIO  = USUARIO_ATUALIZACAO_fun.ID_PESSOA_FUNCIONARIO
                    AND USUARIO_ATUALIZACAO.ID_UNIDADE_GESTORA     = USUARIO_ATUALIZACAO_fun.ID_UNIDADE_GESTORA
                    AND SUPERVISOR_ESTAGIO.ID_PESSOA_SUPERVISOR    = PESSOA_FISICA.ID_PESSOA
                    AND PESSOA_FISICA.ID_PESSOA                    = PESSOA.ID_PESSOA
                    AND V_UNIDADE_ORG_LOTACAO.ID_UNIDADE_ORG       = CONTRATO_ESTAGIO.ID_UNIDADE_ORG
                    AND V_ESTAGIARIO.ID_PESSOA_ESTAGIARIO NOT IN (SELECT ID_PESSOA_ESTAGIARIO FROM estagiario_vaga)
                    AND ID_CONTRATO=" . $VO->ID_CONTRATO;
        }

        return $this->sqlVetor($query);
    }

    function alterar($VO) {
        $query = "Update
                        contrato_estagio
                  set
                        ID_QUADRO_VAGAS_ESTAGIO = '" . $VO->ID_QUADRO_VAGAS_ESTAGIO . "',
                        ID_CURSO_ESTAGIO = '" . $VO->ID_CURSO_ESTAGIO . "',
                        ID_PESSOA_SUPERVISOR = '" . $VO->ID_PESSOA_SUPERVISOR . "',
                        ID_INSTITUICAO_ENSINO = '" . $VO->ID_INSTITUICAO_ENSINO . "',
                        ID_BOLSA_ESTAGIO = '" . $VO->ID_BOLSA_ESTAGIO . "',
                        DT_ATUALIZACAO = sysdate ,
                        DT_INICIO_VIGENCIA = to_date('" . $VO->DT_INICIO_VIGENCIA . "','dd/mm/yyyy'),
                        DT_FIM_VIGENCIA = to_date('" . $VO->DT_FIM_VIGENCIA . "','dd/mm/yyyy'),
                        DT_DESLIGAMENTO = to_date('" . $VO->DT_DESLIGAMENTO . "','dd/mm/yyyy'),
                        NB_INICIO_HORARIO = '" . $VO->NB_INICIO_HORARIO . "',
                        NB_FIM_HORARIO = '" . $VO->NB_FIM_HORARIO . "',
                        TX_PLANO_ATIVIDADE = '" . $VO->TX_PLANO_ATIVIDADE . "',
                        CS_TIPO = '" . $VO->CS_TIPO . "',
                        TX_TCE = '" . $VO->TX_TCE . "',
                        ID_UNIDADE_ORG = '" . $VO->ID_LOTACAO . "',
                        CS_TIPO_VAGA_ESTAGIO = '" . $VO->CS_TIPO_VAGA_ESTAGIO . "',
                        CS_PERIODO = '" . $VO->CS_PERIODO . "',
                        CS_HORARIO_CURSO = '" . $VO->CS_HORARIO_CURSO . "',
                        ID_AGENCIA_ESTAGIO = '" . $VO->ID_AGENCIA_ESTAGIO . "',
                        TX_EMAIL = '" . $VO->TX_EMAIL . "',
                        TX_TELEFONE = '" . $VO->TX_TELEFONE . "',
                        TX_ENDERECO = '" . $VO->TX_ENDERECO . "',
                        ID_USUARIO_ATUALIZACAO = '" . $_SESSION['ID_USUARIO'] . "'

                  where
                        ID_CONTRATO =" . $VO->ID_CONTRATO;
//        print_r($query);
        return $this->sql($query);
    }

    function excluir($VO) {
        $query = "delete from semad.CONTRATO_ESTAGIO
                  where ID_CONTRATO=" . $VO->ID_CONTRATO;
        return $this->sql($query);
    }

    // ########################### ------------------ Fim Repositorio do Master ---------- #################################
    //######### --------------- Repositorio das Funções dos combosBox------------------##################
    /*
     * SÃO as funções:
     *
     *               buscarOrgaoGestor($VO);
     *               buscarOrgaoSolicitante($VO);
     *               buscarCodSelecao($VO);
     *               buscarTipoVaga($VO);
     *               buscarQuadroVaga($VO);
     *               buscarCandidato($VO);
     *               buscarEstagiario($VO);
     *               buscarEstagiarioSemSelecao($VO);
     *               buscarInstituicaoDeEnsino($VO);
     *               buscarAgenteIntegracao($VO);
     *               buscarSupervisor($VO);
     *               buscarCurso($VO);
     *               buscarLotacao($VO);
     *               buscarBolsa($VO);
     *
     *  */

    function buscarBolsa($VO) {
        $query = "SELECT
                    ID_BOLSA_ESTAGIO CODIGO,
                    ID_BOLSA_ESTAGIO,
                    TX_BOLSA_ESTAGIO,
                    NB_VALOR
                 FROM
                    BOLSA_ESTAGIO";
        $VO->ID_BOLSA_ESTAGIO ? $query .= " WHERE ID_BOLSA_ESTAGIO = " . $VO->ID_BOLSA_ESTAGIO . " " : false;
        $query.= " order by tx_bolsa_estagio ";

        return $this->sqlVetor($query);
    }

    function buscarSupervisor($VO) {

        // função utilizada para trazer do banco todos os supervisores
        // Utilizada no arquivo arrays.php
        $query = "SELECT
                    SU.ID_PESSOA_SUPERVISOR CODIGO,
                    SU.ID_PESSOA_SUPERVISOR,
                    FU.TX_NOME
                FROM
                    SUPERVISOR_ESTAGIO SU,
                    PESSOA_FISICA PE,
                    PESSOA FU
                WHERE
                    PE.ID_PESSOA =SU.ID_PESSOA_SUPERVISOR
                    and PE.ID_PESSOA=FU.ID_PESSOA";
        return $this->sqlVetor($query);
    }

    function buscarCandidato($VO) {

        // função utilizada para trazer do banco todos os candidatos de uma seleção
        // Utilizada no arquivo acoes.php
        $query = "SELECT Distinct
                    D.ID_PESSOA_ESTAGIARIO
                    ||'_'
                    || C.NB_CANDIDATO
                    ||'_'
                    || C.NB_VAGAS_RECRUTAMENTO
                    ||'_'
                    || C.ID_RECRUTAMENTO_ESTAGIO
                    ||'_'
                    || F.CS_TIPO_VAGA_ESTAGIO
                    ||'_'
                    || F.TX_TIPO_VAGA_ESTAGIO CODIGO,
                    D.ID_PESSOA_ESTAGIARIO,
                    D.TX_NOME,
                    C.NB_CANDIDATO,
                    C.NB_VAGAS_RECRUTAMENTO,
                    C.ID_RECRUTAMENTO_ESTAGIO

                  FROM
                    SELECAO_ESTAGIO A ,
                    ESTAGIARIO_SELECAO B ,
                    ESTAGIARIO_VAGA C ,
                    V_ESTAGIARIO D,
                    VAGAS_RECRUTAMENTO E,
                    TIPO_VAGA_ESTAGIO F,
                      CONTRATO_ESTAGIO G
                  WHERE
                    D.ID_PESSOA_ESTAGIARIO = G.ID_PESSOA_ESTAGIARIO (+)
                    AND A.ID_SELECAO_ESTAGIO    = B.ID_SELECAO_ESTAGIO
                    AND B.ID_RECRUTAMENTO_ESTAGIO = C.ID_RECRUTAMENTO_ESTAGIO
                    AND B.NB_CANDIDATO            = C.NB_CANDIDATO
                    AND B.NB_VAGAS_RECRUTAMENTO   = C.NB_VAGAS_RECRUTAMENTO
                    AND C.ID_PESSOA_ESTAGIARIO    = D.ID_PESSOA_ESTAGIARIO
                    AND B.ID_RECRUTAMENTO_ESTAGIO = E.ID_RECRUTAMENTO_ESTAGIO
                    AND B.NB_VAGAS_RECRUTAMENTO  = E.NB_VAGAS_RECRUTAMENTO
                    AND E.CS_TIPO_VAGA_ESTAGIO   =F.CS_TIPO_VAGA_ESTAGIO
                    AND A.CS_SITUACAO             =2
                    AND B.CS_SITUACAO             =2
                    AND C.CS_SITUACAO             =2

                    AND  D.ID_PESSOA_ESTAGIARIO  not in (select H.ID_PESSOA_ESTAGIARIO from contrato_estagio h where H.DT_DESLIGAMENTO is null )
                    AND B.ID_SELECAO_ESTAGIO =" . $VO->ID_SELECAO_ESTAGIO;
        return $this->sqlVetor($query);
    }

    function buscarEstagiarioSemSelecao($VO) {
        $query = "SELECT
                    A.ID_PESSOA_ESTAGIARIO CODIGO,
                    A.ID_PESSOA_ESTAGIARIO ,
                    A.TX_NOME
                 FROM
                    V_ESTAGIARIO A,
                    CONTRATO_ESTAGIO B
                WHERE
                    A.ID_PESSOA_ESTAGIARIO = B.ID_PESSOA_ESTAGIARIO(+)
                    And A.ID_PESSOA_ESTAGIARIO not in (select H.ID_PESSOA_ESTAGIARIO from contrato_estagio h where H.DT_DESLIGAMENTO is null )
                    AND A.ID_PESSOA_ESTAGIARIO NOT IN
                    (SELECT C.ID_PESSOA_ESTAGIARIO FROM estagiario_vaga C
                    )";
        return $this->sqlVetor($query);
    }

    function buscarInstituicaoDeEnsino($VO) {
        // função que busca no banco todas as instuições de ensino
        // Utilizada no arrays.php

        $query = "SELECT
                    ID_INSTITUICAO_ENSINO,
                    ID_INSTITUICAO_ENSINO CODIGO,
                    TX_INSTITUICAO_ENSINO
                  FROM
                    INSTITUICAO_ENSINO";
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

    function buscarCurso($VO) {
        // função que busca no banco todos os cursos
        // utilizada no arrays.php
        $query = "SELECT
                    ID_CURSO_ESTAGIO,
                    ID_CURSO_ESTAGIO CODIGO,
                    TX_CURSO_ESTAGIO
                  FROM
                    CURSO_ESTAGIO";
        return $this->sqlVetor($query);
    }

    function buscarLotacao($VO) {

        // Função ultizada para trazer do banco todas as lotações de uma unidade solicitante
        // Utilizada no acoes.php
        $query = "SELECT
                        ID_UNIDADE_ORG ID_LOTACAO,
                        ID_UNIDADE_ORG CODIGO,
                        ORGAO
                  FROM
                        V_UNIDADE_ORG
                  WHERE
                    NB_COD_UNIDADE LIKE '" . $VO->NB_COD_UNIDADE . "%'
                    AND CS_ATIVA=0
                  order by ORGAO";

        return $this->sqlVetor($query);
    }

    function buscarTipoVaga($VO) {

        // Função que traz todos tipos de vagas
        // utilizada no arrays.php
        $query = "SELECT
                    CS_TIPO_VAGA_ESTAGIO,
                    CS_TIPO_VAGA_ESTAGIO CODIGO,
                    TX_TIPO_VAGA_ESTAGIO
                  from
                    TIPO_VAGA_ESTAGIO";
        return $this->sqlVetor($query);
    }

    function buscarTodosQuadrosVagas($VO) {
        $query = "SELECT
                    ID_QUADRO_VAGAS_ESTAGIO CODIGO,
                    ID_QUADRO_VAGAS_ESTAGIO ID_QUADRO_VAGAS_ESTAGIO_2,
                    TX_CODIGO TX_QUADRO_VAGAS_2
                 FROM
                    QUADRO_VAGAS_ESTAGIO";

        return $this->sqlVetor($query);
    }

    function buscarQuadroVaga($VO) {

        // Função uitlizadas para trazer todos os quadros de vagas
        // função utilizada no arrays.php
        $query = "SELECT
                            QUADRO_VAGAS_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO CODIGO,
                            QUADRO_VAGAS_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO,
                            QUADRO_VAGAS_ESTAGIO.TX_CODIGO TX_CODIGO_QUADRO_VAGAS
                  FROM
                            SELECAO_ESTAGIO,
                            RECRUTAMENTO_ESTAGIO,
                            QUADRO_VAGAS_ESTAGIO
                  WHERE
                            SELECAO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO = RECRUTAMENTO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO
                            AND RECRUTAMENTO_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO = QUADRO_VAGAS_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO
                            and SELECAO_ESTAGIO.ID_SELECAO_ESTAGIO =" . $VO->ID_SELECAO_ESTAGIO;
        return $this->sqlVetor($query);
    }

    function buscarOrgaoGestor($VO) {

        // Função que pega todos os orgãos Getores
        // Utilizada na Index chamada pelo arrays.php

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

        // Função que pega todos os Orgãos Solicitantes a qual o Usuario pertence
        // Utilizada na Index chamada pelo arrays.php
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

    function buscarCodSelecao($VO) {
        // Função que pega todos os Códigos das seleção referentes ao Orgão solicitante
        // Utilizada na Index chamada pelo arrays.php

        $query = "SELECT
                    SELECAO_ESTAGIO.TX_COD_SELECAO,
                    SELECAO_ESTAGIO.ID_SELECAO_ESTAGIO CODIGO,
                    SELECAO_ESTAGIO.ID_SELECAO_ESTAGIO
                  FROM
                    SELECAO_ESTAGIO,ORGAO_ESTAGIO
                  WHERE
                    SELECAO_ESTAGIO.ID_ORGAO_ESTAGIO = ORGAO_ESTAGIO.ID_ORGAO_ESTAGIO
                  and SELECAO_ESTAGIO.ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO;

        return $this->sqlVetor($query);
    }

    function buscarCodSelecaoIndex($VO) {
        // Função que pega todos os Códigos das seleção referentes ao Orgão solicitante
        // Utilizada na Index chamada pelo arrays.php

        $query = "select B.ID_SELECAO_ESTAGIO CODIGO, B.TX_COD_SELECAO
					from CONTRATO_ESTAGIO a, SELECAO_ESTAGIO B
					where a.ID_SELECAO_ESTAGIO = B.ID_SELECAO_ESTAGIO
					and A.ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO;

        return $this->sqlVetor($query);
    }

    //############################ --------------- FIM Repositorio Funções dos combosBox---------------##################
    //
    // ###########################---------- BUSCA ENDEREÇO ORGAO E SECRATARIO -----------##################################
    /* UTILIZADA NA TELA DE CADASTRAR ....
     * QUANDO O USUARIO CLICAR EM ORGÃO GESTOR(COMBO BOX) AUTOMATICAMENTE CARREGA OS CAMPOS DO ENDEREÇO E DO SECRETARIO DO ORGÃO GESTOR
     */

    function buscarCargoSupervisor($VO) {

        $query = "
            select
                id_pessoa_supervisor CODIGO,
                id_pessoa_supervisor,
                TX_Cargo
            from
              SUPERVISOR_ESTAGIO
            where id_pessoa_supervisor =" . $VO->ID_PESSOA_SUPERVISOR;

        return $this->sqlVetor($query);
    }

    function buscarEnderecoOrgaoGestor($VO) {
        // Função utilizada para trazer endereço do Orgão gestor
        // Utilizada no acoes.php
        $query = "SELECT
                          TX_ENDERECO TX_ENDERECO_SEC
                  FROM
                    V_END_UNID_ORG END
                  where
                    end.id_unidade_org =" . $VO->ID_UNIDADE_ORG;
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

    function buscarDocuments($VO) {

        // Buscar todos os documentos(CPF & RG) do candidato
        // Utilizada no acoes.php
        $query = "SELECT
                        D.NB_CPF,
                        D.NB_RG
                FROM

                        V_ESTAGIARIO D
                WHERE
                    D.ID_PESSOA_ESTAGIARIO  =" . $VO->ID_PESSOA_ESTAGIARIO;
        return $this->sqlVetor($query);
    }

    // ####################----------- FIM BUSCA ENDEREÇO ORGAO E SECRATARIO -----------##################################
}

?>