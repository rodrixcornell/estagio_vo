$(document).ready(function(){
    
  	
	
    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }
    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };


	function showLoaderForm(){
        $('.fundoForm').fadeIn(200);
    };
	
	function hideLoaderForm(){
        $('.fundoForm').fadeOut(200);
    };
	
	function emptyHideLoader(){
        $('.fundo_pag').fadeOut(200);
		$("#CS_TIPO_VAGA_ESTAGIO option:first").attr('selected','selected');
        $('#NB_QUANTIDADE').val('');
	/*	$.getJSON('acoes.php?identifier=atualizarInf', atualizarInf);
			function atualizarInf(campo){
					$("#atualizacao").html(campo['DT_ATUALIZACAO'][0]);
					$("#funcionario").html(campo['ID_USUARIO_ATUALIZACAO'][0]);
			}     */
		
    };

	function emptyHideLoaderForm(){
        $('.fundo_pag').fadeOut(200);
        $('.fundoForm').fadeOut(200);
        $('#NB_CPF').val(''); 
		$('#TX_NOME').val('');
		
    };

	$("#paginacao li").live('click', function(){
        showLoader();
        $("#tabelaVagas").load('acoes.php?identifier=tabelaVagas&PAGE='+this.id, hideLoader);
        return false;
    });

    // Inserção de Acesso
    $('input[name=inserir]').live('click', function(){
        if (!$('#CS_TIPO_VAGA_ESTAGIO').val()){
            alert('Para inserir escolha um Tipo de Vaga de Estágio.');
            $('#CS_TIPO_VAGA_ESTAGIO').focus();
        }else
        if (!$('#NB_QUANTIDADE').val()){
            alert('Informe a quantidade de Vagas de Estágio.');
            $('#NB_QUANTIDADE').focus();
        }else{
            showLoader();
            $("#tabelaVagas").load('acoes.php?identifier=inserirVaga&CS_TIPO_VAGA_ESTAGIO='+$('#CS_TIPO_VAGA_ESTAGIO').val()+'&NB_QUANTIDADE='+$('#NB_QUANTIDADE').val()+'&PAGE='+$('.selecionado').text(), emptyHideLoader);
        }
        return false;
    });
	
	 // Inserção de Acesso
    $('input[name=inserirCand]').live('click', function(){
        if (!$('#NB_CPF').val()){
            alert('Para inserir escolha um CPF.');
            $('#NB_CPF').focus();
        }else{
            showLoaderForm();
            $("#tabelaCand").load('acoes.php?identifier=inserirCand&NB_CPF='+$('#NB_CPF').val()+'&NB_VAGAS_RECRUTAMENTO='+$('#NB_VAGAS_RECRUTAMENTO').val()+'&CODIGO='+$('#NB_VAGAS_RECRUTAMENTO').val()+'&PAGE='+$('.selecionado').text(), emptyHideLoaderForm);
        }
        return false;
    });
/*	
	$('#inserirTodos').live('click', function(){
		showLoader();
		$("#tabelaUnidadeConsumidora").load('acoes.php?identifier=inserirTodas', hideLoader);
        return false;
    });
*/
    //Exclusão de Acesso
    $('#excluir').live('click', function(){
        var href = $(this).attr('href');

        resp = window.confirm('Tem certeza que deseja excluir este Registro?');
        if (resp){
            showLoader();
            $("#tabelaVagas").load('acoes.php?identifier=excluirVaga&PAGE='+$('.selecionado').text()+'&NB_VAGAS_RECRUTAMENTO='+href, emptyHideLoader);
        }
        return false;
    });
	
    //Exclusão de Acesso
    $('#excluirCand').live('click', function(){
        var cod = $(this).attr('href').split('_');
		
		

        resp = window.confirm('Tem certeza que deseja excluir este Registro?');
        if (resp){
            showLoaderForm();
            $("#tabelaCand").load('acoes.php?identifier=excluirCand&PAGE='+$('.selecionado').text()+'&CODIGO='+cod[0]+'&CODIGO2='+cod[1], emptyHideLoaderForm);
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
	
	
	
//Alteracao de Itens
    $('#alterar').live('click', function(){

        if ($('#NB_QUANTIDADE_ALT').length){
            alert('Já existe um valor em modo de edição.\nConfirme a alteração do item anterior.');
            $('#NB_QUANTIDADE_ALT').focus();
                return false;
        }else{
            var linha = $(this).parent().parent();
            var qtd = $(this).parent().parent().find(".qtd");
            var icones = $(this).parent().parent().find(".icones");

            var href = $(this).attr('href');

            qtd.html('<input type="text" name="NB_QUANTIDADE_ALT" id="NB_QUANTIDADE_ALT" value="'+qtd.text()+'" style="width:75px; text-align:center;">');
            icones.html('<a href="'+href+'" id="salvar"><img src="'+urlimg+'icones/salvar.png" title="Salvar Alterações"/></a> <a href="#" id="cancelar"><img src="'+urlimg+'icones/cancelar.png" title="Cancelar"/></a>');
			
			$("#NB_QUANTIDADE_ALT").numeric({allow:","});
			
			linha.attr('bgcolor', '#FBCA8D');
			$('#NB_QUANTIDADE_ALT').focus();
            return false;
        }
    });
	
	$('#cancelar').live('click', function(){
		showLoader();
		$("#tabelaVagas").load('acoes.php?identifier=tabelaVagas&PAGE='+$('.selecionado').text(), hideLoader);
		return false;
	});
	
	
	$('#salvar').live('click', function(){
		//var href = $(this).attr('href');
        //var valor = href.split('_');
		
		var NB_QUANTIDADE_ALT = $(this).parent().parent().find("#NB_QUANTIDADE_ALT").val();
				
		showLoader();
		$("#tabelaVagas").load('acoes.php?identifier=alterarVaga&PAGE='+$('.selecionado').text(),
							{NB_VAGAS_RECRUTAMENTO: $(this).attr('href'),
							 NB_QUANTIDADE : NB_QUANTIDADE_ALT
                        	}, emptyHideLoader);
		
		return false;
		
	});	
	
	showLoader();
    $("#tabelaVagas").load('acoes.php?identifier=tabelaVagas', hideLoader);


	$( "#dialog-tabela" ).dialog({
		  autoOpen: false,
            height: 340,
            width: 882,
            modal: true
			/* buttons:{
				"Salvar": function() {
					
					if ($('#CS_SITUACAO').val() != 0){
						showLoader();
						$('#tabela').load('acoes.php?identifier=inserirCand',{ID_RECRUTAMENTO_ESTAGIO:$('#ID_RECRUTAMENTO_ESTAGIO').val(), NB_VAGAS_RECRUTAMENTO:$('#NB_VAGAS_RECRUTAMENTO').val(), NB_CANDIDATO:$('#NB_CANDIDATO').val(), CS_SITUACAO:$('#CS_SITUACAO').val(), TX_MOTIVO_SITUACAO:$('#TX_MOTIVO_SITUACAO').val() }, hideLoader);
						$( this ).dialog( "close" );
					}else{
						alert('Escolha o campo Situação.');
						$('#CS_SITUACAO').focus();	
					}
						
				},
				"Cancelar": function() {
					$('#form_tramite').html('');
                    $( this ).dialog( "close" );
                },
			} */
	});
	




$('#candidato').live('click', function(){
		 $( "#dialog-tabela" ).dialog( "open" );
		 $('#tabelaCand').html('');
		 showLoaderForm();
		 $('#tabelaCand').load('acoes.php?identifier=tabelaCand&CODIGO='+$(this).attr('href'), hideLoaderForm);
		 return false;
    });



});
