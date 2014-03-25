<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Novo {$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        <form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">
            Para cadastrar um novo Contrato de Estágio preencha o formulário abaixo e clique em Salvar:<br /><br />

            <!-- FildSet da Unidade Solicitante -->
            <fieldset>
                <legend>Unidade Concedente</legend>

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:300px;" > <font color="#FF0000">*</font>Órgão Gestor<font color="#FF0000">{$validar.ID_ORGAO_GESTOR_ESTAGIO}</font><br />
                    <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:290px;">
                        {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
                    </select>
                </div>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:300px;" > <font color="#FF0000">*</font>Órgão Solicitante<font color="#FF0000">{$validar.ID_ORGAO_ESTAGIO}</font><br />
                    <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO_CAD" style="width:290px;">
                        {html_options options=$arrayOrgaoSolicitante selected=$VO->ID_ORGAO_ESTAGIO}
                    </select>
                </div>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:280px;" >Secretário do Órgão Gestor
                    <input type="text" name="TX_FUNCIONARIO" id="TX_FUNCIONARIO" value="{$VO->TX_FUNCIONARIO}"  style="width:300px;" class="leitura" readonly="readonly" />
                </div>
                <br />

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:920px;" >Endereço do Órgão Gestor
                    <input type="text" name="TX_ENDERECO_SEC" id="TX_ENDERECO_SEC" value="{$VO->TX_ENDERECO_SEC}"  style="width:910px;" class="leitura" readonly="readonly" />
                </div>
                <br />

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:270px;" > <font color="#FF0000"></font>Tipo de Seleção:<font color="#FF0000">{$validar.CS_TIPO}</font><br />
                    {*<select name="CS_TIPO" id="CS_TIPO" style="width:200px;">
                    {html_options options=$arrayTipoContrato selected=$VO->CS_TIPO}
                    </select>*}

                    <input type="radio" name="CS_SELECAO" ID="CHECK_RESP" value="1"><font color="#FF0000">*</font>Com Seleção ||<b> OU </b>||
                    <input type="radio" name="CS_SELECAO" ID="CHECK_RESP_2" value="2"><font color="#FF0000">*</font>Sem Seleção<font color="#FF0000"> {$validar.CS_SELECAO}</font>
                </div>

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:300px;" > <font color="#FF0000">*</font>Candidato<font color="#FF0000">{$validar.ID_PESSOA_ESTAGIARIO}</font><br />
                    <select name="ID_PESSOA_ESTAGIARIO" id="ID_PESSOA_ESTAGIARIO" style="width:290px;">
                        {html_options options=$arrayPessoaEstagiario selected=$VO->ID_PESSOA_ESTAGIARIO}
                    </select>
                </div>

                <br />

            </fieldset>
            <!-- FIm FildSet da Unidade Solicitante -->

            <!--   FildSet para mostrar seleção caso o estagiario tenha seleção         -->
            {*<fieldset id="SELECAO_ID" style="display: none;">

                <legend>Seleção</legend>

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" > <font color="#FF0000">*</font>Código da seleção:<font color="#FF0000">{$validar.ID_SELECAO_ESTAGIO}</font><br />
                    <select name="ID_SELECAO_ESTAGIO" id="ID_SELECAO_ESTAGIO" style="width:170px;">
                        {html_options options=$arrayCodSelecao selected=$VO->ID_SELECAO_ESTAGIO}
                    </select>
                </div>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" > <font color="#FF0000">*</font>Quadro de Vagas:<font color="#FF0000">{$validar.ID_QUADRO_VAGAS_ESTAGIO}</font><br />

                    <input type="text" name="TX_CODIGO_QUADRO_VAGAS" id="TX_CODIGO_QUADRO_VAGAS" value="{$VO->TX_CODIGO_QUADRO_VAGAS}"  style="width:150px;" class="leitura" readonly="readonly" />
                    <input type="hidden" name="ID_QUADRO_VAGAS_ESTAGIO" id="ID_QUADRO_VAGAS_ESTAGIO" value="{$VO->ID_QUADRO_VAGAS_ESTAGIO}"    />
                </div>

            </fieldset>*}
            <!-- fim FildSet do Estagiário -->

            <br />

            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href = '{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />

        </form>

    </div>
</div>