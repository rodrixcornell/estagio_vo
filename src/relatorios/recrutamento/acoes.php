<?php

include "../../../php/define.php";
require_once $pathvo."recrutamentoVO.php";

$VO = new recrutamentoVO();


    $VO->CS_SITUACAO = $_REQUEST['CS_SITUACAO'];

    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];

    $total = $VO->buscarRecrutamentoRel();

    $dados = $VO->getVetor();


    echo '<option value="">Escolha...</option>';
    for ($i = 0; $i < $total; $i++) {
        echo '<option value="' . $dados['ID_RECRUTAMENTO_ESTAGIO'][$i] . '">' . $dados['TX_COD_RECRUTAMENTO'][$i] . '</option>';
    }

?>
