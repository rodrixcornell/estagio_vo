<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Nova {$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        Para um Novo cadastro de Agência de Estágio preencha o formulário abaixo e clique em Salvar:<br /><br />
        <form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">



            <div id="camada" style="width:290px;"><font color="#FF0000">*</font>Nome da Agência<font color="#FF0000"> {$validar.TX_AGENCIA_ESTAGIO} </font></br>
                <input type="text" name="TX_AGENCIA_ESTAGIO" id="TX_AGENCIA_ESTAGIO" value="{$VO->TX_AGENCIA_ESTAGIO}" style="width:280px;"/></div>

                <div id="camada" style="width:220px;"> <font color="#FF0000">*</font>Sigla da Agência<font color="#FF0000"> {$validar.TX_SIGLA} </font><br />
                    <input type="text" name="TX_SIGLA" id="TX_SIGLA" value="{$VO->TX_SIGLA}" style="width:210px;"/></div>
                    
                <br />

                <div id="camada" style="width:160px;"> <font color="#FF0000">*</font>CNPJ<font color="#FF0000"> {$validar.TX_CNPJ} </font><br />
                    <input type="text" name="TX_CNPJ" id="TX_CNPJ"  value="{$VO->TX_CNPJ}" style="width:150px;"/></div>

               
                <div id="camada" style="width:350px;"> <font color="#FF0000">*</font>E-Mail<font color="#FF0000"> {$validar.TX_EMAIL} </font><br />
                    <input type="text" name="TX_EMAIL" id="TX_EMAIL"  value="{$VO->TX_EMAIL}" style="width:340px;"/></div>

                </br> <br/>

                <br />

               <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href = '{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" name="salvar" id="salvar" value="Salvar" />
        </form>
    </div>
</div>
