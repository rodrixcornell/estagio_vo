$(document).ready(function() {

    function showLoader() {
        $('.fundo_pag').fadeIn(200);
    };

    function hideLoader() {
        $('.fundo_pag').fadeOut(200);
    };

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
        $('.comSelecao').hide();
    });

    $("#CHECK_RESP").click(function() {
        //$("#ID_OFERTA_VAGA").attr('disabled', false);
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

//    $('#DT_AGENDAMENTO').setMask({mask: '99/99/9999'});
//
//    $('#DT_AGENDAMENTO').datepicker({
//        changeMonth: true,
//        changeYear: true
//    });
//
//    $('#DT_REALIZACAO').setMask({mask: '99/99/9999'});
//
//    $('#DT_REALIZACAO').datepicker({
//        changeMonth: true,
//        changeYear: true
//    });


    //Cadastrar e Alterar
//    $("#ID_ORGAO_GESTOR_ESTAGIO").live('change', function() {
//        $("#ID_ORGAO_ESTAGIO").html('');
//        if ($('#ID_ORGAO_GESTOR_ESTAGIO').val()) {
//            $("#ID_ORGAO_ESTAGIO").html('<option>Carregando...</option>');
//            $.post("acoes.php", {
//                //ID_ORGAO_GESTOR_ESTAGIO: $('#ID_ORGAO_GESTOR_ESTAGIO').val(),
//                identifier: 'buscarOfertaVaga'
//            },
//            function(valor) {
//                $("#ID_ORGAO_ESTAGIO").html(valor);
//            });
//
//        }
//        return false;
//    });

    //Cadastrar e Alterar
//    $('#ID_ORGAO_ESTAGIO').change(function() {
//        $("#ID_RECRUTAMENTO_ESTAGIO").html('');
//        if ($('#ID_ORGAO_ESTAGIO').val() != 0) {
//            $.post("acoes.php", {
//                //ID_ORGAO_ESTAGIO: $('#ID_ORGAO_ESTAGIO').val(),
//                identifier: 'buscarOfertaVaga'
//            },
//            function(valor) {
//                $('#ID_OFERTA_VAGA').html(valor);
//            });
//        }
//    });
//
//    //Index
//    $("#ID_ORGAO_GESTOR_ESTAGIO").live('change', function() {
//        $("#ID_ORGAO_ESTAGIO,#ID_RECRUTAMENTO_ESTAGIO").html('');
//        if ($('#ID_ORGAO_GESTOR_ESTAGIO').val()) {
//            $("#ID_ORGAO_ESTAGIO").html('<option>Carregando...</option>');
//            $.post("acoes.php", {
//                ID_ORGAO_GESTOR_ESTAGIO: $('#ID_ORGAO_GESTOR_ESTAGIO').val(),
//                identifier: 'buscarSolicitante'
//            },
//            function(valor) {
//                $("#ID_ORGAO_ESTAGIO").html(valor);
//            });
//
//        }
//        return false;
//    });
//
//    //Index
//    $('#ID_ORGAO_ESTAGIO').change(function() {
//        $("#ID_RECRUTAMENTO_ESTAGIO").html('');
//        if ($('#ID_ORGAO_ESTAGIO').val() != 0) {
//            $.post("acoes.php", {
//                ID_ORGAO_ESTAGIO: $('#ID_ORGAO_ESTAGIO').val(),
//                identifier: 'buscarRecrutamento'
//            },
//            function(valor) {
//                $('#ID_RECRUTAMENTO_ESTAGIO').html(valor);
//            });
//        }
//    });
});