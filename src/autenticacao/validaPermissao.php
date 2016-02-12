<?php
//require_once "../../../php/define.php";
require_once $pathvo."usuarioVO.php";

$VO = new usuarioVO();

$VO->NB_MODULO = $modulo;
$VO->NB_PROGRAMA = $programa;
$VO->ID_USUARIO = $_SESSION['ID_USUARIO'];

$total = $VO->verificaPermissao();
$nivel = $VO->getVetor();

if (!$total){
	$smarty->assign("current" 	, $current);
	$smarty->assign("nomeArquivo" 	, "sempermissao.tpl");
	$smarty->display('index.tpl');
	exit;
}else{
	$nomeTela[1] = 'cadastrar';
	$nomeTela[2] = 'alterar';
	$nomeTela[3] = 'excluir';

	if(array_search($nomeArquivo, $nomeTela) && !$nivel['CS_NIVEL_ACESSO'][0]){
		$smarty->assign("current" 	, $current);
		$smarty->assign("nomeArquivo" 	, "sempermissao.tpl");
		$smarty->display('index.tpl');
		exit;
	}
	
	$acesso = $nivel['CS_NIVEL_ACESSO'][0];
	$smarty->assign("acesso" 	, $nivel['CS_NIVEL_ACESSO'][0]);
}
?>