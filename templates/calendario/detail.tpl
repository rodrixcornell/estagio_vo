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
                        <td style="width:500px;"><font color="#0000FF" class="num_em"><strong>{$dados.TX_ORGAO_GESTOR_ESTAGIO[0]}</strong></font></td>
                        <td style="width:150px;"><strong>Data Cadastro</strong></td>
                        <td style="width:200px; text-align:right;">{$dados.DT_CADASTRO[0]}</div></td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Ano de Referência</strong></td>
                        <td>{$dados.NB_ANO_REFERENCIA[0]}</td>
                        <td><strong>Data Atualização</strong></td>
                        <td style="text-align:right;"><div id="atualizacao">{$dados.DT_ATUALIZACAO[0]}</div></td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td><strong>Mês de Referência</strong></td>
                        <td colspan="3">{$arrayMeses[$dados.NB_MES_REFERENCIA[0]]}</td>
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
                <legend>Cadastrar Item</legend>

                {$largura=150}
                <div id="camada" style="width:{$largura+20}px;">
                    <strong><font color="#FF0000">*</font>Grupo Pagamento</strong><br />
                    <select name="ID_GRUPO_PAGAMENTO" id="ID_GRUPO_PAGAMENTO" style="width:{$largura}px;">
                        {html_options options=$arrayGrupoPagamento selected=$VO->ID_GRUPO_PAGAMENTO}
                    </select></div>

                <div id="camada" style="width:{$largura+20}px;" >
                    <strong><font color="#FF0000">*</font>Data Fechamento</strong><br />
                    <input type="text" name="DT_FECHAMENTO" id="DT_FECHAMENTO" value="{$VO->DT_FECHAMENTO}" style="width:{$largura}px;" /></div>

                <div id="camada" style="width:{$largura+10}px;" >
                    <strong><font color="#FF0000">*</font>Data Encaminhamento do Documento</strong><br />
                    <input type="text" name="DT_ENCAM_DOC" id="DT_ENCAM_DOC" value="{$VO->DT_ENCAM_DOC}" style="width:{$largura}px;" /></div>

                <div id="camada" style="width:{$largura+10}px;" >
                    <strong><font color="#FF0000">*</font>Data Transferência Banco</strong><br />
                    <input type="text" name="DT_TRANSF_BANCO" id="DT_TRANSF_BANCO" value="{$VO->DT_TRANSF_BANCO}" style="width:{$largura}px;" /></div>

                <div id="camada" style="width:{$largura+10}px;" >
                    <strong><font color="#FF0000">*</font>Data Início Transferência</strong><br />
                    <input type="text" name="DT_INICIO_TRANSF_ESTAG" id="DT_INICIO_TRANSF_ESTAG" value="{$VO->DT_INICIO_TRANSF_ESTAG}" style="width:{$largura}px;" /></div>

                <div id="camada" style="width:{$largura+20}px;" >
                    <strong><font color="#FF0000">*</font>Data Fim Transferência</strong><br />
                    <input type="text" name="DT_FIM_TRANSF_ESTAG" id="DT_FIM_TRANSF_ESTAG" value="{$VO->DT_FIM_TRANSF_ESTAG}" style="width:{$largura}px;" /></div>

                <div id="camada" style="width:{$largura+10}px;" >
                    <strong><font color="#FF0000">*</font>Data Pagamento</strong><br />
                    <input type="text" name="DT_PAGAMENTO" id="DT_PAGAMENTO" value="{$VO->DT_PAGAMENTO}" style="width:{$largura}px;" /></div>

                    &nbsp;&nbsp;&nbsp;<input type="button" name="inserir" id="inserir" value=" Inserir " />
                {*<input type="button" name="efetivar" id="efetivar" value=" Efetivar Solicitação " style="margin-top:17px; float:right; padding:4px 8px; font-weight:bold;"/>*}
            </fieldset>
        {/if}

        <div id="tabelaItemCalendario"></div>

        <div id="dialog" title="Alterar Item">
            <div id="tabelaAlterarItemCalendario" style="text-align:left;"></div>
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