<?php

include "../../php/define.php";

require_once $pathvo . "quadro_vagasVO.php";
$modulo = 79;
$programa = 1;

require_once "../autenticacao/validaPermissao.php";

session_start();

//--------- pesquisa do detail--------------------------
function gerarTabela($param = '') {
    include "../../php/define.php";
    require_once $pathvo . "quadro_vagasVO.php";
    //require_once $path . "src/quadro_vagas/arrays.php";
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

    $VO = new quadro_vagasVO();

    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];


    $page = $_REQUEST['PAGE'];

    $qtd = 15;
    !$page ? $page = 1 : false;
    $primeiro = ($page * $qtd) - $qtd;

    $total = $VO->pesquisarUnidades();
    //print_r($total);
    $total_page = ceil($total / $qtd);

    $VO->Reg_inicio = $primeiro;
    $VO->Reg_quantidade = $qtd;
    $tot_da_pagina = $VO->pesquisarUnidades();

    echo '<table width="100%" id="tabelaItens" >
			<tr>
                        <th>Órgão Solicitante</th>
                        <th>Tipo</th>
                        <th>Quantidade</th>
                        <th>Curso</th>
			<th>Data de Cadastro</th>
			<th>Data de Atualização</th>';

    //Somente ver a coluna de alterar se tiver acesso completo a tela	
    if ($acesso)
        echo '<th style="width:50px;"></th>';
    echo '</tr>';

    if ($tot_da_pagina) {
        $dados = $VO->getVetor();

        for ($i = 0; $i < $tot_da_pagina; $i++) {
            ($bgcolor == '#F0F0F0') ? $bgcolor = '#DDDDDD' : $bgcolor = '#F0F0F0';
            echo '<tr bgcolor="' . $bgcolor . '" onmouseover="mudarCor(this);" onmouseout="mudarCor(this);">
                                           <td align="center">' . $dados['TX_ORGAO_ESTAGIO'][$i] . '</td>
	                                   <td align="center">' . $dados['TX_TIPO_VAGA_ESTAGIO'][$i] . '</td>
                                           <td align="center">' . $dados['NB_QUANTIDADE'][$i] . '</td>  
                                           <td align="center">' . $dados['TX_CURSO_ESTAGIO'][$i] . '</td>   
                                           <td align="center">' . $dados['DT_CADASTRO'][$i] . '</td>    
		                           <td align="center">' . $dados['DT_ATUALIZACAO'][$i] . '</td> ';

            //Somente ver a coluna de alterar se tiver acesso completo a tela					
            if ($acesso)
                echo'<td align="center" class="icones"> ';
            echo '<a href="' . $dados['ID_ORGAO_ESTAGIO'][$i] . '_' . $dados['CS_TIPO_VAGA_ESTAGIO'][$i] . '" id="alterar"><img src="' . $urlimg . 'icones/editar.png" alt="itens" title="Alterar"/></a> ';
            echo '<a href="' . $dados['ID_ORGAO_ESTAGIO'][$i] . '_' . $dados['CS_TIPO_VAGA_ESTAGIO'][$i] . '" id="excluir"><img src="' . $urlimg . 'icones/excluirItem.png" title="Excluir Registro"/></a>';

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
    }else
        echo '<tr><td colspan="4" class="nenhum">Nenhum registro encontrado.</td></tr></table><br /> ';

    if ($param)
        echo '<script>alert("' . $param . '")</script>';
}

//------------------------quando clico no alterar do detail----------------
function gerarTabelaAlterarUinidade($param = '') {
    include "../../php/define.php";

    require_once $pathvo . "quadro_vagasVO.php";

    require_once $path . "src/quadro_vagas/arrays.php";

    $VO = new quadro_vagasVO();
    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];
    $VO->CS_TIPO_VAGA_ESTAGIO = $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];
    $VO->ID_CURSO_ESTAGIO = $_REQUEST['ID_CURSO_ESTAGIO'];

    // print_r($VO);
    $VO->buscarVagasEstagio();
    $dados = $VO->getVetor();
    //print_r($dados);
    foreach ($orgao_Solicitante as $key => $value) {
        ($dados['ID_ORGAO_ESTAGIO'][0] == $key) ? $selected = 'selected' : $selected = '';
        $orgao_SolicitanteAlt .= '<option value="' . $key . '" ' . $selected . '>' . $value . '</option> ';
    }

    foreach ($pesquisarTipo as $key => $value) {
        ($dados['CS_TIPO_VAGA_ESTAGIO'][0] == $key) ? $selected = 'selected' : $selected = '';
        $pesquisarTipoAlt .= '<option value="' . $key . '" ' . $selected . '>' . $value . '</option> ';
    }

    foreach ($pesquisaCursos as $key => $value) {
        ($dados['ID_CURSO_ESTAGIO'][0] == $key) ? $selected = 'selected' : $selected = '';
        $pesquisaCursosAlt .= '<option value="' . $key . '" ' . $selected . '>' . $value . '</option> ';
    }

    echo "
            <script>
                $(document).ready(function(){
                    $('#NB_QUANTIDADE_ALT').setMask({ mask:'999999' });
                })
            </script>
        ";

    echo '
            <fieldset>
                <legend>Cadastrar Item Adquirido</legend>

                <div id="camada" style="width:240px;"><font color="#FF0000">*</font>Órgão Solicitante 
                    <select name="ID_ORGAO_ESTAGIO_ALT" id="ID_ORGAO_ESTAGIO_ALT" style="width:230px;">' . $orgao_SolicitanteAlt . '</select></div>

                <div id="camada" style="width:130px;"><font color="#FF0000">*</font>Tipo
                    <select name="CS_TIPO_VAGA_ESTAGIO_ALT" id="CS_TIPO_VAGA_ESTAGIO_ALT" style="width:120px;">' . $pesquisarTipoAlt . '</select></div>
                    
                <div id="camada" style="width:130px;"><font color="#FF0000">*</font>Quantidade 
                    <input type="text" name="NB_QUANTIDADE_ALT" id="NB_QUANTIDADE_ALT" value="' . $dados['NB_QUANTIDADE'][0] . '" style="width:120px;" /></div>
                     
                <div id="camada" style="width:200px;"><font color="#FF0000">*</font>Curso 
                    <select name="ID_CURSO_ESTAGIO_ALT" id="ID_CURSO_ESTAGIO_ALT" style="width:230px;">' . $pesquisaCursosAlt . '</select></div>

                <input type="hidden" name="DT_CADASTRO" id="DT_CADASTRO" value="' . $_SESSION['DT_CADASTRO'] . '" />
                <input type="hidden" name="DT_ATUALIZACAO" id="DT_ATUALIZACAO" value="' . $_SESSION['DT_ATUALIZACAO'] . '" />
            </fieldset>
        ';

    if ($param) {
        echo '<script>alert("' . $param . '");</script>';
    }
}

//-----------------PESQUISA COMUM-------------------------------------------
$VO = new quadro_vagasVO();
if ($_REQUEST['identifier'] == "tabela") {
    require_once $path . "src/quadro_vagas/arrays.php";

    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_SESSION['ID_ORGAO_GESTOR_ESTAGIO'];
    $VO->ID_AGENCIA_ESTAGIO = $_SESSION['ID_AGENCIA_ESTAGIO'];
    $VO->CS_SITUACAO = $_SESSION['CS_SITUACAO'];
    $VO->TX_CODIGO = $_SESSION['TX_CODIGO'];
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
			    <th>Agencia de Estágio</th>
			    <th>Situacão</th>
			    <th>Data de Cadastro</th>
                            <th>Data de Atualização</th>';
        //Somente ver a coluna de alterar se tiver acesso completo a tela					
        //if ($acesso) 
        echo '<th style="width:30px;"></th>';
        echo '</tr>';

        for ($i = 0; $i < $tot_da_pagina; $i++) {
            ($bgcolor == '#E6E6E6') ? $bgcolor = '#F0EFEF' : $bgcolor = '#E6E6E6';

            echo '<tr bgcolor="' . $bgcolor . '">
                            <td align="center">' . $dados['TX_CODIGO'][$i] . '</td>
                            <td align="center">' . $dados['TX_ORGAO_GESTOR_ESTAGIO'][$i] . '</td>
			    <td align="center">' . $dados['TX_AGENCIA_ESTAGIO'][$i] . '</td>
                            <td align="center">' . $arraySituacao[$dados['CS_SITUACAO'][$i]] . '</td>    
			    <td align="center">' . $dados['DT_CADASTRO'][$i] . '</td>
                            <td align="center">' . $dados['DT_ATUALIZACAO'][$i] . '</td>
                               
			    ';
            //<td align="center">' . $pesquisarCriterio[$dados['CS_CRITERIO'][$i]] . '</td>  
            //Somente ver a coluna de alterar se tiver acesso completo a tela					
            //if ($acesso) 
            echo '<td align="center"> 
		  <a href="' . $dados['ID_QUADRO_VAGAS_ESTAGIO'][$i] . '" id="alterar"><img src="' . $urlimg . 'icones/editar.png" alt="itens" title="Alterar"/></a></td>';
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
}/* else if ($_REQUEST['identifier'] == "buscarNome"){

  $VO->ID_USUARIO = $_REQUEST['ID_USUARIO_RESP'];

  $VO->pesquisarUsuario();
  $dados = $VO->getVetor();

  echo $dados['TX_LOGIN'][0];


  //--------------- inserir do detail ---------------------------------
  } */ else if ($_REQUEST['identifier'] == "tabelaUnidade") {

    gerarTabela();
} else if ($_REQUEST['identifier'] == "inserirUnidade") {

    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];
    $VO->CS_TIPO_VAGA_ESTAGIO = $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];
    $VO->NB_QUANTIDADE = $_REQUEST['NB_QUANTIDADE'];
    $VO->ID_CURSO_ESTAGIO = $_REQUEST['ID_CURSO_ESTAGIO'];

    if ($acesso) {
        $retorno = $VO->inserirUnidade();

        if (is_array($retorno)) {
            if ($retorno['code'] == '1')
                $erro = 'Registro já existe.';
            else
                $erro = $retorno['message'];
        }
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);
}else if ($_REQUEST['identifier'] == 'atualizarInf') {

    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];
    ;

    $dados = $VO->atualizarInf();

    echo json_encode($dados);
}/* else if ($_REQUEST['identifier'] == "inserirTodas"){

  $VO->ID_USUARIO = $_SESSION['ID_USUARIO'];

  $VO->inserirTodas();

  gerarTabela();

  //---------------------excluir -------------------------------------------------
  } */ else if ($_REQUEST['identifier'] == 'excluirUnidade') {

    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];
    $VO->CS_TIPO_VAGA_ESTAGIO = $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];

    if ($acesso) {

        $retorno = $VO->excluirUnidade();

        if (is_array($retorno))
            $erro = 'Este registro não pode ser excluído pois possui dependentes.';
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);

//-----------------------alterar da pesquisa do detail--------------------------        
}else if ($_REQUEST['identifier'] == "alterarUnidade") {
    gerarTabelaAlterarUinidade();
} else if ($_REQUEST['identifier'] == 'alterar') {

    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];
    $VO->CS_TIPO_VAGA_ESTAGIO = $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];
    $VO->ID_CURSO_ESTAGIO = $_REQUEST['ID_CURSO_ESTAGIO'];

    $retorno = $VO->alterarUnidade();

    if (is_array($retorno)) {
        if ($retorno['code'] == '1')
            $erro = 'Registro já existe.';
        else
            $erro = $retorno['message'];
    }

    gerarTabela($erro);
}

?>