<?php

require_once "../../php/define.php";
require_once $path . "src/transferencia/arrays.php";
require_once $pathvo . "transferenciaVO.php";

$modulo = 79;
$programa = 4;
$pasta = 'transferencia';
$current = 2;
$titulopage = 'Transferência de Vagas';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
if ($_SESSION['ID_TRANSFERENCIA_ESTAGIO']){
	$VO = new transferenciaVO();
	$VO->ID_TRANSFERENCIA_ESTAGIO = $_SESSION['ID_TRANSFERENCIA_ESTAGIO'];

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