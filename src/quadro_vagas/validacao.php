<?php

require_once "../../php/define.php";
require_once $pathvo . "quadro_vagasVO.php";

$modulo = 79;
$programa = 1;
$pasta = 'quadro_vagas';
$current = 2;
$titulopage = 'Quadro de vagas';
session_start();

// Iniciando Instância

$_SESSION['ID_QUADRO_VAGAS_ESTAGIO'] = $_REQUEST['ID'];


header("Location: " . $url . "src/" . $pasta . "/detail.php");
?>