<style>	.ui-combobox input{ width: 420px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Nova {$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        Para uma nova Seleção de Estagiário preencha o formulário abaixo e clique em Salvar:<br /><br />

        <form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" >
                <font color="#FF0000">*</font>Órgão Gestor<font color="#FF0000"> {$validar.ID_ORGAO_GESTOR_ESTAGIO}</font>
                <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:300px;">
                    {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
                </select></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" >
                <font color="#FF0000">*</font>Órgão Solicitante<font color="#FF0000"> {$validar.ID_ORGAO_ESTAGIO}</font>
                <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO" style="width:300px;">
                    {html_options options=$arraySolicitante selected=$VO->ID_ORGAO_ESTAGIO}
                </select></div><br />

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:315px; float:left;" >Tipo de Oferta:<font color="#FF0000"> {$validar.CS_SELECAO}</font>
                <br />
                <input type="radio" name="CS_SELECAO" ID="CHECK_RESP_2" value="2" {if $VO->CS_SELECAO == 2} checked {/if} /><font color="#FF0000">*</font>Sem Oferta ||<b> OU </b>||
                <input type="radio" name="CS_SELECAO" ID="CHECK_RESP" value="1" {if $VO->CS_SELECAO == 1} checked {/if} /><font color="#FF0000">*</font>Com Oferta<font color="#FF0000">{$validar.CS_SELECAO}</font></div>

            <div id="camada" class="comSelecao" style="font-family:Verdana, Geneva, sans-serif; width:170px; display:none; float:left;">
                <font color="#FF0000">*</font>Cód. da Oferta <font color="#FF0000"> {$validar.ID_OFERTA_VAGA}</font>
                <select name="ID_OFERTA_VAGA" id="ID_OFERTA_VAGA" style="width:150px;">
                    {html_options options=$arrayOfertaVaga selected=$VO->ID_OFERTA_VAGA}
                </select></div>

            <br /><br /><br /><br />

            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href = '{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>