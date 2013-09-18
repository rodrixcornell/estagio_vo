<?php

require_once "../../php/define.php";
require_once $pathvo . "termo_aditivoVO.php";

$VO = new termo_aditivoVO();

$VO->pesquisarOrgaoGestor();
$pesquisarOrgaoGestor = $VO->getArray("TX_ORGAO_GESTOR_ESTAGIO");

$VO->pesquisarNB_Codigo();
$pesquisarNB_Codigo = $VO->getArray("NB_CODIGO");


$VO->pesquisarAgenciaDeEstagio();
$pesquisarAgenciaDeEstagio = $VO->getArray("TX_AGENCIA_ESTAGIO");

$smarty->assign("pesquisarOrgaoGestor", $pesquisarOrgaoGestor);
$smarty->assign("pesquisarNB_Codigo", $pesquisarNB_Codigo);
$smarty->assign("pesquisarAgenciaDeEstagio", $pesquisarAgenciaDeEstagio);
?>
