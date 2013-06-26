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
        echo '<th style="width:80px;"></th>';

    echo '</tr>';

    if ($tot_da_pagina) {
        $dados = $VO->getVetor();

        for ($i = 0; $i < $tot_da_pagina; $i++) {

            ($bgcolor == '#F0F0F0') ? $bgcolor = '#DDDDDD' : $bgcolor = '#F0F0F0';

          echo '<tr bgcolor="'.$bgcolor.'" onmouseover="mudarCor(this);" onmouseout="mudarCor(this)" align="center" id="addCand" rel="'.$dados['NB_VAGAS_RECRUTAMENTO'][$i].'">
                <td align="center">' . $dados['TX_ORGAO_GESTOR'][$i] . '</td>
                <td align="center">' . $dados['TX_ORGAO_SOLICITANTE'][$i] . '</td>
                <td align="center">' . $dados['TX_QUADRO_VAGAS'][$i] . '</td>
                <td align="center">' . $dados['TX_TIPO_VAGA_ESTAGIO'][$i] . '</td>
                <td align="center" class="qtd">' . $dados['NB_QUANTIDADE'][$i] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela					
            if ($acesso)
        echo '<td align="center" class="icones">
		<a href="' . $dados['NB_VAGAS_RECRUTAMENTO'][$i] . '" id="candidato" ><img src="' . $urlimg . 'icones/editar.png" title="Adicionar Candidatos"/></a>
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

function gerarTabelaCand($param=''){
	include "../../php/define.php";
	require_once $pathvo."recrutamentoVO.php";

	$VO = new recrutamentoVO();
	$VO->ID_RECRUTAMENTO_ESTAGIO    = $_SESSION['ID_RECRUTAMENTO_ESTAGIO'];
	$VO->NB_VAGAS_RECRUTAMENTO      = $_REQUEST['CODIGO'];

	//$total = $VO->buscarTombamento();
	$VO->pesquisarEstagiario();
	$dadoscpf = $VO->getArray("NB_CPF");
	foreach ($dadoscpf as $key => $value) {
		$arrayCPF .= '<option value="'.$key.'">'.$value.'</option> ';
	}
	echo '
	
	
	<script>
	
	
$.widget( "ui.combobox", {
            _create: function() {
                var input,
                    that = this,
                    select = this.element.hide(),
                    selected = select.children( ":selected" ),
                    value = selected.val() ? selected.text() : "",
                    wrapper = this.wrapper = $( "<span>" )
                        .addClass( "ui-combobox" )
                        .insertAfter( select );
 
                function removeIfInvalid(element) {
                    var value = $( element ).val(),
                        matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( value ) + "$", "i" ),
                        valid = false;
                    select.children( "option" ).each(function() {
                        if ( $( this ).text().match( matcher ) ) {
                            this.selected = valid = true;
                            return false;
                        }
                    });
                    if ( !valid ) {
                        $( element )
                            .val( "" )
                            .attr( "title", value + " não encontrado" )
                            .tooltip( "open" );
                        select.val( "" );
                        setTimeout(function() {
                            input.tooltip( "close" ).attr( "title", "" );
                        }, 2500 );
                        input.data( "autocomplete" ).term = "";
                        return false;
                    }
                }
 
                input = $( "<input>" )
                    .appendTo( wrapper )
                    .val( value )
                    .attr( "title", "" )
                    .addClass( "" )
                    .autocomplete({
                        delay: 0,
                        minLength: 3,
                        source: function( request, response ) {
                            var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
                            response( select.children( "option" ).map(function() {
                                var text = $( this ).text();
                                if ( this.value && ( !request.term || matcher.test(text) ) )
                                    return {
                                        label: text.replace(
                                            new RegExp(
                                                "(?![^&;]+;)(?!<[^<>]*)(" +
                                                $.ui.autocomplete.escapeRegex(request.term) +
                                                ")(?![^<>]*>)(?![^&;]+;)", "gi"
                                            ), "<strong>$1</strong>" ),
                                        value: text,
                                        option: this
                                    };
                            }) );
                        },
                        select: function( event, ui ) {
                            ui.item.option.selected = true;
                            that._trigger( "selected", event, {
                                item: ui.item.option
								
                            });
							
							
                          	if ( ui.item ){
								$("#TX_NOME").val("");
								$.getJSON("acoes.php?identifier=mostrarNome&NB_CPF="+ui.item.option.value, function preencherNome(dados){
									

									$("#TX_NOME").val(dados["TX_NOME"][0]);
	
								});
							}							
							
							
                        },
                        change: function( event, ui ) {
                            if ( !ui.item )
                                return removeIfInvalid( this );
							
						}
                    	})
                    	.addClass( "ui-widget ui-widget-content" );
 
                input.data( "autocomplete" )._renderItem = function( ul, item ) {
                    return $( "<li>" )
                        .data( "item.autocomplete", item )
                        .append( "<a>" + item.label + "</a>" )
                        .appendTo( ul );
                };
 
                $( "<a>" )
                    .attr( "tabIndex", -1 )
                    .attr( "title", "Mostrar Todos Itens" )
                    .tooltip()
                    .appendTo( wrapper )
                    .button({
                        icons: {
                            primary: "ui-icon-triangle-1-s"
                        },
                        text: false
                    })
                    
                    
                    .click(function() {
                        // close if already visible
						input.autocomplete({ minLength: 0 });
                        if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
                            input.autocomplete( "close" );
                            removeIfInvalid( input );
                            return;
                        }
 
                        // work around a bug (likely same cause as #5265)
                        $( this ).blur();
 
                        // pass empty string as value to search for, displaying all results
                        input.autocomplete( "search", "" );
                        input.focus();
                    });
 
                    input
                        .tooltip({
                            position: {
                                of: this.button
                            },
                            tooltipClass: "ui-state-highlight"
                        });
            },
 
            destroy: function() {
                this.wrapper.remove();
                this.element.show();
                $.Widget.prototype.destroy.call( this );
            }
    });	
	
	
 	$("#NB_CPF").combobox();	
	</script>
	<fieldset>
        <legend>Cadastrar Candidatos do Recrutamento</legend>

            <input type="hidden" name="NB_VAGAS_RECRUTAMENTO" id="NB_VAGAS_RECRUTAMENTO" value="'.$VO->NB_VAGAS_RECRUTAMENTO.'"/>
            <div id="camada" style="width:180px;"><strong>CPF </strong>
			
            <select name="NB_CPF" id="NB_CPF" style="width:150px;" >'.$arrayCPF.'</select></div>

            <div id="camada" style="width:230px;"><strong>Nome do Candidato </strong>
                <input type="text" name="TX_NOME" id="TX_NOME" style="width:220px;" /></div>

            <input type="button" name="inserirCand" id="inserir" value="Inserir" />
		</fieldset>';
		
		
	$total = $VO->buscarCandidato();
	
	echo '<table id="tabelaItens" width="100%">
				<tr>
					<th>CPF</th>
					<th>Nome</th>
					<th>Situação</th>
					<th>Motivo</th>
					<th style="width:25px;"></th>
				</tr>';
	if ($total){
		$dados = $VO->getVetor();
		
		for ($i=0; $i<$total; $i++){
			
			($bgcolor == '#F0F0F0') ? $bgcolor = '#DDDDDD' : $bgcolor = '#F0F0F0';
			
			echo '<tr bgcolor="'.$bgcolor.'" onmouseover="mudarCor(this);" onmouseout="mudarCor(this)" align="center" >
					<td align="left">'.$dados['NB_CPF'][$i].'</td>
					<td align="left">'.$dados['TX_NOME'][$i].' </td>
					<td align="left">'.$dados['TX_SITUACAO'][$i].'</td>
					<td align="center">'.$dados['TX_MOTIVO_SITUACAO'][$i].'</td>
					<td align="center" class="icones">
					<a href="'.$dados['NB_VAGAS_RECRUTAMENTO'][$i].'_'.$dados['NB_CANDIDATO'][$i].'" id="excluirCand"><img src="'.$urlimg.'icones/excluirItem.png" title="Excluir Registro"/></a></td>
                  </tr>';
		}
	}else
		echo '<tr><td colspan="5">Nenhum registro encontrado.</td></tr>';
	
	echo '</table>';
	

	if ($param){
		echo '<script>alert("'.$param.'");</script>';
	}	
}



$VO = new recrutamentoVO();

if ($_REQUEST['identifier'] == "tabela") {
    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_REQUEST['ID_ORGAO_GESTOR_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO        = $_REQUEST['ID_ORGAO_ESTAGIO'];
    $VO->CS_SITUACAO 			 = $_REQUEST['CS_SITUACAO'];
    $VO->TX_COD_RECRUTAMENTO 	 = $_REQUEST['TX_COD_RECRUTAMENTO'];

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
}else if ($_REQUEST['identifier'] == "buscarSolicitante") {

    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_REQUEST['ID_ORGAO_GESTOR_ESTAGIO'];
    $total = $VO->buscarSolicitante();

	echo '<option value="">Escolha...</option>';
    if ($total) {
        $dados = $VO->getVetor();
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_ORGAO_ESTAGIO'][$i] . '</option>';
        }
    }
}else if ($_REQUEST['identifier'] == "buscarSolicitacao") {

    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];
    $total = $VO->buscarSolicitacao();

	echo '<option value="">Escolha...</option>';
    if ($total) {
        $dados = $VO->getVetor();
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_COD_SOLICITACAO'][$i] . '</option>';
        }
    }
}else if ($_REQUEST['identifier'] == "buscarQuadroVagas") {

    $VO->ID_SOLICITACAO_ESTAGIO = $_REQUEST['ID_SOLICITACAO_ESTAGIO'];
    $total = $VO->buscarQuadroVagas();

	echo '<option value="">Escolha...</option>';
    if ($total) {
        $dados = $VO->getVetor();
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_CODIGO'][$i] . '</option>';
        }
    }
}else if ($_REQUEST['identifier'] == "buscarCodigo") {

    $VO->ID_RECRUTAMENTO_ESTAGIO = $_REQUEST['ID_RECRUTAMENTO_ESTAGIO'];

    $VO->pesquisarCodigo();
    $dados = $VO->getVetor();



    echo $dados['TX_FUNCIONARIO'][0];
} else if ($_REQUEST['identifier'] == "tabelaVagas") {
    gerarTabela();
}else if ($_REQUEST['identifier'] == 'tabelaCand'){
	gerarTabelaCand();	
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
} else if ($_REQUEST['identifier'] == "inserirCand") {

    $VO->ID_RECRUTAMENTO_ESTAGIO = $_SESSION['ID_RECRUTAMENTO_ESTAGIO'];
    $VO->NB_CPF                  = $_REQUEST['NB_CPF'];
    $VO->NB_VAGAS_RECRUTAMENTO   = $_REQUEST['NB_VAGAS_RECRUTAMENTO'];
    if ($acesso) {
        if ( ($VO->ID_RECRUTAMENTO_ESTAGIO) || ($VO->NB_VAGAS_RECRUTAMENTO) ){
            $retorno = $VO->inserirCandidato();
            if ($retorno) {
                $erro = 'Registro já existe.';
            }
        }else
            $erro = 'Para inserir escolha um Candidato.';
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabelaCand($erro);

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
	
} else if ($_REQUEST['identifier'] == 'excluirCand') {

    $VO->ID_RECRUTAMENTO_ESTAGIO = $_SESSION['ID_RECRUTAMENTO_ESTAGIO'];
//    $cod   = explode('_',$_REQUEST['CODIGO']);
    $VO->NB_VAGAS_RECRUTAMENTO   =  $_REQUEST['CODIGO'];
    $VO->NB_CANDIDATO            =  $_REQUEST['CODIGO2'];

    if ($acesso) {

        $retorno = $VO->excluirCandidato();

        if (is_array($retorno))
            $erro = 'Este registro não pode ser excluído pois possui dependentes.';
    }else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabelaCand($erro);
	
	
}else if ($_REQUEST['identifier'] == "mostrarNome"){
	
	$VO->NB_CPF 	= $_REQUEST['NB_CPF'];
	
	$total = $VO->pesquisarEstagiario();
	
    $dados = $VO->getVetor();
		
	echo json_encode($dados);	

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