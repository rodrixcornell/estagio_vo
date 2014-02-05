<?php
require_once $pathvo."VO.php";
require_once $path."src/repositorio/RepositorioUsuario.php";

class usuarioVO extends VO{

	function usuarioVO(){
		//Banco
		$this->repositorio = new RepositorioUsuario();
	}
	
	
	function carregaUsuario(){
            return $this->repositorio->carregaUsuario($this);
    }
	
	function verificaGrupo(){
            return $this->repositorio->verificaGrupo($this);
    }
	
	function verificaPermissao(){
            return $this->repositorio->verificaPermissao($this);
    }
		
}
?>