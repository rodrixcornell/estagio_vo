<?php
require_once "../../php/define.php";
require_once $pathvo."bolsaVO.php";
	
$VO = new bolsaVO();

$VO->pesquisarBolsa();
$arrayBolsa = $VO->getArray("TX_BOLSA_ESTAGIO");    
$smarty->assign("arrayBolsa", $arrayBolsa);

?>
