$(document).ready(function(){
    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }
    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };
    $('#NB_VALOR').maskMoney({
        showSymbol:false, 
        symbol:"R$", 
        decimal:",", 
        thousands:".", 
        allowZero:false, 
        allowNegative:false, 
        defaultZero:false
    });

    $('#DT_TERMINO_ESTAGIO').setMask({
        mask:'99/99/9999'
    });
    //minicalendario
    $('#DT_TERMINO_ESTAGIO').datepicker({
        changeMonth: true,
        changeYear: true
    });
    
    //    change do  orgão solicitante -
    //     quando o Usuario carregar clicar no combo carrega automaticamente o campo de codigo de seleção
    $('#ID_ORGAO_ESTAGIO').change(function(){
        if ($('#ID_ORGAO_ESTAGIO').val() != 0){
            var valor = $("#ID_ORGAO_ESTAGIO").val().split('_');
            $("#ESTAGIARIO_SELECAO option:first").attr('selected','selected');
//            $("#ID_SELECAO_ESTAGIO,#ID_LOTACAO").val('');
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
    
    // JQuery para carregar os estagiarios no comboBox 
    // Quando selecionar a seleção será carregado no combo Box do  candidatos todos que estiverem naquela seleção
    $("#ID_SELECAO_ESTAGIO").change(function(){
        if ($("#ID_SELECAO_ESTAGIO").val() != 0){  
            var valor = $("#ID_SELECAO_ESTAGIO").val().split('_');
            $("#ID_PESSOA_ESTAGIARIO").val('');
            $.post("acoes.php",{
                ID_SELECAO_ESTAGIO: $("#ID_SELECAO_ESTAGIO").val(), 
                identifier:'candidato'
            },
            function(valor){
                $('#ID_PESSOA_ESTAGIARIO').html(valor);
            });
            
        }else{
            $('#ID_PESSOA_ESTAGIARIO').html('');
        }
    });  
    // JQuery para carregar o valor da  bolsa
    // Quando selecionar a seleção será carregado no campo tx_bolsa_estagio o valor
    $("#ID_BOLSA_ESTAGIO").change(function(){
        if ($("#ID_BOLSA_ESTAGIO").val() != 0){  
     
            $("#NB_VALOR").val('');
            $.post("acoes.php",{
                ID_BOLSA_ESTAGIO: $("#ID_BOLSA_ESTAGIO").val(), 
                identifier:'buscarValor'
            },
            function(valor){
                $('#NB_VALOR').val(valor);
            });
            
        }else{
            $('#NB_VALOR').html('');
        }
    });      

    // JQuery para carregar o cargo do supervisor
    // Quando selecionar o supervisor o cargo será carregado automaticamente
    $("#ID_CONTRATO").change(function(){
        if ($("#ID_CONTRATO").val() != 0){  
            
			$("#TX_NOME,#NB_CPF,#TX_TIPO_VAGA_ESTAGIO,#TX_INSTITUICAO_ENSINO,#TX_CURSO_ESTAGIO,#TX_PERIODO,#TX_NIVEL,#TX_TCE").val('');
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
        }
    });  


    // JQuery para carregar o cargo do supervisor
    // Quando selecionar o supervisor o cargo será carregado automaticamente
    $("#ID_PESSOA_SUPERVISOR").change(function(){
        if ($("#ID_PESSOA_SUPERVISOR").val() != 0){  
          
            $("#TX_CARGO").val('');
            $.post("acoes.php",{
                ID_PESSOA_SUPERVISOR: $("#ID_PESSOA_SUPERVISOR").val(), 
                identifier:'cargoSupervisor'
            },
            function(valor){
               
                $('#TX_CARGO').val(valor);
            });
            
        }else{
            $('#TX_CARGO').html('');
        }
    });  

    
    // Change do orgão gestor -
    //quando o usuario clicar no combo do orgão gestor ele carrega o nome do secretario e o endereço
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
    
    // JQuery Utilizado para quando selecionar o candidato trazer os documentos (CPF & RG)    
    $("#ID_PESSOA_ESTAGIARIO").change(function(){
        
        if ($("#ID_PESSOA_ESTAGIARIO").val() != 0){
            var valor = $("#ID_PESSOA_ESTAGIARIO").val().split('_');
            $("#NB_CPF,#NB_RG").val('');
            $.getJSON("acoes.php",{
                ID_PESSOA_ESTAGIARIO:valor[0], 
                identifier:'buscarDocuments'
            },
            function(valor){
                console.log(valor);
                $("#NB_RG").val(valor['NB_RG'][0]);
                $("#NB_CPF").val(valor['NB_CPF'][0]);
            }
            );
			
        }else{
            $("#NB_CPF,#RG").val('');
        }
    });
        
    // fim Change do orgão gestor        
    $('#pesquisar').click(function(){
        if ($('#ID_ORGAO_GESTOR_ESTAGIO').val() && $('#ID_ORGAO_ESTAGIO').val()){
            showLoader();
            $('#tabela').load('acoes.php?identifier=tabela',{
                ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
                ID_SELECAO_ESTAGIO:$('#ID_SELECAO_ESTAGIO').val(),
                TX_TCE:$('#TX_TCE').val(),
                TX_NOME:$('#TX_NOME').val(),
                NB_CPF:$('#NB_CPF').val()
            }, hideLoader);
        }else
            alert('Preencha pelo menos um campo para realizar a pesquisa!');
    });
	
    //Paginacao
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{
            ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
            ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
            ID_SELECAO_ESTAGIO:$('#ID_SELECAO_ESTAGIO').val(),
            TX_TCE:$('#TX_TCE').val(),
            TX_NOME:$('#TX_NOME').val(),
            NB_CPF:$('#NB_CPF').val()
        }, hideLoader);
        return false;
    });
	
        
    $("#alterar").live('click', function(){
        var href = $(this).attr('href');
        $(window.document.location).attr('href','validacao.php?ID='+href);
        return false;
    });
        
});