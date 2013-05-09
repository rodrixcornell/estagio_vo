<style>	.ui-combobox input{ width: 420px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Novo {$titulopage}</div>

    <br /><br /><br /><hr />
	
    <div id="conteudo">
        Para um novo Agente Setorial preencha o formulário abaixo e clique em Avançar:<br /><br />
        <form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;">
                <font color="#FF0000">*</font>Usuário <font color="#FF0000">{$validar.ID_USUARIO_RESP}</font><br />
                <select name="ID_USUARIO_RESP" id="ID_USUARIO_RESP" style="width:200px;">
                    {html_options options=$arrayUsuario selected=$VO->ID_USUARIO_RESP}
                </select></div>
                
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
                Funcionário <font color="#FF0000">{$validar.TX_FUNCIONARIO}</font><br />
                <input type="text" name="TX_FUNCIONARIO" id="TX_FUNCIONARIO" value="{$VO->TX_FUNCIONARIO}" style="width:400px;" class="leitura" readonly="readonly" /></div>
                
            <br /><br />
                        
            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
