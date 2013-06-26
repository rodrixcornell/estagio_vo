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
                        <td style="width:210px;"><strong>Nome da  Tabela</strong></td>
                        <td style="width:450px;"><font color="#0000FF" class="num_em"><strong>{$dados.TX_TABELA[0]}</strong></font></td>
                        <td style="width:210px;"><strong>Data Início de Vigência</strong></td>
                        <td style="width:200px; text-align:right;">{$dados.DT_INICIO_VIGENCIA[0]}</td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Órgão Gestor</strong></td>
                        <td>{$dados.TX_ORGAO_GESTOR_ESTAGIO[0]}</td>
                        <td><strong>Data Fim de Vigência</strong></td>
                        <td style="text-align:right;">{$dados.DT_FIM_VIGENCIA[0]}</td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td><strong>Cadastrado por</strong></td>
                        <td>{$dados.TX_FUNCIONARIO_CAD[0]}</td>
                        <td><strong>Data do Cadastro</strong></td>
                        <td style="text-align:right;">{$dados.DT_CADASTRO[0]}</div></td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Alterado por</strong></td>
                        <td><div id="funcionario">{$dados.TX_FUNCIONARIO_ATUAL[0]}</div></td>
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
                <legend>Cadastrar Itens Tabela Recesso</legend>

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:140px;" >
                    <font color="#FF0000">*</font><strong>Tempo de Estágio</strong><br />
                <input type="text" name="TX_DURACAO_ESTAGIO" id="TX_DURACAO_ESTAGIO" value="{$VO->TX_DURACAO_ESTAGIO}"  style="width:130px;" /></div>

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" >
                    <font color="#FF0000">*</font><strong>Duração do Recesso</strong><br />
                <input type="text" name="NB_DURACAO_RECESSO" id="NB_DURACAO_RECESSO" value="{$VO->NB_DURACAO_RECESSO}"  style="width:140px;" /></div>

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" >
                    <font color="#FF0000">*</font><strong>Fórmula</strong><br />
                <input type="text" name="TX_FORMULA_RECESSO" id="TX_FORMULA_RECESSO" value="{$VO->TX_FORMULA_RECESSO}"  style="width:300px;" /></div>

                <input type="button" name="inserir" id="inserir" value=" Inserir " />
            </fieldset>
        {/if}

        <div id="tabelaItemTBLRecesso"></div>

        <div id="dialog" title="Alterar Itens Tabela Recesso">
            <div id="tabelaAlterarItemTBLRecesso" style="text-align:left;"></div>
            <div class="fundoForm">
                <img src="{$urlimg}icones/loader3.gif" >
            </div>
        </div>

        <div id="botoesInferiores">
            <a href="{$url}src/{$pasta}/index.php"><img src="{$urlimg}icones/voltar.png" alt="Voltar" title="Voltar" class="voltar" /></a>
            <a href="{$url}src/{$pasta}/index.php"><img src="{$urlimg}icones/finalizar.png" alt="Finalizar" title="Finalizar" class="finalizar"/></a>
        </div>
    </div>
</div>