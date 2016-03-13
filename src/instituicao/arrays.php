<?php
require_once "../../php/define.php";
require_once $pathvo."instituicaoVO.php";

$VO = new instituicaoVO();

$VO->buscarInstituicoes();
$arrayInstituicoes = $VO->getArray("TX_INSTITUICAO_ENSINO");

$smarty->assign("arrayInstituicoes", $arrayInstituicoes);
?>