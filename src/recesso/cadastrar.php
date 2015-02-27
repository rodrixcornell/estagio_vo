<?php

require_once "../../php/define.php";
require_once $path . "src/recesso/arrays.php";
require_once $pathvo . "recessoVO.php";

$modulo = 79;
$programa = 9;
$pasta = 'recesso';
$current = 2;
$titulopage = 'Recesso';

session_start();
require_once "../autenticacao/validaPermissao.php";

unset($_SESSION['ID_RECESSO_ESTAGIO']);

// Iniciando Instância
$VO = new recessoVO();

if ($_POST) {
    $VO->configuracao();
    $VO->setCaracteristica('ID_ORGAO_ESTAGIO,ID_ORGAO_GESTOR_ESTAGIO,ID_CONTRATO,TX_CARGO_AGENTE,TX_EMAIL_AGENTE,TX_TELEFONE_AGENTE,DT_INICIO_VIG_ESTAGIO,DT_FIM_VIGENCIA_ESTAGIO,ID_AGENCIA_ESTAGIO,NB_ANO_REFERENCIA,NB_MES_REFERENCIA,DT_INICIO_RECESSO,DT_FIM_RECESSO,ID_SETORIAL_ESTAGIO,TX_CHEFIA_IMEDIATA,CS_REALIZACAO', 'obrigatorios');
  $validar = $VO->preencher($_POST);
    if ($VO->ID_ORGAO_GESTOR_ESTAGIO) {

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


    
    
  
//	 print_r($validar);
    (!$validar) ? $id_pk = $VO->inserir() : false;

    if (!$validar) {
        $_SESSION['ID_RECESSO_ESTAGIO']      = $id_pk;
       // $_SESSION['STATUS'] = '*Registro inserido com sucesso!';
     //  // $_SESSION['PAGE'] = '1';
        header("Location: " . $url . "src/" . $pasta . "/detail.php");
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