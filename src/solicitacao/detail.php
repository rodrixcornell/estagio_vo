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

    $total = $VO->buscar();
    if ($total) {
        $dados = $VO->getVetor();

        $_SESSION['ID_ORGAO_ESTAGIO'] = $dados['ID_ORGAO_ESTAGIO'][0];
        $_SESSION['ID_AGENCIA_ESTAGIO'] = $dados['ID_AGENCIA_ESTAGIO'][0];
//        $VO->CS_SITUACAO = $_SESSION['CS_SITUACAO'] = $dados['CS_SITUACAO'][0];
//        $VO->TX_COD_SOLICITACAO = $_SESSION['TX_COD_SOLICITACAO'] = $dados['TX_COD_SOLICITACAO'][0];
        $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'] = $dados['ID_QUADRO_VAGAS_ESTAGIO'][0];

//        $VO->pesquisarTipoVaga();
//        $smarty->assign("arrayTipoVaga", $VO->getArray("TX_TIPO_VAGA_ESTAGIO"));
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