<?php
require_once "../../php/define.php";
require_once $pathvo."cursoVO.php";

$VO = new cursoVO();

$VO->pesquisarAreaConhecimento();
    $arrayUnidade = $VO->getArray("TX_AREA_CONHECIMENTO");

$smarty->assign("arrayUnidade"    	, $arrayUnidade);
?>
