<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">

        <form name="form" action="{$url}src/{$pasta}/excluir.php" method="post" >
            <fieldset><!-- Fieldset do Master -->
                <legend>{$titulopage}</legend>
                <table width="100%" class="dataGrid">
                    <!-- LINHA (1) -->
                    <tr bgcolor="#E0E0E0">
                        <td style="width:210px;"><strong>Orgão Gestor</strong></td>
                        <td style="width:450px;"><font color="#0000FF" class="num_em"><strong>{$dados.TX_ORGAO_GESTOR_ESTAGIO[0]}</strong></font></td>
                        <td style="width:210px;"><strong>Contrato</strong></td>
                        <td style="width:200px; text-align:right;">{$dados.NB_CODIGO[0]}</td>
                    </tr>
                    <!-- LINHA (2) -->
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Agência de Estágio</strong></td>
                        <td>{$dados.TX_AGENCIA_ESTAGIO[0]}</td>
                        <td><strong>Código da Solicitação</strong></td>
                        <td style="text-align:right;">{$dados.TX_CODIGO[0]}</td>
                    </tr>
                    <!-- LINHA (3) -->
                    <tr bgcolor="#E0E0E0">
                        <td><strong>Unid. Org. Origem</strong></td>
                        <td>{$dados.TX_UNIDADE_ORG[0]}</td>
                        <td><strong>Unid. Org. Destino</strong></td>
                        <td style="text-align:right;">{$dados.TX_UNIDADE_ORG[0]}</td>
                    </tr>
                    <!-- LINHA (4) -->
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Assunto</strong></td>
                        <td>{$dados.TX_ASSUNTO[0]}</td>
                        <td><strong>Data da Solicitação</strong></td>
                        <td style="text-align:right;">{$dados.DT_SOLICITACAO[0]}</td>
                    </tr>
                    <!-- LINHA (5) -->
                    <tr bgcolor="#F0EFEF">
                        <td style="vertical-align:baseline; padding-top:4px;"><strong>Texto da Solicitação</strong></td>
                        <textarea name="TX_SOLICITACAO" id="TX_SOLICITACAO" style="width:450px; height:100px;" ></textarea>
                        <td colspan="3">{$dados.TX_SOLICITACAO[0]}</td>
                        <td><strong>Situação</strong></td>
                        <td style="text-align:right;">{$dados.CS_SITUACAO[0]}</td>
                    </tr>
                    <!-- LINHA (6) -->
                    <tr bgcolor="#E0E0E0">
                        <td><strong>Cadastrado por</strong></td>
                        <td>{$dados.TX_FUNCIONARIO_CAD[0]}</td>
                        <td><strong>Data do Cadastro</strong></td>
                        <td style="text-align:right;">{$dados.DT_CADASTRO[0]}</div></td>
                    </tr>
                    <!-- LINHA (7) -->
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Atualizado por</strong></td>
                        <td><div id="funcionario">{$dados.TX_FUNCIONARIO_ATUAL[0]}</div></td>
                        <td><strong>Data de Atualização</strong></td>
                        <td style="text-align:right;"><div id="atualizacao">{$dados.DT_ATUALIZACAO[0]}</div>
                        <input type="hidden" name="ID_SOLICITACAO_TA_CP" id="ID_SOLICITACAO_TA_CP" value="{$dados.ID_SOLICITACAO_TA_CP[0]}" />
                        <input type="hidden" name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" value="{$dados.ID_ORGAO_GESTOR_ESTAGIO[0]}" />
                        </td>
                    </tr>
                </table>

                {if $acesso}
                    <div id="botoes">
                         
                        <a href="{$url}src/{$pasta}/alterar.php"><img src="{$urlimg}icones/alterar.png"  alt="Alterar" title="Alterar" id="alterarMaster" /></a>
                        {if !$acessoEfetivado}<a href="{$url}src/{$pasta}/excluir.php"><img src="{$urlimg}icones/excluir.png"  alt="Excluir" title="Excluir" id="excluirMaster" /></a>{/if}
                    </div>
                {/if}
            </fieldset><!-- Fim do Fieldset -->
        </form>

        <div class="fundo_pag"><img src="{$urlimg}icones/loader.gif" alt=""></div>
 
        {if $acesso}
           {if !$acessoEfetivado}
          <fieldset><!-- 1 fieldset do detail -->
              <legend>Vagas Solicitadas</legend>
              
            <fieldset><!-- 2 fieldset do detail -->
                <legend>Cadastrar Quantidade de Vagas</legend>
                <!-- TIPO DE VAGA -->
                <div id="camada" style="width:160px;">
                    <strong><font color="#FF0000">*</font>Tipo de Vaga</strong><br />
                    <select name="CS_TIPO_VAGA_ESTAGIO" id="CS_TIPO_VAGA_ESTAGIO" style="width:150px;">
                        {html_options options=$arrayTipoVaga selected=$VO->CS_TIPO_VAGA_ESTAGIO}
                    </select></div>
                <!-- QUANTIDADE -->
                <div id="camada" style="width:90px;" >
                    <strong><font color="#FF0000">*</font>Quantidade</strong><br />
                    <input type="text" name="NB_QUANTIDADE" id="NB_QUANTIDADE" value="{$VO->NB_QUANTIDADE}" style="width:80px;" /></div>
                <!-- TAXA ADMINISTRATIVA -->
                <div id="camada" style="width:90px;" >
                    <strong><font color="#FF0000">*</font>Taxa Adm.</strong><br />
                    <input type="text" name="NB_TAXA_ADMINISTRATIVA" id="NB_TAXA_ADMINISTRATIVA" value="{$VO->NB_TAXA_ADMINISTRATIVA}" style="width:80px;" /></div>
                 <!-- AUXILIO TRANSPORTE -->
                 <div id="camada" style="width:90px;" >
                    <strong><font color="#FF0000">*</font>Aux. Transporte</strong><br />
                    <input type="text" name="NB_AUXILIO_TRANSPORTE" id="NB_AUXILIO_TRANSPORTE" value="{$VO->NB_AUXILIO_TRANSPORTE}" style="width:80px;" /></div>
                 <!-- BOLSA AUXILIO -->
                 <div id="camada" style="width:90px;" >
                    <strong><font color="#FF0000">*</font>Bolsa Auxílio</strong><br />
                    <input type="text" name="NB_BOLSA_AUXILIO" id="NB_BOLSA_AUXILIO" value="{$VO->NB_BOLSA_AUXILIO}" style="width:80px;" /></div>
               
                    <input type="button" name="inserir" id="inserir" value=" Inserir " />
                
                <form action="{$url}src/{$pasta}/detail.php" method="post" style="display:inline;">			
                <input type="submit" name="efetivar" id="efetivar" value=" Efetivar Solicitação " style="margin-top:17px; float:right; padding:4px 8px; font-weight:bold;"/>
                </form>
            </fieldset><!-- Fim do 1 fieldset do detail-->
           {/if}
        {/if}

        <div id="tabelaVagasSolicitadas"></div>
        <div id="dialog" title="Alterar Vagas de Estátgio">
            <div id="tabelaAlterarVagasSolicitadas" style="text-align:left;"></div>
            <div class="fundoForm">
                <img src="{$urlimg}icones/loader3.gif" >
            </div>
        </div>
            </fieldset><!-- Fim do 2 fieldset do detail-->

        <div id="botoesInferiores">
            <a href="{$url}src/{$pasta}/index.php"><img src="{$urlimg}icones/voltar.png" alt="Voltar" title="Voltar" class="voltar" /></a>
            <a href="{$url}src/{$pasta}/index.php"><img src="{$urlimg}icones/finalizar.png" alt="Finalizar" title="Finalizar" class="finalizar"/></a>
        </div>
    </div>
</div>