<?php
require_once "../../php/define.php";
require_once $pathvo."eventosVO.php";

$modulo = 80;
$programa = 2;
$pasta = 'eventos';
$current = 3;
$titulopage = 'Evento de Pagamento';


session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
if ($_SESSION['ID_ITEM_PAGAMENTO_ESTAGIO']){
	$VO = new eventosVO();

	$VO->ID_ITEM_PAGAMENTO_ESTAGIO = $_SESSION['ID_ITEM_PAGAMENTO_ESTAGIO'];
   
	$retorno = $VO->excluir();
			
	if (!$retorno){
		$msg = 'Evento de Pagamento excluído com sucesso.<br><br> <a href="'.$url.'src/'.$pasta.'/index.php">Clique aqui</a> para voltar';	
		unset($_SESSION['ID_ITEM_PAGAMENTO_ESTAGIO']);
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