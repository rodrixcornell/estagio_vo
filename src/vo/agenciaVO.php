<?php

require_once $pathvo . "VO.php";
require_once $path . "src/repositorio/RepositorioAgencia.php";

class agenciaVO extends VO {

    function agenciaVO() {
        //Banco
        $this->repositorio = new RepositorioAgencia();
    }
    function buscar() {
    return $this->repositorio->buscar($this);
    }
    
     function atualizar() {
    return $this->repositorio->atualizar($this);
    }
     function atualizarcad() {
    return $this->repositorio->atualizarcad($this);
    }
	
   
}

?>