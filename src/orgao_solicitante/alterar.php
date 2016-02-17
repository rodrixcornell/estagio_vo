<?php

require_once "../../php/define.php";
require_once $path . "src/orgao_solicitante/arrays.php";
require_once $pathvo . "orgao_solicitanteVO.php";

$modulo = 78;
$programa = 2;
$pasta = 'orgao_solicitante';
$current = 1;
$titulopage = 'Órgão Solicitante';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new orgao_solicitanteVO();

if ($_SESSION['ID_ORGAO_ESTAGIO']) {

    $VO->ID_ORGAO_ESTAGIO = $_SESSION['ID_ORGAO_ESTAGIO'];
    $VO->buscar();
    $VO->preencherVOBD($VO->getVetor());

    if ($_POST) {
        $VO->configuracao();
        $VO->setCaracteristica('TX_ORGAO_ESTAGIO,ID_UNIDADE_ORG', 'obrigatorios');
        $VO->setCaracteristica('TX_CNPJ', 'cnpjs');
        $validar = $VO->preencher($_POST);

        if (!$validar) {
            $VO->alterar();
            header("Location: " . $url . "src/" . $pasta . "/detail.php");
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