$(document).ready(function(){
    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };
    
//----------------------DATA DE SOLICITACAO DA TELA CADASTRO--------------------
    $('#DT_SOLICITACAO').setMask({mask:'99/99/9999'});

    $('#DT_SOLICITACAO').datepicker({
        changeMonth: true,
        changeYear: true
    });
    
//---------------------------ICONE ALTERAR--------------------------------------    
    $('#pesquisar').click(function(){
      //  if ($('#ID_ORGAO_GESTOR_ESTAGIO').val()){
            showLoader();
            $("#tabela").load('acoes.php?identifier=tabela',
            {
                ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                ID_SOLICITACAO_TA_CP:$('#ID_SOLICITACAO_TA_CP').val(),
                ID_ADITIVO_CONTRATO_CP:$('#ID_ADITIVO_CONTRATO_CP').val(),
                ID_CONTRATO_CP:$('#ID_CONTRATO_CP').val(),
                TX_CODIGO:$('#TX_CODIGO').val()
            }, hideLoader);
      //  }else
          //  alert('Preencha pelo menos os campos \"Órgão Gestor\" para realizar pesquisa!');
    });

    //PAGINACAO
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,
        {
                ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                ID_ADITIVO_CONTRATO_CP:$('#ID_ADITIVO_CONTRATO_CP').val(),
                ID_CONTRATO_CP:$('#ID_CONTRATO_CP').val(),
                TX_CODIGO:$('#TX_CODIGO').val()
        }, hideLoader);
        return false;
    });

//------------------------------------------------------------------------------
    $("#alterar").live('click', function(){
        var href = $(this).attr('href');
        $(window.document.location).attr('href','validacao.php?ID='+href);
        return false;
    });

//---------------------------TELA CADASTRAR-------------------------------------
$("#ID_UNIDADE_ORG_ORIGEM").live('change', function(){
	$("#ID_UNIDADE_ORG_DESTINO").html('<option>Carregando...</option>'); 
       
       if ($('#ID_UNIDADE_ORG_ORIGEM').val()){
			$.post("acoes.php",{
                            ID_UNIDADE_ORG_ORIGEM:$('#ID_UNIDADE_ORG_ORIGEM').val(),
                	    identifier:'gerarDestino' }, 
            
			function(valor){
                $("#ID_UNIDADE_ORG_DESTINO").html(valor);
            });		 
        }
        return false;
    });
/*/------------------------------------------------------------------------------	
	$("#ID_AGENCIA_ESTAGIO").live('change', function(){
		$("#ID_QUADRO_VAGAS_ESTAGIO").html(''); 
        if ($('#ID_AGENCIA_ESTAGIO').val()){
			$.post("acoes.php",{
			       ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
                	                ID_AGENCIA_ESTAGIO:$('#ID_AGENCIA_ESTAGIO').val(),
                	           identifier:'buscarQuadroVagasEstagio'},
                               
			function(valor){
                $("#ID_QUADRO_VAGAS_ESTAGIO").html(valor);
            });		 
        }
        return false;
    });*/
//------------------------------------------------------------------------------

 
 

  /*  $("#ID_QUADRO_VAGAS_ESTAGIO").live('click', function(){
        //alert("Key: " + event.which);
        if (!$('#ID_ORGAO_GESTOR_ESTAGIO').val()){
            alert('Para escolher Quadro de Vagas\n escolha um Órgão Gestor.');
            $('#ID_ORGAO_GESTOR_ESTAGIO').focus();
        }else if (!$('#ID_AGENCIA_ESTAGIO').val()){
            alert('Para escolher Quadro de Vagas\n escolha um Agencia de Estágio.');
            $('#ID_AGENCIA_ESTAGIO').focus();
        }/*else{
            alert($('#ID_ORGAO_GESTOR_ESTAGIO').val()+' '+$('#ID_AGENCIA_ESTAGIO').val());
            $.post("acoes.php",
            {
                ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                ID_AGENCIA_ESTAGIO:$('#ID_AGENCIA_ESTAGIO').val(),
                identifier:'pesquisarQuadroVagasEstagio'
            }, function(valor){
                //alert(valor);
                $("#ID_QUADRO_VAGAS_ESTAGIO").html(valor);
                $("#ID_QUADRO_VAGAS_ESTAGIO").live('change', function(){
                    alert($("#ID_QUADRO_VAGAS_ESTAGIO").val());
                });
                return false;
            });
        }
        return false;
    });*/

}); 
 
