<?php

require_once $pathvo."VO.php";
require_once $path."src/repositorio/RepositorioOrgao_Gestor.php";

class orgao_gestorVO extends VO{
    
    function orgao_gestorVO(){
        
        return $this->repositorio = new RepositorioOrgao_Gestor(); 
        
    }
    
	function pesquisarUnidade(){    
        return $this->repositorio->pesquisarUnidade($this);
    }
	
	
}
?>
