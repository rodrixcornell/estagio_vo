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

//Iniciando Instância
$VO = new selecaoVO();
if ($_SESSION['ID_SELECAO_ESTAGIO']) {

    $VO->ID_SELECAO_ESTAGIO = $_SESSION['ID_SELECAO_ESTAGIO'];

    if ($_POST['BT_EFETIVAR']) {
        $VO->efetivarSelecao();
        $VO->enviarEmailEfetivado();
        $_SESSION['OFERTA_MSG'] = '*Seleção de Candidato Efetiva com sucesso!';
        header("Location: " . $url . "src/" . $pasta . "/detail.php");
        exit;
    }
//
    if ($_POST['BT_ENCAMINHAR']) {
        $VO->encaminharSelecao();
        $VO->enviarEmailAgencia();
        $VO->autorizarSelecao();
        $_SESSION['OFERTA_MSG'] = '*Oferta de Vaga Encaminhada para Agência de Estágio com sucesso!';
        header("Location: " . $url . "src/" . $pasta . "/detail.php");
        exit;
    }

    $total = $VO->buscar();
    $total ? $dados = $VO->getVetor() : false;


    $smarty->assign("msg", $_SESSION['OFERTA_MSG']);
    unset($_SESSION['OFERTA_MSG']);
//
//    //Se continuar Fluxo no Contrato bloquear a tela
    //$contrato = $VO->verificarContrato();
//    if ($contrato) $smarty->assign("acesso", 0);
//

//
//    if ($_POST['efetivar']) {
//        if (!$VO->verificarSituacaoAnalise()) {
//            $VO->efetivar();
//            header("Location: " . $url . "src/" . $pasta . "/detail.php");
//            exit;
//        }
//        else
//            $erro = '<script>alert("A seleção não pode ser efetivada pois existe(m) candidatos em análise!")</script>';
//
//    }
} else
    header("Location: " . $url . "src/" . $pasta . "/index.php");

$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("dados", $dados);
$smarty->assign("gestor", $VO->verficarGestor());
//$smarty->assign("censo", $censo);
$smarty->assign("erro", $erro);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("arquivoCSS", $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("arquivoJS", $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>