<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        Para cadastrar um novo Tipo de pagamento preencha o formulario abaixo e clique em Salvar:<br /><br />
        <form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;"><font color="#FF0000">*</font>Código<font color="#FF0000"> {$validar.CS_TIPO_PAG_ESTAGIO} </font><br />
                <input type="text" name="CS_TIPO_PAG_ESTAGIO" id="CS_TIPO_PAG_ESTAGIO" style="width:100px;" /><br />

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:400px;"> <font color="#FF0000">*</font>Descrição<font color="#FF0000"> {$validar.TX_TIPO_PAG_ESTAGIO} </font><br />
                    <input type="text" name="TX_TIPO_PAG_ESTAGIO" id="TX_TIPO_PAG_ESTAGIO" style="width:400px;">
                    {html_options options=$inserir selected=$VO->TX_TIPO_PAG_ESTAGIO}						

                    <br /><br /><br />

                    <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href = '{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" name="salvar" id="salvar" value="Salvar" />
                    </form>
                </div>
            </div>
