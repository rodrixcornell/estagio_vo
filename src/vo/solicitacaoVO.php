<?php

require_once $pathvo."VO.php";
require_once $path."src/repositorio/RepositorioSolicitacao.php";

class solicitacaoVO extends VO{

    function solicitacaoVO(){
        return $this->repositorio = new RepositorioSolicitacao();
    }

    function pesquisarOrgaoGestor(){
        return $this->repositorio->pesquisarOrgaoGestor($this);
    }

    function pesquisarOrgaoSolicitante(){
        return $this->repositorio->pesquisarOrgaoSolicitante($this);
    }

    function pesquisarAgenciaEstagio(){
        return $this->repositorio->pesquisarAgenciaEstagio($this);
    }

    function pesquisarTipoVaga(){
        return $this->repositorio->pesquisarTipoVaga($this);
    }
}
?>
