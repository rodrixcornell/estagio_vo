$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }
    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };

    function emptyHideLoader(){
        $('.fundo_pag').fadeOut(200);
    //        $("#ID_UNIDADE_IRP option:first").attr('selected','selected');
    //
    //        $.getJSON('acoes.php?identifier=atualizarInf', atualizarInf);
    //        function atualizarInf(campo){
    //            $("#atualizacao").html(campo['DT_ATUALIZACAO'][0]);
    //        }

    };

    $('#NB_QUANTIDADE').setMask({
        mask:'999999'
    });

    $('#ID_CS_CODIGO').change(function(){
        if ($('#ID_CS_CODIGO').val()){
            var valor = $('#ID_CS_CODIGO').val().split('_');
            //alert(valor);
            //console.log(valor);
            $("#ID_CURSO_ESTAGIO").html('<option value="">Carregando ...</option>');
            $.post("acoes.php",
            {
                ID_QUADRO_VAGAS_ESTAGIO:valor[0],
                CS_TIPO_VAGA_ESTAGIO:valor[1],
                identifier:'buscarQuantidade'
            }, function(valor){
                //alert(valor);
                $("#NB_QUANTIDADE").val(valor);
            });
            $.post("acoes.php",
            {
                ID_CURSO_ESTAGIO:valor[2],
                identifier:'buscarCursos'
            }, function(valor){
                $("#ID_CURSO_ESTAGIO").html(valor);
            });
            $("#NB_QUANTIDADE").focus();
        }
    });

    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabelaVagasSolicitadas").load('acoes.php?identifier=tabelaUnidade&PAGE='+this.id, hideLoader);
        return false;
    });

    // Inserção de Acesso
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
    //Exclusão de Acesso
    $('#excluir').live('click', function(){
        var href = $(this).attr('href');

        resp = window.confirm('Tem certeza que deseja excluir este Registro?');
        if (resp){
            showLoader();
            $("#tabelaVagasSolicitadas").load('acoes.php?identifier=excluirUnidade&ID_UNIDADE_IRP='+href+'&PAGE='+$('.selecionado').text(), hideLoader);
        }
        return false;
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