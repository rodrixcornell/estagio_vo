<?php
require_once "../../php/define.php";
require_once $path."src/selecao/arrays.php";
require_once $pathvo."selecaoVO.php";

$modulo = 79;
$programa = 6;
$pasta = 'selecao';
$current = 2;
$titulopage = 'Seleção de Estagiário';

require_once "../autenticacao/validaPermissao.php";

$VO = new selecaoVO();
$VO->preencherVOSession($_SESSION);

if($VO->ID_ORGAO_GESTOR_ESTAGIO =  $_SESSION[$modulo.$programa.'_ID_ORGAO_GESTOR_ESTAGIO']){
	
	$VO->buscarSolicitante();
	$smarty->assign('arrayOrgaoSolicitante',	$VO->getArray('TX_ORGAO_ESTAGIO'));
	
	if($VO->ID_ORGAO_ESTAGIO = $_SESSION[$modulo.$programa.'_ID_ORGAO_ESTAGIO']){
		$VO->buscarRecrutamento();
		$smarty->assign('arrayRecrutamento',	$VO->getArray('TX_COD_RECRUTAMENTO'));
	}
}

$smarty->assign("current"       , $current);
$smarty->assign("pasta"         , $pasta);
$smarty->assign("titulopage"    , $titulopage);
$smarty->assign("VO"      		, $VO);
$smarty->assign("arquivoCSS"    , $pasta);
$smarty->assign("arquivoJS"     , $pasta);
$smarty->assign("nomeArquivo"   , $pasta."/".$nomeArquivo.".tpl");	
$smarty->display('index.tpl');
?>
