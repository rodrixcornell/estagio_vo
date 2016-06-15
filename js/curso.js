$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };

    //autocomplete----------------------------------------------

    $('#TX_CURSO_ESTAGIO').simpleAutoComplete('acoes.php', {
        autoCompleteClassName: 'autocomplete',
        selectedClassName: 'sel',
        identifier: 'curso'
    }, cursoCallback);

    function cursoCallback(par) {
        $("#ID_CURSO_ESTAGIO").val(par[0]);
    }

//-----------------------------------------------------------

    $('#pesquisar').click(function(){
        //if ($('#TX_CURSO_ESTAGIO').val() || $('#CS_AREA_CONHECIMENTO').val()){
            showLoader();
            $('#tabela').load('acoes.php?identifier=tabela',{
               TX_CURSO_ESTAGIO:$('#TX_CURSO_ESTAGIO').val(),
               CS_AREA_CONHECIMENTO:$('#CS_AREA_CONHECIMENTO').val()
            }, hideLoader);
       // }else
       //     alert('Preencha pelo menos um campo para realizar a pesquisa!');
    });

    //Paginacao
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{
           TX_CURSO_ESTAGIO:$('#TX_CURSO_ESTAGIO').val(),
            CS_AREA_CONHECIMENTO:$('#CS_AREA_CONHECIMENTO').val()
        }, hideLoader);
        return false;
    });

    //Icone Alterar
    $("#alterar").live('click', function(){
        var href = $(this).attr('href');
        $(window.document.location).attr('href','validacao.php?ID='+href);
        return false;
    });

    //Excluir
    $('#excluir').live('click', function(){

        resp = window.confirm('Tem certeza que deseja excluir este Registro?');
        if (resp){
            showLoader();
            $('#tabela').load('acoes.php?identifier=excluir',{
                ID_CURSO_ESTAGIO:$(this).attr('href'),
                TX_CURSO_ESTAGIO:$('#TX_CURSO_ESTAGIO').val(),
                CS_AREA_CONHECIMENTO:$('#CS_AREA_CONHECIMENTO').val(),
                PAGE:$('.selecionado').text()
            }, hideLoader);
        }

        return false;
    });

});
