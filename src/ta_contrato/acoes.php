<?php
include "../../php/define.php";
require_once $path . "src/ta_contrato/arrays.php";
require_once $pathvo . "ta_contratoVO.php";

$modulo = 80;
$programa = 7;

require_once "../autenticacao/validaPermissao.php";

session_start();

function gerarTabela($param = '') {
    include "../../php/define.php";
    require_once $pathvo . "ta_contratoVO.php";
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

    $VO = new ta_contratoVO();
    $VO->ID_SOLICITACAO_TA_CP 		= $_SESSION['ID_SOLICITACAO_TA_CP '];
    $VO->ID_ORGAO_GESTOR_ESTAGIO 	= $_REQUEST['ID_ORGAO_GESTOR_ESTAGIO'];
    $VO->ID_ADITIVO_CONTRATO_CP         = $_REQUEST['ID_ADITIVO_CONTRATO_CP'];
    $VO->ID_CONTRATO_CP                 = $_REQUEST['ID_CONTRATO_CP'];
	
    $page = $_REQUEST['PAGE'];
	
    $total = $VO->buscar();
    $dados = $VO->getVetor();
	
	if ($dados['CS_SITUACAO'][0] == 2){
	   $acesso = 0;
	} 
	
    $qtd = 15;
    !$page ? $page = 1 : false;
    $primeiro = ($page * $qtd) - $qtd;

    $total = $VO->pesquisarTipoVaga();

    $total_page = ceil($total / $qtd);

    $VO->Reg_inicio = $primeiro;
    $VO->Reg_quantidade = $qtd;
    $tot_da_pagina = $VO->pesquisarTipoVaga();
	
    echo '
        <table width="100%" id="tabelaItens" >
            <tr>
                <th style="width:100px;">Tipo de Vaga</th>
                <th style="width:70px;">Quantidade</th>
                <th style="width:100px;">Taxa Administrativa</th>
                <th style="width:100px;">Auxilio Transporte</th>
                <th style="width:70px;">Bolsa Auxilio</th>
                <th style="width:100px;">Total Mensal</th>';

    //Somente ver a coluna de alterar se tiver acesso completo a tela
    if ($acesso)
        echo '<th style="width:50px;"></th>';

    echo '</tr>';

    if ($tot_da_pagina) {
        $dados = $VO->getVetor();

        for ($i = 0; $i < $tot_da_pagina; $i++) {

            ($bgcolor == '#F0F0F0') ? $bgcolor = '#DDDDDD' : $bgcolor = '#F0F0F0';

            echo '
                <tr bgcolor="' . $bgcolor . '" onmouseover="mudarCor(this);" onmouseout="mudarCor(this);">
                    <td align="center">' . $dados['TX_TIPO_VAGA_ESTAGIO'][$i] . '</td>
                    <td align="center">' . $dados['NB_QUANTIDADE'][$i] . '</td>
                    <td align="center">' . $dados['NB_TAXA_ADMINISTRATIVA'][$i] . '</td>
                    <td align="center">' . $dados['NB_AUXILIO_TRANSPORTE'][$i] . '</td>
                    <td align="center">' . $dados['NB_BOLSA_AUXILIO'][$i] . '</td>
                    <td align="center">' . $dados['TX_CURSO_ESTAGIO'][$i] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela
            if ($acesso)
                echo '
                    <td align="center" class="icones">
                        <a href="' . $dados['ID_SOLICITACAO_TA_CP'][$i] . '" id="alterar" ><img src="' . $urlimg . 'icones/alterarItem.png" title="Alterar Registro"/></a>
                        <a href="' . $dados['CS_TIPO_VAGA_ESTAGIO'][$i] . '" id="excluir" ><img src="' . $urlimg . 'icones/excluirItem.png" title="Excluir Registro"/></a></td>';
            echo '</tr>';
        }
         //$dados['ID_SOLICITACAO_TA_CP'][$i] . '_' . $dados['ID_ORGAO_GESTOR_ESTAGIO'][$i] . '" 
        echo'</table>';

        if ($total_page > 1) {
            echo '<div id="paginacao" align="center"><ul>';

            for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $page)
                    echo '<li id="' . $i . '" class="selecionado">' . $i . '</li>';
                else
                    echo '<li id="' . $i . '">' . $i . '</li>';
            }
            echo '</ul></div><br><br>';
        }
    }else
        echo '<tr><td colspan="6" class="nenhum">Nenhum registro encontrado.</td></tr></table><br /> ';

    if ($param)
        echo '<script>alert("' . $param . '")</script>';
}

//------------------------------------------------------------------------------

function gerarTabelaAlterar($param = '') {
    include "../../php/define.php";
    require_once $pathvo . "ta_contratoVO.php";
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

    $VO = new ta_contratoVO();
    $VO->ID_SOLICITACAO_ESTAGIO 	= $_SESSION['ID_SOLICITACAO_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO 	        = $_REQUEST['ID_ORGAO_ESTAGIO'];
    $VO->ID_QUADRO_VAGAS_ESTAGIO	= $_REQUEST['ID_QUADRO_VAGAS_ESTAGIO'];
    $VO->CS_TIPO_VAGA_ESTAGIO 		= $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];

    $VO->buscarVagasSolicitadas();
    $dados = $VO->getVetor();

/*    $VO->buscarCursos();
    $arrayCursos = $VO->getArray("TX_CURSO_ESTAGIO");
    foreach ($arrayCursos as $key => $value) {
        ($dados['ID_CURSO_ESTAGIO'][0] == $key) ? $selected = 'selected' : $selected = '';
        $arrayCursosAlt .= '<option value="' . $key . '" ' . $selected . '>' . $value . '</option> ';
    }*/
    
    ?>

    <script>
        $(document).ready(function(){
            $('#NB_QUANTIDADE').setMask({ mask:'999999' });
        })
    </script>
    <table width="100%" class="dataGrid" >
        <tr bgcolor="#E0E0E0">
            <td style="width:200px;"><strong>Tipo Vaga Estágio</strong></td>
            <td><?=$dados['TX_TIPO_VAGA_ESTAGIO'][0]?></td>
        </tr>
    </table>
    <br />
                                  
    <fieldset>
        <!-- TIPOS DE VAGA -->
        <div id="camada" style="width:110px;">
            <font color="#FF0000">*</font>Tipo de Vaga<br />
            <select name="TX_TIPO_VAGA_ESTAGIO" id="TX_TIPO_VAGA_ESTAGIO" style="width:110px;"><?=$arrayTipoVaga?></select>
       </div>

       <!-- QUANTIDADE -->
        <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:85px;" >
            <font color="#FF0000">*</font>Quantidade<br />
            <input type="text" name="NB_QUANTIDADE" id="NB_QUANTIDADE" value="<?=$dados['NB_QUANTIDADE'][0]?>" style="width:80px;" />
        </div>

        <!-- TAXA ADMINISTRATIVA -->
        <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:85px;" >
            <font color="#FF0000">*</font>Taxa Adm.<br />
            <input type="text" name="NB_TAXA_ADMINISTRATIVA" id="NB_TAXA_ADMINISTRATIVA" value="<?=$dados['NB_TAXA_ADMINISTRATIVA'][0]?>"  style="width:80px;"/>
        </div>
        
        <!-- AUXILIO TRANSPORTE -->
        <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:105px;" >
            <font color="#FF0000">*</font>Aux. Transporte<br />
            <input type="text" name="NB_AUXILIO_TRANSPORTE" id="NB_AUXILIO_TRANSPORTE" value="<?=$dados['NB_AUXILIO_TRANSPORTE'][0]?>"  style="width:100px;"/>
        </div>
        
        <!--  BOLSA AUXILIO -->
        <div color="red" id="camada" style="font-family:Verdana, Geneva, sans-serif; width:80px;" >
            <font color="#FF0000">*</font>Bolsa Auxilio<br />
            <input type="text" name="NB_BOLSA_AUXILIO" id="NB_BOLSA_AUXILIO" value="<?=$dados['NB_BOLSA_AUXILIO'][0]?>"  style="width:103px;"/>
        </div><br />
        
        <!-- USUARIO DO CADASTRO -->
          <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:360px;" >
            Usuário do Cadastro:
            <input type="text" name="TX_FUNCIONARIO_CAD" id="TX_FUNCIONARIO_CAD" value="<?=$dados['TX_FUNCIONARIO_CAD'][0]?>"  style="width:350px;" readonly="readonly" class="leitura"/></div>

        <!-- DATA DO CADASTRO -->    
        <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:130px;" >
            Data do Cadastro:
            <input type="text" name="DT_CADASTRO" id="DT_CADASTRO" value="<?=$dados['DT_CADASTRO'][0]?>"  style="width:140px;" readonly="readonly" class="leitura"/>
        </div><br />
        
        <!-- USUARIO DA ATUALIZACAO -->
        <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:360px;" >
            Usuário da Atualização:
            <input type="text" name="TX_FUNCIONARIO_ATUAL" id="TX_FUNCIONARIO_ATUAL" value="<?=$dados['TX_FUNCIONARIO_ATUAL'][0]?>"  style="width:350px;" readonly="readonly" class="leitura"/>
        </div>
 
        <!-- DATA DA ATUALIZACAO -->
        <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:130px;" >
            Data da Atualização:
            <input type="text" name="DT_ATUALIZACAO" id="DT_ATUALIZACAO" value="<?=$dados['DT_ATUALIZACAO'][0]?>"  style="width:140px;" readonly="readonly" class="leitura"/>
        </div>

        <br /><br />
        <input type="hidden" name="CS_TIPO_VAGA_ESTAGIO" id="CS_TIPO_VAGA_ESTAGIO" value="<?=$dados['CS_TIPO_VAGA_ESTAGIO'][0]?>" />
    </fieldset>

    <?php
    if ($param) {
        echo '<script>alert("' . $param . '");</script>';
    }
}
//-----------------------PESQUISA PRINCIPAL-------------------------------------
$VO = new ta_contratoVO();

if ($_REQUEST['identifier'] == "tabela") {
    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_REQUEST['ID_ORGAO_GESTOR_ESTAGIO'];
    $VO->ID_CONTRATO_CP          = $_REQUEST['ID_CONTRATO_CP'];
    $VO->ID_ADITIVO_CONTRATO_CP  = $_REQUEST['ID_ADITIVO_CONTRATO_CP'];
    $VO->TX_CODIGO               = $_REQUEST['TX_CODIGO'];

    $page = $_REQUEST['PAGE'];

    $VO->preencherSessionPesquisar($_REQUEST);

    $qtd = 15;
    !$page ? $page = 1 : false;
    $primeiro = ($page * $qtd) - $qtd;

    $total = $VO->pesquisar();
    
    $total_page = ceil($total / $qtd);

    $VO->Reg_inicio = $primeiro;
    $VO->Reg_quantidade = $qtd;
    $tot_da_pagina = $total;

    if ($tot_da_pagina) {
        $dados = $VO->getVetor();
        echo' 
            <table width="100%" class="dataGrid">
                <tr>
                    <th>Órgão Gestor</th>
                    <th>Contrato</th>
                    <th>Termo Aditivo</th>
                    <th>Solicitação do TAC</th>
                    <th>Data da Solicitação</th>';
        //Somente ver a coluna de alterar se tiver acesso completo a tela
        //if ($acesso)
        echo '<th style="width:30px;"></th>';
        echo '</tr>';

        for ($i = 0; $i < $tot_da_pagina; $i++) {
            ($bgcolor == '#E6E6E6') ? $bgcolor = '#F0EFEF' : $bgcolor = '#E6E6E6';

            echo '
                <tr bgcolor="' . $bgcolor . '">
                    <td align="center">' . $dados['TX_ORGAO_GESTOR_ESTAGIO'][$i] . '</td>
                    <td align="center">' . $dados['NB_CODIGO_CONTRATO'][$i] . '</td>
                    <td align="center">' . $dados['NB_CODIGO'][$i] . '</td>
                    <td align="center">' . $dados['TX_CODIGO'][$i] . '</td>
                    <td align="center">' . $dados['DT_SOLICITACAO'][$i] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela
            //if ($acesso)
      echo '
        <td align="center">
  <a href="' . $dados['ID_SOLICITACAO_TA_CP'][$i] . '_' . $dados['ID_ORGAO_GESTOR_ESTAGIO'][$i] . '" id="alterar"><img src="' . $urlimg . 'icones/editar.png" alt="itens" title="Alterar"/></a></td>';
            echo '</tr>';
        }

        echo '</table>';

        if ($total_page > 1) {
            echo '<div id="paginacao" align="center"><ul>';

            for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $page)
                    echo '<li id="' . $i . '" class="selecionado">' . $i . '</li>';
                else
                    echo '<li id="' . $i . '">' . $i . '</li>';
            }
            echo '</ul></div>';
        }
    }else {
        echo '<div id="nao_encontrado">Nenhum registro encontrado.</div>';
    }
//------------------------------------------------------------------------------
 /*   
} else if ($_REQUEST['identifier'] == "buscarAgenciaEstagio") {

    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];
    $total = $VO->buscarAgenciaEstagio();

	echo '<option value="">Escolha...</option>';
    if ($total) {
        $dados = $VO->getVetor();
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_AGENCIA_ESTAGIO'][$i] . '</option>';
        }
    }
*/ 
//-------------PASSA ORGÃO ORIGEM DO CADASTRAR----------------------------------
}else if ($_REQUEST['identifier'] == "gerarDestino") {

    $VO->ID_UNIDADE_ORG_ORIGEM = $_REQUEST['ID_UNIDADE_ORG_ORIGEM'];
    $total = $VO->buscarUnidadeDestino();

	echo '<option value="">Escolha...</option>';
    if ($total) {
        $dados = $VO->getVetor();
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_UNIDADE_ORG'][$i] . '</option>';
        }
    }
//-------------PASSA ORGÃO DESTINO DO CADASTRAR----------------------------------
}  else if ($_REQUEST['identifier'] == "buscarDestino") {

    $VO->ID_UNIDADE_ORIGEM = $_REQUEST['ID_UNIDADE_ORIGEM'];

    $total = $VO->buscarDestino();

    if ($total) {
        $dados = $VO->getVetor();
        echo '<option value="">Escolha...</option>';
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_UNIDADE_ORIGEM'][$i] . '</option>';
        }
    }
//--------------------PESQUISAR TIPO DE VAGA------------------------------------
	
} else if ($_REQUEST['identifier'] == "pesquisarTipoVaga") {

    $VO->ID_SOLICITACAO_TA_CP	   = $_SESSION['ID_SOLICITACAO_TA_CP'];
    $VO->CS_SITUACAO               = $_SESSION['CS_SITUACAO'];
    $VO->ID_UNID_ORIGEM            = $_SESSION['ID_UNID_ORIGEM'];

    $total = $VO->pesquisarTipoVaga();
	echo '<option value="">Escolha...</option>';
    if ($total) {
        $dados = $VO->getVetor();    
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_TIPO_VAGA_ESTAGIO'][$i] . '</option>';
        }
    }
//------------------------------------------------------------------------------    
} else if ($_REQUEST['identifier'] == "buscarQuantidade") {

    $VO->ID_ORGAO_ESTAGIO = $_SESSION['ID_ORGAO_ESTAGIO'];
    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];
    $VO->CS_TIPO_VAGA_ESTAGIO = $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];
    $VO->ID_CURSO_ESTAGIO = $_REQUEST['ID_CURSO_ESTAGIO'];
    $VO->NB_QUANTIDADE = $_REQUEST['NB_QUANTIDADE'];

    $VO->buscarQuantidade();

    $dados = $VO->getVetor();

    echo $dados['NB_QUANTIDADE'][0];
}else if ($_REQUEST['identifier'] == "tabelaVagasSolicitadas") {
} else if ($_REQUEST['identifier'] == "inserirVagasSolicitadas") {

    $VO->ID_SOLICITACAO_TA_CP 	= $_SESSION['ID_SOLICITACAO_TA_CP'];    gerarTabela();
    $VO->CS_TIPO_VAGA_ESTAGIO   = $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];
    $VO->NB_QUANTIDADE 		= $_REQUEST['NB_QUANTIDADE'];
    $VO->NB_TAXA_ADMINISTRATIVA = $_REQUEST['NB_TAXA_ADMINISTRATIVA'];
    $VO->NB_AUXILIO_TRANSPORTE  = $_REQUEST['NB_AUXILIO_TRANSPORTE'];
    $VO->NB_BOLSA_AUXILIO       = $_REQUEST['NB_BOLSA_AUXILIO'];
     
    if ($acesso) {
        if ($VO->ID_SOLICITACAO_ESTAGIO && $VO->ID_ORGAO_ESTAGIO && $VO->ID_QUADRO_VAGAS_ESTAGIO && $VO->CS_TIPO_VAGA_ESTAGIO && $VO->NB_QUANTIDADE) {
            $retorno = $VO->inserirVagasSolicitadas();

            if ($retorno) {
                $erro = 'Registro já existe.';
            }
        }else
            $erro = 'Para inserir escolha Tipo e Quantidade.';
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);
} else if ($_REQUEST['identifier'] == "excluirVagasSolicitadas") {

    $VO->ID_SOLICITACAO_TA_CP 	= $_SESSION['ID_SOLICITACAO_TA_CP'];
    $VO->CS_TIPO_VAGA_ESTAGIO 		= $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];

    if ($acesso) {
        $retorno = $VO->excluirVagasSolicitadas();

        if (is_array($retorno)) {
            $erro = 'Este registro não pode ser excluído pois possui dependentes.';
        }
    }else
        $erro = "Você não tem permissão para realizar esta ação.";
//-------------------------ALTERAR-DETAIL---------------------------------------
    gerarTabela($erro);
} else if ($_REQUEST['identifier'] == "tabelaAlterarVagasSolicitadas") {
    gerarTabelaAlterar();
} else if ($_REQUEST['identifier'] == "alterarVagasSolicitadas") {

    $VO->ID_SOLICITACAO_ESTAGIO  = $_SESSION['ID_SOLICITACAO_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGI         = $_REQUEST['ID_ORGAO_ESTAGIO'];
    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_REQUEST['ID_QUADRO_VAGAS_ESTAGIO'];
    $VO->CS_TIPO_VAGA_ESTAGIO 	 = $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];
    $VO->NB_QUANTIDADE 	         = $_REQUEST['NB_QUANTIDADE'];
    $VO->ID_CURSO_ESTAGIO        = $_REQUEST['ID_CURSO_ESTAGIO'];

    if ($acesso) {
        if ($VO->ID_SOLICITACAO_ESTAGIO && $VO->ID_ORGAO_ESTAGIO && $VO->ID_QUADRO_VAGAS_ESTAGIO && $VO->CS_TIPO_VAGA_ESTAGIO && $VO->NB_QUANTIDADE) {
            $retorno = $VO->alterarVagasSolicitadas();

            if ($retorno['code'] == '1')
                $erro = 'Registro já existe.';
            else
                $erro = $retorno['message'];
        }else
            $erro = 'Para Alterar escolha uma Quantidade.';
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);
} else if ($_REQUEST['identifier'] == 'atualizarInf') {

    $VO->ID_SOLICITACAO_ESTAGIO = $_SESSION['ID_SOLICITACAO_ESTAGIO'];

    $dados = $VO->atualizarInf();

    echo json_encode($dados);
} 
?>