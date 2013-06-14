<style>	.ui-combobox input{ width: 400px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Alterar {$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        Para alterar a Seleção de Estagiário preencha o formulário abaixo e clique em Avançar:<br /><br />
        <form name="form" action="{$url}src/{$pasta}/alterar.php" method="post">

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:400px;" >
                <font color="#FF0000">*</font>Órgão Gestor <font color="#FF0000">{$validar.ID_ORGAO_GESTOR_ESTAGIO}</font>
                <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:400px;">
                    {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
                </select></div>
                
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:400px;" ><font color="#FF0000">*</font>Órgão Solicitante <font color="#FF0000">{$validar.ID_ORGAO_ESTAGIO}</font>
                <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO" style="width:400px;">
                    {html_options options=$arrayOrgaoSolicitante selected=$VO->ID_ORGAO_ESTAGIO}
                </select></div><br />

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:200px;" >
                <font color="#FF0000">*</font>Cód. do Recrutamento <font color="#FF0000">{$validar.ID_RECRUTAMENTO_ESTAGIO}</font>
                <select name="ID_RECRUTAMENTO_ESTAGIO" id="ID_RECRUTAMENTO_ESTAGIO" style="width:200px;">
                    {html_options options=$arrayRecrutamento selected=$VO->ID_RECRUTAMENTO_ESTAGIO}
                </select></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:155px;" >Data de Agendamento <br />
              <input type="text" name="DT_AGENDAMENTO" id="DT_AGENDAMENTO" value="{$VO->DT_AGENDAMENTO}"  style="width:150px;" /></div> 

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" >Data de Realização <br />
              <input type="text" name="DT_REALIZACAO" id="DT_REALIZACAO" value="{$VO->DT_REALIZACAO}"  style="width:150px;" /></div> 

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><font color="#FF0000">*</font>Situação <font color="#FF0000">{$validar.CS_SITUACAO}</font>
                <select name="CS_SITUACAO" id="CS_SITUACAO" style="width:150px;">
                    {html_options options=$arraySituacao selected=$VO->CS_SITUACAO}
                </select></div>

            <br /><br />

            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/detail.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
