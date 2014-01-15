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

});