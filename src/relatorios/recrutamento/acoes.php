<?php
include "../../../php/define.php";
require_once $pathvo."recrutamentoVO.php";



$VO = new recrutamentoVO();

$VO->ID_RECRUTAMENTO_ESTAGIO = $_REQUEST['ID_RECRUTAMENTO_ESTAGIO'];

	$VO->ID_ORGAO_ESTAGIO	= $_REQUEST['ID_ORGAO_ESTAGIO'];
	
	$total = $VO->buscarRecrutamentoRel();
        
        $dados = $VO->getVetor();

		echo '<option value="">Escolha...</option>';
		for ($i=0; $i<$total; $i++){
			echo '<option value="'.$dados['ID_INVENTARIO_PATRIMONIO'][$i].'">'.$dados['NB_INVENTARIO_PATRIMONIO'][$i].'</option>';
		}		
	

?>
