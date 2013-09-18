<style>	.ui-combobox input{ width: 400px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Alterar {$titulopage}</div>

    <br /><br /><br /><hr />
	
    <div id="conteudo">
        Para alterar o Curso preencha o formulário abaixo e clique em Salvar:<br /><br />
        <form name="form" action="{$url}src/{$pasta}/alterar.php" method="post">
				
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
                <font color="#FF0000">*</font>Nome do Curso <font color="#FF0000">{$validar.TX_CURSO_ESTAGIO}</font><br />
                <input type="text" name="TX_CURSO_ESTAGIO" id="TX_CURSO_ESTAGIO" value="{$VO->TX_CURSO_ESTAGIO}" style="width:400px;" /></div>
                
            <br />
            
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
                <font color="#FF0000">*</font>Área de Conhecimento <font color="#FF0000">{$validar.CS_AREA_CONHECIMENTO}</font><br />
                <select name="CS_AREA_CONHECIMENTO" id="CS_AREA_CONHECIMENTO" style="width:400px;">
                    {html_options options=$arrayUnidade selected=$VO->CS_AREA_CONHECIMENTO}
                </select></div>
                
            <br />
         
            <br />
         
            <br />
         
          
            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
