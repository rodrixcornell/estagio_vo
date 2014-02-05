$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }
    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };
    //-----------------------------------
    function showLoaderForm(){
        $('.fundoForm').fadeIn(200);
    };
    function hideLoaderForm(){
        $('.fundoForm').fadeOut(200);
    };

    //------------ formatos -----------------------
    $('#NB_QUANTIDADE').setMask({
        mask:'999'
    });


    //-----------------------------------
    function emptyHideLoader(){
        $('.fundo_pag').fadeOut(200);
        $("#ID_AGENCIA_ESTAGIO option:first,#ID_ORGAO_ESTAGIO option:first, #CS_TIPO_VAGA_ESTAGIO option:first, #ID_CURSO_ESTAGIO option:first").attr('selected','selected');
		$('#NB_QUANTIDADE').val('')

		$.getJSON('acoes.php?identifier=atualizarInf', atualizarInf);
        function atualizarInf(campo){

            $("#atualizacao").html(campo['DT_ATUALIZACAO'][0]);
            $("#funcionario").html(campo['TX_FUNCIONARIO'][0]);
        }
    };


    //---------------paginação----------------------
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabelaUnidade").load('acoes.php?identifier=tabelaUnidade&PAGE='+this.id, hideLoader);
        return false;
    });

    //---------- INSERÇÃO NO DETAIL --------------------
    // Inserção de Acesso
    $('#inserir').live('click', function(){
		if (!$('#ID_AGENCIA_ESTAGIO').val()){
            alert('Para inserir escolha uma Agência de Estágio.');
            $('#ID_AGENCIA_ESTAGIO').focus();

        }else if (!$('#ID_ORGAO_ESTAGIO').val()){
            alert('Para inserir escolha um Órgão.');
            $('#ID_ORGAO_ESTAGIO').focus();

        }else if (!$('#CS_TIPO_VAGA_ESTAGIO').val()){
            alert('Para inserir escolha um Tipo de Vaga.');
            $('#CS_TIPO_VAGA_ESTAGIO').focus();

        }else if (!$('#NB_QUANTIDADE').val()){
            alert('Para inserir preencha uma Quantidade.');
            $('#NB_QUANTIDADE').focus();

        }else{
            showLoader();
            $("#tabelaUnidade").load('acoes.php?identifier=inserirVaga',{
				ID_AGENCIA_ESTAGIO:$('#ID_AGENCIA_ESTAGIO').val(),
                ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
                CS_TIPO_VAGA_ESTAGIO:$('#CS_TIPO_VAGA_ESTAGIO').val(),
                NB_QUANTIDADE:$('#NB_QUANTIDADE').val(),
                ID_CURSO_ESTAGIO:$('#ID_CURSO_ESTAGIO').val(),
                PAGE:$('.selecionado').text()
            }, emptyHideLoader);
        }
        return false;
    });


    //--------------------alterar do detail-----------------------------------------
	
		//Alteracao de Itens
    $('#alterar').live('click', function(){

        if ($('#NB_QUANTIDADE_ALT').length){
            alert('Já existe um valor em modo de edição.\nConfirme a alteração do item anterior.');
            $('#NB_QUANTIDADE_ALT').focus();
            return false;
        }else{
            var linha = $(this).parent().parent();
			var qtd = $(this).parent().parent().find(".qtd");
            var curso = $(this).parent().parent().find(".curso");			
            var icones = $(this).parent().parent().find(".icones");

            var href = $(this).attr('href');
			var selectionCurso = $(this).attr('sel');
			
			
			qtd.html('<input type="text" name="NB_QUANTIDADE_ALT" id="NB_QUANTIDADE_ALT" value="'+qtd.text()+'" style="width:75px; text-align:center;">');
			curso.html($('#ID_CURSO_ESTAGIO').clone().attr('id', 'ID_CURSO_ESTAGIO_ALT').attr('name', 'ID_CURSO_ESTAGIO_ALT').val(selectionCurso).css('width','255px'));

            icones.html('<a href="'+href+'" id="salvar"><img src="'+urlimg+'icones/salvar.png" title="Salvar Alterações"/></a> <a href="#" id="cancelar"><img src="'+urlimg+'icones/cancelar.png" title="Cancelar"/></a>');
			
			$('#NB_QUANTIDADE_ALT').setMask({ mask:'999' });
			
			linha.attr('bgcolor', '#FBCA8D');
			$('#NB_QUANTIDADE_ALT').focus();
            return false;
        }
    });
	
	$('#cancelar').live('click', function(){
		showLoader();
		$("#tabelaUnidade").load('acoes.php?identifier=tabelaUnidade&PAGE='+$('.selecionado').text(), hideLoader);
		return false;
	});
	
	
	$('#salvar').live('click', function(){
		
		var NB_QUANTIDADE 	 = $(this).parent().parent().find("#NB_QUANTIDADE_ALT").val();
		var ID_CURSO_ESTAGIO = $(this).parent().parent().find("#ID_CURSO_ESTAGIO_ALT").val();
		
		if (NB_QUANTIDADE){
			showLoader();
			$("#tabelaUnidade").load('acoes.php?identifier=alterarVaga&PAGE='+$('.selecionado').text(),
								{CODIGO: $(this).attr('href'),
								 NB_QUANTIDADE: NB_QUANTIDADE,
								 ID_CURSO_ESTAGIO:ID_CURSO_ESTAGIO
								}, hideLoader);
		}else{
			alert('Para alterar preencha o campo Quantidade.');
            $('#NB_QUANTIDADE_ALT').focus();	
		}
		
		return false;
		
	});
	
	

    //---------Exclusão de Acesso detail--------------------------------------------
    $('#excluir').live('click', function(){
        var href = $(this).attr('href');

        resp = window.confirm('Tem certeza que deseja excluir este Registro?');
        if (resp){
            showLoader();
            $("#tabelaUnidade").load('acoes.php?identifier=excluirUnidade',{
                CODIGO: $(this).attr('href'),
                PAGE:$('.selecionado').text()
            }, emptyHideLoader);

            return false;
        }else
			return false;

    });

    //----------------Excluir Master------------------------------------------------
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

    //--------------------------
    showLoader();
    $("#tabelaUnidade").load('acoes.php?identifier=tabelaUnidade', hideLoader);
});