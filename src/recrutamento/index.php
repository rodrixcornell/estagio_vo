<?php
require_once "../../php/define.php";
require_once $path."src/recrutamento/arrays.php";
require_once $pathvo."recrutamentoVO.php";

$modulo = 79;
$programa = 5;
$pasta = 'recrutamento';
$current = 2;
$titulopage = 'Recrutamento de Estagiário';

require_once "../autenticacao/validaPermissao.php";

$VO = new recrutamentoVO();
$VO->preencherVOSession($_SESSION);

if($_SESSION[$modulo.$programa.'_ID_ORGAO_GESTOR_ESTAGIO']){
	$VO->ID_ORGAO_GESTOR_ESTAGIO = $_SESSION[$modulo.$programa.'_ID_ORGAO_GESTOR_ESTAGIO'];
	$VO->buscarSolicitante();
	$arrayOrgaoSolicitante =$VO->getArray('TX_ORGAO_ESTAGIO');
	$smarty->assign('arrayOrgaoSolicitante',	$arrayOrgaoSolicitante);
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
