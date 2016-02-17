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

// Iniciando Instância
$VO = new s_taVO();

if ($_SESSION['ID_SOLICITACAO_TA']) {

    $VO->ID_SOLICITACAO_TA = $_SESSION['ID_SOLICITACAO_TA'];
    $VO->pesquisar();
    $VO->preencherVOBD($VO->getVetor());

    if ($_POST) {

        $VO->configuracao();
        //$VO->setCaracteristica('CS_SITUACAO,TX_MOTIVO_SITUACAO,NB_VALOR_BOLSA,TX_OUTRAS_ALTERACOES,DT_INICIO_PRORROGACAO,DT_FIM_PRORROGACAO,DT_INICIO_RECESSO,DT_FIM_RECESSO,DT_INICIO_JORNADA,DT_INICIO_PAG_BOLSA', 'obrigatorios');
        $VO->setCaracteristica('CS_SITUACAO,TX_MOTIVO_SITUACAO,DT_INICIO_PRORROGACAO,DT_FIM_PRORROGACAO,DT_INICIO_RECESSO,DT_FIM_RECESSO,DT_INICIO_JORNADA,DT_INICIO_PAG_BOLSA,TX_INICIO_HORARIO,TX_FIM_HORARIO,NB_VALOR_BOLSA', 'obrigatorios');
        $VO->setCaracteristica('DT_INICIO_PRORROGACAO,DT_FIM_PRORROGACAO,DT_INICIO_RECESSO,DT_FIM_RECESSO,DT_INICIO_JORNADA,DT_INICIO_PAG_BOLSA', 'datas');
        $VO->setCaracteristica('TX_INICIO_HORARIO,TX_FIM_HORARIO', 'horas');
        $VO->setCaracteristica('NB_VALOR_BOLSA', 'numeros');
        $validar = $VO->preencher($_POST);

        $tamanho_just1 = strlen($_POST['TX_MOTIVO_SITUACAO']);
        if ($tamanho_just1 > 255)
            $validar['TX_MOTIVO_SITUACAO'] = 'Valor máximo de 255 caracteres, atual de: ' . $tamanho_just1;

        //fieldset Alterações
        if (!$_POST['NB_VIGENCIA'] && ($validar['DT_INICIO_PRORROGACAO'] || $validar['DT_FIM_PRORROGACAO'] || $validar['DT_INICIO_RECESSO'] || $validar['DT_FIM_RECESSO']))
            unset($validar['DT_INICIO_PRORROGACAO'], $validar['DT_FIM_PRORROGACAO'], $validar['DT_INICIO_RECESSO'], $validar['DT_FIM_RECESSO']);

        if (!$_POST['NB_JORNADA'] && ($validar['DT_INICIO_JORNADA'] || $validar['TX_HORAS_JORNADA'] || $validar['TX_INICIO_HORARIO'] || $validar['TX_FIM_HORARIO']))
            unset($validar['DT_INICIO_JORNADA'], $validar['TX_HORAS_JORNADA'], $validar['TX_INICIO_HORARIO'], $validar['TX_FIM_HORARIO']);

        if (!$_POST['NB_BOLSA'] && ($validar['DT_INICIO_PAG_BOLSA'] || $validar['NB_VALOR_BOLSA']))
            unset($validar['DT_INICIO_PAG_BOLSA'], $validar['NB_VALOR_BOLSA']);

        if (!$_POST['NB_ALTERACOES'] && $validar['TX_OUTRAS_ALTERACOES'])
            unset($validar['TX_OUTRAS_ALTERACOES']);

        $tamanho_just2 = strlen($_POST['TX_OUTRAS_ALTERACOES']);
        if ($tamanho_just2 > 2000)
            $validar['TX_OUTRAS_ALTERACOES'] = 'Valor máximo de 2000 caracteres, atual de: ' . $tamanho_just2;

        if (!$_POST['NB_VIGENCIA'] && !$_POST['NB_JORNADA'] && !$_POST['NB_BOLSA'] && !$_POST['NB_ALTERACOES'])
            $validar['TX_ALTERACOES'] = 'Selecione um dos ítens abaixo';

        if (!$validar) {

            $VO->alterar();
            header("Location: " . $url . "src/" . $pasta . "/detail.php");
        }
    }

//    if ($VO->ID_ORGAO_ESTAGIO) {
//        //$VO->ID_ORGAO_ESTAGIO = $_SESSION['ID_ORGAO_ESTAGIO'];
//        $VO->buscarASetorial();
//        $buscarASetorial = $VO->getArray('TX_FUNCIONARIO');
//        $smarty->assign("buscarASetorial", $buscarASetorial);
//    }
//    if ($VO->ID_ORGAO_ESTAGIO) {
//        $total = $VO->buscarASetorial();
//        if ($total) {
//            $dados = $VO->getVetor();
//            $arraybuscarASetorial = $VO->getArray('TX_FUNCIONARIO');
//            $smarty->assign("arraybuscarASetorial", $arraybuscarASetorial);
//        } else {
//            $smarty->assign("arraybuscarASetorial", $arrayTipodesligamento[''] = 'Nenhum registro encontrado...');
//        }
//    }
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