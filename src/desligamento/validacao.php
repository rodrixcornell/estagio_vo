<?php
require_once "../../php/define.php";


$modulo = 79;
$programa = 10;
$pasta = 'desligamento';
$current = 2;
$titulopage = 'Solicitação de Desligamento';

session_start();

// Iniciando Instância

$_SESSION['ID_SOLICITACAO_DESLIG'] = $_REQUEST['ID'];

header("Location: ".$url."src/".$pasta."/detail.php");

?>