<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">

        <form name="form" action="{$url}src/{$pasta}/excluir.php" method="post" >
            <fieldset>
                <legend>Seleção de Estagiário</legend>
                <table width="100%" class="dataGrid" >
                    <tr bgcolor="#E0E0E0">
                        <td style="width:150px;"><strong>Órgão Gestor</strong></td>
                        <td style="width:420px;">{$dados.TX_ORGAO_GESTOR_ESTAGIO[0]}</td>
                        <td><strong>Cód. da Seleção</strong></td>
                        <td><font color="#0000FF"><strong>{$dados.TX_COD_SELECAO[0]}</strong></font></td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Órgão Solicitante</strong></td>
                        <td style="text-align:left;">{$dados.TX_ORGAO_ESTAGIO[0]}</td>
                        <td><strong>Cód. da Oferta de Vaga</strong></td>
                        <td>{$dados.TX_CODIGO_OFERTA_VAGA[0]}</td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td><strong>Tipo Seleção</strong></td>
                        <td>{$dados.TX_SELECAO[0]}</td>
                        <td><strong>Situação</strong></td>
                        <td><div>{$dados.TX_SITUACAO[0]}</div></td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td colspan="2"></td>
                        <td><strong>N° Total de Vagas</strong></td>
                        <td>{$dados.NB_QUANTIDADE[0]}</td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td><strong>Cadastrado por</strong></td>
                        <td>{$dados.TX_FUNCIONARIO_CADASTRO[0]}</td>
                        <td><strong>Data de Cadastro</strong></td>
                        <td>{$dados.DT_CADASTRO[0]}</td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Alterado por</strong></td>
                        <td><div id="funcionario">{$dados.TX_FUNCIONARIO_ATUALIZACAO[0]}</div></td>
                        <td><strong>Data de Atualização</strong></td>
                        <td><div id="atualizacao">{$dados.DT_ATUALIZACAO[0]}</div></td>
                    </tr>

                </table>

                {if $acesso}<div id="botoes">
                        <a href="{$url}src/{$pasta}/alterar.php"><img src="{$urlimg}icones/alterar.png"  alt="Alterar" title="Alterar" id="alterarMaster" /></a>
                        <a href="{$url}src/{$pasta}/excluir.php"><img src="{$urlimg}icones/excluir.png"  alt="Excluir" title="Excluir" id="excluirMaster" /></a>
                    </div>{/if}
                </fieldset>
            </form>

            <div class="fundo_pag"><img src="{$urlimg}icones/loader.gif" alt=""></div>


            {if $acesso && $dados.CS_SITUACAO[0] != 2}
            	<input type="button" name="inserir" id="inserir" value=" Adicionar Candidato " style="float:right;"/>
            	<div id="dialog-form-candidato" title="Adicionar Candidato">

                    <div id="form_candidato" style="text-align:left;"></div>

                    <div class="fundoForm">
                        <img src="{$urlimg}icones/loader3.gif" >
                    </div>

                </div>
        	{/if}

                <div id="tabelaCandidato" style="margin-top: 40px;"></div>
                {*<div id="dialog-form" title="Alterar Candidato">

                    <div id="form_candidatos" style="text-align:left;"></div>

                    <div class="fundoForm">
                        <img src="{$urlimg}icones/loader3.gif" >
                    </div>

                </div>*}

                <div id="botoesInferiores">
                    <a href="{$url}src/{$pasta}/index.php"><img src="{$urlimg}icones/voltar.png" alt="Voltar" title="Voltar" class="voltar" /></a>
                    <a href="{$url}src/{$pasta}/index.php"><img src="{$urlimg}icones/finalizar.png" alt="Finalizar" title="Finalizar" class="finalizar"/></a>
                </div>

            </div>
        </div>
        {$erro}