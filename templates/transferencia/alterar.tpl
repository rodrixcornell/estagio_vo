<style>	.ui-combobox input{ width: 420px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Alterar {$titulopage}</div>

    <br /><br /><br /><hr />
    <div id="conteudo">
        Para alterar a {$titulopage} preencha o formulário abaixo e clique em Avançar:<br /><br /><br />

        <form name="form" action="{$url}src/{$pasta}/alterar.php" method="post">
           {*--------------orgão gestor estagio-------------------*}
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" >
                Órgão Gestor
            <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:300px;" disabled="disabled">
               {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
            </select></div>
            
           {*-------------quadro de vagas------------------------*}
            
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" >
                Quadro de Vagas de Estágio
                <select name="ID_QUADRO_VAGAS_ESTAGIO" id="ID_QUADRO_VAGAS_ESTAGIO" style="width:300px;" disabled="disabled">
                    {html_options options=$arrayQuadroVagasEstagio selected=$VO->ID_QUADRO_VAGAS_ESTAGIO}
                </select></div>
                       
           {*---------------codigo da tranferencia----------------------*}    
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" >
              Código Transferência
            <input type="text" name="TX_COD_TRANSFERENCIA" id="TX_COD_TRANSFERENCIA" value="{$VO->TX_COD_TRANSFERENCIA}"  style="width:140px;" readonly="readonly" class="leitura"/></div>
            <br />
            
           {*----------------orgão solicitante---------------*}
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" >
              Órgao Cedente
            <select name="ID_ORGAO_SOLICITANTE" id="ID_ORGAO_SOLICITANTE" style="width:300px;" disabled="disabled">
               {html_options options=$arrayOrgaoSolicitante selected=$VO->ID_ORGAO_SOLICITANTE}
            </select></div>
            
           {*-----------orgão cedente------------------------*}
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" >
             Órgão Solicitante
            <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO" style="width:300px;" disabled="disabled">
              {html_options options=$arraypesquisarOrgaoCedente selected=$VO->ID_ORGAO_ESTAGIO}
            </select></div>
               
            {*--------------situação--------------------*}
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" >
             {*{if !$recrutamento}<font color="#FF0000">*</font>{/if}Situação <font color="#FF0000">{$validar.CS_SITUACAO}</font>*}
             Situação
            <select name="CS_SITUACAO" id="CS_SITUACAO" style="width:140px;" {if $recrutamento} disabled="disabled" {/if}>
                 {html_options options=$arraySituacao selected=$VO->CS_SITUACAO}
            </select></div><br />
            
             {*---------------justificativa-------------------*}  
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:620px;" >
                Motivo / Justificativa: <font color="#FF0000">{$validar.TX_MOTIVO}</font>
            <textarea name="TX_MOTIVO" id="TX_MOTIVO" style="width:765px; height:110px;" rows="2">{$VO->TX_MOTIVO}</textarea></div>
            <br />
            
            {*-------------------------------------------*}
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:565px;" >
                Funcionário do Cadastro:
            <input type="text" name="TX_FUNCIONARIO_CAD" id="TX_FUNCIONARIO_CAD" value="{$VO->TX_FUNCIONARIO_CAD}"  style="width:555px;" readonly="readonly" class="leitura"/></div>

            {*-------------------------------------------*}
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" >
                Data do Cadastro:
            <input type="text" name="DT_CADASTRO" id="DT_CADASTRO" value="{$VO->DT_CADASTRO}"  style="width:200px;" readonly="readonly" class="leitura"/></div>
            <br />
            
            {*--------------------------------------------*}
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:565px;" >
                Funcionário da Atualização:
            <input type="text" name="TX_FUNCIONARIO_ATUAL" id="TX_FUNCIONARIO_ATUAL" value="{$VO->TX_FUNCIONARIO_ATUAL}"  style="width:555px;" readonly="readonly" class="leitura"/></div>
           
            {*--------------------------------------*}
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" >
                Data da Atualização:
            <input type="text" name="DT_ATUALIZACAO" id="DT_ATUALIZACAO" value="{$VO->DT_ATUALIZACAO}"  style="width:200px;" readonly="readonly" class="leitura"/></div>
            <br />
            <br />
            
            {*--------------------------------------------*}
            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/detail.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
