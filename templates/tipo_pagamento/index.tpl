<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />
	
            <div id="conteudo">
            	{*Mostra Botao de Novo Registro Somente se Tiver Acesso Completo a Tela*}
                {if $acesso}<br /><a href="{$url}src/{$pasta}/cadastrar.php" id="nova_rm"><img src="{$urlimg}icones/novo.png" /></a>{/if}
                
                <br /><br /><br />
                    			
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" ><strong>Tipo de Pagamento: </strong></div>
                    <select name="CS_TIPO_PAG_ESTAGIO" id="CS_TIPO_PAG_ESTAGIO" style="width:300px;">
                        {html_options options=$pesquisarTipo selected=$VO->CS_TIPO_PAG_ESTAGIO}
                    </select><br />
                
                <br /><br />
                    
                <input type="button" name="pesquisar" id="pesquisar" value="Pesquisar" />

<script charset="UTF-8" type="text/javascript" language="JavaScript">
$(document).ready(function(){
	function showLoader(){ $('.fundo_pag').fadeIn(200); }
	function hideLoader(){ $('.fundo_pag').fadeOut(200); };
	
	
	if ("{$VO->CS_TIPO_PAG_ESTAGIO}" ){
		showLoader();
		$("#tabela").load('acoes.php?identifier=tabela',{
			CS_TIPO_PAG_ESTAGIO:"{$VO->CS_TIPO_PAG_ESTAGIO}",
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
