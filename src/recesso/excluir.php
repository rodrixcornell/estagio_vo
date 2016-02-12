<?php

require_once "../../php/define.php";
require_once $path . "src/recesso/arrays.php";
require_once $pathvo . "recessoVO.php";

$modulo = 79;
$programa = 9;
$pasta = 'recesso';
$current = 2;
$titulopage = 'Recesso de Estágio';

session_start();
require_once "../autenticacao/validaPermissao.php";

$VO = new recessoVO();

if ($_SESSION['ID_RECESSO_ESTAGIO']) {
	
	$VO->ID_RECESSO_ESTAGIO = $_SESSION['ID_RECESSO_ESTAGIO'];
	
	$retorno = $VO->excluir();
	
	if (!$retorno){
		$msg = 'Recesso de estagio excluído com sucesso.<br><br> <a href="'.$url.'src/'.$pasta.'/index.php">Clique aqui</a> para voltar';	
		unset($_SESSION['ID_RECRUTAMENTO_ESTAGIO']);
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