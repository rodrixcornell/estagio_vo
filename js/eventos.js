$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };
	

	$('#pesquisar').click(function(){
		if ($('#CS_TIPO').val() || $('#CS_SITUACAO').val() || $('#TX_CODIGO').val() || $('#TX_DESCRICAO').val()){
			showLoader();
			$('#tabela').load('acoes.php?identifier=tabela',{
					CS_TIPO:$('#CS_TIPO').val(),
					CS_SITUACAO:$('#CS_SITUACAO').val(),
					TX_CODIGO:$('#TX_CODIGO').val(),					
					TX_DESCRICAO:$('#TX_DESCRICAO').val()
			}, hideLoader);
		}else
			alert('Preencha pelo menos um campo para realizar a pesquisa!');
    });
	
    //Paginacao
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{
					CS_TIPO:$('#CS_TIPO').val(),
					CS_SITUACAO:$('#CS_SITUACAO').val(),
					TX_CODIGO:$('#TX_CODIGO').val(),					
					TX_DESCRICAO:$('#TX_DESCRICAO').val()
			}, hideLoader);
        return false;
    });
	
	
 	//Icone Alterar
    $("#alterar").live('click', function(){
        var href = $(this).attr('href');
        $(window.document.location).attr('href','validacao.php?ID='+href);
        return false;
    });
	
});