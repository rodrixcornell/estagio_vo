$(document).ready(function(){
    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };
//-----------pesquisa principal-------------------------------------------------
    $('#pesquisar').click(function(){
        //if ($('#ID_ORGAO_GESTOR_ESTAGIO').val() || $('#ID_ORGAO_SOLICITANTE').val()){
            showLoader();
            $("#tabela").load('acoes.php?identifier=tabela',
            {
                ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                ID_ORGAO_SOLICITANTE:$('#ID_ORGAO_SOLICITANTE').val(),
                ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
                CS_SITUACAO:$('#CS_SITUACAO').val(),
                TX_COD_TRANSFERENCIA:$('#TX_COD_TRANSFERENCIA').val()
            }, hideLoader);
        //}else
          //alert('Preencha pelo menos os campos \"Órgão Gestor e Órgão Solicitante\" para realizar pesquisa!');
    });
 
   //------------Paginacao da pesquisa------------------------------------------
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,
        {
            ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
            ID_ORGAO_SOLICITANTE:$('#ID_ORGAO_SOLICITANTE').val(),
            ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
            CS_SITUACAO:$('#CS_SITUACAO').val(),
            TX_COD_TRANSFERENCIA:$('#TX_COD_TRANSFERENCIA').val()
        }, hideLoader);
        return false;
    });

//---------------Icone Alterar--------------------------------------------------
    $("#alterar").live('click', function(){
        var href = $(this).attr('href');
        $(window.document.location).attr('href','validacao.php?ID='+href);
        return false;
    });

//----------------------------- CADASTRAR --------------------------------------

$("#ID_ORGAO_SOLICITANTE").live('change', function(){
		$("#ID_ORGAO_ESTAGIO,#ID_QUADRO_VAGAS_ESTAGIO").html('<option>Carregando...</option>'); 
       
       if ($('#ID_ORGAO_SOLICITANTE').val()){
			$.post("acoes.php",{
                            ID_ORGAO_SOLICITANTE:$('#ID_ORGAO_SOLICITANTE').val(),
                	    identifier:'pesquisarOrgaoCedente' }, 
                        
			function(valor){
                $("#ID_ORGAO_ESTAGIO").html(valor);
            });
			 
        }
        return false;
    });
    
//------------------------------------------------------------------------------    
//------------------------------------------------------------------------------
    $("#ID_ORGAO_ESTAGIO").live('change', function(){
		$("#ID_QUADRO_VAGAS_ESTAGIO").html(''); 
       
       if ($('#ID_ORGAO_ESTAGIO').val()){
			$.post("acoes.php",{
                            ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
                            ID_ORGAO_SOLICITANTE:$('#ID_ORGAO_SOLICITANTE').val(),
                	    identifier:'buscarQuadroVagasEstagio' }, 
                        
			function(valor){
                $("#ID_QUADRO_VAGAS_ESTAGIO").html(valor);
            });
			 
        }
        return false;
    });
	

});