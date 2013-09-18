<?php
require_once "../../php/define.php";
require_once $pathvo."ta_contratoVO.php";

$VO = new ta_contratoVO();

$arraySituacao = array(""=>"Escolha...", 1=>"Aberta", 2=>"Efetivada", 3=>"Cancelada");

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

    
$smarty->assign("arraySituacao", $arraySituacao);
$smarty->assign("arrayOrgaoGestor", $arrayOrgaoGestor);
$smarty->assign("arrayCodigoContrato", $arrayCodigoContrato);
$smarty->assign("arrayCodTermoAditivo", $arrayCodTermoAditivo);
$smarty->assign("arraybuscarUnidadeOrigem", $arraybuscarUnidadeOrigem);
$smarty->assign("arraybuscarUnidadeDestino", $arraybuscarUnidadeDestino);

?>