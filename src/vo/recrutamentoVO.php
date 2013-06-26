<?php

require_once $pathvo."VO.php";
require_once $path."src/repositorio/RepositorioRecrutamento.php";

class recrutamentoVO extends VO{
    
    function recrutamentoVO(){
        
        return $this->repositorio = new RepositorioRecrutamento(); 
        
    }


    function inserirCandidato(){   
        return $this->repositorio->inserirCandidato($this);
    }


    function  pesquisarQuadroVagas(){    
        return $this->repositorio->pesquisarQuadroVagas($this);
    }
    
	function  pesquisarOrgaoGestor(){    
        return $this->repositorio->pesquisarOrgaoGestor($this);
    }
 
    function  pesquisarOrgaoSolicitante(){    
        return $this->repositorio->pesquisarOrgaoSolicitante($this);
    }
	
    function  pesquisarTipoVagaEstagio(){    
        return $this->repositorio->pesquisarTipoVagaEstagio($this);
    }
	
//	
	function  buscarRecrutamento(){    
        return $this->repositorio->buscarRecrutamento($this);
    }

    function  buscarVaga(){    
        return $this->repositorio->buscarVaga($this);
    }

    function  buscarCandidato(){    
        return $this->repositorio->buscarCandidato($this);
    }

    function  pesquisarEstagiario(){    
        return $this->repositorio->pesquisarEstagiario($this);
    }

   function  pesquisarRecrutamento(){    
        return $this->repositorio->pesquisarRecrutamento($this);
    }
//	
	function  inserirVaga(){    
        return $this->repositorio->inserirVaga($this);
    }
	
	function  atualizarInf(){    
        return $this->repositorio->atualizarInf($this);
    }
	
	function  excluirVaga(){    
        return $this->repositorio->excluirVaga($this);
    }

	function  excluirCandidato(){    
        return $this->repositorio->excluirCandidato($this);
    }

    function  alterarVaga(){    
        return $this->repositorio->alterarVaga($this);
    }
	function  efetivar(){    
        return $this->repositorio->efetivar($this);
    }
}
?>
