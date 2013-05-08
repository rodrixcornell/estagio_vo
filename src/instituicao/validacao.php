<?php
require_once "../../php/define.php";

$modulo = 78;
$programa = 6;
$pasta = 'instituicao';
$current = 1;
$titulopage = 'Instituição de Ensino';
session_start();

// Iniciando Instância 
$codigo = explode('_', $_REQUEST['ID']);

$_SESSION['ID_INSTITUICAO_ENSINO']   = $codigo[0];
$_SESSION['TX_INSTITUICAO_ENSINO']   = $codigo[1];

header("Location: ".$url."src/".$pasta."/alterar.php");

?>
