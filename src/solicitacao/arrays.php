<?php
require_once "../../php/define.php";
require_once $pathvo."solicitacaoVO.php";

$VO = new solicitacaoVO();

$arraySituacao = array(""=>"Escolha...", 1=>"Ativado", 2=>"Desativado");

$VO->pesquisarOrgaoGestor();
    $arrayOrgaoGestor = $VO->getArray("TX_ORGAO_GESTOR_ESTAGIO");

$VO->pesquisarOrgaoSolicitante();
    $arrayOrgaoSolicitante = $VO->getArray("TX_ORGAO_ESTAGIO");
$VO->pesquisarAgenciaEstagio();
    $arrayAgenciaEstagio = $VO->getArray("TX_AGENCIA_ESTAGIO");

$smarty->assign("arraySituacao", $arraySituacao);
$smarty->assign("arrayOrgaoGestor", $arrayOrgaoGestor);
$smarty->assign("arrayOrgaoSolicitante", $arrayOrgaoSolicitante);
$smarty->assign("arrayAgenciaEstagio", $arrayAgenciaEstagio);
?>
