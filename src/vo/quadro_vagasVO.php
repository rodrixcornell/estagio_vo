<?php
require_once $pathvo."VO.php";
require_once $path."src/repositorio/RepositorioQuadro_vagas.php";


class quadro_vagasVO extends VO{
    
    function quadro_vagasVO(){
        
        return $this->repositorio = new RepositorioQuadro_vagas(); 
        
    }
    
	function  pesquisarOrgaogestor(){    
        return $this->repositorio->pesquisarOrgaogestor($this);
    }
	
    
	function  pesquisarAgenciaestagio(){    
        return $this->repositorio->pesquisarAgenciaestagio($this);
    }
	
	function  pesquisarTipo(){    
        return $this->repositorio->pesquisarTipo($this);
    }
	
    function pesquisarUsuario(){
        return $this->repositorio->pesquisarUsuario($this);
    }
    
    function  pesquisarUnidades(){    
        return $this->repositorio->pesquisarUnidades($this);
    }
	function  pesquisaCursos(){    
        return $this->repositorio->pesquisaCursos($this);
    }
	
	function  inserirUnidade(){    
        return $this->repositorio->inserirUnidade($this);
    }
	
	function  atualizarInf(){    
        return $this->repositorio->atualizarInf($this);
    }
	
    function orgao_Solicitante(){
        return $this->repositorio->orgao_Solicitante($this);
    }
    function  excluirUnidade(){    
        return $this->repositorio->excluirUnidade($this);
    }
    function pesquisaSituacao(){
        return $this->repositorio->pesquisaSituacao($this);
    }
	
 function alterarQuadroVagas(){
        return $this->repositorio->alterarQuadroVagas($this);
    }
    
     function buscarVagasEstagio(){
        return $this->repositorio->buscarVagasEstagio($this);
    }
    
    function pesquisarCodigo(){
        return $this->repositorio->pesquisarCodigo($this);
    }
  
}
?>
