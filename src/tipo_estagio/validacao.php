<?php
require_once "../../php/define.php";

$modulo = 78;
$programa = 4;
$pasta = 'tipo_estagio';
$current = 1;
$titulopage = 'Tipo de Vaga de Estágio';
session_start();

// Iniciando Instância

$_SESSION['CS_TIPO_VAGA_ESTAGIO'] = $_REQUEST['ID'];

header("Location: ".$url."src/".$pasta."/alterar.php");

?>