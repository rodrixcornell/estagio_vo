<style>	.ui-combobox input{ width: 420px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Nova {$titulopage}</div>

    <br /><br /><br /><hr />
	
    <div id="conteudo">
        Para uma nova Seleção de Estagiário preencha o formulário abaixo e clique em Salvar:<br /><br />

        <form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" >
                <font color="#FF0000">*</font>Órgão Gestor<font color="#FF0000"> {$validar.ID_ORGAO_GESTOR_ESTAGIO}</font>
                <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO_CAD" style="width:300px;">
                    {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
                </select></div>
                
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" >
            	<font color="#FF0000">*</font>Órgão Solicitante<font color="#FF0000"> {$validar.ID_ORGAO_ESTAGIO}</font>
                <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO_CAD" style="width:300px;">
                    {html_options options=$arrayOrgaoSolicitante selected=$VO->ID_ORGAO_ESTAGIO}
                </select></div><br />

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" >
                <font color="#FF0000">*</font>Cód. do Recrutamento <font color="#FF0000"> {$validar.ID_RECRUTAMENTO_ESTAGIO}</font>
                <select name="ID_RECRUTAMENTO_ESTAGIO" id="ID_RECRUTAMENTO_ESTAGIO" style="width:150px;">
                    {html_options options=$arrayRecrutamento selected=$VO->ID_RECRUTAMENTO_ESTAGIO}
                </select></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" >Data de Agendamento  <font color="#FF0000"> {$validar.DT_AGENDAMENTO}</font><br />
              <input type="text" name="DT_AGENDAMENTO" id="DT_AGENDAMENTO" value="{$VO->DT_AGENDAMENTO}"  style="width:150px;" /></div> 

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" >Data de Realização  <font color="#FF0000"> {$validar.DT_REALIZACAO}</font><br />
              <input type="text" name="DT_REALIZACAO" id="DT_REALIZACAO" value="{$VO->DT_REALIZACAO}"  style="width:150px;" /></div> 

            <br /><br /><br />
                        
            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>