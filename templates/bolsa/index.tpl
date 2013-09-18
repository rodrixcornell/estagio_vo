<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />
	
            <div id="conteudo">
            	{*Mostra Botao de Novo Registro Somente se Tiver Acesso Completo a Tela*}
                {if $acesso}<br /><a href="{$url}src/{$pasta}/cadastrar.php" id="nova_rm"><img src="{$urlimg}icones/novo.png" /></a>{/if}
                
                <br /><br />
                				
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:130px;" ><strong>Bolsa de Estágio: </strong></div>
                    <select name="ID_BOLSA_ESTAGIO" id="ID_BOLSA_ESTAGIO" style="width:400px;">
                        {html_options options=$arrayBolsa selected=$VO->ID_BOLSA_ESTAGIO}
                    </select>
                    <br />
                    <br />
                
                <input type="button" name="pesquisar" id="pesquisar" value="Pesquisar" />

                    <script charset="UTF-8" type="text/javascript" language="JavaScript">
                    $(document).ready(function(){
                    	function showLoader(){ $('.fundo_pag').fadeIn(200); }
                    	function hideLoader(){ $('.fundo_pag').fadeOut(200); };
                    	
                    	
                    	if (!"{$s}"){
                    		showLoader();
                    		$("#tabela").load('acoes.php?identifier=tabela',{
                    		    ID:$(this).attr('href'),
                    			ID_BOLSA_ESTAGIO:"{$VO->ID_BOLSA_ESTAGIO}",
                    			PAGE:"{$VO->PAGE}"
                    		}, hideLoader); 
                   	}
                    	
                    });
                    </script>
                
                <br /><br />
                <div class="fundo_pag">
                    <img src="{$urlimg}icones/loader.gif" alt="">
                </div>
                
                <div id="tabela"></div><br />
                
                <br />

            </div>

</div>
