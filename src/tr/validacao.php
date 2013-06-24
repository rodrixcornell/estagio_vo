<?php
require_once "../../php/define.php";


$modulo = 79;
$programa = 8;
$pasta = 'tr';
$current = 2;
$titulopage = 'Solicitação de TR';

session_start();

// Iniciando Instância

$_SESSION['ID_CONTRATO'] = $_REQUEST['ID'];

header("Location: ".$url."src/".$pasta."/detail.php");

?>