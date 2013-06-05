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
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

    $VO = new contratoVO();
    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_REQUEST['ID_ORGAO_GESTOR_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];
    $VO->ID_SELECAO_ESTAGIO = $_REQUEST['ID_SELECAO_ESTAGIO'];
    $VO->TX_TCE = $_REQUEST['TX_TCE'];
    $VO->TX_NOME = $_REQUEST['TX_NOME'];
    $VO->NB_CPF = $_REQUEST['NB_CPF'];
    
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
                    <th>Órgão Gestor</th>
                    <th>Agente Solicitante</th>
                    <th>Estagiário</th>
                    <th>CPF</th>';
        //Somente ver a coluna de alterar se tiver acesso completo a tela					
        if ($acesso)
            echo '<th style="width:50px;"></th>';
        echo '</tr>';

        for ($i = 0; $i < $tot_da_pagina; $i++) {
            ($bgcolor == '#E6E6E6') ? $bgcolor = '#F0EFEF' : $bgcolor = '#E6E6E6';

            echo '<tr bgcolor="' . $bgcolor . '">
                    <td align="center">' . $dados[''][$i] . '</td>
                    <td align="center">' . $dados[''][$i] . '</td>
                    <td align="center">' . $dados[''][$i] . '</td>
                    <td align="center">' . $dados[''][$i] . '</td>
                    <td align="center">' . $dados[''][$i] . '</td>';


            //Somente ver a coluna de alterar se tiver acesso completo a tela					
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

//Instancia da classe contratoVO();
$VO = new contratoVO();

// Tabela do master
if ($_REQUEST['identifier'] == "tabela") {
    gerarTabela($erro);
}
//Buscar ComboBox de Codigo de seleção 
else if ($_REQUEST['identifier'] == "codSelecao") {

    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];

    $total = $VO->buscarCodSelecao();

    if ($total) {
        $dados = $VO->getVetor();
         echo '<option value="">Escolha...</option>';
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_COD_SELECAO'][$i] . '</option>';
        }
    }
}
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
else if ($_REQUEST['identifier'] == "candidato") {

    $VO->ID_SELECAO_ESTAGIO = $_REQUEST['ID_SELECAO_ESTAGIO'];

    $total = $VO->buscarCandidato();

    if ($total) {
        $dados = $VO->getVetor();
        echo '<option value="">Escolha...</option>';
        for ($i = 0; $i < $total; $i++) {
                echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_NOME'][$i] . '</option>';
        }
    }
}
// Busca de E/ndereço do Orgão gestor
else if ($_REQUEST['identifier'] == "buscarEndereco") {

    $VO->ID_UNIDADE_ORG = $_REQUEST['ID_UNIDADE_ORG'];

    $VO->buscarEnderecoOrgaoGestor();
    $dados = $VO->getVetor();
    
    echo $dados['TX_ENDERECO'][0];
}
//busca de Nome do Secretario do Orgão Gestor
else if ($_REQUEST['identifier'] == "buscarNome") {

    $VO->ID_UNIDADE_ORG = $_REQUEST['ID_UNIDADE_ORG'];

    $VO->buscarSecretarioOrgaoGestor();
    $dados = $VO->getVetor();
    
    echo $dados['TX_FUNCIONARIO'][0];
}
?>