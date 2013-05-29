<style>	.ui-combobox input{ width: 400px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Alterar {$titulopage}</div>

    <br /><br /><br /><hr />
	
    <div id="conteudo">
        Para alterar o Quadro de Vagas  preencha o formulário abaixo e clique em Salvar:<br /><br /><br />
        <form name="form" action="{$url}src/{$pasta}/alterar.php" method="post">
            
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">Usuário do Cadastro: <font color="#FF0000">{$validar.TX_CODIGO}</font><br />
            <input type="text" name="TX_CODIGO" id="TX_CODIGO" value="{$VO->TX_CODIGO}" style="width:200px;" class="leitura" readonly="readonly" /></div>
	  <br />
            
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;">
            <font color="#FF0000">*</font>Órgão Gestor: <font color="#FF0000">{$validar.ID_ORGAO_GESTOR_ESTAGIO}</font><br />
            <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:500px;">
            {html_options options=$pesquisarOrgaogestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
            </select></div>
            <br />
           
            
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;">
            <font color="#FF0000">*</font>Agencia de Estágio:  <font color="#FF0000">{$validar.ID_AGENCIA_ESTAGIO}</font><br />
            <select name="ID_AGENCIA_ESTAGIO" id="ID_AGENCIA_ESTAGIO" style="width:500px;">
            {html_options options=$pesquisarAgenciaestagio selected=$VO->ID_AGENCIA_ESTAGIO}
            </select></div>
            <br />
          <!--FFF-->
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;">
            <font color="#FF0000">*</font>Situação:  <font color="#FF0000">{$validar.CS_SITUACAO}</font><br />
            <select name="CS_SITUACAO" id="CS_SITUACAO" style="width:200px;">
            {html_options options=$arraySituacao selected=$VO->CS_SITUACAO}
            </select></div>
            <br />
            <!---------------------------------------------------->
                        
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">Usuário do Cadastro: <font color="#FF0000">{$validar.TX_LOGIN}</font><br />
            <input type="text" name="TX_LOGIN" id="TX_LOGIN" value="{$VO->TX_LOGIN}" style="width:400px;" class="leitura" readonly="readonly" /></div>
            
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;">Data de Cadastro <font color="#FF0000">{$validar.DT_CADASTRO}</font><br />
            <input type="text" name="DT_CADASTRO" id="DT_CADASTRO" value="{$VO->DT_CADASTRO}" style="width:150px;" class="leitura" readonly="readonly" /></div>
            <br />
            <br />
                                   
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">Usuário da Atualização: <font color="#FF0000">{$validar.TX_LOGIN}</font><br />
            <input type="text" name="TX_LOGIN" id="TX_LOGIN" value="{$VO->TX_LOGIN}" style="width:400px;" class="leitura" readonly="readonly" /></div>
              
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;">Data de Atualização <font color="#FF0000">{$validar.DT_ATUALIZACAO}</font><br />
            <input type="text" name="DT_ATUALIZACAO" id="DT_ATUALIZACAO" value="{$VO->DT_ATUALIZACAO}" style="width:150px;" class="leitura" readonly="readonly" /></div>
            <br />
            <br />
          
            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/detail.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
