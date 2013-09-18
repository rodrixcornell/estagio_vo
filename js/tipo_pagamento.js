$(document).ready(function() {

    function showLoader() {
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader() {
        $('.fundo_pag').fadeOut(200);
    }
	
	$('#CS_TIPO_PAG_ESTAGIO').setMask({ mask:'99999999' });

    $('#pesquisar').click(function() {
		showLoader();
		$('#tabela').load('acoes.php?identifier=tabela', {
			ID_GRUPO_PAGAMENTO: $('#ID_GRUPO_PAGAMENTO').val()
		}, hideLoader);
    });


    //Paginacao
    $("#paginacao li").live('click', function() {
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE=' + this.id, {
            ID_GRUPO_PAGAMENTO: $('#ID_GRUPO_PAGAMENTO').val()
        }, hideLoader);
        return false;
    });


    //Icone Alterar
    $("#alterar").live('click', function() {
        var href = $(this).attr('href');
        $(window.document.location).attr('href', 'validacao.php?ID=' + href);
        return false;
    });

    //Excluir
    $('#excluir').live('click', function() {

        resp = window.confirm('Tem certeza que deseja excluir este Registro?');
        if (resp) {
            showLoader();
            $('#tabela').load('acoes.php?identifier=excluir', {
                ID: $(this).attr('href'),
                PAGE: $('.selecionado').text()
            }, hideLoader);
        }

        return false;
    });

});