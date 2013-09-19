<?php

require_once $pathvo."VO.php";
require_once $path."src/repositorio/RepositorioCalendario.php";

class calendarioVO extends VO{

    function calendarioVO(){
        return $this->repositorio = new RepositorioCalendario();
    }

    function pesquisarOrgaoGestor(){
        return $this->repositorio->pesquisarOrgaoGestor($this);
    }

    function atualizarInf(){
        return $this->repositorio->atualizarInf($this);
    }

    function pesquisarGrupoPagamento(){
        return $this->repositorio->pesquisarGrupoPagamento($this);
    }

    function pesquisarItemCalendario(){
        return $this->repositorio->pesquisarItemCalendario($this);
    }

    function inserirItemCalendario(){
        return $this->repositorio->inserirItemCalendario($this);
    }

    function excluirItemCalendario(){
        return $this->repositorio->excluirItemCalendario($this);
    }

    function buscarItemCalendario(){
        return $this->repositorio->buscarItemCalendario($this);
    }

    function alterarItemCalendario(){
        return $this->repositorio->alterarItemCalendario($this);
    }
}
?>
