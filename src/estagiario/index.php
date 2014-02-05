<?php
require_once "../../php/define.php";
require_once $pathvo."estagiarioVO.php";

$modulo = 79;
$programa = 2;
$pasta = 'estagiario';
$current = 2;
$titulopage = 'Estagiário';

require_once "../autenticacao/validaPermissao.php";

$VO = new estagiarioVO();
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
