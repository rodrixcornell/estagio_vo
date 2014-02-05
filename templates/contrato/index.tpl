<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />
	
            <div id="conteudo">
            	{*Mostra Botao de Novo Registro Somente se Tiver Acesso Completo a Tela*}
                {if $acesso}<br /><a href="{$url}src/{$pasta}/cadastrar.php" id="nova_rm"><img src="{$urlimg}icones/novo.png" /></a>{/if}
                
                <br /><br />
				
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><font color="#FF0000">*</font><strong>Órgão Gestor: </strong></div>
                    <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:400px;">
                        {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
                    </select><br />
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><font color="#FF0000">*</font><strong>Órgão Solicitante: </strong></div>
                    <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO" style="width:400px;">
                        {html_options options=$arrayOrgaoSolicitante selected=$VO->ID_ORGAO_ESTAGIO}
                    </select><br />
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><font color="#FF0000">*</font><strong>Tipo Seleção: </strong></div>
                <input type="radio" name="CS_SELECAO" ID="CHECK_RESP" value="1" {if $VO->CHECK_RESP == 'true'}checked{/if} >Com Seleção ||<b> OU </b>||
                <input type="radio" name="CS_SELECAO" ID="CHECK_RESP_2" value="2" {if $VO->CHECK_RESP_2 == 'true'}checked{/if} >Sem Seleção
                <br />
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><strong>Código da Seleção: </strong></div>
                    <select name="ID_SELECAO_ESTAGIO" id="ID_SELECAO_ESTAGIO" style="width:200px;" {if $VO->CHECK_RESP != 'true'}disabled="disabled"{/if}>
                        {html_options options=$arrayCodSelecao selected=$VO->ID_SELECAO_ESTAGIO}
                    </select><br />
                
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><strong>TCE: </strong></div>
                    <input type="text" name="TX_TCE" id="TX_TCE" value="{$VO->TX_TCE}"  style="width:200px;" /><br />    
                
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><strong>Nome do Estagiário: </strong></div>
                    <input type="text" name="TX_NOME" id="TX_NOME" value="{$VO->TX_NOME}"  style="width:400px;" /><br />    
                
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><strong>CPF do Estagiário: </strong></div>
                    <input type="text" name="NB_CPF" id="NB_CPF" value="{$VO->NB_CPF}"  style="width:200px;" /><br />    
                
                
                
                <input type="button" name="pesquisar" id="pesquisar" value="Pesquisar" />
                
<script charset="UTF-8" type="text/javascript" language="JavaScript">
$(document).ready(function(){
	function showLoader(){ $('.fundo_pag').fadeIn(200); }
	function hideLoader(){ $('.fundo_pag').fadeOut(200); };
	
	
	if ("{$VO->ID_ORGAO_GESTOR_ESTAGIO}" && "{$VO->ID_ORGAO_ESTAGIO}" ){
		showLoader();
                
		$("#tabela").load('acoes.php?identifier=tabela',{
                 ID_ORGAO_GESTOR_ESTAGIO:"{$VO->ID_ORGAO_GESTOR_ESTAGIO}",
			ID_ORGAO_ESTAGIO:"{$VO->ID_ORGAO_ESTAGIO}",
		      ID_SELECAO_ESTAGIO:"{$VO->ID_SELECAO_ESTAGIO}",
			          TX_TCE:"{$VO->TX_TCE}",
			         TX_NOME:"{$VO->TX_NOME}",
			          NB_CPF:"{$VO->NB_CPF}",
			      CHECK_RESP:"{$VO->CHECK_RESP}",
			      CHECK_RESP_2:"{$VO->CHECK_RESP_2}",
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