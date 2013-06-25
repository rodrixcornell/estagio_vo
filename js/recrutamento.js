$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };
	

    $('#pesquisar').click(function(){
        if ($('#ID_ORGAO_GESTOR_ESTAGIO').val() || $('#ID_ORGAO_ESTAGIO').val() || $('#ID_QUADRO_VAGAS_ESTAGIO').val()   ||  $('#TX_COD_RECRUTAMENTO').val() ){
            showLoader();
            $('#tabela').load('acoes.php?identifier=tabela',{
                ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
                ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                ID_QUADRO_VAGAS_ESTAGIO:$('#ID_QUADRO_VAGAS_ESTAGIO').val(),
                TX_COD_RECRUTAMENTO:$('#TX_COD_RECRUTAMENTO').val()
               
            }, hideLoader);
        }else
            alert('Preencha pelo menos um campo para realizar a pesquisa!');
    });
	
    //Paginacao
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{
            ID_RECRUTAMENTO_ESTAGIO:$('#ID_RECRUTAMENTO_ESTAGIO').val()
           
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