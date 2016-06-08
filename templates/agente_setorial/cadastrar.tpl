<style>	.ui-combobox input{ width: 420px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Novo {$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        Para um novo Agente Setorial preencha o formulário abaixo e clique em Salvar:<br /><br />
        <form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;">
                <font color="#FF0000">*</font>Usuário <font color="#FF0000">{$validar.ID_USUARIO_RESP}</font><br />
                <select name="ID_USUARIO_RESP" id="ID_USUARIO_RESP" style="width:200px;">
                    {html_options options=$arrayBuscarUsuario selected=$VO->ID_USUARIO_RESP}
                </select></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
                Funcionário <font color="#FF0000">{$validar.TX_FUNCIONARIOP}</font><br />
                <input type="text" name="TX_FUNCIONARIOP" id="TX_FUNCIONARIOP" value="{$VO->TX_FUNCIONARIOP}" style="width:400px;" class="leitura" readonly="readonly" /></div>
                 <br />
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
              <font color="#FF0000">*</font>Email <font color="#FF0000">{$validar.TX_EMAIL}</font><br />
                <input type="text" name="TX_EMAIL" id="TX_EMAIL" value="{$VO->TX_EMAIL}" style="width:400px;"  /></div>

            <br /><br />

            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
