$(document).ready(function(){
    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }
    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };
    
    //    change do  orgão solicitante -
    //     quando o Usuario carregar clicar no combo carrega automaticamente o campo de codigo de seleção
    $('#ID_ORGAO_ESTAGIO').change(function(){
        if ($('#ID_ORGAO_ESTAGIO').val() != 0){  
            var valor = $("#ID_ORGAO_ESTAGIO").val().split('_');
            $("#ID_SELECAO_ESTAGIO,#ID_LOTACAO").val('');
            $.post("acoes.php",{
                ID_ORGAO_ESTAGIO:valor[0], 
                identifier:'codSelecao'
            },
            function(valor){
                $('#ID_SELECAO_ESTAGIO').html(valor);
            });
            $.post("acoes.php",{
                NB_COD_UNIDADE:valor[1], 
                identifier:'lotacao'
            },
            function(valor){
                $('#ID_LOTACAO').html(valor);
            });
        }else{
            $('#ID_SELECAO_ESTAGIO,#ID_LOTACAO').html('');
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
            $("#TX_FUNCIONARIO,#TX_ENDERECO").val('');
            $.post("acoes.php",{
                ID_UNIDADE_ORG:valor[1], 
                identifier:'buscarNome'
            },
            function(valor){
                $("#TX_FUNCIONARIO").val(valor);
            }
            );
			
            $.post("acoes.php",
            {
                ID_UNIDADE_ORG:valor[1], 
                identifier:'buscarEndereco'
            },
            function(valor){
                $("#TX_ENDERECO").val(valor);
            }
            );
			
        }else{
            $("#TX_FUNCIONARIO,#TX_ENDERECO").val('');
        }
    });
    
    // JQuery Utilizado para quando selecionar o candidato trazer os documentos (CPF & RG)    
    $("#ID_PESSOA_ESTAGIARIO").change(function(){
        
        if ($("#ID_PESSOA_ESTAGIARIO").val() != 0){
            var valor = $("#ID_PESSOA_ESTAGIARIO").val();
            $("#NB_CPF,#NB_RG").val('');
            $.getJSON("acoes.php",{
                ID_PESSOA_ESTAGIARIO:valor, 
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
	
        
});