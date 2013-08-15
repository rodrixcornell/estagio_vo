<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Novo {$titulopage}</div>

    <br /><br /><br /><hr />
	
    <div id="conteudo">
        Para um novo Tipo de Vaga de Estágio preencha o formulário abaixo e clique em Salvar:<br /><br />

        <form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">
        
        	<div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:300px;">
                <font color="#FF0000">*</font>Código do Tipo <font color="#FF0000">{$validar.CS_TIPO_VAGA_ESTAGIO}</font><br />
                <input type="text" name="CS_TIPO_VAGA_ESTAGIO" id="CS_TIPO_VAGA_ESTAGIO" value="{$VO->CS_TIPO_VAGA_ESTAGIO}" style="width:100px;" /></div>
                
            <br />
            
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
                <font color="#FF0000">*</font>Descrição do Tipo <font color="#FF0000">{$validar.TX_TIPO_VAGA_ESTAGIO}</font><br />
                <input type="text" name="TX_TIPO_VAGA_ESTAGIO" id="TX_TIPO_VAGA_ESTAGIO" value="{$VO->TX_TIPO_VAGA_ESTAGIO}" style="width:400px;" /></div>
           

            <br /><br />
                        
            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
