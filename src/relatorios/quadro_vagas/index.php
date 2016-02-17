<?php
require_once "../../../php/define.php";
require_once $path . "src/relatorios/quadro_vagas/arrays.php";
require_once $pathvo . "quadro_vagasVO.php";

$modulo = 81;
$programa = 1;
$pasta = 'quadro_vagas';
$current = 4;
$titulopage = 'Quadro de Vagas';

require_once "../../autenticacao/validaPermissao.php";

session_start();
$_SESSION['ID_AGENCIA_ESTAGIO'] = '';

if ($_POST) {
	$VO = new quadro_vagasVO();
	$VO->setCaracteristica('ID_AGENCIA_ESTAGIO', 'obrigatorios');
	$validar = $VO->preencher($_POST);

	if (!$validar) {

		$_SESSION['ID_AGENCIA_ESTAGIO'] = $VO->ID_AGENCIA_ESTAGIO;
		header("Location: " . $url . "src/relatorios/" . $pasta . "/relatorio.php");
	}
}

$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("validar", $validar);
$smarty->assign("VO", $VO);
$smarty->assign("arquivoJS", $pasta);
$smarty->assign("nomeArquivo", "relatorios/" . $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>