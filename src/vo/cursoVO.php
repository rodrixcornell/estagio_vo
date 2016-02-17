<?php

require_once $pathvo . "VO.php";
require_once $path . "src/repositorio/RepositorioCurso.php";

class cursoVO extends VO {

    function cursoVO() {

        return $this->repositorio = new RepositorioCurso();
    }

    function pesquisarAreaConhecimento() {
        return $this->repositorio->pesquisarAreaConhecimento($this);
    }



}

?>
