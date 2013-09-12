$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }
    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };
    //-----------------------------------
    function showLoaderForm(){
        $('.fundoForm').fadeIn(200);
    };
    function hideLoaderForm(){
        $('.fundoForm').fadeOut(200);
    };

    //------------ formatos -----------------------
    $('#NB_QUANTIDADE').setMask({
        mask:'999'
    });


    //-----------------------------------
    function emptyHideLoader(){
        $('.fundo_pag').fadeOut(200);
        $("#ID_ORGAO_ESTAGIO option:first, #CS_TIPO_VAGA_ESTAGIO option:first, #ID_CURSO_ESTAGIO option:first").attr('selected','selected');
		$('#NB_QUANTIDADE').val('')

		$.getJSON('acoes.php?identifier=atualizarInf', atualizarInf);
        function atualizarInf(campo){

            $("#atualizacao").html(campo['DT_ATUALIZACAO'][0]);
            $("#funcionario").html(campo['TX_FUNCIONARIO'][0]);
        }
    };


    //---------------paginação----------------------
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabelaUnidade").load('acoes.php?identifier=tabelaUnidade&PAGE='+this.id, hideLoader);
        return false;
    });

    //---------- INSERÇÃO NO DETAIL --------------------
    // Inserção de Acesso
    $('#inserir').live('click', function(){
        if (!$('#ID_ORGAO_ESTAGIO').val()){
            alert('Para inserir escolha um Órgão Solicitante.');
            $('#ID_ORGAO_ESTAGIO').focus();

        }else if (!$('#CS_TIPO_VAGA_ESTAGIO').val()){
            alert('Para inserir escolha um Tipo.');
            $('#CS_TIPO_VAGA_ESTAGIO').focus();

        }else if (!$('#NB_QUANTIDADE').val()){
            alert('Para inserir preencha uma Quantidade.');
            $('#NB_QUANTIDADE').focus();

        }else if (!$('#ID_CURSO_ESTAGIO').val()){
            alert('Para inserir escolha um Curso.');
            $('#ID_CURSO_ESTAGIO').focus();

        }else{
            showLoader();
            $("#tabelaUnidade").load('acoes.php?identifier=inserirVaga',{
                ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
                CS_TIPO_VAGA_ESTAGIO:$('#CS_TIPO_VAGA_ESTAGIO').val(),
                NB_QUANTIDADE:$('#NB_QUANTIDADE').val(),
                ID_CURSO_ESTAGIO:$('#ID_CURSO_ESTAGIO').val(),
                PAGE:$('.selecionado').text()
            }, emptyHideLoader);
        }
        return false;
    });


    //--------------------alterar do detail-----------------------------------------

    $('#alterar').live('click', function(){
        var href = $(this).attr('href');
        var valor = href.split('_');

        $( "#dialog" ).dialog( "open" );
        $('#alterar_vaga').html('');
        showLoaderForm();
        $('#alterar_vaga').load('acoes.php?identifier=formAlterarVaga',{
            ID_ORGAO_ESTAGIO:valor[0],
            CS_TIPO_VAGA_ESTAGIO:valor[1]
            }, hideLoaderForm);
        return false;
    });

    $("#dialog").dialog({
        autoOpen: false,
        height: 300,
        width: 400,
        modal: true,
        buttons:{
            "Salvar": function() {

                if (!$('#ID_ORGAO_ESTAGIO_ALT').val()){
                    alert('Para inserir escolha um Órgão Solicitante.');
                    $('#ID_ORGAO_ESTAGIO_ALT').focus();

                }else if (!$('#CS_TIPO_VAGA_ESTAGIO_ALT').val()){
                    alert('Para inserir escolha um Tipo.');
                    $('#CS_TIPO_VAGA_ESTAGIO_ALT').focus();

                }else if (!$('#NB_QUANTIDADE_ALT').val()){
                    alert('Para inserir preencha uma Quantidade.');
                    $('#NB_QUANTIDADE_ALT').focus();

                }else if (!$('#ID_CURSO_ESTAGIO_ALT').val()){
                    alert('Para inserir escolha um Curso.');
                    $('#ID_CURSO_ESTAGIO_ALT').focus();

                }else{
                    showLoader();

                    $("#tabelaUnidade").load('acoes.php?identifier=alterarVaga',{
                        ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO_ALT').val(),
                        CS_TIPO_VAGA_ESTAGIO:$('#CS_TIPO_VAGA_ESTAGIO_ALT').val(),
                        NB_QUANTIDADE:$('#NB_QUANTIDADE_ALT').val(),
                        ID_CURSO_ESTAGIO:$('#ID_CURSO_ESTAGIO_ALT').val(),
						ID_ORGAO_ESTAGIO_ANT:$('#ID_ORGAO_ESTAGIO_ANT').val(),
						CS_TIPO_VAGA_ESTAGIO_ANT:$('#CS_TIPO_VAGA_ESTAGIO_ANT').val(),

                        },emptyHideLoader);

                    $( this ).dialog("close");
                }
            },
            "Cancelar": function() {
                $('#alterar_vaga').html('');
                $( this ).dialog( "close" );
            }
        }
    });


    //---------Exclusão de Acesso detail--------------------------------------------
    $('#excluir').live('click', function(){
        var href = $(this).attr('href');
        var valor = href.split('_');

        resp = window.confirm('Tem certeza que deseja excluir este Registro?');
        if (resp){
            showLoader();
            $("#tabelaUnidade").load('acoes.php?identifier=excluirUnidade',{
                ID_ORGAO_ESTAGIO:valor[0],
                CS_TIPO_VAGA_ESTAGIO:valor[1],
                PAGE:$('.selecionado').text()
            }, emptyHideLoader);

            return false;
        }else
			return false;

    });

    //----------------Excluir Master------------------------------------------------
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

    //--------------------------
    showLoader();
    $("#tabelaUnidade").load('acoes.php?identifier=tabelaUnidade', hideLoader);
});