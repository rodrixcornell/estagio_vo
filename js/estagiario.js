$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };
	
	$('#NB_CPF').setMask({ mask:'99999999999' });


	//Formatar Campos
	$('#DT_EMISSAO,#DT_NASCIMENTO').setMask({ mask:'99/99/9999' });
	
	$('#DT_EMISSAO,#DT_NASCIMENTO').datepicker({
		changeMonth: true,
        changeYear: true
	});


	$('#pesquisar').click(function(){
		if ($('#TX_NOME').val() || $('#NB_CPF').val()){
			showLoader();
			$('#tabela').load('acoes.php?identifier=tabela',{
					TX_NOME:$('#TX_NOME').val(),
					NB_CPF:$('#NB_CPF').val()
				}, hideLoader);
		}else
			alert('Preencha pelo menos um campo para realizar a pesquisa!');
    });
	
	
    //Paginacao
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{
				TX_NOME:$('#TX_NOME').val(),
				NB_CPF:$('#NB_CPF').val()
			}, hideLoader);
        return false;
    });
	
	
	//Icone Alterar
    $("#alterar").live('click', function(){
        var href = $(this).attr('href');
        $(window.document.location).attr('href','validacao.php?ID='+href);
        return false;
    });
	
	//Excluir
   $('#excluir').live('click', function(){
		
		resp = window.confirm('Tem certeza que deseja excluir este Registro?');
		if (resp){
		   showLoader();
		   $('#tabela').load('acoes.php?identifier=excluir',{
			    ID_PESSOA_ESTAGIARIO:$(this).attr('href'),
				PAGE:$('.selecionado').text()
			}, hideLoader);
		}
					
		return false;
	});

});