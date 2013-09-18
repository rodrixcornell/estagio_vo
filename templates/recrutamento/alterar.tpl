<style>	.ui-combobox input{ width: 400px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Alterar {$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        Para alterar o Recrutamento de Estagiário preencha o formulário abaixo e clique em Salvar:<br /><br />
        <form name="form" action="{$url}src/{$pasta}/alterar.php" method="post">
                
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;">
                Órgão Gestor <font color="#FF0000"> {$validar.TX_ORGAO_GESTOR_ESTAGIO}</font><br />
                <input type="text" name="TX_ORGAO_GESTOR_ESTAGIO" id="TX_ORGAO_GESTOR_ESTAGIO" style="width:300px;" class="leitura" readonly="readonly" value="{$VO->TX_ORGAO_GESTOR_ESTAGIO}" /></div> 

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;">
                Órgão Solicitante<font color="#FF0000"> {$validar.TX_ORGAO_ESTAGIO}</font><br />
                <input type="text" name="TX_ORGAO_ESTAGIO" id="TX_ORGAO_ESTAGIO" style="width:300px;" class="leitura" readonly="readonly" value="{$VO->TX_ORGAO_ESTAGIO}" /></div> <br />
                
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:120px;">
                Solicitação<font color="#FF0000"> {$validar.TX_COD_SOLICITACAO}</font><br />
                <input type="text" name="TX_COD_SOLICITACAO" id="TX_COD_SOLICITACAO" style="width:110px;" class="leitura" readonly="readonly" value="{$VO->TX_COD_SOLICITACAO}" /></div> 
                
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:120px;">
                Quadro de Vagas<font color="#FF0000"> {$validar.TX_CODIGO}</font><br />
                <input type="text" name="TX_CODIGO" id="TX_CODIGO" style="width:110px;" class="leitura" readonly="readonly" value="{$VO->TX_CODIGO}" /></div> 
            
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;">
                <font color="#FF0000"></font>Doc. de Autorização <font color="#FF0000">{$validar.TX_DOC_AUTORIZACAO}</font><br />
                <input type="text" name="TX_DOC_AUTORIZACAO" id="TX_DOC_AUTORIZACAO" value="{$VO->TX_DOC_AUTORIZACAO}" style="width:200px;" /></div>  
                
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:165px;" >
                {if !$selecao}<font color="#FF0000">*</font>{/if}Situação <font color="#FF0000">{$validar.CS_SITUACAO}</font>
                <select name="CS_SITUACAO" id="CS_SITUACAO" style="width:155px;" {if $selecao} disabled="disabled" {/if} >
                    {html_options options=$arraySituacao selected=$VO->CS_SITUACAO}
                </select></div>
                
                <br />

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:610px;">
              <font color="#FF0000"></font>Motivo / Justificativa<font color="#FF0000">{$validar.TX_MOTIVO}</font><br />
              <textarea name="TX_MOTIVO" id="TX_MOTIVO" style="width:610px; height:100px;" >{$VO->TX_MOTIVO}</textarea></div>
              
              <br />
              
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:460px;">
                Funcionário do Cadastro <font color="#FF0000">{$validar.TX_FUNCIONARIO_CADASTRO}</font><br />
                <input type="text" name="TX_FUNCIONARIO_CADASTRO" id="TX_FUNCIONARIO_CADASTRO" value="{$VO->TX_FUNCIONARIO_CADASTRO}" style="width:450px;" class="leitura" readonly="readonly" /></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;">
                Data de Cadastro <font color="#FF0000">{$validar.DT_CADASTRO}</font><br />
                <input type="text" name="DT_CADASTRO" id="DT_CADASTRO" value="{$VO->DT_CADASTRO}" style="width:150px;" class="leitura" readonly="readonly" /></div>


            <br />    
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:460px;">
                Funcionário de Atualização <font color="#FF0000">{$validar.TX_FUNCIONARIO_ATUALIZACAO}</font><br />
                <input type="text" name="TX_FUNCIONARIO_ATUALIZACAO" id="TX_FUNCIONARIO_ATUALIZACAO" value="{$VO->TX_FUNCIONARIO_ATUALIZACAO}" style="width:450px;" class="leitura" readonly="readonly" /></div>



            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;">
                Data de Atualização <font color="#FF0000">{$validar.DT_ATUALIZACAO}</font><br />
                <input type="text" name="DT_ATUALIZACAO" id="DT_ATUALIZACAO" value="{$VO->DT_ATUALIZACAO}" style="width:150px;" class="leitura" readonly="readonly" /></div>


            <br /><br />

            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/detail.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
