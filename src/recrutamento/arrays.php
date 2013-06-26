<?php
require_once "../../php/define.php";
require_once $pathvo."recrutamentoVO.php";
	
$VO = new recrutamentoVO();

$VO->pesquisarQuadroVagas();
    $arrayQuadroVagas = $VO->getArray("TX_CODIGO");    

$VO->pesquisarOrgaoSolicitante();
    $arrayOrgaoSolicitante = $VO->getArray("TX_ORGAO_ESTAGIO");  

$VO->pesquisarOrgaoGestor();
    $arrayOrgaoGestor = $VO->getArray("TX_ORGAO_ESTAGIO");  

$arraySituacao[''] 	= 'Escolha...';
$arraySituacao[1] 	= 'Ativado';
$arraySituacao[2] 	= 'Desativado';

$smarty->assign("arrayQuadroVagas"    	    , $arrayQuadroVagas);
$smarty->assign("arrayOrgaoSolicitante"    	, $arrayOrgaoSolicitante);
$smarty->assign("arrayOrgaoGestor"          , $arrayOrgaoGestor);
$smarty->assign("arraySituacao"			    , $arraySituacao);

?>
