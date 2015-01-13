$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }
    function hideLoader(){
        $('.fundo_pag').fadeOut(200);

    };

    function emptyHideLoader(){
        $('.fundo_pag').fadeOut(200);
        $('#NB_QUANTIDADE').val('');
		$('#CS_TIPO_VAGA_ESTAGIO').html('');
        $('#ID_SOLICITACAO_TA_CP option:first').attr('selected','selected');

        $.post("acoes.php?identifier=pesquisarTipoVaga",{ID_SOLICITACAO_TA_CP:$('#ID_SOLICITACAO_TA_CP').val()},TipoVaga);		
		function TipoVaga(valor){
			$("#CS_TIPO_VAGA_ESTAGIO").html(valor);
		}
		
        $.getJSON('acoes.php?identifier=atualizarInf', atualizarInf);
        function atualizarInf(campo){
            $("#funcionario").html(campo['TX_FUNCIONARIO_ATUAL'][0]);
            $("#atualizacao").html(campo['DT_ATUALIZACAO'][0]);
        }
    };

    function showLoaderForm(){
        $('.fundoForm').fadeIn(200);
    };
    
    function hideLoaderForm(){
        $('.fundoForm').fadeOut(200);
    };

    $('#NB_QUANTIDADE').setMask({
        mask:'999999'
    });

//------------------------INSERIR VAGAS SOLICITADAS----------------------------------
    $('#inserir').live('click', function(){
        if (!$('#CS_TIPO_VAGA_ESTAGIO').val()){
            alert('Para inserir escolha um Tipo de Vaga.');
            $('#CS_TIPO_VAGA_ESTAGIO').focus();
        }else if (!$('#NB_QUANTIDADE').val()){
            alert('Para inserir escolha uma Quantidade.');
            $('#NB_QUANTIDADE').focus();
        }else{
            showLoader();
            $("#tabelaVagasSolicitadas").load('acoes.php',
				{
				CS_TIPO_VAGA_ESTAGIO:$('#CS_TIPO_VAGA_ESTAGIO').val(),
				NB_QUANTIDADE:$('#NB_QUANTIDADE').val(),
                                NB_TAXA_ADMINISTRATIVA:$('#NB_TAXA_ADMINISTRATIVA').val(),
                                NB_AUXILIO_TRANSPORTE:$('#NB_AUXILIO_TRANSPORTE').val(),
                                NB_BOLSA_AUXILIO:$('#NB_BOLSA_AUXILIO').val(),
				identifier:'inserirVagasSolicitadas',
				PAGE:$('.selecionado').text()
				}, emptyHideLoader);
        }
        return false;
    });
    
    //----------------------------ALTERAR VAGAS SOLICITADAS---------------------
    $('#alterar').live('click', function(){
        var href = $(this).attr('href');

        $("#dialog").dialog("open");

        $('#tabelaAlterarVagasSolicitadas').html('');
        showLoaderForm();
        $('#tabelaAlterarVagasSolicitadas').load('acoes.php',
			{
			CS_TIPO_VAGA_ESTAGIO:href,
			ID_SOLICITACAO_TA_CP:$('#ID_SOLICITACAO_TA_CP').val(), 
                        NB_QUANTIDADE:$('#NB_QUANTIDADE').val(),
                        NB_TAXA_ADMINISTRATIVA:$('#NB_TAXA_ADMINISTRATIVA').val(),
                        NB_AUXILIO_TRANSPORTE:$('#NB_AUXILIO_TRANSPORTE').val(),
			NB_BOLSA_AUXILIO:$('#NB_BOLSA_AUXILIO').val(),
			identifier:'tabelaAlterarVagasSolicitadas'
			}, hideLoaderForm);
        return false;
    });
    
//------------------------EXCLUIR VAGAS SOLICITADAS-----------------------------
    $('#excluir').live('click', function(){
        var href = $(this).attr('href');

        resp = window.confirm('Tem certeza que deseja excluir este Registro?');
        if (resp){
            showLoader();
            $("#tabelaVagasSolicitadas").load('acoes.php',
            {
                CS_TIPO_VAGA_ESTAGIO:href,
				ID_SOLICITACAO_TA_CP:$('#ID_SOLICITACAO_TA_CP').val(), 
			
                identifier:'excluirVagasSolicitadas',
                PAGE:$('.selecionado').text()
            }, emptyHideLoader);
        }
        return false;
    });
    

    $("#dialog").dialog({
        autoOpen: false,
        height: 300,
        width: 600,
        modal: true,
        buttons:{
            "Salvar": function() {
                if (!$('#NB_QUANTIDADE').val()){
                    alert('Para inserir escolha uma Quantidade.');
                    $('#NB_QUANTIDADE').focus();
                }else{
                    showLoader();
                    $("#tabelaVagasSolicitadas").load('acoes.php',
							{	
							CS_TIPO_VAGA_ESTAGIO:$('#CS_TIPO_VAGA_ESTAGIO_ALT').val(),
							NB_QUANTIDADE:$('#NB_QUANTIDADE_ALT').val(),
							NB_TAXA_ADMINISTRATIVA:$('#NB_TAXA_ADMINISTRATIVA').val(),
                                                        NB_AUXILIO_TRANSPORTE:$('#NB_AUXILIO_TRANSPORTE').val(),
                                                        NB_BOLSA_AUXILIO:$('#NB_BOLSA_AUXILIO').val(),
							identifier:'alterarVagasSolicitadas',
							PAGE:$('.selecionado').text()
							}, emptyHideLoader);
                    $( this ).dialog("close");
                };
            },
            "Cancelar": function() {
                $('#tabelaAlterarVagasSolicitadas').html('');
                $( this ).dialog( "close" );
            }
        }
    });
    
//------------------------------EFETIVAR VAGAS----------------------------------	
	$( "#efetivar" ).live('click', function() {
		if ($('.icones').length){
			resp = window.confirm('Tem certeza que deseja Efetivar esta Solicitação?');
			if (resp){
				showLoader();
				return true;
			}
			return false;
		}else{
			alert('Para Efetivar uma Solicitação adicione pelo menos uma vaga de estágio.');
			return false;	
		}			  
    });


//------------------------------EXCLUIR MASTER----------------------------------
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
	
	$("#paginacao li").live('click', function(){
        showLoader();
        $("#tabelaVagasSolicitadas").load('acoes.php?identifier=tabelaVagasSolicitadas&PAGE='+this.id, {ID_QUADRO_VAGAS_ESTAGIO:$('#ID_QUADRO_VAGAS_ESTAGIO').val(), ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val()}, hideLoader);
        return false;
    });

    showLoader();
    $("#tabelaVagasSolicitadas").load('acoes.php?identifier=tabelaVagasSolicitadas',{ID_QUADRO_VAGAS_ESTAGIO:$('#ID_QUADRO_VAGAS_ESTAGIO').val(), ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val()}, hideLoader);
});