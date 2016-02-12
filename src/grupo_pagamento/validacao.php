<?php
require_once "../../php/define.php";

$modulo = 80;
$programa = 8;
$pasta = 'grupo_pagamento';
$current = 3;
$titulopage = 'Grupo de Pagamento';
session_start();

// Iniciando Instância

$_SESSION['ID_GRUPO_PAGAMENTO'] = $_REQUEST['ID'];

header("Location: ".$url."src/".$pasta."/alterar.php");

?>