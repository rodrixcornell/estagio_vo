<?php
require_once "../../php/define.php";
require_once $pathvo."orgao_solicitanteVO.php";
	
$VO = new orgao_solicitanteVO();

$VO->pesquisarOrgaoSolicitante();
    $pesquisarOrgaoSolicitante = $VO->getArray("TX_UNIDADE_ORG");  

$smarty->assign("pesquisarOrgaoSolicitante"    	, $pesquisarOrgaoSolicitante);
?>
