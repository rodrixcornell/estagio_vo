<?php

require_once "../../php/define.php";
require_once $path . "src/s_ta/arrays.php";
require_once $pathvo . "s_taVO.php";

$modulo = 79;
$programa = 11;
$pasta = 's_ta';
$current = 2;
$titulopage = 'Solicitação de TA';

session_start();
require_once "../autenticacao/validaPermissao.php";

//Iniciando Instância
$VO = new s_taVO();

if ($_SESSION['ID_SOLICITACAO_TA']) {

    $VO->ID_SOLICITACAO_TA = $_SESSION['ID_SOLICITACAO_TA'];

    $total = $VO->pesquisar();
    $dados = $VO->getVetor();



    $_SESSION['CS_SITUACAO'] = $dados['CS_SITUACAO'][0];
    $_SESSION['ID_CONTRATO'] = $dados['ID_CONTRATO'][0];
    //$_SESSION['ID_ORGAO_ESTAGIO'] = $dados['ID_ORGAO_ESTAGIO'][0];
    $_SESSION['ID_SETORIAL_ESTAGIO'] = $dados['ID_SETORIAL_ESTAGIO'][0];
    $_SESSION['ID_AGENCIA_ESTAGIO'] = $dados['ID_AGENCIA_ESTAGIO'][0];

    if ($dados['CS_SITUACAO'][0] == 2) {
        $acesso = 0;
    }

    if ($_POST['efetivar']) {

        $VO->ID_SOLICITACAO_TA = $dados['ID_SOLICITACAO_TA'][0];

        $VO->EFETIVAR = 2;
        $VO->atualizarInf();
        header("Location: " . $url . "src/" . $pasta . "/detail.php");
    }
}else
    header("Location: " . $url . "src/" . $pasta . "/index.php");


$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("dados", $dados);
$smarty->assign("acesso", $acesso);
$smarty->assign("censo", $censo);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("arquivoCSS", $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("arquivoJS", $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>