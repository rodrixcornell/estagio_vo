<?php
require_once "../../php/define.php";
require_once $pathvo."ta_contratoVO.php";

$VO = new ta_contratoVO();

$VO->pesquisarOrgaoGestor();
    $arrayOrgaoGestor = $VO->getArray("TX_ORGAO_GESTOR_ESTAGIO");

$VO->pesquisarCodigoContrato();
    $arrayCodigoContrato = $VO->getArray("NB_CODIGO");

$VO->pesquisarCodTermoAditivo();
    $arrayCodTermoAditivo = $VO->getArray("NB_CODIGO");

$VO->buscarUnidadeOrigem();
    $arraybuscarUnidadeOrigem = $VO->getArray("TX_UNIDADE_ORIGEM");

$VO->buscarUnidadeDestino();
    $arraybuscarUnidadeDestino = $VO->getArray("TX_UNIDADE_DESTINO");

$VO->pesquisarTipoVaga();
    $arrayTipoVaga = $VO->getArray("TX_TIPO_VAGA_ESTAGIO");

$arraySituacao = array(""=>"Escolha...", 1=>"ABERTA", 2=>"EFETIVADA", 3=>"CANCELADA");

$smarty->assign("arraySituacao", $arraySituacao);
$smarty->assign("arrayOrgaoGestor", $arrayOrgaoGestor);
$smarty->assign("arrayCodigoContrato", $arrayCodigoContrato);
$smarty->assign("arrayCodTermoAditivo", $arrayCodTermoAditivo);
$smarty->assign("arraybuscarUnidadeOrigem", $arraybuscarUnidadeOrigem);
$smarty->assign("arraybuscarUnidadeDestino", $arraybuscarUnidadeDestino);
$smarty->assign("arrayTipoVaga", $arrayTipoVaga);

?>