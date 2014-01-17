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

    function checaCPF() {
        return $this->repositorio->checaCPF($this);
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

    function inserirEstagiario() {
        return $this->repositorio->inserirEstagiario($this);
    }

    function alterarEstagiario() {
        return $this->repositorio->alterarEstagiario($this);
    }

    function buscarCandidatoEstagiario() {
        return $this->repositorio->buscarCandidatoEstagiario($this);
    }

    function buscarDadosOfertaVaga() {
        return $this->repositorio->buscarDadosOfertaVaga($this);
    }

    function buscarCursoEstagio() {
        return $this->repositorio->buscarCursoEstagio($this);
    }

    function buscarTurno() {
        return $this->repositorio->buscarTurno($this);
    }

    function buscarInstituicaoEnsino() {
        return $this->repositorio->buscarInstituicaoEnsino($this);
    }

    function buscarTipoVagaEstagio() {
        return $this->repositorio->buscarTipoVagaEstagio($this);
    }

    function buscarBolsaEstagio() {
        return $this->repositorio->buscarBolsaEstagio($this);
    }

    function buscarSupervisorEstagio() {
        return $this->repositorio->buscarSupervisorEstagio($this);
    }

    function alterarCandidatoComMotivo() {
        return $this->repositorio->alterarCandidatoComMotivo($this);
    }

    function alterarCandidatoSemMotivo() {
        return $this->repositorio->alterarCandidatoSemMotivo($this);
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
