<?php
require_once "../../php/define.php";
require_once $pathvo."orgao_solicitanteVO.php";

$modulo = 78;
$programa = 2;
$pasta = 'orgao_solicitante';
$current = 1;
$titulopage = 'Órgão Solicitante';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
if ($_SESSION['ID_ORGAO_ESTAGIO']){
	$VO = new orgao_solicitanteVO();
	$VO->ID_ORGAO_ESTAGIO = $_SESSION['ID_ORGAO_ESTAGIO'];
	
	$retorno = $VO->excluir();
			
	if (!$retorno){
		$msg = 'Órgao Solicitante excluído com sucesso.<br><br> <a href="'.$url.'src/'.$pasta.'/index.php">Clique aqui</a> para voltar';	
		unset($_SESSION['ID_ORGAO_ESTAGIO']);
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