<?php

include "../../php/define.php";
require_once $pathvo . "termo_aditivoVO.php";

$modulo = 80;
$programa = 5;

require_once "../autenticacao/validaPermissao.php";

session_start();

function gerarTabela($param = '') {
    include "../../php/define.php";
    require_once $pathvo . "termo_aditivoVO.php";
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

    $VO = new termo_aditivoVO();
    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_REQUEST['ID_ORGAO_GESTOR_ESTAGIO'];
    $VO->NB_CODIGO = $_REQUEST['NB_CODIGO'];
    $VO->TX_TERMO_ADITIVO = $_REQUEST['TX_TERMO_ADITIVO'];
    $page = $_REQUEST['PAGE'];

    $VO->preencherSessionPesquisar($_REQUEST);

    $qtd = 15;
    !$page ? $page = 1 : false;
    $primeiro = ($page * $qtd) - $qtd;

    $total = $VO->pesquisar();

    $total_page = ceil($total / $qtd);

    $VO->Reg_inicio = $primeiro;
    $VO->Reg_quantidade = $qtd;
    $tot_da_pagina = $VO->pesquisar();

    if ($tot_da_pagina) {
        $dados = $VO->getVetor();
        echo '<div id="status">' . $_SESSION['STATUS'] . '</div>
		<table width="100%" class="dataGrid">
                            <tr>
                                <th>Código do Contrato</th>
				<th>Termo Aditivo</th>
				<th>Órgão Gestor</th>
				<th>Data TA</th>
                                <th>Objeto do Termo Aditivo</th>';

        //Somente ver a coluna de alterar se tiver acesso completo a tela					
        if ($acesso)
            echo '<th style="width:50px;"></th>';
        echo '</tr>';

        for ($i = 0; $i < $tot_da_pagina; $i++) {
            ($bgcolor == '#E6E6E6') ? $bgcolor = '#F0EFEF' : $bgcolor = '#E6E6E6';

            echo '<tr bgcolor="' . $bgcolor . '">
                            <td align="center">' . $dados['NB_CODIGO'][$i] . '</td>
                            <td align="center">' . $dados['TX_TERMO_ADITIVO'][$i] . '</td>
                            <td align="center">' . $dados['TX_ORGAO_GESTOR_ESTAGIO'][$i] . '</td>
                            <td align="center">' . $dados['DT_ADITIVO'][$i] . '</td>
                            <td align="center">' . $dados['TX_OBJETO'][$i] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela					
            if ($acesso)
                echo '<td align="center"> 
						<a href="' . $dados['ID_ADITIVO_CONTRATO_CP'][$i] . '" id="alterar"><img src="' . $urlimg . 'icones/editar.png" alt="itens" title="Alterar"/></a>
						<a href="' . $dados['ID_ADITIVO_CONTRATO_CP'][$i] . '" id="excluir"><img src="' . $urlimg . 'icones/excluirItem.png" alt="itens" title="Excluir"/></a></td>';
            echo '</tr>';
        }

        echo '</table>';

        if ($total_page > 1) {
            echo '<div id="paginacao" align="center">
					<ul>';

            for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $page)
                    echo '<li id="' . $i . '" class="selecionado">' . $i . '</li>';
                else
                    echo '<li id="' . $i . '">' . $i . '</li>';
            }
            echo '	</ul>
				  </div>';
        }
    }else {
        echo '<div id="status">' . $_SESSION['STATUS'] . '</div>
				<div id="nao_encontrado">Nenhum registro encontrado.</div>';
    }

    if ($param)
        echo '<script>alert("' . $param . '")</script>';

    unset($_SESSION['STATUS']);
}

$VO = new termo_aditivoVO();

if ($_REQUEST['identifier'] == "tabela") {
    gerarTabela($erro);
} else if ($_REQUEST['identifier'] == 'excluir') {

    $VO->ID_ADITIVO_CONTRATO_CP = $_REQUEST['ID_ADITIVO_CONTRATO_CP'];

    if ($acesso) {

        $retorno = $VO->excluir();

        if (is_array($retorno))
            $erro = 'Este registro não pode ser excluído pois possui dependentes.';
        else
            $_SESSION['STATUS'] = '*Registro excluído com sucesso!';
    }
    else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);
}
?>