$(document).ready(function(){
    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };

    $('#pesquisar').click(function(){
       // if ($('#ID_ORGAO_GESTOR_ESTAGIO').val() && $('#ID_ORGAO_ESTAGIO').val() || ($('#ID_AGENCIA_ESTAGIO').val() || $('#CS_SITUACAO').val() || $.trim($('#TX_COD_SOLICITACAO').val()))){
            //alert('ok: '+$('#ID_ORGAO_GESTOR_ESTAGIO').val()+', '+$('#ID_ORGAO_ESTAGIO').val()+', '+$('#ID_AGENCIA_ESTAGIO').val()+', '+$('#CS_SITUACAO').val()+', '+$('#TX_COD_SOLICITACAO').val()+'.');
            showLoader();
            $("#tabela").load('acoes.php?identifier=tabela',
            {
                ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
                CS_SITUACAO:$('#CS_SITUACAO').val(),
                ID_TRANSFERENCIA_ESTAGIO:$('#ID_TRANSFERENCIA_ESTAGIO').val()
            }, hideLoader);
      //  }else
            //alert('Preencha pelo menos os campos \"Órgão Gestor e Órgão Solicitante\" para realizar pesquisa!');
    });

 /*      
 ID_ORGAO_GESTOR_ESTAGIO 
 ID_ORGAO_ESTAGIO
 CS_SITUACAO
 ID_TRANSFERENCIA_ESTAGIO    */
    //Paginacao
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,
        {
            ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
            ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
            CS_SITUACAO:$('#CS_SITUACAO').val(),
            ID_TRANSFERENCIA_ESTAGIO:$('#ID_TRANSFERENCIA_ESTAGIO').val()
        }, hideLoader);
        return false;
});

    //Icone Alterar
    $("#alterar").live('click', function(){
        var href = $(this).attr('href');
        $(window.document.location).attr('href','validacao.php?ID='+href);
        return false;
    });

    //Tela Cadastrar

    $("#ID_ORGAO_GESTOR_ESTAGIO").live('change', function(){
        if (!$('#ID_AGENCIA_ESTAGIO').val()){
            //alert('Para escolher Quadro de Vagas\n escolha um Agencia de Estágio.');
            $('#ID_AGENCIA_ESTAGIO').focus();
        }else{
            $.post("acoes.php",
            {
                ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                ID_AGENCIA_ESTAGIO:$('#ID_AGENCIA_ESTAGIO').val(),
                identifier:'pesquisarQuadroVagasEstagio'
            }, function(valor){
                //alert(valor);
                $("#ID_QUADRO_VAGAS_ESTAGIO").html(valor);
            });
        }
        return false;
    });

    $("#ID_AGENCIA_ESTAGIO").live('change', function(){
        if (!$('#ID_ORGAO_GESTOR_ESTAGIO').val()){
            //alert('Para escolher Quadro de Vagas\n escolha um Agencia de Estágio.');
            $('#ID_ORGAO_GESTOR_ESTAGIO').focus();
        }else{
            $.post("acoes.php",
            {
                ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                ID_AGENCIA_ESTAGIO:$('#ID_AGENCIA_ESTAGIO').val(),
                identifier:'pesquisarQuadroVagasEstagio'
            }, function(valor){
                //alert(valor);
                $("#ID_QUADRO_VAGAS_ESTAGIO").html(valor);
            });
        }
        return false;
    });

    $("#ID_QUADRO_VAGAS_ESTAGIO").live('click', function(){
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
        }*/
        return false;
    });

});