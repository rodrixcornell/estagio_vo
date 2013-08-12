<style>	.ui-combobox input{ width: 420px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Novo {$titulopage}</div>
    <br />
    <br />
    <br />
    <hr />

    <div id="conteudo">

        Para um novo cadastro de Quadro de Vagas preencha o formulário abaixo e clique em Salvar:<br /><br />

        <form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;">
                <font color="#FF0000">*</font>Órgão Gestor <font color="#FF0000">{$validar.ID_ORGAO_GESTOR_ESTAGIO}</font><br />
                <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:500px;">
                    {html_options options=$pesquisarOrgaogestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
                </select></div>
            <br />

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;">
                <font color="#FF0000">*</font>Agencia de Estágio <font color="#FF0000">{$validar.ID_AGENCIA_ESTAGIO}</font><br />
                <select name="ID_AGENCIA_ESTAGIO" id="ID_AGENCIA_ESTAGIO" style="width:500px;">
                    {html_options options=$pesquisarAgenciaestagio selected=$VO->ID_AGENCIA_ESTAGIO}
                </select></div>
            <br />

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;">
                <font color="#FF0000">*</font>Situação <font color="#FF0000">{$validar.CS_SITUACAO}</font><br />
                <select name="CS_SITUACAO" id="CS_SITUACAO" style="width:200px;">
                    {html_options options=$arraySituacao selected=$VO->CS_SITUACAO}
                </select></div>
             
                
                 <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;">
                <font color="#FF0000">*</font>Contrato <font color="#FF0000">{$validar.ID_CONTRATO_CP}</font><br />
                <select name="ID_CONTRATO_CP" id="ID_CONTRATO_CP" style="width:200px;">
                    {html_options options=$pesquisaContrato selected=$VO->ID_CONTRATO_CP}
                </select></div>
                <br /><br />

            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
