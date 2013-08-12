<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />
	
            <div id="conteudo">
            	{*Mostra Botao de Novo Registro Somente se Tiver Acesso Completo a Tela*}
                {if $acesso}<br /><a href="{$url}src/{$pasta}/cadastrar.php" id="nova_rm"><img src="{$urlimg}icones/novo.png" /></a>{/if}
                
                <br /><br />		
                            
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:200px;" ><strong>Órgão Solicitante: </strong></div>
                    <input type="text" name="TX_ORGAO_ESTAGIO" id="TX_ORGAO_ESTAGIO" value="{$VO->TX_ORGAO_ESTAGIO}"  style="width:500px;" /><br />    
                      
                    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:200px;" ><strong>Unidade Organizacional: </strong></div>
                    <select name="ID_UNIDADE_ORG" id="ID_UNIDADE_ORG" style="width:500px;">
                        {html_options options=$pesquisarOrgaoSolicitante selected=$VO->ID_UNIDADE_ORG}
                    </select><br />
         
                <input type="button" name="pesquisar" id="pesquisar" value="Pesquisar" />
                
<script charset="UTF-8" type="text/javascript" language="JavaScript">
$(document).ready(function(){
	function showLoader(){ $('.fundo_pag').fadeIn(200); }
	function hideLoader(){ $('.fundo_pag').fadeOut(200); };
	
	if (!"{$s}"){
		showLoader();
		$("#tabela").load('acoes.php?identifier=tabela',{
			TX_ORGAO_ESTAGIO:"{$VO->TX_ORGAO_ESTAGIO}",
			ID_UNIDADE_ORG:"{$VO->ID_UNIDADE_ORG}",
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