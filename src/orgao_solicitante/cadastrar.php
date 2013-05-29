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

unset($_SESSION['ID_ORGAO_ESTAGIO']);

// Iniciando Instância
$VO = new orgao_solicitanteVO();

if ($_POST) {
    $VO->configuracao();
    $VO->setCaracteristica('TX_ORGAO_ESTAGIO,ID_UNIDADE_ORG', 'obrigatorios');
    $validar = $VO->preencher($_POST);

    (!$validar) ? $id_pk = $VO->inserir() : false;

    if ($id_pk) {
        $_SESSION['ID_ORGAO_ESTAGIO'] = $id_pk;
        header("Location: " . $url . "src/" . $pasta . "/detail.php");
    }
}

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