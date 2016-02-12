<?php
require_once "../../php/define.php";
require_once $path . "src/quadro_vagas/arrays.php";
require_once $pathvo . "quadro_vagasVO.php";

$modulo = 78;
$programa = 9;
$pasta = 'quadro_vagas';
$current = 1;
$titulopage = 'Quadro de Vagas';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new quadro_vagasVO();

if ($_SESSION['ID_QUADRO_VAGAS_ESTAGIO']) {

    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];

    $total = $VO->buscar();
    $total ? $dados = $VO->getVetor() : false;
	
	//Arrays
	$VO->pesquisarTipo();
	$smarty->assign("pesquisarTipo", $VO->getArray("TX_TIPO_VAGA_ESTAGIO"));
	
	$VO->pesquisaCursos();
	$smarty->assign("pesquisaCursos", $VO->getArray("TX_CURSO_ESTAGIO"));
	
	$VO->orgao_Solicitante();
	$smarty->assign("orgao_Solicitante", $VO->getArray("TX_ORGAO_ESTAGIO"));

	
}else
    header("Location: " . $url . "src/" . $pasta . "/index.php");


$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("dados", $dados);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("arquivoCSS", $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("arquivoJS", $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>