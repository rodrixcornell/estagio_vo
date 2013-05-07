<?php
require_once $path."src/repositorio/Repositorio.php";
class RepositorioUsuario extends Repositorio {

	function carregaUsuario($VO){
		
		$query = "SELECT us.id_usuario, ".
                        "us.id_pessoa_funcionario, ".
              		"us.tx_login, ".
                 	"pe.tx_nome nome, ".
               		"fu.ID_UNIDADE_GESTORA, ".
              		"uo.TX_UNIDADE_ORG, ".
              		"uo.TX_SIGLA_UNIDADE, ".
              		"us.tx_email_pmm ".
            	"FROM usuario us, funcionario_2 fu, pessoa pe, UNIDADE_ORG uo ".
            	"WHERE uo.ID_UNIDADE_ORG = fu.ID_UNIDADE_GESTORA ".
              		"AND fu.id_pessoa_funcionario = us.id_pessoa_funcionario ".
              		"AND pe.id_pessoa = us.id_pessoa_funcionario ".
	      			"AND fu.cs_situacao_funcionario = 1 ".
              		"AND UPPER(us.tx_login) LIKE UPPER('".$VO->TX_LOGIN."')";
		
		return $this->sqlVetor($query);
			
	}
	
	function verificaGrupo($VO){
		
		//$query = "SELECT * FROM grupo_usuario WHERE id_grupo IN (SELECT distinct id_grupo FROM perfil_grupo WHERE id_sistema = 17 AND nb_modulo in (1)) AND id_usuario = ".$VO->ID_USUARIO;
		$query = "select * from v_perfil_usuario where id_sistema = 77 AND nb_modulo in (78,79,80,81) and ID_USUARIO = ".$VO->ID_USUARIO;

		return $this->sqlVetor($query);
			
	}
	
	function verificaPermissao($VO){
		
		$query = "select cs_nivel_acesso from v_perfil_usuario where id_sistema = 77 and nb_modulo = ".$VO->NB_MODULO." and nb_programa = ".$VO->NB_PROGRAMA." and id_usuario = ".$VO->ID_USUARIO;

		return $this->sqlVetor($query);
			
	}
}
?>