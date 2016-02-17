<?php
require_once "../../php/define.php";
require_once $path . "src/tbl_calc_recesso/arrays.php";
require_once $pathvo . "tbl_calc_recessoVO.php";

$modulo = 80;
$programa = 6;
$pasta = 'tbl_calc_recesso';
$current = 3;
$titulopage = 'Tabela de Cálculo do Recesso';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new tbl_calc_recessoVO();

if ($_SESSION['ID_TABELA_RECESSO']) {

    $VO->ID_TABELA_RECESSO = $_SESSION['ID_TABELA_RECESSO'];

    $total = $VO->buscar();
    if ($total) {
        $dados = $VO->getVetor();
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