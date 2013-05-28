<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo"> {$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        Para alterar a Agência de Estágio preencha o formulário abaixo e clique em Salvar:<br /><br />
         
          <form name="form" action="{$url}src/{$pasta}/alterar.php" method="post">

            <div id="camada" style="width:290px;"><font color="#FF0000">*</font>Nome da Agência<font color="#FF0000">{$valida.TX_AGENCIA_ESTAGIO} </font></br>
                <input type="text" name="TX_AGENCIA_ESTAGIO" id="TX_AGENCIA_ESTAGIO" value="{$VO->TX_AGENCIA_ESTAGIO}" style="width:280px;"/></div>

               
                <div id="camada" style="width:300px;"> <font color="#FF0000">*</font>Sigla da Agência<font color="#FF0000">{$validar.TX_SIGLA} </font><br />
                    <input type="text" name="TX_SIGLA" id="TX_SIGLA" value="{$VO->TX_SIGLA}" style="width:150px;"/></div>
				
                <br />
                   
                <div id="camada" style="width:300px;"> <font color="#FF0000">*</font>CNPJ<font color="#FF0000">{$validar.TX_CNPJ}</font><br />
                    <input type="text" name="TX_CNPJ" id="TX_CNPJ" value="{$VO->TX_CNPJ}" style="width:150px;"/></div>

                </br>
            	<div id="camada" style="width:290px;">Usuário do Cadastrado<font color="#FF0000">{$validar.USUARIO_ATUALIZACAO}</font></br>
                	<input type="text" name="USUARIO_ATUALIZACAO" id="USUARIO_ATUALIZACAO"  value="{$VO->USUARIO_ATUALIZACAO}" style="width:280px;" disabled="disabled"/></div>

               
                <div id="camada" style="width:400px;">Data do Cadastro<font color="#FF0000">{$validar.DT_CADASTRO}</font><br />
                    <input type="text" name="DT_CADASTRO" id="DT_CADASTRO" value="{$VO->DT_CADASTRO}" style="width:150px;" disabled="disabled"/></div>

                <div id="camada" style="width:290px;">Usuário da Atualização<font color="#FF0000">{$validar.USUARIO_ATUALIZACAO}</font></br>
                <input type="text" name="USUARIO_ATUALIZACAO" id="USUARIO_ATUALIZACAO"  value="{$VO->USUARIO_ATUALIZACAO}" style="width:280px;" disabled="disabled"/></div>

               
                <div id="camada" style="width:400px;">Data da Atualização<font color="#FF0000"> {$validar.DT_ATUALIZACAO}</font><br />
                    <input type="text" name="DT_ATUALIZACAO" id="DT_ATUALIZACAO" value="{$VO->DT_ATUALIZACAO}" style="width:150px;" disabled="disabled"/></div>


      <br /><br />
          
            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
   
            
            
            
