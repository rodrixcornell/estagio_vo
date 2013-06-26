<?php
require_once "../../php/define.php";
require_once $path . "src/tbl_calc_recesso/arrays.php";
require_once $pathvo . "tbl_calc_recessoVO.php";

$modulo = 80;
$programa = 6;
$pasta = 'tbl_calc_recesso';
$current = 3;
$titulopage = 'Tabela de Cálculo do Recesso';

session_start();

// Iniciando Instância

$id = explode('_', $_REQUEST['ID']);
$_SESSION['ID_TABELA_RECESSO'] = $id[0];
$_SESSION['ID_ORGAO_GESTOR_ESTAGIO'] = $id[1];
header("Location: ".$url."src/".$pasta."/detail.php");

?>