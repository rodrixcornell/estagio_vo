<style>	.ui-combobox input{ width: 420px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Alterar {$titulopage}</div>

    <br /><br /><br /><hr />
    <div id="conteudo">
        Para alterar a {$titulopage} preencha o formulário abaixo e clique em Avançar:<br /><br /><br />

        <form name="form" action="{$url}src/{$pasta}/alterar.php" method="post">

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" >
                <font color="#FF0000">*</font>Órgão Gestor: <font color="#FF0000">{$validar.ID_ORGAO_GESTOR_ESTAGIO}</font>
                <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:300px;">
                    {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
                </select></div><br />

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" >
                <font color="#FF0000">*</font>Nome da Tabela: <font color="#FF0000">{$validar.TX_TABELA}</font>
                <input type="text" name="TX_TABELA" id="TX_TABELA" value="{$VO->TX_TABELA}"  style="width:200px;" /></div><br />

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" >
                <font color="#FF0000">*</font>Data Início de Vigência: <font color="#FF0000">{$validar.DT_INICIO_VIGENCIA}</font><br />
                <input type="text" name="DT_INICIO_VIGENCIA" id="DT_INICIO_VIGENCIA" value="{$VO->DT_INICIO_VIGENCIA}" style="width:120px;" /></div><br />

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" >
                Data Fim de Vigência:<br />
                <input type="text" name="DT_FIM_VIGENCIA" id="DT_FIM_VIGENCIA" value="{$VO->DT_FIM_VIGENCIA}" style="width:120px;" /></div><br />

            <br />
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:360px;" >
                Usuário do Cadastro:
                <input type="text" name="TX_FUNCIONARIO_CAD" id="TX_FUNCIONARIO_CAD" value="{$VO->TX_FUNCIONARIO_CAD}"  style="width:350px;" readonly="readonly" class="leitura"/></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" >
                Data do Cadastro:
                <input type="text" name="DT_CADASTRO" id="DT_CADASTRO" value="{$VO->DT_CADASTRO}"  style="width:200px;" readonly="readonly" class="leitura"/></div>

            <br />
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:360px;" >
                Usuário da Atualização:
                <input type="text" name="TX_FUNCIONARIO_ATUAL" id="TX_FUNCIONARIO_ATUAL" value="{$VO->TX_FUNCIONARIO_ATUAL}"  style="width:350px;" readonly="readonly" class="leitura"/></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" >
                Data da Atualização:
                <input type="text" name="DT_ATUALIZACAO" id="DT_ATUALIZACAO" value="{$VO->DT_ATUALIZACAO}"  style="width:200px;" readonly="readonly" class="leitura"/></div>

            <br /><br />

            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/detail.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
