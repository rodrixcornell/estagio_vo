<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />
	
            <div id="conteudo">
            	{*Mostra Botao de Novo Registro Somente se Tiver Acesso Completo a Tela*}
                {if $acesso}<br /><a href="{$url}src/{$pasta}/cadastrar.php" id="nova_rm"><img src="{$urlimg}icones/novo.png" /></a>{/if}
                
                <br /><br />
                
                 <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" ><strong>Nome do Curso: </strong></div>
                    <input type="text" name="TX_CURSO_ESTAGIO" id="TX_CURSO_ESTAGIO" value="{$VO->TX_CURSO_ESTAGIO}" style="width:400px;" /><br />
				
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" ><strong>Área de Conhecimento: </strong></div>
                    <select name="CS_AREA_CONHECIMENTO" id="CS_AREA_CONHECIMENTO" style="width:400px;">
                        {html_options options=$arrayUnidade selected=$VO->CS_AREA_CONHECIMENTO}
                    </select><br />
                
                <input type="button" name="pesquisar" id="pesquisar" value="Pesquisar" />

<script charset="UTF-8" type="text/javascript" language="JavaScript">
$(document).ready(function(){
	function showLoader(){ $('.fundo_pag').fadeIn(200); }
	function hideLoader(){ $('.fundo_pag').fadeOut(200); };
	
	
	if ("{$VO->TX_CURSO_ESTAGIO}" || "{$VO->CS_AREA_CONHECIMENTO}"){
		showLoader();
		$("#tabela").load('acoes.php?identifier=tabela',{
			TX_CURSO_ESTAGIO:"{$VO->TX_CURSO_ESTAGIO}",
			CS_AREA_CONHECIMENTO:"{$VO->CS_AREA_CONHECIMENTO}",
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
