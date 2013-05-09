<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Novo {$titulopage}</div>

    <br /><br /><br /><hr />
	
    <div id="conteudo">
        Para um novo cadastro de Curso preencha o formulário abaixo e clique em Avançar:<br /><br />
        <form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">
			
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
                <font color="#FF0000">*</font>Nome do Curso <font color="#FF0000">{$validar.TX_CURSO_ESTAGIO}</font><br />
                <input type="text" name="TX_CURSO_ESTAGIO" id="TX_CURSO_ESTAGIO" value="{$VO->TX_CURSO_ESTAGIO}" style="width:400px;" /></div>
                
            <br />
            
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
                <font color="#FF0000">*</font>Área de conehcimento <font color="#FF0000">{$validar.ID_UNIDADE_ORG}</font><br />
                <select name="CS_AREA_CONHECIMENTO" id="CS_AREA_CONHECIMENTO" style="width:400px;">
                    {html_options options=$arrayUnidade selected=$VO->CS_AREA_CONHECIMENTO}
                </select></div>

            <br /><br />
                        
            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
