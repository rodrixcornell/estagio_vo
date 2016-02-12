<?php
require_once "../../php/define.php";
require_once $pathvo."agente_setorialVO.php";
	
$VO = new agente_setorialVO();

$VO->pesquisarUsuario();
    $arrayUsuario = $VO->getArray("TX_LOGIN");    

//$VO->pesquisarUnidadeSolicitante();
//    $arrayUnidade = $VO->getArray("TX_UNIDADE_IRP");  
//	
$VO->pesquisarUnidade();
    $arrayUnidadeDetail = $VO->getArray("TX_ORGAO_ESTAGIO");  


$smarty->assign("arrayUsuario"    	, $arrayUsuario);
//$smarty->assign("arrayUnidade"    	, $arrayUnidade);
$smarty->assign("arrayUnidadeDetail", $arrayUnidadeDetail);
?>
