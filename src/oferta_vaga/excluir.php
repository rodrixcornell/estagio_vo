<?php
require_once "../../php/define.php";
require_once $path . "src/oferta_vaga/arrays.php";
require_once $pathvo . "oferta_vagaVO.php";

$modulo = 79;
$programa = 3;
$pasta = 'oferta_vaga';
$current = 2;
$titulopage = 'Oferta de Vaga';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
if ($_SESSION['ID_OFERTA_VAGA']){
	$VO = new oferta_vagaVO();
	$VO->ID_OFERTA_VAGA = $_SESSION['ID_OFERTA_VAGA'];

	$retorno = $VO->excluir();

	if (!$retorno){
		$msg = 'A '.$titulopage.' foi excluída com sucesso.<br><br> <a href="'.$url.'src/'.$pasta.'/index.php">Clique aqui</a> para voltar';
		unset($_SESSION['ID_OFERTA_VAGA']);
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