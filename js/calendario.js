$(document).ready(function(){
    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };

    //Pesquisa
    $('#pesquisar').click(function(){
        if ($('#ID_ORGAO_GESTOR_ESTAGIO').val()){
            //alert('ok: '+$('#ID_ORGAO_GESTOR_ESTAGIO').val()+', '+$('#NB_ANO_REFERENCIA').val()+', '+$('#NB_MES_REFERENCIA').val()+'.');
            showLoader();
            $("#tabela").load('acoes.php?identifier=tabela',
            {
                ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                NB_ANO_REFERENCIA:$('#NB_ANO_REFERENCIA').val(),
                NB_MES_REFERENCIA:$('#NB_MES_REFERENCIA').val()
            }, hideLoader);
        }else
            alert('Preencha pelo menos o campo \"Órgão Gestor\" para realizar pesquisa!');
    });

    //Paginacao
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,
        {
            ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
            NB_ANO_REFERENCIA:$('#NB_ANO_REFERENCIA').val(),
            NB_MES_REFERENCIA:$('#NB_MES_REFERENCIA').val()
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