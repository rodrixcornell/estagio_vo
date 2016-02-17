<?php

require_once $pathvo . "VO.php";
require_once $path . "src/repositorio/RepositorioS_TA.php";

class s_taVO extends VO {

    function s_taVO() {
        return $this->repositorio = new RepositorioS_TA();
    }

    function buscarOrgaoGestor(){
        return $this->repositorio->buscarOrgaoGestor($this);
    }

    function buscarOrgaoSolicitante(){
        return $this->repositorio->buscarOrgaoSolicitante($this);
    }

    function buscarAgenteIntegracao(){
        return $this->repositorio->buscarAgenteIntegracao($this);
    }

    function buscarContrato(){
        return $this->repositorio->buscarContrato($this);
    }
    
    function buscarDadosContrato(){
        return $this->repositorio->buscarDadosContrato($this);
    }
    
    function pesquisarSolicitacao(){
         return $this->repositorio->pesquisarSolicitacao($this);
    }
    
    function buscarASetorial(){
         return $this->repositorio->buscarASetorial($this);
    }
    /*function buscaTipo(){
         return $this->repositorio->buscaTipo($this);
    }*/
    
    function atualizarInf(){
      return $this->repositorio->atualizarInf($this);
   }
   
   function buscarSecretarioOrgaoGestor(){
     return $this->repositorio->buscarSecretarioOrgaoGestor($this);  
   }
   function buscaAEstagio(){
     return $this->repositorio->buscaAEstagio($this);  
   }
   
 /*  function buscarDadosAgente(){
        return $this->repositorio->buscarDadosAgente($this);
    }*/

}

?>