<style>	.ui-combobox input{ width: 420px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Novo {$titulopage}</div>

    <br /><br /><br /><hr />
	
    <div id="conteudo">
        Para um novo Recrutamento de Estagiário preencha o formulário abaixo e clique em Avançar:<br /><br />
        <form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;">
                <font color="#FF0000">*</font>Órgão Gestor <font color="#FF0000"> {$validar.ID_ORGAO_GESTOR_ESTAGIO}</font><br />
                <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:300px;">
                    {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
                </select></div> 

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;">
                <font color="#FF0000">*</font>Órgão Solicitante<font color="#FF0000"> {$validar.ID_ORGAO_ESTAGIO}</font><br />
                <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO" style="width:300px;">
                    {html_options options=$arrayOrgaoSolicitante selected=$VO->ID_ORGAO_ESTAGIO}
                </select></div> <br />
                
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;">
                <font color="#FF0000">*</font>Solicitação<font color="#FF0000"> {$validar.ID_SOLICITACAO_ESTAGIO}</font><br />
                <select name="ID_SOLICITACAO_ESTAGIO" id="ID_SOLICITACAO_ESTAGIO" style="width:150px;">
                    {html_options options=$arraySolicitacao selected=$VO->ID_SOLICITACAO_ESTAGIO}
                </select></div> 
                
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;">
                <font color="#FF0000">*</font>Quadro de Vagas<font color="#FF0000"> {$validar.ID_QUADRO_VAGAS_ESTAGIO}</font><br />
                <select name="ID_QUADRO_VAGAS_ESTAGIO" id="ID_QUADRO_VAGAS_ESTAGIO" style="width:200px;">
                    {html_options options=$arrayQuadroVagas selected=$VO->ID_QUADRO_VAGAS_ESTAGIO}
                </select></div> 
            
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:245px;">
                <font color="#FF0000"></font>Doc. de Autorização <font color="#FF0000">{$validar.TX_DOC_AUTORIZACAO}</font><br />
                <input type="text" name="TX_DOC_AUTORIZACAO" id="TX_DOC_AUTORIZACAO" value="{$VO->TX_DOC_AUTORIZACAO}" style="width:235px;" /></div>  
                <br />

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:610px;">
              <font color="#FF0000"></font>Motivo / Justificativa<font color="#FF0000">{$validar.TX_MOTIVO}</font><br />
              <textarea name="TX_MOTIVO" id="TX_MOTIVO" style="width:610px; height:100px;" >{$VO->TX_MOTIVO}</textarea></div>

                
            <br /><br /><br />
                        
            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
