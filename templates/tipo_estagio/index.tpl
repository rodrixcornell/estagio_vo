<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />
	
            <div id="conteudo">
            	{*Mostra Botao de Novo Registro Somente se Tiver Acesso Completo a Tela*}
                {if $acesso}<br /><a href="{$url}src/{$pasta}/cadastrar.php" id="nova_rm"><img src="{$urlimg}icones/novo.png" /></a>{/if}
                
                <br /><br />

                 <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" ><strong>Código do Tipo: </strong></div>
                    <input type="text" name="CS_TIPO_VAGA_ESTAGIO" id="CS_TIPO_VAGA_ESTAGIO" value="{$VO->CS_TIPO_VAGA_ESTAGIO}" style="width:100px;" /><br />

                 <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" ><strong>Descrição do Tipo: </strong></div>
                    <input type="text" name="TX_TIPO_VAGA_ESTAGIO" id="TX_TIPO_VAGA_ESTAGIO" value="{$VO->TX_TIPO_VAGA_ESTAGIO}" style="width:400px;" /><br />

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
                    			CS_TIPO_VAGA_ESTAGIO:"{$VO->CS_TIPO_VAGA_ESTAGIO}",
                    			TX_TIPO_VAGA_ESTAGIO:"{$VO->TX_TIPO_VAGA_ESTAGIO}",
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
