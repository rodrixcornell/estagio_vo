<style>	.ui-combobox input{ width: 420px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Alterar {$titulopage}</div>

    <br /><br /><br /><hr />
    <div id="conteudo">
        Para alterar a {$titulopage} preencha o formulário abaixo e clique em Salvar:<br /><br /><br />

        <form name="form" action="{$url}src/{$pasta}/alterar.php" method="post">

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" >
                Órgão Gestor
                <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:300px;" disabled="disabled">
                    {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
                </select></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" >
                Quadro de Vagas de Estágio
                <select name="ID_QUADRO_VAGAS_ESTAGIO" id="ID_QUADRO_VAGAS_ESTAGIO" style="width:300px;" disabled="disabled">
                    {html_options options=$arrayQuadroVagasEstagio selected=$VO->ID_QUADRO_VAGAS_ESTAGIO}
                </select></div>
                
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" >
                Código da Solicitação
                <input type="text" name="TX_COD_SOLICITACAO" id="TX_COD_SOLICITACAO" value="{$VO->TX_COD_SOLICITACAO}"  style="width:140px;" readonly="readonly" class="leitura"/></div>
                
                
            <br />

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" >
                Órgão Solicitante
                <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO" style="width:300px;" disabled="disabled">
                    {html_options options=$arrayOrgaoSolicitante selected=$VO->ID_ORGAO_ESTAGIO}
                </select></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" >
                Agencia de Estágio
                <select name="ID_AGENCIA_ESTAGIO" id="ID_AGENCIA_ESTAGIO" style="width:300px;" disabled="disabled">
                    {html_options options=$arrayAgenciaEstagio selected=$VO->ID_AGENCIA_ESTAGIO}
                </select></div>


            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" >
                {if !$recrutamento}<font color="#FF0000">*</font>{/if}Situação <font color="#FF0000">{$validar.CS_SITUACAO}</font>
                <select name="CS_SITUACAO" id="CS_SITUACAO" style="width:140px;" {if $recrutamento} disabled="disabled" {/if}>
                    {html_options options=$arraySituacao selected=$VO->CS_SITUACAO}
                </select></div><br />

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:620px;" >
                Motivo / Justificativa <font color="#FF0000">{$validar.TX_JUSTIFICATIVA}</font>
                <textarea name="TX_JUSTIFICATIVA" id="TX_JUSTIFICATIVA" style="width:765px; height:110px;" rows="2">{$VO->TX_JUSTIFICATIVA}</textarea></div>

            <br />
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:565px;" >
                Funcionário Cadastro
                <input type="text" name="TX_FUNCIONARIO_CAD" id="TX_FUNCIONARIO_CAD" value="{$VO->TX_FUNCIONARIO_CAD}"  style="width:555px;" readonly="readonly" class="leitura"/></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" >
                Data Cadastro
                <input type="text" name="DT_CADASTRO" id="DT_CADASTRO" value="{$VO->DT_CADASTRO}"  style="width:200px;" readonly="readonly" class="leitura"/></div>

            <br />
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:565px;" >
                Funcionário Atualização
                <input type="text" name="TX_FUNCIONARIO_ATUAL" id="TX_FUNCIONARIO_ATUAL" value="{$VO->TX_FUNCIONARIO_ATUAL}"  style="width:555px;" readonly="readonly" class="leitura"/></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" >
                Data Atualização
                <input type="text" name="DT_ATUALIZACAO" id="DT_ATUALIZACAO" value="{$VO->DT_ATUALIZACAO}"  style="width:200px;" readonly="readonly" class="leitura"/></div>

            <br /><br />

            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/detail.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
