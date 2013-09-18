$(document).ready(function(){
    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    };
    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };
        $('#TX_FONE_AGENTE').setMask({ mask:'9999-999999' });
/*-------------FORMATO----------------------------*/
 
$('#NB_VALOR_BOLSA').maskMoney({
        showSymbol:false, 
        symbol:"R$", 
        decimal:",", 
        thousands:".", 
        allowZero:false, 
        allowNegative:false, 
        defaultZero:false
    });
    //----------FORMATO DAS HORAS -------------------------------------------

    $('#TX_INICIO_HORARIO,#TX_FIM_HORARIO').timepicker();
    $('#TX_INICIO_HORARIO,#TX_FIM_HORARIO').setMask({
        mask:'99:99'
    });
 
 //-------------FORMATO DA DATA--------------------
$('#DT_INICIO_PRORROGACAO,#DT_FIM_PRORROGACAO,#DT_INICIO_RECESSO,#DT_FIM_RECESSO,#DT_INICIO_JORNADA,#DT_INICIO_PAG_BOLSA').setMask({
        mask:'99/99/9999'
    }); 

//------------CALENDARIO---------------------------------------------------
    $('#DT_INICIO_PRORROGACAO').datepicker({
        changeMonth: true,
        changeYear: true
    }); 
    $('#DT_FIM_PRORROGACAO').datepicker({
        changeMonth: true,
        changeYear: true
    }); 
    $('#DT_INICIO_RECESSO').datepicker({
        changeMonth: true,
        changeYear: true
    }); 
    $('#DT_FIM_RECESSO').datepicker({
        changeMonth: true,
        changeYear: true
    }); 
    $('#DT_INICIO_JORNADA').datepicker({
        changeMonth: true,
        changeYear: true
    }); 
    $('#DT_INICIO_PAG_BOLSA').datepicker({
        changeMonth: true,
        changeYear: true
    }); 
//---------------------------------
$('#NB_QUANTIDADE').setMask({
        mask:'999999'
    });
//--------------------------------------------------------------------------
//---------------se orgao gestor seleciona o secretario------------------------
    $("#ID_ORGAO_GESTOR_ESTAGIO").change(function(){

        if ($("#ID_ORGAO_GESTOR_ESTAGIO").val() != 0){
            var valor = $("#ID_ORGAO_GESTOR_ESTAGIO").val().split('_');
            $("#TX_FUNCIONARIO").val('');
            $.post("acoes.php",{
                ID_UNIDADE_ORG:valor[1],
                identifier:'buscarNome'
            },
            function(valor){
                $("#TX_FUNCIONARIO").val(valor);
            }
            );

        }else{
            $("#TX_FUNCIONARIO").val('');
        }
    });
//-------------------------------------------------
/*--------------cadastrar seleciona o agente setorial---------------------------*/
    $('#ID_ORGAO_ESTAGIO').change(function(){
        if ($('#ID_ORGAO_ESTAGIO').val() != 0){
            var valor = $("#ID_ORGAO_ESTAGIO").val().split('_');
            $("#ID_SETORIAL_ESTAGIO option:first").attr('selected','selected');
            $.post("acoes.php",{
                ID_ORGAO_ESTAGIO:valor[0], 
                identifier:'buscarASetorial'
            },
            function(valor){
                $('#ID_SETORIAL_ESTAGIO').html(valor);
            });
        }else{
            $('#ID_SETORIAL_ESTAGIO').html('');
        }
    }); 
    
//--------------------COISAS DO CONTRATO--------------    
$("#ID_CONTRATO").change(function(){
        if ($("#ID_CONTRATO").val() != 0){  
           
           var valor = $('#ID_CONTRATO').val().split('_');
              // alert(valor);
            
            $("#TX_NOME,#NB_CPF,#TX_TIPO_VAGA_ESTAGIO,#TX_INSTITUICAO_ENSINO,#TX_CURSO_ESTAGIO,#TX_PERIODO,#TX_TCE,#TX_AGENCIA_ESTAGIO").val('');
	    $.post("acoes.php",{
               ID_CONTRATO: valor[0], 
               ID_AGENCIA_ESTAGIO:valor[1], 
                identifier:'buscarDadosContrato'
            },
            function(valor){
                
                dados = valor.split('_');
                $("#TX_NOME").val(dados[0]);
                $("#NB_CPF").val(dados[1]);
                $("#TX_TIPO_VAGA_ESTAGIO").val(dados[2]);
                $("#TX_INSTITUICAO_ENSINO").val(dados[3]);
                $("#TX_CURSO_ESTAGIO").val(dados[4]);
                $("#TX_PERIODO").val(dados[5]);
                $("#TX_TCE").val(dados[6]);   
                $("#TX_AGENCIA_ESTAGIO").val(dados[7]);                            
            });
        }else{
            $('#TX_NOME').val('');
            $("#NB_CPF").val('');
            $("#TX_TIPO_VAGA_ESTAGIO").val('');
            $("#TX_INSTITUICAO_ENSINO").val('');
            $("#TX_CURSO_ESTAGIO").val('');
            $("#TX_PERIODO").val('');
            $("#TX_TCE").val('');  
            $("#TX_AGENCIA_ESTAGIO").val('');                       
        }
    });


    //--------------check VIGENCIA-----------------------
    //----------traz inativo ---------------
//    $('input[name=DT_INICIO_PRORROGACAO]').attr('disabled',true);
//    $('input[name=DT_FIM_PRORROGACAO]').attr('disabled',true);
//    $('input[name=DT_INICIO_RECESSO]').attr('disabled',true);
//    $('input[name=DT_FIM_RECESSO]').attr('disabled',true);
//    $('input[name=NB_MES]').attr('disabled',true);
//
//    $('input[name=DT_INICIO_JORNADA]').attr('disabled',true);
//    $('input[name=TX_HORAS_JORNADA]').attr('disabled',true);
//    $('input[name=TX_INICIO_HORARIO]').attr('disabled',true);
//    $('input[name=TX_FIM_HORARIO]').attr('disabled',true);
//
//    $('input[name=DT_INICIO_PAG_BOLSA]').attr('disabled',true);
//    $('input[name=NB_VALOR_BOLSA]').attr('disabled',true);
//
//    $('textarea[name=TX_OUTRAS_ALTERACOES]').attr('disabled',true);

    //-------------------------VIGENCIA---------------------------------
    $("#NB_VIGENCIA").click( function() {
        if($('#NB_VIGENCIA').is(':checked')){
            $('#DT_INICIO_PRORROGACAO').attr('disabled',false);
            $('#DT_FIM_PRORROGACAO').attr('disabled',false);
            $('#DT_INICIO_RECESSO').attr('disabled',false);
            $('#DT_FIM_RECESSO').attr('disabled',false);
            $('#NB_MES').attr('disabled',false);
        }else{
            $('#DT_INICIO_PRORROGACAO').attr('disabled',true);
            $('#DT_FIM_PRORROGACAO').attr('disabled',true);
            $('#DT_INICIO_RECESSO').attr('disabled',true);
            $('#DT_FIM_RECESSO').attr('disabled',true);
            $('#NB_MES').attr('disabled',true);
        }
    });
    if($('#NB_VIGENCIA').is(':checked')){
            $('#DT_INICIO_PRORROGACAO').attr('disabled',false);
            $('#DT_FIM_PRORROGACAO').attr('disabled',false);
            $('#DT_INICIO_RECESSO').attr('disabled',false);
            $('#DT_FIM_RECESSO').attr('disabled',false);
            $('#NB_MES').attr('disabled',false);
        }else{
            $('#DT_INICIO_PRORROGACAO').attr('disabled',true);
            $('#DT_FIM_PRORROGACAO').attr('disabled',true);
            $('#DT_INICIO_RECESSO').attr('disabled',true);
            $('#DT_FIM_RECESSO').attr('disabled',true);
            $('#NB_MES').attr('disabled',true);
        }
    //----------------JORNADA-------------------------------
    $("#NB_JORNADA").click( function() {
        if($('#NB_JORNADA').is(':checked')){

            $('#DT_INICIO_JORNADA').attr('disabled',false);
            $('#TX_HORAS_JORNADA').attr('disabled',false);
            $('#TX_INICIO_HORARIO').attr('disabled',false);
            $('#TX_FIM_HORARIO').attr('disabled',false);
        }else{
            $('#DT_INICIO_JORNADA').attr('disabled',true);
            $('#TX_HORAS_JORNADA').attr('disabled',true);
            $('#TX_INICIO_HORARIO').attr('disabled',true);
            $('#TX_FIM_HORARIO').attr('disabled',true);
        }
    });
    if($('#NB_JORNADA').is(':checked')){

            $('#DT_INICIO_JORNADA').attr('disabled',false);
            $('#TX_HORAS_JORNADA').attr('disabled',false);
            $('#TX_INICIO_HORARIO').attr('disabled',false);
            $('#TX_FIM_HORARIO').attr('disabled',false);
        }else{
            $('#DT_INICIO_JORNADA').attr('disabled',true);
            $('#TX_HORAS_JORNADA').attr('disabled',true);
            $('#TX_INICIO_HORARIO').attr('disabled',true);
            $('#TX_FIM_HORARIO').attr('disabled',true);
        }
    //---------------BOLSA------------------
    $("#NB_BOLSA").click( function() {
        if($('#NB_BOLSA').is(':checked')){
            $('#DT_INICIO_PAG_BOLSA').attr('disabled',false);
            $('#NB_VALOR_BOLSA').attr('disabled',false);
        }else{
            $('#DT_INICIO_PAG_BOLSA').attr('disabled',true);
            $('#NB_VALOR_BOLSA').attr('disabled',true);
        }
    });
    if($('#NB_BOLSA').is(':checked')){
            $('#DT_INICIO_PAG_BOLSA').attr('disabled',false);
            $('#NB_VALOR_BOLSA').attr('disabled',false);
        }else{
            $('#DT_INICIO_PAG_BOLSA').attr('disabled',true);
            $('#NB_VALOR_BOLSA').attr('disabled',true);
        }
    //-------ALTERACOES---------
    $("#NB_ALTERACOES").click( function(){
        if($('#NB_ALTERACOES').is(':checked')){
            $('#TX_OUTRAS_ALTERACOES').attr('disabled',false);
        }else{
            $('#TX_OUTRAS_ALTERACOES').attr('disabled',true);
        }
    });
    if($('#NB_ALTERACOES').is(':checked')){
        $('#TX_OUTRAS_ALTERACOES').attr('disabled',false);
    }else{
        $('#TX_OUTRAS_ALTERACOES').attr('disabled',true);
    }

    //alert("O checkbox esta checado? " + $("#NB_ALTERACOES").is(":checked"));



    //---------------------PESQUISA---------------------------------------
    $('#pesquisar').click(function(){
     if ($('#ID_ORGAO_GESTOR_ESTAGIO').val() || $('#ID_ORGAO_ESTAGIO').val()){
            showLoader();
            $('#tabela').load('acoes.php?identifier=tabela',{
                ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
                ID_AGENCIA_ESTAGIO:$('#ID_AGENCIA_ESTAGIO').val(),
                TX_COD_SELECAO:$('#TX_CODIGO_CONTRATO').val(),
                TX_NOME:$('#TX_NOME').val(),
                NB_CPF:$('#NB_CPF').val(),
                TX_CODIGO_SOLICITACAO:$('#TX_CODIGO_SOLICITACAO').val()
            }, hideLoader);
      }else
         alert('Preencha os campos obrigatório para realizar a pesquisa!');
    });

//--------PAGINAÇÃO DA PESQUISA-------------------------------------
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{
            ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
            ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
            ID_AGENCIA_ESTAGIO:$('#ID_AGENCIA_ESTAGIO').val(),
            TX_CODIGO_CONTRATO:$('#TX_CODIGO_CONTRATO').val(),
            TX_NOME:$('#TX_NOME').val(),
            NB_CPF:$('#NB_CPF').val(),
            TX_CODIGO_SOLICITACAO:$('#TX_CODIGO_SOLICITACAO').val()
           
        }, hideLoader);
        return false;
    });

    $("#alterar").live('click', function(){
        var href = $(this).attr('href');
        $(window.document.location).attr('href','validacao.php?ID='+href);
        return false;
    });

});
