<?php

require_once "../../php/define.php";
require_once $path . "src/solicitacao/arrays.php";
require_once $pathvo . "solicitacaoVO.php";

$modulo = 79;
$programa = 3;
$pasta = 'solicitacao';
$current = 2;
$titulopage = 'Oferta de Vaga';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new solicitacaoVO();

if ($_SESSION['ID_OFERTA_VAGA']) {

    $VO->ID_OFERTA_VAGA = $_SESSION['ID_OFERTA_VAGA'];

    if ($_POST['BT_EFETIVAR']) {
        $VO->efetivarOferta();
        $VO->gerarPDF();
        $VO->enviarEmailEfetivado();
        $_SESSION['OFERTA_MSG'] = '*Oferta de Vaga Efetiva com sucesso!';
        header("Location: " . $url . "src/" . $pasta . "/detail.php");
        exit;
    }

    if ($_POST['BT_ENCAMINHAR']) {
        $VO->encaminharOferta();
        $VO->enviarEmailAgencia();
        $_SESSION['OFERTA_MSG'] = '*Oferta de Vaga Encaminhada para Agência de Estágio com sucesso!';
        header("Location: " . $url . "src/" . $pasta . "/detail.php");
        exit;
    }

    $total = $VO->buscar();
    $dados = $VO->getVetor();

    $smarty->assign("msg", $_SESSION['OFERTA_MSG']);
    unset($_SESSION['OFERTA_MSG']);
}
else
    header("Location: " . $url . "src/" . $pasta . "/index.php");


$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("dados", $dados);
$smarty->assign("gestor", $VO->verficarGestor());
$smarty->assign("acessoEfetivado", $acessoEfetivado);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("arquivoCSS", $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("arquivoJS", $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>