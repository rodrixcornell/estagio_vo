<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />
	
            <div id="conteudo">
            	{*Mostra Botao de Novo Registro Somente se Tiver Acesso Completo a Tela*}
                {if $acesso}<br /><a href="{$url}src/{$pasta}/cadastrar.php" id="nova_rm"><img src="{$urlimg}icones/novo.png" /></a>{/if}
                
                <br /><br />
				
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><strong>Usuário: </strong></div>
                    <select name="ID_USUARIO_RESP" id="ID_USUARIO_RESP" style="width:200px;">
                        {html_options options=$arrayUsuario selected=$VO->ID_USUARIO_RESP}
                    </select><br />
                
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><strong>Funcionário: </strong></div>
                    <input type="text" name="TX_FUNCIONARIO" id="TX_FUNCIONARIO" value="{$VO->TX_FUNCIONARIO}"  style="width:400px;" /><br />    
                
                
                
                <input type="button" name="pesquisar" id="pesquisar" value="Pesquisar" />
                
<script charset="UTF-8" type="text/javascript" language="JavaScript">
$(document).ready(function(){
	function showLoader(){ $('.fundo_pag').fadeIn(200); }
	function hideLoader(){ $('.fundo_pag').fadeOut(200); };
	
	
	if (!"{$s}"){
		showLoader();
		$("#tabela").load('acoes.php?identifier=tabela',{
			ID_USUARIO_RESP:"{$VO->ID_USUARIO_RESP}",
			TX_FUNCIONARIO:"{$VO->TX_FUNCIONARIO}",
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