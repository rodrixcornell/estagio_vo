$(document).ready(function() {

    function showLoader() {
        $('.fundo_pag').fadeIn(200);
    }
    function hideLoader() {
        $('.fundo_pag').fadeOut(200);
    }
    function emptyHideLoader() {
        $('.fundo_pag').fadeOut(200);
//        $("#ESTAGIARIO_SELECAO option:first").attr('selected', 'selected');
//        $("#CS_SITUACAO option:first").attr('selected', 'selected');

        $("#TX_NOME,#NB_RG,#DT_NASCIMENTO,#CS_SEXO,#TX_CEP,#TX_ENDERECO,#NB_NUMERO,#TX_BAIRRO,#TX_COMPLEMENTO").val('');
        $("#TX_CONTATO,#TX_EMAIL,#TX_AGENCIA,#TX_CONTA_CORRENTE,#ID_PESSOA_ESTAGIARIO").val('');

        $("#CS_SITUACAO,#TX_AGENCIA,#TX_CONTA_CORRENTE,#CS_ESCOLARIDADE,#ID_CURSO_ESTAGIO,#NB_PERIODO_ANO,#CS_TURNO,#ID_INSTITUICAO_ENSINO").val('');
        $("#ID_ORGAO_ESTAGIO,#CS_TIPO_VAGA_ESTAGIO,#TX_HORA_INICIO,#TX_HORA_FINAL,#ID_BOLSA_ESTAGIO,#ID_PESSOA_SUPERVISOR,#ID_PESSOA_ESTAGIARIO").val('');

        $.getJSON('acoes.php?identifier=atualizarInf', atualizarInf);
        function atualizarInf(campo) {
            $("#atualizacao").html(campo['DT_ATUALIZACAO'][0]);
            $("#funcionario").html(campo['TX_FUNCIONARIO_ATUALIZACAO'][0]);
        }
    }

    function showLoaderForm() {
        $('.fundoForm').fadeIn(200);
    }
    function hideLoaderForm() {
        $('.fundoForm').fadeOut(200);
    }

    //Excluir Master
    $('#excluirMaster').click(function() {
        if ($('.icones').length) {
            alert('Este registro não pode ser excluído pois possui dependentes.');
            return false;
        } else {
            resp = window.confirm('Tem certeza que deseja excluir este Registro?');
            if (!resp) {
                return false;
            }
        }
    });

    $("#efetivar").live('click', function() {
        if (!$('.icones').length) {
            alert('Este registro não pode ser Efetivado pois Não possui Candidato.');
            return false;
        }
        else if (!($('.qtdAprov').text() <= $('.quantidade').text())){
            alert('Quantidade de Candidatos Aprovado é maior que Número de Vagas.');
            return false;
        }
        else if (!$('.qtdAprov').text()){
            alert('Este registro não pode ser Efetivado pois Não possui Candidato Aprovado.');
            return false;
        }
        else if ($('.qtdAnalise').text()){
            alert('Existe Candidato em Análise.');
            return false;
        }
        else {
//            alert($('.quantidade').text());
//            alert($('.qtdAprov').text());
//            alert($('.icones').length);
            resp = window.confirm('Tem certeza que deseja Efetivar esta Seleção de Candidatos?');
            if (resp1)
                $('#form').submit();
            else
                return false;
        }
    });

    $("#encaminhar").live('click', function() {
        resp = window.confirm('Tem certeza que deseja Encaminhar esta Oferta de Vaga para a Agência de Estágio?');
        if (resp)
            $('#form').submit();
        else
            return false;
    });

//------------------------------------------------------------------------------
    $("#paginacao li").live('click', function() {
        showLoader();
        $("#tabelaCandidato").load('acoes.php', {
            PAGE: this.id,
            identifier: 'tabelaCandidato'
        }, hideLoader);
        return false;
    });

    showLoader();
    $("#tabelaCandidato").load('acoes.php', {
        identifier: 'tabelaCandidato'
    }, hideLoader);

//------------------------------------------------------------------------------
    $("#dialog-form-candidato").dialog({
        autoOpen: false,
        height: 380,
        width: 800,
        modal: true,
        closeOnEscape: false,
        open: function(event, ui) {
            // Hide close button
            $(this).parent().children().children(".ui-dialog-titlebar-close").hide();
            $('.ui-dialog-buttonset').find('button:contains("Salvar")').addClass('salvar');
            $('.ui-dialog-buttonset').find('button:contains("Cancelar")').addClass('cancelar');
            //$('.ui-icon-closethick').find('button:contains("close")').addClass('close');
        },
        buttons: {
            "Salvar": function() {
                // função para inserir Candidato a Seleção
                function inserirCandidato(campo) {

                    if (campo['ID_PESSOA_ESTAGIARIO']) {
                        //alert(campo['ID_PESSOA_ESTAGIARIO']);
                        $('#tabelaCandidato').load('acoes.php', {
                            ID_PESSOA_ESTAGIARIO: campo['ID_PESSOA_ESTAGIARIO'][0],
                            identifier: 'inserirCandidato'
                        }, emptyHideLoader);
                    } else {
                        alert(campo);
                        hideLoader();
                        $(".cancelar").focus();
                    }
                }

                // Teste de Validação
                //alert(parseInt($("#ID_PESSOA").val())+' - '+parseInt($("#ID_PESSOA_ESTAGIARIO").val()));
                if ($("#NB_CPF").val() == '') {
                    alert('Para inserir preencha CPF Válido.');
                    $("#NB_CPF").focus();
                } else if ($("#TX_NOME").val() == '') {
                    alert('Para inserir preencha Nome.');
                    $("#TX_NOME").focus();
                } else if ($("#DT_NASCIMENTO").val() == '') {
                    alert('Para inserir preencha Data.');
                    $("#DT_NASCIMENTO").focus();
                } else if ($("#CS_SEXO").val() == '') {
                    alert('Para inserir preencha Sexo.');
                    $("#CS_SEXO").focus();
                } else if ($("#TX_CEP").val() == '') {
                    alert('Para inserir preencha CEP.');
                    $("#TX_CEP").focus();
                } else if ($("#ID_PESSOA").val() == '') {
                    showLoader();
                    $.getJSON('acoes.php', {
                        NB_CPF: $("#NB_CPF").val(), TX_NOME: $("#TX_NOME").val(), NB_RG: $("#NB_RG").val(), DT_NASCIMENTO: $("#DT_NASCIMENTO").val(),
                        CS_SEXO: $("#CS_SEXO").val(), TX_CEP: $("#TX_CEP").val(), TX_ENDERECO: $("#TX_ENDERECO").val(), NB_NUMERO: $("#NB_NUMERO").val(),
                        TX_BAIRRO: $("#TX_BAIRRO").val(), TX_COMPLEMENTO: $("#TX_COMPLEMENTO").val(), TX_CONTATO: $("#TX_CONTATO").val(),
                        TX_EMAIL: $("#TX_EMAIL").val(), TX_AGENCIA: $("#TX_AGENCIA").val(), TX_CONTA_CORRENTE: $("#TX_CONTA_CORRENTE").val(),
                        identifier: 'inserirEstagiario'
                    }, inserirCandidato);
                    //alert('inserido e add a seleção');
                    $(this).dialog("close");
                } else {
                    //alert($("#ID_PESSOA").val()+' - '+$("#ID_PESSOA_ESTAGIARIO").val());
                    showLoader();
                    $.getJSON('acoes.php', {
                        NB_CPF: $("#NB_CPF").val(), TX_NOME: $("#TX_NOME").val(), NB_RG: $("#NB_RG").val(), DT_NASCIMENTO: $("#DT_NASCIMENTO").val(),
                        CS_SEXO: $("#CS_SEXO").val(), TX_CEP: $("#TX_CEP").val(), TX_ENDERECO: $("#TX_ENDERECO").val(), NB_NUMERO: $("#NB_NUMERO").val(),
                        TX_BAIRRO: $("#TX_BAIRRO").val(), TX_COMPLEMENTO: $("#TX_COMPLEMENTO").val(), TX_CONTATO: $("#TX_CONTATO").val(),
                        TX_EMAIL: $("#TX_EMAIL").val(), TX_AGENCIA: $("#TX_AGENCIA").val(), TX_CONTA_CORRENTE: $("#TX_CONTA_CORRENTE").val(),
                        ID_PESSOA_ESTAGIARIO: $("#ID_PESSOA_ESTAGIARIO").val(), ID_PESSOA: $("#ID_PESSOA").val(),
                        identifier: 'atualizarEstagiario'
                    }, inserirCandidato);
                    //alert('atualizar e add a seleção');
                    $(this).dialog("close");
                }
            },
            "Cancelar": function() {
                $("#TX_NOME,#NB_RG,#DT_NASCIMENTO,#CS_SEXO,#TX_CEP,#TX_ENDERECO,#NB_NUMERO,#TX_BAIRRO,#TX_COMPLEMENTO").val('');
                $("#TX_CONTATO,#TX_EMAIL,#TX_AGENCIA,#TX_CONTA_CORRENTE,#ID_PESSOA_ESTAGIARIO").val('');
                $('#form_candidato').html('');
                $(this).dialog("close");
            }
        }
    });

    $("#inserir").live('click', function() {
        $("#dialog-form-candidato").dialog("open");
        $('#form_candidato').html('');
        showLoaderForm();
        $('#form_candidato').load('acoes.php', {
            identifier: 'formInserirCandidato'
        }, hideLoaderForm);
        return false;
    });

//------------------------------------------------------------------------------
    $('#excluirCandidato').live('click', function() {
        var href = $(this).attr('href');

        resp = window.confirm('Tem certeza que deseja excluir este Registro?');
        if (resp) {
            showLoader();
            $("#tabelaCandidato").load('acoes.php', {
                identifier: 'excluirCandidato',
                ID_PESSOA_ESTAGIARIO: href,
                PAGE: $('.selecionado').text()
            }, emptyHideLoader);
        }
        return false;
    });

//------------------------------------------------------------------------------
    $("#dialog-form-alterar-candidato").dialog({
        autoOpen: false,
        height: 830,
        width: 510,
        modal: true,
        closeOnEscape: false,
        open: function(event, ui) {
            // Hide close button
            $(this).parent().children().children(".ui-dialog-titlebar-close").hide();
            $('.ui-dialog-buttonset').find('button:contains("Salvar")').addClass('salvar');
            $('.ui-dialog-buttonset').find('button:contains("Cancelar")').addClass('cancelar');
            //$('.ui-icon-closethick').find('button:contains("close")').addClass('close');
        },
        buttons: {
            "Salvar": function() {

                if ($("#CS_SITUACAO").val() == 1) {
                    $('#form_alterar_candidato').html('');
                    $(this).dialog("close");
                } else if ($("#CS_SITUACAO").val() == '') {
                    alert('Para inserir Escolha Situação.');
                    $('#TX_MOTIVO_SITUACAO').focus();
                } else if ($("#CS_SITUACAO").val() == 3 || $("#CS_SITUACAO").val() == 4) {
                    if ($('#TX_MOTIVO_SITUACAO').val() == '') {
                        alert('Para inserir Preencha Motivo.');
                        $('#TX_MOTIVO_SITUACAO').focus();
                    } else {
                        showLoader();
                        $('#tabelaCandidato').load('acoes.php', {
                            CS_SITUACAO: $("#CS_SITUACAO").val(),
                            TX_MOTIVO_SITUACAO: $("#TX_MOTIVO_SITUACAO").val(),
                            ID_PESSOA_ESTAGIARIO: $("#ID_PESSOA_ESTAGIARIO").val(),
                            identifier: 'alterarCandidato'
                        }, emptyHideLoader);
                        $(this).dialog("close");
                    }
                } else if ($("#CS_SITUACAO").val() == 2) {
                    if ($('#form_alterar_candidato #TX_AGENCIA').val() == '') {
                        alert('Para inserir Preencha Agencia.');
                        $('#form_alterar_candidato #TX_AGENCIA').focus();
                    } else if ($('#form_alterar_candidato #TX_CONTA_CORRENTE').val() == '') {
                        alert('Para inserir Preencha Conta Corrente.');
                        $('#form_alterar_candidato #TX_CONTA_CORRENTE').focus();
                    } else if ($('#CS_ESCOLARIDADE').val() == '') {
                        alert('Para inserir Escolha Nível Escolar.');
                        $('#CS_ESCOLARIDADE').focus();
                    } else if ($('#ID_CURSO_ESTAGIO').val() == '') {
                        alert('Para inserir Escolha Curso.');
                        $('#ID_CURSO_ESTAGIO').focus();
                    } else if ($('#NB_PERIODO_ANO').val() == '') {
                        alert('Para inserir Preencha Período/Ano.');
                        $('#NB_PERIODO_ANO').focus();
                    } else if ($('#CS_TURNO').val() == '') {
                        alert('Para inserir Escolha Turno.');
                        $('#CS_TURNO').focus();
                    } else if ($('#ID_INSTITUICAO_ENSINO').val() == '') {
                        alert('Para inserir Escolha Instituição.');
                        $('#ID_INSTITUICAO_ENSINO').focus();
                    } else if ($('#ID_ORGAO_ESTAGIO').val() == '') {
                        alert('Para inserir Escolha Orgão Municipal.');
                        $('#ID_ORGAO_ESTAGIO').focus();
                    } else if ($('#CS_TIPO_VAGA_ESTAGIO').val() == '') {
                        alert('Para inserir Escolha Carga Horária.');
                        $('#CS_TIPO_VAGA_ESTAGIO').focus();
                    } else if ($('#TX_HORA_INICIO').val() == '') {
                        alert('Para inserir Preencha Horário Inicial do Estágio.');
                        $('#TX_HORA_INICIO').focus();
                    } else if ($('#TX_HORA_FINAL').val() == '') {
                        alert('Para inserir Preencha Horário Final do Estágio.');
                        $('#TX_HORA_FINAL').focus();
                    } else if ($('#ID_BOLSA_ESTAGIO').val() == '') {
                        alert('Para inserir Escolha Valor da Bolsa.');
                        $('#ID_BOLSA_ESTAGIO').focus();
                    } else if ($('#ID_PESSOA_SUPERVISOR').val() == '') {
                        alert('Para inserir Escolha Supervisor.');
                        $('#ID_PESSOA_SUPERVISOR').focus();
                    } else {
                        showLoader();
                        $('#tabelaCandidato').load('acoes.php', {
                            CS_SITUACAO: $("#CS_SITUACAO").val(),
                            TX_AGENCIA: $("#TX_AGENCIA").val(),
                            TX_CONTA_CORRENTE: $("#TX_CONTA_CORRENTE").val(),
                            CS_ESCOLARIDADE: $("#CS_ESCOLARIDADE").val(),
                            ID_CURSO_ESTAGIO: $("#ID_CURSO_ESTAGIO").val(),
                            NB_PERIODO_ANO: $("#NB_PERIODO_ANO").val(),
                            CS_TURNO: $("#CS_TURNO").val(),
                            ID_INSTITUICAO_ENSINO: $("#ID_INSTITUICAO_ENSINO").val(),
                            ID_ORGAO_ESTAGIO: $("#ID_ORGAO_ESTAGIO").val(),
                            CS_TIPO_VAGA_ESTAGIO: $("#CS_TIPO_VAGA_ESTAGIO").val(),
                            TX_HORA_INICIO: $("#TX_HORA_INICIO").val(),
                            TX_HORA_FINAL: $("#TX_HORA_FINAL").val(),
                            ID_BOLSA_ESTAGIO: $("#ID_BOLSA_ESTAGIO").val(),
                            ID_PESSOA_SUPERVISOR: $("#ID_PESSOA_SUPERVISOR").val(),
                            ID_PESSOA_ESTAGIARIO: $("#ID_PESSOA_ESTAGIARIO").val(),
                            identifier: 'alterarCandidato'
                        }, emptyHideLoader);
                        $(this).dialog("close");
                    }
                }
            },
            "Cancelar": function() {
                $("#CS_SITUACAO,#TX_AGENCIA,#TX_CONTA_CORRENTE,#CS_ESCOLARIDADE,#ID_CURSO_ESTAGIO,#NB_PERIODO_ANO,#CS_TURNO,#ID_INSTITUICAO_ENSINO").val('');
                $("#ID_ORGAO_ESTAGIO,#CS_TIPO_VAGA_ESTAGIO,#TX_HORA_INICIO,#TX_HORA_FINAL,#ID_BOLSA_ESTAGIO,#ID_PESSOA_SUPERVISOR,#ID_PESSOA_ESTAGIARIO").val('');
                $('#form_alterar_candidato').html('');
                $(this).dialog("close");
            }
        }
    });

    $("#alterarCandidato").live('click', function() {
        //var href = $(this).attr('href');
        $("#dialog-form-alterar-candidato").dialog("open");
        $('#form_alterar_candidato').html('');
        showLoaderForm();
        $('#form_alterar_candidato').load('acoes.php', {
            ID_PESSOA_ESTAGIARIO: $(this).attr('href'),
            identifier: 'formAlterarCandidato'
        }, hideLoaderForm);
        return false;
    });

//    $("#efetivar").live('click', function() {
//        if ($('.icones').length) {
//            resp = window.confirm('Tem certeza que deseja Efetivar esta Seleção?');
//            if (resp) {
//                showLoader();
//                return true;
//            }
//            return false;
//        } else {
//            alert('Para Efetivar uma Seleção adicione pelo menos um candidato.');
//            return false;
//        }
//    });

    /*$('#inserir').live('click', function() {
     if (!$('#NB_CANDIDATO').val()) {
     alert('Para inserir escolha um Candidato.');
     $('#NB_CANDIDATO').focus();
     } else {
     showLoader();
     $("#tabelaCandidato").load('acoes.php',
     {
     NB_CANDIDATO:$('#NB_CANDIDATO').val(),
     identifier:'inserirCandidato',
     PAGE: $('.selecionado').text()
     }, emptyHideLoader);
     }
     return false;
     });*/

//    $('#CS_SITUACAO').live('change', function() {
//        if ((($('#CS_SITUACAO').val() == 3) || ($('#CS_SITUACAO').val() == 4))) {
//            $('#motivo').show("slow");
//        } else {
//            $("#motivo").hide("slow");
//            $("#TX_MOTIVO_SITUACAO").val('');
//        }
//    });

//    $('#inserir').live('click', function() {
//        if (!$('#ESTAGIARIO_SELECAO').val()) {
//            alert('Para inserir escolha um Candidato.');
//            $('#ESTAGIARIO_SELECAO').focus();
//        } else {
//            if (!$('#DT_AGENDAMENTO').val()) {
//                alert('Para inserir preencha uma Data de Agendamento.');
//                $('#DT_AGENDAMENTO').focus();
//            } else {
//                if (!$('#DT_REALIZACAO').val()) {
//                    alert('Para inserir preencha uma Data de Realização.');
//                    $('#DT_REALIZACAO').focus();
//                } else {
//                    if ($('#DT_AGENDAMENTO').val() > $('#DT_REALIZACAO').val()) {
//                        alert('Para inserir, a Data de Agendamento não pode ser maior que a Data de Realização.');
//                        $('#DT_AGENDAMENTO').focus();
//                    } else {
//                        if (!$('#CS_SITUACAO').val()) {
//                            alert('Para inserir escolha uma Situação.');
//                            $('#CS_SITUACAO').focus();
//                        } else {
//                            if ((($('#CS_SITUACAO').val() == 3) || ($('#CS_SITUACAO').val() == 4)) && (!$('#TX_MOTIVO_SITUACAO').val())) {
//                                alert('Para inserir preencha um Motivo.');
//                                $('#TX_MOTIVO_SITUACAO').focus();
//                            } else {
//                                showLoader();
//                                $("#tabelaCandidato").load('acoes.php?identifier=inserirCandidato', {
//                                    ESTAGIARIO_SELECAO: $('#ESTAGIARIO_SELECAO').val(),
//                                    DT_REALIZACAO: $('#DT_REALIZACAO').val(),
//                                    DT_AGENDAMENTO: $('#DT_AGENDAMENTO').val(),
//                                    CS_SITUACAO: $('#CS_SITUACAO').val(),
//                                    TX_MOTIVO_SITUACAO: $('#TX_MOTIVO_SITUACAO').val(),
//                                    PAGE: $('.selecionado').text()
//                                }, emptyHideLoader);
//                            }
//                        }
//                    }
//                }
//            }
//        }
//        return false;
//    });

    // Inserção de Acesso
    /* $('#ESTAGIARIO_SELECAO').live('click', function(){
     $("#pesquisarCandidatos").load('acoes.php?identifier=pesquisarCandidatos&ID_ORGAO_ESTAGIO='+$('#ID_ORGAO_ESTAGIO').val()+'&PAGE='+$('.selecionado').text(), emptyHideLoader);
     });*/

    // Inserção de Acesso



//    $( document ).tooltip();


});