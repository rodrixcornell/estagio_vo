<?php

require_once $pathvo."VO.php";
require_once $path."src/repositorio/RepositorioOrgao_Gestor.php";

class orgao_gestorVO extends VO{

    function orgao_gestorVO(){

        return $this->repositorio = new RepositorioOrgao_Gestor();

    }

	function pesquisarUnidade(){
        return $this->repositorio->pesquisarUnidade($this);
    }

    function buscarEmails(){
        return $this->repositorio->buscarEmails($this);
    }

	function inserirEmail(){
        return $this->repositorio->inserirEmail($this);
    }

	function atualizarInf(){
        return $this->repositorio->atualizarInf($this);
    }

	function excluirEmail(){
        return $this->repositorio->excluirEmail($this);
    }


}
?>
