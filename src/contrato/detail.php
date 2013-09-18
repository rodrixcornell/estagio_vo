<?php

require_once "../../php/define.php";
require_once $path . "src/contrato/arrays.php";
require_once $pathvo . "contratoVO.php";

$modulo = 79;
$programa = 7;
$pasta = 'contrato';
$current = 2;
$titulopage = 'Contrato de Estágio';

session_start();
require_once "../autenticacao/validaPermissao.php";



$VO = new contratoVO();

if ($_SESSION['ID_CONTRATO']) {

    $VO->ID_CONTRATO = $_SESSION['ID_CONTRATO'];

    $todosCSselecao=$VO->buscarCsSelecao();
    $dadosCSSelecao=$VO->getVetor();
    
    $VO->CS_SELECAO=$dadosCSSelecao['CS_SELECAO'][0];
    
    $total = $VO->buscar();
    $total ? $dados = $VO->getVetor() : false;
}else
    header("Location: " . $url . "src/" . $pasta . "/index.php");

$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("dados", $dados);
$smarty->assign("validar", $validar);
$smarty->assign("VO", $VO);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("arquivoCSS", $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("arquivoJS", $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>