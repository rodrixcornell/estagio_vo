<?php

require_once $pathvo."VO.php";
require_once $path."src/repositorio/RepositorioGrupo_pagamento.php";

class grupo_pagamentoVO extends VO{
    
    function grupo_pagamentoVO(){        
        return $this->repositorio = new RepositorioGrupo_pagamento();         
    }
    
	function pesquisargrupo_pagamento(){    
        return $this->repositorio->pesquisargrupo_pagamento($this);
    }
 	
}
?>
