<?php

require_once "../../php/define.php";
require_once $path . "src/instituicao/arrays.php";
require_once $pathvo . "instituicaoVO.php";

$modulo = 78;
$programa = 6;
$pasta = 'instituicao';
$current = 1;
$titulopage = 'Instituição de Ensino';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new instituicaoVO();

if ($_SESSION['ID_INSTITUICAO_ENSINO']) {

    $VO->ID_INSTITUICAO_ENSINO = $_SESSION['ID_INSTITUICAO_ENSINO'];
    $VO->TX_INSTITUICAO_ENSINO = $_SESSION['TX_INSTITUICAO_ENSINO'];

    $VO->buscar();
    $VO->preencherVOBD($VO->getVetor());

    if ($_POST) {
        $VO->configuracao();
        $VO->setCaracteristica('TX_INSTITUICAO_ENSINO,TX_SIGLA', 'obrigatorios');

        $validar = $VO->preencher($_POST);


        if (!$validar) {

            $VO->alterar();
            $_SESSION['ID_INSTITUICAO_ENSINO'] = $VO->ID_INSTITUICAO_ENSINO;
            $_SESSION['TX_INSTITUICAO_ENSINO'] = $VO->TX_INSTITUICAO_ENSINO;
            $_SESSION['TX_SIGLA'] = $VO->TX_SIGLA;
            $_SESSION['STATUS'] = '*Registro alterado com sucesso!';
            $_SESSION['PAGE'] = '1';

            header("Location: " . $url . "src/" . $pasta . "/index.php");
        }
    }
}else
    header("Location: " . $url . "src/" . $pasta . "/index.php");

$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("validar", $validar);
$smarty->assign("VO", $VO);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("arquivoCSS", $pasta);
$smarty->assign("arquivoJS", $pasta);
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>