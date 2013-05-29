<style>	.ui-combobox input{ width: 400px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Alterar {$titulopage}</div>

    <br /><br /><br /><hr />
	
    <div id="conteudo">
        Para alterar o Quadro de Vagas  preencha o formulário abaixo e clique em Salvar:<br /><br /><br />
        <form name="form" action="{$url}src/{$pasta}/alterar.php" method="post">
	
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;">
            <font color="#FF0000">*</font>Órgão Gestor: <font color="#FF0000">{$validar.ID_ORGAO_ESTAGIO}</font><br />
            <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO" style="width:500px;">
            {html_options options=$orgao_Solicitante selected=$VO->ID_ORGAO_ESTAGIO}
            </select></div>
            <br />
           
            
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;">
            <font color="#FF0000">*</font>Agencia de Estágio:  <font color="#FF0000">{$validar.CS_TIPO_VAGA_ESTAGIO}</font><br />
            <select name="CS_TIPO_VAGA_ESTAGIO" id="CS_TIPO_VAGA_ESTAGIO" style="width:500px;">
            {html_options options=$pesquisarTipo selected=$VO->CS_TIPO_VAGA_ESTAGIO}
            </select></div>
            <br />
            
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">Usuário do Cadastro: <font color="#FF0000">{$validar.NB_QUANTIDADE}</font><br />
            <input type="text" name="NB_QUANTIDADE" id="NB_QUANTIDADE" value="{$VO->NB_QUANTIDADE}" style="width:400px;" class="leitura" readonly="readonly" /></div>
          
             <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;">
            <font color="#FF0000">*</font>Situação:  <font color="#FF0000">{$validar.ID_CURSO_ESTAGIO}</font><br />
            <select name="ID_CURSO_ESTAGIO" id="ID_CURSO_ESTAGIO" style="width:200px;">
            {html_options options=$pesquisaCursos selected=$VO->ID_CURSO_ESTAGIO}
            </select></div>
            <br />
            
            
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;">Data de Cadastro <font color="#FF0000">{$validar.DT_CADASTRO}</font><br />
            <input type="text" name="DT_CADASTRO" id="DT_CADASTRO" value="{$VO->DT_CADASTRO}" style="width:150px;" class="leitura" readonly="readonly" /></div>
            <br />
           
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;">Data de Atualização <font color="#FF0000">{$validar.DT_ATUALIZACAO}</font><br />
            <input type="text" name="DT_ATUALIZACAO" id="DT_ATUALIZACAO" value="{$VO->DT_ATUALIZACAO}" style="width:150px;" class="leitura" readonly="readonly" /></div>
            <br />
            <br />
          
            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/detail.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
