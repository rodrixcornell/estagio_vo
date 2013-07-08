<?php
require_once "../../php/define.php";
require_once $pathvo."grupo_pagamentoVO.php";
	
$VO = new grupo_pagamentoVO();

$VO->pesquisarGrupo_pagamento();

$arrayGrupo = $VO->getArray("TX_GRUPO_PAGAMENTO");   

$smarty->assign("arrayGrupo", $arrayGrupo);

?>
