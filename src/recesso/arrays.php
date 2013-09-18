<?php
require_once "../../php/define.php";
require_once $pathvo."recessoVO.php";
	
$VO = new recessoVO();



//ComboBox de Org�o gestor
$VO->buscarOrgaoGestor();
$arrayOrgaoGestor=$VO->getArray('TX_ORGAO_GESTOR_ESTAGIO');


//$VO->pesquisarOrgaoSolicitante();
//$arrayOrgaoSolicitante = $VO->getArray("TX_ORGAO_ESTAGIO");  

$VO->pesquisarAgenteSetorial();	
    $arrayAgenteSetorial = $VO->getArray("TX_FUNCIONARIO");  

//selecionar quadro de vagas
//$VO->buscarContrato();
//$arrayContrato=$VO->getArray('TX_CONTRATO'); 

$arraySituacao[''] 	= 'Escolha...';
$arraySituacao[1] 	= 'Aberta';
$arraySituacao[2] 	= 'Fechada';	

$arraySituacaoGozo[''] 	= 'Escolha...';
$arraySituacaoGozo[1] 	= 'Realizado';
$arraySituacaoGozo[2] 	= 'Postergado Totalmente';	
$arraySituacaoGozo[3] 	= 'Postergado Parcialmente';	

//$smarty->assign("arrayOrgaoSolicitante"    	, $arrayOrgaoSolicitante);
$smarty->assign("arrayOrgaoGestor"          , $arrayOrgaoGestor);
$smarty->assign("arrayAgenteSetorial"               , $arrayAgenteSetorial);
//$smarty->assign('arrayContrato',$arrayContrato);
$smarty->assign("arraySituacao"             , $arraySituacao);
$smarty->assign("arraySituacaoGozo"             , $arraySituacaoGozo);
?>
