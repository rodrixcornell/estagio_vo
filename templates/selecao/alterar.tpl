<style>	.ui-combobox input{ width: 400px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Alterar {$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        Para alterar a Seleção de Estagiário preencha o formulário abaixo e clique em Salvar:<br /><br />
        <form name="form" action="{$url}src/{$pasta}/alterar.php" method="post">

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" >
                <font color="#FF0000">*</font>Órgão Gestor<font color="#FF0000"> {$validar.TX_ORGAO_GESTOR_ESTAGIO}</font>
                <input type="text" name="TX_ORGAO_GESTOR_ESTAGIO" id="TX_ORGAO_GESTOR_ESTAGIO" style="width:300px;" value="{$VO->TX_ORGAO_GESTOR_ESTAGIO}" class="leitura" readonly="readonly" /></div>
                
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" >
            	<font color="#FF0000">*</font>Órgão Solicitante<font color="#FF0000"> {$validar.TX_ORGAO_ESTAGIO}</font>
                <input type="text" name="TX_ORGAO_ESTAGIO" id="TX_ORGAO_ESTAGIO" style="width:300px;" value="{$VO->TX_ORGAO_ESTAGIO}" class="leitura" readonly="readonly" /></div><br />

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" >
                <font color="#FF0000">*</font>Cód. do Recrutamento <font color="#FF0000"> {$validar.TX_COD_RECRUTAMENTO}</font>
                <input type="text" name="TX_COD_RECRUTAMENTO" id="TX_COD_RECRUTAMENTO" style="width:150px;" value="{$VO->TX_COD_RECRUTAMENTO}" class="leitura" readonly="readonly" /></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" >Data de Agendamento  <font color="#FF0000"> {$validar.DT_AGENDAMENTO}</font><br />
              <input type="text" name="DT_AGENDAMENTO" id="DT_AGENDAMENTO" value="{$VO->DT_AGENDAMENTO}"  style="width:150px;" /></div> 

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" >Data de Realização  <font color="#FF0000"> {$validar.DT_REALIZACAO}</font><br />
              <input type="text" name="DT_REALIZACAO" id="DT_REALIZACAO" value="{$VO->DT_REALIZACAO}"  style="width:150px;" /></div>  

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:132px;" >{if !$contrato}<font color="#FF0000">*</font>{/if}Situação <font color="#FF0000">{$validar.CS_SITUACAO}</font>
                <select name="CS_SITUACAO" id="CS_SITUACAO" style="width:122px;" {if $contrato} disabled="disabled" {/if} >
                    {html_options options=$arraySituacao selected=$VO->CS_SITUACAO}
                </select></div>
                
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
