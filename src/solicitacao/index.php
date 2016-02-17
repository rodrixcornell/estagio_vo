<?php

require_once "../../php/define.php";
require_once $path . "src/solicitacao/arrays.php";
require_once $pathvo . "solicitacaoVO.php";

$modulo = 79;
$programa = 3;
$pasta = 'solicitacao';
$current = 2;
$titulopage = 'Oferta de Vaga';

require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new solicitacaoVO();
$VO->preencherVOSession($_SESSION);

if($_SESSION[$modulo.$programa.'_ID_ORGAO_ESTAGIO']){
	$VO->ID_ORGAO_ESTAGIO = $_SESSION[$modulo.$programa.'_ID_ORGAO_ESTAGIO'];
	$VO->buscarAgenciaEstagio();
	$arrayAgenciaEstagio =$VO->getArray('TX_AGENCIA_ESTAGIO');
	$smarty->assign('arrayAgenciaEstagio',	$arrayAgenciaEstagio);
}

$arraySituacao = array(""=>"Escolha...", 1=>"Aberta", 2=>"Efetivada", 3=>'Oferta Encaminhada', 4=>"Cancelada");

$smarty->assign("current", $current);
$smarty->assign("arraySituacao", $arraySituacao);
$smarty->assign("pasta", $pasta);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("VO", $VO);
$smarty->assign("arquivoCSS", $pasta);
$smarty->assign("arquivoJS", $pasta);
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>
