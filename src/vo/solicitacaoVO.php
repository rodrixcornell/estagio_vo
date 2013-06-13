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

    function pesquisarQuadroVagasEstagio(){
        return $this->repositorio->pesquisarQuadroVagasEstagio($this);
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

    function excluirVagasSolicitadas(){
        return $this->repositorio->excluirVagasSolicitadas($this);
    }

    function buscarVagasSolicitadas(){
        return $this->repositorio->buscarVagasSolicitadas($this);
    }

    function alterarVagasSolicitadas(){
        return $this->repositorio->alterarVagasSolicitadas($this);
    }

    function atualizarInf(){
        return $this->repositorio->atualizarInf($this);
    }
}
?>
