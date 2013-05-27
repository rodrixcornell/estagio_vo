<?php

require_once $pathvo."VO.php";
require_once $path."src/repositorio/RepositorioContrato.php";

class contratoVO extends VO{
    
    function contratoVO(){        
        return $this->repositorio = new RepositorioContrato();         
    }
    
     //######### --------------- VO das Funções dos combosBox------------------##################
    /*
     * SÃO as funções:
     * 
     *               buscarOrgaoGesto();
     *               buscarOrgaoSolicitante();
     *               buscarCodSelecao();
     *               buscarTipoVaga();
     *               buscarQuadroVaga();
     *               buscarCandidato();
     *               buscarEstagiario();
     *               buscarInstituicaoDeEnsino();
     *               buscarAgenteIntegracao();
     *               buscarSupervisor();
     *               buscarCurso();
     * 
     *  */
    
    function buscarOrgaoGestor(){        
        // Função que pega todos os orgãos Getores
        return $this->repositorio->buscarOrgaoGestor($this);
        
    }
    
    function buscarOrgaoSolicitante(){
        // Função que pega todos os Orgãos Solicitantes a qual o Usuario pertence
        return $this->repositorio->buscarOrgaoSolicitante($this);
        
    }

    function  buscarCodSelecao(){
        return $this->repositorio->buscarCodSelecao($this);
    }

    //######### --------------- FIM VO Funções dos combosBox------------------##################
 	
}
?>