<?php
include "../../php/define.php";
require_once $pathvo."usuarioVO.php";

$usuario = strtoupper($_POST["USU_LOGIN"]);
$senha = $_POST["USU_SENHA"];

if ($_POST['validaLogin']){
	
	if (!$usuario || !$senha)
		$obrigatorio["geral"] = "Usu&aacute;rio e Senha Obrigat&oacute;rios";
	else {
		$tryConnUser = @oci_new_connect($usuario, $senha, $ipBanco);
		if($tryConnUser){
			oci_close($tryConnUser);
			$VO = new usuarioVO();

			//Carrega informacoes do usuario
			$VO->TX_LOGIN = $usuario;
			$VO->carregaUsuario();
			$user = $VO->getVetor();
			
			//Verifica se o usuario esta no sistema estoque e modulos
			$VO->ID_USUARIO = $user['ID_USUARIO'][0];
			$permissaoGrupo = $VO->verificaGrupo();
			
			if ($permissaoGrupo){
				$VO->preencherSession($user);
				$_SESSION['usuario'] = $usuario;
				$_SESSION['senha'] = $senha;
				header("Location: ".$url);
			} else $obrigatorio["geral"] = "Você não tem permissão para acessar este módulo";
			
		}else
			$obrigatorio["geral"] = "Usu&aacute;rio ou Senha Inv&aacute;lidos";
	}
}

$smarty->assign("obrigatorio" 	, $obrigatorio);
$smarty->assign("nomeArquivo" 	, "autenticacao/".$nomeArquivo.".tpl");		
$smarty->assign("arquivoCSS" 	,"autenticacao");
$smarty->assign("arquivoJS" 	,"autenticacao");
$smarty->display('index.tpl');
?>