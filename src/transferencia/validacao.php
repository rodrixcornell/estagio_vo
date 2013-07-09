<?php

require_once "../../php/define.php";
require_once $path . "src/transferencia/arrays.php";
require_once $pathvo . "transferenciaVO.php";

$modulo = 79;
$programa = 4;
$pasta = 'transferencia';
$current = 2;
$titulopage = 'Transferência de Vagas';

session_start();

// Iniciando Instância

$id = explode('_', $_REQUEST['ID']);
$_SESSION['ID_TRANSFERENCIA_ESTAGIO'] = $id[0];
$_SESSION['ID_ORGAO_ESTAGIO'] = $id[1];
//$_SESSION['ID_ORGAO_SOLICITANTE']=$id[2];
header("Location: " . $url . "src/" . $pasta . "/detail.php");

//print_r($_SESSION);
?>