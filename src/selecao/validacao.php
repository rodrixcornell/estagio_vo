<?php

require_once "../../php/define.php";
require_once $pathvo . "selecaoVO.php";

$modulo = 78;
$programa = 6;
$pasta = 'selecao';
$current = 1;
$titulopage = 'Seleção de Estágio';

session_start();

// Iniciando Instância

$_SESSION['ID_SELECAO_ESTAGIO'] = $_REQUEST['ID'];

header("Location: " . $url . "src/" . $pasta . "/detail.php");
?>