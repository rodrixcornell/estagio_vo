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

// Iniciando Instância
$VO = new recessoVO();

if ($_SESSION['ID_RECESSO_ESTAGIO']) {

    $VO->ID_RECESSO_ESTAGIO = $_SESSION['ID_RECESSO_ESTAGIO'];
    $VO->buscar();
    $VO->preencherVOBD($VO->getVetor());

    if ($_SESSION['ID_ORGAO_GESTOR_ESTAGIO']) {

        $VO->buscarOrgaoGestor();
        $arrayOrgaoGestor = $VO->getArray('TX_ORGAO_GESTOR_ESTAGIO');
        $smarty->assign("arrayOrgaoGestor", $arrayOrgaoGestor);
    }


    if ($VO->ID_ORGAO_ESTAGIO) {
        $codigo = explode('_', $VO->ID_ORGAO_GESTOR_ESTAGIO);
        $VO->ID_ORGAO_GESTOR_ESTAGIO = $codigo[0];
        $VO->pesquisarOrgaoSolicitante();
        $arrayOrgaoSolicitante = $VO->getArray("TX_ORGAO_ESTAGIO");
        $smarty->assign("arrayOrgaoSolicitante", $arrayOrgaoSolicitante);

        $VO->buscarContrato();
        $arrayContrato = $VO->getArray('TX_CONTRATO');
        $smarty->assign('arrayContrato', $arrayContrato);
        $VO->ID_ORGAO_GESTOR_ESTAGIO = implode('_', $codigo);
    }



    if ($_POST) {
        $VO->configuracao();
        $VO->setCaracteristica('TX_CARGO_AGENTE,TX_EMAIL_AGENTE,TX_TELEFONE_AGENTE,DT_INICIO_VIG_ESTAGIO,DT_FIM_VIGENCIA_ESTAGIO,ID_AGENCIA_ESTAGIO,NB_ANO_REFERENCIA,NB_MES_REFERENCIA,DT_INICIO_RECESSO,DT_FIM_RECESSO,ID_SETORIAL_ESTAGIO,TX_CHEFIA_IMEDIATA,CS_REALIZACAO', 'obrigatorios');
        $validar = $VO->preencher($_POST);
//        print_r($validar);
        if (!$validar) {
            $VO->alterar();
            $_SESSION['ID_RECESSO_ESTAGIO'] = $VO->ID_RECESSO_ESTAGIO;
            $_SESSION['STATUS'] = '*Registro alterado com sucesso!';
            $_SESSION['PAGE'] = '1';
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