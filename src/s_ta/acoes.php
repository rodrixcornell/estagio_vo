<?php

include "../../php/define.php";
require_once $path . "src/s_ta/arrays.php";
require_once $pathvo . "s_taVO.php";

$modulo = 79;
$programa = 11;

require_once "../autenticacao/validaPermissao.php";

session_start();

function gerarTabela($param = '') {
    include "../../php/define.php";
    require_once $pathvo . "s_taVO.php";
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

    $VO = new s_taVO();
    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_REQUEST['ID_ORGAO_GESTOR_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];
    $VO->ID_AGENCIA_ESTAGIO = $_SESSION['ID_AGENCIA_ESTAGIO'];
    $VO->TX_CODIGO_CONTRATO = $_REQUEST['TX_CODIGO_CONTRATO'];
    $VO->TX_NOME = $_REQUEST['TX_NOME'];
    $VO->NB_CPF = $_REQUEST['NB_CPF'];
    $VO->TX_CODIGO_SOLICITACAO = $_REQUEST['TX_CODIGO_SOLICITACAO'];
    

    $page = $_REQUEST['PAGE'];

    $VO->preencherSessionPesquisar($_REQUEST);

    $qtd = 15;
    !$page ? $page = 1 : false;
    $primeiro = ($page * $qtd) - $qtd;

    $total = $VO->pesquisarSolicitacao();

    $total_page = ceil($total / $qtd);
  
    $VO->Reg_inicio = $primeiro;
    $VO->Reg_quantidade = $qtd;
    $tot_da_pagina = $total; //$VO->pesquisarSolicitacao();

    if ($tot_da_pagina) {
        $dados = $VO->getVetor();
      
        
        
        echo '<div id="status">' . $_SESSION['STATUS'] . '</div>
		<table width="100%" class="dataGrid">
                <tr>
                    <th>Código da Solicitação</th>
                    <th>Órgão Gestor</th>
                    <th>Órgão Solicitante</th>
                    <th>Agente de Integração</th>
                    <th>Estagiário</th>
                    <th>CPF</th>
                    <th>Situção</th>';
        //Somente ver a coluna de alterar se tiver acesso completo a tela
        if ($acesso)
            echo '<th style="width:50px;"></th>';
        echo '</tr>';

        for ($i = 0; $i < $tot_da_pagina; $i++) {
            ($bgcolor == '#E6E6E6') ? $bgcolor = '#F0EFEF' : $bgcolor = '#E6E6E6';

            echo '<tr bgcolor="' . $bgcolor . '">
                    <td align="center">' . $dados['TX_CODIGO_SOLICITACAO'][$i] . '</td>
                    <td align="center">' . $dados['TX_ORGAO_GESTOR_ESTAGIO'][$i] . '</td>
                    <td align="center">' . $dados['TX_ORGAO_ESTAGIO'][$i] . '</td>
                    <td align="center">' . $dados['TX_AGENCIA_ESTAGIO'][$i] . '</td>
                    <td align="center">' . $dados['TX_NOME'][$i] . '</td>
                    <td align="center">' . $dados['NB_CPF'][$i] . '</td>
                    <td align="center">' . $dados['TX_SITUACAO'][$i] . '</td>';


            //Somente ver a coluna de alterar se tiver acesso completo a tela
            if ($acesso)
                echo '<td align="center">
                      <a href="' . $dados['ID_SOLICITACAO_TA'][$i] . '" id="alterar"><img src="' . $urlimg . 'icones/editar.png" alt="itens" title="Visualizar"/></a></td>';
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


//Instancia da classe desligamentoVO();
$VO = new s_taVO();

//---------busca nome do secretario--------------------
if ($_REQUEST['identifier'] == "tabela") {
    gerarTabela($erro);
}else if ($_REQUEST['identifier'] == "buscarNome") {

    $VO->ID_UNIDADE_ORG = $_REQUEST['ID_UNIDADE_ORG'];

    $VO->buscarSecretarioOrgaoGestor();
    $dados = $VO->getVetor();

    echo $dados['TX_FUNCIONARIO'][0];

//------------busca dados do contrato------------------------------    
}else if ($_REQUEST['identifier'] == "buscarDadosContrato") {

    $VO->ID_CONTRATO = $_REQUEST['ID_CONTRATO'];
    $VO->ID_AGENCIA_ESTAGIO = $_REQUEST['ID_AGENCIA_ESTAGIO'];
    $VO->buscarDadosContrato();
    $dados = $VO->getVetor();
        
    echo $dados['TUDO'][0];
    
// --------------------------busca agente setorial------------------------------    
}else if ($_REQUEST['identifier'] == "buscarASetorial"){

    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];

    $total = $VO->buscarASetorial();
    $dados = $VO->getVetor();

    if ($total) {
       $dados = $VO->getVetor();

       echo '<option value="">Escolha...</option>';
       for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_FUNCIONARIO'][$i] . '</option>';
       }
    
    } else
        echo '<option value="">Nenhum registro encontrado</option>';
    
//------------------------------------
   echo json_encode($dados);
}else if ($_REQUEST['identifier'] == 'atualizarInf') {

    $VO->ID_SOLICITACAO_TA = $_SESSION['ID_SOLICITACAO_TA'];
    $VO->EFETIVAR = $_REQUEST['EFETIVAR'];
    
    $dados = $VO->atualizarInf();

    echo json_encode($dados);
    
}
?>