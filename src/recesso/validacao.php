<?php
require_once "../../php/define.php";

$modulo = 79;
$programa = 5;
$pasta = 'recesso';
$current = 1;
$titulopage = 'Recesso';
session_start();

// Iniciando Instância

$_SESSION['ID_RECESSO_ESTAGIO'] = $_REQUEST['ID'];

header("Location: ".$url."src/".$pasta."/detail.php");

?>