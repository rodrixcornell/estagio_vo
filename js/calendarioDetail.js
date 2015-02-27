$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }
    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };
    function showLoaderForm(){
        $('.fundoForm').fadeIn(200);
    };
    function hideLoaderForm(){
        $('.fundoForm').fadeOut(200);
    };

    function emptyHideLoader(){
        $('.fundo_pag').fadeOut(200);
        $('#DT_FECHAMENTO,#DT_ENCAM_DOC,#DT_TRANSF_BANCO,#DT_PAGAMENTO,#DT_INICIO_TRANSF_ESTAG,#DT_FIM_TRANSF_ESTAG').val('');

        $.post("acoes.php?identifier=pesquisarGrupoPagamento",GrupoPagamento);

        function GrupoPagamento(valor){
            //console.log(valor);
            $("#ID_GRUPO_PAGAMENTO").html(valor);
        }

        $.getJSON('acoes.php?identifier=atualizarInf', atualizarInf);

        function atualizarInf(campo){
            //console.log(campo);
            //$("#funcionario").html(campo['TX_FUNCIONARIO_ATUAL'][0]);
            $("#atualizacao").html(campo['DT_ATUALIZACAO'][0]);
        }

    };

    $('#DT_FECHAMENTO,#DT_ENCAM_DOC,#DT_TRANSF_BANCO,#DT_PAGAMENTO,#DT_INICIO_TRANSF_ESTAG,#DT_FIM_TRANSF_ESTAG').setMask({
        mask:'99/99/9999'
    });

    $('#DT_FECHAMENTO,#DT_ENCAM_DOC,#DT_TRANSF_BANCO,#DT_PAGAMENTO,#DT_INICIO_TRANSF_ESTAG,#DT_FIM_TRANSF_ESTAG').datepicker({
        changeMonth: true,
        changeYear: true
    });

    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabelaItemCalendario").load('acoes.php?identifier=tabelaItemCalendario&PAGE='+this.id, hideLoader);
        return false;
    });

    // Inserção de Detail
    $('#inserir').live('click', function(){
        if (!$('#ID_GRUPO_PAGAMENTO').val()){
            alert('Para inserir escolha o Grupo Pagamento.');
            $('#ID_GRUPO_PAGAMENTO').focus();
        }else if (!$('#DT_FECHAMENTO').val()){
            alert('Para inserir escolha a Data Fechamento.');
            $('#DT_FECHAMENTO').focus();
        }else if (!$('#DT_ENCAM_DOC').val()){
            alert('Para inserir escolha a Data Encam. Doc.');
            $('#DT_ENCAM_DOC').focus();
        }else if (!$('#DT_TRANSF_BANCO').val()){
            alert('Para inserir escolha a Data Transf. Banco.');
            $('#DT_TRANSF_BANCO').focus();
        }else if (!$('#DT_INICIO_TRANSF_ESTAG').val()){
            alert('Para inserir escolha a Data\nInício Transf. Estagiário.');
            $('#DT_INICIO_TRANSF_ESTAG').focus();
        }else if (!$('#DT_FIM_TRANSF_ESTAG').val()){
            alert('Para inserir escolha a Data\nFim Transf. Estagiário.');
            $('#DT_FIM_TRANSF_ESTAG').focus();
        }else if (!$('#DT_PAGAMENTO').val()){
            alert('Para inserir escolha a Data Pagamento.');
            $('#DT_PAGAMENTO').focus();
        }else{
            showLoader();
            $("#tabelaItemCalendario").load('acoes.php',
            {
                ID_GRUPO_PAGAMENTO:$('#ID_GRUPO_PAGAMENTO').val(),
                DT_FECHAMENTO:$('#DT_FECHAMENTO').val(),
                DT_ENCAM_DOC:$('#DT_ENCAM_DOC').val(),
                DT_TRANSF_BANCO:$('#DT_TRANSF_BANCO').val(),
                DT_PAGAMENTO:$('#DT_PAGAMENTO').val(),
                DT_INICIO_TRANSF_ESTAG:$('#DT_INICIO_TRANSF_ESTAG').val(),
                DT_FIM_TRANSF_ESTAG:$('#DT_FIM_TRANSF_ESTAG').val(),
                identifier:'inserirItemCalendario',
                PAGE:$('.selecionado').text()
            }, emptyHideLoader);
        }
        return false;
    });

    //Exclusão de Detail
    $('#excluir').live('click', function(){
        var href = $(this).attr('href');

        resp = window.confirm('Tem certeza que deseja excluir este Registro?');
        if (resp){
            showLoader();
            $("#tabelaItemCalendario").load('acoes.php',
            {
                ID_GRUPO_PAGAMENTO:href,
                identifier:'excluirItemCalendario',
                PAGE:$('.selecionado').text()
            }, emptyHideLoader);
        }
        return false;
    });

    //Alteração de Detail
    $('#alterar').live('click', function(){
        var href = $(this).attr('href');

        $("#dialog").dialog("open");
        $('#tabelaAlterarItemCalendario').html('');
        showLoaderForm();
        $('#tabelaAlterarItemCalendario').load('acoes.php',{
            ID_GRUPO_PAGAMENTO:href,
            NB_NOT_IN:1,
            identifier:'tabelaAlterarItemCalendario'
        }, hideLoaderForm);
        return false;
    });

    $("#dialog").dialog({
        autoOpen: false,
        height: 260,
        width: 670,
        modal: true,
        buttons:{
            "Salvar": function() {
                if (!$('#ID_GRUPO_PAGAMENTO_ALT').val()){
                    alert('Para inserir escolha o Grupo Pagamento.');
                    $('#ID_GRUPO_PAGAMENTO_ALT').focus();
                }else if (!$('#DT_FECHAMENTO_ALT').val()){
                    alert('Para inserir escolha a Data Fechamento.');
                    $('#DT_FECHAMENTO_ALT').focus();
                }else if (!$('#DT_ENCAM_DOC_ALT').val()){
                    alert('Para inserir escolha a Data Encam. Doc.');
                    $('#DT_ENCAM_DOC_ALT').focus();
                }else if (!$('#DT_TRANSF_BANCO_ALT').val()){
                    alert('Para inserir escolha a Data Transf. Banco.');
                    $('#DT_TRANSF_BANCO_ALT').focus();
                }else if (!$('#DT_INICIO_TRANSF_ESTAG_ALT').val()){
                    alert('Para inserir escolha a Data\nInício Transf. Estagiário.');
                    $('#DT_INICIO_TRANSF_ESTAG_ALT').focus();
                }else if (!$('#DT_FIM_TRANSF_ESTAG_ALT').val()){
                    alert('Para inserir escolha a Data\nFim Transf. Estagiário.');
                    $('#DT_FIM_TRANSF_ESTAG_ALT').focus();
                }else if (!$('#DT_PAGAMENTO_ALT').val()){
                    alert('Para inserir escolha a Data Pagamento.');
                    $('#DT_PAGAMENTO_ALT').focus();
                }else{
                    showLoader();
                    $("#tabelaItemCalendario").load('acoes.php',
                    {
                        ID_GRUPO_PAGAMENTO_OLD:$('#ID_GRUPO_PAGAMENTO_OLD').val(),
                        ID_GRUPO_PAGAMENTO:$('#ID_GRUPO_PAGAMENTO_ALT').val(),
                        DT_FECHAMENTO:$('#DT_FECHAMENTO_ALT').val(),
                        DT_ENCAM_DOC:$('#DT_ENCAM_DOC_ALT').val(),
                        DT_TRANSF_BANCO:$('#DT_TRANSF_BANCO_ALT').val(),
                        DT_PAGAMENTO:$('#DT_PAGAMENTO_ALT').val(),
                        DT_INICIO_TRANSF_ESTAG:$('#DT_INICIO_TRANSF_ESTAG_ALT').val(),
                        DT_FIM_TRANSF_ESTAG:$('#DT_FIM_TRANSF_ESTAG_ALT').val(),
                        identifier:'alterarItemCalendario',
                        PAGE:$('.selecionado').text()
                    }, emptyHideLoader);
                    $( this ).dialog("close");
                };
            },
            "Cancelar": function() {
                $('#tabelaAlterarItemCalendario').html('');
                $( this ).dialog( "close" );
            }
        }
    });

    //Excluir Master
    $('#excluirMaster').click(function(){

        if ($('.icones').length){
            alert('Este registro não pode ser excluído pois possui dependentes.');
            return false;
        }else{
            resp = window.confirm('Tem certeza que deseja excluir este Registro?');
            if (!resp){
                return false;
            }
        }

    });

    showLoader();
    $("#tabelaItemCalendario").load('acoes.php?identifier=tabelaItemCalendario', hideLoader);
});