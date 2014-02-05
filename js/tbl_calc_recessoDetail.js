$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }
    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };

    function emptyHideLoader(){
        //alert(valor);
        //console.log(valor);
        $('.fundo_pag').fadeOut(200);
        $('#TX_DURACAO_ESTAGIO,#NB_DURACAO_RECESSO,#TX_FORMULA_RECESSO').val('');

        $.getJSON('acoes.php?identifier=atualizarInf', atualizarInf);
        function atualizarInf(campo){
            //console.log(campo);
            $("#funcionario").html(campo['TX_FUNCIONARIO_ATUAL'][0]);
            $("#atualizacao").html(campo['DT_ATUALIZACAO'][0]);
        }
    };

    function showLoaderForm(){
        $('.fundoForm').fadeIn(200);
    };
    function hideLoaderForm(){
        $('.fundoForm').fadeOut(200);
    };

    $('#NB_DURACAO_RECESSO').setMask({
        mask:'9999'
    });

    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabelaTBLRecesso").load('acoes.php?identifier=tabelaTBLRecesso&PAGE='+this.id, hideLoader);
        return false;
    });

    // Inserção
    $('#inserir').live('click', function(){
        if (!$('#TX_DURACAO_ESTAGIO').val()){
            alert('Insira o Tempo de Estágio.');
            $('#TX_DURACAO_ESTAGIO').focus();
        }else if (!$('#NB_DURACAO_RECESSO').val()){
            alert('Insira a Duração do Recesso.');
            $('#NB_DURACAO_RECESSO').focus();
        }else if (!$('#TX_FORMULA_RECESSO').val()){
            alert('Insira a Fórmula.');
            $('#TX_FORMULA_RECESSO').focus();
        }else{
            //console.log();
            showLoader();
            $("#tabelaTBLRecesso").load('acoes.php',
            {
                TX_DURACAO_ESTAGIO:$('#TX_DURACAO_ESTAGIO').val(),
                NB_DURACAO_RECESSO:$('#NB_DURACAO_RECESSO').val(),
                TX_FORMULA_RECESSO:$('#TX_FORMULA_RECESSO').val(),
                identifier:'inserirTBLRecesso',
                PAGE:$('.selecionado').text()
            }, emptyHideLoader);
        }
        return false;
    });

    //Exclusão
    $('#excluir').live('click', function(){
        var href = $(this).attr('href');

        resp = window.confirm('Tem certeza que deseja excluir este Registro?');
        if (resp){
            showLoader();
            $("#tabelaTBLRecesso").load('acoes.php',
            {
                NB_ITEM_TAB_RECESSO:href,
                identifier:'excluirTBLRecesso',
                PAGE:$('.selecionado').text()
            }, emptyHideLoader);
        }
        return false;
    });

    // Alterar
    $('#alterar').live('click', function(){
        var href = $(this).attr('href');

        $("#dialog").dialog("open");
        $('#tabelaAlterarTBLRecesso').html('');
        //console.log();
        showLoaderForm();
        $('#tabelaAlterarTBLRecesso').load('acoes.php',
        {
            NB_ITEM_TAB_RECESSO:href,
            identifier:'tabelaAlterarTBLRecesso'
        }, hideLoaderForm);

        return false;
    });

    $("#dialog").dialog({
        autoOpen: false,
        height: 400,
        width: 420,
        modal: true,
        buttons:{
            "Salvar": function() {
                if (!$('#TX_DURACAO_ESTAGIO_ALT').val()){
                    alert('Insira o Tempo de Estágio.');
                    $('#TX_DURACAO_ESTAGIO_ALT').focus();
                }else if (!$('#NB_DURACAO_RECESSO_ALT').val()){
                    alert('Insira a Duração do Recesso.');
                    $('#NB_DURACAO_RECESSO_ALT').focus();
                }else if (!$('#TX_FORMULA_RECESSO_ALT').val()){
                    alert('Insira a Fórmula.');
                    $('#TX_FORMULA_RECESSO_ALT').focus();
                }else{
                    //console.log();
                    showLoader();
                    $("#tabelaTBLRecesso").load('acoes.php',
                    {
                        NB_ITEM_TAB_RECESSO:$('#NB_ITEM_TAB_RECESSO_ALT').val(),
                        TX_DURACAO_ESTAGIO:$('#TX_DURACAO_ESTAGIO_ALT').val(),
                        NB_DURACAO_RECESSO:$('#NB_DURACAO_RECESSO_ALT').val(),
                        TX_FORMULA_RECESSO:$('#TX_FORMULA_RECESSO_ALT').val(),
                        identifier:'alterarTBLRecesso',
                        PAGE:$('.selecionado').text()
                    }, emptyHideLoader);
                    $(this).dialog("close");
                };
            },
            "Cancelar": function() {
                $('#tabelaAlterarTBLRecesso').html('');
                $(this).dialog("close");
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
    $("#tabelaTBLRecesso").load('acoes.php?identifier=tabelaTBLRecesso', hideLoader);
});