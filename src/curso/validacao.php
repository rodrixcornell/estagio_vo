<?php
require_once "../../php/define.php";

$modulo = 78;
$programa = 5;
$pasta = 'curso';
$current = 1;
$titulopage = 'Curso';
session_start();

// Iniciando Instância

$_SESSION['ID_CURSO_ESTAGIO'] = $_REQUEST['ID'];

header("Location: ".$url."src/".$pasta."/alterar.php");

?>