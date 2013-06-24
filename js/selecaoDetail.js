$(document).ready(function(){
    
    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }
    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };
	
	function emptyHideLoader(){
        $('.fundo_pag').fadeOut(200);
		$("#ESTAGIARIO_SELECAO option:first").attr('selected','selected');
		$("#CS_SITUACAO option:first").attr('selected','selected');
        $("#DT_AGENDAMENTO").val('');
        $("#DT_REALIZACAO").val('');
        $("#TX_MOTIVO_SITUACAO").val('');
		$("#msg").html('');
		$.getJSON('acoes.php?identifier=atualizarInf', atualizarInf);
			
			function atualizarInf(campo){
					$("#atualizacao").html(campo['DT_ATUALIZACAO'][0]);
					$("#funcionario").html(campo['TX_FUNCIONARIO_ALT'][0]);
					$("#situacao").html(campo['TX_SITUACAO'][0]);
			}     
	    
	    $.post("acoes.php",
			{identifier:'gerarCandidatos'},
			function(valor){
					$("#ESTAGIARIO_SELECAO").html(valor);
			}
		);	
		
    };

	function showLoaderForm(){
        $('.fundoForm').fadeIn(200);
    };
	
	function hideLoaderForm(){
        $('.fundoForm').fadeOut(200);
    };

	$( "#dialog-form" ).dialog({
		  autoOpen: false,
            height: 295,
            width: 920,
            modal: true,
			buttons:{
				"Salvar": function() {
					
					if ($("#DT_AGENDAMENTO_ALT").val() && $("#DT_REALIZACAO_ALT").val() && $("#CS_SITUACAO_ALT").val()){
						showLoader();
						$('#tabelaCandidato').load('acoes.php?identifier=alterarCandidato',
							{DT_AGENDAMENTO:$("#DT_AGENDAMENTO_ALT").val(),
							 DT_REALIZACAO:$("#DT_REALIZACAO_ALT").val(),
							 CS_SITUACAO:$("#CS_SITUACAO_ALT").val(),
							 TX_MOTIVO_SITUACAO:$("#TX_MOTIVO_SITUACAO_ALT").val(),
							 ESTAGIARIO_SELECAO:$("#ESTAGIARIO_SELECAO_ALT").val()
                        	}, emptyHideLoader);
						$( this ).dialog( "close" );
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
	
	$('#DT_AGENDAMENTO').setMask({ mask:'99/99/9999' });

	$('#DT_AGENDAMENTO').datepicker({
		changeMonth: true,
        changeYear: true
	});
	
	$('#DT_REALIZACAO').setMask({ mask:'99/99/9999' });

	$('#DT_REALIZACAO').datepicker({
		changeMonth: true,
        changeYear: true
	});
	
	$("#paginacao li").live('click', function(){
        showLoader();
        $("#tabelaCandidato").load('acoes.php?identifier=tabelaCandidato&PAGE='+this.id, hideLoader);
        return false;
    });

    $('#CS_SITUACAO').live('change', function(){
    	
	   if ((($('#CS_SITUACAO').val() == 3) || ($('#CS_SITUACAO').val() == 4))){
	
			$('div[name=motivo]').show("slow");
			$("#TX_MOTIVO_SITUACAO").show("slow");
	   }else{
			$("div[name=motivo]").hide("slow");
			$("#TX_MOTIVO_SITUACAO").hide("slow");					
	   }
	   	
    });    

    // Inserção de Acesso
    $('#ESTAGIARIO_SELECAO').live('click', function(){
		$("#pesquisarCandidatos").load('acoes.php?identifier=pesquisarCandidatos&ID_ORGAO_ESTAGIO='+$('#ID_ORGAO_ESTAGIO').val()+'&PAGE='+$('.selecionado').text(), emptyHideLoader);      
    });

    // Inserção de Acesso
    $('#inserir').live('click', function(){
        if (!$('#ESTAGIARIO_SELECAO').val()){
            alert('Para inserir escolha um Candidato.');
            $('#ESTAGIARIO_SELECAO').focus();
        }else{
        	if (!$('#DT_AGENDAMENTO').val()){
            	alert('Paralterara inserir escolha uma Data de Agendamento.');
            	$('#DT_AGENDAMENTO').focus();
        	}else{
        		if (!$('#DT_REALIZACAO').val()){
            		alert('Para inserir escolha uma Data de Realização.');
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
            					alert('Para inserir escolha uma Motivo.');
            					$('#TX_MOTIVO_SITUACAO').focus();
            				}else{
            					showLoader();
            					$("#tabelaCandidato").load('acoes.php?identifier=inserirCandidato&ESTAGIARIO_SELECAO='+$('#ESTAGIARIO_SELECAO').val()+'&DT_REALIZACAO='+$('#DT_REALIZACAO').val()+'&DT_AGENDAMENTO='
            					+$('#DT_AGENDAMENTO').val()+'&CS_SITUACAO='+$('#CS_SITUACAO').val()+'&TX_MOTIVO_SITUACAO='+$('#TX_MOTIVO_SITUACAO').val()+'&PAGE='+$('.selecionado').text(), emptyHideLoader);
							}
						}
					}
				}
			}
		}
	    return false;
    });

    //Exclusão de Acesso
    $('#excluirCandidato').live('click', function(){
        var href = $(this).attr('href');

        resp = window.confirm('Tem certeza que deseja excluir este Registro?');
        if (resp){
            showLoader();
            $("#tabelaCandidato").load('acoes.php?identifier=excluirCandidato&ESTAGIARIO_SELECAO='+href+'&PAGE='+$('.selecionado').text(), emptyHideLoader);
        }
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
	
	$( "#alterarCandidato" ).live('click', function() {
        var href = $(this).attr('href');
        $( "#dialog-form" ).dialog( "open" );
		$('#form_candidatos').html('');
		showLoaderForm();
		$('#form_candidatos').load('acoes.php?identifier=form_Candidatos&ESTAGIARIO_SELECAO='+href, emptyHideLoader);
		return false;
    });

    $( document ).tooltip();	
	
	showLoader();
    $("#tabelaCandidato").load('acoes.php?identifier=tabelaCandidato', hideLoader);
});