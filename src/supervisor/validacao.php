<?php

require_once "../../php/define.php";
require_once $pathvo . "supervisorVO.php";

$modulo = 78;
$programa = 1;
$pasta = 'supervisor';
$current = 8;
$titulopage = 'Supervisor de Estágio';

session_start();


$_SESSION['id_pessoa_supervisor'] = $_REQUEST['ID'];




header("Location: " . $url . "src/" . $pasta . "/alterar.php");
?>