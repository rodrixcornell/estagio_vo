<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioContrato extends Repositorio {

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
     * 
     *  */

    function buscarOrgaoGestor($VO) {

        // Função que pega todos os orgãos Getores
        // Utilizada na Index chamada pelo arrays.php

        $query = "SELECT 
                    ID_ORGAO_GESTOR_ESTAGIO,
                    ID_ORGAO_GESTOR_ESTAGIO CODIGO,
                    TX_ORGAO_GESTOR_ESTAGIO 
                FROM ORGAO_GESTOR_ESTAGIO";
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

    //######### --------------- FIM Repositorio Funções dos combosBox------------------################## 
    
    
    // ########################### ------------------  Repositorio do Master ---------- #################################

    function pesquisar($VO) {
        $query = "";
        return $this->sqlVetor($query);
    }

    function inserir($VO) {
        $query = "";
        return $this->sql($query);
    }

    function alterar($VO) {
        $query = "";
        return $this->sql($query);
    }

    function excluir($VO) {
        $query = "";
        return $this->sql($query);
    }

    // ########################### ------------------ Fim Repositorio do Master ---------- #################################
}

?>