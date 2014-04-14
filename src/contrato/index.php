<?php
require_once "../../php/define.php";
require_once $path."src/contrato/arrays.php";
require_once $pathvo."contratoVO.php";

$modulo = 79;
$programa = 7;
$pasta = 'contrato';
$current = 2;
$titulopage = 'Contrato de Estágio';

require_once "../autenticacao/validaPermissao.php";

$VO = new contratoVO();
$VO->preencherVOSession($_SESSION);

// Se houver valor na sessão do ID_ORGAO_ESTAGIO ENTÃO IMPRIMA NO COMBO BOX O VALOR CORRETO
if($VO->ID_ORGAO_ESTAGIO){
		$codigo = explode('_', $VO->ID_ORGAO_ESTAGIO);
		$VO->ID_ORGAO_ESTAGIO = $codigo[0];

        $VO->buscarCodSelecaoIndex();
		$smarty->assign('arrayCodSelecao', $VO->getArray('TX_COD_SELECAO'));

		$VO->ID_ORGAO_ESTAGIO = implode('_', $codigo);
}

$smarty->assign("current"       , $current);
$smarty->assign("pasta"         , $pasta);
$smarty->assign("titulopage"    , $titulopage);
$smarty->assign("VO"      		, $VO);
$smarty->assign("arquivoCSS"    , $pasta);
$smarty->assign("arquivoJS"     , $pasta);
$smarty->assign("nomeArquivo"   , $pasta."/".$nomeArquivo.".tpl");	
$smarty->display('index.tpl');
?>
