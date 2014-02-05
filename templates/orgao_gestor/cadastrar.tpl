<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Novo {$titulopage}</div>

    <br /><br /><br /><hr />
	
    <div id="conteudo">
        Para um novo Órgão Gestor de Estágio preencha o formulário abaixo e clique em Salvar:<br /><br />

        <form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">
			
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
                <font color="#FF0000">*</font>Órgão Gestor de Estágio <font color="#FF0000">{$validar.TX_ORGAO_GESTOR_ESTAGIO}</font><br />
                <input type="text" name="TX_ORGAO_GESTOR_ESTAGIO" id="TX_ORGAO_GESTOR_ESTAGIO" value="{$VO->TX_ORGAO_GESTOR_ESTAGIO}" style="width:400px;" /></div>
                
            <br />
            
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
                <font color="#FF0000">*</font>Unidade Organizacional <font color="#FF0000">{$validar.ID_UNIDADE_ORG}</font><br />
                <select name="ID_UNIDADE_ORG" id="ID_UNIDADE_ORG" style="width:400px;">
                    {html_options options=$arrayUnidade selected=$VO->ID_UNIDADE_ORG}
                </select></div>

            <br />
             <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;">
                <font color="#FF0000">*</font>CNPJ <font color="#FF0000">{$validar.TX_CNPJ}</font><br />
                <input type="text" name="TX_CNPJ" id="TX_CNPJ" value="{$VO->TX_CNPJ}" style="width:200px;" /></div>
                
            <br />
            
            <br />
                        
            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
