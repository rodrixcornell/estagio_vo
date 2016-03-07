<?php
require_once "../../php/define.php";
require_once $pathvo . "instituicao_estagioVO.php";

$modulo = 78;
$programa = 7;
$pasta = 'instituicao_estagio';
$current = 1;
$titulopage = 'Instituição de Estágio';

session_start();
$_SESSION['ID_AGENCIA_ESTAGIO'] = $_REQUEST['ID'];
header("Location: " . $url . "src/" . $pasta . "/alterar.php");
?>