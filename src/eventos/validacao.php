<?php
require_once "../../php/define.php";
require_once $pathvo."eventosVO.php";

$modulo = 78;
$programa = 2;
$pasta = 'eventos';
$current = 3;
$titulopage = 'Evento de Pagamento';
session_start();

// Iniciando Instância

$_SESSION['ID_ITEM_PAGAMENTO_ESTAGIO'] = $_REQUEST['ID'];

header("Location: ".$url."src/".$pasta."/detail.php");

?>