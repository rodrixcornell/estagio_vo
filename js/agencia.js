$(document).ready(function() {
 function showLoader() {
        $('.fundo_pag').fadeIn(200);
    }

function hideLoader() {
        $('.fundo_pag').fadeOut(200);
    }
    ;

//Formatar Campos
    $('input[name=DT_ATUALIZACAO]').setMask({ mask:'99/99/9999' });
    $('input[name=DT_CADASTRO]').setMask({ mask:'99/99/9999' });
   
//Calendario
    $('input[name=DT_ATUALIZACAO]').focus(function(){
    $(this).calendario({
      target:'#DT_ATUALIZACAO'
        });
    });

    $('input[name=DT_CADASTRO]').focus(function(){
    $(this).calendario({
            target:'#DT_CADASTRO'
        });
    });

//Pesquisar
  $('#pesquisar').click(function(){
         showLoader();
	 $('#tabela').load('acoes.php?identifier=tabela',{TX_AGENCIA_ESTAGIO:$('#TX_AGENCIA_ESTAGIO').val(),TX_SIGLA:$('#TX_SIGLA').val(),TX_CNPJ:$('#TX_CNPJ').val(),DT_CADASTRO:$('#DT_CADASTRO').val(),DT_ATUALIZACAO:$('#DT_ATUALIZACAO').val()}, hideLoader);
       return false;    
      });    
  
//Paginacao
$("#paginacao li").live('click', function(){
 showLoader();
 $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{TX_AGENCIA_ESTAGIO:$('#TX_AGENCIA_ESTAGIO').val(),TX_SIGLA:$('#TX_SIGLA').val(),TX_CNPJ:$('#TX_CNPJ').val(),DT_CADASTRO:$('#DT_CADASTRO').val(),DT_ATUALIZACAO:$('#DT_ATUALIZACAO').val()}, hideLoader);
 return false;
});
  
 $("#alterar").live('click', function() {
        var href = $(this).attr('href');
        $(window.document.location).attr('href', 'validacao.php?ID=' + href);
        return false;
    });
 
 //Inserir
  $('#inserir').live('click', function() {
   if (!$('#TX_AGENCIA_ESTAGIO').val()) {
          $('#TX_AGENCIA_ESTAGIO').focus();
      } else if (!$('#TX_SIGLA').val()) {
            $('#TX_SIGLA').focus();
      } else if (!$('#TX_CNPJ').val()) {
          $('#TX_CNPJ').focus();
      } else if (!$('#ID_USUARIO_ATUALIZACAO').val()) {
          $('#ID_USUARIO_ATUALIZACAO').focus();
      } else if (!$('#ID_USUARIO_CADASTRO').val()) {
          $('#ID_USUARIO_CADASTRO').focus();
       } else if (!$('#DT_CADASTRO').val()) {
            $('#DT_CADASTRO').focus();
       } else if (!$('#DT_ATUALIZACAO').val()) {
            $('#DT_ATUALIZACAO').focus();    
       } else {
            showLoader();
          $('#tabela').load('acoes.php?identifier=tabela&TX_AGENCIA_ESTAGIO='+$('#TX_AGENCIA_ESTAGIO').val()+'&TX_SIGLA='+$('#TX_SIGLA').val()+'&TX_CNPJ='+$('#TX_CNPJ').val()+'&DT_CADASTRO='+$('#DT_CADASTRO').val()+'&DT_ATUALIZACAO='+$('#DT_ATUALIZACAO').val(), hideLoader);
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