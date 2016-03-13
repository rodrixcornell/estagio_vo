<?php
require_once "../../php/define.php";
require_once $pathvo."instituicao_estagioVO.php";

$modulo = 78;
$programa = 7;
$pasta = 'instituicao_estagio';
$current = 1;
$titulopage = 'Instituição de Estágio';

require_once "../autenticacao/validaPermissao.php";

$VO = new instituicao_estagioVO();
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
