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
		
    $('#pesquisar').click(function(){
     //   if ($('#ID_ORGAO_GESTOR_ESTAGIO').val() && $('#ID_ORGAO_ESTAGIO').val()){
            showLoader();
            $('#tabela').load('acoes.php?identifier=tabela',{
                ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),                
                ID_RECRUTAMENTO_ESTAGIO:$('#ID_RECRUTAMENTO_ESTAGIO').val(),
                CS_SITUACAO:$('#CS_SITUACAO').val(),
                TX_COD_SELECAO:$('#TX_COD_SELECAO').val()                               
            }, hideLoader);
    //    }else
  //          alert('Preencha pelo menos os dois campos obrigatórios para realizar a pesquisa!');
    });
	
    //Paginacao
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{
            ID_USUARIO_RESP:$('#ID_USUARIO_RESP').val(),
            TX_FUNCIONARIO:$('#TX_FUNCIONARIO').val()
           
        }, hideLoader);
        return false;
    });
	
    $('#ID_ORGAO_ESTAGIO').change(function(){
        if ($('#ID_ORGAO_ESTAGIO').val() != 0){              
            $.post("acoes.php",{
                ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(), 
                identifier:'buscarRecrutamento'
            },
            function(valor){
                $('#ID_RECRUTAMENTO_ESTAGIO').html(valor);
            });
        }else{
            $('#ID_RECRUTAMENTO_ESTAGIO').html('');
        }
    });
    	
    $("#ID_USUARIO_RESP").change(function(){
        if ($("#ID_USUARIO_RESP").val() != 0){
            $("#TX_FUNCIONARIO").val('');

            $.post("acoes.php",
            {
                ID_USUARIO_RESP:$("#ID_USUARIO_RESP").val(), 
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
	
	
    //Icone Alterar
    $("#alterar").live('click', function(){
        var href = $(this).attr('href');
        $(window.document.location).attr('href','validacao.php?ID='+href);
        return false;
    });
	
});