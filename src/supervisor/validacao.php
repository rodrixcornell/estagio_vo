<?php
require_once "../../php/define.php";
require_once $pathvo . "supervisorVO.php";

$modulo = 78;
$programa = 8;
$pasta = 'supervisor';
$current = 1;
$titulopage = 'Supervisor de Estágio';

session_start();

$_SESSION['ID_PESSOA_SUPERVISOR'] = $_REQUEST['ID'];
header("Location: " . $url . "src/" . $pasta . "/alterar.php");
?>