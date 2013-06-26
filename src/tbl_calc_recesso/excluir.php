<?php
require_once "../../php/define.php";
require_once $path . "src/tbl_calc_recesso/arrays.php";
require_once $pathvo . "tbl_calc_recessoVO.php";

$modulo = 80;
$programa = 6;
$pasta = 'tbl_calc_recesso';
$current = 3;
$titulopage = 'Tabela de Cálculo do Recesso';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
if ($_SESSION['ID_TABELA_RECESSO']){
	$VO = new tbl_calc_recessoVO();
	$VO->ID_TABELA_RECESSO = $_SESSION['ID_TABELA_RECESSO'];

	$retorno = $VO->excluir();

	if (!$retorno){
		$msg = 'A '.$titulopage.' foi excluída com sucesso.<br><br> <a href="'.$url.'src/'.$pasta.'/index.php">Clique aqui</a> para voltar';
		unset($_SESSION['ID_TABELA_RECESSO']);
	}else{
		$msg = 'Este registro não pode ser excluído pois possui dependentes.<br />
                    <a href="'.$url.'src/'.$pasta.'/detail.php">clique aqui</a> para voltar';
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