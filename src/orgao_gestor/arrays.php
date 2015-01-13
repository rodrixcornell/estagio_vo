<?php
require_once "../../php/define.php";
require_once $pathvo."orgao_gestorVO.php";
	
$VO = new orgao_gestorVO();

$VO->pesquisarUnidade();
    $arrayUnidade = $VO->getArray("TX_UNIDADE_ORG");    

$smarty->assign("arrayUnidade"    	, $arrayUnidade);
?>
