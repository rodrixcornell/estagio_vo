<?php
require_once "../../php/define.php";
require_once $path."src/recesso/arrays.php";
require_once $pathvo."recessoVO.php";

$modulo = 79;
$programa = 9;
$pasta = 'recesso';
$current = 2;
$titulopage = 'Recesso';

require_once "../autenticacao/validaPermissao.php";

$VO = new recessoVO();
$VO->preencherVOSession($_SESSION);

if($_SESSION['ID_ORGAO_GESTOR_ESTAGIO']){
    
    $VO->pesquisarOrgaoSolicitante();
    $arrayOrgaoSolicitante = $VO->getArray("TX_ORGAO_ESTAGIO"); 
    $smarty->assign("arrayOrgaoSolicitante"    	, $arrayOrgaoSolicitante);
}


$smarty->assign("current"       , $current);
$smarty->assign("titulopage"    , $titulopage);
$smarty->assign("pasta"         , $pasta);
$smarty->assign("VO"      		, $VO);
$smarty->assign("arquivoCSS"    , $pasta);
$smarty->assign("arquivoJS"     , $pasta);
$smarty->assign("nomeArquivo"   , $pasta."/".$nomeArquivo.".tpl");	
$smarty->display('index.tpl');
?>
