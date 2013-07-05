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
                        <td style="width:210px;"><strong>Cód. Transferência</strong></td>
                        <td style="width:450px;"><font color="#0000FF" class="num_em"><strong>{$dados.TX_COD_TRANSFERENCIA[0]}</strong></font></td>
                        <td style="width:210px;"><strong>Quadro de Vagas de Estágio</strong></td>
                        <td style="width:200px; text-align:right;">{$dados.TX_CODIGO[0]}</td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Órgão Gestor</strong></td>
                        <td>{$dados.TX_ORGAO_GESTOR_ESTAGIO[0]}</td>
                        <td><strong>Órgão Solicitante</strong></td>
                        <td style="text-align:right;">{$dados.TX_SOLICITANTE[0]}</td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td><strong>Órgão Cedente </strong></td>
                        <td>{$dados.TX_ORGAO_ESTAGIO[0]}</td>
                        <td><strong>Situação</strong></td>
                        <td style="text-align:right;">{$arraySituacao[$dados.CS_SITUACAO[0]]}</td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td style="vertical-align:baseline; padding-top:4px;"><strong>Motivo / Justificativa</strong></td>
                        <td colspan="3">{$dados.TX_MOTIVO[0]}</td>
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
                        <td style="text-align:right;"><div id="atualizacao">{$dados.DT_ATUALIZACAO[0]}</div>
                        <input type="hidden" name="ID_QUADRO_VAGAS_ESTAGIO" id="ID_QUADRO_VAGAS_ESTAGIO" value="{$dados.ID_QUADRO_VAGAS_ESTAGIO[0]}" />
                        <input type="hidden" name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO" value="{$dados.ID_ORGAO_ESTAGIO[0]}" />
                        </td>
                    </tr>
                </table>

                {if $acesso}
                    <div id="botoes">
                        <a href="{$url}src/{$pasta}/alterar.php"><img src="{$urlimg}icones/alterar.png"  alt="Alterar" title="Alterar" id="alterarMaster" /></a>
                        {if !$acessoEfetivado}<a href="{$url}src/{$pasta}/excluir.php"><img src="{$urlimg}icones/excluir.png"  alt="Excluir" title="Excluir" id="excluirMaster" /></a>{/if}
                    </div>
                {/if}
            </fieldset>
        </form>

        <div class="fundo_pag"><img src="{$urlimg}icones/loader.gif" alt=""></div>

        {if $acesso}
           {if !$acessoEfetivado}
            <fieldset>
                <legend>Cadastrar Vagas de Estágio</legend>

                <div id="camada" style="width:160px;">
                    <strong><font color="#FF0000">*</font>Tipo </strong><br />
                    <select name="CS_TIPO_VAGA_ESTAGIO" id="CS_TIPO_VAGA_ESTAGIO" style="width:150px;">
                        {html_options options=$arrayTipoVaga selected=$VO->CS_TIPO_VAGA_ESTAGIO}
                    </select></div>

                <div id="camada" style="width:90px;" >
                    <strong><font color="#FF0000">*</font>Quantidade</strong><br />
                    <input type="text" name="NB_QUANTIDADE" id="NB_QUANTIDADE" value="{$VO->NB_QUANTIDADE}" style="width:80px;" /></div>

             
                <input type="button" name="inserir" id="inserir" value=" Inserir " />
                
                <form action="{$url}src/{$pasta}/detail.php" method="post" style="display:inline;">			
                	<input type="submit" name="efetivar" id="efetivar" value=" Efetivar Solicitação " style="margin-top:17px; float:right; padding:4px 8px; font-weight:bold;"/>
                </form>
                
            </fieldset>
           {/if}
        {/if}

        <div id="tabelaVagasSolicitadas"></div>

        <div id="dialog" title="Alterar Vagas de Estátgio">
            <div id="tabelaAlterarVagasSolicitadas" style="text-align:left;"></div>
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