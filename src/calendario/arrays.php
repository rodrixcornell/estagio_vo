<?php
require_once "../../php/define.php";
require_once $pathvo."transferenciaVO.php";

$VO = new transferenciaVO();

$arraySituacao = array(""=>"Escolha...", 1=>"Aberta", 2=>"Efetivada", 3=>"Cancelada");

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
