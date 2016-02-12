<?php
require_once "../../php/define.php";
require_once $path."src/eventos/arrays.php";
require_once $pathvo."eventosVO.php";

$modulo = 80;
$programa = 2;
$pasta = 'eventos';
$current = 3;
$titulopage = 'Evento de Pagamento';

require_once "../autenticacao/validaPermissao.php";

$VO = new eventosVO();
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
