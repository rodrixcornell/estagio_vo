$(document).ready(function(){

    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }

    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };

    $.widget( "ui.combobox", {
        _create: function() {
            var input,
                that = this,
                select = this.element.hide(),
                selected = select.children( ":selected" ),
                value = selected.val() ? selected.text() : "",
                wrapper = this.wrapper = $( "<span>" )
                    .addClass( "ui-combobox" )
                    .insertAfter( select );

            function removeIfInvalid(element) {
                var value = $( element ).val(),
                    matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( value ) + "$", "i" ),
                    valid = false;
                select.children( "option" ).each(function() {
                    if ( $( this ).text().match( matcher ) ) {
                        this.selected = valid = true;
                        return false;
                    }
                });
                if ( !valid ) {
                    // remove invalid value, as it didn't match anything
                    $( element )
                        .val( "" )
                        .attr( "title", value + " não encontrado" )
                        .tooltip( "open" );
                    select.val( "" );
                    setTimeout(function() {
                        input.tooltip( "close" ).attr( "title", "" );
                    }, 2500 );
                    input.data( "autocomplete" ).term = "";
                    return false;
                }
            }

            input = $( "<input>" )
                .appendTo( wrapper )
                .val( value )
                .attr( "title", "" )
                .addClass( "" )
                .autocomplete({
                    delay: 0,
                    minLength: 3,
                    source: function( request, response ) {
                        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
                        response( select.children( "option" ).map(function() {
                            var text = $( this ).text();
                            if ( this.value && ( !request.term || matcher.test(text) ) )
                                return {
                                    label: text.replace(
                                        new RegExp(
                                            "(?![^&;]+;)(?!<[^<>]*)(" +
                                            $.ui.autocomplete.escapeRegex(request.term) +
                                            ")(?![^<>]*>)(?![^&;]+;)", "gi"
                                        ), "<strong>$1</strong>" ),
                                    value: text,
                                    option: this
                                };
                        }) );
                    },
                    select: function( event, ui ) {
                        ui.item.option.selected = true;
                        that._trigger( "selected", event, {
                            item: ui.item.option
                        });
                    },
                    change: function( event, ui ) {
                        if ( !ui.item )
                            return removeIfInvalid( this );
                    }
                })
                .addClass( "ui-widget ui-widget-content input-formatacao" );

            input.data( "autocomplete" )._renderItem = function( ul, item ) {
                return $( "<li>" )
                    .data( "item.autocomplete", item )
                    .append( "<a>" + item.label + "</a>" )
                    .appendTo( ul );
            };

            $( "<a>" )
                .attr( "tabIndex", -1 )
                .attr( "title", "Mostrar Todos Itens" )
                .tooltip()
                .appendTo( wrapper )
                .button({
                    icons: {
                        primary: "ui-icon-triangle-1-s"
                    },
                    text: false
                })


                .click(function() {
                    // close if already visible
                    input.autocomplete({ minLength: 0 });
                    if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
                        input.autocomplete( "close" );
                        removeIfInvalid( input );
                        return;
                    }

                    // work around a bug (likely same cause as #5265)
                    $( this ).blur();

                    // pass empty string as value to search for, displaying all results
                    input.autocomplete( "search", "" );
                    input.focus();
                });

            input
                .tooltip({
                    position: {
                        of: this.button
                    },
                    tooltipClass: "ui-state-highlight"
                });
        },

        destroy: function() {
            this.wrapper.remove();
            this.element.show();
            $.Widget.prototype.destroy.call( this );
        }
    });

    $( "#TX_INSTITUICAO_ENSINO" ).combobox();



// Pesquisar por unidade 
    $('#pesquisar').click(function(){
        showLoader();
	    $('#tabela').load('acoes.php?identifier=tabela',{TX_INSTITUICAO_ENSINO:$('#TX_INSTITUICAO_ENSINO').val(),TX_SIGLA:$('#TX_SIGLA').val()}, hideLoader);
        return false;
    });
  
//Paginacao
$("#paginacao li").live('click', function(){
 showLoader();
 $("#tabela").load('acoes.php?identifier=tabela&PAGE='+this.id,{TX_INSTITUICAO_ENSINO:$('#TX_INSTITUICAO_ENSINO').val(),TX_SIGLA:$('#TX_SIGLA').val()}, hideLoader);
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
			    ID_INSTITUICAO_ENSINO:$(this).attr('href'),
				TX_INSTITUICAO_ENSINO:$('#TX_INSTITUICAO_ENSINO').val(),
				TX_SIGLA:$('#TX_SIGLA').val(),
				PAGE:$('.selecionado').text()
			}, hideLoader);
		}
					
		return false;
	});

});