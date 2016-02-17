<?php
require_once "../../php/define.php";
require_once $pathvo."contratoVO.php";

$modulo = 79;
$programa = 7;
$pasta = 'contrato';
$current = 2;
$titulopage = 'Contrato de Estágio';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Se houver valor na sessão do ID_ORGAO_ESTAGIO ENTÃO IMPRIMA NO COMBO BOX O VALOR CORRETO
if($_SESSION['ID_CONTRATO']){
    
        $VO = new contratoVO();

        $VO->ID_CONTRATO=$_SESSION['ID_CONTRATO'];

 	$retorno = $VO->excluir();
			
	if (!$retorno){
		$msg = 'Contrato de Estagio excluído com sucesso.<br><br> <a href="'.$url.'src/'.$pasta.'/index.php">Clique aqui</a> para voltar';	
		unset($_SESSION['ID_CONTRATO']);
	}else{
		$msg = 'Este registro não pode ser excluído pois possui dependentes.<br /> <a href="'.$url.'src/'.$pasta.'/detail.php">clique aqui</a> para voltar';
	}
}else
    header("Location: ".$url."src/".$pasta."/index.php");

$smarty->assign("current"       , $current);
$smarty->assign("pasta"         , $pasta);
$smarty->assign("titulopage"    , $titulopage);
$smarty->assign("VO"      	, $VO);
$smarty->assign("msg"           , $msg);
$smarty->assign("arquivoCSS"    , $pasta);
$smarty->assign("arquivoJS"     , $pasta);
$smarty->assign("nomeArquivo"   , $pasta."/".$nomeArquivo.".tpl");	
$smarty->display('index.tpl');
?>