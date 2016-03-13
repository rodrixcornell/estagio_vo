<?php
require_once "../../php/define.php";
require_once $pathvo . "instituicao_estagioVO.php";


$arraySituacao[''] = "Escolha...";
$arraySituacao[1] = "Ativado";
$arraySituacao[2] = "Desativado";

$smarty->assign("arraySituacao", $arraySituacao);
?>