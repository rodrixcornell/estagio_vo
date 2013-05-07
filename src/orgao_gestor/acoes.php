<?php
include "../../php/define.php";
require_once $pathvo."orgao_gestorVO.php";

$modulo = 78;
$programa = 1;

require_once "../autenticacao/validaPermissao.php";

session_start();

function gerarTabela($param=''){
	include "../../php/define.php";
	require_once $pathvo."orgao_gestorVO.php";
	$acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

	$VO = new orgao_gestorVO();
	$VO->TX_ORGAO_GESTOR_ESTAGIO 	= $_REQUEST['TX_ORGAO_GESTOR_ESTAGIO'];
	$VO->ID_UNIDADE_ORG 			= $_REQUEST['ID_UNIDADE_ORG'];
	$page               			= $_REQUEST['PAGE'];
	
	$VO->preencherSessionPesquisar($_REQUEST);
	
	$qtd = 5;
	!$page ? $page = 1: false;
	$primeiro = ($page*$qtd)-$qtd;
	
	$total = $VO->pesquisar();
	
	$total_page = ceil($total/$qtd);
	
	$VO->Reg_inicio = $primeiro;
	$VO->Reg_quantidade = $qtd;
	$tot_da_pagina = $VO->pesquisar();
	
	if ($tot_da_pagina){
		$dados = $VO->getVetor();
		echo '<div id="status">'.$_SESSION['STATUS'].'</div>
		<table width="100%" class="dataGrid">
                            <tr>
                                <th>Órgão Gestor</th>
								<th>Unidade Organizacional</th>
								<th>Data Cadastro</th>
								<th>Data Atualização</th>';
			//Somente ver a coluna de alterar se tiver acesso completo a tela					
			if ($acesso) 
				echo '<th style="width:50px;"></th>';
                     echo '</tr>';

                for ($i=0; $i<$tot_da_pagina; $i++){
                    ($bgcolor == '#E6E6E6') ? $bgcolor = '#F0EFEF' : $bgcolor = '#E6E6E6';

                    echo '<tr bgcolor="'.$bgcolor.'">
                            <td align="center">'.$dados['TX_ORGAO_GESTOR_ESTAGIO'][$i].'</td>
							<td align="center">'.$dados['TX_UNIDADE_ORG'][$i].'</td>
							<td align="center">'.$dados['DT_CADASTRO'][$i].'</td>
							<td align="center">'.$dados['DT_ATUALIZACAO'][$i].'</td>';
							
		//Somente ver a coluna de alterar se tiver acesso completo a tela					
           if ($acesso) 
		 			echo '<td align="center"> 
								<a href="'.$dados['ID_ORGAO_GESTOR_ESTAGIO'][$i].'" id="alterar"><img src="'.$urlimg.'icones/editar.png" alt="itens" title="Alterar"/></a>
								<a href="'.$dados['ID_ORGAO_GESTOR_ESTAGIO'][$i].'" id="excluir"><img src="'.$urlimg.'icones/excluirItem.png" alt="itens" title="Excluir"/></a></td>';
					echo '</tr>';
		}
		
		echo '</table>';
		
		if ($total_page > 1){
			echo '<div id="paginacao" align="center">
					<ul>';

			for($i=1; $i<=$total_page; $i++){
				if ($i==$page)
					echo '<li id="'.$i.'" class="selecionado">'.$i.'</li>';
				else 
					echo '<li id="'.$i.'">'.$i.'</li>';
			}
			echo '	</ul>
				  </div>';
		}
	
	}else{
		echo '<div id="status">'.$_SESSION['STATUS'].'</div>
				<div id="nao_encontrado">Nenhum registro encontrado.</div>';
	}
	
	if ($param) echo '<script>alert("'.$param.'")</script>';
	
	unset($_SESSION['STATUS']);			
}

$VO = new orgao_gestorVO();

if ($_REQUEST['identifier'] == "tabela"){
	gerarTabela($erro);
}else if ($_REQUEST['identifier'] == 'excluir'){
	
	$VO->ID_UNIDADE_IRP 		= $_REQUEST['ID_UNIDADE_IRP'];
	
	if ($acesso){
		
		$retorno = $VO->excluir();
		
		if (is_array($retorno))
				$erro = 'Este registro não pode ser excluído pois possui dependentes.';
		else
		 	$_SESSION['STATUS']	= '*Registro excluído com sucesso!';
		
			
	}else
		$erro = "Você não tem permissão para realizar esta ação.";
	
	gerarTabela($erro);
        
}
?>