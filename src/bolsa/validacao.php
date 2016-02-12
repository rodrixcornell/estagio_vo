<?php
require_once "../../php/define.php";

$modulo = 78;
$programa = 1;
$pasta = 'bolsa';
$current = 1;
$titulopage = 'Bolsa de Estágio';
session_start();

// Iniciando Instância

$_SESSION['ID_BOLSA_ESTAGIO'] = $_REQUEST['ID'];

header("Location: ".$url."src/".$pasta."/alterar.php");

?>