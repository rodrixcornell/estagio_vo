<?php
include "../../php/define.php";

if ($_POST['altera']){
	$senha_atual    = $_REQUEST['senha_atual'];
    $senha_nova     = $_REQUEST['senha_nova'];
    $senha_nova_cfm = $_REQUEST['senha_nova_cfm'];
	
	if($senha_nova==$senha_nova_cfm){
		$tryConnUser = @oci_new_connect($usuario, $senha_atual, $ipBanco);	
		$tryChangePwd = @oci_password_change($tryConnUser,$usuario,$senha_atual,$senha_nova);
		if($tryChangePwd){
			session_destroy();
			session_unset();
			$resultado = "Senha Alterada com Sucesso!!";
		}
		else
			$resultado = "Senha Atual incorreta";
	}else
		$resultado = "Nova senha e confirmação não confere";		
}

$smarty->assign("resultado"		, $resultado);
$smarty->assign("nomeArquivo" 	, "autenticacao/".$nomeArquivo.".tpl");
$smarty->assign("arquivoCSS" 	,"autenticacao");
$smarty->display('index.tpl');
?>