$(document).ready(function() {

    function showLoader() {
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader() {
        $('.fundo_pag').fadeOut(200);
    }

    $('#pesquisar').click(function() {
        if ($('#CS_TIPO_PAG_ESTAGIO').val()) {
            showLoader();
            $('#tabela').load('acoes.php?identifier=tabela', {
                CS_TIPO_PAG_ESTAGIO: $('#CS_TIPO_PAG_ESTAGIO').val()
            }, hideLoader);
        } else
            alert('Preencha pelo menos um campo para realizar a pesquisa!');
    });


    //Paginacao
    $("#paginacao li").live('click', function() {
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE=' + this.id, {
            CS_TIPO_PAG_ESTAGIO: $('#CS_TIPO_PAG_ESTAGIO').val()
        }, hideLoader);
        return false;
    });


    //INSERIR
    $('#inserir').live('click', function() {
        if (!$('#CS_TIPO_PAG_ESTAGIO').val()) {
            $('#CS_TIPO_PAG_ESTAGIO').focus();
        } else if (!$('#TX_TIPO_PAG_ESTAGIO').val()) {
            $('#TX_TIPO_PAG_ESTAGIO').focus();
        } else {
            showLoader();
            $('#tabela').load('acoes.php?identifier=tabela&CS_TIPO_PAG_ESTAGIO=' + $('#CS_TIPO_PAG_ESTAGIO').val() + '&TX_TIPO_PAG_ESTAGIO=' + $('#TX_TIPO_PAG_ESTAGIO').val(), hideLoader);
            return false;
        }
        return false;
    });

    //Icone Alterar
    $("#alterar").live('click', function() {
        var href = $(this).attr('href');
        $(window.document.location).attr('href', 'validacao.php?ID=' + href);
        return false;
    });

    //Excluir
    $('#excluir').live('click', function() {

        resp = window.confirm('Tem certeza que deseja excluir este Registro?');
        if (resp) {
            showLoader();
            $('#tabela').load('acoes.php?identifier=excluir', {
                CS_TIPO_PAG_ESTAGIO: $(this).attr('href'),
                TX_TIPO_PAG_ESTAGIO: $('#TX_TIPO_PAG_ESTAGIO').val(),
                CS_TIPO_PAG_ESTAGIO:$('#CS_TIPO_PAG_ESTAGIO').val(),
                        PAGE: $('.selecionado').text()
            }, hideLoader);
        }

        return false;
    });

});