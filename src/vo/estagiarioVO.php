<?php

require_once $pathvo."VO.php";
require_once $path."src/repositorio/RepositorioEstagiario.php";

class estagiarioVO extends VO{
    
    function estagiarioVO(){
        return $this->repositorio = new RepositorioEstagiario(); 
    }
    
	function pesquisarLocalidade(){    
        return $this->repositorio->pesquisarLocalidade($this);
    }
	
    function checacpf(){    
        return $this->repositorio->checacpf($this);
    }

	function pesquisarCurso(){
		return $this->repositorio->pesquisarCurso($this);
	}

	function pesquisarOfertaVaga(){
		return $this->repositorio->pesquisarOfertaVaga($this);
	}
	
    function inserirestagiario(){    
        return $this->repositorio->inserirestagiario($this);
    }
	
	function pesquisarFuncionario(){    
        return $this->repositorio->pesquisarFuncionario($this);
    }
    function buscarCPF(){
        return $this->repositorio->buscarCPF($this);
    }
  
}
?>
