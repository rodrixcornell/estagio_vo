<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Nova {$titulopage}</div>

    <br /><br /><br /><hr />
	
    <div id="conteudo">
        Para uma nova cadastro de Grupo de Pagamento preencha o formulário abaixo e clique em Salvar:<br /><br />
        <form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">
			
           <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
                <font color="#FF0000">*</font>Código <font color="#FF0000">{$validar.ID_GRUPO_PAGAMENTO}</font><br />
                <input type="text" name="ID_GRUPO_PAGAMENTO" id="ID_GRUPO_PAGAMENTO" value="{$VO->ID_GRUPO_PAGAMENTO}" style="width:100px;" /></div>
                
            <br />
			
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
                <font color="#FF0000">*</font>Descrição<font color="#FF0000">{$validar.TX_GRUPO_PAGAMENTO}</font><br />
                <input type="text" name="TX_GRUPO_PAGAMENTO" id="TX_GRUPO_PAGAMENTO" value="{$VO->TX_GRUPO_PAGAMENTO}" style="width:400px;" /></div>
                
            <br /><br />
                        
            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
