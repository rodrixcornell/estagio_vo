<?php
require_once "../../php/define.php";
require_once $pathvo."eventosVO.php";
	
$VO = new eventosVO();

$arrayTipoEvento = array('' => "Escolha...", 1 => "Crédito", 2 => "Débito", 3 => "Informativo");
$arraySituacao = array('' => "Escolha...", 1 => "Ativado", 2 => "Desativado");

$smarty->assign("arrayTipoEvento"   , $arrayTipoEvento);
$smarty->assign("arraySituacao"    	, $arraySituacao);
 
?>
