<?php

require_once $pathvo . "VO.php";
require_once $path . "src/repositorio/RepositorioSelecao.php";

class selecaoVO extends VO {

    function selecaoVO() {
        return $this->repositorio = new RepositorioSelecao();
    }

    function buscarOrgaoGestor() {
        return $this->repositorio->buscarOrgaoGestor($this);
    }

    function buscarSolicitante() {
        return $this->repositorio->buscarSolicitante($this);
    }

    function buscarOfertaVaga() {
        return $this->repositorio->buscarOfertaVaga($this);
    }

    function buscarOrgaoSolicitante() {
        return $this->repositorio->buscarOrgaoSolicitante($this);
    }

//
    function verificarSituacaoAnalise() {
        return $this->repositorio->verificarSituacaoAnalise($this);
    }
//
    function verificarContrato() {
        return $this->repositorio->verificarContrato($this);
    }

    function buscarCPF() {
        return $this->repositorio->buscarCPF($this);
    }

    function buscarCandidatoVaga() {
        return $this->repositorio->buscarCandidatoVaga($this);
    }

    function pesquisarCandidatos() {
        return $this->repositorio->pesquisarCandidatos($this);
    }

    function inserirCandidato() {
        return $this->repositorio->inserirCandidato($this);
    }

    function alterarCandidato() {
        return $this->repositorio->alterarCandidato($this);
    }

    function atualizarInf() {
        return $this->repositorio->atualizarInf($this);
    }

    function excluirCandidato() {
        return $this->repositorio->excluirCandidato($this);
    }

    function efetivar() {
        return $this->repositorio->efetivar($this);
    }
}
?>
