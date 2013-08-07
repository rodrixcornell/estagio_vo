<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        {*Mostra Botao de Novo Registro Somente se Tiver Acesso Completo a Tela*}
    {if $acesso}<br /><a href="{$url}src/{$pasta}/cadastrar.php" id="nova_rm"><img src="{$urlimg}icones/novo.png" /></a>{/if}

    <br /><br />
{*-- ORGAO GESTOR DE ESTAGIO --*}
    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" >
        <font color="#FF0000">*</font><strong>Órgão Gestor: </strong></div>
    <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:300px;">
        {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
    </select><br />
    
{*-- CODIGO DO CONTRATO --*}
    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" >
        <font color="#FF0000"></font><strong>Código do Contrato: </strong></div>
    <select name="ID_CONTRATO_CP" id="ID_CONTRATO_CP" style="width:300px;">
        {html_options options=$arrayCodigoContrato selected=$VO->ID_CONTRATO_CP}
    </select><br />
    
{*-- CODIGO DO TERMO ADITIVO --*}
    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" >
        <strong>Código do Termo Aditivo: </strong></div>
    <select name="ID_ADITIVO_CONTRATO_CP" id="ID_ADITIVO_CONTRATO_CP" style="width:300px;">
        {html_options options=$arrayCodTermoAditivo selected=$VO->ID_ADITIVO_CONTRATO_CP}
    </select><br />
    
    
{*-- CODIGO DA SOLICITACAO --*}
    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" >
        <strong>Código da Solicitação: </strong></div>
    <input type="text" name="TX_CODIGO" id="TX_CODIGO" value="{$VO->TX_CODIGO}"  style="width:200px;" /><br />

    <br />
    <input type="button" name="pesquisar" id="pesquisar" value="Pesquisar" />

    <script charset="UTF-8" type="text/javascript" language="JavaScript">
        $(document).ready(function(){
            function showLoader(){ $('.fundo_pag').fadeIn(200); }
            function hideLoader(){ $('.fundo_pag').fadeOut(200); };

            if ("{$VO->ID_ORGAO_GESTOR_ESTAGIO}" && "{$VO->ID_ORGAO_ESTAGIO}" || ("{$VO->CS_SITUACAO}" || $.trim("{$VO->TX_CODIGO}"))){
                showLoader();
                //alert('ok: {$VO->ID_ORGAO_GESTOR_ESTAGIO}, {$VO->ID_ORGAO_ESTAGIO}, {$VO->CS_SITUACAO}, {$VO->TX_CODIGO}.');
                $("#tabela").load('acoes.php?identifier=tabela',{
                    ID_ORGAO_GESTOR_ESTAGIO:"{$VO->ID_ORGAO_GESTOR_ESTAGIO}",
                    ID_ORGAO_ESTAGIO:"{$VO->ID_ORGAO_ESTAGIO}",
                    CS_SITUACAO:"{$VO->CS_SITUACAO}",
                    TX_COD_SOLICITACAO:"{$VO->TX_COD_SOLICITACAO}",
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