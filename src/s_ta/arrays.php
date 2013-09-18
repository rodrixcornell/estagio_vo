<?php

require_once "../../php/define.php";
require_once $pathvo."s_taVO.php";

// instancia da classe s_taVO
$VO = new s_taVO();

//ComboBox de Orgão gestor
$VO->buscarOrgaoGestor();
$arrayOrgaoGestor=$VO->getArray('TX_ORGAO_GESTOR_ESTAGIO');

//ComboBox de Orgão Solicitante
$VO->buscarOrgaoSolicitante();
$arrayOrgaoSolicitante =$VO->getArray('TX_ORGAO_ESTAGIO');

$arraySituacao = array('' => "Escolha...", 1 => "ABERTA", 2 => "FECHADA");

$VO->buscarContrato();
$arrayContrato =$VO->getArray('TX_CODIGO');
/*
$VO->buscaTipo();
$arraybuscaTipo =$VO->getArray('TX_TIPO_VAGA_ESTAGIO');
*/
$VO->buscarASetorial();
$buscarASetorial=$VO->getArray('TX_FUNCIONARIO');


$VO->buscarAgenteIntegracao();
$arraybuscarAgenteIntegracao=$VO->getArray('TX_AGENCIA_ESTAGIO');


//Apresentações dos dados no tpl
$smarty->assign('arrayOrgaoGestor'             ,$arrayOrgaoGestor);
$smarty->assign('arrayOrgaoSolicitante'        ,$arrayOrgaoSolicitante);
$smarty->assign('arrayContrato'                ,$arrayContrato);
//$smarty->assign("buscarASetorial"              ,$buscarASetorial);
$smarty->assign("arraySituacao"                ,$arraySituacao);
$smarty->assign("arraybuscarAgenteIntegracao"  ,$arraybuscarAgenteIntegracao);
$smarty->assign("arraybuscaTipo"               ,$arraybuscaTipo);


?>