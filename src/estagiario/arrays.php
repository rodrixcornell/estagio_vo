<?php
require_once "../../php/define.php";
require_once $pathvo."estagiarioVO.php";
	
$VO = new estagiarioVO();

$VO->pesquisarLocalidade();
    $arrayLocalidade = $VO->getArray("TX_LOCALIDADE");    

$arraySexo[''] 	= 'Escolha...';
$arraySexo[1] 	= 'Masculino';
$arraySexo[2] 	= 'Feminino';

$smarty->assign("arrayLocalidade"    	, $arrayLocalidade);
$smarty->assign("arraySexo"			    , $arraySexo);
?>
