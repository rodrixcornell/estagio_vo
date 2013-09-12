<?php

require_once "../../php/define.php";


$modulo = 79;
$programa = 11;
$pasta = 's_ta';
$current = 2;
$titulopage = 'Solicitação TA';

session_start();

// Iniciando Instância

$_SESSION['ID_SOLICITACAO_TA'] = $_REQUEST['ID'];


header("Location: " . $url . "src/" . $pasta . "/detail.php");
?>