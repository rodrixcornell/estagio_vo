$(document).ready(function() {
 function showLoader() {
        $('.fundo_pag').fadeIn(200);
    }

function hideLoader() {
        $('.fundo_pag').fadeOut(200);
    }
    ;
    

//Pesquisar
  $('#pesquisar').click(function(){
         showLoader();
	 $('#tabela').load('acoes.php?identifier=tabela',{NB_FUNCIONARIO:$('#NB_FUNCIONARIO').val(),TX_CARGO:$('#TX_CARGO').val(),,TX_FORMACAO:$('#TX_FORMACAO').val()}, hideLoader);
       return false;    
      });    
  
//Paginacao
$("#paginacao li").live('click', function(){
 showLoader();
 $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{TX_NOME:$('#TX_NOME').val(),TX_CARGO:$('#TX_CARGO').val(),TX_FORMACAO:$('#TX_FORMACAO').val()}, hideLoader);
 return false;
});
  
 $("#alterar").live('click', function() {
        var href = $(this).attr('href');
        $(window.document.location).attr('href', 'validacao.php?ID=' + href);
        return false;
    });
 
 //Inserir
  $('#inserir').live('click', function() {
   if (!$('#TX_NOME').val()) {
           $('#TX_NOME').focus();
      } else if (!$('#NB_FUNCIONARIO').val()) {
           $('#NB_FUNCIONARIO').focus();
      } else if (!$('#TX_CONSELHO').val()) {
           $('#TX_CONSELHO').focus();
      } else if (!$('#TX_FORMACAO').val()) {
           $('#TX_FORMACAO').focus();
      } else if (!$('#TX_CARGO').val()) {
           $('#TX_CARGO').focus();
       } else if (!$('#TX_CURRICULO').val()) {
           $('#TX_CURRICULO').focus();
       } else if (!$('#ID_PESSOA_FUNCIONARIO').val()) {
           $('#ID_PESSOA_FUNCIONARIO').focus(); 
       } else if (!$('#ID_PESSOA_SUPERVISOR').val()) {
           $('#ID_PESSOA_SUPERVISOR').focus();    
       } else {
            showLoader();
          $('#tabela').load('acoes.php?identifier=tabela&TX_FUNCIONARIO='+$('#TX_FUNCIONARIO').val()+'&TX_CARGO='+$('#TX_CARGO').val()+'&TX_FORMACAO='+$('#TX_FORMACAO').val(), hideLoader);
        return false;
      }
        return false;
    });
     
 //Excluir 
   $('#excluir').live('click', function(){
    var href = $(this).attr('href');
		
		resp = window.confirm('Tem certeza que deseja excluir este Registro?');
		if (resp){
		   showLoader();
		   $('#tabela').load('acoes.php?identifier=excluir&ID='+href+'&TX_AGENCIA_ESTAGIO='+$('#TX_AGENCIA_ESTAGIO').val(), hideLoader);
                }
                    
		return false;
        });
               
});