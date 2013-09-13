$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    };

    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };


    //---------------------pequisa--------------------------------------------------
    $('#pesquisar').click(function(){

        //if(($('#ID_QUADRO_VAGAS_ESTAGIO').val() || $('#ID_ORGAO_GESTOR_ESTAGIO').val()) || ($('#ID_AGENCIA_ESTAGIO').val() || $('#CS_SITUACAO').val())){
            showLoader();
            $('#tabela').load('acoes.php?identifier=tabela',{
                ID_QUADRO_VAGAS_ESTAGIO:$('#ID_QUADRO_VAGAS_ESTAGIO').val(),
                ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                ID_AGENCIA_ESTAGIO:$('#ID_AGENCIA_ESTAGIO').val(),
                CS_SITUACAO:$('#CS_SITUACAO').val()
                },hideLoader);
        //}else
        //    alert('Preencha pelo menos um campo para realizar a pesquisa!');

    });


    //--------------------Paginacao-------------------------------------------------
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{
            ID_QUADRO_VAGAS_ESTAGIO:$('#ID_QUADRO_VAGAS_ESTAGIO').val(),
            ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
            ID_AGENCIA_ESTAGIO:$('#ID_AGENCIA_ESTAGIO').val(),
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