<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioTr extends Repositorio {

    // ########################### ------------------  Repositorio do Master ---------- #################################

    function pesquisar($VO) {
        
        $codigoOrgaoSolicitante = explode('_', $VO->ID_ORGAO_ESTAGIO);

        $codigoOrgaoGestor = explode('_', $VO->ID_ORGAO_GESTOR_ESTAGIO);
        $query = "SELECT 
  
                        A.ID_Tr CODIGO,
                        A.ID_Tr,
                        A.TX_CODIGO,
                        E.TX_AGENCIA_ESTAGIO,
                        C.TX_ORGAO_ESTAGIO,
                        B.TX_ORGAO_GESTOR_ESTAGIO,
                        D.TX_NOME,
                        D.NB_CPF
                  FROM 
                        Tr_ESTAGIO A,
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
                  ID_AGENCIA_ESTAGIO,
                  ID_ORGAO_ESTAGIO,
                  DT_CADASTRO,
                  DT_ATUALIZACAO,
                  ID_USUARIO_CADASTRO,
                  ID_USUARIO_ATUALIZACAO,
                  CS_SITUACAO
                 )
                  VALUES
                 (
                  '".$CodigoPK['ID_SOLICITACAO_TR'][0]."',
                  SEMAD.F_G_COD_SOLICITACAO_TR(),
                  '" . $VO->TX_CARGO_AGENTE . "',
                  '" . $VO->TX_EMAIL_AGENTE . "',
                  '" . $VO->TX_TELEFONE_AGENTE . "',
                  '" . $VO->DT_TERMINO_ESTAGIO . "',
                  '" . $VO->ID_CONTRATO . "',
                  '" . $VO->ID_SETORIAL_ESTAGIO . "',
                  '" . $VO->ID_AGENCIA_ESTAGIO . "',
                  '" . $codigoOrgaoSolicitante[0] . "',
                  SYSDATE,
                  SYSDATE,
                  '".$_SESSION['ID_USUARIO']."',
                  '".$_SESSION['ID_USUARIO']."',
                  1
                 ) 
   ";
print_r($query);
        $retorno = $this->sql($query);
        return $retorno ? '' : $CodigoPK['ID_SOLICITACAO_TR'][0];
    }

    function alterar($VO) {
        $query = "INSERT INTO SOLICITACAO_TR
                 (
                  ID_SOLICITACAO_TR,
                  TX_CODIGO,
                  TX_CARGO_AGENTE,
                  TX_EMAIL_AGENTE,
                  TX_TELEFONE_AGENTE,
                  DT_TERMINO_ESTAGIO,
                //  TX_MOTIVO,
                //  TX_OBSERVACAO,
                  ID_CONTRATO,
                  ID_SETORIAL_ESTAGIO,
                  ID_AGENCIA_ESTAGIO,
                  ID_ORGAO_ESTAGIO,
                  DT_CADASTRO,
                  DT_ATUALIZACAO,
                  ID_USUARIO_CADASTRO,
                  ID_USUARIO_ATUALIZACAO,
                  CS_SITUACAO
                 )
                  VALUES
                 (
                  SEMAD.F_G_PK_SOLICITACAO_TR(),
                  '" . $VO->TX_CODIGO . "',
                  '" . $VO->TX_CARGO_AGENTE . "',
                  '" . $VO->TX_EMAIL_AGENTE . "',
                  '" . $VO->TX_TELEFONE_AGENTE . "',
                  '" . $VO->DT_TERMINO_ESTAGIO . "',
                  '" . $VO->ID_CONTRATO . "',
                  '" . $VO->ID_SETORIAL_ESTAGIO . "',
                  '" . $VO->ID_AGENCIA_ESTAGIO . "',
                  '" . $VO->ID_ORGAO_ESTAGIO . "',
                  SYSDATE,
                  SYSDATE,
                  '".$_SESSION['ID_USUARIO']."',
                  '".$_SESSION['ID_USUARIO']."',
                  1
                 )  ";
                 
                 return $this->sql($query);
    }

    function excluir($VO) {
        $query = "delete from Tr_estagio
                  where id_Tr_estagio =".$VO->ID_Tr_ESTAGIO;
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

    function buscarAgenteSetorial($VO) {
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
                    AND O.ID_ORGAO_ESTAGIO = NVL('" . $VO->ID_ORGAO_ESTAGIO."',0)";

 //       $VO->ID_ORGAO_ESTAGIO ? $query .= "AND O.ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . " " : false;
      //  print_r($query);
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
                  || '_' ||  SUBSTR(T.TX_TIPO_VAGA_ESTAGIO, 0, (CASE WHEN INSTR(T.TX_TIPO_VAGA_ESTAGIO, ' ') <> 0 THEN INSTR(T.TX_TIPO_VAGA_ESTAGIO, ' ') - 1 ELSE LENGTH(T.TX_TIPO_VAGA_ESTAGIO) END)) || '_' || A.TX_TCE TUDO
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

    function buscarContrato($VO) {

        $query = "SELECT ID_CONTRATO CODIGO, ID_CONTRATO, TX_CODIGO FROM CONTRATO_ESTAGIO ORDER BY TX_CODIGO";
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