<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />
	
            <div id="conteudo">
            	{*Mostra Botao de Novo Registro Somente se Tiver Acesso Completo a Tela*}
                {if $acesso}<br /><a href="{$url}src/{$pasta}/cadastrar.php" id="nova_rm"><img src="{$urlimg}icones/novo.png" /></a>{/if}
                
                <br /><br />
                
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" ><font color="#FF0000">*</font><strong>Órgão Gestor: </strong></div>
                    <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:200px;">
                        {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
                    </select><br />

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" ><font color="#FF0000">*</font><strong>Órgão Solicitante: </strong></div>
                    <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO" style="width:200px;">
                        {html_options options=$arrayOrgaoSolicitante selected=$VO->ID_ORGAO_ESTAGIO}
                    </select><br />


                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" ><strong>Agente de Integração: </strong></div>
                    <select name="ID_SETORIAL_ESTAGIO" id="ID_SETORIAL_ESTAGIO" style="width:200px;">
                        {html_options options=$arrayAgenteIntegracao selected=$VO->ID_SETORIAL_ESTAGIO}
                    </select><br />

                 <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" ><strong>Código do Contrato: </strong></div>
                    <input type="text" name="TX_CODIGO_CONTRATO" id="TX_CODIGO_CONTRATO" value="{$VO->TX_CODIGO_CONTRATO}" style="width:400px;" /><br />
                    
                 <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" ><strong>Nome do Estagiário: </strong></div>
                    <input type="text" name="TX_NOME_ESTAGIARIO" id="TX_NOME_ESTAGIARIO" value="{$VO->TX_NOME_ESTAGIARIO}" style="width:400px;" /><br />

                 <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" ><strong>CPF do Estagiário: </strong></div>
                    <input type="text" name="NB_CPF" id="NB_CPF" value="{$VO->NB_CPF}" style="width:400px;" /><br />

                 <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" ><strong>Código do Recesso: </strong></div>
                    <input type="text" name="CODIGO_RECESSO" id="CODIGO_RECESSO" value="{$VO->CODIGO_RECESSO}" style="width:400px;" /><br />
				
                
                <input type="button" name="pesquisar" id="pesquisar" value="Pesquisar" />

<script charset="UTF-8" type="text/javascript" language="JavaScript">
$(document).ready(function(){
	function showLoader(){ $('.fundo_pag').fadeIn(200); }
	function hideLoader(){ $('.fundo_pag').fadeOut(200); };
	
	
	if ("{$VO->ID_ORGAO_ESTAGIO}" || "{$VO->ID_ORGAO_GESTOR_ESTAGIO}"){
		showLoader();
		$("#tabela").load('acoes.php?identifier=tabela',{
			ID_RECESSO_ESTAGIO:"{$VO->ID_RECESSO_ESTAGIO}",
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
