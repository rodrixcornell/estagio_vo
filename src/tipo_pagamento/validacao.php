<?php
require_once "../../php/define.php";
require_once $pathvo . "tipo_pagamentoVO.php";

$modulo = 80;
$programa = 4;
$pasta = 'tipo_pagamento';
$current = 3;
$titulopage = 'Tipo de Pagamento';

session_start();

$_SESSION['CS_TIPO_PAG_ESTAGIO'] = $_REQUEST['ID'];

header("Location: " . $url . "src/" . $pasta . "/alterar.php");
?>