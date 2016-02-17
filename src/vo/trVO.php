<?php

require_once $pathvo . "VO.php";
require_once $path . "src/repositorio/RepositorioTr.php";

class TrVO extends VO {

    function TrVO() {
        return $this->repositorio = new RepositorioTr();
    }

    function buscarDadosContrato() {
        return $this->repositorio->buscarDadosContrato($this);
    }

    function buscarOrgaoGestor() {
        // Função que pega todos os orgãos Getores
        return $this->repositorio->buscarOrgaoGestor($this);
    }

    function buscarAgenteIntegracao() {
        // Função que pega todas as Agencias de Estagio
        return $this->repositorio->buscarAgenteIntegracao($this);
    }

    function buscarAgenteSetorial() {
        return $this->repositorio->buscarAgenteSetorial($this);
    }

    function buscarContrato() {
        return $this->repositorio->buscarContrato($this);
    }

    function buscarOrgaoSolicitante() {
        // Função que pega todos os Orgãos Solicitantes a qual o Usuario pertence
        return $this->repositorio->buscarOrgaoSolicitante($this);
    }

    function buscarSecretarioOrgaoGestor() {
        //Função que o Secretario do Orgão Gestor e Carrega no campo desabilitado o tpl
        return $this->repositorio->buscarSecretarioOrgaoGestor($this);
    }

    function pesquisarSolicitacao(){
        return $this->repositorio->pesquisarSolicitacao($this);
    }

    function atualizarInf(){
        return $this->repositorio->atualizarInf($this);
    }

}

?>