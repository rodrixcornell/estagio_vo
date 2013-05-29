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
        mask:'999999'
    });
    //Formatar Campos
    $('#DT_ATUALIZACAO,#DT_CADASTRO').setMask({
        mask:'99/99/9999'
    });
    $('#DT_ATUALIZACAO,#DT_CADASTRO').datepicker({
        changeMonth: true, 
        changeYear: true
    });
   
    //-----------------------------------
    function emptyHideLoader(){
        $('.fundo_pag').fadeOut(200);
        $("#ID_QUADRO_VAGAS_ESTAGIO option:first").attr('selected','selected');
        $.getJSON('acoes.php?identifier=atualizarInf', atualizarInf);
        function atualizarInf(campo){
            $("#atualizacao").html(campo['DT_ATUALIZACAO'][0]);
            $("#funcionario").html(campo['TX_LOGIN'][1]);	
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
            alert('Para inserir escolha uma Quantidade.');
            $('#NB_QUANTIDADE').focus();
                  
        }else if (!$('#ID_CURSO_ESTAGIO').val()){
            alert('Para inserir escolha um Curso.');
            $('#ID_CURSO_ESTAGIO').focus();
            
        }else{
            showLoader();
            $("#tabelaUnidade").load('acoes.php?identifier=inserirUnidade',{
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
        
        if (!$('#ID_ORGAO_ESTAGIO').val()){
                    alert('Para inserir escolha um Órgão Solicitante.');
                    $('#ID_ORGAO_ESTAGIO').focus();
            
                }else if (!$('#CS_TIPO_VAGA_ESTAGIO').val()){
                    alert('Para inserir escolha um Tipo.');
                    $('#CS_TIPO_VAGA_ESTAGIO').focus();
                  
               }else if (!$('#NB_QUANTIDADE').val()){
                    alert('Para inserir escolha uma Quantidade.');
                    $('#NB_QUANTIDADE').focus();
                  
                }else if (!$('#ID_CURSO_ESTAGIO').val()){
                    alert('Para inserir escolha um Curso.');
                    $('#ID_CURSO_ESTAGIO').focus();
            
                }        
        $( "#dialog" ).dialog( "open" );
        $('#tabela_Item_Adquirido').html('');
        //showLoader();
        $('#tabela_Item_Adquirido').load('acoes.php?identifier=alterarUnidade',{ID_ORGAO_ESTAGIO:valor[0],
                                                                                CS_TIPO_VAGA_ESTAGIO:valor[1]}, hideLoaderForm);
        return false;
    });

    $("#dialog").dialog({
        autoOpen: false, 
        height: 180, 
        width: 800, 
        modal: true,
        buttons:{
            "Salvar": function() {
                //var href = $(this).attr('href');
                //var valor = href.split('_');
                           
                if (!$('#ID_ORGAO_ESTAGIO').val()){
                    alert('Para inserir escolha um Órgão Solicitante.');
                    $('#ID_ORGAO_ESTAGIO').focus();
            
                }else if (!$('#CS_TIPO_VAGA_ESTAGIO').val()){
                    alert('Para inserir escolha um Tipo.');
                    $('#CS_TIPO_VAGA_ESTAGIO').focus();
                  
               }else if (!$('#NB_QUANTIDADE').val()){
                    alert('Para inserir escolha uma Quantidade.');
                    $('#NB_QUANTIDADE').focus();
                  
                }else if (!$('#ID_CURSO_ESTAGIO').val()){
                    alert('Para inserir escolha um Curso.');
                    $('#ID_CURSO_ESTAGIO').focus();
            
                }else{
               showLoader();
  /* $('#tabelaUnidade').load('acoes.php?identifier=alterarUnidade',{ID_ORGAO_ESTAGIO:valor[0],
                                                                   CS_TIPO_VAGA_ESTAGIO:valor[1]}, hideLoader);    */         
$("#tabelaUnidade").load('acoes.php?identifier=alterarUnidade',{ID_ORGAO_ESTAGIO:valor[0],
                                                                  CS_TIPO_VAGA_ESTAGIO:valor[1],
                                                                  NB_QUANTIDADE:valor[2],
                                                                  ID_CURSO_ESTAGIO:[3]},hideLoader);
                                                    
                                               $( this ).dialog("close");
                }
            },
            "Cancelar": function() {
                $('#form_tramite').html('');
                showLoader();
                $("#tabelaUnidade").load('acoes.php?identifier=tabelaUnidade', hideLoader);
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
                }, hideLoader);
            //  ID_CURSO_ESTAGIO
            return false;    
        }
                                         
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