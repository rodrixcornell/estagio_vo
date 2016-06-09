<?php

require_once "../../php/define.php";
require_once $path . "src/oferta_vaga/arrays.php";
require_once $pathvo . "oferta_vagaVO.php";

$modulo = 79;
$programa = 3;
$pasta = 'oferta_vaga';
$current = 2;
$titulopage = 'Oferta de Vaga';

session_start();

// Iniciando Instância

$_SESSION['ID_OFERTA_VAGA'] = $_REQUEST['ID'];
header("Location: ".$url."src/".$pasta."/detail.php");
?>