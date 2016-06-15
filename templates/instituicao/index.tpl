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


  {*  <div id="camada" style="width:145px;"><strong>Nome da Instituição:</strong><font color="#FF0000"> {$validar.TX_INSTITUICAO_ENSINO} </font> </div>
    <select name="TX_INSTITUICAO_ENSINO" id="TX_INSTITUICAO_ENSINO" style="width:600px;">
        {html_options options=$arrayInstituicoes}
    </select><br />
        <input type="text" name="TX_INSTITUICAO_ENSINO" id="TX_INSTITUICAO_ENSINO" value="{$VO->TX_INSTITUICAO_ENSINO}" style="width:400px;"/>*}

        <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:200px;"><strong>Nome da Instituição: </strong></div>
        <input type="text" name="TX_INSTITUICAO_ENSINO" id="TX_INSTITUICAO_ENSINO" value="{$VO->TX_INSTITUICAO_ENSINO}" autocomplete="off" style="width:470px;" />
        <input type="hidden" name="ID_INSTITUICAO_ENSINO" id="ID_INSTITUICAO_ENSINO" value="{$VO->ID_INSTITUICAO_ENSINO}" />
    <br />


    <div id="camada" style="width:200px;"><strong>Sigla da instituição:</strong><font color="#FF0000"> {$validar.TX_SIGLA} </font> </div>
    <input type="text" name="TX_SIGLA" id="TX_SIGLA" value="{$VO->TX_SIGLA}" style="width:200px;"/>
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
				   TX_INSTITUICAO_ENSINO:"{$VO->TX_INSTITUICAO_ENSINO}",
				   TX_SIGLA:             "{$VO->TX_SIGLA}",
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
