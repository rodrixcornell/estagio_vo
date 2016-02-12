<?php
require_once $pathvo . "VO.php";
require_once $path . "src/repositorio/RepositorioAgencia.php";

class agenciaVO extends VO {

    function agenciaVO() {
        //Banco
        $this->repositorio = new RepositorioAgencia();
    }
    
}

?>