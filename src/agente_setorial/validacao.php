<?php
require_once "../../php/define.php";
require_once $pathvo."agente_setorialVO.php";

$modulo = 78;
$programa = 3;
$pasta = 'agente_setorial';
$current = 1;
$titulopage = 'Agente Setorial';
session_start();

// Iniciando Instância

$_SESSION['ID_SETORIAL_ESTAGIO'] = $_REQUEST['ID'];

header("Location: ".$url."src/".$pasta."/detail.php");

?>