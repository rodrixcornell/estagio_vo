<?php
include "../../php/define.php";
require_once $pathvo . "recrutamentoVO.php";

$modulo = 79;
$programa = 5;

require_once "../autenticacao/validaPermissao.php";

session_start();

function gerarTabela($param = '') {
    include "../../php/define.php";
    require_once $pathvo . "recrutamentoVO.php";
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

    $VO = new recrutamentoVO();
    $VO->ID_RECRUTAMENTO_ESTAGIO = $_SESSION['ID_RECRUTAMENTO_ESTAGIO'];
    $VO->TX_ORGAO_GESTOR         = $_SESSION['TX_ORGAO_GESTOR'];
    $VO->TX_ORGAO_SOLICITANTE    = $_SESSION['TX_ORGAO_SOLICITANTE'];
    $VO->TX_DOC_AUTORIZACAO      = $_SESSION['TX_DOC_AUTORIZACAO'];
	
    $page = $_REQUEST['PAGE'];


    $qtd = 15;
    !$page ? $page = 1 : false;
    $primeiro = ($page * $qtd) - $qtd;

    $total = $VO->buscarRecrutamento();

    $total_page = ceil($total / $qtd);

    $VO->Reg_inicio = $primeiro;
    $VO->Reg_quantidade = $qtd;
    $tot_da_pagina = $VO->buscarVaga();

    echo '<table width="100%" id="tabelaItens" >
        <tr>
        <th>Órgão Gestor</th>
        <th>Órgão Solicitante</th>
        <th>Quadro de Vagas</th>
        <th>Tipo de Vaga</th>
        <th style="width:145px;">Quantidade</th>';

    //Somente ver a coluna de alterar se tiver acesso completo a tela	
    if ($acesso)
        echo '<th style="width:50px;"></th>';

    echo '</tr>';

    if ($tot_da_pagina) {
        $dados = $VO->getVetor();

        for ($i = 0; $i < $tot_da_pagina; $i++) {

            ($bgcolor == '#F0F0F0') ? $bgcolor = '#DDDDDD' : $bgcolor = '#F0F0F0';

            echo '<tr bgcolor="' . $bgcolor . '" onmouseover="mudarCor(this);" onmouseout="mudarCor(this);">
                <td align="center">' . $dados['TX_ORGAO_GESTOR'][$i] . '</td>
                <td align="center">' . $dados['TX_ORGAO_SOLICITANTE'][$i] . '</td>
                <td align="center">' . $dados['TX_QUADRO_VAGAS'][$i] . '</td>
                <td align="center">' . $dados['TX_TIPO_VAGA_ESTAGIO'][$i] . '</td>
                <td align="center" class="qtd">' . $dados['NB_QUANTIDADE'][$i] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela					
            if ($acesso)
        echo '<td align="center" class="icones">
		<a href="' . $dados['NB_VAGAS_RECRUTAMENTO'][$i] . '" id="alterar" ><img src="' . $urlimg . 'icones/alterarItem.png" title="Alterar Registro"/></a>
		<a href="' . $dados['NB_VAGAS_RECRUTAMENTO'][$i] . '" id="excluir" ><img src="' . $urlimg . 'icones/excluirItem.png" title="Excluir Registro"/></a></td>';
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

$VO = new recrutamentoVO();

if ($_REQUEST['identifier'] == "tabela") {
    $VO->ID_RECRUTAMENTO_ESTAGIO = $_REQUEST['ID_RECRUTAMENTO_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO        = $_REQUEST['ID_ORGAO_ESTAGIO'];
    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_REQUEST['ID_ORGAO_GESTOR_ESTAGIO'];
    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_REQUEST['ID_QUADRO_VAGAS_ESTAGIO'];
    $VO->TX_COD_RECRUTAMENTO     = $_REQUEST['TX_COD_RECRUTAMENTO'];

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
             <th>Código</th>
             <th>Órgão Gestor</th>
             <th>Órgão Solicitante</th>
             <th>Quadro de Vagas</th>
             <th>Doc. Autorização</th>
             <th style="width:150px;">Data de Atualização</th>
								';
        //Somente ver a coluna de alterar se tiver acesso completo a tela					
        //if ($acesso)
            echo '<th style="width:30px;"></th>';
        echo '</tr>';

        for ($i = 0; $i < $tot_da_pagina; $i++) {
            ($bgcolor == '#E6E6E6') ? $bgcolor = '#F0EFEF' : $bgcolor = '#E6E6E6';

            echo '<tr bgcolor="' . $bgcolor . '">
                <td align="center">' . $dados['ID_RECRUTAMENTO_ESTAGIO'][$i] . '</td>
                <td align="center">' . $dados['TX_ORGAO_GESTOR'][$i] . '</td>
                <td align="center">' . $dados['TX_ORGAO_SOLICITANTE'][$i] . '</td>
                <td align="center">' . $dados['TX_QUADRO_VAGAS'][$i] . '</td>
                <td align="center">' . $dados['TX_DOC_AUTORIZACAO'][$i] . '</td>
                <td align="center">' . $dados['DT_ATUALIZACAO'][$i] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela					
           // if ($acesso)

          echo '<td align="center"> 
		  <a href="' . $dados['ID_RECRUTAMENTO_ESTAGIO'][$i] . '" id="alterar"><img src="' . $urlimg . 'icones/editar.png" alt="itens" title="Alterar"/></a></td>';

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
} else if ($_REQUEST['identifier'] == "buscarCodigo") {

    $VO->ID_RECRUTAMENTO_ESTAGIO = $_REQUEST['ID_RECRUTAMENTO_ESTAGIO'];

    $VO->pesquisarCodigo();
    $dados = $VO->getVetor();



    echo $dados['TX_FUNCIONARIO'][0];
} else if ($_REQUEST['identifier'] == "tabelaVagas") {
    gerarTabela();
} else if ($_REQUEST['identifier'] == "inserirVaga") {

    $VO->ID_RECRUTAMENTO_ESTAGIO = $_SESSION['ID_RECRUTAMENTO_ESTAGIO'];
    $VO->CS_TIPO_VAGA_ESTAGIO    = $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];
    $VO->NB_QUANTIDADE           = $_REQUEST['NB_QUANTIDADE'];

    if ($acesso) {
        if ( ($VO->CS_TIPO_VAGA_ESTAGIO) || ($VO->NB_QUANTIDADE) ){
            $retorno = $VO->inserirVaga();

            if ($retorno) {
                $erro = 'Registro já existe.';
            }
        }else
            $erro = 'Para inserir escolha uma Vaga.';
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);
}else if ($_REQUEST['identifier'] == 'atualizarInf') {

    $VO->ID_RECRUTAMENTO_ESTAGIO = $_SESSION['ID_RECRUTAMENTO_ESTAGIO'];
    

    $dados = $VO->atualizarInf();

    echo json_encode($dados);
} else if ($_REQUEST['identifier'] == 'excluirVaga') {

    $VO->ID_RECRUTAMENTO_ESTAGIO = $_SESSION['ID_RECRUTAMENTO_ESTAGIO'];
    $VO->NB_VAGAS_RECRUTAMENTO   = $_REQUEST['NB_VAGAS_RECRUTAMENTO'];

    if ($acesso) {

        $retorno = $VO->excluirVaga();

        if (is_array($retorno))
            $erro = 'Este registro não pode ser excluído pois possui dependentes.';
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);

}else if ($_REQUEST['identifier'] == 'alterarVaga'){
    
        $VO->ID_RECRUTAMENTO_ESTAGIO= $_SESSION['ID_RECRUTAMENTO_ESTAGIO'];
		$VO->NB_VAGAS_RECRUTAMENTO	= $_REQUEST['NB_VAGAS_RECRUTAMENTO'];
        $VO->NB_QUANTIDADE			= $_REQUEST['NB_QUANTIDADE'];
        
	
	    if ($VO->NB_QUANTIDADE){
	
			$retorno = $VO->alterarVaga();
			if (is_array($retorno)){	
				$posicao = stripos($retorno['message'], ":");
				$string1 = substr($retorno['message'], $posicao+1);
				$posicao2 = stripos($string1, "ORA");
				$erro = substr($retorno['message'], $posicao+1, $posicao2-1);
			}
	
		}else
			$erro = "O campo Quantidade devem ser preenchidos.";
                
     gerarTabela($erro);
		
}
?>