<?php

require_once $pathvo."VO.php";
require_once $path."src/repositorio/RepositorioSelecao.php";

class selecaoVO extends VO{
    
    function selecaoVO(){        
        return $this->repositorio = new RepositorioSelecao();         
    }
	
	function  buscarSolicitante(){    
        return $this->repositorio->buscarSolicitante($this);
    }
	
	function buscarOrgaoGestor(){        
        return $this->repositorio->buscarOrgaoGestor($this);        
    }
	
	function buscarSelecao(){    
        return $this->repositorio->buscarSelecao($this);
    }
	
    function  buscarEstagiarioVaga(){    
        return $this->repositorio->buscarEstagiarioVaga($this);
    }
        
    function buscarOrgaoSolicitante(){
        return $this->repositorio->buscarOrgaoSolicitante($this);        
    }
	
	 function buscarSolicitanteCad(){
        return $this->repositorio->buscarSolicitanteCad($this);        
    }
	
	function verificarSituacaoAnalise(){
        return $this->repositorio->verificarSituacaoAnalise($this);        
    }
	
	function verificarContrato(){
        return $this->repositorio->verificarContrato($this);        
    }
    
    function buscarRecrutamento(){
        return $this->repositorio->buscarRecrutamento($this);        
    }
	
	function buscarRecrutamentoCad(){
        return $this->repositorio->buscarRecrutamentoCad($this);        
    }
	
    function pesquisarCandidatos(){
        return $this->repositorio->pesquisarCandidatos($this);        
    }
        
	function  inserirCandidato(){    
        return $this->repositorio->inserirCandidato($this);
    }
	
	function buscar(){    
        return $this->repositorio->buscar($this);
    }
	
	function  alterarCandidato(){    
        return $this->repositorio->alterarCandidato($this);
    }

    function  atualizarInf(){    
        return $this->repositorio->atualizarInf($this);
    }
    
    function  excluirCandidato(){    
        return $this->repositorio->excluirCandidato($this);
    }    
	
    function  efetivar(){    
        return $this->repositorio->efetivar($this);
    }    
           
}
?>
