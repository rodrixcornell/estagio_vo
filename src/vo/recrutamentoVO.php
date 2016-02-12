<?php

require_once $pathvo . "VO.php";
require_once $path . "src/repositorio/RepositorioRecrutamento.php";

class recrutamentoVO extends VO {

    function recrutamentoVO() {

        return $this->repositorio = new RepositorioRecrutamento();
    }

    function inserirCandidato() {
        return $this->repositorio->inserirCandidato($this);
    }

    function pesquisarOrgaoGestor() {
        return $this->repositorio->pesquisarOrgaoGestor($this);
    }

    function buscarSolicitante() {
        return $this->repositorio->buscarSolicitante($this);
    }

    function buscarSolicitacao() {
        return $this->repositorio->buscarSolicitacao($this);
    }

    function buscarQuadroVagas() {
        return $this->repositorio->buscarQuadroVagas($this);
    }

    function pesquisarTipoVagaEstagio() {
        return $this->repositorio->pesquisarTipoVagaEstagio($this);
    }

//	
    function buscarRecrutamento() {
        return $this->repositorio->buscarRecrutamento($this);
    }

    function buscarVaga() {
        return $this->repositorio->buscarVaga($this);
    }

    function buscarCandidato() {
        return $this->repositorio->buscarCandidato($this);
    }

    function pesquisarEstagiario() {
        return $this->repositorio->pesquisarEstagiario($this);
    }

    function pesquisarRecrutamento() {
        return $this->repositorio->pesquisarRecrutamento($this);
    }

//	
    function inserirVaga() {
        return $this->repositorio->inserirVaga($this);
    }

    function atualizarInf() {
        return $this->repositorio->atualizarInf($this);
    }

    function excluirVaga() {
        return $this->repositorio->excluirVaga($this);
    }

    function excluirCandidato() {
        return $this->repositorio->excluirCandidato($this);
    }

    function alterarVaga() {
        return $this->repositorio->alterarVaga($this);
    }

    function efetivar() {
        return $this->repositorio->efetivar($this);
    }

    function verificarSelecao() {
        return $this->repositorio->verificarSelecao($this);
    }

    /*
     * 
     * funções para relatorio 
     * 
     */

    function buscarOrgaoSolicitanteRel() {
        return $this->repositorio->buscarOrgaoSolicitanteRel($this);
    }
    
    function buscarRecrutamentoRel() {
        return $this->repositorio->buscarRecrutamentoRel($this);
    }

    /*
     * 
     * Fim funções para relatorio 
     * 
     */
}

?>
