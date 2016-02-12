<?php
include "../../php/define.php";
require_once $pathvo . "quadro_vagasVO.php";

$modulo = 78;
$programa = 9;

require_once "../autenticacao/validaPermissao.php";

session_start();

//--------- pesquisa do detail--------------------------
function gerarTabela($param = '') {
    include "../../php/define.php";
    require_once $pathvo . "quadro_vagasVO.php";
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

    $VO = new quadro_vagasVO();

    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];

    $page = $_REQUEST['PAGE'];

    $qtd = 15;
    !$page ? $page = 1 : false;
    $primeiro = ($page * $qtd) - $qtd;

    $total = $VO->pesquisarUnidades();

    $total_page = ceil($total / $qtd);

    $VO->Reg_inicio = $primeiro;
    $VO->Reg_quantidade = $qtd;
    $tot_da_pagina = $VO->pesquisarUnidades();
	
	//Correção exclusao ultima linha da pagina
	if ($total_page >= 1 && !$tot_da_pagina){
		$VO->Reg_inicio = $primeiro-$qtd;
		$page--;
		$tot_da_pagina = $VO->pesquisarUnidades();
	}

    echo '<table width="100%" id="tabelaItens" >
			<tr>
				<th style="width:140px">Agência de Estágio</th>
				<th style="width:130px" >Órgão</th>
				<th style="width:160px">Tipo de Vaga</th>
				<th style="width:120px">Quantidade</th>
				<th>Curso</th>';

    //Somente ver a coluna de alterar se tiver acesso completo a tela	
    if ($acesso)
        echo '<th style="width:50px;"></th>';
    echo '</tr>';

    if ($tot_da_pagina) {
        $dados = $VO->getVetor();

        for ($i = 0; $i < $tot_da_pagina; $i++) {
            ($bgcolor == '#F0F0F0') ? $bgcolor = '#DDDDDD' : $bgcolor = '#F0F0F0';
            echo '<tr bgcolor="' . $bgcolor . '" onmouseover="mudarCor(this);" onmouseout="mudarCor(this);">
										   <td align="center">' . $dados['TX_AGENCIA_ESTAGIO'][$i] . '</td>
                                           <td align="center">' . $dados['TX_ORGAO_ESTAGIO'][$i] . '</td>
	                                   	   <td align="center">' . $dados['TX_TIPO_VAGA_ESTAGIO'][$i] . '</td>
                                           <td align="center" class="qtd">' . $dados['NB_QUANTIDADE'][$i] . '</td>  
                                           <td align="center" class="curso">' . $dados['TX_CURSO_ESTAGIO'][$i] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela					
            if ($acesso)
                echo'<td align="center" class="icones"> ';
            echo '<a href="'.$dados['ID_AGENCIA_ESTAGIO'][$i].'_'.$dados['ID_ORGAO_ESTAGIO'][$i].'_'.$dados['CS_TIPO_VAGA_ESTAGIO'][$i].'" id="alterar" sel="'.$dados['ID_CURSO_ESTAGIO'][$i].'"><img src="' . $urlimg . 'icones/alterarItem.png" alt="itens" title="Alterar"/></a> ';
            echo '<a href="'.$dados['ID_AGENCIA_ESTAGIO'][$i].'_'.$dados['ID_ORGAO_ESTAGIO'][$i].'_'.$dados['CS_TIPO_VAGA_ESTAGIO'][$i].'" id="excluir"><img src="' . $urlimg . 'icones/excluirItem.png" title="Excluir Registro"/></a>';

            echo '</td>';
        }

        echo'</table>';

        if ($total_page > 1) {
            echo '<div id="paginacao" align="center"> <ul>';

            for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $page)
                    echo '<li id="' . $i . '" class="selecionado">' . $i . '</li>';
                else
                    echo '<li id="' . $i . '">' . $i . '</li>';
            }
            echo '</ul>	</div><br><br>';
        }
    }
    else
        echo '<tr><td colspan="6" class="nenhum">Nenhum registro encontrado.</td></tr></table><br /> ';

    if ($param)
        echo '<script>alert("' . $param . '")</script>';
}


//-----------------PESQUISA COMUM-------------------------------------------
$VO = new quadro_vagasVO();

if ($_REQUEST['identifier'] == "tabela") {

    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_REQUEST['ID_ORGAO_GESTOR_ESTAGIO'];
    $VO->CS_SITUACAO = $_REQUEST['CS_SITUACAO'];
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
               <tr>
				<th>Código</th>
				<th>Órgão Gestor</th>
			    <th>Situação</th>
			    <th style="width:150px;">Data de Cadastro</th>
                <th style="width:150px;">Data de Atualização</th>';
        //Somente ver a coluna de alterar se tiver acesso completo a tela					
        //if ($acesso) 
        echo '<th style="width:30px;"></th><th style="width:30px;"></th>';
        echo '</tr>';

        for ($i = 0; $i < $tot_da_pagina; $i++) {
            ($bgcolor == '#E6E6E6') ? $bgcolor = '#F0EFEF' : $bgcolor = '#E6E6E6';

            echo '<tr bgcolor="' . $bgcolor . '">
                     <td align="center">' . $dados['TX_CODIGO'][$i] . '</td>
                     <td align="center">' . $dados['TX_ORGAO_GESTOR_ESTAGIO'][$i] . '</td>
                     <td align="center">' . $dados['TX_SITUACAO'][$i] . '</td>    
			         <td align="center">' . $dados['DT_CADASTRO'][$i] . '</td>
                     <td align="center">' . $dados['DT_ATUALIZACAO'][$i] . '</td>
                               
			    ';
            //Somente ver a coluna de alterar se tiver acesso completo a tela					
            //if ($acesso) 
            echo '<td align="center"> 
		          <a href="' . $dados['ID_QUADRO_VAGAS_ESTAGIO'][$i] . '_1" id="alterar"><img src="' . $urlimg . 'icones/editar.png" alt="itens" title="Alterar"/></a></td>
                   <td align="center"> <a href="' . $dados['ID_QUADRO_VAGAS_ESTAGIO'][$i] . '" id="alterar"><img src="' . $urlimg . 'icones/visualizarItem.png" alt="itens" title="Visualisar"/></a></td>';
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
} else if ($_REQUEST['identifier'] == "inserirVaga") {

    $VO->ID_QUADRO_VAGAS_ESTAGIO 		= $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO				= $_REQUEST['ID_ORGAO_ESTAGIO'];
    $VO->CS_TIPO_VAGA_ESTAGIO 			= $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];
    $VO->NB_QUANTIDADE 					= $_REQUEST['NB_QUANTIDADE'];
    $VO->ID_CURSO_ESTAGIO 				= $_REQUEST['ID_CURSO_ESTAGIO'];
	$VO->ID_AGENCIA_ESTAGIO 			= $_REQUEST['ID_AGENCIA_ESTAGIO'];

    if ($acesso) {
        $retorno = $VO->inserirVaga();
		
		if ($retorno){
			$erro = $VO->erroOracle($retorno);
		}

    }
    else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);
}else if ($_REQUEST['identifier'] == 'atualizarInf') {

    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];

    $dados = $VO->atualizarInf();

    echo json_encode($dados);
} else if ($_REQUEST['identifier'] == 'excluirUnidade') {

    $VO->ID_QUADRO_VAGAS_ESTAGIO 		= $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];
	$codigo 							= explode('_', $_REQUEST['CODIGO']);
	$VO->ID_AGENCIA_ESTAGIO 			= $codigo[0];
    $VO->ID_ORGAO_ESTAGIO 				= $codigo[1];
    $VO->CS_TIPO_VAGA_ESTAGIO 			= $codigo[2];

    if ($acesso) {

        $retorno = $VO->excluirUnidade();

        if (is_array($retorno))
            $erro = 'Este registro não pode ser excluído pois possui dependentes.';
    }
    else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);

//-----------------------alterar da pesquisa do detail--------------------------        
}else if ($_REQUEST['identifier'] == 'alterarVaga') {

    $VO->ID_QUADRO_VAGAS_ESTAGIO 		= $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];
	$codigo 							= explode('_', $_REQUEST['CODIGO']);
	$VO->ID_AGENCIA_ESTAGIO 			= $codigo[0];
    $VO->ID_ORGAO_ESTAGIO 				= $codigo[1];
    $VO->CS_TIPO_VAGA_ESTAGIO 			= $codigo[2];
    $VO->NB_QUANTIDADE 					= $_REQUEST['NB_QUANTIDADE'];
    $VO->ID_CURSO_ESTAGIO 				= $_REQUEST['ID_CURSO_ESTAGIO'];
	
	
 if ($acesso) {
	 $retorno = $VO->alterarVaga();
	 
	 if ($retorno){
		$erro = $VO->erroOracle($retorno);
	 }
 }else
    $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);
}
?>