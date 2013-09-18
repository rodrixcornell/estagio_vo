<?php

require_once "../../php/define.php";
require_once $pathvo . "quadro_vagasVO.php";

$VO = new quadro_vagasVO();

$VO->pesquisarCodigo();
$pesquisarCodigo = $VO->getArray("TX_CODIGO");
//------------------------------------------
$VO->pesquisarOrgaogestor();
$pesquisarOrgaogestor = $VO->getArray("TX_ORGAO_GESTOR_ESTAGIO");
//-----------------------------------------
$VO->pesquisarAgenciaestagio();
$pesquisarAgenciaestagio = $VO->getArray("TX_AGENCIA_ESTAGIO");
//---------------------------------------
$VO->pesquisarTipo();
$pesquisarTipo = $VO->getArray("TX_TIPO_VAGA_ESTAGIO");
//----------------------------------------
$VO->pesquisaCursos();
$pesquisaCursos = $VO->getArray("TX_CURSO_ESTAGIO");
//---------------------------------------
$VO->orgao_Solicitante();
$orgao_Solicitante = $VO->getArray("TX_ORGAO_ESTAGIO");
//------------------------------------------
/*$VO->orgao_Solicitante();
$orgao_Solicitante = $VO->getArray("TX_ORGAO_ESTAGIO");*/
//---------------------------------------------
$VO->pesquisaContrato();
$pesquisaContrato = $VO->getArray("NB_CODIGO");


$arraySituacao = array('' => "Escolha", 1 => "ATIVO", 2 => "DESATIVADO");

$smarty->assign("arraySituacao", $arraySituacao);
$smarty->assign("pesquisarOrgaogestor", $pesquisarOrgaogestor);
$smarty->assign("pesquisarAgenciaestagio", $pesquisarAgenciaestagio);
$smarty->assign("pesquisarTipo", $pesquisarTipo);
$smarty->assign("pesquisaCursos", $pesquisaCursos);
$smarty->assign("orgao_Solicitante", $orgao_Solicitante);
$smarty->assign("pesquisarCodigo", $pesquisarCodigo);
$smarty->assign("pesquisaContrato", $pesquisaContrato);


?>

