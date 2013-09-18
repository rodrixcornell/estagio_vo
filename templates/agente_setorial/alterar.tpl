<style>	.ui-combobox input{ width: 400px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Alterar {$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        Para alterar o Agente Setorial preencha o formulário abaixo e clique em Salvar:<br /><br />
        <form name="form" action="{$url}src/{$pasta}/alterar.php" method="post">

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
                <font color="#FF0000">*</font>Usuário <font color="#FF0000">{$validar.ID_USUARIO_RESP}</font><br />
                <select name="ID_USUARIO_RESP" id="ID_USUARIO_RESP" style="width:400px;">
                    {html_options options=$arrayUsuario selected=$VO->ID_USUARIO_RESP}
                </select></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;">
                Usuário do Cadastro <font color="#FF0000">{$validar.TX_LOGIN_CAD}</font><br />
                <input type="text" name="TX_LOGIN_CAD" id="TX_LOGIN_CAD" value="{$VO->TX_LOGIN_CAD}" style="width:150px;" class="leitura" readonly="readonly" /></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;">
                Data de Cadastro <font color="#FF0000">{$validar.DT_CADASTRO}</font><br />
                <input type="text" name="DT_CADASTRO" id="DT_CADASTRO" value="{$VO->DT_CADASTRO}" style="width:150px;" class="leitura" readonly="readonly" /></div>


            <br />    
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
                Funcionário <font color="#FF0000">{$validar.TX_FUNCIONARIO}</font><br />
                <input type="text" name="TX_FUNCIONARIO" id="TX_FUNCIONARIO" value="{$VO->TX_FUNCIONARIO}" style="width:400px;" class="leitura" readonly="readonly" /></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;">
                Usuário da Atualização <font color="#FF0000">{$validar.TX_LOGIN_ATU}</font><br />
                <input type="text" name="TX_LOGIN_ATU" id="TX_LOGIN_ATU" value="{$VO->TX_LOGIN_ATU}" style="width:150px;" class="leitura" readonly="readonly" /></div>



            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;">
                Data de Atualização <font color="#FF0000">{$validar.DT_ATULIZACAO}</font><br />
                <input type="text" name="DT_ATULIZACAO" id="DT_ATULIZACAO" value="{$VO->DT_ATULIZACAO}" style="width:150px;" class="leitura" readonly="readonly" /></div>


            <br /><br />

            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/detail.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
