<?php
require_once "../../../php/define.php";
require_once $pathvo."recrutamentoVO.php";
	
$VO = new recrutamentoVO();

$VO->pesquisarOrgaoGestor();
    $arrayOrgaoGestor = $VO->getArray("TX_ORGAO_GESTOR_ESTAGIO");  
	
$VO->buscarOrgaoSolicitanteRel();
    $arrayOrgaoSolicitanteRel = $VO->getArray("TX_ORGAO_ESTAGIO"); 
//
//$VO->pesquisarQuadroVagas();
//    $arrayQuadroVagas = $VO->getArray("TX_CODIGO");   

$arraySituacao[''] 	= 'Escolha...';
$arraySituacao[1] 	= 'Aberto';
$arraySituacao[2] 	= 'Fechado';

//$smarty->assign("arrayQuadroVagas"    	    , $arrayQuadroVagas);
$smarty->assign("arrayOrgaoSolicitanteRel"    	, $arrayOrgaoSolicitanteRel);
$smarty->assign("arrayOrgaoGestor"          , $arrayOrgaoGestor);
$smarty->assign("arraySituacao"			    , $arraySituacao);

?>
