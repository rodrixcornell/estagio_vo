<?php
require_once "../../php/define.php";
require_once $pathvo . "tipo_pagamentoVO.php";

$VO = new tipo_pagamentoVO();

$VO->pesquisarTipo();
$pesquisarTipo = $VO->getArray("TX_TIPO_PAG_ESTAGIO");

$smarty->assign("pesquisarTipo", $pesquisarTipo);
?>