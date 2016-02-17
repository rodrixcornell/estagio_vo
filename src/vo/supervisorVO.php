<?php
require_once $pathvo . "VO.php";
require_once $path . "src/repositorio/RepositorioSupervisor.php";

class supervisorVO extends VO {

    function supervisorVO() {
        //Banco
        $this->repositorio = new RepositorioSupervisor();
    }
    
    function pesquisarFuncionario() {
    	return $this->repositorio->pesquisarFuncionario($this);
    }
	
    function pesquisarConselho() {
    	return $this->repositorio->pesquisarConselho($this);
    }

}

?>