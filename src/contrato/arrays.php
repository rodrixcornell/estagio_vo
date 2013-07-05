<?php

require_once "../../php/define.php";
require_once $pathvo."contratoVO.php";

// instancia da classe contratoVO	
$VO = new contratoVO();

//busca pelos dados que será apresentado na tela

//ComboBox de Orgão gestor
$VO->buscarOrgaoGestor();
$arrayOrgaoGestor=$VO->getArray('TX_ORGAO_GESTOR_ESTAGIO');

//ComboBox de Orgão Solicitante
$VO->buscarOrgaoSolicitante();
$arrayOrgaoSolicitante =$VO->getArray('TX_ORGAO_ESTAGIO');

//Tipo da vaga
$VO->buscarTipoVaga();
$arrayTipoVagas=$VO->getArray('TX_TIPO_VAGA_ESTAGIO');

// selecionar quadro de vagas
//$VO->buscarQuadroVaga();
//$arrayQuadroVagas=$VO->getArray('TX_CODIGO');

//selecionar curso
$VO->buscarCurso();
$arrayCursoEstagio=$VO->getArray('TX_CURSO_ESTAGIO');

// selecionar agente de integração
$VO->buscarAgenteIntegracao();
$arrayAgenteIntegracao=$VO->getArray('TX_AGENCIA_ESTAGIO');

// selecionar Instituição de ensino
$VO->buscarInstituicaoDeEnsino();
$arrayInstituicaoDeEnsino=$VO->getArray('TX_INSTITUICAO_ENSINO');

// buscar Supervisor
$VO->buscarSupervisor();
$arrayPessoaSupervisor=$VO->getArray('TX_NOME');

// buscar Bolsa 
$VO->buscarBolsa();
$arrayBolsa=$VO->getArray('TX_BOLSA_ESTAGIO');

// #################################### ARRAYS PRÉ-DEFINIFINIDOS#####################################

// Tipo de Contrato
$arrayTipoContrato[''] = 'Escolha...';	
$arrayTipoContrato[1] = 'Contrato Inicial';	  
$arrayTipoContrato[2] = 'Aditivo Contratual';

//Periodo Do curso do Estagiario
$arrayPeriodoEstagio['']='Escolha...';
$arrayPeriodoEstagio['1']='1º Ano';
$arrayPeriodoEstagio['2']='2º Ano';
$arrayPeriodoEstagio['3']='3º Ano';
$arrayPeriodoEstagio['4']='4º Ano';
$arrayPeriodoEstagio['5']='5º Ano';
$arrayPeriodoEstagio['6']='1º Periodo';
$arrayPeriodoEstagio['7']='2º Periodo';
$arrayPeriodoEstagio['8']='3º Periodo';
$arrayPeriodoEstagio['9']='4º Periodo';
$arrayPeriodoEstagio['10']='5º Periodo';
$arrayPeriodoEstagio['11']='6º Periodo';
$arrayPeriodoEstagio['12']='7º Periodo';
$arrayPeriodoEstagio['13']='8º Periodo';
$arrayPeriodoEstagio['14']='9º Periodo';
$arrayPeriodoEstagio['15']='10º Periodo';

// Horario do Curso do estagiasio
$arrayHorarioCurso['']='Escolha...';
$arrayHorarioCurso['1']='Manhã';
$arrayHorarioCurso['2']='Tarde';
$arrayHorarioCurso['3']='Noite';

//Apresentações dos dados no tpl 
$smarty->assign('arrayOrgaoGestor',$arrayOrgaoGestor);
$smarty->assign('arrayOrgaoSolicitante',$arrayOrgaoSolicitante);
$smarty->assign('arrayTipoContrato',$arrayTipoContrato);
$smarty->assign('arrayPeriodoEstagio',$arrayPeriodoEstagio);
$smarty->assign('arrayHorarioCurso',$arrayHorarioCurso);
$smarty->assign('arrayTipoVagas',$arrayTipoVagas);
//$smarty->assign('arrayQuadroVagas',$arrayQuadroVagas);
$smarty->assign('arrayCursoEstagio',$arrayCursoEstagio);
$smarty->assign('arrayAgenteIntegracao',$arrayAgenteIntegracao);
$smarty->assign('arrayInstituicaoDeEnsino',$arrayInstituicaoDeEnsino);
$smarty->assign('arrayPessoaSupervisor',$arrayPessoaSupervisor);
$smarty->assign('arrayBolsa',$arrayBolsa);
?>