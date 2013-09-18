<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>
    <br />
    <br />
    <br />
    <hr />

    <div id="conteudo">
        {*Mostra Botao de Novo Registro Somente se Tiver Acesso Completo a Tela*}
    {if $acesso}<br /><a href="{$url}src/{$pasta}/cadastrar.php" id="nova_rm"><img src="{$urlimg}icones/novo.png" /></a>{/if}
    <br />
    <br />

    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><strong>Código: </strong></div>
    <select name="ID_QUADRO_VAGAS_ESTAGIO" id="ID_QUADRO_VAGAS_ESTAGIO" style="width:200px;">
        {html_options options=$pesquisarCodigo selected=$VO->ID_QUADRO_VAGAS_ESTAGIO}
    </select>
    <br />

    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><strong>Órgão Gestor: </strong></div>
    <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:500px;">
        {html_options options=$pesquisarOrgaogestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
    </select>
    <br />

    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><strong>Agencia de Estágio: </strong></div>
    <select name="ID_AGENCIA_ESTAGIO" id="ID_AGENCIA_ESTAGIO" style="width:500px;">
        {html_options options=$pesquisarAgenciaestagio selected=$VO->ID_AGENCIA_ESTAGIO}
    </select>
    <br />

    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><strong>Situação: </strong></div>
    <select name="CS_SITUACAO" id="CS_SITUACAO" style="width:200px;">
        {html_options options=$arraySituacao selected=$VO->CS_SITUACAO}
    </select>
    <br />
    <br />

    <input type="button" name="pesquisar" id="pesquisar" value="Pesquisar" />


    <script charset="UTF-8" type="text/javascript" language="JavaScript">
        $(document).ready(function(){
        function showLoader(){ $('.fundo_pag').fadeIn(200); }
    	function hideLoader(){ $('.fundo_pag').fadeOut(200); };
	
	
			if (!"{$s}"){
					showLoader();
					$("#tabela").load('acoes.php?identifier=tabela',{
						ID_QUADRO_VAGAS_ESTAGIO:"{$VO->ID_QUADRO_VAGAS_ESTAGIO}",
						ID_ORGAO_GESTOR_ESTAGIO:"{$VO->ID_ORGAO_GESTOR_ESTAGIO}",
						ID_AGENCIA_ESTAGIO:"{$VO->ID_AGENCIA_ESTAGIO}",
						CS_SITUACAO:"{$VO->CS_SITUACAO}",
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