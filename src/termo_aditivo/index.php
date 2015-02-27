<?php
require_once "../../php/define.php";
require_once $path."src/termo_aditivo/arrays.php";
require_once $pathvo."termo_aditivoVO.php";

$modulo = 80;
$programa = 5;
$pasta = 'termo_aditivo';
$current = 3;
$titulopage = 'Termo Aditivo de Contrato';

require_once "../autenticacao/validaPermissao.php";

$VO = new termo_aditivoVO();
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
