<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        {*Mostra Botao de Novo Registro Somente se Tiver Acesso Completo a Tela*}
    {if $acesso}<br /><a href="{$url}src/{$pasta}/cadastrar.php" id="nova_rm"><img src="{$urlimg}icones/novo.png" /></a>{/if}

    <br /><br />

    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" >
        <font color="#FF0000">*</font><strong>Órgão Gestor: </strong></div>
    <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:300px;">
        {html_options options=$pesquisarOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
    </select><br />

    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><strong>Código do Contrato: </strong></div>
    <select name="ID_CONTRATO_CP" id="ID_CONTRATO_CP" style="width:300px;">
        {html_options options=$pesquisarNB_Codigo selected=$VO->ID_CONTRATO_CP}
    </select><br />

    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><strong>Termo Aditivo: </strong></div>
    <input type="text" name="TX_TERMO_ADITIVO" id="TX_TERMO_ADITIVO" value="{$VO->TX_TERMO_ADITIVO}" style="width:300px;" /><br />


    <input type="button" name="pesquisar" id="pesquisar" value="Pesquisar" />

    <script charset="UTF-8" type="text/javascript" language="JavaScript">
        $(document).ready(function() {
            function showLoader() {
                $('.fundo_pag').fadeIn(200);
            }
            function hideLoader() {
                $('.fundo_pag').fadeOut(200);
            }
            ;


            if ("{$VO->ID_ORGAO_GESTOR_ESTAGIO}") {
                showLoader();
                $("#tabela").load('acoes.php?identifier=tabela', {
                    ID_ORGAO_GESTOR_ESTAGIO: "{$VO->ID_ORGAO_GESTOR_ESTAGIO}",
                    ID_CONTRATO_CP: "{$VO->ID_CONTRATO_CP}",
                    TX_TERMO_ADITIVO: "{$VO->TX_TERMO_ADITIVO}",
                    PAGE: "{$VO->PAGE}"
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