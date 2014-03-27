$(document).ready(function() {
    function showLoader() {
        $('.fundo_pag').fadeIn(200);
    }
    function hideLoader() {
        $('.fundo_pag').fadeOut(200);
    }
    ;

    $('#TX_TCE').setMask({mask: '99999999999999999999'});
    $('#TX_TELEFONE').setMask({mask: '9999-9999999'});

    $('#NB_VALOR').maskMoney({
        showSymbol: false,
        symbol: "R$",
        decimal: ",",
        thousands: ".",
        allowZero: false,
        allowNegative: false,
        defaultZero: false
    });
    $('#NB_INICIO_HORARIO,#NB_FIM_HORARIO').timepicker();

    $('#NB_CPF').setMask({
        mask: '99999999999'
    });

    $('#NB_INICIO_HORARIO,#NB_FIM_HORARIO').setMask({
        mask: '99:99'
    });
    $('#DT_INICIO_VIGENCIA,#DT_FIM_VIGENCIA,#DT_DESLIGAMENTO').setMask({
        mask: '99/99/9999'
    });
    //minicalendario
    $('#DT_INICIO_VIGENCIA,#DT_FIM_VIGENCIA,#DT_DESLIGAMENTO').datepicker({
        changeMonth: true,
        changeYear: true
    });

    // Index
    // Change do orgão gestor
    $('#pesquisar').click(function() {
        if ($('#ID_ORGAO_GESTOR_ESTAGIO').val() && $('#ID_ORGAO_ESTAGIO').val() && ($('#CHECK_RESP').is(':checked') || $('#CHECK_RESP_2').is(':checked'))) {
            showLoader();
            $('#tabela').load('acoes.php?identifier=tabela', {
                ID_ORGAO_GESTOR_ESTAGIO: $('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                ID_ORGAO_ESTAGIO: $('#ID_ORGAO_ESTAGIO').val(),
                ID_SELECAO_ESTAGIO: $('#ID_SELECAO_ESTAGIO').val(),
                TX_TCE: $('#TX_TCE').val(),
                TX_NOME: $('#TX_NOME').val(),
                NB_CPF: $('#NB_CPF').val(),
                CHECK_RESP: $('#CHECK_RESP').is(':checked'),
                CHECK_RESP_2: $('#CHECK_RESP_2').is(':checked')
            }, hideLoader);
        } else
            alert('Preencha pelo menos os campos \"Órgão Gestor, Órgão Solicitante e Tipo selecao \" para realizar pesquisa!');
    });

    //Paginacao
    $("#paginacao li").live('click', function() {
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE=' + this.id, {
            ID_ORGAO_GESTOR_ESTAGIO: $('#ID_ORGAO_GESTOR_ESTAGIO').val(),
            ID_ORGAO_ESTAGIO: $('#ID_ORGAO_ESTAGIO').val(),
            ID_SELECAO_ESTAGIO: $('#ID_SELECAO_ESTAGIO').val(),
            TX_TCE: $('#TX_TCE').val(),
            TX_NOME: $('#TX_NOME').val(),
            NB_CPF: $('#NB_CPF').val(),
            CHECK_RESP: $('#CHECK_RESP').is(':checked'),
            CHECK_RESP_2: $('#CHECK_RESP_2').is(':checked')
        }, hideLoader);
        return false;
    });


    $("#alterar").live('click', function() {
        var href = $(this).attr('href');
        $(window.document.location).attr('href', 'validacao.php?ID=' + href);
        return false;
    });

    // Change do orgão gestor -
    // quando o usuario clicar no combo do orgão gestor ele carrega o nome do secretario e o endereço
    $("#ID_ORGAO_GESTOR_ESTAGIO").change(function() {

        if ($("#ID_ORGAO_GESTOR_ESTAGIO").val() != 0) {
            var valor = $("#ID_ORGAO_GESTOR_ESTAGIO").val().split('_');
            $("#TX_FUNCIONARIO,#TX_ENDERECO_SEC").val('');
            $.post("acoes.php", {
                ID_UNIDADE_ORG: valor[1],
                identifier: 'buscarNome'
            }, function(valor) {
                $("#TX_FUNCIONARIO").val(valor);
            });

            $.post("acoes.php", {
                ID_UNIDADE_ORG: valor[1],
                identifier: 'buscarEndereco'
            }, function(valor) {
                $("#TX_ENDERECO_SEC").val(valor);
            });

        } else {
            $("#TX_FUNCIONARIO,#TX_ENDERECO_SEC").val('');
        }
    });

    // change do  orgão solicitante - Cadastrar e Alterar
    // quando o Usuario carregar clicar no combo carrega automaticamente o campo de codigo de seleção
//    $('#ID_ORGAO_ESTAGIO_CAD').change(function() {
//        if ($('#ID_ORGAO_ESTAGIO_CAD').val() != 0) {
//            var valor = $("#ID_ORGAO_ESTAGIO_CAD").val().split('_');
//            $("#ID_SELECAO_ESTAGIO,#ID_LOTACAO").val('');
//            $('#CHECK_RESP').attr("disabled", false);
//            $.post("acoes.php", {
//                ID_ORGAO_ESTAGIO: valor[0],
//                identifier: 'codSelecao'
//            },
//            function(valor) {
//                $('#ID_SELECAO_ESTAGIO').html(valor);
//            });
//            $.post("acoes.php", {
//                NB_COD_UNIDADE: valor[1],
//                identifier: 'lotacao'
//            },
//            function(valor) {
//                $('#ID_LOTACAO').html(valor);
//            });
//        } else {
//            $('#ID_SELECAO_ESTAGIO,#ID_LOTACAO').html('');
//        }
//    });

    $("input[name=CS_SELECAO]").click(function() {
        if ($('#CHECK_RESP').is(':checked')) {

            $("#ID_QUADRO_VAGAS_ESTAGIO_2 option:first").attr('selected', 'selected');
            $('#ID_QUADRO_VAGAS_ESTAGIO_2').attr("disabled", true);
            $('#ID_SELECAO_ESTAGIO').attr("disabled", false);
            $('#ID_SELECAO_ESTAGIO').focus();

//			$("#NB_MES_INICIO,#NB_MES_FIM,#NB_ANO_INICIO,#NB_ANO_FIM").html('');
            $('#QUADRO_ID').hide();
            $('#SELECAO_ID').show();

        } else {
            $("#ID_SELECAO_ESTAGIO option:first").attr('selected', 'selected');
            $('#ID_SELECAO_ESTAGIO').attr("disabled", true);
            $('#ID_QUADRO_VAGAS_ESTAGIO_2').attr("disabled", false);
            $('#ID_QUADRO_VAGAS_ESTAGIO_2').focus();
//			$("#NB_MES_INICIO,#NB_MES_FIM,#NB_ANO_INICIO,#NB_ANO_FIM").html('');
            $('#SELECAO_ID').hide();
            $('#QUADRO_ID').show();
            $.post("acoes.php", {
                identifier: 'candidatoSemSelecao'
            },
            function(valor) {
                $('#ID_PESSOA_ESTAGIARIO').html(valor);
            });
        }
    });


    //Index
    $('#ID_ORGAO_ESTAGIO').change(function() {
        if ($('#ID_ORGAO_ESTAGIO').val() != 0) {
            var valor = $("#ID_ORGAO_ESTAGIO").val().split('_');
            $("#ID_SELECAO_ESTAGIO").val('');

            $.post("acoes.php", {
                ID_ORGAO_ESTAGIO: valor[0],
                identifier: 'codSelecaoIndex'
            },
            function(valor) {
                $('#ID_SELECAO_ESTAGIO').html(valor);
            });

        } else {
            $('#ID_SELECAO_ESTAGIO').html('');
        }
    });

    // JQuery para carregar os estagiarios no comboBox
    // Quando selecionar a seleção será carregado no combo Box do  candidatos todos que estiverem naquela seleção
    $("#ID_SELECAO_ESTAGIO").change(function() {
        if ($("#ID_SELECAO_ESTAGIO").val() != 0) {
            var valor = $("#ID_SELECAO_ESTAGIO").val().split('_');
            $("#ID_PESSOA_ESTAGIARIO,#TX_CODIGO_QUADRO_VAGAS,#ID_QUADRO_VAGAS_ESTAGIO").val('');
            $.post("acoes.php", {
                ID_SELECAO_ESTAGIO: $("#ID_SELECAO_ESTAGIO").val(),
                identifier: 'candidato'
            },
            function(valor) {
                $('#ID_PESSOA_ESTAGIARIO').html(valor);
            });
            $.post("acoes.php", {
                ID_SELECAO_ESTAGIO: $("#ID_SELECAO_ESTAGIO").val(),
                identifier: 'buscarQuadroVagas'
            },
            function(valor) {
//                console.log(valor);
//                alert(valor["ID_QUADRO_VAGAS_ESTAGIO"][0]);
                $("#TX_CODIGO_QUADRO_VAGAS").val(valor["TX_CODIGO_QUADRO_VAGAS"][0]);
                $("#ID_QUADRO_VAGAS_ESTAGIO").val(valor["ID_QUADRO_VAGAS_ESTAGIO"][0]);

            }, 'json');

        } else {
            $('#ID_PESSOA_ESTAGIARIO,#TX_CODIGO_QUADRO_VAGAS,#ID_QUADRO_VAGAS_ESTAGIO').html('');
        }
    });
    // JQuery para carregar o valor da  bolsa
    // Quando selecionar a seleção será carregado no campo tx_bolsa_estagio o valor
    $("#ID_BOLSA_ESTAGIO").change(function() {
        if ($("#ID_BOLSA_ESTAGIO").val() != 0) {

            $("#NB_VALOR").val('');
            $.post("acoes.php", {
                ID_BOLSA_ESTAGIO: $("#ID_BOLSA_ESTAGIO").val(),
                identifier: 'buscarValor'
            },
            function(valor) {
                $('#NB_VALOR').val(valor);
            });

        } else {
            $('#NB_VALOR').html('');
        }
    });
    // JQuery para carregar o cargo do supervisor
    // Quando selecionar o supervisor o cargo será carregado automaticamente
    $("#ID_PESSOA_SUPERVISOR").change(function() {
        if ($("#ID_PESSOA_SUPERVISOR").val() != 0) {

            $("#TX_CARGO").val('');
            $.post("acoes.php", {
                ID_PESSOA_SUPERVISOR: $("#ID_PESSOA_SUPERVISOR").val(),
                identifier: 'cargoSupervisor'
            },
            function(valor) {

                $('#TX_CARGO').val(valor);
            });

        } else {
            $('#TX_CARGO').html('');
        }
    });

    // JQuery Utilizado para quando selecionar o candidato trazer os documentos (CPF & RG)
    $("#ID_PESSOA_ESTAGIARIO").change(function() {

        if ($("#ID_PESSOA_ESTAGIARIO").val() != 0) {
            var valor = $("#ID_PESSOA_ESTAGIARIO").val().split('_');
            $("#NB_CPF,#NB_RG").val('');
            $.getJSON("acoes.php", {
                ID_PESSOA_ESTAGIARIO: valor[0],
                identifier: 'buscarDocuments'
            },
            function(valor) {

                $("#NB_RG").val(valor['NB_RG'][0]);
                $("#NB_CPF").val(valor['NB_CPF'][0]);
            }
            );

        } else {
            $("#NB_CPF,#NB_RG").val('');
        }
    });
});