<?php

include "../../php/define.php";
require_once $pathvo . "agenciaVO.php";

$modulo = 78;
$programa = 7;

require_once "../autenticacao/validaPermissao.php";

session_start();

function gerarTabela($param = '') {

    /***
     * Cria Mascara somente para exibição
     * http://blog.clares.com.br/php-mascara-cnpj-cpf-data-e-qualquer-outra-coisa/
     */
    function mask($val, $mask) {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k]))
                    $maskared .= $val[$k++];
            }
            else {
                if (isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }

    include "../../php/define.php";
    require_once $pathvo . "agenciaVO.php";
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

    $VO = new agenciaVO();
    $VO->TX_AGENCIA_ESTAGIO = $_REQUEST['TX_AGENCIA_ESTAGIO'];
    $VO->TX_SIGLA = $_REQUEST['TX_SIGLA'];
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
                                <th>Nome da Agência</th>
								<th>Sigla</th>
                                <th>CNPJ</th>
								<th>Data de Cadastro</th>
								<th>Data de Atualização</th>';
        //Somente ver a coluna de alterar se tiver acesso completo a tela
        if ($acesso)
            echo '<th style="width:50px;"></th>';
        echo '</tr>';

        for ($i = 0; $i < $tot_da_pagina; $i++) {
            ($bgcolor == '#E6E6E6') ? $bgcolor = '#F0EFEF' : $bgcolor = '#E6E6E6';

            echo '<tr bgcolor="' . $bgcolor . '">
                            <td align="center">' . $dados['TX_AGENCIA_ESTAGIO'][$i] . '</td>
							<td align="center">' . $dados['TX_SIGLA'][$i] . '</td>
							<td align="center">' . mask($dados['TX_CNPJ'][$i],'##.###.###/####-##') . '</td>
                            <td align="center">' . $dados['DT_CADASTRO'][$i] . '</td>
							<td align="center">' . $dados['DT_ATUALIZACAO'][$i] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela
            if ($acesso)
                echo '<td align="center">
								<a href="' . $dados['ID_AGENCIA_ESTAGIO'][$i] . '" id="alterar"><img src="' . $urlimg . 'icones/editar.png" alt="itens" title="Alterar"/></a>
								<a href="' . $dados['ID_AGENCIA_ESTAGIO'][$i] . '" id="excluir"><img src="' . $urlimg . 'icones/excluirItem.png" alt="itens" title="Excluir"/></a></td>';
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

$VO = new agenciaVO();

if ($_REQUEST['identifier'] == "tabela") {
    gerarTabela($erro);
} else if ($_REQUEST['identifier'] == 'excluir') {

    $VO->ID_AGENCIA_ESTAGIO = $_REQUEST['ID'];

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