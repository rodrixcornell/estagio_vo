<?php
include "../../php/define.php";
require_once $pathvo."eventosVO.php";

$modulo = 80;
$programa = 2;

require_once "../autenticacao/validaPermissao.php";

session_start();

function gerarTabela($param=''){
	include "../../php/define.php";
	require_once $pathvo."eventosVO.php";
	$acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

	$VO = new eventosVO();
	$VO->ID_ITEM_PAGAMENTO_ESTAGIO 	= $_SESSION['ID_ITEM_PAGAMENTO_ESTAGIO'];
	$page           		        = $_REQUEST['PAGE'];

	
	$qtd = 15;
	!$page ? $page = 1: false;
	$primeiro = ($page*$qtd)-$qtd;

	$total = $VO->pesquisarBase();
	
	$total_page = ceil($total/$qtd);
	
	$VO->Reg_inicio = $primeiro;
	$VO->Reg_quantidade = $qtd;
	$tot_da_pagina = $VO->pesquisarBase();
	
	echo '<table width="100%" id="tabelaItens" >
			<tr>
				<th style="width:150px;">Valor</th>
				<th style="width:150px;">Início Vigência</th>
                <th style="width:150px;">Fim Vigência</th>
                <th>Data Cadastro</th>
                <th>Data Atualização</th>';
	
	//Somente ver a coluna de alterar se tiver acesso completo a tela	
	if ($acesso) echo '<th style="width:50px;"></th>';
	
	echo '</tr>';
	
	if ($tot_da_pagina){
		$dados = $VO->getVetor();
		
		for ($i=0; $i<$tot_da_pagina; $i++){
                    
			($bgcolor == '#F0F0F0') ? $bgcolor = '#DDDDDD' : $bgcolor = '#F0F0F0';
                     
			echo '<tr bgcolor="'.$bgcolor.'" onmouseover="mudarCor(this);" onmouseout="mudarCor(this);">
						<td align="center" class="valor">'.number_format($dados['NB_VALOR_BASE'][$i],2,',','.').'</td>
						<td align="center" class="dtInicio">'.$dados['DT_INICIO_VIGENCIA'][$i].'</td>
						<td align="center" class="dtFim">'.$dados['DT_FIM_VIGENCIA'][$i].'</td>
                        <td align="center">'.$dados['DT_CADASTRO'][$i].'</td>
                        <td align="center">'.$dados['DT_ATUALIZACAO'][$i].'</td>';
		//Somente ver a coluna de alterar se tiver acesso completo a tela					
			 if ($acesso) echo '<td align="center" class="icones">
			                    <a href="'.$dados['NB_VALOR_BASE_ITEM_PAG'][$i].'" id="alterar"><img src="'.$urlimg.'icones/alterarItem.png" title="Alterar Registro"/></a>
								<a href="'.$dados['NB_VALOR_BASE_ITEM_PAG'][$i].'" id="excluir" ><img src="'.$urlimg.'icones/excluirItem.png" title="Excluir Registro"/></a></td>';                                
			 echo '</tr>';
		}
		
		echo'</table>';
		
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
				  </div><br><br>';
		}
			
	}else
		echo '<tr><td colspan="6" class="nenhum">Nenhum registro encontrado.</td></tr></table><br /> ';
		
	if ($param) echo '<script>alert("'.$param.'")</script>';
					
}

$VO = new eventosVO();

if ($_REQUEST['identifier'] == "tabela"){

	$VO->CS_TIPO       = $_REQUEST['CS_TIPO'];
    $VO->CS_SITUACAO   = $_REQUEST['CS_SITUACAO'];
    $VO->TX_CODIGO     = $_REQUEST['TX_CODIGO'];
    $VO->TX_DESCRICAO  = $_REQUEST['TX_DESCRICAO'];
	
	$page              = $_REQUEST['PAGE'];
	
	$VO->preencherSessionPesquisar($_REQUEST);
	
	$qtd = 15;
	!$page ? $page = 1: false;
	$primeiro = ($page*$qtd)-$qtd;
	
	$total = $VO->pesquisarEventos();
	
	$total_page = ceil($total/$qtd);
	
	$VO->Reg_inicio = $primeiro;
	$VO->Reg_quantidade = $qtd;
	$tot_da_pagina = $VO->pesquisarEventos();
	
	if ($tot_da_pagina){
		$dados = $VO->getVetor();
		echo '<table width="100%" class="dataGrid">
                            <tr>
                                <th>Código</th>
				<th>Descrição</th>
				<th>Sigla</th>
				<th>Situação</th>
                                <th>Tipo</th>
                                <th>Data Cadastro</th>
                                <th>Data Atualização</th>
                                <th></th>
              ';
			//Somente ver a coluna de alterar se tiver acesso completo a tela					
			//if ($acesso) 
				echo '<th"></th>';
                     echo '</tr>';

                for ($i=0; $i<$tot_da_pagina; $i++){
                    ($bgcolor == '#E6E6E6') ? $bgcolor = '#F0EFEF' : $bgcolor = '#E6E6E6';

                    echo '<tr bgcolor="'.$bgcolor.'">
                            <td align="center">'.$dados['TX_CODIGO'][$i].'</td>
							<td align="center">'.$dados['TX_DESCRICAO'][$i].'</td>
							<td align="center">'.$dados['TX_SIGLA'][$i].'</td>
                            <td align="center">'.$dados['TX_SITUACAO'][$i].'</td>
                            <td align="center">'.$dados['TX_TIPO'][$i].'</td>
                            <td align="center">'.$dados['DT_CADASTRO'][$i].'</td>
                            <td align="center">'.$dados['DT_ATUALIZACAO'][$i].'</td>';							
		//Somente ver a coluna de alterar se tiver acesso completo a tela					
         //if ($acesso) 
		 			echo '<td align="center"> 
								<a href="'.$dados['ID_ITEM_PAGAMENTO_ESTAGIO'][$i].'" id="alterar"><img src="'.$urlimg.'icones/editar.png" alt="itens" title="Visualizar"/></a></td>';								
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
		echo '<div id="nao_encontrado">Nenhum registro encontrado.</div>';
	}	
}else if ($_REQUEST['identifier'] == "tabelaBase"){
	gerarTabela();
}else if ($_REQUEST['identifier'] == "inserirBase"){
	
	$VO->ID_ITEM_PAGAMENTO_ESTAGIO 	= $_SESSION['ID_ITEM_PAGAMENTO_ESTAGIO'];
    $VO->NB_VALOR_BASE        		= $_REQUEST['NB_VALOR_BASE'];
    $VO->DT_INICIO_VIGENCIA   		= $_REQUEST['DT_INICIO_VIGENCIA'];
	$VO->DT_FIM_VIGENCIA      		= $_REQUEST['DT_FIM_VIGENCIA'];

	if ($acesso){
		if (($VO->NB_VALOR_BASE) && ($VO->DT_INICIO_VIGENCIA) && ($VO->DT_FIM_VIGENCIA)){
			$retorno = $VO->inserirBase();
    
			if (is_array($retorno)){    
                $posicao = stripos($retorno['message'], ":");
                $string1 = substr($retorno['message'], $posicao+1);
                $posicao2 = stripos($string1, "ORA");
                $erro = substr($retorno['message'], $posicao+1, $posicao2-1);
            }
			
		}else
			$erro = 'Para inserir preencha os campos Valor, Início de Vigência e Fim de Vigência.';
	}else
		$erro = "Você não tem permissão para realizar esta ação.";
	
	gerarTabela($erro);	

}else if ($_REQUEST['identifier'] == 'excluirBase'){
	
	$VO->NB_VALOR_BASE_ITEM_PAG 		= $_REQUEST['NB_VALOR_BASE_ITEM_PAG'];
	
	if ($acesso){
		
		$retorno = $VO->excluirBase();
		
		if (is_array($retorno))
				$erro = 'Este registro não pode ser excluído pois possui dependentes.';
	}else
		$erro = "Você não tem permissão para realizar esta ação.";
	
	gerarTabela($erro);
        
}else if ($_REQUEST['identifier'] == 'alterar'){
    
	 $VO->ID_ITEM_PAGAMENTO_ESTAGIO = $_SESSION['ID_ITEM_PAGAMENTO_ESTAGIO'];
	 $VO->NB_VALOR_BASE_ITEM_PAG    = $_REQUEST['NB_VALOR_BASE_ITEM_PAG'];
     $VO->NB_VALOR_BASE             = $_REQUEST['NB_VALOR_BASE'];
     $VO->DT_INICIO_VIGENCIA        = $_REQUEST['DT_INICIO_VIGENCIA'];
     $VO->DT_FIM_VIGENCIA           = $_REQUEST['DT_FIM_VIGENCIA'];
if ($acesso){
     if ($VO->NB_VALOR_BASE && $VO->DT_INICIO_VIGENCIA && $VO->DT_FIM_VIGENCIA){

            $retorno = $VO->alterarBase();

            if (is_array($retorno)){    
                $posicao = stripos($retorno['message'], ":");
                $string1 = substr($retorno['message'], $posicao+1);
                $posicao2 = stripos($string1, "ORA");
                $erro = substr($retorno['message'], $posicao+1, $posicao2-1);
            }

        }else
            $erro = "Os campos Valor, Início de Vigência e Fim de Vigência devem ser preenchidos!";
}else
	$erro = "Você não tem permissão para realizar esta ação.";
    
	gerarTabela($erro);
        
}else if($_REQUEST['identifier'] == 'atualizarInfMaster'){
    
    $VO->ID_ITEM_PAGAMENTO_ESTAGIO = $_SESSION['ID_ITEM_PAGAMENTO_ESTAGIO'];

    $VO->atualizarInfMaster();
    $total = $VO->pesquisarEventos(); 
    $total ? $dados = $VO->getVetor() : false;
        
    echo json_encode($dados);
    
}

?>