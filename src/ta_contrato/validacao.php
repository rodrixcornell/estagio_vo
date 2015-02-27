<?php

require_once "../../php/define.php";
require_once $path . "src/ta_contrato/arrays.php";
require_once $pathvo . "ta_contratoVO.php";

$modulo = 80;
$programa = 7;
$pasta = 'ta_contrato';
$current = 3;
$titulopage = 'Solicitação de Termo Aditivo de Contrato';

session_start();

// Iniciando Instância

$id = explode('_', $_REQUEST['ID']);
$_SESSION['ID_SOLICITACAO_TA_CP'] = $id[0];
//$_SESSION['ID_UNIDADE_ORG'] = $id[1];
header("Location: ".$url."src/".$pasta."/detail.php");

?>