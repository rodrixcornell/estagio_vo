<?php

require_once $pathvo."VO.php";
require_once $path."src/repositorio/RepositorioOrgao_solicitante.php";

class orgao_solicitanteVO extends VO{
    
    function orgao_solicitanteVO(){
        
        return $this->repositorio = new RepositorioOrgao_solicitante(); 
        
    }	
	function  buscarAgenteSetorial(){    
        return $this->repositorio->buscarAgenteSetorial($this);
    }

	function  pesquisarOrgaoSolicitante(){    
        return $this->repositorio->pesquisarOrgaoSolicitante($this);
    }
    
}
?>