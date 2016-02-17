<?php
require_once "../../php/define.php";
require_once $pathvo."agenciaVO.php";

$modulo = 78;
$programa = 7;
$pasta = 'agencia';
$current = 1;
$titulopage = 'Agência de Estágio';

require_once "../autenticacao/validaPermissao.php";

$VO = new agenciaVO();
$VO->preencherVOSession($_SESSION);

$smarty->assign("current"       , $current);
$smarty->assign("titulopage"    , $titulopage);
$smarty->assign("pasta"         , $pasta);
$smarty->assign("VO"      		, $VO);
$smarty->assign("arquivoCSS"    , $pasta);
$smarty->assign("arquivoJS"     , $pasta);
$smarty->assign("nomeArquivo"   , $pasta."/".$nomeArquivo.".tpl");	
$smarty->display('index.tpl');
?>
