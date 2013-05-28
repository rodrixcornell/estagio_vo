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
	
	
    // Inserção de Acesso
    $('#inserir').live('click', function(){
        if (!$('#NB_VALOR_BASE').val() || !$('#DT_INICIO_VIGENCIA').val() || !$('#DT_FIM_VIGENCIA').val()){
            alert('Os campos Valor, Início de Vigência e Fim de Vigência são Obrigatórios.');
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
	
	
	//Alteracao
    $('#alterar').live('click', function(){

        if ($('#NB_VALOR_BASE_ALT').length){
            alert('Já existe um valor em modo de edição.\nConfirme a alteração do item anterior.');
            $('#NB_VALOR_BASE_ALT').focus();
                return false;
        }else{
            var linha = $(this).parent().parent();
            var valor = $(this).parent().parent().find(".valor");
			var dtInicio = $(this).parent().parent().find(".dtInicio");
			var dtFim = $(this).parent().parent().find(".dtFim");
            var icones = $(this).parent().parent().find(".icones");

            var href = $(this).attr('href');

            valor.html('<input type="text" name="NB_VALOR_BASE_ALT" id="NB_VALOR_BASE_ALT" value="'+valor.text()+'" style="width:120px; text-align:center;">');
			dtInicio.html('<input type="text" name="DT_INICIO_VIGENCIA_ALT" id="DT_INICIO_VIGENCIA_ALT" value="'+dtInicio.text()+'" style="width:120px; text-align:center;">');
			dtFim.html('<input type="text" name="DT_FIM_VIGENCIA_ALT" id="DT_FIM_VIGENCIA_ALT" value="'+dtFim.text()+'" style="width:120px; text-align:center;">');
            icones.html('<a href="'+href+'" id="salvar"><img src="'+urlimg+'icones/salvar.png" title="Salvar Alterações"/></a> <a href="#" id="cancelar"><img src="'+urlimg+'icones/cancelar.png" title="Cancelar"/></a>');
			
			
			//Formatar Campos
			$('#DT_INICIO_VIGENCIA_ALT').setMask({
				mask:'99/99/9999'
			});
			
			//Formatar Campos
			$('#DT_FIM_VIGENCIA_ALT').setMask({
				mask:'99/99/9999'
			});
		
			$('input[name=NB_VALOR_BASE_ALT]').maskMoney({showSymbol:false, symbol:"R$", decimal:",", thousands:".", allowZero:false, allowNegative:true, defaultZero:false});
			
			//Calendario
			$('#DT_INICIO_VIGENCIA_ALT').datepicker({
				changeMonth: true,
				changeYear: true
			});
		
			//Calendario
			$('#DT_FIM_VIGENCIA_ALT').datepicker({
				changeMonth: true,
				changeYear: true
			});
			
			linha.attr('bgcolor', '#FBCA8D');

            return false;
        }
    });
	
	$('#cancelar').live('click', function(){
		showLoader();
		$("#tabelaBase").load('acoes.php?identifier=tabelaBase', hideLoader);
		return false;
	});
	
	
	$('#salvar').live('click', function(){
		var href = $(this).attr('href');
        var valor = href.split('_');
		
		var NB_VALOR_BASE_ALT = $(this).parent().parent().find("#NB_VALOR_BASE_ALT").val();
		var DT_INICIO_VIGENCIA_ALT = $(this).parent().parent().find("#DT_INICIO_VIGENCIA_ALT").val();
		var DT_FIM_VIGENCIA_ALT = $(this).parent().parent().find("#DT_FIM_VIGENCIA_ALT").val();
				
		showLoader();
		$("#tabelaBase").load('acoes.php?identifier=alterar&NB_VALOR_BASE_ITEM_PAG='+$(this).attr('href'),{NB_VALOR_BASE:NB_VALOR_BASE_ALT, DT_INICIO_VIGENCIA:DT_INICIO_VIGENCIA_ALT, DT_FIM_VIGENCIA:DT_FIM_VIGENCIA_ALT}, emptyHideLoader);
		
		return false;
		
	});
	

    	
	showLoader();
    $("#tabelaBase").load('acoes.php?identifier=tabelaBase', hideLoader);
});