<?php
require_once "../../../php/define.php";
require_once $pathvo."quadro_vagasVO.php";
	
$VO = new quadro_vagasVO();

//$VO->tabelaDiarias();
  //  $tabelaDiarias = $VO->getArray("TABELA");	
    
    
$VO->pesquisarCodigo();
$pesquisarCodigo = $VO->getArray("TX_CODIGO");

$smarty->assign("tabelaDiarias", $tabelaDiarias);
$smarty->assign("pesquisarCodigo", $pesquisarCodigo);
?>
