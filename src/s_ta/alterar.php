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
        $VO->setCaracteristica('CS_SITUACAO,TX_MOTIVO_SITUACAO,NB_VALOR_BOLSA,TX_OUTRAS_ALTERACOES,DT_INICIO_PRORROGACAO,DT_FIM_PRORROGACAO,DT_INICIO_RECESSO,DT_FIM_RECESSO,DT_INICIO_JORNADA,DT_INICIO_PAG_BOLSA', 'obrigatorios');
        $VO->setCaracteristica('DT_INICIO_PRORROGACAO,DT_FIM_PRORROGACAO,DT_INICIO_RECESSO,DT_FIM_RECESSO,DT_INICIO_JORNADA,DT_INICIO_PAG_BOLSA', 'datas');
        $validar = $VO->preencher($_POST);

        if (!$validar) {
            $VO->alterar();
            header("Location: " . $url . "src/" . $pasta . "/detail.php");
        }
    }

    if ($VO->ID_ORGAO_ESTAGIO) {

        $total = $VO->buscarASetorial();

        if ($total) {
            $dados = $VO->getVetor();
            $arraybuscarASetorial = $VO->getArray('TX_FUNCIONARIO');
            $smarty->assign("arraybuscarASetorial", $arraybuscarASetorial);
        } else {
            $smarty->assign("arraybuscarASetorial", $arrayTipodesligamento[''] = 'Nenhum registro encontrado...');
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