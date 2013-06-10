<?php

include "../../php/define.php";
require_once $path . "src/solicitacao/arrays.php";
require_once $pathvo . "solicitacaoVO.php";

$modulo = 79;
$programa = 3;

require_once "../autenticacao/validaPermissao.php";

session_start();

function gerarTabela($param = '') {
    include "../../php/define.php";
    require_once $pathvo . "solicitacaoVO.php";
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

    $VO = new solicitacaoVO();
    $VO->ID_SOLICITACAO_ESTAGIO = $_SESSION['ID_SOLICITACAO_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO = $_SESSION['ID_ORGAO_ESTAGIO'];
    $page = $_REQUEST['PAGE'];


    $qtd = 15;
    !$page ? $page = 1 : false;
    $primeiro = ($page * $qtd) - $qtd;

    $total = $VO->pesquisarVagasSolicitadas();

    $total_page = ceil($total / $qtd);

    $VO->Reg_inicio = $primeiro;
    $VO->Reg_quantidade = $qtd;
    $tot_da_pagina = $VO->pesquisarVagasSolicitadas();

    echo '
        <table width="100%" id="tabelaItens" >
            <tr>
                <th style="width:210px;">Órgão Gestor</th>
                <th style="width:210px;">Agencia de Estágio</th>
                <th>Tipo</th>
                <th style="width:70px;">Quantidade</th>
                <th style="width:210px;">Curso</th>';

    //Somente ver a coluna de alterar se tiver acesso completo a tela
    if ($acesso)
        echo '<th style="width:50px;"></th>';

    echo '</tr>';

    if ($tot_da_pagina) {
        $dados = $VO->getVetor();

        for ($i = 0; $i < $tot_da_pagina; $i++) {

            ($bgcolor == '#F0F0F0') ? $bgcolor = '#DDDDDD' : $bgcolor = '#F0F0F0';

            echo '
                <tr bgcolor="' . $bgcolor . '" onmouseover="mudarCor(this);" onmouseout="mudarCor(this);">
                    <td align="center">' . $dados['TX_ORGAO_ESTAGIO'][$i] . '</td>
                    <td align="center">' . $dados['TX_AGENCIA_ESTAGIO'][$i] . '</td>
                    <td align="center">' . $dados['TX_TIPO_VAGA_ESTAGIO'][$i] . '</td>
                    <td align="center">' . $dados['NB_QUANTIDADE'][$i] . '</td>
                    <td align="center">' . $dados['TX_CURSO_ESTAGIO'][$i] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela
            if ($acesso)
                echo '
                    <td align="center" class="icones">
                        <a href="' . $dados['CODIGO'][$i] . '" id="alterar" ><img src="' . $urlimg . 'icones/alterarItem.png" title="Excluir Registro"/></a>
                        <a href="' . $dados['CODIGO'][$i] . '" id="excluir" ><img src="' . $urlimg . 'icones/excluirItem.png" title="Excluir Registro"/></a></td>';
            echo '</tr>';
        }

        echo'</table>';

        if ($total_page > 1) {
            echo '<div id="paginacao" align="center"><ul>';

            for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $page)
                    echo '<li id="' . $i . '" class="selecionado">' . $i . '</li>';
                else
                    echo '<li id="' . $i . '">' . $i . '</li>';
            }
            echo '</ul></div><br><br>';
        }
    }else
        echo '<tr><td colspan="6" class="nenhum">Nenhum registro encontrado.</td></tr></table><br /> ';

    if ($param)
        echo '<script>alert("' . $param . '")</script>';
}

$VO = new solicitacaoVO();

if ($_REQUEST['identifier'] == "tabela") {
    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];
    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_REQUEST['ID_ORGAO_GESTOR_ESTAGIO'];
    $VO->ID_AGENCIA_ESTAGIO = $_REQUEST['ID_AGENCIA_ESTAGIO'];
    $VO->CS_SITUACAO = $_REQUEST['CS_SITUACAO'];
    $VO->TX_ORGAO_ESTAGIO = $_REQUEST['TX_ORGAO_ESTAGIO'];

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
        echo '
            <table width="100%" class="dataGrid">
                <tr>
                    <th>Código</th>
                    <th>Órgão Gestor</th>
                    <th>Órgão Solicitante</th>
                    <th>Agencia de Estágio</th>
                    <th>Situação</th>';
        //Somente ver a coluna de alterar se tiver acesso completo a tela
        //if ($acesso)
        echo '<th style="width:30px;"></th>';
        echo '</tr>';

        for ($i = 0; $i < $tot_da_pagina; $i++) {
            ($bgcolor == '#E6E6E6') ? $bgcolor = '#F0EFEF' : $bgcolor = '#E6E6E6';

            echo '
                <tr bgcolor="' . $bgcolor . '">
                    <td align="center">' . $dados['TX_COD_SOLICITACAO'][$i] . '</td>
                    <td align="center">' . $dados['TX_ORGAO_ESTAGIO'][$i] . '</td>
                    <td align="center">' . $dados['TX_ORGAO_GESTOR_ESTAGIO'][$i] . '</td>
                    <td align="center">' . $dados['TX_AGENCIA_ESTAGIO'][$i] . '</td>
                    <td align="center">' . $arraySituacao[$dados['CS_SITUACAO'][$i]] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela
            //if ($acesso)
            echo '
                <td align="center">
                    <a href="' . $dados['ID_SOLICITACAO_ESTAGIO'][$i] . '" id="alterar"><img src="' . $urlimg . 'icones/editar.png" alt="itens" title="Alterar"/></a></td>';
            echo '</tr>';
        }

        echo '</table>';

        if ($total_page > 1) {
            echo '<div id="paginacao" align="center"><ul>';

            for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $page)
                    echo '<li id="' . $i . '" class="selecionado">' . $i . '</li>';
                else
                    echo '<li id="' . $i . '">' . $i . '</li>';
            }
            echo '</ul></div>';
        }
    }else {
        echo '<div id="nao_encontrado">Nenhum registro encontrado.</div>';
    }
} else if ($_REQUEST['identifier'] == "pesquisarQuadroVagasEstagio") {

    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_REQUEST['ID_ORGAO_GESTOR_ESTAGIO'];
    $VO->ID_AGENCIA_ESTAGIO = $_REQUEST['ID_AGENCIA_ESTAGIO'];

    $total = $VO->pesquisarQuadroVagasEstagio();

    if ($total) {
        $dados = $VO->getVetor();
        echo '<option value="">Escolha...</option>';
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_CODIGO'][$i] . '</option>';
        }
    }
} else if ($_REQUEST['identifier'] == "buscarQuantidade") {

    $VO->ID_ORGAO_ESTAGIO = $_SESSION['ID_ORGAO_ESTAGIO'];
    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_REQUEST['ID_QUADRO_VAGAS_ESTAGIO'];
    $VO->CS_TIPO_VAGA_ESTAGIO = $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];

    $VO->buscarQuantidade();

    $dados = $VO->getVetor();

    echo $dados['NB_QUANTIDADE'][0];
} else if ($_REQUEST['identifier'] == "buscarCursos") {

    $VO->buscarCursos();
    $dados = $VO->getArray("TX_CURSO_ESTAGIO");

    foreach ($dados as $key => $value) {
        ($_REQUEST['ID_CURSO_ESTAGIO'] == $key) ? $selected = 'selected' : $selected = '';
        echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option> ';
    }
} else if ($_REQUEST['identifier'] == "tabelaVagasSolicitadas") {
    gerarTabela();
} else if ($_REQUEST['identifier'] == "inserirVagasSolicitadas") {

    $VO->ID_SOLICITACAO_ESTAGIO = $_SESSION['ID_SOLICITACAO_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO = $_SESSION['ID_ORGAO_ESTAGIO'];

    $valor = explode('_', $_REQUEST['ID_CS_CODIGO']);
    $VO->ID_QUADRO_VAGAS_ESTAGIO = $valor[0];
    $VO->CS_TIPO_VAGA_ESTAGIO = $valor[1];
    $VO->ID_CURSO_ESTAGIO = $valor[2];

    $VO->NB_QUANTIDADE = $_REQUEST['NB_QUANTIDADE'];
    $VO->ID_CURSO_ESTAGIO = $_REQUEST['ID_CURSO_ESTAGIO'];

    if ($acesso) {
        if ($VO->ID_QUADRO_VAGAS_ESTAGIO && $VO->CS_TIPO_VAGA_ESTAGIO && $VO->ID_CURSO_ESTAGIO && $VO->NB_QUANTIDADE) {
            $retorno = $VO->inserirVagasSolicitadas();

            if ($retorno) {
                $erro = 'Registro já existe.';
            }
        }else
            $erro = 'Para inserir escolha Tipo e Quantidade.';
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);
}else if ($_REQUEST['identifier'] == 'atualizarInf') {

    $VO->ID_RESP_UNID_IRP = $_SESSION['ID_RESP_UNID_IRP'];
    ;

    $dados = $VO->atualizarInf();

    echo json_encode($dados);
}/* else if ($_REQUEST['identifier'] == "inserirTodas"){

  $VO->ID_USUARIO 			= $_SESSION['ID_USUARIO_ACESSO'];

  $VO->inserirTodas();

  gerarTabela();

  } */ else if ($_REQUEST['identifier'] == 'excluirUnidade') {

    $VO->ID_RESP_UNID_IRP = $_SESSION['ID_RESP_UNID_IRP'];
    $VO->ID_UNIDADE_IRP = $_REQUEST['ID_UNIDADE_IRP'];

    if ($acesso) {

        $retorno = $VO->excluirUnidade();

        if (is_array($retorno))
            $erro = 'Este registro não pode ser excluído pois possui dependentes.';
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);
}
?>