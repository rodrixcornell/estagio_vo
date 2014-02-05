<?php

include "../../php/define.php";
require_once $path . "src/calendario/arrays.php";
require_once $pathvo . "calendarioVO.php";

$modulo = 80;
$programa = 9;

require_once "../autenticacao/validaPermissao.php";

session_start();

function gerarTabela($param = '') {
    include "../../php/define.php";
    require_once $pathvo . "calendarioVO.php";
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

    $VO = new calendarioVO();

    $VO->ID_CALENDARIO_FOLHA_PAG = $_SESSION['ID_CALENDARIO_FOLHA_PAG'];
    $page = $_REQUEST['PAGE'];

    $qtd = 15;
    !$page ? $page = 1 : false;
    $primeiro = ($page * $qtd) - $qtd;

    $total = $VO->pesquisarItemCalendario();

    $total_page = ceil($total / $qtd);

    $VO->Reg_inicio = $primeiro;
    $VO->Reg_quantidade = $qtd;
    $tot_da_pagina = $VO->pesquisarItemCalendario();

    echo '
        <table width="100%" id="tabelaItens" >
            <tr>
                <th>Grupo</th>
                <th>Data Fechamento</th>
                <th>Data Encaminhamento de Documento</th>
                <th>Data Transferância Banco</th>
                <th>Data Início Transferência</th>
                <th>Data Fim Transferência</th>
                <th>Data Pagamento</th>';

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
                    <td align="center">' . $dados['TX_GRUPO_PAGAMENTO'][$i] . '</td>
                    <td align="center">' . $dados['DT_FECHAMENTO'][$i] . '</td>
                    <td align="center">' . $dados['DT_ENCAM_DOC'][$i] . '</td>
                    <td align="center">' . $dados['DT_TRANSF_BANCO'][$i] . '</td>
                    <td align="center">' . $dados['DT_INICIO_TRANSF_ESTAG'][$i] . '</td>
                    <td align="center">' . $dados['DT_FIM_TRANSF_ESTAG'][$i] . '</td>
                    <td align="center">' . $dados['DT_PAGAMENTO'][$i] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela
            if ($acesso)
                echo '
                    <td align="center" class="icones">
                        <a href="' . $dados['ID_GRUPO_PAGAMENTO'][$i] . '" id="alterar" ><img src="' . $urlimg . 'icones/alterarItem.png" title="Excluir Registro"/></a>
                        <a href="' . $dados['ID_GRUPO_PAGAMENTO'][$i] . '" id="excluir" ><img src="' . $urlimg . 'icones/excluirItem.png" title="Excluir Registro"/></a></td>';
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
        echo '<tr><td colspan="8" class="nenhum">Nenhum registro encontrado.</td></tr></table><br /> ';

    if ($param)
        echo '<script>alert("' . $param . '")</script>';
}
//------------------------------------------------------------------------------
function gerarTabelaAlterar($param = '') {
    include "../../php/define.php";
    require_once $pathvo . "calendarioVO.php";
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

    $VO = new calendarioVO();

    $VO->ID_CALENDARIO_FOLHA_PAG = $_SESSION['ID_CALENDARIO_FOLHA_PAG'];

    $VO->ID_GRUPO_PAGAMENTO = $_REQUEST['ID_GRUPO_PAGAMENTO'];
    $VO->NB_NOT_IN = $_REQUEST['NB_NOT_IN'];

    $VO->buscarItemCalendario();
    $dados = $VO->getVetor();

    $VO->pesquisarGrupoPagamento();

    $arrayGrupoPagamento = $VO->getArray("TX_GRUPO_PAGAMENTO");
    foreach ($arrayGrupoPagamento as $key => $value) {
        ($dados['ID_GRUPO_PAGAMENTO'][0] == $key) ? $selected = 'selected' : $selected = '';
        $arrayGrupoPagamentoAlt .= '<option value="' . $key . '" ' . $selected . '>' . $value . '</option> ';
    }

    $largura=140;
    $largura_div=150;
    echo '
        <script>
            $("#DT_FECHAMENTO_ALT,#DT_ENCAM_DOC_ALT,#DT_TRANSF_BANCO_ALT,#DT_PAGAMENTO_ALT,#DT_INICIO_TRANSF_ESTAG_ALT,#DT_FIM_TRANSF_ESTAG_ALT").setMask({
                mask:"99/99/9999"
            });

            $("#DT_FECHAMENTO_ALT,#DT_ENCAM_DOC_ALT,#DT_TRANSF_BANCO_ALT,#DT_PAGAMENTO_ALT,#DT_INICIO_TRANSF_ESTAG_ALT,#DT_FIM_TRANSF_ESTAG_ALT").datepicker({
                changeMonth: true,
                changeYear: true
            });
        </script>';

    echo '
        <br />
        <fieldset>

            <div id="camada" style="width:'.  $largura_div  .'px;">
                <strong><font color="#FF0000">*</font>Grupo Pagamento</strong><br />
                <select name="ID_GRUPO_PAGAMENTO_ALT" id="ID_GRUPO_PAGAMENTO_ALT" style="width:'.  $largura  .'px;">'.  $arrayGrupoPagamentoAlt  .'</select></div>

            <div id="camada" style="width:'.  $largura_div  .'px;" >
                <strong><font color="#FF0000">*</font>Data Fechamento</strong><br />
                <input type="text" name="DT_FECHAMENTO_ALT" id="DT_FECHAMENTO_ALT" value="'.  $dados['DT_FECHAMENTO'][0]  .'" style="width:'.  $largura  .'px;" /></div>

            <div id="camada" style="width:'.  $largura_div  .'px;" >
                <strong><font color="#FF0000">*</font>Data Encaminhamento de Documento</strong><br />
                <input type="text" name="DT_ENCAM_DOC_ALT" id="DT_ENCAM_DOC_ALT" value="'.  $dados['DT_ENCAM_DOC'][0]  .'" style="width:'.  $largura  .'px;" /></div>

            <div id="camada" style="width:'.  $largura_div  .'px;" >
                <strong><font color="#FF0000">*</font>Data Transferência Banco</strong><br />
                <input type="text" name="DT_TRANSF_BANCO_ALT" id="DT_TRANSF_BANCO_ALT" value="'.  $dados['DT_TRANSF_BANCO'][0]  .'" style="width:'.  $largura  .'px;" /></div>

            <div id="camada" style="width:'.  $largura_div  .'px;" >
                <strong><font color="#FF0000">*</font>Data Início Transferência</strong><br />
                <input type="text" name="DT_INICIO_TRANSF_ESTAG_ALT" id="DT_INICIO_TRANSF_ESTAG_ALT" value="'.  $dados['DT_INICIO_TRANSF_ESTAG'][0]  .'" style="width:'.  $largura  .'px;" /></div>

            <div id="camada" style="width:'.  $largura_div  .'px;" >
                <strong><font color="#FF0000">*</font>Data Fim Transferência</strong><br />
                <input type="text" name="DT_FIM_TRANSF_ESTAG_ALT" id="DT_FIM_TRANSF_ESTAG_ALT" value="'.  $dados['DT_FIM_TRANSF_ESTAG'][0]  .'" style="width:'.  $largura  .'px;" /></div>

            <div id="camada" style="width:'.  $largura_div  .'px;" >
                <strong><font color="#FF0000">*</font>Data Pagamento</strong><br />
                <input type="text" name="DT_PAGAMENTO_ALT" id="DT_PAGAMENTO_ALT" value="'.  $dados['DT_PAGAMENTO'][0]  .'" style="width:'.  $largura  .'px;" /></div>

            <br /><br />
            <input type="hidden" name="ID_GRUPO_PAGAMENTO_OLD" id="ID_GRUPO_PAGAMENTO_OLD" value="'.  $dados['ID_GRUPO_PAGAMENTO'][0]  .'" />

        </fieldset>';


    if ($param) {
        echo '<script>alert("' . $param . '");</script>';
    }
}
//------------------------------------------------------------------------------

$VO = new calendarioVO();

if ($_REQUEST['identifier'] == "tabela") {

    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_REQUEST['ID_ORGAO_GESTOR_ESTAGIO'];
    $VO->NB_ANO_REFERENCIA = $_REQUEST['NB_ANO_REFERENCIA'];
    $VO->NB_MES_REFERENCIA = $_REQUEST['NB_MES_REFERENCIA'];


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
                    <th>Órgão Gestor</th>
                    <th style="width:132px;">Ano de Referência</th>
                    <th style="width:132px;">Mês de Referência</th>
                    <th style="width:132px;">Data Cadastro</th>
                    <th style="width:132px;">Data Atualização</th>';
        //Somente ver a coluna de alterar se tiver acesso completo a tela
        //if ($acesso)
        echo '<th style="width:30px;"></th>';
        echo '</tr>';

        for ($i = 0; $i < $tot_da_pagina; $i++) {
            ($bgcolor == '#E6E6E6') ? $bgcolor = '#F0EFEF' : $bgcolor = '#E6E6E6';

            echo '
                <tr bgcolor="' . $bgcolor . '">
                    <td align="center">' . $dados['TX_ORGAO_GESTOR_ESTAGIO'][$i] . '</td>
                    <td align="center">' . $dados['NB_ANO_REFERENCIA'][$i] . '</td>
                    <td align="center">' . $arrayMeses[$dados['NB_MES_REFERENCIA'][$i]] . '</td>
                    <td align="center">' . $dados['DT_CADASTRO'][$i] . '</td>
                    <td align="center">' . $dados['DT_ATUALIZACAO'][$i] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela
            //if ($acesso)
            echo '
                <td align="center">
                    <a href="' . $dados['ID_CALENDARIO_FOLHA_PAG'][$i] . '" id="alterar"><img src="' . $urlimg . 'icones/editar.png" alt="itens" title="Alterar"/></a></td>';
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
} else if ($_REQUEST['identifier'] == 'atualizarInf') {

    $VO->ID_CALENDARIO_FOLHA_PAG = $_SESSION['ID_CALENDARIO_FOLHA_PAG'];

    $dados = $VO->atualizarInf();

    echo json_encode($dados);
} else if ($_REQUEST['identifier'] == "tabelaItemCalendario") {
    gerarTabela();
} else if ($_REQUEST['identifier'] == "pesquisarGrupoPagamento") {

    $VO->ID_CALENDARIO_FOLHA_PAG = $_SESSION['ID_CALENDARIO_FOLHA_PAG'];
    $VO->NB_NOT_IN = $_REQUEST['NB_NOT_IN'];

    $total = $VO->pesquisarGrupoPagamento();

    if ($total) {
        $dados = $VO->getVetor();
        echo '<option value="">Escolha...</option>';
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_GRUPO_PAGAMENTO'][$i] . '</option>';
        }
    } else
        echo '<option value="">Nenhum registro encontrado...</option>';
} else if ($_REQUEST['identifier'] == "inserirItemCalendario") {

    $VO->ID_CALENDARIO_FOLHA_PAG = $_SESSION['ID_CALENDARIO_FOLHA_PAG'];

    //DT_FECHAMENTO,DT_ENCAM_DOC,DT_TRANSF_BANCO,DT_PAGAMENTO,DT_INICIO_TRANSF_ESTAG,DT_FIM_TRANSF_ESTAG
    $VO->ID_GRUPO_PAGAMENTO = $_REQUEST['ID_GRUPO_PAGAMENTO'];
    $VO->DT_FECHAMENTO = $_REQUEST['DT_FECHAMENTO'];
    $VO->DT_ENCAM_DOC = $_REQUEST['DT_ENCAM_DOC'];
    $VO->DT_TRANSF_BANCO = $_REQUEST['DT_TRANSF_BANCO'];
    $VO->DT_PAGAMENTO = $_REQUEST['DT_PAGAMENTO'];
    $VO->DT_INICIO_TRANSF_ESTAG = $_REQUEST['DT_INICIO_TRANSF_ESTAG'];
    $VO->DT_FIM_TRANSF_ESTAG = $_REQUEST['DT_FIM_TRANSF_ESTAG'];

    if ($acesso) {
        if ($VO->ID_GRUPO_PAGAMENTO && $VO->DT_FECHAMENTO && $VO->DT_ENCAM_DOC && $VO->DT_TRANSF_BANCO
                && $VO->DT_PAGAMENTO && $VO->DT_INICIO_TRANSF_ESTAG && $VO->DT_FIM_TRANSF_ESTAG) {
            $retorno = $VO->inserirItemCalendario();

            if ($retorno) {
                $erro = 'Registro já existe.';
            }
        }else
            $erro = 'Para inserir preencha os Campos.';
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);
} else if ($_REQUEST['identifier'] == 'excluirItemCalendario') {

    $VO->ID_CALENDARIO_FOLHA_PAG = $_SESSION['ID_CALENDARIO_FOLHA_PAG'];

    $VO->ID_GRUPO_PAGAMENTO = $_REQUEST['ID_GRUPO_PAGAMENTO'];

    if ($acesso) {

        $retorno = $VO->excluirItemCalendario();

        if (is_array($retorno))
            $erro = 'Este registro não pode ser excluído pois possui dependentes.';
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);
} else if ($_REQUEST['identifier'] == "tabelaAlterarItemCalendario") {
    gerarTabelaAlterar();
} else if ($_REQUEST['identifier'] == "alterarItemCalendario") {

    $VO->ID_CALENDARIO_FOLHA_PAG = $_SESSION['ID_CALENDARIO_FOLHA_PAG'];

    //DT_FECHAMENTO,DT_ENCAM_DOC,DT_TRANSF_BANCO,DT_PAGAMENTO,DT_INICIO_TRANSF_ESTAG,DT_FIM_TRANSF_ESTAG
    $VO->ID_GRUPO_PAGAMENTO_OLD = $_REQUEST['ID_GRUPO_PAGAMENTO_OLD'];
    $VO->ID_GRUPO_PAGAMENTO = $_REQUEST['ID_GRUPO_PAGAMENTO'];

    $VO->DT_FECHAMENTO = $_REQUEST['DT_FECHAMENTO'];
    $VO->DT_ENCAM_DOC = $_REQUEST['DT_ENCAM_DOC'];
    $VO->DT_TRANSF_BANCO = $_REQUEST['DT_TRANSF_BANCO'];
    $VO->DT_PAGAMENTO = $_REQUEST['DT_PAGAMENTO'];
    $VO->DT_INICIO_TRANSF_ESTAG = $_REQUEST['DT_INICIO_TRANSF_ESTAG'];
    $VO->DT_FIM_TRANSF_ESTAG = $_REQUEST['DT_FIM_TRANSF_ESTAG'];

    if ($acesso) {
      //  if ($VO->ID_TRANSFERENCIA_ESTAGIO && $VO->NB_QUANTIDADE && $VO->CS_TIPO_VAGA_ESTAGIO) {
            $retorno = $VO->alterarItemCalendario();

            if ($retorno['code'] == '1')
                $erro = 'Registro já existe.';
            else
                $erro = $retorno['message'];
       /* }else
            $erro = 'Para Alterar escolha uma Quantidade.';*/
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);
}
?>