<?php
require_once "../../php/define.php";


$modulo = 79;
$programa = 7;
$pasta = 'contrato';
$current = 2;
$titulopage = 'Contrato de Estágio';
session_start();

// Iniciando Instância

$_SESSION[''] = $_REQUEST['ID'];

header("Location: ".$url."src/".$pasta."/detail.php");

?>