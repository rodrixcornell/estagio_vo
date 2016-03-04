<?php

require_once "../../php/define.php";
require_once $pathvo . "estagiarioVO.php";

$VO = new estagiarioVO();

//$VO->pesquisarLocalidade();
//$arrayLocalidade = $VO->getArray("TX_LOCALIDADE");

//$VO->pesquisarFuncionario();
//$arrayFuncionario = $VO->getArray("TX_FUNCIONARIO");

//$VO->pesquisarCurso();
//$arrayCurso = $VO->getArray('TX_CURSO_ESTAGIO');

//$VO->pesquisarOfertaVaga();
//$arrayOfertaVaga = $VO->getArray('TX_CODIGO_OFERTA_VAGA');

$arraySexo[''] = 'Escolha...';
$arraySexo[1] = 'Masculino';
$arraySexo[2] = 'Feminino';

$arrayPCD[''] = 'Escolha...';
$arrayPCD[1] = 'Sim';
$arrayPCD[2] = 'Não';

//$arrayTurno = array('Escolha...', 1 => 'Matutino', 2 => 'Vespertino', 3 => 'Diurno', 4 => 'Noturno');

//$smarty->assign("arrayLocalidade", $arrayLocalidade);
//$smarty->assign("arrayFuncionario", $arrayFuncionario);
//$smarty->assign("arrayCurso", $arrayCurso);
//$smarty->assign("arrayOfertaVaga", $arrayOfertaVaga);
$smarty->assign("arraySexo", $arraySexo);
$smarty->assign("arrayPDC", $arrayPCD);
//$smarty->assign("arrayTurno", $arrayTurno);
?>
