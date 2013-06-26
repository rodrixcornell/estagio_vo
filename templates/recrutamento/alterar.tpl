<style>	.ui-combobox input{ width: 400px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Alterar {$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        Para alterar o Recrutamento de Estagiário preencha o formulário abaixo e clique em Avançar:<br /><br /><br />
        <form name="form" action="{$url}src/{$pasta}/alterar.php" method="post">
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;">
                <font color="#FF0000">*</font>Órgão Gestor <font color="#FF0000">{$validar.ID_ORGAO_GESTOR_ESTAGIO}</font><br />
                <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:300px;">
                    {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_ESTAGIO_GEST}
                </select></div> 

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;">
                <font color="#FF0000">*</font>Órgão Solicitante<font color="#FF0000">{$validar.ID_ORGAO_ESTAGIO}</font><br />
                <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO" style="width:300px;">
                    {html_options options=$arrayOrgaoSolicitante selected=$VO->ID_ORGAO_ESTAGIO}
                </select></div> <br />
                
                
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;">
                <font color="#FF0000">*</font>Quadro de Vagas<font color="#FF0000">{$validar.ID_QUADRO_VAGAS_ESTAGIO}</font><br />
                <select name="ID_QUADRO_VAGAS_ESTAGIO" id="ID_QUADRO_VAGAS_ESTAGIO" style="width:300px;">
                    {html_options options=$arrayQuadroVagas selected=$VO->ID_QUADRO_VAGAS_ESTAGIO}
                </select></div> 
            
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
                <font color="#FF0000"></font>Doc. de Autorização <font color="#FF0000">{$validar.TX_DOC_AUTORIZACAO}</font><br />
                <input type="text" name="TX_DOC_AUTORIZACAO" id="TX_DOC_AUTORIZACAO" value="{$VO->TX_DOC_AUTORIZACAO}" style="width:300px;" /></div>  
                <br />

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
              <font color="#FF0000"></font>Motivo/Justificativa<font color="#FF0000"></font><br />
              <textarea name="TX_MOTIVO" name="TX_MOTIVO" id="TX_MOTIVO"  style="width:600px;"  cols="45" rows="5">{$VO->TX_MOTIVO}</textarea>  </div><br />
              
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:300px;">
                Usuário do Cadastro <font color="#FF0000">{$validar.TX_LOGIN_CAD}</font><br />
                <input type="text" name="CADASTRADOPOR" id="CADASTRADOPOR" value="{$VO->CADASTRADOPOR}" style="width:290px;" class="leitura" readonly="readonly" /></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:300px;">
                Data de Cadastro <font color="#FF0000">{$validar.DT_CADASTRO}</font><br />
                <input type="text" name="DT_CADASTRO" id="DT_CADASTRO" value="{$VO->DT_CADASTRO}" style="width:290px;" class="leitura" readonly="readonly" /></div>


            <br />    
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:300px;">
                Usuário da Atualização <font color="#FF0000">{$validar.ALTERADOPOR}</font><br />
                <input type="text" name="ALTERADOPOR" id="ALTERADOPOR" value="{$VO->ALTERADOPOR}" style="width:290px;" class="leitura" readonly="readonly" /></div>



            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:300px;">
                Data de Atualização <font color="#FF0000">{$validar.DT_ATUALIZACAO}</font><br />
                <input type="text" name="DT_ATUALIZACAO" id="DT_ATUALIZACAO" value="{$VO->DT_ATUALIZACAO}" style="width:290px;" class="leitura" readonly="readonly" /></div>


            <br /><br />

            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/detail.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
