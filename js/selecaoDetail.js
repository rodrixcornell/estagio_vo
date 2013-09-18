$(document).ready(function(){
    
    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }
    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };
	
	function emptyHideLoader(){
        $('.fundo_pag').fadeOut(200);
		$("#ESTAGIARIO_SELECAO").html('<option>Carregando...</option>');
		$.post("acoes.php",
			{identifier:'gerarCandidatos'},
			function(valor){
				$("#ESTAGIARIO_SELECAO").html(valor);
			}
		);
		
		$("#ESTAGIARIO_SELECAO option:first").attr('selected','selected');
		$("#CS_SITUACAO option:first").attr('selected','selected');
        $("#DT_AGENDAMENTO,#DT_REALIZACAO,#TX_MOTIVO_SITUACAO").val('');
		$("#motivo").hide();
		$("#TX_MOTIVO_SITUACAO").val('');
 
		$.getJSON('acoes.php?identifier=atualizarInf', atualizarInf);
			
			function atualizarInf(campo){
					$("#atualizacao").html(campo['DT_ATUALIZACAO'][0]);
					$("#funcionario").html(campo['TX_FUNCIONARIO_ALT'][0]);
			}     
    };
	
	$('#DT_AGENDAMENTO, #DT_REALIZACAO').setMask({ mask:'99/99/9999' });

	$('#DT_AGENDAMENTO, #DT_REALIZACAO').datepicker({
		changeMonth: true,
        changeYear: true
	});
	
	
	$('#CS_SITUACAO').live('change', function(){
	   if ((($('#CS_SITUACAO').val() == 3) || ($('#CS_SITUACAO').val() == 4))){
			$('#motivo').show("slow");
	   }else{
			$("#motivo").hide("slow");
			$("#TX_MOTIVO_SITUACAO").val('');					
	   }
	   	
    }); 
	  
	
	$('#inserir').live('click', function(){
        if (!$('#ESTAGIARIO_SELECAO').val()){
            alert('Para inserir escolha um Candidato.');
            $('#ESTAGIARIO_SELECAO').focus();
        }else{
        	if (!$('#DT_AGENDAMENTO').val()){
            	alert('Para inserir preencha uma Data de Agendamento.');
            	$('#DT_AGENDAMENTO').focus();
        	}else{
        		if (!$('#DT_REALIZACAO').val()){
            		alert('Para inserir preencha uma Data de Realização.');
            		$('#DT_REALIZACAO').focus();
        		}else{
        			if ($('#DT_AGENDAMENTO').val() > $('#DT_REALIZACAO').val()){
            			alert('Para inserir, a Data de Agendamento não pode ser maior que a Data de Realização.');
            			$('#DT_AGENDAMENTO').focus();
        			}else{
        				if (!$('#CS_SITUACAO').val()){
            				alert('Para inserir escolha uma Situação.');
            				$('#CS_SITUACAO').focus();
            			}else{
        					if ((($('#CS_SITUACAO').val() == 3) || ($('#CS_SITUACAO').val() == 4)) && (!$('#TX_MOTIVO_SITUACAO').val())){
            					alert('Para inserir preencha um Motivo.');
            					$('#TX_MOTIVO_SITUACAO').focus();
            				}else{
            					showLoader();
            					$("#tabelaCandidato").load('acoes.php?identifier=inserirCandidato', {
										ESTAGIARIO_SELECAO: $('#ESTAGIARIO_SELECAO').val(),
										DT_REALIZACAO: $('#DT_REALIZACAO').val(),
										DT_AGENDAMENTO: $('#DT_AGENDAMENTO').val(),
										CS_SITUACAO: $('#CS_SITUACAO').val(),
										TX_MOTIVO_SITUACAO: $('#TX_MOTIVO_SITUACAO').val(),
										PAGE: $('.selecionado').text()
									}, emptyHideLoader);
							}
						}
					}
				}
			}
		}
	    return false;
    });
	
	
    $('#excluirCandidato').live('click', function(){
        var href = $(this).attr('href');

        resp = window.confirm('Tem certeza que deseja excluir este Registro?');
        if (resp){
            showLoader();
            $("#tabelaCandidato").load('acoes.php?identifier=excluirCandidato&ESTAGIARIO_SELECAO='+href+'&PAGE='+$('.selecionado').text(), emptyHideLoader);
        }
        return false;
    });
	
	
	function showLoaderForm(){
        $('.fundoForm').fadeIn(200);
    };
	
	function hideLoaderForm(){
        $('.fundoForm').fadeOut(200);
    };

	$( "#dialog-form" ).dialog({
		  autoOpen: false,
            height: 320,
            width: 540,
            modal: true,
			buttons:{
				"Salvar": function() {
					
					if ($("#DT_AGENDAMENTO_ALT").val() && $("#DT_REALIZACAO_ALT").val() && $("#CS_SITUACAO_ALT").val()){
						if ((($('#CS_SITUACAO_ALT').val() == 3) || ($('#CS_SITUACAO_ALT').val() == 4)) && (!$('#TX_MOTIVO_SITUACAO_ALT').val())){
            					alert('Para inserir preencha um Motivo.');
            					$('#TX_MOTIVO_SITUACAO_ALT').focus();
						}else{
							showLoader();
							$('#tabelaCandidato').load('acoes.php?identifier=alterarCandidato',
								{DT_AGENDAMENTO:$("#DT_AGENDAMENTO_ALT").val(),
								 DT_REALIZACAO:$("#DT_REALIZACAO_ALT").val(),
								 CS_SITUACAO:$("#CS_SITUACAO_ALT").val(),
								 TX_MOTIVO_SITUACAO:$("#TX_MOTIVO_SITUACAO_ALT").val(),
								 ESTAGIARIO_SELECAO:$("#ESTAGIARIO_SELECAO_ALT").val()
								}, emptyHideLoader);
							$( this ).dialog( "close" );
						}
					}else{
						alert('Todos os campos devem ser preenchidos.');
					}
						
				},
				"Cancelar": function() {
					$('#form_Candidato').html('');
                    $( this ).dialog( "close" );
                },
			}
	});
	
	$( "#alterarCandidato" ).live('click', function() {
        var href = $(this).attr('href');
        $( "#dialog-form" ).dialog( "open" );
		$('#form_candidatos').html('');
		showLoaderForm();
		$('#form_candidatos').load('acoes.php?identifier=form_Candidatos&ESTAGIARIO_SELECAO='+href, hideLoaderForm);
		return false;
    });
	
	
	$("#paginacao li").live('click', function(){
        showLoader();
        $("#tabelaCandidato").load('acoes.php?identifier=tabelaCandidato&PAGE='+this.id, hideLoader);
        return false;
    });
	
	
	//Excluir Master
	$('#excluirMaster').click(function(){

		if ($('.icones').length){
			alert('Este registro não pode ser excluído pois possui dependentes.');
			return false;
		}else{
			resp = window.confirm('Tem certeza que deseja excluir este Registro?');
			if (!resp){
				return false;	
			}
		}
	
	});
	
	
	$( "input[name=efetivar]" ).live('click', function() {
		if ($('.icones').length){
			resp = window.confirm('Tem certeza que deseja Efetivar esta Seleção?');
			if (resp){
				showLoader();
				return true;
			}
			return false;
		}else{
			alert('Para Efetivar uma Seleção adicione pelo menos um candidato.');
			return false;	
		}			  
        
    });

	
	
	showLoader();
    $("#tabelaCandidato").load('acoes.php?identifier=tabelaCandidato', hideLoader);
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	
	
	
	
	
	
	

     

    // Inserção de Acesso
   /* $('#ESTAGIARIO_SELECAO').live('click', function(){
		$("#pesquisarCandidatos").load('acoes.php?identifier=pesquisarCandidatos&ID_ORGAO_ESTAGIO='+$('#ID_ORGAO_ESTAGIO').val()+'&PAGE='+$('.selecionado').text(), emptyHideLoader);      
    });*/

    // Inserção de Acesso
    

    
	
	
	
	
	

//    $( document ).tooltip();	
	
	
});