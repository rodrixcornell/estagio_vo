$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };
     $('#TX_CNPJ').setMask({ mask:'99.999.999/9999-99' });

    $('#pesquisar').click(function(){
        //if ($('#TX_ORGAO_GESTOR_ESTAGIO').val() || $('#ID_UNIDADE_ORG').val()){
        showLoader();
        $('#tabela').load('acoes.php?identifier=tabela',{
            TX_ORGAO_GESTOR_ESTAGIO:$('#TX_ORGAO_GESTOR_ESTAGIO').val(),
            ID_UNIDADE_ORG:$('#ID_UNIDADE_ORG').val()
        }, hideLoader);
    //}else
    //alert('Preencha pelo menos um campo para realizar a pesquisa!');
    });
	
    //Paginacao
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{
            TX_ORGAO_GESTOR_ESTAGIO:$('#TX_ORGAO_GESTOR_ESTAGIO').val(),
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
	
    //Excluir
//    $('#excluir').live('click', function(){
//		
//        resp = window.confirm('Tem certeza que deseja excluir este Registro?');
//        if (resp){
//            showLoader();
//            $('#tabela').load('acoes.php?identifier=excluir',{
//                ID_ORGAO_GESTOR_ESTAGIO:$(this).attr('href'),
//                TX_ORGAO_GESTOR_ESTAGIO:$('#TX_ORGAO_GESTOR_ESTAGIO').val(),
//                ID_UNIDADE_ORG:$('#ID_UNIDADE_ORG').val(),
//                PAGE:$('.selecionado').text()
//            }, hideLoader);
//        }
//					
//        return false;
//    });

});