<?php

require_once "../../php/define.php";
require_once $path . "src/recesso/arrays.php";
require_once $pathvo . "recessoVO.php";

$modulo = 79;
$programa = 9;
$pasta = 'recesso';
$current = 2;
$titulopage = 'Recesso de Estágio';

session_start();
require_once "../autenticacao/validaPermissao.php";

$VO = new recessoVO();

if ($_SESSION['ID_RECESSO_ESTAGIO']) {

    $VO->ID_RECESSO_ESTAGIO = $_SESSION['ID_RECESSO_ESTAGIO'];

    if ($_POST['efetivar']) {
        $VO->efetivar();
        header("Location: " . $url . "src/" . $pasta . "/detail.php");
        exit;
    }

    $total = $VO->buscar();
    $total ? $dados = $VO->getVetor() : false;

    if($dados['CS_SITUACAO'][0]==2){
      $smarty->assign("acesso", 0);

    }

}else
    header("Location: " . $url . "src/" . $pasta . "/index.php");

$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("dados", $dados);
$smarty->assign("validar", $validar);
$smarty->assign("VO", $VO);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("arquivoCSS", $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("arquivoJS", $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>