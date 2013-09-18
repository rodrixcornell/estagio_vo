<style>	.ui-combobox input{ width: 400px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Alterar {$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        Para alterar o Termo de Aditivo de Contrato preencha o formulário abaixo e clique em Salvar:<br /><br /><br />
        <form name="form" action="{$url}src/{$pasta}/alterar.php" method="post">

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" >
                <font color="#FF0000">*</font>Órgão Gestor: <font color="#FF0000">{$validar.ID_ORGAO_GESTOR_ESTAGIO}</font><br />
                <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:170px;">
                    {html_options options=$pesquisarOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
                </select><br /></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" >
                Código do Contrato: <font color="#FF0000">{$validar.ID_CONTRATO_CP}</font><br />
                <select name="ID_CONTRATO_CP" id="ID_CONTRATO_CP" disabled="disabled" style="width:170px;">
                    {html_options options=$pesquisarNB_Codigo selected=$VO->ID_CONTRATO_CP}
                </select><br /></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:200px;" >
                <font color="#FF0000">*</font>Agencia de Estágio de Estágio <font color="#FF0000">{$validar.ID_AGENCIA_ESTAGIO}</font><br />
                <select name="ID_AGENCIA_ESTAGIO" id="ID_AGENCIA_ESTAGIO" style="width:250px;">
                    {html_options options=$pesquisarAgenciaDeEstagio selected=$VO->ID_AGENCIA_ESTAGIO}
                </select><br /></div>
            <br />

            <div id="camada" style="width:180px;"> <font color="#FF0000">*</font>Dt. do TA<font color="#FF0000"> {$validar.DT_ADITIVO} </font><br />
                <input type="text" name="DT_ADITIVO" id="DT_ADITIVO" value="{$VO->DT_ADITIVO}" style="width:160px;" /></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;">
                Código do TA <font color="#FF0000">{$validar.NB_CODIGO}</font><br />
                <input type="text" name="NB_CODIGO" id="NB_CODIGO" value="{$VO->NB_CODIGO}" style="width:150px;" class="leitura" readonly="readonly" /></div>
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:170px;">
                Termo Aditivo do Contrato <font color="#FF0000">{$validar.TX_TERMO_ADITIVO}</font><br />
                <input type="text" name="TX_TERMO_ADITIVO" id="TX_TERMO_ADITIVO" value="{$VO->TX_TERMO_ADITIVO}" style="width:170px;" class="leitura" readonly="readonly" /></div>
            <br />

            <div id="camada" style="width:170px;"> <font color="#FF0000">*</font>Dt. Início Vigencia<font color="#FF0000"> {$validar.DT_INICIO_VIGENCIA} </font><br />
                <input type="text" name="DT_INICIO_VIGENCIA" id="DT_INICIO_VIGENCIA" value="{$VO->DT_INICIO_VIGENCIA}" style="width:160px;" /></div>

            <div id="camada" style="width:170px;"> <font color="#FF0000">*</font>Dt. Início Vigencia<font color="#FF0000"> {$validar.DT_FIM_VIGENCIA} </font><br />
                <input type="text" name="DT_FIM_VIGENCIA" id="DT_FIM_VIGENCIA" value="{$VO->DT_FIM_VIGENCIA}" style="width:160px;" /></div>

            <br />

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:630px;">Objeto do Termo Aditivo
                <font color="#FF0000"></font>{$validar.TX_OBJETO}</font>&nbsp;<br />
                <textarea name="TX_OBJETO" id="TX_OBJETO" value="{$VO->TX_OBJETO}" style="width:760px; height:110px;" />{$VO->TX_OBJETO}</textarea>
            </div>

            <br /><br />

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;">
                Usuário do Cadastro <font color="#FF0000">{$validar.TX_FUNCIONARIO_CAD}</font><br />
                <input type="text" name="TX_FUNCIONARIO_CAD" id="TX_FUNCIONARIO_CAD" value="{$VO->TX_FUNCIONARIO_CAD}" style="width: 300px;" class="leitura" readonly="readonly" /></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;">
                Data de Cadastro <font color="#FF0000">{$validar.DT_CADASTRO}</font><br />
                <input type="text" name="DT_CADASTRO" id="DT_CADASTRO" value="{$VO->DT_CADASTRO}" style="width:150px;" class="leitura" readonly="readonly" /></div>

            <br />

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;">
                Usuário de Atualização <font color="#FF0000">{$validar.TX_FUNCIONARIO_ATUAL}</font><br />
                <input type="text" name="TX_FUNCIONARIO_ATUAL" id="TX_FUNCIONARIO_ATUAL" value="{$VO->TX_FUNCIONARIO_ATUAL}" style="width:300px;" class="leitura" readonly="readonly" /></div>

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;">
                Data de Atualização <font color="#FF0000">{$validar.DT_ATUALIZACAO}</font><br />
                <input type="text" name="DT_ATUALIZACAO" id="DT_ATUALIZACAO" value="{$VO->DT_ATUALIZACAO}" style="width:150px;" class="leitura" readonly="readonly" /></div>

            <br /><br />

            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href = '{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
