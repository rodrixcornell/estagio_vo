<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Nova {$titulopage}</div>

    <br /><br /><br /><hr />
	
    <div id="conteudo">
        Para cadastrar uma nova Bolsa de Estágio preencha o formulário abaixo e clique em Avançar:<br /><br />
        <form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">
			
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
                <font color="#FF0000">*</font>Bolsa de Estágio <font color="#FF0000">{$validar.TX_BOLSA_ESTAGIO}</font><br />
                <input type="text" name="TX_BOLSA_ESTAGIO" id="TX_BOLSA_ESTAGIO" value="{$VO->TX_BOLSA_ESTAGIO}" style="width:400px;" /></div>
                
            <br />

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
                <font color="#FF0000">*</font>Valor <font color="#FF0000">{$validar.NB_VALOR}</font><br />
                <input type="text" name="NB_VALOR" id="NB_VALOR" value="{$VO->NB_VALOR}" style="width:100px;" /></div>            

            <br /><br />
                        
            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
