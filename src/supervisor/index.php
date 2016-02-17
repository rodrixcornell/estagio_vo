<?php
require_once "../../php/define.php";
require_once $pathvo."supervisorVO.php";

$modulo = 78;
$programa = 8;
$pasta = 'supervisor';
$current = 1;
$titulopage = 'Supervisor de Estágio';

require_once "../autenticacao/validaPermissao.php";

$VO = new supervisorVO();
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
