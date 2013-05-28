$(document).ready(function(){
    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };

    $('#pesquisar').click(function(){
        if ($('#ID_ORGAO_GESTOR_ESTAGIO').val() && $('#ID_ORGAO_ESTAGIO').val() || ($('#ID_AGENCIA_ESTAGIO').val() || $('#CS_SITUACAO').val() || $.trim($('#TX_COD_SOLICITACAO').val()))){
            //alert('fudeu '+$('#ID_ORGAO_GESTOR_ESTAGIO').val()+', '+$('#ID_ORGAO_ESTAGIO').val()+', '+$('#ID_AGENCIA_ESTAGIO').val()+', '+$('#CS_SITUACAO').val()+', '+$('#TX_COD_SOLICITACAO').val()+'.');
            showLoader();
            $("#tabela").load('acoes.php?identifier=tabela',
            {
                ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
                ID_AGENCIA_ESTAGIO:$('#ID_AGENCIA_ESTAGIO').val(),
                CS_SITUACAO:$('#CS_SITUACAO').val(),
                TX_COD_SOLICITACAO:$('#TX_COD_SOLICITACAO').val()
            }, hideLoader);
        }else
            alert('Preencha pelo menos os campos \"Órgão Gestor e Órgão Solicitante\" para realizar pesquisa!');
    });

    //Paginacao
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,
        {
            ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
                ID_AGENCIA_ESTAGIO:$('#ID_AGENCIA_ESTAGIO').val(),
                CS_SITUACAO:$('#CS_SITUACAO').val(),
                TX_COD_SOLICITACAO:$('#TX_COD_SOLICITACAO').val()
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