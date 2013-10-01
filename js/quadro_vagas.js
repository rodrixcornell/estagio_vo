$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    };

    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };


    //---------------------pequisa--------------------------------------------------
    $('#pesquisar').click(function(){
            showLoader();
            $('#tabela').load('acoes.php?identifier=tabela',{
                ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                CS_SITUACAO:$('#CS_SITUACAO').val()
            },hideLoader);
    });


    //--------------------Paginacao-------------------------------------------------
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{
            ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
            CS_SITUACAO:$('#CS_SITUACAO').val()
        }, hideLoader);
        return false;
    });

    //--------master Alterar---------------------
    $("#alterar").live('click', function(){
        var href = $(this).attr('href');
        $(window.document.location).attr('href','validacao.php?ID='+href);
        return false;
    });

});