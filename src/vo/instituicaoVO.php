<?php

require_once $pathvo."VO.php";
require_once $path."src/repositorio/RepositorioInstituicao.php";

class instituicaoVO extends VO{

    function instituicaoVO(){

        return $this->repositorio = new RepositorioInstituicao();
        }

   function pesquisarUnidade(){
        return $this->repositorio->pesquisarUnidade($this);
    }

    function buscarInstituicoes() {
        return $this->repositorio->buscarInstituicoes();
    }


}
?>
