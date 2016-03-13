$(document).ready(function() {

    function showLoader() {
        $('.fundo_pag').fadeIn(200);
    };

    function hideLoader() {
        $('.fundo_pag').fadeOut(200);
    };

    $('#ID_ORGAO_GESTOR_ESTAGIO option').first().next().attr("selected","selected");
    $('#ID_ORGAO_GESTOR_ESTAGIO').attr("disabled","disabled");
    $('#ID_ORGAO_GESTOR_ESTAGIO').attr("readonly","readonly");

    $('#pesquisar').click(function() {
        if ($('#ID_ORGAO_GESTOR_ESTAGIO').val() && $('#ID_ORGAO_ESTAGIO').val()) {
            showLoader();
            $('#tabela').load('acoes.php?identifier=tabela', {
                ID_ORGAO_GESTOR_ESTAGIO: $('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                ID_ORGAO_ESTAGIO: $('#ID_ORGAO_ESTAGIO').val(),
                ID_OFERTA_VAGA: $('#ID_OFERTA_VAGA').val(),
                CS_SITUACAO: $('#CS_SITUACAO').val(),
                TX_COD_SELECAO: $.trim($('#TX_COD_SELECAO').val())
            }, hideLoader);
        } else
            alert('Preencha todos os campos obrigatórios!');
    });

    //Paginacao
    $("#paginacao li").live('click', function() {
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE=' + this.id, {
            ID_ORGAO_GESTOR_ESTAGIO: $('#ID_ORGAO_GESTOR_ESTAGIO').val(),
            ID_ORGAO_ESTAGIO: $('#ID_ORGAO_ESTAGIO').val(),
            ID_OFERTA_VAGA: $('#ID_OFERTA_VAGA').val(),
            CS_SITUACAO: $('#CS_SITUACAO').val(),
            TX_COD_SELECAO: $.trim($('#TX_COD_SELECAO').val())
        }, hideLoader);
        return false;
    });

    //Icone Alterar
    $("#alterar").live('click', function() {
        var href = $(this).attr('href');
        $(window.document.location).attr('href', 'validacao.php?ID=' + href);
        return false;
    });

    $("#CHECK_RESP_2").click(function() {
        //$("#ID_OFERTA_VAGA").attr('disabled', true);
        $("#ID_OFERTA_VAGA").val('0');
        $('.comSelecao').hide();
        $('.semSelecao').show();
    });

    $("#CHECK_RESP").click(function() {
        //$("#ID_OFERTA_VAGA").attr('disabled', false);
         $('.semSelecao').hide();
        $('.comSelecao').show();

        $('#ID_ORGAO_ESTAGIO').change(function() {
            $("#ID_OFERTA_VAGA").html('');
            if ($('#ID_ORGAO_ESTAGIO').val() != 0) {
                $("#ID_OFERTA_VAGA").html('<option>Carregando...</option>');
                $.post("acoes.php", {
                    ID_ORGAO_ESTAGIO: $('#ID_ORGAO_ESTAGIO').val(),
                    identifier: 'buscarOfertaVaga'
                },
                function(valor) {
                    $('#ID_OFERTA_VAGA').html(valor);
                });
            }
        });
    });

    if ($("#CHECK_RESP").is(':checked')) {
        $('.semSelecao').hide();
        $('.comSelecao').show();


    } else {
        $('.comSelecao').hide();
    }

    $('#ID_ORGAO_ESTAGIO').change(function() {
        $("#ID_OFERTA_VAGA").html('');
        if ($('#ID_ORGAO_ESTAGIO').val() !== 0) {
            $("#ID_OFERTA_VAGA").html('<option>Carregando...</option>');
            $.post("acoes.php", {
                ID_ORGAO_ESTAGIO: $('#ID_ORGAO_ESTAGIO').val(),
                identifier: 'buscarOfertaVaga'
            },
            function(valor) {
                $('#ID_OFERTA_VAGA').html(valor);
            });
        }
    });
});