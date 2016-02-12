<?php

require_once "../../php/define.php";
require_once $path . "src/selecao/arrays.php";
require_once $pathvo . "selecaoVO.php";

$modulo = 79;
$programa = 6;
$pasta = 'selecao';
$current = 2;
$titulopage = 'Seleção de Estagiário';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new selecaoVO();

if ($_SESSION['ID_SELECAO_ESTAGIO']) {

    $VO->ID_SELECAO_ESTAGIO = $_SESSION['ID_SELECAO_ESTAGIO'];
    $VO->buscar();
    $VO->preencherVOBD($VO->getVetor());

    $contrato = $VO->verificarContrato();

    if ($_POST) {
        $VO->configuracao();
        $VO->setCaracteristica('CS_SITUACAO', 'obrigatorios');
        //$VO->setCaracteristica('DT_AGENDAMENTO,DT_REALIZACAO', 'datas');
        $validar = $VO->preencher($_POST);

        if (!$validar) {
            $VO->alterar();
            header("Location: " . $url . "src/" . $pasta . "/detail.php");
        }
    }
}
else
    header("Location: " . $url . "src/" . $pasta . "/index.php");

$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("validar", $validar);
$smarty->assign("contrato", $contrato);
$smarty->assign("VO", $VO);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("arquivoCSS", $pasta);
$smarty->assign("arquivoJS", $pasta);
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>