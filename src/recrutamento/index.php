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

$smarty->assign("current"       , $current);
$smarty->assign("pasta"         , $pasta);
$smarty->assign("titulopage"    , $titulopage);
$smarty->assign("VO"      		, $VO);
$smarty->assign("arquivoCSS"    , $pasta);
$smarty->assign("arquivoJS"     , $pasta);
$smarty->assign("nomeArquivo"   , $pasta."/".$nomeArquivo.".tpl");	
$smarty->display('index.tpl');
?>
