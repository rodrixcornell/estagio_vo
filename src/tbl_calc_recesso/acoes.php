<?php
include "../../php/define.php";
require_once $path . "src/tbl_calc_recesso/arrays.php";
require_once $pathvo . "tbl_calc_recessoVO.php";

$modulo = 80;
$programa = 6;

require_once "../autenticacao/validaPermissao.php";

session_start();

function gerarTabela($param = '') {
    include "../../php/define.php";
    require_once $pathvo . "tbl_calc_recessoVO.php";
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

    $VO = new tbl_calc_recessoVO();
    $VO->ID_TABELA_RECESSO = $_SESSION['ID_TABELA_RECESSO'];

    $page = $_REQUEST['PAGE'];

    $qtd = 15;
    !$page ? $page = 1 : false;
    $primeiro = ($page * $qtd) - $qtd;

    $total = $VO->pesquisarItemTBLRecesso();

    $total_page = ceil($total / $qtd);

    $VO->Reg_inicio = $primeiro;
    $VO->Reg_quantidade = $qtd;
    $tot_da_pagina = $VO->pesquisarItemTBLRecesso();

    echo '
        <table width="100%" id="tabelaItens" >
            <tr>
                <th>Tempo de Estágio (Mês)</th>
                <th>Duração do Recesso (Dia)</th>
                <th>Fórmula</th>
                <th>Data Cadastro</th>
                <th>Data Atualização</th>';

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
                    <td align="center">' . $dados['TX_DURACAO_ESTAGIO'][$i] . '</td>
                    <td align="center">' . $dados['NB_DURACAO_RECESSO'][$i] . '</td>
                    <td align="center">' . $dados['TX_FORMULA_RECESSO'][$i] . '</td>
                    <td align="center">' . $dados['DT_CADASTRO'][$i] . '</td>
                    <td align="center">' . $dados['DT_ATUALIZACAO'][$i] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela
            if ($acesso)
                echo '
                    <td align="center" class="icones">
                        <a href="' . $dados['NB_ITEM_TAB_RECESSO'][$i] . '" id="alterar" >
                            <img src="' . $urlimg . 'icones/alterarItem.png" title="Excluir Registro"/></a>
                        <a href="' . $dados['NB_ITEM_TAB_RECESSO'][$i] . '" id="excluir" >
                            <img src="' . $urlimg . 'icones/excluirItem.png" title="Excluir Registro"/></a></td>';
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
    }
    else
        echo '<tr><td colspan="6" class="nenhum">Nenhum registro encontrado.</td></tr></table><br /> ';

    if ($param)
        echo '<script>alert("' . $param . '")</script>';
}

//-----------------------------------------------------------------------------

function gerarTabelaAlterar($param = '') {
    include "../../php/define.php";
    require_once $pathvo . "tbl_calc_recessoVO.php";
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

    $VO = new tbl_calc_recessoVO();
    $VO->ID_TABELA_RECESSO = $_SESSION['ID_TABELA_RECESSO'];

    $VO->NB_ITEM_TAB_RECESSO = $_REQUEST['NB_ITEM_TAB_RECESSO'];

    $VO->buscarTBLRecesso();
    $dados = $VO->getVetor();

    echo '
        <script>
            $(document).ready(function() {
                $("#NB_DURACAO_RECESSO_ALT").setMask({mask: "9999"});
            })
        </script>

        <br />

        <fieldset>
            <div id="camada" style="width:140px;" >
                <font color="#FF0000">*</font><strong>Tempo de Estágio</strong><br />
                <input type="text" name="TX_DURACAO_ESTAGIO_ALT" id="TX_DURACAO_ESTAGIO_ALT" value="'. $dados['TX_DURACAO_ESTAGIO'][0] .'"  style="width:130px;" /></div>

            <div id="camada" style="width:150px;" >
                <font color="#FF0000">*</font><strong>Duração do Recesso</strong><br />
                <input type="text" name="NB_DURACAO_RECESSO_ALT" id="NB_DURACAO_RECESSO_ALT" value="'. $dados['NB_DURACAO_RECESSO'][0] .'"  style="width:140px;" /></div>

            <div id="camada" style="width:360px;" >
                <font color="#FF0000">*</font><strong>Fórmula</strong><br />
                <input type="text" name="TX_FORMULA_RECESSO_ALT" id="TX_FORMULA_RECESSO_ALT" value="'. $dados['TX_FORMULA_RECESSO'][0] .'"  style="width:350px;" /></div>

            <br />
            <div id="camada" style="width:360px;" >
                Usuário Cadastro:
                <input type="text" name="TX_FUNCIONARIO_CAD_ALT" id="TX_FUNCIONARIO_CAD_ALT" value="'. $dados['TX_FUNCIONARIO_CAD'][0] .'"  style="width:350px;" readonly="readonly" class="leitura"/></div>

            <div id="camada" style="width:140px;" >
                Data Cadastro:
                <input type="text" name="DT_CADASTRO_ALT" id="DT_CADASTRO_ALT" value="'. $dados['DT_CADASTRO'][0] .'"  style="width:130px;" readonly="readonly" class="leitura"/></div>

            <br />
            <div id="camada" style="width:360px;" >
                Usuário Atualização:
                <input type="text" name="TX_FUNCIONARIO_ATUAL_ALT" id="TX_FUNCIONARIO_ATUAL_ALT" value="'. $dados['TX_FUNCIONARIO_ATUAL'][0] .'"  style="width:350px;" readonly="readonly" class="leitura"/></div>

            <div id="camada" style="width:140px;" >
                Data Atualização:
                <input type="text" name="DT_ATUALIZACAO_ALT" id="DT_ATUALIZACAO_ALT" value="'. $dados['DT_ATUALIZACAO'][0] .'"  style="width:130px;" readonly="readonly" class="leitura"/></div>

            <br /><br />
            <input type="hidden" name="NB_ITEM_TAB_RECESSO_ALT" id="NB_ITEM_TAB_RECESSO_ALT" value="'. $dados['NB_ITEM_TAB_RECESSO'][0] .'" />
        </fieldset>

    ';

    if ($param) {
        echo '<script>alert("' . $param . '");</script>';
    }
}

//------------------------------------------------------------------------------

$VO = new tbl_calc_recessoVO();

if ($_REQUEST['identifier'] == "tabela") {
    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_REQUEST['ID_ORGAO_GESTOR_ESTAGIO'];
    $VO->TX_TABELA = $_REQUEST['TX_TABELA'];
    $VO->DT_INICIO_VIGENCIA = $_REQUEST['DT_INICIO_VIGENCIA'];
    $VO->DT_FIM_VIGENCIA = $_REQUEST['DT_FIM_VIGENCIA'];

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

    if ($total) {
        $dados = $VO->getVetor();
        echo '
            <table width="100%" class="dataGrid">
                <tr>
                    <th>Órgão Gestor</th>
                    <th>Nome da Tabela</th>
                    <th>Início Vigência</th>
                    <th>Fim Vigência</th>
                    <th>Data Cadastro</th>
                    <th>Data Atualização</th>';
        //Somente ver a coluna de alterar se tiver acesso completo a tela
        //if ($acesso)
        echo '<th style="width:30px;"></th>';
        echo '</tr>';

        for ($i = 0; $i < $tot_da_pagina; $i++) {
            ($bgcolor == '#E6E6E6') ? $bgcolor = '#F0EFEF' : $bgcolor = '#E6E6E6';

            echo '
                <tr bgcolor="' . $bgcolor . '">
                    <td align="center">' . $dados['TX_ORGAO_GESTOR_ESTAGIO'][$i] . '</td>
                    <td align="center">' . $dados['TX_TABELA'][$i] . '</td>
                    <td align="center">' . $dados['DT_INICIO_VIGENCIA'][$i] . '</td>
                    <td align="center">' . $dados['DT_FIM_VIGENCIA'][$i] . '</td>
                    <td align="center">' . $dados['DT_CADASTRO'][$i] . '</td>
                    <td align="center">' . $dados['DT_ATUALIZACAO'][$i] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela
            //if ($acesso)
            echo '
                <td align="center">
                    <a href="' . $dados['ID_TABELA_RECESSO'][$i] . '_' . $dados['ID_ORGAO_GESTOR_ESTAGIO'][$i] . '" id="alterar">
                        <img src="' . $urlimg . 'icones/editar.png" alt="itens" title="Visualizar"/></a></td>';
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
} else if ($_REQUEST['identifier'] == "tabelaTBLRecesso") {
    gerarTabela();
} else if ($_REQUEST['identifier'] == 'atualizarInf') {

    $VO->ID_TABELA_RECESSO = $_SESSION['ID_TABELA_RECESSO'];

    $dados = $VO->atualizarInf();

    echo json_encode($dados);
} else if ($_REQUEST['identifier'] == "inserirTBLRecesso") {

    $VO->ID_TABELA_RECESSO = $_SESSION['ID_TABELA_RECESSO'];

    $VO->TX_DURACAO_ESTAGIO = $_REQUEST['TX_DURACAO_ESTAGIO'];
    $VO->NB_DURACAO_RECESSO = $_REQUEST['NB_DURACAO_RECESSO'];
    $VO->TX_FORMULA_RECESSO = $_REQUEST['TX_FORMULA_RECESSO'];

    if ($acesso) {
        if ($VO->ID_TABELA_RECESSO && $VO->TX_DURACAO_ESTAGIO && $VO->NB_DURACAO_RECESSO && $VO->TX_FORMULA_RECESSO) {
            $retorno = $VO->inserirTBLRecesso();

            if ($retorno) {
                $erro = 'Registro já existe.';
            }
        }
        else
            $erro = 'Insira o Tempo de Estágio, a Duração do Recesso e/ou a Fórmula.';
    }
    else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);
} else if ($_REQUEST['identifier'] == "excluirTBLRecesso") {

    $VO->ID_TABELA_RECESSO = $_SESSION['ID_TABELA_RECESSO'];

    $VO->NB_ITEM_TAB_RECESSO = $_REQUEST['NB_ITEM_TAB_RECESSO'];

    if ($acesso) {
        $retorno = $VO->excluirTBLRecesso();

        if (is_array($retorno)) {
            $erro = 'Este registro não pode ser excluído pois possui dependentes.';
        }
    }
    else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);
} else if ($_REQUEST['identifier'] == "tabelaAlterarTBLRecesso") {
    gerarTabelaAlterar();
} else if ($_REQUEST['identifier'] == "alterarTBLRecesso") {

    $VO->ID_TABELA_RECESSO = $_SESSION['ID_TABELA_RECESSO'];

    $VO->NB_ITEM_TAB_RECESSO = $_REQUEST['NB_ITEM_TAB_RECESSO'];
    $VO->TX_DURACAO_ESTAGIO = $_REQUEST['TX_DURACAO_ESTAGIO'];
    $VO->NB_DURACAO_RECESSO = $_REQUEST['NB_DURACAO_RECESSO'];
    $VO->TX_FORMULA_RECESSO = $_REQUEST['TX_FORMULA_RECESSO'];

    if ($acesso) {
        if ($VO->ID_TABELA_RECESSO && $VO->TX_DURACAO_ESTAGIO && $VO->NB_DURACAO_RECESSO && $VO->TX_FORMULA_RECESSO) {
            $retorno = $VO->alterarTBLRecesso();

            if ($retorno['code'] == '1')
                $erro = 'Registro já existe.';
            else
                $erro = $retorno['message'];
        }else
            $erro = 'Altere o Tempo de Estágio, a Duração do Recesso e/ou a Fórmula.';
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);
}
?>