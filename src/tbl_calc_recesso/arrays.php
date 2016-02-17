<?php
require_once "../../php/define.php";
require_once $pathvo."tbl_calc_recessoVO.php";

$VO = new tbl_calc_recessoVO();

$VO->pesquisarOrgaoGestor();
    $arrayOrgaoGestor = $VO->getArray("TX_ORGAO_GESTOR_ESTAGIO");

$smarty->assign("arrayOrgaoGestor", $arrayOrgaoGestor);
?>
