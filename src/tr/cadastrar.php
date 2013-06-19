<?php

require_once "../../php/define.php";
require_once $path . "src/tr/arrays.php";
require_once $pathvo . "trVO.php";

$modulo = 79;
$programa = 8;
$pasta = 'tr';
$current = 2;
$titulopage = 'Solicitação de TR';

require_once "../autenticacao/validaPermissao.php";

$VO = new trVO();
unset($_SESSION['ID_SOLICITACAO_TR']);

if ($_POST) {

    $VO->configuracao();
    $VO->setCaracteristica('ID_ORGAO_GESTOR_ESTAGIO,ID_ORGAO_ESTAGIO,ID_CONTRATO,TX_TELEFONE,ID_AGENCIA_ESTAGIO', 'obrigatorios');
    $VO->setCaracteristica('DT_FIM_VIGENCIA,DT_INICIO_VIGENCIA', 'datas');
    $VO->setCaracteristica('NB_INICIO_HORARIO,NB_FIM_HORARIO', 'horas');

    $validar = $VO->preencher($_POST);
    if ($VO->ID_ORGAO_ESTAGIO) {

        $codigo = explode('_', $VO->ID_ORGAO_ESTAGIO);

        $VO->ID_ORGAO_ESTAGIO = $codigo[0];
        $VO->buscarCodSelecao();
        $arrayCodSelecao = $VO->getArray('TX_COD_SELECAO');
        $smarty->assign("arrayCodSelecao", $arrayCodSelecao);

        $VO->NB_COD_UNIDADE = $codigo[1];
        $VO->buscarLotacao();
        $arrayLotacao = $VO->getArray('ORGAO');
        $smarty->assign("arrayLotacao", $arrayLotacao);


        $VO->ID_ORGAO_ESTAGIO = implode('_', $codigo);
    }

    if ($VO->ID_SELECAO_ESTAGIO) {
        
        $VO->buscarCandidato();
        $arrayPessoaEstagiario = $VO->getArray('TX_NOME');
        $smarty->assign("arrayPessoaEstagiario", $arrayPessoaEstagiario);
    }
//    print_r($VO);

    if (!$validar)
        $id_pk = $VO->inserir();

    if ($id_pk) {
        $_SESSION['ID_tr_ESTAGIO'] = $id_pk;
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