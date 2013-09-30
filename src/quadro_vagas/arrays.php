<?php
require_once "../../php/define.php";
require_once $pathvo . "quadro_vagasVO.php";

$VO = new quadro_vagasVO();

$arraySituacao = array('' => "Escolha", 1 => "ATIVADO", 2 => "DESATIVADO");

$VO->pesquisarOrgaogestor();
$pesquisarOrgaogestor = $VO->getArray("TX_ORGAO_GESTOR_ESTAGIO");

$VO->pesquisarAgenciaestagio();
$pesquisarAgenciaestagio = $VO->getArray("TX_AGENCIA_ESTAGIO");

$VO->pesquisaContrato();
$pesquisaContrato = $VO->getArray("NB_CODIGO");


$smarty->assign("arraySituacao", $arraySituacao);
$smarty->assign("pesquisarOrgaogestor", $pesquisarOrgaogestor);
$smarty->assign("pesquisarAgenciaestagio", $pesquisarAgenciaestagio);
$smarty->assign("pesquisaContrato", $pesquisaContrato);


?>

