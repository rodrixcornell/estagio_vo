$(document).ready(function(){
    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }
    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };

    $('#ID_ORGAO_GESTOR_ESTAGIO option').first().next().attr("selected","selected");
    $('#ID_ORGAO_GESTOR_ESTAGIO').attr("disabled","disabled");
    $('#ID_ORGAO_GESTOR_ESTAGIO').attr("readonly","readonly");

    $('#DT_SOLICITACAO').setMask({
        mask:'99/99/9999'
    });

    $('#DT_DESLIGAMENTO').setMask({
      mask:'99/99/9999'
    });

    $('#DT_SOLICITACAO').datepicker({
        changeMonth: true,
        changeYear: true
    });

   $('#DT_DESLIGAMENTO').datepicker({
      changeMonth: true,
      changeYear: true
    });
    
    $('#ID_ORGAO_ESTAGIO').change(function(){
        if ($('#ID_ORGAO_ESTAGIO').val() != 0){
            var valor = $("#ID_ORGAO_ESTAGIO").val().split('_');
            $("#ID_SETORIAL_ESTAGIO option:first").attr('selected','selected');
            $.post("acoes.php",{
                ID_ORGAO_ESTAGIO:valor[0], 
                identifier:'buscarAgenteSetorial'
            },
            function(valor){
                $('#ID_SETORIAL_ESTAGIO').html(valor);
            });
        }else{
            $('#ID_SETORIAL_ESTAGIO').html('');
        }
    }); 
    
    $("#ID_CONTRATO").change(function(){
        if ($("#ID_CONTRATO").val() != 0){  
            
			$("#TX_NOME,#NB_CPF,#TX_TIPO_VAGA_ESTAGIO,#TX_INSTITUICAO_ENSINO,#TX_CURSO_ESTAGIO,#TX_PERIODO,#TX_NIVEL,#TX_TCE,#TX_AGENCIA_ESTAGIO").val('');
			$.post("acoes.php",{
                ID_CONTRATO: $("#ID_CONTRATO").val(), 
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
                $("#TX_NIVEL").val(dados[6]);
                $("#TX_TCE").val(dados[7]);   
                $("#TX_AGENCIA_ESTAGIO").val(dados[8]);                            
            });
        }else{
            $('#TX_NOME').val('');
            $("#NB_CPF").val('');
            $("#TX_TIPO_VAGA_ESTAGIO").val('');
            $("#TX_INSTITUICAO_ENSINO").val('');
            $("#TX_CURSO_ESTAGIO").val('');
            $("#TX_PERIODO").val('');
            $("#TX_NIVEL").val('');
            $("#TX_TCE").val('');  
            $("#TX_AGENCIA_ESTAGIO").val('');                       
        }
    });  
   
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
            
    $('#pesquisar').click(function(){
        if ($('#ID_ORGAO_GESTOR_ESTAGIO').val() && $('#ID_ORGAO_ESTAGIO').val()){
            showLoader();
            $('#tabela').load('acoes.php?identifier=tabela',{
                ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
                ID_AGENCIA_ESTAGIO:$('#ID_AGENCIA_ESTAGIO').val(),
                TX_COD_SELECAO:$('#TX_COD_SELECAO').val(),
                TX_NOME:$('#TX_NOME').val(),
                NB_CPF:$('#NB_CPF').val(),
                TX_CODIGO:$('#TX_CODIGO').val()                
            }, hideLoader);
        }else
            alert('Preencha pelo menos um campo para realizar a pesquisa!');
    });
	
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{
            ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
            ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
            ID_AGENCIA_ESTAGIO:$('#ID_AGENCIA_ESTAGIO').val(),
            TX_COD_SELECAO:$('#TX_COD_SELECAO').val(),
            TX_NOME:$('#TX_NOME').val(),
            NB_CPF:$('#NB_CPF').val(),
            TX_TCE:$('#TX_TCE').val()                
        }, hideLoader);
        return false;
    });
	
    $("#alterar").live('click', function(){
        var href = $(this).attr('href');
        $(window.document.location).attr('href','validacao.php?ID='+href);
        return false;
    });	
	
});