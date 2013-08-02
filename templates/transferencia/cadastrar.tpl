<style>	.ui-combobox input{ width: 420px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Nova {$titulopage}</div>

    <br /><br /><br /><hr />
    <div id="conteudo">
        Para uma nova {$titulopage} preencha o formulário abaixo e clique em Salvar:<br /><br />

        <form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">
                          
                {*---------orgão gestor---------------------*}
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:360px;" >
                <font color="#FF0000">*</font>Órgão Gestor<font color="#FF0000">{$validar.ID_ORGAO_GESTOR_ESTAGIO}</font>
                <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:350px;">
                    {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
                </select></div>
                
               {*-----------solicitante----------------------*}     
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:360px;" >
                <font color="#FF0000">*</font>Órgão Solicitante<font color="#FF0000">{$validar.ID_ORGAO_SOLICITANTE}</font>
                <select name="ID_ORGAO_SOLICITANTE" id="ID_ORGAO_SOLICITANTE" style="width:350px;">
                    {html_options options=$arrayOrgaoSolicitante selected=$VO->ID_ORGAO_SOLICITANTE}
                </select></div><br />
                
                {*--------------cedente-------------------------*}
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:360px;" >
                <font color="#FF0000">*</font>Órgão Cedente <font color="#FF0000">{$validar.ID_ORGAO_ESTAGIO}</font>
                <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO" style="width:350px;">
                    {*html_options options=$arraypesquisarOrgaoCedente selected=$VO->ID_ORGAO_ESTAGIO*}
                </select></div>
                
               {*-------------------------------------------*}
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:360px;" >
                <font color="#FF0000">*</font>Quadro de Vagas de Estágio <font color="#FF0000">{$validar.ID_QUADRO_VAGAS_ESTAGIO}</font>
                <select name="ID_QUADRO_VAGAS_ESTAGIO" id="ID_QUADRO_VAGAS_ESTAGIO" style="width:350px;">
                    {*{html_options options=$arrayQuadroVagasEstagio selected=$VO->ID_QUADRO_VAGAS_ESTAGIO}*}
                </select></div><br />
         
                
             {*-----------justificativa-------------------*}
              <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:720px;" >
               Motivo / Justificativa: <font color="#FF0000">{$validar.TX_MOTIVO}</font>
              <textarea name="TX_MOTIVO" id="TX_MOTIVO" style="width:710px;" rows="2">{$VO->TX_MOTIVO}</textarea></div>
              <br /><br />

            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>