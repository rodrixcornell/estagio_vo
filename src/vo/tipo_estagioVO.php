<?php

require_once $pathvo."VO.php";
require_once $path."src/repositorio/RepositorioTipo_Estagio.php";

class tipo_estagioVO extends VO{
    
    function tipo_estagioVO(){        
        return $this->repositorio = new RepositorioTipo_Estagio();         
    }
    
/*	function pesquisarTipo_Estagio(){    
        return $this->repositorio->pesquisarBolsa($this);
    }
*/ 	
}
?>
