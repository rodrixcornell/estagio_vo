<?php
require_once "../../php/define.php";
require_once $path . "src/tipo_pagamento/arrays.php";
require_once $pathvo . "tipo_pagamentoVO.php";

$modulo = 80;
$programa = 4;
$pasta = 'tipo_pagamento';
$current = 3;
$titulopage = 'Tipo de Pagamento';

require_once "../autenticacao/validaPermissao.php";

$VO = new tipo_pagamentoVO();
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
