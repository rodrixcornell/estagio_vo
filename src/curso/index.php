<?php
require_once "../../php/define.php";
require_once $path."src/curso/arrays.php";
require_once $pathvo."cursoVO.php";

$modulo = 78;
$programa = 5;
$pasta = 'curso';
$current = 1;
$titulopage = 'Curso';

require_once "../autenticacao/validaPermissao.php";

$VO = new cursoVO();
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
