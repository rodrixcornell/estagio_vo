$(document).ready(function() {

    function showLoader() {
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader() {
        $('.fundo_pag').fadeOut(200);
    }
    ;

    //fomatar campos datas

    $('#DT_ADITIVO,#DT_INICIO_VIGENCIA,#DT_FIM_VIGENCIA').setMask({mask: '99/99/9999'});

    //Calendario
    $('#DT_ADITIVO,#DT_INICIO_VIGENCIA,#DT_FIM_VIGENCIA').datepicker({
        changeMonth: true,
        changeYear: true
    });

    $('#pesquisar').click(function() {
        if ($('#ID_ORGAO_GESTOR_ESTAGIO').val()) {
            showLoader();
            $('#tabela').load('acoes.php?identifier=tabela', {
                ID_ORGAO_GESTOR_ESTAGIO: $('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                NB_CODIGO: $('#ID_CONTRATO_CP').val(),
                TX_TERMO_ADITIVO: $('#TX_TERMO_ADITIVO').val()
            }, hideLoader);
        } else
            alert('Preencha pelo menos um campo para realizar a pesquisa!');
    });

    //Paginacao
    $("#paginacao li").live('click', function() {
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE=' + this.id, {
            ID_ORGAO_GESTOR_ESTAGIO: $('#ID_ORGAO_GESTOR_ESTAGIO').val(),
            NB_CODIGO: $('#NB_CODIGO').val(),
            TX_TERMO_ADITIVO: $('#TX_TERMO_ADITIVO').val()
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
                ID_ADITIVO_CONTRATO_CP: $(this).attr('href'),
                PAGE: $('.selecionado').text()
            }, hideLoader);
        }

        return false;
    });

});