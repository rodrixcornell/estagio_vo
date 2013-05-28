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
    $VO->buscar();
    $VO->preencherVOBD($VO->getVetor());

    if ($_POST) {
        $VO->configuracao();
        //ID_ORGAO_GESTOR_ESTAGIO, ID_AGENCIA_ESTAGIO, ID_ORGAO_ESTAGIO, TX_COD_SOLICITACAO, CS_SITUACAO, TX_JUSTIFICATIVA, ID_SOLICITACAO_ESTAGIO
        $VO->setCaracteristica('ID_ORGAO_GESTOR_ESTAGIO,ID_AGENCIA_ESTAGIO,ID_ORGAO_ESTAGIO,TX_COD_SOLICITACAO,CS_SITUACAO', 'obrigatorios');
        $validar = $VO->preencher($_POST);

        $tamanho = strlen($_POST['TX_COD_SOLICITACAO']);
        if ($tamanho > 20) {
            $validar['TX_COD_SOLICITACAO'] = 'Valor máximo de 20, atual de: ' . $tamanho;
        } else if (!$validar) {
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