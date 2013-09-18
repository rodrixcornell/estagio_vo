$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };

	$('#CS_TIPO_VAGA_ESTAGIO').setMask({ mask:'99999999' });

	$('#pesquisar').click(function(){
//		if ($('#TX_UNIDADE_IRP').val() || $('#ID_UNIDADE_ORG').val()){
			showLoader();
			$('#tabela').load('acoes.php?identifier=tabela',{
					CS_TIPO_VAGA_ESTAGIO:$('#CS_TIPO_VAGA_ESTAGIO').val(),
					TX_TIPO_VAGA_ESTAGIO:$('#TX_TIPO_VAGA_ESTAGIO').val()
				}, hideLoader);
//		}else
//			alert('Preencha pelo menos um campo para realizar a pesquisa!');
    });
	
    //Paginacao
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{
				CS_TIPO_VAGA_ESTAGIO:$('#CS_TIPO_VAGA_ESTAGIO').val()
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
				CS_TIPO_VAGA_ESTAGIO:$('#CS_TIPO_VAGA_ESTAGIO').val(),
				PAGE:$('.selecionado').text()
			}, hideLoader);
		}
					
		return false;
	});

});