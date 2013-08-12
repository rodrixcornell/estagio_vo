<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">

        <form name="form" action="{$url}src/{$pasta}/excluir.php" method="post" >
            <fieldset>
                <legend>Quadro de Vagas</legend>
                <table width="100%" class="dataGrid" >
                    <tr>
                        <td style="width:150px;"><strong>Código</strong></td>
                        <td><font color="#0000FF"><strong>{$dados.TX_CODIGO[0]}</strong></font></td>
                        </tr>
                        <tr bgcolor="#F0EFEF">
                        <td style="width:140px;"><strong>Órgão Gestor</strong></td>
                        <td style="width:250px; text-align:left;">{$dados.TX_ORGAO_GESTOR_ESTAGIO[0]}</td>
                        <td><strong>Agencia de Estágio</strong></td>
                        <td style="text-align:left;">{$dados.TX_AGENCIA_ESTAGIO[0]}</td> 
                        </tr>

                       <tr bgcolor="#E0E0E0">
                        <td><strong>Situação</strong></td>
                        <td style="text-align:left;">{$dados.TX_SITUACAO[0]}</td>
                        <td><strong>Contrato</strong></td>
                        <td style="text-align:left;">{$dados.NB_CODIGO[0]}</td>
                        </tr>

                    <tr bgcolor="#F0EFEF">
                        <td><strong>Cadastrado por </strong></td>
                        <td>{$dados.TX_FUNCIONARIO_CADASTRO[0]}</td>
                        <td><strong>Data de Cadastro</strong></td>
                        <td style="text-align:left;">{$dados.DT_CADASTRO[0]}</td>
                    </tr>

                    <tr bgcolor="#E0E0E0">
                        <td><strong>Alterado por</strong></td>
                        <td><div id="funcionario">{$dados.TX_FUNCIONARIO_ATUALIZACAO[0]}</div></td>
                        <td><strong>Data de Atualização</strong></td>
                        <td style="text-align:left;"><div id="atualizacao">{$dados.DT_ATUALIZACAO[0]}</div></td>
                    </tr>
                </table>


                {if $acesso}<div id="botoes">
                        <a href="{$url}src/{$pasta}/alterar.php"><img src="{$urlimg}icones/alterar.png"  alt="Alterar" title="Alterar" id="alterarMaster" /></a>
                        <a href="{$url}src/{$pasta}/excluir.php"><img src="{$urlimg}icones/excluir.png"  alt="Excluir" title="Excluir" id="excluirMaster" /></a>
                    </div>{/if}
                </fieldset>
            </form>

            <div class="fundo_pag"><img src="{$urlimg}icones/loader.gif" alt=""></div>

            {if $acesso}<fieldset>
                    <legend>Vagas</legend>

                    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;">
                        <font color="#FF0000">*</font>Órgão Solicitante <font color="#FF0000">{$validar.ID_ORGAO_ESTAGIO}</font><br />
                        <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO" style="width:300px;">
                            {html_options options=$orgao_Solicitante selected=$VO->ID_ORGAO_ESTAGIO}
                        </select></div>


                    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:130px;">
                        <font color="#FF0000">*</font>Tipo <font color="#FF0000">{$validar.CS_TIPO_VAGA_ESTAGIO}</font><br />
                        <select name="CS_TIPO_VAGA_ESTAGIO" id="CS_TIPO_VAGA_ESTAGIO" style="width:120px;">
                            {html_options options=$pesquisarTipo selected=$VO->CS_TIPO_VAGA_ESTAGIO}
                        </select></div>

                    <div id="camada" style="width:110px;"><font color="#FF0000">*</font>Quantidade:<font color="#FF0000"> {$validar.NB_QUANTIDADE} </font><br />     
                        <input type="text" name="NB_QUANTIDADE" id="NB_QUANTIDADE" value="{$VO->NB_QUANTIDADE}" style="width:100px; text-align:center;"  />
                    </div>


                    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;">
                        <font color="#FF0000">*</font>Curso <font color="#FF0000">{$validar.ID_CURSO_ESTAGIO}</font><br />
                        <select name="ID_CURSO_ESTAGIO" id="ID_CURSO_ESTAGIO" style="width:300px;">
                            {html_options options=$pesquisaCursos selected=$VO->ID_CURSO_ESTAGIO}
                        </select></div>

                    <input type="button" name="inserir" id="inserir" value=" Inserir " style="margin-top:10px;"/>
                </fieldset>{/if}

                <div id="tabelaUnidade"></div>

                <div id="dialog" title="Alterar Vagas de Estágio">
                    <div id="alterar_vaga" style="text-align:left;"></div>
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