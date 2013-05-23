<?php
require_once "../../php/define.php";
require_once $pathvo."eventosVO.php";
	
$VO = new eventosVO();

$arrayTipoEvento = array('' => "ESCOLHA...", 1 => "CRÉDITO", 2 => "DÉBITO", 3 => "INFORMATIVO");
$arraySituacao = array('' => "ESCOLHA...", 2 => "ATIVADO", 1 => "DESATIVADO");

$smarty->assign("arrayTipoEvento"   , $arrayTipoEvento);
$smarty->assign("arraySituacao"    	, $arraySituacao);
 
?>
