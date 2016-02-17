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
    $VO->buscar();
    $VO->preencherVOBD($VO->getVetor());

    if ($_POST) {
        $VO->configuracao();
        $VO->setCaracteristica('TX_TABELA,ID_ORGAO_GESTOR_ESTAGIO,DT_INICIO_VIGENCIA', 'obrigatorios');
        $VO->setCaracteristica('DT_INICIO_VIGENCIA,DT_FIM_VIGENCIA', 'datas');
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
$smarty->assign("VO", $VO);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("arquivoCSS", $pasta);
$smarty->assign("arquivoJS", $pasta);
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>