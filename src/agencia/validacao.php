<?php
require_once "../../php/define.php";
require_once $pathvo . "agenciaVO.php";

$modulo = 78;
$programa = 7;
$pasta = 'agencia';
$current = 1;
$titulopage = 'Agência de Estágio';

session_start();
$_SESSION['ID_AGENCIA_ESTAGIO'] = $_REQUEST['ID'];
header("Location: " . $url . "src/" . $pasta . "/alterar.php");
?>