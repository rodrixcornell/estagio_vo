<?php
require_once "../../php/define.php";
require_once $pathvo."estagiarioVO.php";
	
$VO = new estagiarioVO();

$VO->pesquisarLocalidade();
    $arrayLocalidade = $VO->getArray("TX_LOCALIDADE");  
	
$VO->pesquisarFuncionario();
    $arrayFuncionario = $VO->getArray("TX_FUNCIONARIO");  	

$arraySexo[''] 	= 'Escolha...';
$arraySexo[1] 	= 'Masculino';
$arraySexo[2] 	= 'Feminino';

$smarty->assign("arrayLocalidade"    	, $arrayLocalidade);
$smarty->assign("arrayFuncionario"    	, $arrayFuncionario);
$smarty->assign("arraySexo"			    , $arraySexo);
?>
