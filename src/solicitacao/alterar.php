<?php
require_once "../../php/define.php";
require_once $path . "src/solicitacao/arrays.php";
require_once $pathvo . "solicitacaoVO.php";

$modulo = 79;
$programa = 3;
$pasta = 'solicitacao';
$current = 2;
$titulopage = 'Oferta de Vaga';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new solicitacaoVO();

if ($_SESSION['ID_SOLICITACAO_ESTAGIO']) {

    $VO->ID_SOLICITACAO_ESTAGIO = $_SESSION['ID_SOLICITACAO_ESTAGIO'];
    $VO->buscar();
    $VO->preencherVOBD($VO->getVetor());
	
	$recrutamento = $VO->verificarRecrutamento();
	
    if ($VO->ID_ORGAO_ESTAGIO) {
        $VO->buscarAgenciaEstagio();
        $smarty->assign("arrayAgenciaEstagio", $VO->getArray("TX_AGENCIA_ESTAGIO"));
		
		if ($VO->ID_AGENCIA_ESTAGIO) {
        	$VO->buscarQuadroVagasEstagio();
        	$smarty->assign("arrayQuadroVagasEstagio", $VO->getArray("TX_CODIGO"));
		}
    }

    if ($_POST) {
        $VO->configuracao();
		if (!$recrutamento) $VO->setCaracteristica('CS_SITUACAO', 'obrigatorios');
        $validar = $VO->preencher($_POST);
		
		$tamanho_just = strlen($_POST['TX_JUSTIFICATIVA']);

		if ($tamanho_just > 255) {
			$validar['TX_JUSTIFICATIVA'] = 'Valor máximo de 255 caracteres, atual de: ' . $tamanho_just;
		} else if (!$validar) {
			$id_pk = $VO->alterar();
			header("Location: " . $url . "src/" . $pasta . "/detail.php");
    	}
	}
}else
    header("Location: " . $url . "src/" . $pasta . "/index.php");

$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("validar", $validar);
$smarty->assign("recrutamento", $recrutamento);
$smarty->assign("VO", $VO);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("arquivoCSS", $pasta);
$smarty->assign("arquivoJS", $pasta);
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>