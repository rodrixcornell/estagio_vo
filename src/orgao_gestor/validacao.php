<?php
require_once "../../php/define.php";

$modulo = 78;
$programa = 1;
$pasta = 'orgao_gestor';
$current = 1;
$titulopage = 'Órgão Gestor de Estágio';
session_start();

// Iniciando Instância

$_SESSION['ID_ORGAO_GESTOR_ESTAGIO'] = $_REQUEST['ID'];

header("Location: ".$url."src/".$pasta."/alterar.php");

?>