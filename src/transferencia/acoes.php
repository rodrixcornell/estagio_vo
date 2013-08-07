
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
    $tot_da_pagina = $total; 

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
                         <a href="' . $dados['ID_TRANSFERENCIA_ESTAGIO'][$i] . '_' . $dados['CS_TIPO_VAGA_ESTAGIO'][$i] . '" id="alterar"><img src="' . $urlimg . 'icones/alterarItem.png" title="Alterar Registro"/></a>
                         <a href="' . $dados['ID_TRANSFERENCIA_ESTAGIO'][$i] . '_' . $dados['CS_TIPO_VAGA_ESTAGIO'][$i] . '" id="excluir"><img src="' . $urlimg . 'icones/excluirItem.png" title="Excluir Registro"/></a>';
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

//------------------------alterar do detail-------------------------------------

function gerarTabelaAlterar($param = '') {
    include "../../php/define.php";
    require_once $pathvo . "transferenciaVO.php";
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

    $VO = new transferenciaVO();
    $VO->ID_TRANSFERENCIA_ESTAGIO = $_SESSION['ID_TRANSFERENCIA_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO         = $_SESSION['ID_ORGAO_ESTAGIO'];
    $VO->ID_QUADRO_VAGAS_ESTAGIO  = $_REQUEST['ID_QUADRO_VAGAS_ESTAGIO'];
    $VO->CS_TIPO_VAGA_ESTAGIO     = $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];

    $VO->buscarVagasSolicitadas();
    $dados = $VO->getVetor();

    //print_r($dados);
    /*foreach ($arrayTipoVaga as $key => $value) {
        ($dados['CS_TIPO_VAGA_ESTAGIO'][0] == $key) ? $selected = 'selected' : $selected = '';
        $arrayTipoVagaAlt .= '<option value="' . $key . '" ' . $selected . '>' . $value . '</option> ';
    }
   */

    
    echo "
            <script>
                $(document).ready(function(){
                    $('#NB_QUANTIDADE_ALT').setMask({ mask:'999' });
                    
                })
            </script>
        ";

    echo '
 
     <div id="camada" style="width:160px;"><font color="#FF0000">*</font>
     Tipo
     <input type="text" name="TX_TIPO_VAGA_ESTAGIO_ALT" id="TX_TIPO_VAGA_ESTAGIO_ALT" value="' . $dados['TX_TIPO_VAGA_ESTAGIO'][0] .'" style="width:150px;" readonly="readonly" class="leitura"/></div>


     <div id="camada" style="width:155px;"><font color="#FF0000">*</font>
     Quantidade 
     <input type="text" name="NB_QUANTIDADE_ALT" id="NB_QUANTIDADE_ALT" value="' . $dados['NB_QUANTIDADE'][0] . '" style="width:145px; text-align:center;" /></div><br />


      <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:320px;" >
       Usuario Cadastro
      <input type="text" name="TX_FUNCIONARIO_CAD_ALT" id="TX_FUNCIONARIO_CAD_ALT" value="'.$dados['TX_FUNCIONARIO_CAD'][0].'" style="width:310px;" readonly="readonly" class="leitura"/></div>
      

      <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" >
       Data Cadastro 
      <input type="text" name="DT_CADASTRO_ALT" id="DT_CADASTRO_ALT" value="'.$dados['DT_CADASTRO'][0].'" style="width:200px;" readonly="readonly" class="leitura"/></div><br />
      

      <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:320px;" >
       Usuario Atualização
      <input type="text" name="TX_FUNCIONARIO_ATUAL_ALT" id="TX_FUNCIONARIO_ATUAL_ALT" value="'.$dados['TX_FUNCIONARIO_ATUAL'][0].'" style="width:310px;" readonly="readonly" class="leitura"/></div>
      

     <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" >
       Data Atualização 
      <input type="text" name="DT_ATUALIZACAO_ALT" id="DT_ATUALIZACAO_ALT" value="'.$dados['DT_ATUALIZACAO'][0].'" style="width:200px;" readonly="readonly" class="leitura"/></div><br />
	

     <input type="hidden" name="NB_QUANTIDADE_ALT" id="NB_QUANTIDADE_ALT" value="'.$VO->NB_QUANTIDADE.'" />
         
     <input type="hidden" name="CS_TIPO_VAGA_ESTAGIO_ANT" id="CS_TIPO_VAGA_ESTAGIO_ANT" value="'.$VO->CS_TIPO_VAGA_ESTAGIO.'" />
          

      


     ';
    if ($param) {
        echo '<script>alert("' . $param . '");</script>';
    }
}
/* <input type="hidden" name="ID_TRANSFERENCIA_ESTAGIO_ANT" id="ID_TRANSFERENCIA_ESTAGIO_ANT" value="'.$VO->ID_TRANSFERENCIA_ESTAGIO.'" />
     <input type="hidden" name="ID_QUADRO_VAGAS_ESTAGIO_ANT" id="ID_QUADRO_VAGAS_ESTAGIO_ANT" value="'.$VO->ID_QUADRO_VAGAS_ESTAGIO.'" />
     <input type="hidden" name="ID_ORGAO_EST_ORIGEM_ANT" id="ID_ORGAO_EST_ORIGEM_ANT" value="'.$VO->ID_ORGAO_EST_ORIGEM.'" />    
     <input type="hidden" name="ID_ORGAO_EST_DESTINO_ANT" id="ID_ORGAO_EST_DESTINO_ANT" value="'.$VO->ID_ORGAO_EST_DESTINO.'" /> */

//{*<input type="hidden" name="ID_ORGAO_ESTAGIO_ANT" id="ID_ORGAO_ESTAGIO_ANT" value="'.$VO->ID_ORGAO_ESTAGIO.'" />*} 
//----------------------------pesquisa principal----------------------------
$VO = new transferenciaVO();

if ($_REQUEST['identifier'] == "tabela") {
    $VO->ID_TRANSFERENCIA_ESTAGIO = $_SESSION['ID_TRANSFERENCIA_ESTAGIO'];
    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_REQUEST['ID_ORGAO_GESTOR_ESTAGIO'];
    $VO->ID_ORGAO_SOLICITANTE = $_REQUEST['ID_ORGAO_SOLICITANTE'];
    $VO->ID_ORGAO_ESTAGIO = $_SESSION['ID_ORGAO_ESTAGIO'];        
    $VO->CS_SITUACAO = $_SESSION['CS_SITUACAO'];
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

//-----------------PASSA ORGÃO CEDENTE DO CADASTRAR-----------------------------   
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
//---------------------------------------------------------------------------------
//-----------------BUSCA O TIPO CS DO DETAIL---------------------------------------   
} else if ($_REQUEST['identifier'] == "pesquisarTipoVaga") {

    $VO->ID_TRANSFERENCIA_ESTAGIO = $_SESSION['ID_TRANSFERENCIA_ESTAGIO'];
    $VO->CS_SITUACAO = $_SESSION['CS_SITUACAO'];
    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO = $_SESSION['ID_ORGAO_ESTAGIO'];
    $VO->ID_ORGAO_SOLICITANTE = $_SESSION['ID_ORGAO_SOLICITANTE'];
  
    
    $total = $VO->pesquisarTipoVaga();
    echo '<option value="">Escolha...</option>';
    if ($total) {
        $dados = $VO->getVetor();
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_TIPO_VAGA_ESTAGIO'][$i] . '</option>';
           
            }
    }
    
 //----------------BUSCA QUANTIDADE EXISTENTE DETAIL----------------------------   
   
} else if ($_REQUEST['identifier'] == "buscarQuantAtual") {
 
    $VO->ID_ORGAO_ESTAGIO        = $_SESSION['ID_ORGAO_ESTAGIO'];
    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];
    $VO->CS_TIPO_VAGA_ESTAGIO    = $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];
            
    
 $total = $VO->buscarQuantAtual();
 $dados = $VO->getVetor();
 
 
 echo $dados['NB_QUANTIDADE_ATUAL'][0];
 
       
//----------------- QUANTIDADE DO DETAIL----------------------------------------    
} else if ($_REQUEST['identifier'] == "buscarQuantidade") {

    $VO->ID_ORGAO_ESTAGIO        = $_SESSION['ID_ORGAO_ESTAGIO'];
    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];
    $VO->CS_TIPO_VAGA_ESTAGIO    = $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];
    
    
   /*$VO->ID_TRANSFERENCIA_ESTAGIO = $_SESSION['ID_TRANSFERENCIA_ESTAGIO'];
    $VO->ID_ORGAO_EST_ORIGEM      = $_SESSION['ID_ORGAO_ESTAGIO'];
    $VO->ID_ORGAO_EST_DESTINO     = $_SESSION['ID_ORGAO_SOLICITANTE'];
    $VO->ID_QUADRO_VAGAS_ESTAGIO  = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];
    $VO->CS_TIPO_VAGA_ESTAGIO     = $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];
    $VO->NB_VAGAS_TRANSFERIDAS    = $_REQUEST['NB_VAGAS_TRANSFERIDAS'];
    $VO->NB_QUANTIDADE            = $_REQUEST['NB_QUANTIDADE'];*/
    
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
       			
	$VO-> buscarQuantidade();
	$qtd = $VO->getVetor();
              
	    $total = $VO->buscarQuantAtual();
      	
	    
            if (($VO->NB_QUANTIDADE) <= ($VO->NB_VAGAS_TRANSFERIDAS)&&($VO->NB_QUANTIDADE)>0){  
              
                 $retorno = $VO->inserirVagasSolicitadas(); 
                      
                
                 
               if ($retorno) {
		   $erro = 'Registro já existe.';
			}
                 
                        
	       }else $erro = 'O valor inserido não pode ser maior que a quantidade e nem igual zero';
      
   }else
       $erro = "Você não tem permissão para realizar esta ação.";    
     
gerarTabela($erro);

//-------------------------------EXCLUIR DO DETAIL------------------------------

} else if ($_REQUEST['identifier'] == "excluirVagasSolicitadas") {

    $VO->ID_TRANSFERENCIA_ESTAGIO = $_SESSION['ID_TRANSFERENCIA_ESTAGIO'];
    $VO->CS_TIPO_VAGA_ESTAGIO     = $_REQUEST['CS_TIPO_VAGA_ESTAGIO'];
    $VO->ID_QUADRO_VAGAS_ESTAGIO  = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO']; 
    $VO->ID_ORGAO_EST_ORIGEM      = $_SESSION['ID_ORGAO_ESTAGIO'];
    $VO->ID_ORGAO_EST_DESTINO     = $_SESSION['ID_ORGAO_SOLICITANTE'];
       
    if ($acesso) {
        $retorno = $VO->excluirVagasSolicitadas();

        if (is_array($retorno)) {
            $erro = 'Este registro não pode ser excluído pois possui dependentes.';
        }
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);


//------------------------------------------------------------------------------    
//----------------------------ALTERA DETAIL ------------------------------------
} else if ($_REQUEST['identifier'] == "tabelaAlterarVagasSolicitadas") {
    gerarTabelaAlterar();
} else if ($_REQUEST['identifier'] == "alterarVagasSolicitadas") {
  
    $VO->ID_TRANSFERENCIA_ESTAGIO = $_SESSION['ID_TRANSFERENCIA_ESTAGIO'];
    $VO->CS_TIPO_VAGA_ESTAGIO     = $_REQUEST['CS_TIPO_VAGA_ESTAGIO']; 
    $VO->ID_QUADRO_VAGAS_ESTAGIO  = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];  
    $VO->ID_ORGAO_EST_ORIGEM      = $_SESSION['ID_ORGAO_ESTAGIO'];
    $VO->ID_ORGAO_EST_DESTINO     = $_SESSION['ID_ORGAO_SOLICITANTE'];
    $VO->NB_QUANTIDADE            = $_REQUEST['NB_QUANTIDADE'];
    $VO->NB_VAGAS_TRANSFERIDAS    = $_REQUEST['NB_VAGAS_TRANSFERIDAS'];  
        

  if ($acesso) {
             	
	    
       if (($VO->NB_QUANTIDADE) <= ($VO->NB_VAGAS_TRANSFERIDAS)&&($VO->NB_QUANTIDADE)>0){    
            $retorno = $VO->alterarVagasSolicitadas();
                
                 
               if ($retorno) {
		   $erro = 'Registro já existe.';
			}
                 
                        
	    }else $erro = 'O valor alterado não pode ser maior que a quantidade e nem igual zero';
      
   }else
       $erro = "Você não tem permissão para realizar esta ação.";    
     
gerarTabela($erro);     
//if ($acesso) {
        /*if ($VO->ID_TRANSFERENCIA_ESTAGIO && 
            $VO->CS_TIPO_VAGA_ESTAGIO && 
            $VO->ID_QUADRO_VAGAS_ESTAGIO &&  
            $VO->ID_ORGAO_EST_ORIGEM &&
            $VO->ID_ORGAO_EST_DESTINO &&
            $VO->NB_QUANTIDADE) {
         			
	$VO-> buscarQuantidade();
	$qtd = $VO->getVetor();
              
	    $total = $VO->buscarQuantAtual();
      	
         if (($VO->NB_QUANTIDADE_ALT) <= ($VO->NB_VAGAS_TRANSFERIDAS)){  
            
            $retorno = $VO->alterarVagasSolicitadas();

            if ($retorno['code'] == '1')
                $erro = 'Registro já existe.';
            else
                $erro = $retorno['message'];
        }else
            $erro = 'Para Alterar escolha  uma Quantidade.';
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);*/
    
//------------------------------------------------------------------------------
//-------------ATUALIZA QUANDO FAZ AUTERAÇÃO------------------------------------
} else if ($_REQUEST['identifier'] == 'atualizarInf') {

    $VO->ID_TRANSFERENCIA_ESTAGIO = $_SESSION['ID_TRANSFERENCIA_ESTAGIO'];

    $dados = $VO->atualizarInf();

    echo json_encode($dados);
}
?>