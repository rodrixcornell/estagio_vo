<?php
include "../../php/define.php";
require_once $pathvo . "agente_setorialVO.php";

$modulo = 78;
$programa = 3;

require_once "../autenticacao/validaPermissao.php";

session_start();

function gerarTabela($param = '') {
    include "../../php/define.php";
    require_once $pathvo . "agente_setorialVO.php";
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

    $VO = new agente_setorialVO();
    $VO->ID_SETORIAL_ESTAGIO = $_SESSION['ID_SETORIAL_ESTAGIO'];
    $VO->TX_FUNCIONARIO = $_SESSION['TX_FUNCIONARIO'];
    $page = $_REQUEST['PAGE'];


    $qtd = 15;
    !$page ? $page = 1 : false;
    $primeiro = ($page * $qtd) - $qtd;

    $total = $VO->buscarUnidades();

    $total_page = ceil($total / $qtd);

    $VO->Reg_inicio = $primeiro;
    $VO->Reg_quantidade = $qtd;
    $tot_da_pagina = $VO->buscarUnidades();

    echo '<table width="100%" id="tabelaItens" >
        <tr>
        <th>Órgão Solicitante</th>
        <th>Unidade Organizacional</th>
        <th style="width:145px;">Data de Atualização</th>';

    //Somente ver a coluna de alterar se tiver acesso completo a tela
    if ($acesso)
        echo '<th style="width:30px;"></th>';

    echo '</tr>';

    if ($tot_da_pagina) {
        $dados = $VO->getVetor();

        for ($i = 0; $i < $tot_da_pagina; $i++) {

            ($bgcolor == '#F0F0F0') ? $bgcolor = '#DDDDDD' : $bgcolor = '#F0F0F0';

            echo '<tr bgcolor="' . $bgcolor . '" onmouseover="mudarCor(this);" onmouseout="mudarCor(this);">
                <td align="center">' . $dados['TX_ORGAO_ESTAGIO'][$i] . '</td>
                <td align="center">' . $dados['TX_UNIDADE_ORG'][$i] . '</td>
                <td align="center">' . $dados['DT_ATUALIZACAO'][$i] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela
            if ($acesso)
                echo '<td align="center" class="icones">
		<a href="' . $dados['ID_ORGAO_ESTAGIO'][$i] . '" id="excluir" ><img src="' . $urlimg . 'icones/excluirItem.png" title="Excluir Registro"/></a></td>';
            echo '</tr>';
        }

        echo'</table>';

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
				  </div><br><br>';
        }
    }else
        echo '<tr><td colspan="4" class="nenhum">Nenhum registro encontrado.</td></tr></table><br /> ';

    if ($param)
        echo '<script>alert("' . $param . '")</script>';
}

$VO = new agente_setorialVO();

if ($_REQUEST['identifier'] == "tabela") {
    $VO->ID_USUARIO_RESP = $_REQUEST['ID_USUARIO_RESP'];
    $VO->TX_FUNCIONARIO = $_REQUEST['TX_FUNCIONARIO'];

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

        echo '<table width="100%" class="dataGrid">
             <th>Usuário</th>
             <th>Funcionário</th>
             <th>Data de Cadastro</th>
             <th style="width:150px;">Data de Atualização</th>
								';
        //Somente ver a coluna de alterar se tiver acesso completo a tela
        //if ($acesso)
            echo '<th style="width:30px;"></th>';
        echo '</tr>';

        for ($i = 0; $i < $tot_da_pagina; $i++) {
            ($bgcolor == '#E6E6E6') ? $bgcolor = '#F0EFEF' : $bgcolor = '#E6E6E6';

            echo '<tr bgcolor="' . $bgcolor . '">
                <td align="center">' . $dados['TX_LOGIN'][$i] . '</td>
                <td align="center">' . $dados['TX_FUNCIONARIO'][$i] . '</td>
                <td align="center">' . $dados['DT_CADASTRO'][$i] . '</td>
                <td align="center">' . $dados['DT_ATULIZACAO'][$i] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela
           // if ($acesso)
                echo '<td align="center">
		  <a href="' . $dados['ID_SETORIAL_ESTAGIO'][$i] . '" id="alterar"><img src="' . $urlimg . 'icones/editar.png" alt="itens" title="Visualizar"/></a></td>';

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
        echo '<div id="nao_encontrado">Nenhum registro encontrado.</div>';
    }
} else if ($_REQUEST['identifier'] == "buscarNome") {

    $VO->ID_USUARIO = $_REQUEST['ID_USUARIO_RESP'];

    $VO->pesquisarUsuario();
    $dados = $VO->getVetor();



    echo $dados['TX_FUNCIONARIO'][0];
} else if ($_REQUEST['identifier'] == "tabelaUnidade") {
    gerarTabela();
} else if ($_REQUEST['identifier'] == "inserirOrgao") {

    $VO->ID_SETORIAL_ESTAGIO = $_SESSION['ID_SETORIAL_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];

    if ($acesso) {
        if ($VO->ID_ORGAO_ESTAGIO) {
            $retorno = $VO->inserirOrgao();

            if ($retorno) {
                $erro = 'Registro já existe.';
            }
        }else
            $erro = 'Para inserir escolha uma Unidade Solicitante.';
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);
}else if ($_REQUEST['identifier'] == 'atualizarInf') {

    $VO->ID_SETORIAL_ESTAGIO = $_SESSION['ID_SETORIAL_ESTAGIO'];


    $dados = $VO->atualizarInf();

    echo json_encode($dados);
} else if ($_REQUEST['identifier'] == 'excluirOrgao') {

    $VO->ID_SETORIAL_ESTAGIO = $_SESSION['ID_SETORIAL_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];

    if ($acesso) {

        $retorno = $VO->excluirOrgao();

        if (is_array($retorno))
            $erro = 'Este registro não pode ser excluído pois possui dependentes.';
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);
}
?>