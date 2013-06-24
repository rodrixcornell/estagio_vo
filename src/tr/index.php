<?php
require_once "../../php/define.php";
require_once $path."src/tr/arrays.php";
require_once $pathvo."trVO.php";

$modulo = 79;
$programa = 8;
$pasta = 'tr';
$current = 2;
$titulopage = 'Solicitação de TR';

require_once "../autenticacao/validaPermissao.php";

$VO = new trVO();
$VO->preencherVOSession($_SESSION);


// Se houver valor na sessão do ID_ORGAO_ESTAGIO ENTÃO IMPRIMA NO COMBO BOX O VALOR CORRETO
if($_SESSION['ID_ORGAO_ESTAGIO']){

        $VO->ID_ORGAO_ESTAGIO=$_SESSION['ID_ORGAO_ESTAGIO'];

        $VO->buscarCodSelecao();
        $arrayCodSelecao =$VO->getArray('TX_COD_SELECAO');


        $smarty->assign('arrayCodSelecao',$arrayCodSelecao);
}

$smarty->assign("current"       , $current);
$smarty->assign("pasta"         , $pasta);
$smarty->assign("titulopage"    , $titulopage);
$smarty->assign("VO"      	, $VO);
$smarty->assign("arquivoCSS"    , $pasta);
$smarty->assign("arquivoJS"     , $pasta);
$smarty->assign("nomeArquivo"   , $pasta."/".$nomeArquivo.".tpl");	
$smarty->display('index.tpl');
?>
