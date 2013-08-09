<?php

include "../../php/define.php";
require_once $pathvo . "recessoVO.php";

$modulo = 79;
$programa = 9;

require_once "../autenticacao/validaPermissao.php";

session_start();

function gerarTabela($param = '') {
    include "../../php/define.php";
    require_once $pathvo . "recessoVO.php";
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

    $VO = new recessoVO();
    $VO->ID_RECESSO_ESTAGIO = $_REQUEST['ID_RECESSO_ESTAGIO '];
    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];
    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_REQUEST['ID_ORGAO_GESTOR_ESTAGIO'];
    $VO->TX_CODIGO_CONTRATO = $_REQUEST['TX_CODIGO_CONTRATO'];
    $VO->ID_AGENCIA_ESTAGIO  = $_REQUEST['ID_AGENCIA_ESTAGIO'];
    $VO->NB_CPF              = $_REQUEST['NB_CPF'];
    $VO->TX_NOME_ESTAGIARIO = $_REQUEST['TX_NOME_ESTAGIARIO'];
    $VO->CODIGO_RECESSO = $_REQUEST['CODIGO_RECESSO'];
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
                 <th>Código do Recesso</th>
				<th>Órgão Gestor</th>
				<th>Órgão Solicitante</th>
				<th>Contrato</th>
				<th>Estagiário</th>
				<th>CPF</th>
';
        //Somente ver a coluna de alterar se tiver acesso completo a tela					
        if ($acesso)
            echo '<th style="width:100px;"></th>';
        echo '</tr>';

        for ($i = 0; $i < $tot_da_pagina; $i++) {
            ($bgcolor == '#E6E6E6') ? $bgcolor = '#F0EFEF' : $bgcolor = '#E6E6E6';

            echo '<tr bgcolor="' . $bgcolor . '">
                            <td align="center">' . $dados['CODIGO_RECESSO'][$i] . '</td>
                            <td align="center">' . $dados['TX_ORGAO_GESTOR'][$i] . '</td>
                            <td align="center">' . $dados['TX_ORGAO_SOLICITANTE'][$i] . '</td>
                            <td align="center">' . $dados['TX_CONTRATO'][$i] . '</td>
                            <td align="center">' . $dados['TX_NOME_ESTAGIARIO'][$i] . '</td>
                            <td align="center">' . $dados['NB_CPF'][$i] . '</td>
							
							';


            //Somente ver a coluna de alterar se tiver acesso completo a tela					
            if ($acesso)
                echo '<td align="center"> 
                    <a href="' . $dados['ID_RECESSO_ESTAGIO'][$i] . '" id="alterar"><img src="' . $urlimg . 'icones/editar.png" alt="itens" title="Alterar"/></a>';
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

$VO = new recessoVO();

if ($_REQUEST['identifier'] == "tabela") {
    gerarTabela($erro);
} else if ($_REQUEST['identifier'] == 'excluir') {

    $VO->ID_RECESSO_ESTAGIO = $_REQUEST['ID_RECESSO_ESTAGIO'];

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
else if ($_REQUEST['identifier'] == "buscarNome") {

    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_REQUEST['ID_ORGAO_GESTOR_ESTAGIO'];

    $VO->buscarSecretarioOrgaoGestor();
    $dados = $VO->getVetor();

    echo $dados['TX_FUNCIONARIO'][0];
}

else if ($_REQUEST['identifier'] == "buscarDadosContrato") {

    $VO->ID_CONTRATO = $_REQUEST['ID_CONTRATO'];
    $VO->buscarDadosContrato();
    $dados = $VO->getVetor();
    echo $dados['TUDO'][0];
}

else if($_REQUEST['identifier'] == "buscarOrgaoSolicitante"){
    
    $total = $VO->pesquisarOrgaoSolicitante();
	echo '<option value="">Escolha...</option>';
    if ($total) {
        $dados = $VO->getVetor();    
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_ORGAO_ESTAGIO'][$i] . '</option>';
        }
    }
    

}
else if($_REQUEST['identifier'] == "buscarContratoCombo"){
 
    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_REQUEST['ID_ORGAO_GESTOR_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];
    
    $total = $VO->buscarContrato();
    echo '<option value="">Escolha...</option>';
    if ($total) {
        $dados = $VO->getVetor();    
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_CONTRATO'][$i] . '</option>';
        }
    }
    
}

?>