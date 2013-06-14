<?php

require_once "../../php/define.php";
require_once $path . "src/transferencia/arrays.php";
require_once $pathvo . "transferenciaVO.php";

$modulo = 79;
$programa = 3;
$pasta = 'transferencia';
$current = 2;
$titulopage = 'Tanferência  de Vagas';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new transferenciaVO();

if ($_SESSION['ID_SOLICITACAO_ESTAGIO']) {

    $VO->ID_SOLICITACAO_ESTAGIO = $_SESSION['ID_SOLICITACAO_ESTAGIO'];

    $total = $VO->buscar();
    if ($total) {
        $dados = $VO->getVetor();

        $VO->ID_ORGAO_ESTAGIO = $_SESSION['ID_ORGAO_ESTAGIO'] = $dados['ID_ORGAO_ESTAGIO'][0];
        $VO->ID_AGENCIA_ESTAGIO = $_SESSION['ID_AGENCIA_ESTAGIO'] = $dados['ID_AGENCIA_ESTAGIO'][0];
        $VO->CS_SITUACAO = $_SESSION['CS_SITUACAO'] = $dados['CS_SITUACAO'][0];
        $VO->TX_COD_SOLICITACAO = $_SESSION['TX_COD_SOLICITACAO'] = $dados['TX_COD_SOLICITACAO'][0];

        $VO->pesquisarTipoVaga();
        $smarty->assign("arrayTipoVaga", $VO->getArray("TX_TIPO_VAGA_ESTAGIO"));
    }
}else
    header("Location: " . $url . "src/" . $pasta . "/index.php");


$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("dados", $dados);
$smarty->assign("censo", $censo);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("arquivoCSS", $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("arquivoJS", $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>