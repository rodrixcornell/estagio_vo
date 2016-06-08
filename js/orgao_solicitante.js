$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };

      $('#TX_CNPJ').setMask({
        mask:'99.999.999/9999-99'
    });


  //-------------autocomplete unidade---------------------

      $('#ID_UNIDADE_ORG').simpleAutoComplete('acoes.php', {
          autoCompleteClassName: 'autocomplete',
          selectedClassName: 'sel',
          identifier: 'itens'
      }, unidadeCallback);

      function unidadeCallback(par) {
          $("#ID_UNIDADE_ORG").val(par[0]);
          if (par[0] != 0) {
              $('#TX_UNIDADE_ORGANIZACIONAL').attr('disabled', false);
              $('#TX_UNIDADE_ORGANIZACIONAL').val('');
              $('#TX_UNIDADE_ORGANIZACIONAL').focus();
              $('#TX_UNIDADE_ORGANIZACIONAL').val('');
          } else {
              $('#TX_UNIDADE_ORGANIZACIONAL').attr('disabled', true);
              $('#TX_UNIDADE_ORGANIZACIONAL').val('');
              $('#ID_UNIDADE_ORG').val('');
          }
      }

      $('#TX_UNIDADE_ORGANIZACIONAL').simpleAutoComplete('acoes.php', {
          autoCompleteClassName: 'autocomplete',
          selectedClassName: 'sel',
          identifier: 'item',
          extraParamFromInput: '#ID_UNIDADE_ORG'
      }, itemCallBack);

      function itemCallBack(par) {
          $("#ID_UNIDADE_ORG").val(par[0]);
      }

  	//--------fim autocomplete----------------


    $('#pesquisar').click(function(){
       // if ($('#TX_ORGAO_ESTAGIO').val() || $('#ID_UNIDADE_ORG').val()){
            showLoader();
            $('#tabela').load('acoes.php?identifier=tabela',{
                TX_ORGAO_ESTAGIO:$('#TX_ORGAO_ESTAGIO').val(),
                ID_UNIDADE_ORG:$('#ID_UNIDADE_ORG').val(),
                CS_STATUS:$('#CS_STATUS').val()

            }, hideLoader);
        //}else
         //   alert('Preencha pelo menos um campo para realizar a pesquisa!');
    });

    //Paginacao
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{
            TX_ORGAO_ESTAGIO:$('#TX_ORGAO_ESTAGIO').val(),
            ID_UNIDADE_ORG:$('#ID_UNIDADE_ORG').val()

        }, hideLoader);
        return false;
    });


    //Icone Alterar
    $("#alterar").live('click', function(){
        var href = $(this).attr('href');
        $(window.document.location).attr('href','validacao.php?ID='+href);
        return false;
    });

});
