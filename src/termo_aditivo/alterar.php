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

// Iniciando Instância
$VO = new termo_aditivoVO();

if ($_SESSION['ID_ADITIVO_CONTRATO_CP']) {

    $VO->ID_ADITIVO_CONTRATO_CP = $_SESSION['ID_ADITIVO_CONTRATO_CP'];

//preenche os dados para visualizar no alterar
    $VO->buscar();
    $VO->preencherVOBD($VO->getVetor());

    if ($_POST) {
        $VO->configuracao();
        $VO->setCaracteristica('ID_ORGAO_GESTOR_ESTAGIO,ID_AGENCIA_ESTAGIO,TX_OBJETO,TX_TERMO_ADITIVO', 'obrigatorios');
        $VO->setCaracteristica('DT_ADITIVO,DT_INICIO_VIGENCIA,DT_FIM_VIGENCIA', 'datas');
        $validar = $VO->preencher($_POST);

        if (!$validar) {
            $VO->alterar();
            $_SESSION['ID_ORGAO_GESTOR_ESTAGIO'] = $VO->ID_ORGAO_GESTOR_ESTAGIO;
            $_SESSION['ID_AGENCIA_ESTAGIO'] = $VO->ID_AGENCIA_ESTAGIO;
            $_SESSION['TX_OBJETO'] = $VO->TX_OBJETO;
            $_SESSION['TX_TERMO_ADITIVO'] = $VO->TX_TERMO_ADITIVO;
            $_SESSION['DT_ADITIVO'] = $VO->DT_ADITIVO;
            $_SESSION['DT_INICIO_VIGENCIA'] = $VO->DT_INICIO_VIGENCIA;
            $_SESSION['DT_FIM_VIGENCIA'] = $VO->DT_FIM_VIGENCIA;
            $_SESSION['DT_ATUALIZACAO'] = $VO->DT_ATUALIZACAO;
            $_SESSION['ID_USUARIO_ATUALIZACAO'] = $VO->ID_USUARIO_ATUALIZACAO;
            $_SESSION['STATUS'] = '*Registro alterado com sucesso!';
            $_SESSION['PAGE'] = '1';
            header("Location: " . $url . "src/" . $pasta . "/index.php");
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