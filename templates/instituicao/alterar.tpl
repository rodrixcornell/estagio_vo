<style>	.ui-combobox input{ width: 400px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Alterar {$titulopage}</div>

    <br /><br /><br /><hr />
	
    <div id="conteudo">
        Para alterar a Instituição de Ensino preencha o formulário abaixo e clique em Avançar:<br /><br /><br />
        <form name="form" action="{$url}src/{$pasta}/alterar.php" method="post">
				
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
                <font color="#FF0000">*</font>Nome da instituição <font color="#FF0000">{$validar.TX_INSTITUICAO_ENSINO}</font><br />
                <input type="text" name="TX_INSTITUICAO_ENSINO" id="TX_INSTITUICAO_ENSINO" value="{$VO->TX_INSTITUICAO_ENSINO}" style="width:500px;" /></div>
                
            <br />
            
             <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
                <font color="#FF0000">*</font>Sigla da Instituição <font color="#FF0000">{$validar.TX_SIGLA}</font><br />
                <input type="text" name="TX_SIGLA" id="TX_SIGLA" value="{$VO->TX_SIGLA}" style="width:200px;" /></div>
                
            <br />
                
            <br />
                           
            <br /><br />
          
            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
