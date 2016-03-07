$(document).ready(function(){
    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };

    $('#ID_ORGAO_GESTOR_ESTAGIO option').first().next().attr("selected","selected");
    $('#ID_ORGAO_GESTOR_ESTAGIO').attr("disabled","disabled");
    $('#ID_ORGAO_GESTOR_ESTAGIO').attr("readonly","readonly");

	$('#NB_QUANTIDADE,#NB_QTDE_EMCAMINHADO,#NB_SEMESTRE').setMask({
        mask:'999'
    });

	$('#DT_ENTREVISTA').setMask({  mask:'99/99/9999' });
	$('#DT_ENTREVISTA').datepicker({
        changeMonth: true,
        changeYear: true
    });


	$( "#NB_DURACAO_ESTAGIO" ).spinner({ min: 6, max: 24 });
	$('#NB_VALOR_TRANSPORTE').maskMoney({showSymbol:false, symbol:"R$", decimal:",", thousands:"."});
	$('#TX_HORA_INICIO,#TX_HORA_FINAL').setMask({ mask:'99:99:99' });
	$('#TX_HORA_INICIO,#TX_HORA_FINAL').timepicker({timeFormat: 'HH:mm:ss'});

    $('#pesquisar').click(function(){
        if ($('#ID_ORGAO_GESTOR_ESTAGIO').val() && $('#ID_ORGAO_ESTAGIO').val()){
            showLoader();
            $("#tabela").load('acoes.php?identifier=tabela',
            {
                ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
                CS_SITUACAO:$('#CS_SITUACAO').val(),
                TX_CODIGO_OFERTA_VAGA:$('#TX_CODIGO_OFERTA_VAGA').val()
            }, hideLoader);
        }else
            alert('Preencha todos os campos obrigatórios!');
    });

    //Paginacao
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,
        {
           		ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
                ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
                CS_SITUACAO:$('#CS_SITUACAO').val(),
                TX_CODIGO_OFERTA_VAGA:$('#TX_CODIGO_OFERTA_VAGA').val()
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
    $("#ID_ORGAO_ESTAGIO").live('change', function(){
		$("#ID_AGENCIA_ESTAGIO,#ID_QUADRO_VAGAS_ESTAGIO,#CS_TIPO_VAGA_ESTAGIO").html('');
		$("#TX_ORGAO_ESTAGIO,#TX_CNPJ").val('');

        if ($('#ID_ORGAO_ESTAGIO').val()){
			$("#ID_AGENCIA_ESTAGIO").html('<option>Carregando...</option>');
			$.post("acoes.php",{
                				ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
                				identifier:'buscarQuadroVagas'
            					},
			function(valor){
                $("#ID_QUADRO_VAGAS_ESTAGIO").val(valor);
            });


			$.post("acoes.php",{
                				ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
                				identifier:'buscarAgenciaEstagio'
            					},
			function(valor){
                $("#ID_AGENCIA_ESTAGIO").html(valor);
            });

			$.getJSON("acoes.php",{
                				ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
                				identifier:'buscarNomeOrgao'
            					},
			function(valor){
                $("#TX_ORGAO_ESTAGIO").val(valor['TX_UNIDADE_ORG'][0]);
				$("#TX_CNPJ").val(valor['TX_CNPJ'][0]);
            });

        }
        return false;
    });

	$("#ID_AGENCIA_ESTAGIO").live('change', function(){
		$("#CS_TIPO_VAGA_ESTAGIO").html('');
        if ($('#ID_AGENCIA_ESTAGIO').val()){
			$("#CS_TIPO_VAGA_ESTAGIO").html('<option>Carregando...</option>');
			$.post("acoes.php",{
								ID_QUADRO_VAGAS_ESTAGIO:$('#ID_QUADRO_VAGAS_ESTAGIO').val(),
								ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
                				ID_AGENCIA_ESTAGIO:$('#ID_AGENCIA_ESTAGIO').val(),
                				identifier:'buscarTipoVaga'
            					},
			function(valor){
                $("#CS_TIPO_VAGA_ESTAGIO").html(valor);
            });

        }
        return false;
    });


});