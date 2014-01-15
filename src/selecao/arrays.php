<?php

require_once "../../php/define.php";
require_once $pathvo . "selecaoVO.php";

$VO = new selecaoVO();

//ComboBox de Orgão gestor
$VO->buscarOrgaoGestor();
$arrayOrgaoGestor = $VO->getArray('TX_ORGAO_GESTOR_ESTAGIO');

$VO->buscarSolicitante();
$arraySolicitante = $VO->getArray('TX_ORGAO_ESTAGIO');

$arraySituacao = array('' => "Escolha...", 1 => "Aberta", 2 => "Fechada");

$arraySituacaoCandidato = array('' => "Escolha...", 1 => "Em Análise", 2 => "Aprovado", 3 => "Reprovado", 4 => "Cancelado");

//$arraySexo = array('' => 'Escolha...', 1 => 'Masculino', 2 => 'Feminino');

$smarty->assign('arrayOrgaoGestor', $arrayOrgaoGestor);
$smarty->assign('arraySolicitante', $arraySolicitante);

$smarty->assign("arraySituacaoCandidato", $arraySituacaoCandidato);
$smarty->assign("arraySituacao", $arraySituacao);
?>