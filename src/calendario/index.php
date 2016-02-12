<?php

require_once "../../php/define.php";
require_once $path . "src/calendario/arrays.php";
require_once $pathvo . "calendarioVO.php";

$modulo = 80;
$programa = 9;
$pasta = 'calendario';
$current = 3;
$titulopage = 'Calendário da Folha de Pagamento de Estágio';

require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new calendarioVO();
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
