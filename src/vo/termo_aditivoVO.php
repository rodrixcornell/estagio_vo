<?php

require_once $pathvo . "VO.php";
require_once $path . "src/repositorio/RepositorioTermo_Aditivo.php";

class termo_aditivoVO extends VO {

    function termo_aditivoVO() {

        return $this->repositorio = new RepositorioTermo_Aditivo();
    }

    function pesquisarOrgaoGestor() {
        return $this->repositorio->pesquisarOrgaoGestor($this);
    }

    function pesquisarNB_Codigo() {
        return $this->repositorio->pesquisarNB_Codigo($this);
    }

    function pesquisarAgenciaDeEstagio() {
        return $this->repositorio->pesquisarAgenciaDeEstagio($this);
    }

    function pesquisar() {
        return $this->repositorio->pesquisar($this);
    }

}

?>
