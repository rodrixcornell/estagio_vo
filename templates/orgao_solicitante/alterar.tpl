<style>	.ui-combobox input{ width: 400px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Alterar {$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        Para alterar o Órgão Solicitante preencha o formulário abaixo e clique em Salvar:<br /><br /><br />
        <form name="form" action="{$url}src/{$pasta}/alterar.php" method="post">

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
                <font color="#FF0000">*</font>Órgão Solicitante <font color="#FF0000">{$validar.TX_ORGAO_ESTAGIO}</font><br />
                <input type="text" name="TX_ORGAO_ESTAGIO" id="TX_ORGAO_ESTAGIO" value="{$VO->TX_ORGAO_ESTAGIO}" style="width:400px;" /></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;">
                Usuário do Cadastro <font color="#FF0000">{$validar.TX_USUARIO_CAD}</font><br />
                <input type="text" name="TX_LOGIN_CAD" id="TX_LOGIN_CAD" value="{$VO->TX_LOGIN_CAD}" style="width:150px;" class="leitura" readonly="readonly" /></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;">
                Data de Cadastro <font color="#FF0000">{$validar.DT_CADASTRO}</font><br />
                <input type="text" name="DT_CADASTRO" id="DT_CADASTRO" value="{$VO->DT_CADASTRO}" style="width:150px;" class="leitura" readonly="readonly" /></div>

            <br />

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
                <font color="#FF0000">*</font>Unidade Organizacional <font color="#FF0000">{$validar.ID_UNIDADE_ORG}</font><br />
                <select name="ID_UNIDADE_ORG" id="ID_UNIDADE_ORG" style="width:400px;">
                    {html_options options=$pesquisarOrgaoSolicitante selected=$VO->ID_UNIDADE_ORG}
                </select></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;">
                Usuário da Atualização <font color="#FF0000">{$validar.TX_LOGIN_ALT}</font><br />
                <input type="text" name="TX_LOGIN_ALT" id="TX_LOGIN_ALT" value="{$VO->TX_LOGIN_ALT}" style="width:150px;" class="leitura" readonly="readonly" /></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;">
                Data de Atualização <font color="#FF0000">{$validar.DT_ATUALIZACAO}</font><br />
                <input type="text" name="DT_ATUALIZACAO" id="DT_ATUALIZACAO" value="{$VO->DT_ATUALIZACAO}" style="width:150px;" class="leitura" readonly="readonly" /></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;">
              <font color="#FF0000">*</font>CNPJ <font color="#FF0000">{$validar.TX_CNPJ}</font><br />
                <input type="text" name="TX_CNPJ" id="TX_CNPJ" value="{$VO->TX_CNPJ}" style="width:300px;" /></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
                <font color="#FF0000">*</font>Situação <font color="#FF0000">{$validar.CS_STATUS}</font><br />
                <select name="CS_STATUS" id="CS_STATUS" style="width:200px;">
                    {html_options options=$pesquisarSituacao selected=$VO->CS_STATUS}
                </select></div>

            <br /><br />

            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/detail.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
