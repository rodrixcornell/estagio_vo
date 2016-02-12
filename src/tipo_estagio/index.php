<?php
require_once "../../php/define.php";
require_once $path."src/tipo_estagio/arrays.php";
require_once $pathvo."tipo_estagioVO.php";

$modulo = 78;
$programa = 4;
$pasta = 'tipo_estagio';
$current = 1;
$titulopage = 'Tipo de Vaga de Estágio';

require_once "../autenticacao/validaPermissao.php";

$VO = new tipo_estagioVO();
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
