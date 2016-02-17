<?php

require_once "../../php/define.php";
require_once $path . "src/calendario/arrays.php";
require_once $pathvo . "calendarioVO.php";

$modulo = 80;
$programa = 9;
$pasta = 'calendario';
$current = 3;
$titulopage = 'Calendário da Folha de Pagamento';

session_start();

// Iniciando Instância

$id = explode('_', $_REQUEST['ID']);
$_SESSION['ID_CALENDARIO_FOLHA_PAG'] = $id[0];
header("Location: ".$url."src/".$pasta."/detail.php");

?>