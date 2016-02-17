<?php

include "../../php/define.php";
require_once $pathvo . "contratoVO.php";

$modulo = 79;
$programa = 7;

require_once "../autenticacao/validaPermissao.php";

session_start();

function gerarTabela($param = '') {
    include "../../php/define.php";
    require_once $pathvo . "contratoVO.php";
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global; --------------------------------------------------------------------------------

    $VO = new contratoVO();
    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_REQUEST['ID_ORGAO_GESTOR_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];
    $VO->ID_SELECAO_ESTAGIO = $_REQUEST['ID_SELECAO_ESTAGIO'];
    $VO->TX_TCE = $_REQUEST['TX_TCE'];
    $VO->TX_NOME = $_REQUEST['TX_NOME'];
    $VO->NB_CPF = $_REQUEST['NB_CPF'];
    $VO->CHECK_RESP = $_REQUEST['CHECK_RESP'];
    $VO->CHECK_RESP_2 = $_REQUEST['CHECK_RESP_2'];

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
                    <th style="width:75px;">Código Contrato</th>
					<th style="width:75px;">Código Seleção</th>
                    <th style="width:100px;">Órgão Gestor</th>
                    <th style="width:100px;">Órgão Solicitante</th>
					<th style="width:80px;">Agente de Integração</th>
					<th style="width:80px;">TCE</th>
                    <th>Estagiário</th>
                    <th style="width:80px;">CPF</th>';
        //Somente ver a coluna de alterar se tiver acesso completo a tela --------------------------------------------------------------------------------
        if ($acesso)
            echo '<th style="width:30px;"></th>';
        echo '</tr>';

        for ($i = 0; $i < $tot_da_pagina; $i++) {
            ($bgcolor == '#E6E6E6') ? $bgcolor = '#F0EFEF' : $bgcolor = '#E6E6E6';

            echo '<tr bgcolor="' . $bgcolor . '">
                    <td align="center">' . $dados['TX_CODIGO'][$i] . '</td>
					<td align="center">' . $dados['TX_COD_SELECAO'][$i] . '</td>
                    <td align="center">' . $dados['TX_ORGAO_GESTOR_ESTAGIO'][$i] . '</td>
                    <td align="center">' . $dados['TX_ORGAO_ESTAGIO'][$i] . '</td>
                    <td align="center">' . $dados['TX_AGENCIA_ESTAGIO'][$i] . '</td>
					<td align="center">' . $dados['TX_TCE'][$i] . '</td>
                    <td align="center">' . $dados['TX_NOME'][$i] . '</td>
                    <td align="center">' . $dados['NB_CPF'][$i] . '</td>';


            //Somente ver a coluna de alterar se tiver acesso completo a tela	--------------------------------------------------------------------------
            if ($acesso)
                echo '<td align="center">
                       <a href="' . $dados['ID_CONTRATO'][$i] . '" id="alterar"><img src="' . $urlimg . 'icones/editar.png" alt="itens" title="Alterar"/></a></td>';
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

//Instancia da classe contratoVO();----------------------------------------------------------------------------
$VO = new contratoVO();

// Tabela do master
if ($_REQUEST['identifier'] == "tabela") {
    gerarTabela($erro);
}
//Buscar ComboBox de Codigo de seleção  -----------------------------------------------------------------------
else if ($_REQUEST['identifier'] == "codSelecao") {

    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];

    $total = $VO->buscarCodSelecao();
    echo '<option value="">Escolha...</option>';

    if ($total) {
        $dados = $VO->getVetor();
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_COD_SELECAO'][$i] . '</option>';
        }
    }
} else if ($_REQUEST['identifier'] == "codSelecaoIndex") {

    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];

    $total = $VO->buscarCodSelecaoIndex();
    echo '<option value="">Escolha...</option>';

    if ($total) {
        $dados = $VO->getVetor();
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_COD_SELECAO'][$i] . '</option>';
        }
    }
}
// trazer todas as lotações de um orgão solicitante -----------------------------------------------------------
else if ($_REQUEST['identifier'] == "lotacao") {

    $VO->NB_COD_UNIDADE = $_REQUEST['NB_COD_UNIDADE'];

    $total = $VO->buscarLotacao();

    if ($total) {
        $dados = $VO->getVetor();
        echo '<option value="">Escolha...</option>';
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['ORGAO'][$i] . '</option>';
        }
    }
}
// Trazer todos os candidatos de uma seleção--------------------------------------------------------------------
else if ($_REQUEST['identifier'] == "candidato") {

    $VO->ID_SELECAO_ESTAGIO = $_REQUEST['ID_SELECAO_ESTAGIO'];

    $total = $VO->buscarCandidato();
    echo '<option value="">Escolha...</option>';
    if ($total) {
        $dados = $VO->getVetor();
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_NOME'][$i] . '</option>';
        }
    }
}
// Trazer todos os candidatos de uma seleção--------------------------------------------------------------------
else if ($_REQUEST['identifier'] == "candidatoSemSelecao") {

    $total = $VO->buscarEstagiarioSemSelecao();
    echo '<option value="">Escolha...</option>';
    if ($total) {
        $dados = $VO->getVetor();
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_NOME'][$i] . '</option>';
        }
    }
}
// Busca de E/ndereço do Orgão gestor---------------------------------------------------------------------------
else if ($_REQUEST['identifier'] == "buscarEndereco") {

    $VO->ID_UNIDADE_ORG = $_REQUEST['ID_UNIDADE_ORG'];
    $VO->buscarEnderecoOrgaoGestor();
    $dados = $VO->getVetor();
    echo $dados['TX_ENDERECO_SEC'][0];
}
//busca de Nome do Secretario do Orgão Gestor-------------------------------------------------------------------
else if ($_REQUEST['identifier'] == "buscarNome") {

    $VO->ID_UNIDADE_ORG = $_REQUEST['ID_UNIDADE_ORG'];

    $VO->buscarSecretarioOrgaoGestor();
    $dados = $VO->getVetor();

    echo $dados['TX_FUNCIONARIO'][0];
}
//busca do cargo do Supervisor ---------------------------------------------------------------------------------
else if ($_REQUEST['identifier'] == "cargoSupervisor") {

    $VO->ID_PESSOA_SUPERVISOR = $_REQUEST['ID_PESSOA_SUPERVISOR'];

    $VO->buscarCargoSupervisor();
    $dados = $VO->getVetor();


    echo $dados['TX_CARGO'][0];
}
// buscar o valor da bolsa do estagio --------------------------------------------------------------------------
else if ($_REQUEST['identifier'] == "buscarValor") {

    $VO->ID_BOLSA_ESTAGIO = $_REQUEST['ID_BOLSA_ESTAGIO'];

    $VO->buscarBolsa();
    $dados = $VO->getVetor();


    echo $dados['NB_VALOR'][0];
}
// buscar todos os documentos(CPF & RG) do candidato-------------------------------------------------------------
else if ($_REQUEST['identifier'] == "buscarDocuments") {

    $VO->ID_PESSOA_ESTAGIARIO = $_REQUEST['ID_PESSOA_ESTAGIARIO'];

    $VO->buscarDocuments();
    $dados = $VO->getVetor();
//    $dados= $VO->buscarDocuments();

    echo json_encode($dados);
} else if ($_REQUEST['identifier'] == "buscarQuadroVagas") {

    $VO->ID_SELECAO_ESTAGIO = $_REQUEST['ID_SELECAO_ESTAGIO'];

    $VO->buscarQuadroVaga();
    $dados = $VO->getVetor();
//    $dados= $VO->buscarDocuments();

    echo json_encode($dados);
}
?>