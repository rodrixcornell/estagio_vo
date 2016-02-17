<?php
require_once "../../../php/define.php";
require_once $pathvo . "quadro_vagasVO.php";

$VO = new quadro_vagasVO();

$VO->pesquisarAgenciaestagio();
$pesquisarAgenciaestagio = $VO->getArray("TX_AGENCIA_ESTAGIO");

$smarty->assign("pesquisarAgenciaestagio", $pesquisarAgenciaestagio);
?>