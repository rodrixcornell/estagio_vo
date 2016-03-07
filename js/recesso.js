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

    $('#DT_INICIO_RECESSO').setMask({
        mask:'99/99/9999'
    });
    //minicalendario
    $('#DT_INICIO_RECESSO').datepicker({
        changeMonth: true,
        changeYear: true
    });

    $('#DT_FIM_RECESSO').setMask({
        mask:'99/99/9999'
    });
    //minicalendario
    $('#DT_FIM_RECESSO').datepicker({
        changeMonth: true,
        changeYear: true
    });

    $('#DT_ADIAMENTO').setMask({
        mask:'99/99/9999'
    });
    //minicalendario
    $('#DT_ADIAMENTO').datepicker({
        changeMonth: true,
        changeYear: true
    });

    $('#pesquisar').click(function(){
        if ($('#ID_ORGAO_GESTOR_ESTAGIO').val() && $('#ID_ORGAO_ESTAGIO').val()  )
        {
            showLoader();
            $('#tabela').load('acoes.php?identifier=tabela',{
                ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
                ID_SETORIAL_ESTAGIO:$('#ID_SETORIAL_ESTAGIO').val(),
                TX_CODIGO_CONTRATO:$('#TX_CODIGO_CONTRATO').val(),
                TX_NOME_ESTAGIARIO:$('#TX_NOME_ESTAGIARIO').val(),
                NB_CPF:$('#NB_CPF').val(),
                CODIGO_RECESSO:$('#CODIGO_RECESSO').val()
            }, hideLoader);
        }else
            alert('Selecione Orgão Gestor e o Orgão Solicitante!');
    });
	
    //Paginacao
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{
            ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val()
        }, hideLoader);
        return false;
    });
	
    //Icone Alterar
    $("#alterar").live('click', function(){
        var href = $(this).attr('href');
        $(window.document.location).attr('href','validacao.php?ID='+href);
        return false;
    });
	
    //Excluir
    $('#excluir').live('click', function(){
		
        resp = window.confirm('Tem certeza que deseja excluir este Registro?');
        if (resp){
            showLoader();
            $('#tabela').load('acoes.php?identifier=excluir',{
                ID_RECESSO_ESTAGIO:$(this).attr('href'),
                PAGE:$('.selecionado').text()
            }, hideLoader);
        }
					
        return false;
    });

    // Change do org�o gestor -
    //quando o usuario clicar no combo do org�o gestor ele carrega o nome do secretario e o endere�o
    $("#ID_ORGAO_GESTOR_ESTAGIO").change(function(){
        if ($("#ID_ORGAO_GESTOR_ESTAGIO").val() != 0){
            $("#TX_SECRETARIO_ORGAO_GESTOR,#ID_ORGAO_ESTAGIO").val('');
            $.post("acoes.php",{
                ID_ORGAO_GESTOR_ESTAGIO:$("#ID_ORGAO_GESTOR_ESTAGIO").val(), 
                identifier:'buscarNome'
            },
            function(valor){
                $("#TX_SECRETARIO_ORGAO_GESTOR").val(valor);
            }
            );			            
			
            $.post("acoes.php",{               
                identifier:'buscarOrgaoSolicitante'
            },
            function(valor){
                $("#ID_ORGAO_ESTAGIO").html(valor);
            }
            );			            
			
        }else{
            $("#TX_SECRETARIO_ORGAO_GESTOR,#ID_ORGAO_ESTAGIO").val('');
        }
    });
    $("#ID_ORGAO_ESTAGIO").change(function(){
        if ($("#ID_ORGAO_ESTAGIO").val() != 0){
            var valor = $("#ID_ORGAO_GESTOR_ESTAGIO").val().split('_');
            $("#ID_CONTRATO").val('');
            $.post("acoes.php",{
                ID_ORGAO_GESTOR_ESTAGIO:valor[0], 
                ID_ORGAO_ESTAGIO:$("#ID_ORGAO_ESTAGIO").val(), 
                identifier:'buscarContratoCombo'
            },
            function(valor){
                
                $("#ID_CONTRATO").html(valor);
            }
            );			            
			            
			
        }else{
            $("#ID_CONTRATO").val('');
        }
    });
    
    
   
	
    // Change do Orgão Solicitante para carregar o combo de contrato
        
        
    // JQuery para carregar o cargo do supervisor
    // Quando selecionar o supervisor o cargo ser� carregado automaticamente
    $("#ID_CONTRATO").change(function(){
        if ($("#ID_CONTRATO").val() != 0){  
            $("#TX_NOME,#NB_CPF,#TX_TIPO_VAGA_ESTAGIO,#TX_INSTITUICAO_ENSINO,#TX_CURSO_ESTAGIO,#TX_PERIODO,#TX_NIVEL,#TX_TCE,#DT_INICIO_VIG_ESTAGIO,#DT_FIM_VIGENCIA_ESTAGIO,#ID_AGENCIA_ESTAGIO").val('');
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
                $("#DT_INICIO_VIG_ESTAGIO").val(dados[8]);                
                $("#DT_FIM_VIGENCIA_ESTAGIO").val(dados[9]);                
                $("#ID_AGENCIA_ESTAGIO").val(dados[10]);                
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
            $("#DT_INICIO_VIG_ESTAGIO").val('');                
            $("#DT_FIM_VIGENCIA_ESTAGIO").val('');                
            $("#ID_AGENCIA_ESTAGIO").val('');                
        }
    });  

});