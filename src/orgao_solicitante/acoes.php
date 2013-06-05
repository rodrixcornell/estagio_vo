<?php
include "../../php/define.php";
require_once $pathvo . "orgao_solicitanteVO.php";

$modulo = 78;
$programa = 2;

require_once "../autenticacao/validaPermissao.php";

session_start();

function gerarTabela($param = '') {
    include "../../php/define.php";
    require_once $pathvo . "orgao_solicitanteVO.php";
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;
    
    //PESQUISA DETAIL

    $VO = new orgao_solicitanteVO();
    $VO->ID_ORGAO_ESTAGIO = $_SESSION['ID_ORGAO_ESTAGIO'];    
    
    $page = $_REQUEST['PAGE'];

    $qtd = 15;
    !$page ? $page = 1 : false;
    $primeiro = ($page * $qtd) - $qtd;

    $total = $VO->buscarAgenteSetorial();

    $total_page = ceil($total / $qtd);

    $VO->Reg_inicio = $primeiro;
    $VO->Reg_quantidade = $qtd;
    $tot_da_pagina = $VO->buscarAgenteSetorial();

    echo '<table width="100%" id="tabelaItens" >
        <tr>
        <th>Usuário</th>
        <th>Funcionário</th>
        <th>Data Cadastro</th>
        <th>Data de Atualização</th>';

    //Somente ver a coluna de alterar se tiver acesso completo a tela	
//    if ($acesso)
      //echo '<th style="width:0px;"></th>';

    echo '</tr>';

    if ($tot_da_pagina) {
        $dados = $VO->getVetor();

        for ($i = 0; $i < $tot_da_pagina; $i++) {

            ($bgcolor == '#F0F0F0') ? $bgcolor = '#DDDDDD' : $bgcolor = '#F0F0F0';

            echo '<tr bgcolor="' . $bgcolor . '" onmouseover="mudarCor(this);" onmouseout="mudarCor(this);">
                <td align="center">' . $dados['TX_USUARIO'][$i] . '</td>
                <td align="center">' . $dados['TX_FUNCIONARIO'][$i] . '</td>
                <td align="center">' . $dados['DT_CADASTRO'][$i] . '</td>
                <td align="center">' . $dados['DT_ATUALIZACAO'][$i] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela					
//            if ($acesso)
//                echo '<td align="center" class="icones">
//		<a href="' . $dados['ID_ORGAO_ESTAGIO'][$i] . '" id="excluir" ><img src="' . $urlimg . 'icones/excluirItem.png" title="Excluir Registro"/></a></td>';
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

//PESQUISAR INDEX

$VO = new orgao_solicitanteVO();

if ($_REQUEST['identifier'] == "tabela") {
   
    $VO->ID_UNIDADE_ORG = $_REQUEST['ID_UNIDADE_ORG'];
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

        echo '<table width="100%" class="dataGrid">
             <th>Órgao Solicitante</th>
             <th>Unidade Organizacional</th>
             <th>Data de Cadastro</th>
             <th>Data de Atualização</th>
								';
        //Somente ver a coluna de alterar se tiver acesso completo a tela					
        //if ($acesso)
            echo '<th style="width:30px;"></th>';
        echo '</tr>';

        for ($i = 0; $i < $tot_da_pagina; $i++) {
            ($bgcolor == '#E6E6E6') ? $bgcolor = '#F0EFEF' : $bgcolor = '#E6E6E6';

            echo '<tr bgcolor="' . $bgcolor . '">
                <td align="center">' . $dados['TX_ORGAO_ESTAGIO'][$i] . '</td>
                <td align="center">' . $dados['TX_UNIDADE_ORG'][$i] . '</td>
                <td align="center">' . $dados['DT_CADASTRO'][$i] . '</td>
                <td align="center">' . $dados['DT_ATUALIZACAO'][$i] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela					
           // if ($acesso)
                echo '<td align="center"> 
		  <a href="' . $dados['ID_ORGAO_ESTAGIO'][$i] . '" id="alterar"><img src="' . $urlimg . 'icones/editar.png" alt="itens" title="Alterar"/></a></td>';
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
} else if ($_REQUEST['identifier'] == "tabelaUnidade") {
    gerarTabela();

}else if ($_REQUEST['identifier'] == 'alterar') {

    $VO->ID_ORGAO_ESTAGIO = $_SESSION['ID_ORGAO_ESTAGIO'];
    
    $dados = $VO->alterar();

   // echo json_encode($dados);
} else if ($_REQUEST['identifier'] == 'excluirOrgao') {

    $VO->ID_ORGAO_ESTAGIO = $_SESSION['ID_ORGAO_ESTAGIO'];
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