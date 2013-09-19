$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };
	

    $('#pesquisar').click(function(){
        if ($('#ID_ORGAO_GESTOR_ESTAGIO').val() && $('#ID_ORGAO_ESTAGIO').val()){
            showLoader();
            $('#tabela').load('acoes.php?identifier=tabela',{
                ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
                CS_SITUACAO:$('#CS_SITUACAO').val(),
                TX_COD_RECRUTAMENTO:$('#TX_COD_RECRUTAMENTO').val()
            }, hideLoader);
        }else
            alert('Preencha pelo menos os campos \"Órgão Gestor e Órgão Solicitante\" para realizar pesquisa!');
    });
	
    //Paginacao
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{
            ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
            ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
            CS_SITUACAO:$('#CS_SITUACAO').val(),
            TX_COD_RECRUTAMENTO:$('#TX_COD_RECRUTAMENTO').val()
        }, hideLoader);
        return false;
    });
	
	
	
    //Icone Alterar
    $("#alterar").live('click', function(){
        var href = $(this).attr('href');
        $(window.document.location).attr('href','validacao.php?ID='+href);
        return false;
    });
	
	
	
    $("#ID_ORGAO_GESTOR_ESTAGIO").live('change', function(){
        $("#ID_ORGAO_ESTAGIO,#ID_SOLICITACAO_ESTAGIO,#ID_QUADRO_VAGAS_ESTAGIO").html(''); 
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
	
	
    $("#ID_ORGAO_ESTAGIO").live('change', function(){
        $("#ID_SOLICITACAO_ESTAGIO,#ID_QUADRO_VAGAS_ESTAGIO").html(''); 
        if ($('#ID_ORGAO_ESTAGIO').val()){
            $("#ID_SOLICITACAO_ESTAGIO").html('<option>Carregando...</option>');
            $.post("acoes.php",{
                ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
                identifier:'buscarSolicitacao'
            }, 
            function(valor){
                $("#ID_SOLICITACAO_ESTAGIO").html(valor);
            });
        }
        return false;
    });
	
    $("#ID_SOLICITACAO_ESTAGIO").live('change', function(){
        $("#ID_QUADRO_VAGAS_ESTAGIO").html(''); 
        if ($('#ID_SOLICITACAO_ESTAGIO').val()){
            $("#ID_QUADRO_VAGAS_ESTAGIO").html('<option>Carregando...</option>');
            $.post("acoes.php",{
                ID_SOLICITACAO_ESTAGIO:$('#ID_SOLICITACAO_ESTAGIO').val(),
                identifier:'buscarQuadroVagas'
            }, 
            function(valor){
                $("#ID_QUADRO_VAGAS_ESTAGIO").html(valor);
            });
        }
        return false;
    });
       
    /*
     * 
     * funções para relatorio 
     * 
     */
   $('#ID_ORGAO_ESTAGIO_REL').change(function(){
        if($('#ID_ORGAO_ESTAGIO_REL').val()){
            $("#CS_SITUACAO_REL option:first").attr('selected','selected');
            $("#CS_SITUACAO_REL").attr("disabled",false);
        }else {
            $("#CS_SITUACAO_REL option:first").attr('selected','selected');
            $("#CS_SITUACAO_REL").attr("disabled",true);
              
        }
    });
    $('#CS_SITUACAO_REL').change(function(){
        if($('#CS_SITUACAO_REL').val()){
            $("#ID_RECRUTAMENTO_ESTAGIO_REL option:first").attr('selected','selected');
            $("#ID_RECRUTAMENTO_ESTAGIO_REL").attr("disabled",false);
            var valor = $('#ID_ORGAO_ESTAGIO_REL').val().split('_');
            $.post("acoes.php",{
                ID_ORGAO_ESTAGIO:valor[0],
                CS_SITUACAO:$('#CS_SITUACAO_REL').val()  
    
            }, 
            function(valor){
                $("#ID_RECRUTAMENTO_ESTAGIO_REL").html(valor);
            });
        }
        if (!$('#CS_SITUACAO_REL').val()){
            $("#ID_RECRUTAMENTO_ESTAGIO_REL option:first").attr('selected','selected');
            $("#ID_RECRUTAMENTO_ESTAGIO_REL").attr("disabled",true);
              
        }
    });
/*
     * 
     * Fim funções para relatorio 
     * 
     */
    
	
});