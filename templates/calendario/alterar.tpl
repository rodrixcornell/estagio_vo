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
                <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:300px;" disabled="disabled">
                    {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
                </select></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" >
                <font color="#FF0000">*</font>Ano de Referência: <font color="#FF0000">{$validar.NB_ANO_REFERENCIA}</font>
                <select name="NB_ANO_REFERENCIA" id="NB_ANO_REFERENCIA" style="width:150px;">
                    {html_options options=$arrayAnos selected=$VO->NB_ANO_REFERENCIA}
                </select></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" >
                <font color="#FF0000">*</font>Mês de Referência: <font color="#FF0000">{$validar.NB_MES_REFERENCIA}</font>
                <select name="NB_MES_REFERENCIA" id="NB_MES_REFERENCIA" style="width:150px;">
                    {html_options options=$arrayMeses selected=$VO->NB_MES_REFERENCIA}
                </select></div><br />

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" >
                Data do Cadastro:
                <input type="text" name="DT_CADASTRO" id="DT_CADASTRO" value="{$VO->DT_CADASTRO}"  style="width:200px;" readonly="readonly" class="leitura"/></div>


            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" >
                Data da Atualização:
                <input type="text" name="DT_ATUALIZACAO" id="DT_ATUALIZACAO" value="{$VO->DT_ATUALIZACAO}"  style="width:200px;" readonly="readonly" class="leitura"/></div>

            <br /><br />

            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/detail.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
