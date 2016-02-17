<?php
require_once "../../php/define.php";
require_once $path . "src/ta_contrato/arrays.php";
require_once $pathvo . "ta_contratoVO.php";

$modulo = 80;
$programa = 7;
$pasta = 'ta_contrato';
$current = 3;
$titulopage = 'Solicitação de Termo Aditivo de Contrato';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new ta_contratoVO();

if ($_SESSION['ID_SOLICITACAO_TA_CP']) {

    $VO->ID_SOLICITACAO_TA_CP = $_SESSION['ID_SOLICITACAO_TA_CP'];

	if ($_POST['efetivar']){
	  $VO->efetivarSolicitacao();
	  header("Location: ".$url."src/".$pasta."/detail.php");
	}

    $total = $VO->buscar();
    $dados = $VO->getVetor();

	if ($dados['CS_SITUACAO'][0] == 2){
	   $acessoEfetivado = 1;
	}
        //print_r
	($acessoEfetivado);
	$VO->preencherVOBD($dados);

 	$VO->pesquisarTipoVaga();
	$smarty->assign("arrayTipoVaga", $VO->getArray("TX_TIPO_VAGA_ESTAGIO"));

}else
    header("Location: " . $url . "src/" . $pasta . "/detail.php");

//print_r($_SESSION);

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