<?php
require_once "../../php/define.php";
require_once $path."src/grupo_pagamento/arrays.php";
require_once $pathvo."grupo_pagamentoVO.php";

$modulo = 80;
$programa = 8;
$pasta = 'grupo_pagamento';
$current = 3;
$titulopage = 'Grupo de Pagamento';

require_once "../autenticacao/validaPermissao.php";

$VO = new grupo_pagamentoVO();
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
