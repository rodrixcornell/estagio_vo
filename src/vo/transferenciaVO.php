<?php

require_once $pathvo."VO.php";
require_once $path."src/repositorio/RepositorioTransferencia.php";

class transferenciaVO extends VO{

    function transferenciaVO(){
        return $this->repositorio = new RepositorioTransferencia();
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

    function pesquisarCodigoSilicitacao(){
        return $this->repositorio->pesquisarCodigoSilicitacao($this);
    }

    function pesquisarTipoVaga(){
        return $this->repositorio->pesquisarTipoVaga($this);
    }

    function buscarQuantidade(){
        return $this->repositorio->buscarQuantidade($this);
    }

    function buscarCursos(){
        return $this->repositorio->buscarCursos($this);
    }

    function pesquisarVagasSolicitadas(){
        return $this->repositorio->pesquisarVagasSolicitadas($this);
    }

    function inserirVagasSolicitadas(){
        return $this->repositorio->inserirVagasSolicitadas($this);
    }
}
?>
