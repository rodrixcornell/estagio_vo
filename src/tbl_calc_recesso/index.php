<?php

require_once "../../php/define.php";
require_once $path . "src/tbl_calc_recesso/arrays.php";
require_once $pathvo . "tbl_calc_recessoVO.php";

$modulo = 80;
$programa = 6;
$pasta = 'tbl_calc_recesso';
$current = 3;
$titulopage = 'Tabela de Cálculo do Recesso';

require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new tbl_calc_recessoVO();
$VO->preencherVOSession($_SESSION);

$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("VO", $VO);
$smarty->assign("arquivoCSS", $pasta);
$smarty->assign("arquivoJS", $pasta);
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>
