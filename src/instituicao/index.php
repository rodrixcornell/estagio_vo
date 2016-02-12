<?php
require_once "../../php/define.php";
require_once $path . "src/instituicao/arrays.php";
require_once $pathvo . "instituicaoVO.php";

$modulo = 78;
$programa = 6;
$pasta = 'instituicao';
$current = 1;
$titulopage = 'Instituição de Ensino';

require_once "../autenticacao/validaPermissao.php";

$VO = new instituicaoVO();
$VO->preencherVOSession($_SESSION);

$smarty->assign("current", $current);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("pasta", $pasta);
$smarty->assign("VO", $VO);
$smarty->assign("arquivoCSS", $pasta);
$smarty->assign("arquivoJS", $pasta);
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>
