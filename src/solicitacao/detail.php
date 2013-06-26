<?php
require_once "../../php/define.php";
require_once $path . "src/solicitacao/arrays.php";
require_once $pathvo . "solicitacaoVO.php";

$modulo = 79;
$programa = 3;
$pasta = 'solicitacao';
$current = 2;
$titulopage = 'Solicitação de Estagiário';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new solicitacaoVO();

if ($_SESSION['ID_SOLICITACAO_ESTAGIO']) {

    $VO->ID_SOLICITACAO_ESTAGIO = $_SESSION['ID_SOLICITACAO_ESTAGIO'];

	if ($_POST['efetivar']){
	  $VO->efetivarSolicitacao(); 
	  header("Location: ".$url."src/".$pasta."/detail.php");
	}	

    $total = $VO->buscar();
    $dados = $VO->getVetor();
	
	if ($dados['CS_SITUACAO'][0] == 2){
	   $acessoEfetivado = 1;
	} 	
	
	$VO->preencherVOBD($dados);
	
 	$VO->pesquisarTipoVaga();
	$smarty->assign("arrayTipoVaga", $VO->getArray("TX_TIPO_VAGA_ESTAGIO"));
	
	$VO->buscarCursos();
	$smarty->assign("arrayCurso", $VO->getArray("TX_CURSO_ESTAGIO"));
}else
    header("Location: " . $url . "src/" . $pasta . "/index.php");


$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("dados", $dados);
$smarty->assign("acessoEfetivado", $acessoEfetivado);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("arquivoCSS", $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("arquivoJS", $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>