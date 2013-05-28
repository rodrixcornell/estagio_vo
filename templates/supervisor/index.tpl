
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        <br />
        {*Mostra Botao de Novo Registro Somente se Tiver Acesso Completo a Tela*}
        {if $acesso}<br /><a href="{$url}src/{$pasta}/cadastrar.php" id="nova_rm"><img src="{$urlimg}icones/novo.png" /></a>{/if}
        <br /><br />


        <div id="camada" style="width:100px;"><strong>Cargo</strong><font color="#FF0000"> {$validar.TX_CARGO} </font> </div>              
        <input type="text" name="TX_CARGO" id="TX_CARGO" value="{$VO->TX_CARGO}" style="width:300px;"/> 
        <br />

        <div id="camada" style="width:100px;"><strong>Nome</strong><font color="#FF0000">{$validar.NB_FUNCIONARIO}</font></div>
        <select name="NB_FUNCIONARIO" id="NB_FUNCIONARIO" value="{$VO->NB_FUNCIONARIO}" style="width:300px;">
        {html_options options=$arrayFuncionario selected=$VO->NB_FUNCIONARIO}
        </select>
</br>
        <input type="button" name="pesquisar" id="pesquisar" value="Pesquisar" />
       
<script charset="UTF-8" type="text/javascript" language="JavaScript">
$(document).ready(function(){
	function showLoader(){ $('.fundo_pag').fadeIn(200); }
	function hideLoader(){ $('.fundo_pag').fadeOut(200); };
	
	
	if ("{$VO->TX_CARGO}" || "{$VO->NB_FUNCIONARIO}"){
		showLoader();
		$("#tabela").load('acoes.php?identifier=tabela',{
                
                        NB_FUNCIONARIO:"{$VO->NB_FUNCIONARIO}",
			TX_CARGO:"{$VO->TX_CARGO}",
                        TX_FORMACAO:"{$VO->TX_FORMACAO}",
                        
                        PAGE:"{$VO->PAGE}"
                       
		}, hideLoader); 
	}
	
});
</script>

        <div class="fundo_pag">
            <img src="{$urlimg}icones/loader.gif" alt="">
        </div>

        <div id="tabela"></div><br />

        <br />

    </div>

</div>
{if $status == 1}<script>alert('Registro inserido com sucesso!');</script>{/if}
{if $status == 2}<script>alert('Registro alterado com sucesso!');</script>{/if}