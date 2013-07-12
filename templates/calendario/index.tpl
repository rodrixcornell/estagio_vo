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
            {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
        </select><br />

        <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" >
            <strong>Ano de Referência: </strong></div>
        <select name="NB_ANO_REFERENCIA" id="NB_ANO_REFERENCIA" style="width:150px;">
            {html_options options=$arrayAnos selected=$VO->NB_ANO_REFERENCIA}
        </select><br />

        <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" >
            <strong>Mês de Referência: </strong></div>
        <select name="NB_MES_REFERENCIA" id="NB_MES_REFERENCIA" style="width:150px;">
            {html_options options=$arrayMeses selected=$VO->NB_MES_REFERENCIA}
        </select><br />

        <br />
        <input type="button" name="pesquisar" id="pesquisar" value="Pesquisar" />

        <script charset="UTF-8" type="text/javascript" language="JavaScript">
            $(document).ready(function(){
                function showLoader(){ $('.fundo_pag').fadeIn(200); }
                function hideLoader(){ $('.fundo_pag').fadeOut(200); };

                if ("{$VO->ID_ORGAO_GESTOR_ESTAGIO}"){
                    showLoader();
                    //alert('ok: {$VO->ID_ORGAO_GESTOR_ESTAGIO}, {$VO->NB_ANO_REFERENCIA}, {$VO->NB_MES_REFERENCIA}.');
                    $("#tabela").load('acoes.php?identifier=tabela',{
                        ID_ORGAO_GESTOR_ESTAGIO:"{$VO->ID_ORGAO_GESTOR_ESTAGIO}",
                        NB_ANO_REFERENCIA:"{$VO->NB_ANO_REFERENCIA}",
                        NB_MES_REFERENCIA:"{$VO->NB_MES_REFERENCIA}",
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