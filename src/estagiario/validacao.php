<?php
require_once "../../php/define.php";

$modulo = 79;
$programa = 2;
$pasta = 'estagiario';
$current = 2;
$titulopage = 'Estagiário';
session_start();

// Iniciando Instância

$_SESSION['ID_PESSOA_ESTAGIARIO'] = $_REQUEST['ID'];

header("Location: ".$url."src/".$pasta."/alterar.php");

?>