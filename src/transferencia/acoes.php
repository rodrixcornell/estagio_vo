<?php
include "../../php/define.php";
require_once $path . "src/transferencia/arrays.php";
require_once $pathvo . "transferenciaVO.php";

$modulo = 79;
$programa = 4;

require_once "../autenticacao/validaPermissao.php";

session_start();

function gerarTabela($param = '') {
    include "../../php/define.php";
    require_once $pathvo . "transferenciaVO.php";
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

    $VO = new transferenciaVO();
    $VO->CS_TIPO_VAGA_ESTAGIO = $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];
    $VO->ID_TRANSFERENCIA_ESTAGIO = $_SESSION['ID_TRANSFERENCIA_ESTAGIO'];
    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_REQUEST['ID_QUADRO_VAGAS_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];

    $page = $_REQUEST['PAGE'];

    $total = $VO->buscar();
    $dados = $VO->getVetor();
//	print_r($dados);
    if ($dados['CS_SITUACAO'][0] == 2) {
        $acesso = 0;
    }

    $qtd = 15;
    !$page ? $page = 1 : false;
    $primeiro = ($page * $qtd) - $qtd;

    $total = $VO->pesquisarVagasSolicitadas();

    $total_page = ceil($total / $qtd);
    $VO->Reg_inicio = $primeiro;
    $VO->Reg_quantidade = $qtd;
    $tot_da_pagina = $total; //$VO->pesquisarVagasSolicitadas();

    echo '
        <table width="100%" id="tabelaItens" >
            <tr>
                <th style="width:210px;">Órgão Gestor</th>
                <th style="width:210px;">Órgão Solicitante</th>
                <th style="width:210px;">Órgão Cedente</th>
                <th>Tipo</th>
                <th style="width:70px;">Quantidade</th>';

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
                    <td align="center">' . $dados['TX_ORGAO_GESTOR'][$i] . '</td>
                    <td align="center">' . $dados['TX_ORGAO_SOLICITANTE'][$i] . '</td>
                    <td align="center">' . $dados['TX_ORGAO_CEDENTE'][$i] . '</td>
                    <td align="center">' . $dados['TX_TIPO_VAGA_ESTAGIO'][$i] . '</td>     
                    <td align="center">' . $dados['NB_QUANTIDADE'][$i] . '</td> ';

            //Somente ver a coluna de alterar se tiver acesso completo a tela
            if ($acesso)
                echo '
                    <td align="center" class="icones">
                        <a href="' . $dados['CS_TIPO_VAGA_ESTAGIO'][$i] . '" id="alterar" ><img src="' . $urlimg . 'icones/alterarItem.png" title="Excluir Registro"/></a>
                        <a href="' . $dados['CS_TIPO_VAGA_ESTAGIO'][$i] . '" id="excluir" ><img src="' . $urlimg . 'icones/excluirItem.png" title="Excluir Registro"/></a></td>';
            echo '</tr>';
        }

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

//-----------------------------------------------------------------------------

function gerarTabelaAlterar($param = '') {
    include "../../php/define.php";
    require_once $pathvo . "transferenciaVO.php";
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

    $VO = new transferenciaVO();
    $VO->ID_TRANSFERENCIA_ESTAGIO = $_SESSION['ID_TRANSFERENCIA_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];
    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_REQUEST['ID_QUADRO_VAGAS_ESTAGIO'];
    $VO->CS_TIPO_VAGA_ESTAGIO = $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];

    $VO->buscarVagasSolicitadas();
    $dados = $VO->getVetor();

    
    ?>

    <script>
        $(document).ready(function(){
            $('#NB_QUANTIDADE_ALT').setMask({ mask:'999999' });
        })
    </script>
    <!--table width="100%" class="dataGrid" >
        <tr bgcolor="#E0E0E0">
            <td style="width:150px;"><strong>Tipo Transferência de Vagas</strong></td>
           <td><?= $dados['TX_TIPO_VAGA_ESTAGIO'][0] ?></td>
        </tr>
    </table-->
    <br />

    <fieldset>

      <div id="camada" style="width:210px;">
      <strong><font color="#FF0000">*</font>Tipo</strong><br />
      <select name="CS_TIPO_VAGA_ESTAGIO_ALT" id="CS_TIPO_VAGA_ESTAGIO_ALT" style="width:200px;"disabled ="disabled"><?= $arrayTipoAlt ?></select></div>
      
        <div id="camada" style="width:90px;" >
        <strong><font color="#FF0000">*</font>Quantidade</strong><br />
        <input type="text" name="NB_QUANTIDADE_ALT" id="NB_QUANTIDADE_ALT" value="<?= $dados['NB_QUANTIDADE'][0] ?>" style="width:80px;" /></div>
        <br />

        <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:360px;" >
            Usuário do Cadastro:
        <input type="text" name="TX_FUNCIONARIO_CAD_ALT" id="TX_FUNCIONARIO_CAD_ALT" value="<?= $dados['TX_FUNCIONARIO_CAD'][0] ?>"  style="width:350px;" readonly="readonly" class="leitura"/></div>

        <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:140px;" >
            Data do Cadastro:
        <input type="text" name="DT_CADASTRO_ALT" id="DT_CADASTRO_ALT" value="<?= $dados['DT_CADASTRO'][0] ?>"  style="width:130px;" readonly="readonly" class="leitura"/></div>

        <br />
        <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:360px;" >
            Usuário da Atualização:
        <input type="text" name="TX_FUNCIONARIO_ATUAL_ALT" id="TX_FUNCIONARIO_ATUAL_ALT" value="<?= $dados['TX_FUNCIONARIO_ATUAL'][0] ?>"  style="width:350px;" readonly="readonly" class="leitura"/></div>

        <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:140px;" >
            Data da Atualização:
        <input type="text" name="DT_ATUALIZACAO_ALT" id="DT_ATUALIZACAO_ALT" value="<?= $dados['DT_ATUALIZACAO'][0] ?>"  style="width:130px;" readonly="readonly" class="leitura"/></div>

        <br /><br />
        <input type="hidden" name="CS_TIPO_VAGA_ESTAGIO_ALT" id="CS_TIPO_VAGA_ESTAGIO_ALT" value="<?= $dados['CS_TIPO_VAGA_ESTAGIO'][0] ?>" />
    </fieldset>

    <?php
    if ($param) {
        echo '<script>alert("' . $param . '");</script>';
    }
}

//----------------------------pesquisa principal----------------------------
$VO = new transferenciaVO();

if ($_REQUEST['identifier'] == "tabela") {
    $VO->ID_TRANSFERENCIA_ESTAGIO = $_SESSION['ID_TRANSFERENCIA_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];
    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_REQUEST['ID_ORGAO_GESTOR_ESTAGIO'];
    $VO->ID_ORGAO_SOLICITANTE = $_REQUEST['ID_ORGAO_SOLICITANTE'];
    $VO->CS_SITUACAO = $_REQUEST['CS_SITUACAO'];
    $VO->TX_COD_TRANSFERENCIA = $_REQUEST['TX_COD_SOLICITACAO'];
   
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
        echo '
            <table width="100%" class="dataGrid">
                <tr>
                <th>Código</th>
                <th>Órgão Gestor</th>
                <th>Órgão Solicitante</th>
                <th>Òrgão Cedente</th>
                <th>Situação</th>';
        //Somente ver a coluna de alterar se tiver acesso completo a tela
        //if ($acesso)
        echo '<th style="width:30px;"></th>';
        echo '</tr>';

        for ($i = 0; $i < $tot_da_pagina; $i++) {
            ($bgcolor == '#E6E6E6') ? $bgcolor = '#F0EFEF' : $bgcolor = '#E6E6E6';

            echo '
                <tr bgcolor="' . $bgcolor . '">
                    <td align="center">' . $dados['TX_COD_TRANSFERENCIA'][$i] . '</td>
                    <td align="center">' . $dados['TX_ORGAO_GESTOR_ESTAGIO'][$i] . '</td>
                    <td align="center">' . $dados['TX_SOLICITANTE'][$i] . '</td>
                    <td align="center">' . $dados['TX_ORGAO_ESTAGIO'][$i] . '</td>
                    <td align="center">' . $arraySituacao[$dados['CS_SITUACAO'][$i]] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela
            //if ($acesso)
            echo '
                <td align="center">
                    <a href="' . $dados['ID_TRANSFERENCIA_ESTAGIO'][$i] . '_' . $dados['ID_ORGAO_ESTAGIO'][$i] . '" id="alterar"><img src="' . $urlimg . 'icones/editar.png" alt="itens" title="Alterar"/></a></td>';
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

//--------------PASSA ORGÃO CEDENTE DO CADASTRAR-----------------------------   
} else if ($_REQUEST['identifier'] == "pesquisarOrgaoCedente") {

    $VO->ID_ORGAO_SOLICITANTE = $_REQUEST['ID_ORGAO_SOLICITANTE'];

    $total = $VO->pesquisarOrgaoCedente();

    if ($total) {
        $dados = $VO->getVetor();
        echo '<option value="">Escolha...</option>';
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_ORGAO_ESTAGIO'][$i] . '</option>';
        }
    }

//-------------PASSA QUADRO DE VAGAS DO CADASTRAR-------------------------------    
} else if ($_REQUEST['identifier'] == "buscarQuadroVagasEstagio") {

    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];

    $total = $VO->buscarQuadroVagasEstagio();

    if ($total) {
        $dados = $VO->getVetor();
        echo '<option value="">Escolha...</option>';
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_CODIGO'][$i] . '</option>';
        }
    }

//----------------BUSCA O TIPO DO DETAIL---------------------------------------   
} else if ($_REQUEST['identifier'] == "pesquisarTipoVaga") {

    $VO->ID_TRANSFERENCIA_ESTAGIO = $_SESSION['ID_TRANSFERENCIA_ESTAGIO'];
    $VO->CS_SITUACAO = $_SESSION['CS_SITUACAO'];
    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO = $_SESSION['ID_ORGAO_ESTAGIO'];

    $total = $VO->pesquisarTipoVaga();
    echo '<option value="">Escolha...</option>';
    if ($total) {
        $dados = $VO->getVetor();
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_TIPO_VAGA_ESTAGIO'][$i] . '</option>';
           
            }
    }
    
 //----------------BUSCA QUANTIDADE ATUAL DETAIL------------------------------   
   
} else if ($_REQUEST['identifier'] == "buscarQuantAtual") {

     $VO->ID_ORGAO_ESTAGIO = $_SESSION['ID_ORGAO_ESTAGIO'];
     $VO->ID_QUADRO_VAGAS_ESTAGIO = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];
    // $VO->CS_TIPO_VAGA_ESTAGIO = $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];
     
     $total = $VO->buscarQuantAtual();
    
        $dados = $VO->getVetor();
            echo $dados['NB_QUANTIDADE_ATUAL'][0]; 
    
//------------------------------------------------------------------------------
  
    
//------------ QUANTIDADE DO DETAIL----------------------------------------    
} else if ($_REQUEST['identifier'] == "buscarQuantidade") {

    $VO->ID_ORGAO_ESTAGIO = $_SESSION['ID_ORGAO_ESTAGIO'];
    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];
    $VO->CS_TIPO_VAGA_ESTAGIO = $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];
    
    
    $VO->buscarQuantidade();

    $dados = $VO->getVetor();

    echo $dados['NB_QUANTIDADE'][0];

//---------INSERIR TIPO, QUANTIDADE DO DETAIL-----------------------------------
} else if ($_REQUEST['identifier'] == "tabelaVagasSolicitadas") {
    gerarTabela();
} else if ($_REQUEST['identifier'] == "inserirVagasSolicitadas") {

    $VO->ID_TRANSFERENCIA_ESTAGIO = $_SESSION['ID_TRANSFERENCIA_ESTAGIO'];
    $VO->ID_ORGAO_EST_ORIGEM      = $_SESSION['ID_ORGAO_ESTAGIO'];
    $VO->ID_ORGAO_EST_DESTINO     = $_SESSION['ID_ORGAO_SOLICITANTE'];
    $VO->ID_QUADRO_VAGAS_ESTAGIO  = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];
    $VO->CS_TIPO_VAGA_ESTAGIO     = $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];
    $VO->NB_VAGAS_TRANSFERIDAS    = $_REQUEST['NB_VAGAS_TRANSFERIDAS'];
    $VO->NB_QUANTIDADE            = $_REQUEST['NB_QUANTIDADE'];

    if ($acesso) {
        $retorno = $VO->inserirVagasSolicitadas();

        if (is_array($retorno)) {
            if ($retorno['code'] == '1')
                $erro = 'Registro já existe.';
            else
                $erro = $retorno['message'];
        }
     
}else
     $erro = "Você não tem permissão para realizar esta ação.";
      
//------------------------------EXCLUIR ---------------------------------------
        gerarTabela($erro);
} else if ($_REQUEST['identifier'] == "excluirVagasSolicitadas") {

    $VO->ID_TRANSFERENCIA_ESTAGIO = $_SESSION['ID_TRANSFERENCIA_ESTAGIO'];
    $VO->ID_ORGAO_EST_ORIGEM = $_SESSION['ID_ORGAO_ESTAGIO'];
    $VO->ID_ORGAO_EST_DESTINO = $_SESSION['ID_ORGAO_SOLICITANTE'];
    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];
    $VO->CS_TIPO_VAGA_ESTAGIO = $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];
    $VO->NB_VAGAS_TRANSFERIDAS = $_REQUEST['NB_VAGAS_TRANSFERIDAS'];
    $VO->NB_QUANTIDADE = $_REQUEST['NB_QUANTIDADE'];
    
     if ($acesso) {
        $retorno = $VO->excluirVagasSolicitadas();

        if (is_array($retorno)) {
            $erro = 'Este registro não pode ser excluído pois possui dependentes.';
        }
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

//----------------------------ALTERA DETAIL ------------------------------------------------------------------
    gerarTabela($erro);
} else if ($_REQUEST['identifier'] == "tabelaAlterarVagasSolicitadas") {
    gerarTabelaAlterar();
} else if ($_REQUEST['identifier'] == "alterarVagasSolicitadas") {

    $VO->ID_TRANSFERENCIA_ESTAGIO = $_SESSION['ID_TRANSFERENCIA_ESTAGIO'];
    $VO->ID_ORGAO_EST_ORIGEM = $_SESSION['ID_ORGAO_ESTAGIO'];
    $VO->ID_ORGAO_EST_DESTINO = $_SESSION['ID_ORGAO_SOLICITANTE'];
    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];
    $VO->CS_TIPO_VAGA_ESTAGIO = $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];
    $VO->NB_VAGAS_TRANSFERIDAS = $_REQUEST['NB_VAGAS_TRANSFERIDAS'];
    $VO->NB_QUANTIDADE = $_REQUEST['NB_QUANTIDADE'];
    
    if ($acesso) {
      //  if ($VO->ID_TRANSFERENCIA_ESTAGIO && $VO->NB_QUANTIDADE && $VO->CS_TIPO_VAGA_ESTAGIO) {
            $retorno = $VO->alterarVagasSolicitadas();

            if ($retorno['code'] == '1')
                $erro = 'Registro já existe.';
            else
                $erro = $retorno['message'];
       /* }else
            $erro = 'Para Alterar escolha uma Quantidade.';*/
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

//-------------ATUALIZA QUANDO FAZ AUTERAÇÃO------------------------------------------------------------------
    gerarTabela($erro);
} else if ($_REQUEST['identifier'] == 'atualizarInf') {

    $VO->ID_TRANSFERENCIA_ESTAGIO = $_SESSION['ID_TRANSFERENCIA_ESTAGIO'];

    $dados = $VO->atualizarInf();

    echo json_encode($dados);
}
?>