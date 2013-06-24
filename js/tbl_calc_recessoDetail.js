$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }
    function hideLoader(){
        $('.fundo_pag').fadeOut(200);

        $.post("acoes.php?identifier=pesquisarTipoVaga", TipoVaga);
    };

    function emptyHideLoader(){
        $('.fundo_pag').fadeOut(200);
        $('#NB_QUANTIDADE').val('');
        $('#ID_CURSO_ESTAGIO').html('');

        $.post("acoes.php?identifier=pesquisarTipoVaga", TipoVaga);

        //$("#ID_UNIDADE_IRP option:first").attr('selected','selected');

        $.getJSON('acoes.php?identifier=atualizarInf', atualizarInf);
        function atualizarInf(campo){
            //console.log(campo);
            $("#funcionario").html(campo['TX_FUNCIONARIO_ATUAL'][0]);
            $("#atualizacao").html(campo['DT_ATUALIZACAO'][0]);
        }
    };

    function TipoVaga(valor){
        //alert(valor);
        //console.log(valor);
        $("#ID_CS_CODIGO").html(valor);
    };

    function showLoaderForm(){
        $('.fundoForm').fadeIn(200);
    };
    function hideLoaderForm(){
        $('.fundoForm').fadeOut(200);
    };

    $('#NB_QUANTIDADE').setMask({
        mask:'999999'
    });

    $('#ID_CS_CODIGO').change(function(){
        if ($('#ID_CS_CODIGO').val()){
            var valor = $('#ID_CS_CODIGO').val().split('_');
            //alert(valor);
            //console.log(valor);
            //            $.post("acoes.php",
            //            {
            //                CS_TIPO_VAGA_ESTAGIO:valor[0],
            //                ID_CURSO_ESTAGIO:valor[1],
            //                NB_QUANTIDADE:valor[2],
            //                identifier:'buscarQuantidade'
            //            }, function(valor){
            //                //alert(valor);
            //                $("#NB_QUANTIDADE").val(valor);
            //            });
            $("#ID_CURSO_ESTAGIO").html('<option value="">Carregando ...</option>');
            $.post("acoes.php",
            {
                ID_CURSO_ESTAGIO:valor[1],
                identifier:'buscarCursos'
            }, function(valor){
                $("#ID_CURSO_ESTAGIO").html(valor);
            });
            $("#NB_QUANTIDADE").val(valor[2]);
            $("#NB_QUANTIDADE").focus();
        }
    });

    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabelaVagasSolicitadas").load('acoes.php?identifier=tabelaVagasSolicitadas&PAGE='+this.id, hideLoader);
        return false;
    });

    // Inserção de Vagas de Estágio
    $('#inserir').live('click', function(){
        if (!$('#ID_CS_CODIGO').val()){
            alert('Para inserir escolha um Tipo.');
            $('#ID_CS_CODIGO').focus();
        }else if (!$('#NB_QUANTIDADE').val()){
            alert('Para inserir escolha uma Quantidade.');
            $('#NB_QUANTIDADE').focus();
        }else{
            showLoader();
            $("#tabelaVagasSolicitadas").load('acoes.php',
            {
                ID_CS_CODIGO:$('#ID_CS_CODIGO').val(),
                NB_QUANTIDADE:$('#NB_QUANTIDADE').val(),
                ID_CURSO_ESTAGIO:$('#ID_CURSO_ESTAGIO').val(),
                identifier:'inserirVagasSolicitadas',
                PAGE:$('.selecionado').text()
            }, emptyHideLoader);
        }
        return false;
    });
    /*
	$('#inserirTodos').live('click', function(){
		showLoader();
		$("#tabelaUnidadeConsumidora").load('acoes.php?identifier=inserirTodas', hideLoader);
        return false;
    });
         */
    //Exclusão de Vagas de Estágio
    $('#excluir').live('click', function(){
        var href = $(this).attr('href');

        resp = window.confirm('Tem certeza que deseja excluir este Registro?');
        if (resp){
            showLoader();
            $("#tabelaVagasSolicitadas").load('acoes.php',
            {
                CS_TIPO_VAGA_ESTAGIO:href,
                identifier:'excluirVagasSolicitadas',
                PAGE:$('.selecionado').text()
            }, emptyHideLoader);
        }
        return false;
    });

    $('#alterar').live('click', function(){
        var href = $(this).attr('href');

        $("#dialog").dialog("open");

        $('#tabelaAlterarVagasSolicitadas').html('');
        showLoaderForm();
        $('#tabelaAlterarVagasSolicitadas').load('acoes.php',
        {
            CS_TIPO_VAGA_ESTAGIO:href,
            identifier:'tabelaAlterarVagasSolicitadas'
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
                if (!$('#NB_QUANTIDADE_ALT').val()){
                    alert('Para inserir escolha uma Quantidade.');
                    $('#NB_QUANTIDADE_ALT').focus();
                }else{
                    console.log();
                    showLoader();
                    $("#tabelaVagasSolicitadas").load('acoes.php',
                    {
                        CS_TIPO_VAGA_ESTAGIO:$('#CS_TIPO_VAGA_ESTAGIO_ALT').val(),
                        NB_QUANTIDADE:$('#NB_QUANTIDADE_ALT').val(),
                        ID_CURSO_ESTAGIO:$('#ID_CURSO_ESTAGIO_ALT').val(),
                        identifier:'alterarVagasSolicitadas',
                        PAGE:$('.selecionado').text()
                    }, emptyHideLoader);
                    $( this ).dialog("close");
                };
            },
            "Cancelar": function() {
                $('#tabelaAlterarVagasSolicitadas').html('');
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
    $("#tabelaVagasSolicitadas").load('acoes.php?identifier=tabelaVagasSolicitadas', hideLoader);
});