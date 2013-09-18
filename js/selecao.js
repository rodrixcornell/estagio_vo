$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };
	
	$('#DT_AGENDAMENTO').setMask({ mask:'99/99/9999' });

	$('#DT_AGENDAMENTO').datepicker({
		changeMonth: true,
        changeYear: true
	});
	
	$('#DT_REALIZACAO').setMask({ mask:'99/99/9999' });

	$('#DT_REALIZACAO').datepicker({
		changeMonth: true,
        changeYear: true
	});
	
	
	//Cadastrar e Alterar
	$("#ID_ORGAO_GESTOR_ESTAGIO_CAD").live('change', function(){
		$("#ID_ORGAO_ESTAGIO_CAD,#ID_RECRUTAMENTO_ESTAGIO").html(''); 
        if ($('#ID_ORGAO_GESTOR_ESTAGIO_CAD').val()){
			$("#ID_ORGAO_ESTAGIO_CAD").html('<option>Carregando...</option>');
			$.post("acoes.php",{
                				ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO_CAD').val(),
                				identifier:'buscarSolicitanteCad'
            					}, 
			function(valor){
                $("#ID_ORGAO_ESTAGIO_CAD").html(valor);
            });
			 
        }
        return false;
    });
	
	//Cadastrar e Alterar
	$('#ID_ORGAO_ESTAGIO_CAD').change(function(){
		$("#ID_RECRUTAMENTO_ESTAGIO").html('');
        if ($('#ID_ORGAO_ESTAGIO_CAD').val() != 0){              
            $.post("acoes.php",{
                ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO_CAD').val(), 
                identifier:'buscarRecrutamentoCad'
            },
            function(valor){
                $('#ID_RECRUTAMENTO_ESTAGIO').html(valor);
            });
        }
    });
	
	//Index
	$("#ID_ORGAO_GESTOR_ESTAGIO").live('change', function(){
		$("#ID_ORGAO_ESTAGIO,#ID_RECRUTAMENTO_ESTAGIO").html(''); 
        if ($('#ID_ORGAO_GESTOR_ESTAGIO').val()){
			$("#ID_ORGAO_ESTAGIO").html('<option>Carregando...</option>');
			$.post("acoes.php",{
                				ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                				identifier:'buscarSolicitante'
            					}, 
			function(valor){
                $("#ID_ORGAO_ESTAGIO").html(valor);
            });
			 
        }
        return false;
    });
	
	//Index
	$('#ID_ORGAO_ESTAGIO').change(function(){
		$("#ID_RECRUTAMENTO_ESTAGIO").html('');
        if ($('#ID_ORGAO_ESTAGIO').val() != 0){              
            $.post("acoes.php",{
                ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(), 
                identifier:'buscarRecrutamento'
            },
            function(valor){
                $('#ID_RECRUTAMENTO_ESTAGIO').html(valor);
            });
        }
    });
	
	
	
	
	
	
	
	
		
    $('#pesquisar').click(function(){
        if ($('#ID_ORGAO_GESTOR_ESTAGIO').val() && $('#ID_ORGAO_ESTAGIO').val()){
            showLoader();
            $('#tabela').load('acoes.php?identifier=tabela',{
                ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),                
                ID_RECRUTAMENTO_ESTAGIO:$('#ID_RECRUTAMENTO_ESTAGIO').val(),
                CS_SITUACAO:$('#CS_SITUACAO').val(),
                TX_COD_SELECAO:$('#TX_COD_SELECAO').val()                               
            }, hideLoader);
        }else
            alert('Preencha pelo menos os dois campos obrigatórios para realizar a pesquisa!');
    });
	
    //Paginacao
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{
            ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
            ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),                
            ID_RECRUTAMENTO_ESTAGIO:$('#ID_RECRUTAMENTO_ESTAGIO').val(),
            CS_SITUACAO:$('#CS_SITUACAO').val(),
            TX_COD_SELECAO:$('#TX_COD_SELECAO').val()                               
        }, hideLoader);
        return false;
    });
	
    
    	
    //Icone Alterar
    $("#alterar").live('click', function(){
        var href = $(this).attr('href');
        $(window.document.location).attr('href','validacao.php?ID='+href);
        return false;
    });
	
});