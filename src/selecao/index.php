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

$smarty->assign("current"       , $current);
$smarty->assign("pasta"         , $pasta);
$smarty->assign("titulopage"    , $titulopage);
$smarty->assign("VO"      		, $VO);
$smarty->assign("arquivoCSS"    , $pasta);
$smarty->assign("arquivoJS"     , $pasta);
$smarty->assign("nomeArquivo"   , $pasta."/".$nomeArquivo.".tpl");	
$smarty->display('index.tpl');
?>
