<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />
	
            <div id="conteudo">
            	{*Mostra Botao de Novo Registro Somente se Tiver Acesso Completo a Tela*}
                {if $acesso}<br /><a href="{$url}src/{$pasta}/cadastrar.php" id="nova_rm"><img src="{$urlimg}icones/novo.png" /></a>{/if}
                
                <br /><br />
				
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><strong>Tipo de Evento: </strong></div>
                    <select name="CS_TIPO" id="CS_TIPO" style="width:200px;">
                        {html_options options=$arrayTipoEvento selected=$VO->CS_TIPO}
                    </select><br />

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><strong>Situação do Evento: </strong></div>
                    <select name="CS_SITUACAO" id="CS_SITUACAO" style="width:200px;">
                        {html_options options=$arraySituacao selected=$VO->CS_SITUACAO}
                    </select><br />
                
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><strong>Código do Evento: </strong></div>
                    <input type="text" name="TX_CODIGO" id="TX_CODIGO" value="{$VO->TX_CODIGO}"  style="width:200px;" /><br />    
                
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><strong>Descrição do Evento: </strong></div>
                    <input type="text" name="TX_DESCRICAO" id="TX_DESCRICAO" value="{$VO->TX_DESCRICAO}"  style="width:400px;" /><br />    

                <br />
                                
                <input type="button" name="pesquisar" id="pesquisar" value="Pesquisar" />
                

<script charset="UTF-8" type="text/javascript" language="JavaScript">
$(document).ready(function(){
	function showLoader(){ $('.fundo_pag').fadeIn(200); }
	function hideLoader(){ $('.fundo_pag').fadeOut(200); };
	
	
	if ("{$VO->CS_TIPO}" || "{$VO->CS_SITUACAO}" || "{$VO->TX_CODIGO}" || "{$VO->TX_DESCRICAO}"){
		showLoader();
		$("#tabela").load('acoes.php?identifier=tabela',{
			CS_TIPO:"{$VO->CS_TIPO}",
			CS_SITUACAO:"{$VO->CS_SITUACAO}",
			TX_CODIGO:"{$VO->TX_CODIGO}",
            TX_DESCRICAO:"{$VO->TX_DESCRICAO}",			
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