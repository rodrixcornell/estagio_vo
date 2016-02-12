<?php
require_once "../../php/define.php";
require_once $pathvo."agente_setorialVO.php";

$modulo = 78;
$programa = 3;
$pasta = 'agente_setorial';
$current = 1;
$titulopage = 'Agente Setorial';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
if ($_SESSION['ID_SETORIAL_ESTAGIO']){
	$VO = new agente_setorialVO();
	$VO->ID_SETORIAL_ESTAGIO = $_SESSION['ID_SETORIAL_ESTAGIO'];
	
	$retorno = $VO->excluir();
			
	if (!$retorno){
		$msg = 'Agente setorial excluído com sucesso.<br><br> <a href="'.$url.'src/'.$pasta.'/index.php">Clique aqui</a> para voltar';	
		unset($_SESSION['ID_RESP_UNID_IRP']);
	}else{
		$msg = 'Este registro não pode ser excluído pois possui dependentes.<br /> <a href="'.$url.'src/'.$pasta.'/detail.php">clique aqui</a> para voltar';
	}
}else
    header("Location: ".$url."src/".$pasta."/index.php");

$smarty->assign("current"       , $current);
$smarty->assign("pasta"         , $pasta);
$smarty->assign("titulopage"    , $titulopage);
$smarty->assign("msg"           , $msg);
$smarty->assign("arquivoCSS"    , $pasta);
$smarty->assign("arquivoJS"     , $pasta);
$smarty->assign("nomeArquivo"   , $pasta."/".$nomeArquivo.".tpl");	
$smarty->display('index.tpl');
?>