<?php
require_once "../../php/define.php";
require_once $pathvo."selecaoVO.php";
	
$VO = new selecaoVO();

//ComboBox de Orgão gestor
$VO->buscarOrgaoGestor();
$arrayOrgaoGestor=$VO->getArray('TX_ORGAO_GESTOR_ESTAGIO');

//ComboBox de Orgão Solicitante
/*$VO->buscarOrgaoSolicitante();
$arrayOrgaoSolicitante =$VO->getArray('TX_ORGAO_ESTAGIO');*/

$arraySituacao = array('' => "Escolha...", 1 => "Aberta", 2 => "Fechada");

$arraySituacaoCandidato = array('' => "Escolha...",1 => "Em Análise",2 => "Aprovado",3 => "Reprovado",4 => "Cancelado");

$smarty->assign('arrayOrgaoGestor'       ,$arrayOrgaoGestor);
/*$smarty->assign('arrayOrgaoSolicitante'  ,$arrayOrgaoSolicitante);*/
$smarty->assign("arraySituacaoCandidato" ,$arraySituacaoCandidato);
$smarty->assign("arraySituacao"          ,$arraySituacao);

?>