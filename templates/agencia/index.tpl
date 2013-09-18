<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        {*Mostra Botao de Novo Registro Somente se Tiver Acesso Completo a Tela*}
        {if $acesso}<br /><a href="{$url}src/{$pasta}/cadastrar.php" id="nova_rm"><img src="{$urlimg}icones/novo.png" /></a>{/if}
        <br /><br />

        <div id="camada" style="width:140px;"><strong>Nome da Agência</strong><font color="#FF0000"> {$validar.TX_AGENCIA_ESTAGIO} </font> </div>              
        <input type="text" name="TX_AGENCIA_ESTAGIO" id="TX_AGENCIA_ESTAGIO" value="{$VO->TX_AGENCIA_ESTAGIO}" style="width:400px;"/> 
        <br />

        <div id="camada" style="width:140px;"><strong>Sigla da Agência</strong><font color="#FF0000"> {$validar.TX_SIGLA} </font> </div>              
        <input type="text" name="TX_SIGLA" id="TX_SIGLA" value="{$VO->TX_SIGLA}" style="width:150px;"/> 
        
        <br /></br>
        
        <input type="button" name="pesquisar" id="pesquisar" value="Pesquisar" />
       
<script charset="UTF-8" type="text/javascript" language="JavaScript">
$(document).ready(function(){
	function showLoader(){ $('.fundo_pag').fadeIn(200); }
	function hideLoader(){ $('.fundo_pag').fadeOut(200); };
	
	
	if (!"{$s}"){
		showLoader();
		$("#tabela").load('acoes.php?identifier=tabela',{
			TX_AGENCIA_ESTAGIO:"{$VO->TX_AGENCIA_ESTAGIO}",
			TX_SIGLA:"{$VO->TX_SIGLA}",
                        TX_CNPJ:"{$VO->TX_CNPJ}",
                        DT_CADASTRO:"{$VO->DT_CADASTRO}",
                        DT_ATUALIZACAO:"{$VO->DT_ATUALIZACAO}",
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