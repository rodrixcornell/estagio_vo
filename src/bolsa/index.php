<?php
require_once "../../php/define.php";
require_once $path."src/bolsa/arrays.php";
require_once $pathvo."bolsaVO.php";

$modulo = 78;
$programa = 1;
$pasta = 'bolsa';
$current = 3;
$titulopage = 'Bolsa de Estágio';

require_once "../autenticacao/validaPermissao.php";

$VO = new bolsaVO();
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
