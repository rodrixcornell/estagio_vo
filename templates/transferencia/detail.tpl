<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">

        <form name="form" action="{$url}src/{$pasta}/excluir.php" method="post" >
            <fieldset>
                <legend>{$titulopage}</legend>
                <table width="100%" class="dataGrid">
                    <tr bgcolor="#E0E0E0">
                        <td style="width:210px;"><strong>Órgão Gestor</strong></td>
                        <td style="width:500px;">{$dados.TX_ORGAO_GESTOR_ESTAGIO[0]}</td>
                        <td style="width:150px;"><strong>Agencia de Estágio</strong></td>
                        <td style="width:200px;">{$dados.TX_AGENCIA_ESTAGIO[0]}</td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Órgão Solicitante</strong></td>
                        <td>{$dados.TX_ORGAO_ESTAGIO[0]}</td>
                        <td><strong>Cód. da Solicitação</strong></td>
                        <td><div id="atualizacao">{$dados.TX_COD_SOLICITACAO[0]}</div></td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td><strong>Quadro de Vagas de Estágio</strong></td>
                        <td>{$dados.TX_CODIGO[0]}</td>
                        <td><strong>Situação</strong></td>
                        <td>{$arraySituacao[$dados.CS_SITUACAO[0]]}</td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td style="vertical-align:baseline; padding-top:4px;"><strong>Motivo / Justificativa</strong></td>
                        <td colspan="3">{$dados.TX_JUSTIFICATIVA[0]}</td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td><strong>Cadastrado por</strong></td>
                        <td>{$dados.TX_FUNCIONARIO_CAD[0]}</td>
                        <td><strong>Data do Cadastro</strong></td>
                        <td style="text-align:right;">{$dados.DT_CADASTRO[0]}</div></td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Alterado por</strong></td>
                        <td>{$dados.TX_FUNCIONARIO_ATUAL[0]}</td>
                        <td><strong>Data de Atualização</strong></td>
                        <td style="text-align:right;"><div id="atualizacao">{$dados.DT_ATUALIZACAO[0]}</div></td>
                    </tr>
                </table>

                {if $acesso}
                    <div id="botoes">
                        <a href="{$url}src/{$pasta}/alterar.php"><img src="{$urlimg}icones/alterar.png"  alt="Alterar" title="Alterar" id="alterarMaster" /></a>
                        <a href="{$url}src/{$pasta}/excluir.php"><img src="{$urlimg}icones/excluir.png"  alt="Excluir" title="Excluir" id="excluirMaster" /></a>
                    </div>
                {/if}
            </fieldset>
        </form>

        <div class="fundo_pag"><img src="{$urlimg}icones/loader.gif" alt=""></div>

        {if $acesso}
            <fieldset>
                <legend>Cadastrar Vagas de Estátgio</legend>

                <div id="camada" style="width:210px;">
                    <strong><font color="#FF0000">*</font>Tipo</strong><br />
                    <select name="ID_CS_CODIGO" id="ID_CS_CODIGO" style="width:200px;">
                        {html_options options=$arrayTipoVaga selected=$VO->ID_CS_CODIGO}
                    </select></div>

                <div id="camada" style="width:110px;" >
                    <strong><font color="#FF0000">*</font>Quantidade</strong><br />
                    <input type="text" name="NB_QUANTIDADE" id="NB_QUANTIDADE" value="{$VO->NB_QUANTIDADE}" style="width:100px;" /></div>

                <div id="camada" style="width:210px;">
                    <strong>Curso</strong><br />
                    <select name="ID_CURSO_ESTAGIO" id="ID_CURSO_ESTAGIO" style="width:200px;">
                        {*html_options options=$arrayUnidadeDetail selected=$VO->ID_CURSO_ESTAGIO*}
                    </select></div>

                <input type="button" name="inserir" id="inserir" value=" Inserir " />
                <input type="button" name="efetivar" id="efetivar" value=" Efetivar Solicitação " style="margin-top:17px; float:right; padding:4px 8px; font-weight:bold;"/>
            </fieldset>
        {/if}

        <div id="tabelaVagasSolicitadas"></div>


        <div id="botoesInferiores">
            <a href="{$url}src/{$pasta}/index.php"><img src="{$urlimg}icones/voltar.png" alt="Voltar" title="Voltar" class="voltar" /></a>
            <a href="{$url}src/{$pasta}/index.php"><img src="{$urlimg}icones/finalizar.png" alt="Finalizar" title="Finalizar" class="finalizar"/></a>
        </div>
    </div>
</div>