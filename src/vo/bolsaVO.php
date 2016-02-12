<?php

require_once $pathvo."VO.php";
require_once $path."src/repositorio/RepositorioBolsa.php";

class bolsaVO extends VO{
    
    function bolsaVO(){        
        return $this->repositorio = new RepositorioBolsa();         
    }
    
	function pesquisarBolsa(){    
        return $this->repositorio->pesquisarBolsa($this);
    }
 	
}
?>
