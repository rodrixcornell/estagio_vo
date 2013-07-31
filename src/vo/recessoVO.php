<?php

require_once $pathvo . "VO.php";
require_once $path . "src/repositorio/RepositorioRecesso.php";

class recessoVO extends VO {

    function recessoVO() {

        return $this->repositorio = new RepositorioRecesso();
    }

    function  pesquisarOrgaoGestor(){    
        return $this->repositorio->pesquisarOrgaoGestor($this);
    }
 
    function  pesquisarOrgaoSolicitante(){    
        return $this->repositorio->pesquisarOrgaoSolicitante($this);
    }

    function  buscarContrato(){    
        return $this->repositorio->buscarContrato($this);
    }

  	function buscarAgenteSetorial(){    
        return $this->repositorio->buscarAgenteSetorial($this);
    }

    function pesquisarAgenteSetorial(){    
        return $this->repositorio->pesquisarAgenteSetorial($this);
    }
	

    function  inserir(){    
        return $this->repositorio->inserir($this);
    }
    function  excluir(){    
        return $this->repositorio->excluir($this);
    }
    function  alterar(){    
        return $this->repositorio->alterar($this);
    }
	
    function buscarSecretarioOrgaoGestor() {
       return $this->repositorio->buscarSecretarioOrgaoGestor($this);
    }



    function buscarOrgaoGestor() {
        // Função que pega todos os orgãos Getores
        return $this->repositorio->buscarOrgaoGestor($this);
    }
	
	   function buscarDadosContrato() {
        // Função que pega todas as bolsas de estagio
        return $this->repositorio->buscarDadosContrato($this);
    }


}

?>
