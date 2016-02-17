<?php
require_once "../../php/define.php";
require_once $path."src/desligamento/arrays.php";
require_once $pathvo."desligamentoVO.php";

$modulo = 79;
$programa = 10;
$pasta = 'desligamento';
$current = 2;
$titulopage = 'Solicitação de Desligamento';

require_once "../autenticacao/validaPermissao.php";

$VO = new desligamentoVO();
$VO->preencherVOSession($_SESSION);

$smarty->assign("current"       , $current);
$smarty->assign("pasta"         , $pasta);
$smarty->assign("titulopage"    , $titulopage);
$smarty->assign("VO"      	, $VO);
$smarty->assign("arquivoCSS"    , $pasta);
$smarty->assign("arquivoJS"     , $pasta);
$smarty->assign("nomeArquivo"   , $pasta."/".$nomeArquivo.".tpl");	
$smarty->display('index.tpl');
?>
