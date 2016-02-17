<?php

require_once "../../php/define.php";
require_once $path . "src/solicitacao/arrays.php";
require_once $pathvo . "solicitacaoVO.php";

$modulo = 79;
$programa = 3;
$pasta = 'solicitacao';
$current = 2;
$titulopage = 'Oferta de Vaga';

session_start();

// Iniciando Instância

$_SESSION['ID_OFERTA_VAGA'] = $_REQUEST['ID'];
header("Location: ".$url."src/".$pasta."/detail.php");
?>