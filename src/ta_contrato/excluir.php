<?php

require_once "../../php/define.php";
require_once $path . "src/ta_contrato/arrays.php";
require_once $pathvo . "ta_contratoVO.php";

$modulo = 80;
$programa = 7;
$pasta = 'ta_contrato';
$current = 3;
$titulopage = 'Solicitação de Termo de Aditivo de Contrato';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
if ($_SESSION['ID_SOLICITACAO_ESTAGIO']){
	$VO = new ta_contratoVO();
	$VO->ID_SOLICITACAO_ESTAGIO = $_SESSION['ID_SOLICITACAO_ESTAGIO'];

	$retorno = $VO->excluir();

	if (!$retorno){
		$msg = 'A '.$titulopage.' foi excluída com sucesso.<br><br> <a href="'.$url.'src/'.$pasta.'/index.php">Clique aqui</a> para voltar';
		unset($_SESSION['ID_RESP_UNID_IRP']);
	}else{
		$msg = 'Este registro não pode ser excluído pois possui dependentes.<br /> <a href="'.$url.'src/'.$pasta.'/detail.php">clique aqui</a> para voltar';
	}
}else
    header("Location: ".$url."src/".$pasta."/index.php");

$smarty->assign("current"       , $current);
$smarty->assign("pasta"         , $pasta);
$smarty->assign("titulopage"    , $titulopage);
$smarty->assign("msg"           , $msg);
$smarty->assign("arquivoCSS"    , $pasta);
$smarty->assign("arquivoJS"     , $pasta);
$smarty->assign("nomeArquivo"   , $pasta."/".$nomeArquivo.".tpl");
$smarty->display('index.tpl');
?>