<?php

require_once "../../php/define.php";
require_once $path . "src/s_ta/arrays.php";
require_once $pathvo . "s_taVO.php";

$modulo = 79;
$programa = 11;
$pasta = 's_ta';
$current = 2;
$titulopage = 'Solicitação de TA';

require_once "../autenticacao/validaPermissao.php";

$VO = new s_taVO();
unset($_SESSION['ID_SOLICITACAO_TA']);

if ($_POST) {

    $VO->configuracao();
    //$VO->setCaracteristica('ID_ORGAO_GESTOR_ESTAGIO,ID_ORGAO_ESTAGIO,ID_CONTRATO,ID_SETORIAL_ESTAGIO,TX_CARGO_AGENTE,TX_FONE_AGENTE,TX_EMAIL_AGENTE,TX_MOTIVO_SITUACAO,TX_HORAS_JORNADA,TX_OUTRAS_ALTERACOES', 'obrigatorios');
    $VO->setCaracteristica('ID_ORGAO_GESTOR_ESTAGIO,ID_ORGAO_ESTAGIO,ID_CONTRATO,ID_SETORIAL_ESTAGIO,TX_CARGO_AGENTE,TX_FONE_AGENTE,TX_EMAIL_AGENTE,TX_MOTIVO_SITUACAO,TX_HORAS_JORNADA,TX_OUTRAS_ALTERACOES,DT_INICIO_PRORROGACAO,DT_FIM_PRORROGACAO,DT_INICIO_RECESSO,DT_FIM_RECESSO,DT_INICIO_JORNADA,DT_INICIO_PAG_BOLSA,TX_INICIO_HORARIO,TX_FIM_HORARIO,NB_VALOR_BOLSA', 'obrigatorios');
    $VO->setCaracteristica('DT_INICIO_PRORROGACAO,DT_FIM_PRORROGACAO,DT_INICIO_RECESSO,DT_FIM_RECESSO,DT_INICIO_JORNADA,DT_INICIO_PAG_BOLSA', 'datas');
    $VO->setCaracteristica('TX_INICIO_HORARIO,TX_FIM_HORARIO', 'horas');
    $VO->setCaracteristica('NB_VALOR_BOLSA', 'numeros');

    $validar = $VO->preencher($_POST);

    //fieldset Solicitante

//    if ($VO->ID_CONTRATO) {
//
//        $codigo = explode('_', $VO->ID_CONTRATO);
//
//        $VO->ID_CONTRATO = $codigo[0];
//        $VO->buscarContrato();
//        $arrayContrato = $VO->getArray('TX_CODIGO');
//        $smarty->assign("arrayContrato", $arrayContrato);
//
//        $VO->ID_AGENCIA_ESTAGIO = $codigo[1];
//
//        $VO->ID_CONTRATO = implode('_', $codigo);
//    }

    if ($VO->ID_ORGAO_ESTAGIO) {
        //$VO->ID_ORGAO_ESTAGIO = $_SESSION['ID_ORGAO_ESTAGIO'];
        $VO->buscarASetorial();
        $buscarASetorial=$VO->getArray('TX_FUNCIONARIO');
        $smarty->assign("buscarASetorial",$buscarASetorial);
    }

    $tamanho_just1 = strlen($_POST['TX_MOTIVO_SITUACAO']);
    if ($tamanho_just1 > 255) $validar['TX_MOTIVO_SITUACAO'] = 'Valor máximo de 255 caracteres, atual de: ' . $tamanho_just1;

    //fieldset Alterações

    if (!$_POST['NB_VIGENCIA'] && ($validar['DT_INICIO_PRORROGACAO'] || $validar['DT_FIM_PRORROGACAO'] || $validar['DT_INICIO_RECESSO'] || $validar['DT_FIM_RECESSO'])) {
        unset($validar['DT_INICIO_PRORROGACAO'], $validar['DT_FIM_PRORROGACAO'], $validar['DT_INICIO_RECESSO'], $validar['DT_FIM_RECESSO']);
    }
    if (!$_POST['NB_JORNADA'] && ($validar['DT_INICIO_JORNADA'] || $validar['TX_HORAS_JORNADA'] || $validar['TX_INICIO_HORARIO'] || $validar['TX_FIM_HORARIO'])) {
        unset($validar['DT_INICIO_JORNADA'], $validar['TX_HORAS_JORNADA'], $validar['TX_INICIO_HORARIO'], $validar['TX_FIM_HORARIO']);
    }
    if (!$_POST['NB_BOLSA'] && ($validar['DT_INICIO_PAG_BOLSA'] || $validar['NB_VALOR_BOLSA'])) {
        unset($validar['DT_INICIO_PAG_BOLSA'], $validar['NB_VALOR_BOLSA']);
    }
    if (!$_POST['NB_ALTERACOES'] && $validar['TX_OUTRAS_ALTERACOES']) {
        unset($validar['TX_OUTRAS_ALTERACOES']);
    }

    $tamanho_just2 = strlen($_POST['TX_OUTRAS_ALTERACOES']);
    if ($tamanho_just2 > 2000) $validar['TX_OUTRAS_ALTERACOES'] = 'Valor máximo de 2000 caracteres, atual de: ' . $tamanho_just2;

    // Teste de Validação
    if (!$_POST['NB_VIGENCIA'] && !$_POST['NB_JORNADA'] && !$_POST['NB_BOLSA'] && !$_POST['NB_ALTERACOES']) {
        $validar['TX_ALTERACOES'] = 'Selecione um dos ítens abaixo';
    }

    if (!$validar) {
        $id_pk = $VO->inserir();

        if ($id_pk) {
            $_SESSION['ID_SOLICITACAO_TA'] = $id_pk;
            header("Location: " . $url . "src/" . $pasta . "/detail.php");
        } else {
            $validar['ID_ORGAO_GESTOR_ESTAGIO'] = "Erro de Cadastro!";
        }
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