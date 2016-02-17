<?php

require_once $pathvo."VO.php";
require_once $path."src/repositorio/RepositorioTa_contrato.php";

class ta_contratoVO extends VO{

    function ta_contratoVO(){
        return $this->repositorio = new RepositorioTa_contrato();
    }

    function pesquisarOrgaoGestor(){
        return $this->repositorio->pesquisarOrgaoGestor($this);
    }

    function pesquisarCodigoContrato(){
        return $this->repositorio->pesquisarCodigoContrato($this);
    }

    function pesquisarCodTermoAditivo(){
        return $this->repositorio->pesquisarCodTermoAditivo($this);
    }

    function buscarAgenciaEstagio(){
        return $this->repositorio->buscarAgenciaEstagio($this);
    }

    function buscarUnidadeOrigem(){
        return $this->repositorio->buscarUnidadeOrigem($this);
    }

    function buscarUnidadeDestino(){
        return $this->repositorio->buscarUnidadeDestino($this);
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

	function verificarRecrutamento(){
        return $this->repositorio->verificarRecrutamento($this);
    }

	function efetivarSolicitacao(){
        return $this->repositorio->efetivarSolicitacao($this);
    }

}
?>
