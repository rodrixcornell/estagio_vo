<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        {*Mostra Botao de Novo Registro Somente se Tiver Acesso Completo a Tela*}
    {if $acesso}<br /><a href="{$url}src/{$pasta}/cadastrar.php" id="nova_rm"><img src="{$urlimg}icones/novo.png" /></a>{/if}

    <br /><br />

    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" >
        <font color="#FF0000">*</font><strong>Órgão Gestor: </strong></div>
    <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:300px;">
        {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
    </select><br />

    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" >
        <strong>Nome da Tabela: </strong></div>
    <input type="text" name="TX_TABELA" id="TX_TABELA" value="{$VO->TX_TABELA}"  style="width:200px;" /><br />

    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;">
        <strong>Data Início Vigência: </strong></div>
    <input type="text" name="DT_INICIO_VIGENCIA" id="DT_INICIO_VIGENCIA" value="{$VO->DT_INICIO_VIGENCIA}" style="width:120px;" /><br />

    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;">
        <strong>Data Fim Vigência: </strong></div>
    <input type="text" name="DT_FIM_VIGENCIA" id="DT_FIM_VIGENCIA" value="{$VO->DT_FIM_VIGENCIA}" style="width:120px;" /><br />

    <br />
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
                //alert('ok: {$VO->ID_ORGAO_GESTOR_ESTAGIO}, {$VO->TX_TABELA}, {$VO->DT_INICIO_VIGENCIA}, {$VO->DT_FIM_VIGENCIA}.');
                $("#tabela").load('acoes.php?identifier=tabela', {
                    ID_ORGAO_GESTOR_ESTAGIO: "{$VO->ID_ORGAO_GESTOR_ESTAGIO}",
                    TX_TABELA: "{$VO->TX_TABELA}",
                    DT_INICIO_VIGENCIA: "{$VO->DT_INICIO_VIGENCIA}",
                    DT_FIM_VIGENCIA: "{$VO->DT_FIM_VIGENCIA}",
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