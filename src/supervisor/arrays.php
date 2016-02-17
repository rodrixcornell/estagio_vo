<?php
require_once "../../php/define.php";
require_once $pathvo."supervisorVO.php";

$VO = new supervisorVO();

$VO->pesquisarFuncionario();
    $arrayFuncionario = $VO->getArray("TX_NOME");

$VO->pesquisarConselho();
  $arrayConselho = $VO->getArray("TX_CONSELHO");

$smarty->assign("arrayFuncionario"    	, $arrayFuncionario);
$smarty->assign("arrayConselho"    	, $arrayConselho);
?>