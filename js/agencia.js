$(document).ready(function() {
 function showLoader() {
        $('.fundo_pag').fadeIn(200);
    }

function hideLoader() {
        $('.fundo_pag').fadeOut(200);
    }
   
//Pesquisar
  $('#pesquisar').click(function(){
	// if ($('#TX_AGENCIA_ESTAGIO').val() || $('#TX_SIGLA').val()){
        showLoader();
	 	$('#tabela').load('acoes.php?identifier=tabela',{TX_AGENCIA_ESTAGIO:$('#TX_AGENCIA_ESTAGIO').val(),TX_SIGLA:$('#TX_SIGLA').val()}, hideLoader);
        return false;    
	// }else
	//	alert('Preencha pelo menos um campo para realizar a pesquisa!');
   });    
  
//Paginacao
  $("#paginacao li").live('click', function(){
 	showLoader();
 	$("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{TX_AGENCIA_ESTAGIO:$('#TX_AGENCIA_ESTAGIO').val(),TX_SIGLA:$('#TX_SIGLA').val()}, hideLoader);
 	return false;
  });
  
 $("#alterar").live('click', function() {
        var href = $(this).attr('href');
        $(window.document.location).attr('href', 'validacao.php?ID=' + href);
        return false;
    });
     
 //Excluir 
   $('#excluir').live('click', function(){
    var href = $(this).attr('href');
		
		resp = window.confirm('Tem certeza que deseja excluir este Registro?');
		if (resp){
		   showLoader();
		   $('#tabela').load('acoes.php?identifier=excluir&ID='+href, hideLoader);
                }
                    
		return false;
        });
               
});