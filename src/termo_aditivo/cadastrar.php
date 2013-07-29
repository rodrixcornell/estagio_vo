<?php

require_once "../../php/define.php";
require_once $path . "src/termo_aditivo/arrays.php";
require_once $pathvo . "termo_aditivoVO.php";

$modulo = 80;
$programa = 5;
$pasta = 'termo_aditivo';
$current = 3;
$titulopage = 'Termo Aditivo de Contrato';

session_start();
require_once "../autenticacao/validaPermissao.php";

unset($_SESSION['ID_ADITIVO_CONTRATO_CP']);

// Iniciando Instância
$VO = new termo_aditivoVO();

if ($_POST) {
    $VO->configuracao();
    $VO->setCaracteristica('ID_ORGAO_GESTOR_ESTAGIO,ID_AGENCIA_ESTAGIO,TX_OBJETO,TX_TERMO_ADITIVO,DT_ADITIVO,DT_INICIO_VIGENCIA,DT_FIM_VIGENCIA', 'obrigatorios');
    $validar = $VO->preencher($_POST);
    print_r($validar);
    (!$validar) ? $id_pk = $VO->inserir() : false;

    if (!$validar) {
        $_SESSION['ID_ORGAO_GESTOR_ESTAGIO'] = $VO->ID_ORGAO_GESTOR_ESTAGIO;
        $_SESSION['ID_AGENCIA_ESTAGIO'] = $VO->ID_AGENCIA_ESTAGIO;
        $_SESSION['NB_CODIGO'] = $VO->NB_CODIGO;
        $_SESSION['TX_OBJETO'] = $VO->TX_OBJETO;
        $_SESSION['TX_TERMO_ADITIVO'] = $VO->TX_TERMO_ADITIVO;
        $_SESSION['DT_ADITIVO'] = $VO->DT_ADITIVO;
        $_SESSION['DT_INICIO_VIGENCIA'] = $VO->DT_INICIO_VIGENCIA;
        $_SESSION['DT_FIM_VIGENCIA'] = $VO->DT_FIM_VIGENCIA;
        $_SESSION['STATUS'] = '*Registro inserido com sucesso!';
        $_SESSION['PAGE'] = '1';
        header("Location: " . $url . "src/" . $pasta . "/index.php");
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