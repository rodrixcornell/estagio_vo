<?php

include "../../php/define.php";
require_once $pathvo . "cursoVO.php";

$modulo = 78;
$programa = 5;

require_once "../autenticacao/validaPermissao.php";

session_start();

function gerarTabela($param = '') {
    include "../../php/define.php";
    require_once $pathvo . "cursoVO.php";
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

    $VO = new cursoVO();
    $VO->TX_CURSO_ESTAGIO = $_REQUEST['TX_CURSO_ESTAGIO'];
    $VO->CS_AREA_CONHECIMENTO = $_REQUEST['CS_AREA_CONHECIMENTO'];
    $page = $_REQUEST['PAGE'];



    $VO->preencherSessionPesquisar($_REQUEST);

    $qtd = 5;
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
                                <th>Nome do Curso</th>
				<th>Área de Conhecimento</th>';
        //Somente ver a coluna de alterar se tiver acesso completo a tela					
        if ($acesso)
            echo '<th style="width:50px;"></th>';
        echo '</tr>';

        for ($i = 0; $i < $tot_da_pagina; $i++) {
            ($bgcolor == '#E6E6E6') ? $bgcolor = '#F0EFEF' : $bgcolor = '#E6E6E6';

            echo '<tr bgcolor="' . $bgcolor . '">
                            <td align="center">' . $dados['TX_CURSO_ESTAGIO'][$i] . '</td>
                            <td align="center">' . $dados['TX_AREA_CONHECIMENTO'][$i] . '</td>';


            //Somente ver a coluna de alterar se tiver acesso completo a tela					
            if ($acesso)
                echo '<td align="center"> 
                    <a href="' . $dados['ID_CURSO_ESTAGIO'][$i] . '" id="alterar"><img src="' . $urlimg . 'icones/editar.png" alt="itens" title="Alterar"/></a>
                    <a href="' . $dados['ID_CURSO_ESTAGIO'][$i] . '" id="excluir"><img src="' . $urlimg . 'icones/excluirItem.png" alt="itens" title="Excluir"/></a></td>';
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

$VO = new cursoVO();

if ($_REQUEST['identifier'] == "tabela") {
    gerarTabela($erro);
} else if ($_REQUEST['identifier'] == 'excluir') {

    $VO->ID_CURSO_ESTAGIO = $_REQUEST['ID_CURSO_ESTAGIO'];

    if ($acesso) {

        $retorno = $VO->excluir();

        if (is_array($retorno))
            $erro = 'Este registro não pode ser excluído pois possui dependentes.';
        else
            $_SESSION['STATUS'] = '*Registro excluído com sucesso!';
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);
}
?>