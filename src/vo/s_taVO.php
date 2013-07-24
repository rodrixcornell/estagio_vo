<?php

require_once $pathvo . "VO.php";
require_once $path . "src/repositorio/RepositorioS_TA.php";

class s_taVO extends VO {

    function s_taVO() {
        return $this->repositorio = new RepositorioS_TA();
    }

    function buscarOrgaoGestor(){
        return $this->repositorio->buscarOrgaoGestor($this);
    }

    function buscarOrgaoSolicitante(){
        return $this->repositorio->buscarOrgaoSolicitante($this);
    }

    function buscarAgenteIntegracao(){
        return $this->repositorio->buscarAgenteIntegracao($this);
    }

    function buscarContrato(){
        return $this->repositorio->buscarContrato($this);
    }
//    function atualizarInf(){
//        return $this->repositorio->atualizarInf($this);
//    }
}

?>