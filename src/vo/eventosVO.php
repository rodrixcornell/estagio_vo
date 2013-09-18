<?php

require_once $pathvo."VO.php";
require_once $path."src/repositorio/RepositorioEventos.php";

class eventosVO extends VO{
    
    function eventosVO(){        
        return $this->repositorio = new RepositorioEventos();         
    }
    
	
	function  pesquisarEventos(){    
        return $this->repositorio->pesquisarEventos($this);
    }
	
	function  pesquisarBase(){    
        return $this->repositorio->pesquisarBase($this);
    }

	function  inserirBase(){    
        return $this->repositorio->inserirBase($this);
    }
    
    function  excluirBase(){    
        return $this->repositorio->excluirBase($this);
    }    
	
	function  alterarBase(){    
        return $this->repositorio->alterarBase($this);
    }

    function atualizarInfMaster(){    
        return $this->repositorio->atualizarInfMaster($this);
    }
}
?>
