
<?php

require_once "../../php/define.php";
require_once $path . "src/ta_contrato/arrays.php";
require_once $pathvo . "ta_contratoVO.php";

$modulo = 80;
$programa = 7;
$pasta = 'ta_contrato'; 
$current = 3;
$titulopage = 'Solicitação de Termo Aditivo de Contrato';

require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new ta_contratoVO();
$VO->preencherVOSession($_SESSION);
/*
if($_SESSION['ID_SOLICITACAO_TA_CP']){
	$VO->ID_ORGAO_ESTAGIO = $_SESSION['ID_ORGAO_ESTAGIO'];
	$VO->buscarAgenciaEstagio();
	$arrayAgenciaEstagio =$VO->getArray('TX_AGENCIA_ESTAGIO');
	$smarty->assign('arrayAgenciaEstagio',	$arrayAgenciaEstagio);
}
*/

$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("VO", $VO);
$smarty->assign("arquivoCSS", $pasta);
$smarty->assign("arquivoJS", $pasta);
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>
