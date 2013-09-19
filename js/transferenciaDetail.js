$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }
    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };

    function emptyHideLoader(){
        $('.fundo_pag').fadeOut(200);
        //$('#NB_QUANTIDADE').val('');
        $("#NB_QUANTIDADE,#NB_QUANT_SISTEMA").val('');
        //$('#CS_TIPO_VAGA_ESTAGIO').html('');
        //$('#CS_TIPO_VAGA_ESTAGIO option:first').attr('selected','selected');

        $.post("acoes.php?identifier=pesquisarTipoVaga",TipoVaga);
                                                         
        function TipoVaga(valor){
            console.log(valor);
            $("#CS_TIPO_VAGA_ESTAGIO").html(valor);
        }
		
        $.getJSON('acoes.php?identifier=atualizarInf', atualizarInf);
        function atualizarInf(campo){
            $("#funcionario").html(campo['TX_FUNCIONARIO_ATUAL'][0]);
            $("#atualizacao").html(campo['DT_ATUALIZACAO'][0]);
        }
    };
    //------------------------------------
    function showLoaderForm(){
        $('.fundoForm').fadeIn(200);
    };
    //-----------------------------------    
    function hideLoaderForm(){
        $('.fundoForm').fadeOut(200);
    };
    //-----------------------------------
    $('#NB_QUANTIDADE').setMask({
        mask:'999999'
    });
    //------------------------------------------------------------------------------
    //--------------------carregar a quantidade EXISTENTE DO SISTEMA----------------
    //------------------------------------------------------------------------------ 
 
    $("#CS_TIPO_VAGA_ESTAGIO").change(function(){
        if ($("#CS_TIPO_VAGA_ESTAGIO").val() != 0){
            var valor = $("#CS_TIPO_VAGA_ESTAGIO").val().split('_');
       
            $("#NB_QUANT_SISTEMA").val('');
            $.post("acoes.php",{
                CS_TIPO_VAGA_ESTAGIO:valor[0], 
                NB_QUANT_SISTEMA:valor[1],
                identifier:'buscarQuantExistente'
            },
            function(valor){
                $("#NB_QUANT_SISTEMA").val(valor);
            }
            );
        
        }

    });
    //   $("#CS_TIPO_VAGA_ESTAGIO").change(function(){
    //        if ($("#CS_TIPO_VAGA_ESTAGIO").val() != 0){
    //  
    //       
    //
    //            $.post("acoes.php",{
    //                CS_TIPO_VAGA_ESTAGIO: $("#CS_TIPO_VAGA_ESTAGIO").val(), 
    //                identifier:'buscarQuantExistente'
    //            },
    //            function(valor){
    //                $("#NB_QUANT_SISTEMA").val(valor);
    //            }
    //            );
    //        
    //        }
    //        return false;
    //    });  
    //    
    //------------------------------------------------------------------------------
    //--------------Inserção no detail do tipo e quantidade-------------------------
    $('#inserir').live('click', function(){
        
        if (!$('#CS_TIPO_VAGA_ESTAGIO').val()){
            alert('Para inserir escolha um Tipo de Vaga.');
            $('#CS_TIPO_VAGA_ESTAGIO').focus();
          
        }else if (!$('#NB_QUANTIDADE').val()){
            alert('Para inserir escolha uma Quantidade.');
            $('#NB_QUANTIDADE').focus();
       
        }else{
            var valor = $('#CS_TIPO_VAGA_ESTAGIO').val().split('_');

            showLoader();
            $("#tabelaVagasSolicitadas").load('acoes.php',{           
                CS_TIPO_VAGA_ESTAGIO:valor[0],
                NB_VAGAS_TRANSFERIDAS:valor[1],
                NB_QUANTIDADE:$('#NB_QUANTIDADE').val(),
                identifier:'inserirVagasSolicitadas',
                PAGE:$('.selecionado').text()
            }, emptyHideLoader);
        }
        return false;
    });

    //--------------------------------Exclusão do detail ---------------------------
    $('#excluir').live('click', function(){
        var href = $(this).attr('href');
        var valor = href.split('_');

        resp = window.confirm('Tem certeza que deseja excluir este Registro?');
        if (resp){
            showLoader();
            $("#tabelaVagasSolicitadas").load('acoes.php',{
                ID_TRANSFERENCIA_ESTAGIO:valor[0],
                CS_TIPO_VAGA_ESTAGIO:valor[1],
                ID_ORGAO_EST_ORIGEM:$('#ID_ORGAO_EST_ORIGEM').val(),
                ID_ORGAO_EST_DESTINO:$('#ID_ORGAO_EST_DESTINO').val(),
                identifier:'excluirVagasSolicitadas',
                PAGE:$('.selecionado').text()
            }, emptyHideLoader);
        }
        return false;
    });
    
   
    //------------------------------------------------------------------------------ 
    //--------alteração do detail tipo quantidade entre outos-----------------------
    $('#alterar').live('click', function(){
        var href = $(this).attr('href');
        var valor = href.split('_');

        // alert(valor);
        $("#dialog").dialog("open");
        $('#tabelaAlterarVagasSolicitadas').html('');
        showLoaderForm();
        $('#tabelaAlterarVagasSolicitadas').load('acoes.php',{ 
            ID_TRANSFERENCIA_ESTAGIO:valor[0],
            CS_TIPO_VAGA_ESTAGIO:valor[1],
            ID_QUADRO_VAGAS_ESTAGIO:$('#ID_QUADRO_VAGAS_ESTAGIO').val(),  
            //ID_ORGAO_EST_ORIGEM:$('#ID_ORGAO_EST_ORIGEM').val(), 
            //ID_ORGAO_EST_DESTINO:$('#ID_ORGAO_EST_DESTINO').val(), 
            NB_QUANTIDADE:$('#NB_QUANTIDADE_ALT').val(),
            identifier:'tabelaAlterarVagasSolicitadas'
        }, hideLoaderForm);
        return false;
    });
    
    
    //------------------------------------------------------------------------------  
    //------------------------------------------------------------------------------

    $("#dialog").dialog({
        autoOpen: false,
        height: 300,
        width: 600,
        modal: true,
        buttons:{
            "Salvar": function() {
                if (!$('#NB_QUANTIDADE_ALT').val()){
                    alert('Para inserir escolha  uma Quantidade.');
                    $('#NB_QUANTIDADE_ALT').focus();
       
                }else{
                     
                    showLoader();
                    $("#tabelaVagasSolicitadas").load('acoes.php',{
                        ID_QUADRO_VAGAS_ESTAGIO:$('#ID_QUADRO_VAGAS_ESTAGIO').val(), 
                        CS_TIPO_VAGA_ESTAGIO:$('#CS_TIPO_VAGA_ESTAGIO_ANT').val(),
                        ID_ORGAO_EST_ORIGEM:$('#ID_ORGAO_EST_ORIGEM').val(), 
                        ID_ORGAO_EST_DESTINO:$('#ID_ORGAO_EST_DESTINO').val(), 
                        NB_QUANTIDADE:$('#NB_QUANTIDADE_ALT').val(),
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
    //-------
 
    //------------------------------efetivar----------------------------	
    $( "#efetivar" ).live('click', function() {
        if ($('.icones').length){
            resp = window.confirm('Tem certeza que deseja Efetivar esta Solicitação?');
            if (resp){
                showLoader();
                return true;
            }
            return false;
        }else{
            alert('Para Efetivar uma Solicitação adicione pelo menos uma vaga de estágio.');
            return false;	
        }			  
        
    });


    //----------Excluir Master---------------------------------------------------
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
	
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabelaVagasSolicitadas").load('acoes.php?identifier=tabelaVagasSolicitadas&PAGE='+this.id,hideLoader);
        return false;
    });

    showLoader();
    $("#tabelaVagasSolicitadas").load('acoes.php?identifier=tabelaVagasSolicitadas',hideLoader);
});