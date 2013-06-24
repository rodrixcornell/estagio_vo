<?php

require_once $pathvo."VO.php";
require_once $path."src/repositorio/RepositorioSelecao.php";

class selecaoVO extends VO{
    
    function selecaoVO(){        
        return $this->repositorio = new RepositorioSelecao();         
    }
    
	function  pesquisarSelecao_Estagio(){    
        return $this->repositorio->pesquisarSelecao_Estagio($this);
    }

    function  buscarSelecao_Estagio(){    
        return $this->repositorio->buscarSelecao_Estagio($this);
    }
    
    function buscarOrgaoGestor(){        
        // Função que pega todos os orgãos Getores
        return $this->repositorio->buscarOrgaoGestor($this);        
    }
    
    function buscarOrgaoSolicitante(){
        // Função que pega todos os Orgãos Solicitantes a qual o Usuario pertence
        return $this->repositorio->buscarOrgaoSolicitante($this);        
    }
    
    function buscarRecrutamento(){
        return $this->repositorio->buscarRecrutamento($this);        
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
