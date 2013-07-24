<?php

require_once "../../php/define.php";
require_once $pathvo . "s_taVO.php";

$modulo = 79;
$programa = 11;
$pasta = 's_ta';
$current = 2;
$titulopage = 'Solicitação de TA';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
if ($_SESSION['ID_SOLICITACAO_DESLIG']){
	$VO = new s_taVO();
	$VO->ID_SOLICITACAO_DESLIG = $_SESSION['ID_SOLICITACAO_DESLIG'];

	$retorno = $VO->excluir();

	if (!$retorno){
		$msg = 'Solicitação de Desligamento excluído com sucesso.<br><br> <a href="'.$url.'src/'.$pasta.'/index.php">Clique aqui</a> para voltar';
		unset($_SESSION['ID_SOLICITACAO_DESLIG']);
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