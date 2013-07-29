<?php

require_once "../../php/define.php";

$modulo = 80;
$programa = 5;
$pasta = 'termo_aditivo';
$current = 3;
$titulopage = 'Termo Aditivo de Contrato';
session_start();

// Iniciando Instância

$_SESSION['ID_ADITIVO_CONTRATO_CP'] = $_REQUEST['ID'];

header("Location: " . $url . "src/" . $pasta . "/alterar.php");
?>