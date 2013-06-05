<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />
	
            <div id="conteudo">
            	{*Mostra Botao de Novo Registro Somente se Tiver Acesso Completo a Tela*}
                {if $acesso}<br /><a href="{$url}src/{$pasta}/cadastrar.php" id="nova_rm"><img src="{$urlimg}icones/novo.png" /></a>{/if}
                
                <br /><br />
                
                 <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:80px;" ><strong>CPF:</strong></div>
                    <input type="text" name="NB_CPF" id="NB_CPF" value="{$VO->NB_CPF}" style="width:120px;" /><br />

                 <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:80px;" ><strong>Nome:</strong></div>
                    <input type="text" name="TX_NOME" id="TX_NOME" value="{$VO->TX_NOME}" style="width:400px;" /><br />
                    <br />

                <input type="button" name="pesquisar" id="pesquisar" value="Pesquisar" />

                   <script charset="UTF-8" type="text/javascript" language="JavaScript">
                    $(document).ready(function(){
                    	function showLoader(){ $('.fundo_pag').fadeIn(200); }
                    	function hideLoader(){ $('.fundo_pag').fadeOut(200); };
                    	
                    	
                    	if ("{$VO->TX_NOME}" || "{$VO->NB_CPF}"){
                    		showLoader();
                    		$("#tabela").load('acoes.php?identifier=tabela',{
                    		    TX_NOME:"{$VO->TX_NOME}",
                    			NB_CPF:"{$VO->NB_CPF}",
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
