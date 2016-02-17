<?php
require_once "../../php/define.php";
require_once $path."src/agente_setorial/arrays.php";
require_once $pathvo."agente_setorialVO.php";

$modulo = 78;
$programa = 3;
$pasta = 'agente_setorial';
$current = 1;
$titulopage = 'Agente Setorial';

require_once "../autenticacao/validaPermissao.php";

$VO = new agente_setorialVO();
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
