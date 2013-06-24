<?php
require_once "../../php/define.php";
require_once $path . "src/tr/arrays.php";
require_once $pathvo . "trVO.php";

$modulo = 79;
$programa = 8;
$pasta = 'tr';
$current = 2;
$titulopage = 'Solicitação de TR';

session_start();
require_once "../autenticacao/validaPermissao.php";


$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("validar", $validar);
$smarty->assign("VO", $VO);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("arquivoCSS"    , $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("arquivoJS"     , $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>
