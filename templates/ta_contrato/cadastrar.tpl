<style>	.ui-combobox input{ width: 420px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Nova {$titulopage}</div>

    <br /><br /><br /><hr />
    <div id="conteudo">
        Para cadastrar uma nova {$titulopage} preencha o formulário abaixo e clique em Salvar <br /><br />
          
         <!-- Fieldset da solicitacao -->
         <fieldset>
              <legend>Solicitação</legend>
        
        <form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">
            
            <!-- ORGAO GESTOR DE ESTAGIO -->
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;">
                <font color="#FF0000">*</font>Órgão Gestor <font color="#FF0000">{$validar.ID_ORGAO_GESTOR_ESTAGIO}</font>
                <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:300px;">
                    {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
                </select></div>
                
            <!-- CODIGO DO CONTRATO -->    
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" >
                <font color="#FF0000">*</font> Código do Contrato <font color="#FF0000">{$validar.ID_CONTRATO_CP}</font>
                <select name="ID_CONTRATO_CP" id="ID_CONTRATO_CP" style="width:200px;">
                    {html_options options=$arrayCodigoContrato selected=$VO->ID_CONTRATO_CP}
                </select></div>
                
            {*-- AGENCIA DE ESTAGIO --   
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" >
                Agência de Estágio 
                 <input type="text" name="ID_AGENCIA_ESTAGIO" id="ID_AGENCIA_ESTAGIO" value="{$VO->ID_AGENCIA_ESTAGIO}"  style="width:380px;" class="leitura" readonly="readonly"/><br />
            </div>*} <br />
           
            <!-- DATA DA SOLICITACAO -->  
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" >
            <font color="#FF0000">*</font> Data Solicitação <br />
            <input type="text" name="DT_SOLICITACAO" id="DT_SOLICITACAO" value="{$VO->DT_SOLICITACAO}"  style="width:145px;" /><br />
            </div>
            
            <!-- UNIDADE ORGAO ORIGEM -->   
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:370px;" >
            <font color="#FF0000">*</font>Unidade Organizacional de Origem<font color="#FF0000">{$validar.ID_UNIDADE_ORG_ORIGEM}</font>
            <select name="ID_UNIDADE_ORG_ORIGEM" id="ID_UNIDADE_ORG_ORIGEM" style="width:360px;">
               {html_options options=$arraybuscarUnidadeOrigem selected=$VO->ID_UNIDADE_ORG_ORIGEM}
            </select></div>
               
            <!-- UNIDADE ORGAO DESTINO -->  
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:320px;" >
                <font color="#FF0000">*</font>Unidade Organizacional de Destino<font color="#FF0000">{$validar.ID_UNIDADE_ORG_DESTINO}</font>
                <select name="ID_UNIDADE_ORG_DESTINO" id="ID_UNIDADE_ORG_DESTINO" style="width:385px;">
                    {html_options options=$arraybuscarUnidadeDestino selected=$VO->ID_UNIDADE_ORG_DESTINO}
                </select></div><br/>
                
            <!-- ASSUNTO -->   
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" >
               <font color="#FF0000">*</font> Assunto <br />
                 <input type="text" name="TX_ASSUNTO" id="TX_ASSUNTO" value="{$VO->TX_ASSUNTO}"  style="width:510px;" /><br />
            </div><br/>  
               
            <!-- TEXTO DA SOLICITAÇÃO -->    
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:630px;" >
                 <font color="#FF0000">*</font>Texto da solicitação <font color="#FF0000">{$validar.TX_SOLICITACAO}</font>
                <textarea name="TX_SOLICITACAO" id="TX_SOLICITACAO" style="width:910px; height:110px;" >{$VO->TX_SOLICITACAO}</textarea></div>

             </fieldset>
             <!-- Fim do Fieldset da solicitacao -->
                
            <br /><br />

            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>