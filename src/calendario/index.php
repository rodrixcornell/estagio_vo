<?php

require_once "../../php/define.php";
require_once $path . "src/transferencia/arrays.php";
require_once $pathvo . "transferenciaVO.php";

$modulo = 79;
$programa = 3;
$pasta = 'transferencia';
$current = 2;
$titulopage = 'Transferência de Vagas';

require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new transferenciaVO();
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
