<?php

require_once "../../php/define.php";
require_once $pathvo . "transferenciaVO.php";

$VO = new transferenciaVO();

$arraySituacao = array("" => "Escolha...", 1 => "Aberta", 2 => "Efetivada", 3 => "Cancelada");

$VO->pesquisarOrgaoGestor();
$arrayOrgaoGestor = $VO->getArray("TX_ORGAO_GESTOR_ESTAGIO");

$VO->pesquisarOrgaoSolicitante();
$arrayOrgaoSolicitante = $VO->getArray("TX_ORGAO_ESTAGIO");

$VO->pesquisarOrgaoCedente();
$arraypesquisarOrgaoCedente = $VO->getArray("TX_ORGAO_ESTAGIO");



/*$VO->buscarQuadroVagasEstagio();
$arrayQuadroVagasEstagio = $VO->getArray("TX_CODIGO");*/

//
// $VO->pesquisarTipoVaga();
//  $arrayTipoVaga = $VO->getArray("TX_TIPO_VAGA_ESTAGIO");


  // $VO->buscarQuantAtual();
//  $arraybuscarQuantAtual = $VO->getArray("NB_QUANTIDADE_ATUAL");

$smarty->assign("arraySituacao", $arraySituacao);
$smarty->assign("arrayOrgaoGestor", $arrayOrgaoGestor);
$smarty->assign("arrayOrgaoSolicitante", $arrayOrgaoSolicitante);
$smarty->assign("arraypesquisarOrgaoCedente", $arraypesquisarOrgaoCedente);
$smarty->assign("arrayQuadroVagasEstagio", $arrayQuadroVagasEstagio);
//$smarty->assign("arrayTipoVaga", $arrayTipoVaga);
//$smarty->assign("arrayTipoVaga", $arrayTipoVaga);
?>