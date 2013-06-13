<?php
include "../../php/define.php";
require_once $pathvo . "selecaoVO.php";

$modulo = 78;
$programa = 6;

require_once "../autenticacao/validaPermissao.php";

session_start();

function gerarTabela($param = '') {
    include "../../php/define.php";
    require_once $pathvo . "selecaoVO.php";
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

    $VO = new selecaoVO();
    
    $VO->ID_SELECAO_ESTAGIO      = $_SESSION['ID_SELECAO_ESTAGIO'];
    $VO->buscarSelecao_Estagio();
    $master = $VO->getVetor();
    $master['CS_SITUACAO'][0] == 2 ? $acesso = 0 : FALSE;
//    $VO->ID_RECRUTAMENTO_ESTAGIO = $_REQUEST['ID_RECRUTAMENTO_ESTAGIO'];
    $page                        = $_REQUEST['PAGE'];

    $qtd = 15;
    !$page ? $page = 1 : false;
    $primeiro = ($page * $qtd) - $qtd;

    $total = $VO->pesquisar();

    $total_page = ceil($total / $qtd);

    $VO->Reg_inicio = $primeiro;
    $VO->Reg_quantidade = $qtd;
    $tot_da_pagina = $VO->pesquisar();
    
    echo '<table width="100%" id="tabelaItens" >
        <tr>
             <th>Candidato</th>
             <th>Quadro Vagas</th>
             <th>Tipo Vagas</th>
             <th>Situação</th>
             <th>Dt. Agendamento</th>
             <th>Dt. Realização</th>             
        ';

    //Somente ver a coluna de alterar se tiver acesso completo a tela	
    if ($acesso)
        echo '<th style="width:50px;"></th>';

    echo '</tr>';

    if ($tot_da_pagina) {
        $dados = $VO->getVetor();        
        
        for ($i = 0; $i < $tot_da_pagina; $i++) {

            ($bgcolor == '#F0F0F0') ? $bgcolor = '#DDDDDD' : $bgcolor = '#F0F0F0';

            echo '<tr bgcolor="' . $bgcolor . '" onmouseover="mudarCor(this);" onmouseout="mudarCor(this);"
                    title="<strong>Motivo:</strong> '.$dados['TX_MOTIVO_SITUACAO'][$i].' <br>
                 ">
                <td align="center" class="valor">' . $dados['TX_NOME'][$i] . '</td>
                <td align="center">' . $dados['TX_CODIGO'][$i] . '</td>
                <td align="center">' . $dados['TX_TIPO_VAGA_ESTAGIO'][$i] . '</td>
                <td align="center">' . $dados['TX_SITUACAO'][$i] . '</td>
                <td align="center" class="dtInicio">' . $dados['DT_AGENDAMENTO'][$i] . '</td>
                <td align="center" class="dtFim">' . $dados['DT_REALIZACAO'][$i] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela					
            if ($acesso){
                echo '<td align="center" class="icones">';
                echo '<a href="'.$dados['ID_RECRUTAMENTO_ESTAGIO'][$i].'_'.$dados['NB_VAGAS_RECRUTAMENTO'][$i].'_'.$dados['NB_CANDIDATO'][$i].'" id="alterarCandidato" ><img src="'.$urlimg.'icones/alterarItem.png" title="Alterar Registro"/></a>';                
		        echo '<a href="'.$dados['ID_RECRUTAMENTO_ESTAGIO'][$i].'_'.$dados['NB_VAGAS_RECRUTAMENTO'][$i].'_'.$dados['NB_CANDIDATO'][$i].'" id="excluirCandidato" ><img src="' . $urlimg . 'icones/excluirItem.png" title="Excluir Registro"/></a></td>';
		        }
            }
           
            echo '</tr>';
           

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
        echo '<tr><td colspan="7" class="nenhum">Nenhum registro encontrado.</td></tr></table><br /> ';

    if ($param)
        echo '<script>alert("' . $param . '")</script>';
}

$VO = new selecaoVO();

if ($_REQUEST['identifier'] == "tabela") {
    
    $VO->ID_SELECAO_ESTAGIO      = $_SESSION['ID_SELECAO_ESTAGIO'];
    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_REQUEST['ID_ORGAO_GESTOR_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO        = $_REQUEST['ID_ORGAO_ESTAGIO'];
    $VO->ID_RECRUTAMENTO_ESTAGIO = $_REQUEST['ID_RECRUTAMENTO_ESTAGIO'];
    $VO->CS_SITUACAO             = $_REQUEST['CS_SITUACAO'];
    $VO->TX_COD_SELECAO          = $_REQUEST['TX_COD_SELECAO'];   
    $page                        = $_REQUEST['PAGE'];

    $VO->preencherSessionPesquisar($_REQUEST);

    $qtd = 15;
    !$page ? $page = 1 : false;
    $primeiro = ($page * $qtd) - $qtd;


    $total = $VO->pesquisarSelecao_Estagio();

    $total_page = ceil($total / $qtd);

    $VO->Reg_inicio = $primeiro;
    $VO->Reg_quantidade = $qtd;
    $tot_da_pagina = $VO->pesquisarSelecao_Estagio();

    if ($tot_da_pagina) {

        $dados = $VO->getVetor();

        echo '<table width="100%" class="dataGrid">
                <th>Código da Seleção</th>
                <th>Órgão Gestor</th>
                <th>Órgão Solicitante</th>
                <th>Quadro de Vagas</th>
                <th>Situação</th>
                <th style="width:145px;">Data da Seleção</th>					
             ';
        //Somente ver a coluna de alterar se tiver acesso completo a tela					
        //if ($acesso)
            echo '<th style="width:30px;"></th>';
        echo '</tr>';

        for ($i = 0; $i < $tot_da_pagina; $i++) {
            ($bgcolor == '#E6E6E6') ? $bgcolor = '#F0EFEF' : $bgcolor = '#E6E6E6';

            echo '<tr bgcolor="' . $bgcolor . '">
                <td align="center">' . $dados['TX_COD_SELECAO'][$i] . '</td>
                <td align="center">' . $dados['TX_ORGAO_GESTOR_ESTAGIO'][$i] . '</td>
                <td align="center">' . $dados['TX_ORGAO_ESTAGIO'][$i] . '</td>
                <td align="center">' . $dados['TX_CODIGO'][$i] . '</td>
                <td align="center">' . $dados['TX_SITUACAO'][$i] . '</td>
                <td align="center">' . $dados['DT_AGENDAMENTO'][$i] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela					
           // if ($acesso)
                echo '<td align="center"> 
		  <a href="' . $dados['ID_SELECAO_ESTAGIO'][$i] . '" id="alterar"><img src="' . $urlimg . 'icones/editar.png" alt="itens" title="Visualizar"/></a></td>';

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
}else if ($_REQUEST['identifier'] == 'form_Candidatos'){
    
    $VO->ID_SELECAO_ESTAGIO      = $_SESSION['ID_SELECAO_ESTAGIO'];
    $aux = explode("_",$_REQUEST['ESTAGIARIO_SELECAO']);
    
    $VO->ID_RECRUTAMENTO_ESTAGIO = $aux[0];
    $VO->NB_VAGAS_RECRUTAMENTO = $aux[1];
    $VO->NB_CANDIDATO = $aux[2];

    $VO->buscar();
    $dados = $VO->getVetor();

    $arraySituacaoCandidato = array('' => "Escolha...",1 => "EM ANÁLISE",2 => "APROVADO",3 => "REPROVADO",4 => "CANCELADO");  

    foreach($arraySituacaoCandidato as $key=>$val){
        ($dados['CS_SITUACAO'][0] == $key) ? $selected = 'selected' : $selected = '';
        $arraySituacaoCandidato .= '<option value="'.$key.'" '.$selected.'>'.$val.'</option> ';
    }
        
    echo '
        <script>
            $(document).ready(function(){

                $("#DT_AGENDAMENTO_ALT").setMask({ mask:"99/99/9999" });
            
                $("#DT_AGENDAMENTO_ALT").datepicker({
                    changeMonth: true,
                    changeYear: true
                });
                
                $("#DT_REALIZACAO_ALT").setMask({ mask:"99/99/9999" });
            
                $("#DT_REALIZACAO_ALT").datepicker({
                    changeMonth: true,
                    changeYear: true
                });

   $("#CS_SITUACAO_ALT").live("change", function(){
        
       if ((($("#CS_SITUACAO_ALT").val() == 3) || ($("#CS_SITUACAO_ALT").val() == 4))){
    
            $("div[name=motivo_alt]").show("slow");
            $("#TX_MOTIVO_SITUACAO_ALT").show("slow");
       }else{
            $("div[name=motivo_alt]").hide("slow");
            $("#TX_MOTIVO_SITUACAO_ALT").hide("slow");                  
       }
        
    });


                })
                
        </script>

    <div id="conteudo"> 
    <br />Realize as alterações e clique em salvar<br /><br />
                    
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:135px;" ><font color="#FF0000">*</font>Data de Agendamento <br />
              <input type="text" name="DT_AGENDAMENTO_ALT" id="DT_AGENDAMENTO_ALT" value="'.$dados['DT_AGENDAMENTO'][0].'"  style="width:130px;" /></div> 

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:135px;" ><font color="#FF0000">*</font>Data de Realização <br />
              <input type="text" name="DT_REALIZACAO_ALT" id="DT_REALIZACAO_ALT" value="'.$dados['DT_REALIZACAO'][0].'"  style="width:130px;" /></div> 

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><font color="#FF0000">*</font>Situação
                <select name="CS_SITUACAO_ALT" id="CS_SITUACAO_ALT" style="width:150px;">
                 '.$arraySituacaoCandidato.'
            </select></div>
            <br />
            
            <div id="camada" name="motivo_alt" style="font-family:Verdana, Geneva, sans-serif; width:670px;';
            
            if ($dados["CS_SITUACAO"][0] == 2 || $dados["CS_SITUACAO"][0] == 1)
                echo 'display: none;';
        echo '" ><font color="#FF0000">*</font>Motivo <br />
              <input type="text" name="TX_MOTIVO_SITUACAO_ALT" id="TX_MOTIVO_SITUACAO_ALT" value="'.$dados['TX_MOTIVO_SITUACAO'][0].'"  style="width:665px;" />
            </div> 

            <input type="hidden" name="ESTAGIARIO_SELECAO_ALT" id="ESTAGIARIO_SELECAO_ALT" value="'.$dados['ESTAGIARIO_SELECAO'][0].'"  style="width:665px;" />

    </div>';

}else if ($_REQUEST['identifier'] == "tabelaCandidato") {
    gerarTabela();
}else if ($_REQUEST['identifier'] == "inserirCandidato") {


    $VO->ID_SELECAO_ESTAGIO = $_SESSION['ID_SELECAO_ESTAGIO'];
    $aux = explode("_",$_REQUEST['ESTAGIARIO_SELECAO']);
    
    $VO->ID_RECRUTAMENTO_ESTAGIO = $aux[0];
    $VO->NB_VAGAS_RECRUTAMENTO = $aux[1];
    $VO->NB_CANDIDATO = $aux[2];
 
    $VO->DT_REALIZACAO = $_REQUEST['DT_REALIZACAO'];
    $VO->DT_AGENDAMENTO = $_REQUEST['DT_AGENDAMENTO'];
    
    $VO->CS_SITUACAO = $_REQUEST['CS_SITUACAO'];
    $VO->TX_MOTIVO_SITUACAO = $_REQUEST['TX_MOTIVO_SITUACAO'];

    if ($acesso) {
        if (($VO->ID_RECRUTAMENTO_ESTAGIO) && ($VO->DT_REALIZACAO) && ($VO->DT_AGENDAMENTO)) {
            $retorno = $VO->inserirCandidato();

            if ($retorno) {
                $erro = 'Registro já existe.';
            }
        }else
            $erro = 'Para inserir preencha os campos obrigatórios.';
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);
}else if ($_REQUEST['identifier'] == 'atualizarInf') {

    $VO->ID_SELECAO_ESTAGIO = $_SESSION['ID_SELECAO_ESTAGIO'];
    $VO->EFETIVAR = $_REQUEST['EFETIVAR'];
    
    $dados = $VO->atualizarInf();

    echo json_encode($dados);
    
} else if ($_REQUEST['identifier'] == 'excluirCandidato') {

    $VO->ID_SELECAO_ESTAGIO = $_SESSION['ID_SELECAO_ESTAGIO'];
    $aux = explode("_",$_REQUEST['ESTAGIARIO_SELECAO']);
    
    $VO->ID_RECRUTAMENTO_ESTAGIO = $aux[0];
    $VO->NB_VAGAS_RECRUTAMENTO = $aux[1];
    $VO->NB_CANDIDATO = $aux[2];

    if ($acesso) {

        $retorno = $VO->excluirCandidato();

        if (is_array($retorno))
            $erro = 'Este registro não pode ser excluído pois possui dependentes.';
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);
}//Buscar ComboBox de Codigo de Recrutamento 
else if ($_REQUEST['identifier'] == "buscarRecrutamento") {

    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];

    $total = $VO->buscarRecrutamento();
    
    if ($total) {
        $dados = $VO->getVetor();
        echo '<option value="">Escolha...</option>';
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_COD_RECRUTAMENTO'][$i] . '</option>';
        }
    }
}//Buscar ComboBox de Candidato 
else if ($_REQUEST['identifier'] == "pesquisarCandidatos") {

    $VO->ID_RECRUTAMENTO_ESTAGIO = $_REQUEST['ID_RECRUTAMENTO_ESTAGIO'];

    $total = $VO->pesquisarCandidatos();
    
    if ($total) {
        $dados = $VO->getVetor();
        echo '<option value="">Escolha...</option>';
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_NOME'][$i] . '</option>';
        }
    }
}else if ($_REQUEST['identifier'] == 'alterarCandidato'){
    
    $VO->ID_SELECAO_ESTAGIO      = $_SESSION['ID_SELECAO_ESTAGIO'];

    $aux = explode("_",$_REQUEST['ESTAGIARIO_SELECAO']);
    
    $VO->ID_RECRUTAMENTO_ESTAGIO = $aux[0];
    $VO->NB_VAGAS_RECRUTAMENTO = $aux[1];
    $VO->NB_CANDIDATO = $aux[2];
    $VO->DT_REALIZACAO = $_REQUEST['DT_REALIZACAO'];
    $VO->DT_AGENDAMENTO = $_REQUEST['DT_AGENDAMENTO'];
    
    $VO->CS_SITUACAO = $_REQUEST['CS_SITUACAO'];
    $VO->TX_MOTIVO_SITUACAO = $_REQUEST['TX_MOTIVO_SITUACAO'];        

    
    if ($VO->ID_SELECAO_ESTAGIO && $VO->ID_RECRUTAMENTO_ESTAGIO && $VO->NB_VAGAS_RECRUTAMENTO && $VO->NB_CANDIDATO){

        $retorno = $VO->alterarCandidato();

        if (is_array($retorno)){    
            $posicao = stripos($retorno['message'], ":");
            $string1 = substr($retorno['message'], $posicao+1);
            $posicao2 = stripos($string1, "ORA");
            $erro = substr($retorno['message'], $posicao+1, $posicao2-1);
        }

    }else
        $erro = "Todos os campos devem ser preenchidos.";
                
     gerarTabela($erro);
        
}



?>