<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioContrato extends Repositorio {

    // ########################### ------------------  Repositorio do Master ---------- #################################

    function pesquisar($VO) {
        
        $codigoOrgaoSolicitante = explode('_', $VO->ID_ORGAO_ESTAGIO);

        $codigoOrgaoGestor = explode('_', $VO->ID_ORGAO_GESTOR_ESTAGIO);
        $query = "SELECT 
  
                        A.ID_CONTRATO CODIGO,
                        A.ID_CONTRATO,
                        A.TX_CODIGO,
                        E.TX_AGENCIA_ESTAGIO,
                        C.TX_ORGAO_ESTAGIO,
                        B.TX_ORGAO_GESTOR_ESTAGIO,
                        D.TX_NOME,
                        D.NB_CPF
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
                        ";
          $VO->ID_ORGAO_ESTAGIO ? $query .= " And A.ID_ORGAO_ESTAGIO = " . $codigoOrgaoSolicitante[0] . " " : false;
          $VO->ID_ORGAO_GESTOR_ESTAGIO ? $query .= " And A.ID_ORGAO_GESTOR_ESTAGIO = " . $codigoOrgaoGestor[0]. " " : false;
          $VO->ID_SELECAO_ESTAGIO ? $query .= " And A.ID_SELECAO_ESTAGIO = " . $VO->ID_SELECAO_ESTAGIO . " " : false;
        
        return $this->sqlVetor($query);
    }

    function inserir($VO) {

        $codigoOrgaoSolicitante = explode('_', $VO->ID_ORGAO_ESTAGIO);

        $codigoOrgaoGestor = explode('_', $VO->ID_ORGAO_GESTOR_ESTAGIO);

        $codigoCandidato = explode('_', $VO->ID_PESSOA_ESTAGIARIO);

        $queryPK = "select SEMAD. F_G_PK_Contrato_Estagio as ID_CONTRATO_ESTAGIO from DUAL";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

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
                        TX_CODIGO
                    )
                    VALUES
                    (
                        '" . $codigoCandidato[0] . "',
                        '" . $CodigoPK['ID_CONTRATO_ESTAGIO'][0] . "',                      
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
                        semad.f_g_cod_contrato_estagio()
                    )
                    ";

        $retorno = $this->sql($query);
        return $retorno ? '' : $CodigoPK['ID_CONTRATO_ESTAGIO'][0];
    }

    function alterar($VO) {
        $query = "";
        return $this->sql($query);
    }

    function excluir($VO) {
        $query = "delete from contrato_estagio
                  where id_contrato_estagio =".$VO->ID_CONTRATO_ESTAGIO;
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
        $query = "SELECT 
                    D.ID_PESSOA_ESTAGIARIO||'_'|| C.NB_CANDIDATO ||'_'||   C.NB_VAGAS_RECRUTAMENTO||'_'||  C.ID_RECRUTAMENTO_ESTAGIO CODIGO,
                    D.ID_PESSOA_ESTAGIARIO,
                    D.TX_NOME,
                    C.NB_CANDIDATO,
                    C.NB_VAGAS_RECRUTAMENTO,
                    C.ID_RECRUTAMENTO_ESTAGIO
                  FROM 
                    SELECAO_ESTAGIO A  ,
                    ESTAGIARIO_SELECAO B ,
                    ESTAGIARIO_VAGA C , 
                    V_ESTAGIARIO D
                  WHERE 
                    A.ID_SELECAO_ESTAGIO = B.ID_SELECAO_ESTAGIO
                    AND B.ID_RECRUTAMENTO_ESTAGIO = C.ID_RECRUTAMENTO_ESTAGIO
                    AND C.ID_PESSOA_ESTAGIARIO = D.ID_PESSOA_ESTAGIARIO
                    --AND A.CS_SITUACAO =2 
                    --AND B.CS_SITUACAO =2
                    AND C.CS_SITUACAO =1 
                    AND B.ID_SELECAO_ESTAGIO =" . $VO->ID_SELECAO_ESTAGIO;
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

    function buscarQuadroVaga($VO) {

        // Função uitlizadas para trazer todos os quadros de vagas
        // função utilizada no arrays.php
        $query = " SELECT 
                    ID_QUADRO_VAGAS_ESTAGIO,
                    ID_QUADRO_VAGAS_ESTAGIO CODIGO,
                    TX_CODIGO 
                   from 
                    QUADRO_VAGAS_ESTAGIO";
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
                    ID_ENDERECO,
                    ID_ENDERECO CODIGO,
                    ID_UNIDADE_ORG,
                    TX_ENDERECO
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
                        SELECAO_ESTAGIO A ,
                        ESTAGIARIO_SELECAO B ,
                        ESTAGIARIO_VAGA C ,
                        V_ESTAGIARIO D
                WHERE 
                        A.ID_SELECAO_ESTAGIO    = B.ID_SELECAO_ESTAGIO
                        AND B.ID_RECRUTAMENTO_ESTAGIO = C.ID_RECRUTAMENTO_ESTAGIO
                        AND C.ID_PESSOA_ESTAGIARIO    = D.ID_PESSOA_ESTAGIARIO
                        --AND A.CS_SITUACAO             =2
                        --AND B.CS_SITUACAO             =2
                        AND C.CS_SITUACAO             =1 
                        AND D.ID_PESSOA_ESTAGIARIO  =" . $VO->ID_PESSOA_ESTAGIARIO;
        return $this->sqlVetor($query);
    }

    // ####################----------- FIM BUSCA ENDEREÇO ORGAO E SECRATARIO -----------################################## 
}

?>