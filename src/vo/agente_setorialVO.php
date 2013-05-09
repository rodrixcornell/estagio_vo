<?php

require_once $pathvo."VO.php";
require_once $path."src/repositorio/RepositorioAgente_setorial.php";

class agente_setorialVO extends VO{
    
    function agente_setorialVO(){
        
        return $this->repositorio = new RepositorioAgente_setorial(); 
        
    }
    
	function  pesquisarUsuario(){    
        return $this->repositorio->pesquisarUsuario($this);
    }
	
//	function  pesquisarUnidadeSolicitante(){    
//        return $this->repositorio->pesquisarUnidadeSolicitante($this);
//    }
//	
//	function  buscarUnidades(){    
//        return $this->repositorio->buscarUnidades($this);
//    }
//	
//	function  pesquisarUnidade(){    
//        return $this->repositorio->pesquisarUnidade($this);
//    }
//	
//	function  inserirUnidade(){    
//        return $this->repositorio->inserirUnidade($this);
//    }
//	
//	function  atualizarInf(){    
//        return $this->repositorio->atualizarInf($this);
//    }
//	
//	function  excluirUnidade(){    
//        return $this->repositorio->excluirUnidade($this);
//    }

	
}
?>
