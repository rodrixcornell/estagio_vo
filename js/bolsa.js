$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };


	$('#pesquisar').click(function(){
//		if ($('#TX_UNIDADE_IRP').val() || $('#ID_UNIDADE_ORG').val()){
			showLoader();
			$('#tabela').load('acoes.php?identifier=tabela',{
					ID_BOLSA_ESTAGIO:$('#ID_BOLSA_ESTAGIO').val()
				}, hideLoader);
//		}else
//			alert('Preencha pelo menos um campo para realizar a pesquisa!');
    });
	
    //Paginacao
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{
				TX_UNIDADE_IRP:$('#ID_BOLSA_ESTAGIO').val()
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
				ID:$(this).attr('href'),
				ID_BOLSA_ESTAGIO:$('#ID_BOLSA_ESTAGIO').val(),
				PAGE:$('.selecionado').text()
			}, hideLoader);
		}
					
		return false;
	});

	$('input[name=NB_VALOR]').maskMoney({showSymbol:false, symbol:"R$", decimal:",", thousands:".", allowZero:false, allowNegative:false, defaultZero:false});

});