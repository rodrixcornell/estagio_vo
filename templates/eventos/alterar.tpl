<style>	.ui-combobox input{ width: 400px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Alterar {$titulopage}</div>

    <br /><br /><br /><hr />
	
    <div id="conteudo">
        Para alterar o Funcionário do Controle de Acesso preencha o formulário abaixo e clique em Avançar:<br /><br /><br />
        <form name="form" action="{$url}src/{$pasta}/alterar.php" method="post">
				
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" ><font color="#FF0000">*</font>Código: <font color="#FF0000">{$validar.TX_CODIGO}</font>
                    <input type="text" name="TX_CODIGO" id="TX_CODIGO" value="{$VO->TX_CODIGO}"  style="width:150px;" />
                </div>
                    
                
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;" ><font color="#FF0000">*</font>Descrição do Evento: <font color="#FF0000">{$validar.TX_DESCRICAO}</font>
                    <input type="text" name="TX_DESCRICAO" id="TX_DESCRICAO" value="{$VO->TX_DESCRICAO}"  style="width:410px;" />
                </div>    
                <br />

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" ><font color="#FF0000">*</font>Sigla: <font color="#FF0000">{$validar.TX_SIGLA}</font>
                   <input type="text" name="TX_SIGLA" id="TX_SIGLA" value="{$VO->TX_SIGLA}"  style="width:150px;" /> 
                </div>
                    
                    
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" ><font color="#FF0000">*</font>Tipo de Evento: <font color="#FF0000">{$validar.CS_TIPO}</font>
                    <select name="CS_TIPO" id="CS_TIPO" style="width:200px;">
                        {html_options options=$arrayTipoEvento selected=$VO->CS_TIPO}
                    </select><br />
                </div>
                
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" ><font color="#FF0000">*</font>Situação do Evento: <font color="#FF0000">{$validar.CS_SITUACAO}</font>
                    <select name="CS_SITUACAO" id="CS_SITUACAO" style="width:200px;">
                        {html_options options=$arraySituacao selected=$VO->CS_SITUACAO}
                    </select><br />
                </div>

                <br />
                
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;">Data de Cadastro <font color="#FF0000">{$validar.DT_CADASTRO}</font><br />
                    <input type="text" name="DT_CADASTRO" id="DT_CADASTRO" value="{$VO->DT_CADASTRO}" style="width:150px;" class="leitura" readonly="readonly" /></div>
                    
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;">Data de Atualização <font color="#FF0000">{$validar.DT_ATUALIZACAO}</font><br />
                    <input type="text" name="DT_ATUALIZACAO" id="DT_ATUALIZACAO" value="{$VO->DT_ATUALIZACAO}" style="width:150px;" class="leitura" readonly="readonly" /></div>
                
                
            <br /><br />
          
            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/detail.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
