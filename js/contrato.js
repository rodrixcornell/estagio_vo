$(document).ready(function(){
    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }
    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };
    
    $('#ID_ORGAO_ESTAGIO').change(function(){
        if ($('#ID_ORGAO_ESTAGIO').val() != 0){              
            $.post("acoes.php",{
                ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(), 
                identifier:'codSelecao'
            },
            function(valor){
                $('#ID_SELECAO_ESTAGIO').html(valor);
            });
        }else{
            $('#ID_SELECAO_ESTAGIO').html('');
        }
    }); 	
	
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