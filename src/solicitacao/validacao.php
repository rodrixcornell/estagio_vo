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

$id = explode('_', $_REQUEST['ID']);
$_SESSION['ID_SOLICITACAO_ESTAGIO'] = $id[0];
$_SESSION['ID_ORGAO_ESTAGIO'] = $id[1];
header("Location: ".$url."src/".$pasta."/detail.php");

?>