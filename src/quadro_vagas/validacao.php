<?php
require_once "../../php/define.php";
require_once $pathvo . "quadro_vagasVO.php";

$modulo = 78;
$programa = 9;
$pasta = 'quadro_vagas';
$current = 1;
$titulopage = 'Quadro de vagas';
session_start();

// Iniciando Instância
$sessao = explode('_',$_REQUEST['ID']);
$_SESSION['ID_QUADRO_VAGAS_ESTAGIO']=$sessao[0];

// Caso seja Editar cadastro redireciona para o detail.php
// 
if($sessao[1]==1){
	header("Location: " . $url . "src/" . $pasta . "/detail.php");
}else{
	header("Location: " . $url . "src/" . $pasta . "/tabela.php");
}


?>