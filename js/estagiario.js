$(document).ready(function(){
	
	/*$.widget("ui.combobox", {
        _create: function() {
            var input,
                    that = this,
                    select = this.element.hide(),
                    selected = select.children(":selected"),
                    value = selected.val() ? selected.text() : "",
                    wrapper = this.wrapper = $("<span>")
                    .addClass("ui-combobox")
                    .insertAfter(select);

            function removeIfInvalid(element) {
                var value = $(element).val(),
                        matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(value) + "$", "i"),
                        valid = false;
                select.children("option").each(function() {
                    if ($(this).text().match(matcher)) {
                        this.selected = valid = true;
                        return false;
                    }
                });
                if (!valid) {
                    // remove invalid value, as it didn't match anything
                    $(element)
                            .val("")
                            .attr("title", value + " não encontrado")
                            .tooltip("open");
                    select.val("");
                    setTimeout(function() {
                        input.tooltip("close").attr("title", "");
                    }, 2500);
                    input.data("autocomplete").term = "";
                    return false;
                }
            }

            input = $("<input>")
                    .appendTo(wrapper)
                    .val(value)
                    .attr("title", "")
                    .addClass("")
                    .autocomplete({
                delay: 0,
                minLength: 3,
                source: function(request, response) {
                    var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
                    response(select.children("option").map(function() {
                        var text = $(this).text();
                        if (this.value && (!request.term || matcher.test(text)))
                            return {
                                label: text.replace(
                                        new RegExp(
                                        "(?![^&;]+;)(?!<[^<>]*)(" +
                                        $.ui.autocomplete.escapeRegex(request.term) +
                                        ")(?![^<>]*>)(?![^&;]+;)", "gi"
                                        ), "<strong>$1</strong>"),
                                value: text,
                                option: this
                            };
                    }));
                },
                select: function(event, ui) {
                    ui.item.option.selected = true;
                    that._trigger("selected", event, {
                        item: ui.item.option
                    });

                },
                change: function(event, ui) {
                    if (!ui.item)
                        return removeIfInvalid(this);
                }
            })
                    .addClass("ui-widget ui-widget-content");

            input.data("autocomplete")._renderItem = function(ul, item) {
                return $("<li>")
                        .data("item.autocomplete", item)
                        .append("<a>" + item.label + "</a>")
                        .appendTo(ul);
            };

        },
        destroy: function() {
            this.wrapper.remove();
            this.element.show();
            $.Widget.prototype.destroy.call(this);
        }
    });

    $("#ID_PESSOA_FUNCIONARIO").combobox();*/

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };
	
	$('#NB_CPF,#NB_RG').setMask({ mask:'99999999999' });
	$('#TX_AGENCIA,#TX_CONTA_CORRENTE').setMask({ mask:'***********' });
	$('#TX_CEP').setMask({ mask:'999999999' });
	$('#NB_NUMERO,#NB_PERIODO_ANO').setMask({ mask:'*****' });

	//Formatar Campos
	$('#DT_EMISSAO,#DT_NASCIMENTO').setMask({ mask:'99/99/9999' });
	
	$('#DT_EMISSAO,#DT_NASCIMENTO').datepicker({
		changeMonth: true,
        changeYear: true
	});

	//CEP
	$('#TX_CEP').blur(function() {
		if($.trim($('#TX_CEP').val()) != ""){
			$("#carregando").show();
			$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$('#TX_CEP').val(), function(){
				if(resultadoCEP["resultado"] != 0){
					//$('#TX_UF]').val(unescape(resultadoCEP["uf"]));
					//$('#TX_MUNICIPIO]').val(unescape(resultadoCEP["cidade"]));
					$('#TX_BAIRRO').val(unescape(resultadoCEP["bairro"]));
					$('#TX_ENDERECO').val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
					$("#carregando").hide();
					$('#NB_NUMERO').focus();
				}else{
					alert('Cep não encontrado, por favor verifique o cep digitado.');
					//$('#TX_UF]').val('');
					//$('#TX_MUNICIPIO]').val('');
					$('#TX_BAIRRO]').val('');
					$('#TX_ENDERECO]').val('');
					$("#carregando").hide();
					$('#TX_CEP]').focus();
				}
			});
		}else{
			//$('#TX_UF]').val('');
			//$('#TX_MUNICIPIO]').val('');
			$('#TX_BAIRRO]').val('');
			$('#TX_ENDERECO]').val('');
		}
	});

	$('#pesquisar').click(function(){
		if ($('#TX_NOME').val() || $('#NB_CPF').val()){
			showLoader();
			$('#tabela').load('acoes.php?identifier=tabela',{
					TX_NOME:$('#TX_NOME').val(),
					NB_CPF:$('#NB_CPF').val()
				}, hideLoader);
		}else
			alert('Preencha pelo menos um campo para realizar a pesquisa!');
    });
	
	
    //Paginacao
    $("#paginacao li").live('click', function(){
        showLoader();
        $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{
				TX_NOME:$('#TX_NOME').val(),
				NB_CPF:$('#NB_CPF').val()
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
			    ID_PESSOA_ESTAGIARIO:$(this).attr('href'),
				PAGE:$('.selecionado').text()
			}, hideLoader);
		}
					
		return false;
	});

    function validarCPF(cpf) {
        exp = /\.|-/g;
        cpf = cpf.toString().replace(exp, "");
        var digitoDigitado = eval(cpf.charAt(9) + cpf.charAt(10));
        var digitoGerado = 0;
        var soma1 = 0, soma2 = 0;
        var vlr = 11;

        for (i = 0; i < 9; i++) {
            soma1 += eval(cpf.charAt(i) * (vlr - 1));
            soma2 += eval(cpf.charAt(i) * vlr);
            vlr--;
        }

        soma1 = (soma1 % 11) < 2 ? 0 : 11 - (soma1 % 11);
        aux = soma1 * 2;
        soma2 = soma2 + aux;
        soma2 = (soma2 % 11) < 2 ? 0 : 11 - (soma2 % 11);

        if (cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555"
            || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999" || cpf == "00000000000") {
            digitoGerado = null;
        } else {
            digitoGerado = eval(soma1.toString().charAt(0) + soma2.toString().charAt(0));
        }

        if (digitoGerado != digitoDigitado) {
            return false;
        }
        return true;
    }

    //$("#TX_NOME,#NB_RG,#DT_NASCIMENTO,#CS_SEXO,#TX_CEP,#TX_ENDERECO,#NB_NUMERO,#TX_BAIRRO,#TX_COMPLEMENTO").val('');
    //$("#TX_CONTATO,#TX_EMAIL,#TX_AGENCIA,#TX_CONTA_CORRENTE,#ID_PESSOA_ESTAGIARIO").val('');
    $('#NB_CPF,#NB_RG').setMask({mask: '99999999999'});
    $('#TX_AGENCIA,#TX_CONTA_CORRENTE').setMask({mask: '***********'});
    $('#TX_CEP').setMask({mask: '999999999'});
    $('#NB_NUMERO,#NB_PERIODO_ANO').setMask({mask: '*****'});
    $('#DT_NASCIMENTO').setMask({mask: '99/99/9999'});
    $('#DT_NASCIMENTO').datepicker({
        changeMonth: true,
        changeYear: true
    });

    $('#NB_INICIO_HORARIO,#NB_FIM_HORARIO').setMask({mask: '99:99'});
    $('#NB_INICIO_HORARIO,#NB_FIM_HORARIO').timepicker();

    //CPF
    $("#NB_CPF").live('blur', function() {
        //if($.trim($('#NB_CPF').val()) != ""){
        if(validarCPF($("#NB_CPF").val())){
            $("#carregando1").show();
            $.getJSON('acoes.php',{
                NB_CPF:$('#NB_CPF').val(),
                identifier:'buscarCPF'
            }, function(campo) {
                //console.log();
                if(campo['ID_PESSOA'] != 0){
                    $("#TX_NOME").val(campo['TX_NOME'][0]);
                    $("#NB_RG").val(campo['NB_RG'][0]);
                    $("#DT_NASCIMENTO").val(campo['DT_NASCIMENTO'][0]);
                    $("#CS_SEXO").val(campo['CS_SEXO'][0]);
                    $("#TX_CEP").val(campo['TX_CEP'][0]);
                    $("#TX_ENDERECO").val(campo['TX_ENDERECO'][0]);
                    $("#NB_NUMERO").val(campo['NB_NUMERO'][0]);
                    $("#TX_BAIRRO").val(campo['TX_BAIRRO'][0]);
                    $("#TX_COMPLEMENTO").val(campo['TX_COMPLEMENTO'][0]);
                    $("#TX_CONTATO").val(campo['TX_CONTATO'][0]);
                    $("#TX_EMAIL").val(campo['TX_EMAIL'][0]);
                    $("#TX_AGENCIA").val(campo['TX_AGENCIA'][0]);
                    $("#TX_CONTA_CORRENTE").val(campo['TX_CONTA_CORRENTE'][0]);
                    $("#ID_PESSOA_ESTAGIARIO").val(campo['ID_PESSOA_ESTAGIARIO'][0]);
                    $("#ID_PESSOA").val(campo['ID_PESSOA'][0]);
                    $("#carregando1").hide();
                    $(".salvar").focus();
                }else{
                    //$("#TX_NOME,#NB_RG,#DT_NASCIMENTO,#CS_SEXO,#TX_CEP,#TX_ENDERECO,#NB_NUMERO,#TX_BAIRRO,#TX_COMPLEMENTO").val('');
                    //$("#TX_CONTATO,#TX_EMAIL,#TX_AGENCIA,#TX_CONTA_CORRENTE,#ID_PESSOA_ESTAGIARIO").val('');
                    $("#ID_PESSOA,#ID_PESSOA_ESTAGIARIO").val('');
                    $("#carregando1").hide();
                    //$("#TX_NOME").focus();
                }
            });
        }else{
            alert('CPF Inválido!');
            //$("#NB_CPF").val('');
            //$("#NB_CPF").focus();
            $(".cancelar").focus();
        }
    });

    //CEP
    $('#TX_CEP').blur(function() {
        if($.trim($('#TX_CEP').val()) != ""){
            $("#carregando2").show();
            $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$('#TX_CEP').val(), function(){
                if(resultadoCEP["resultado"] != 0){
                    //$('#TX_UF]').val(unescape(resultadoCEP["uf"]));
                    //$('#TX_MUNICIPIO]').val(unescape(resultadoCEP["cidade"]));
                    $('#TX_BAIRRO').val(unescape(resultadoCEP["bairro"]));
                    $('#TX_ENDERECO').val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
                    $("#carregando2").hide();
                    $('#NB_NUMERO').focus();
                }else{
                    alert('Cep não encontrado, por favor verifique o cep digitado.');
                    //$('#TX_UF]').val('');
                    //$('#TX_MUNICIPIO]').val('');
                    $('#TX_BAIRRO]').val('');
                    $('#TX_ENDERECO]').val('');
                    $("#carregando2").hide();
                    $('#TX_CEP]').focus();
                }
            });
        }else{
            //$('#TX_UF]').val('');
            //$('#TX_MUNICIPIO]').val('');
            $('#TX_BAIRRO]').val('');
            $('#TX_ENDERECO]').val('');
        }
    });
      

});