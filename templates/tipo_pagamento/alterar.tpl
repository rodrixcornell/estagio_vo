<style>	.ui-combobox input{	width: 380px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Alterar {$titulopage}</div>

    <br /><br /><br /><hr />
            <div id="conteudo">
                Para alterar o Tipo de Pagamento preencha o formulário abaixo e clique em Salvar:<br /><br /><br />
		<form name="form" action="{$url}src/{$pasta}/alterar.php" method="post">
                
                    <font color="#FF0000"> {$erro} </font>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;"><font color="#FF0000">*</font>Código<font color="#FF0000"> {$validar.CS_TIPO_PAG_ESTAGIO} </font><br />
	             <input type="text" name="CS_TIPO_PAG_ESTAGIO" id="CS_TIPO_PAG_ESTAGIO" value="{$VO->CS_TIPO_PAG_ESTAGIO}" disabled="disabled" style="width:100px;" /><br />

                 <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;"><font color="#FF0000">*</font>Descriçâo<font color="#FF0000"> {$validar.TX_TIPO_PAG_ESTAGIO}</font><br />
	             <input type="text" name="TX_TIPO_PAG_ESTAGIO" id="TX_TIPO_PAG_ESTAGIO" value="{$VO->TX_TIPO_PAG_ESTAGIO}" style="width:400px;" /><br />
                  <br/>
					                              
                <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" name="salvar" id="salvar" value="Salvar" />
                </form>
           </div>
</div>
