$(document).ready(function() {
 function showLoader() {
        $('.fundo_pag').fadeIn(200);
    }

function hideLoader() {
        $('.fundo_pag').fadeOut(200);
    }
    ;

 $('#pesquisar').click(function(){
     if ($('#NB_FUNCIONARIO').val() || $('#TX_CARGO').val()){
         showLoader();
	 $('#tabela').load('acoes.php?identifier=tabela',{NB_FUNCIONARIO:$('#NB_FUNCIONARIO').val(),
                                                          TX_CARGO:$('#TX_CARGO').val()}, hideLoader);
       return false;    
      }else
          alert('Preencha pelo menos um campo para realizar a pesquisa!');
 });    
 
$("#paginacao li").live('click', function(){
 showLoader();
 $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{NB_FUNCIONARIO:$('#NB_FUNCIONARIO').val(),
                                                                TX_CARGO:$('#TX_CARGO').val()}, hideLoader);
 return false;
});

    $("#alterar").live('click', function(){
        var href = $(this).attr('href');
        $(window.document.location).attr('href','validacao.php?ID='+href);
        return false;
    });
	
  $('#inserir').live('click', function() {
      if        (!$('#NB_FUNCIONARIO').val()){
                  $('#NB_FUNCIONARIO').focus();
      
      } else if (!$('#ID_CONSELHO').val()){
                  $('#ID_CONSELHO').focus();
      
      } else if (!$('#TX_FORMACAO').val()){
                  $('#TX_FORMACAO').focus();
      
      } else if (!$('#NB_INSCRICAO_CONSELHO').val()){
                  $('#NB_INSCRICAO_CONSELHO').focus();
      
      } else if (!$('#TX_CARGO').val()){
                  $('#TX_CARGO').focus();
      
      } else if (!$('#TX_CURRICULO').val()){
                  $('#TX_CURRICULO').focus();
      
      }else{
      showLoader();
      $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{NB_FUNCIONARIO:$('#NB_FUNCIONARIO').val(),
                                                                     TX_CARGO:$('#TX_CARGO').val(),
                                                                     ID_CONSELHO:$('#ID_CONSELHO').val(),
                                                                     NB_INSCRICAO_CONSELHO:$('#NB_INSCRICAO_CONSELHO').val(),
                                                                     TX_CURRICULO:$('#TX_CURRICULO').val(),
                                                                     TX_FORMACAO:$('#TX_FORMACAO').val()}, hideLoader);
      return false;
      }
      return false;
      });

   $('#excluir').live('click', function(){
    var href = $(this).attr('href');
		
		resp = window.confirm('Tem certeza que deseja excluir este Registro?');
		if (resp){
		   showLoader();
		   $('#tabela').load('acoes.php?identifier=excluir&ID='+href+'&ID_PESSOA_FUNCIONARIO='+$('#ID_PESSOA_FUNCIONARIO').val()+'&NB_FUNCIONARIO='+$('#NB_FUNCIONARIO').val(), hideLoader);
                }
                    
		return false;
        });
});