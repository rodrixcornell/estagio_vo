<?php

require_once "../../php/define.php";
require_once $pathvo . "calendarioVO.php";

$VO = new calendarioVO();

$VO->pesquisarOrgaoGestor();
$arrayOrgaoGestor = $VO->getArray("TX_ORGAO_GESTOR_ESTAGIO");

$arrayAnos = array(
    '' => 'Escolha...',
    //date('Y') + 8 => date('Y') + 8,
    //date('Y') + 7 => date('Y') + 7,
    //date('Y') + 6 => date('Y') + 6,
    date('Y') + 5 => date('Y') + 5,
    date('Y') + 4 => date('Y') + 4,
    date('Y') + 3 => date('Y') + 3,
    date('Y') + 2 => date('Y') + 2,
    date('Y') + 1 => date('Y') + 1,
    date('Y') => date('Y'),
    date('Y') - 1 => date('Y') - 1,
    date('Y') - 2 => date('Y') - 2,
    date('Y') - 3 => date('Y') - 3,
    date('Y') - 4 => date('Y') - 4,
    date('Y') - 5 => date('Y') - 5,
    //date('Y') - 6 => date('Y') - 6,
    //date('Y') - 7 => date('Y') - 7,
    //date('Y') - 8 => date('Y') - 8,
);

$arrayMeses = array('Escolha...', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');

$smarty->assign("arrayOrgaoGestor", $arrayOrgaoGestor);
$smarty->assign("arrayAnos", $arrayAnos);
$smarty->assign("arrayAnos_id", date('Y'));
$smarty->assign("arrayMeses", $arrayMeses);
$smarty->assign("arrayMeses_id", date('m'));
?>
