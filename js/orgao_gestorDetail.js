$(document).ready(function () {

    function showLoader() {
        $('.fundo_pag').fadeIn(200);
    }
    function hideLoader() {
        $('.fundo_pag').fadeOut(200);
    }
    ;

    function emptyHideLoader() {
        $('.fundo_pag').fadeOut(200);
        $("#TX_EMAIL").val('');
        $.getJSON('acoes.php?identifier=atualizarInf', atualizarInf);
        function atualizarInf(campo) {
            $("#atualizacao").html(campo['DT_ATUALIZACAO'][0]);
        }
    }
    ;


    // Inserção de Itens
    $('#inserir').live('click', function () {
        var emailValido = /^.+@.+\..{2,}$/;

        if (!$('#TX_EMAIL').val()) {
            alert('Para inserir preencha o campo E-mail!');
            $('#TX_EMAIL').focus();
        } else if (!emailValido.test($('#TX_EMAIL').val())) {
            alert('E-mail Inválido!');
            $('#TX_EMAIL').focus();
        } else {
            showLoader();
            $("#tabelaEmail").load('acoes.php?identifier=inserirEmail', {
                TX_EMAIL: $('#TX_EMAIL').val(),
                NB_ORGAO_GESTOR_EMAIL: $('#NB_EMAIL_GESTOR_ESTAGIO').val()
            }, emptyHideLoader);
            $('#TX_EMAIL').focus();
            $('#NB_EMAIL_GESTOR_ESTAGIO').focus;
        }
        return false;
    });

    //Exclusão de Itens
    $('#excluir').live('click', function () {
        var href = $(this).attr('href');

        resp = window.confirm('Tem certeza que deseja excluir este Registro?');
        if (resp) {
            showLoader();
            $("#tabelaEmail").load('acoes.php?identifier=excluirEmail&NB_EMAIL_GESTOR_ESTAGIO=' + href, emptyHideLoader);
            alert(NB_EMAIL_GESTOR_ESTAGIO);
        }
        return false;
    });


    //Excluir Master
//	$('#excluirMaster').click(function(){
//
//		if ($('.icones').length){
//			alert('Este registro não pode ser excluído pois possui dependentes.');
//			return false;
//		}else{
//			resp = window.confirm('Tem certeza que deseja excluir este Registro?');
//			if (!resp){
//				return false;
//			}
//		}
//
//	});


    showLoader();
    $("#tabelaEmail").load('acoes.php?identifier=tabelaEmail', hideLoader);
});