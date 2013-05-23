$(document).ready(function(){
    
    function showLoaderForm(){$('.fundoForm').fadeIn(200);};
    function hideLoaderForm(){$('.fundoForm').fadeOut(200);};    
    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }
    function hideLoader(){
        $('.fundo_pag').fadeOut(200);        
    };

	function emptyHideLoader(){
        $('.fundo_pag').fadeOut(200);
		$("#NB_VALOR_BASE").val('');
		$("#DT_INICIO_VIGENCIA").val('');
		$("#DT_FIM_VIGENCIA").val('');

		$.getJSON('acoes.php?identifier=atualizarInfMaster', atualizarInfMaster);
		
		function atualizarInfMaster(campo){
			console.log(campo);
			$("#atualizacao").html(campo['DT_ATUALIZACAO'][0]);
		}     
		
		
    };
	
    //Formatar Campos
    $('#DT_FIM_VIGENCIA').setMask({
        mask:'99/99/9999'
    });
    
    //Formatar Campos
    $('#DT_INICIO_VIGENCIA').setMask({
        mask:'99/99/9999'
    });

	$('input[name=NB_VALOR_BASE]').maskMoney({showSymbol:false, symbol:"R$", decimal:",", thousands:".", allowZero:false, allowNegative:true, defaultZero:false});
    
    //Calendario
    $('#DT_FIM_VIGENCIA').datepicker({
        changeMonth: true,
        changeYear: true
    });

    //Calendario
    $('#DT_INICIO_VIGENCIA').datepicker({
        changeMonth: true,
        changeYear: true
    });    
	
	$("#paginacao li").live('click', function(){
        showLoader();
        $("#tabelaBase").load('acoes.php?identifier=tabelaBase&PAGE='+this.id, hideLoader);
        return false;
    });

    // Inserção de Acesso
    $('#inserir').live('click', function(){
        if (!$('#NB_VALOR_BASE').val() || !$('#DT_INICIO_VIGENCIA').val() || !$('#DT_FIM_VIGENCIA').val()){
            alert('Para inserir escolha uma Unidade Solicitante.');
            $('#NB_VALOR_BASE').focus();
        }else{
            showLoader();
            $("#tabelaBase").load('acoes.php?identifier=inserirBase&NB_VALOR_BASE='+$('#NB_VALOR_BASE').val()+'&DT_INICIO_VIGENCIA='+$('#DT_INICIO_VIGENCIA').val()+'&DT_FIM_VIGENCIA='+$('#DT_FIM_VIGENCIA').val()+
            '&PAGE='+$('.selecionado').text(), emptyHideLoader);
        }
        return false;
    });

    //Exclusão de Acesso
    $('#excluir').live('click', function(){
        var href = $(this).attr('href');

        resp = window.confirm('Tem certeza que deseja excluir este Registro?');
        if (resp){
            showLoader();
            $("#tabelaBase").load('acoes.php?identifier=excluirBase&NB_VALOR_BASE_ITEM_PAG='+href+'&PAGE='+$('.selecionado').text(), emptyHideLoader);
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

    $("#dialog").dialog({
        autoOpen: false, height: 180, width: 900, modal: true,
        buttons:{
            "Salvar": function() {
                var vlr = $('#NB_VALOR_BASE_ALT').val();
                if (!$('#NB_VALOR_BASE_ALT').val()){
                    alert('Valor não pode ser igual a zero.');
                    $('#NB_VALOR_BASE_ALT').focus();
                }else if (!$('#DT_INICIO_VIGENCIA_ALT').val()){
                    alert('Preencha o campo Início de Vigência!');
                    $('#DT_INICIO_VIGENCIA_ALT').focus();
                }else if (!$('#DT_FIM_VIGENCIA_ALT').val()){
                    alert('Preencha o campo Fim de Vigência!');
                    $('#DT_FIM_VIGENCIA_ALT').focus();
                }else if ($('#DT_FIM_VIGENCIA_ALT').val() < $('#DT_INICIO_VIGENCIA_ALT').val()){
                    alert('Fim de Vigência não pode ser maior que o Início de Vigência!');
                    $('#DT_INICIO_VIGENCIA_ALT').focus();
                }else{
                    showLoaderForm();
                    $("#tabelaBase").load('acoes.php?identifier=alterar&NB_VALOR_BASE='+$('#NB_VALOR_BASE_ALT').val()+'&DT_INICIO_VIGENCIA='+$('#DT_INICIO_VIGENCIA_ALT').val()+'&DT_FIM_VIGENCIA='+$('#DT_FIM_VIGENCIA_ALT').val(),emptyHideLoader);
                    $( this ).dialog("close");
                }
            },
            "Cancelar": function() {
                $('#tabelaBase').html('');
                showLoader();
                $("#tabelaBase").load('acoes.php?identifier=tabelaBase', hideLoader);
                $( this ).dialog( "close" );
            }
        }
    });

   $('#alterar').live('click', function(){
        var href = $(this).attr('href');
        $( "#dialog" ).dialog( "open" );
        $('#tabela_base').html('');
        showLoaderForm();
        $('#tabela_base').load('acoes.php?identifier=tabela_Base&NB_VALOR_BASE_ITEM_PAG='+href, emptyHideLoader);
//        resp = window.confirm('Tem certeza que deseja excluir este Registro?');
//        if (resp){
//            showLoader();
//            $("#tabela").load('acoes.php?identifier=excluirItem&ID_INVENTARIO_PATRIMONIO='+valor[0]+'&ID_ITEM_PATRIMONIO='+valor[1], emptyHideLoader);
//        }

        return false;
    });
    	
	showLoader();
    $("#tabelaBase").load('acoes.php?identifier=tabelaBase', hideLoader);
});