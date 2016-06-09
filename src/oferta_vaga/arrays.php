<?php
require_once "../../php/define.php";
require_once $pathvo."oferta_vagaVO.php";

$VO = new oferta_vagaVO();

$arraySituacao = array(""=>"Escolha...", 1=>"Aberta", 2=>"Efetivada", 4=>"Cancelada");

$VO->pesquisarOrgaoGestor();
    $arrayOrgaoGestor = $VO->getArray("TX_ORGAO_GESTOR_ESTAGIO");

$VO->pesquisarOrgaoSolicitante();
    $arrayOrgaoSolicitante = $VO->getArray("TX_ORGAO_ESTAGIO");

$VO->pesquisarValorBolsa();
    $arrayBolsa = $VO->getArray("NB_VALOR");

$VO->buscarCursos();
    $arrayCurso = $VO->getArray("TX_CURSO_ESTAGIO");

// VO->AgenciaEstagio();
// $arrayAgenciaEstag = $VO->getArray("ID_AGENCIA_ESTAGIO");
//dd($_SESSION);


$arrayEscolaridade[''] = 'Escolha...';
$arrayEscolaridade[1] = 'Médio';
$arrayEscolaridade[2] = 'Técnico';
$arrayEscolaridade[3] = 'Superior';
$arrayEscolaridade[4] = 'Educação Especial';

$arraySexo[''] = 'Escolha...';
$arraySexo[1] = 'Masculino';
$arraySexo[2] = 'Feminino';

$smarty->assign("arraySituacao", $arraySituacao);
$smarty->assign("arrayOrgaoGestor", $arrayOrgaoGestor);
$smarty->assign("arrayOrgaoSolicitante", $arrayOrgaoSolicitante);
$smarty->assign("arrayBolsa", $arrayBolsa);
$smarty->assign("arrayEscolaridade", $arrayEscolaridade);
$smarty->assign("arrayCurso", $arrayCurso);
$smarty->assign("arraySexo", $arraySexo);