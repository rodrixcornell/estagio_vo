$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };
	

    $('#pesquisar').click(function(){
        //if ($('#ID_USUARIO_RESP').val() || $('#TX_FUNCIONARIO').val()){
            showLoader();
            $('#tabela').load('acoes.php?identifier=tabela',{
                ID_USUARIO_RESP:$('#ID_USUARIO_RESP').val(),
                TX_FUNCIONARIO:$('#TX_FUNCIONARIO').val()
               
            }, hideLoader);
        //}else
           // alert('Preencha pelo menos um campo para realizar a pesquisa!');
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