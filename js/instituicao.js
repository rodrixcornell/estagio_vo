$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };

// Pesquisar por unidade 
    $('#pesquisar').click(function(){
         showLoader();
	 $('#tabela').load('acoes.php?identifier=tabela',{TX_INSTITUICAO_ENSINO:$('#TX_INSTITUICAO_ENSINO').val(),TX_SIGLA:$('#TX_SIGLA').val()}, hideLoader);
       return false;    
      });    
  
//Paginacao
$("#paginacao li").live('click', function(){
 showLoader();
 $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{TX_INSTITUICAO_ENSINO:$('#TX_INSTITUICAO_ENSINO').val(),TX_SIGLA:$('#TX_SIGLA').val()}, hideLoader);
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
			    ID_INSTITUICAO_ENSINO:$(this).attr('href'),
				TX_INSTITUICAO_ENSINO:$('#TX_INSTITUICAO_ENSINO').val(),
				TX_SIGLA:$('#TX_SIGLA').val(),
				PAGE:$('.selecionado').text()
			}, hideLoader);
		}
					
		return false;
	});

});