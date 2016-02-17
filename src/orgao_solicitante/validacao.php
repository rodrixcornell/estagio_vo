<?php
require_once "../../php/define.php";
require_once $pathvo."orgao_solicitanteVO.php";

$modulo = 78;
$programa = 2;
$pasta = 'orgao_solicitante';
$current = 1;
$titulopage = 'Órgão Solicitante';
session_start();

// Iniciando Instância

$_SESSION['ID_ORGAO_ESTAGIO'] = $_REQUEST['ID'];

header("Location: ".$url."src/".$pasta."/detail.php");

?>