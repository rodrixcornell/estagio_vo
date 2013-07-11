<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />
	
    <div id="conteudo">

        <form name="form" action="{$url}src/{$pasta}/excluir.php" method="post" >
            <fieldset>
                <legend>Recrutamento de Estagiário</legend>
                <table width="100%" class="dataGrid" >
                    <tr bgcolor="#E0E0E0">
                        <td style="width:125px;"><strong>Órgão Gestor</strong></td>
                        <td style="width:350px;">{$dados.TX_ORGAO_GESTOR_ESTAGIO[0]}</td>
                        <td style="width:150px;"><strong>Órgão Solicitante</strong></td>
                        <td style="width:100px; text-align:right;">{$dados.TX_ORGAO_ESTAGIO[0]}</td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Quadro de Vagas</strong></td>
                        <td>{$dados.TX_CODIGO[0]}</td>
                        <td><strong>Cód. de Recrutamento</strong></td>
                        <td style="text-align:right;"><font color="#0000FF"><strong>{$dados.TX_COD_RECRUTAMENTO[0]}</strong></font></td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td><strong>Motivo/Justificativa</strong></td>
                        <td>{$dados.TX_MOTIVO[0]}</td>
                        <td><strong>Cód. da Solicitação </strong></td>
                        <td style="text-align:right;">{$dados.TX_COD_SOLICITACAO[0]}</td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Doc. Autorização</strong></td>
                        <td>{$dados.TX_DOC_AUTORIZACAO[0]}</td>
                        <td><strong>Situação</strong></td>
                        <td style="width:100px; text-align:right;">{$dados.TX_SITUACAO[0]}</td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td><strong>Cadastrado por</strong></td>
                        <td>{$dados.TX_FUNCIONARIO_CADASTRO[0]}</td>
                        <td><strong>Data de Cadastro</strong></td>
                        <td style="text-align:right;">{$dados.DT_CADASTRO[0]}</td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Alterado por</strong></td>
                        <td><div id="funcionario">{$dados.TX_FUNCIONARIO_ATUALIZACAO[0]}</div></td>
                        <td><strong>Data de Atualização</strong></td>
                        <td style="text-align:right;"><div id="atualizacao">{$dados.DT_ATUALIZACAO[0]}</div></td>
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
        	<legend>Cadastrar Vagas de Estágio</legend>
        	<div id="camada" style="width:210px;"><strong><font color="#FF0000">*</font>Tipo de Vaga</strong> <br />
              <select name="CS_TIPO_VAGA_ESTAGIO" id="CS_TIPO_VAGA_ESTAGIO" style="width:200px;">
                    {html_options options=$arrayTipoVagaEstagioDetail selected=$VO->CS_TIPO_VAGA_ESTAGIO}
            </select> </div>
            
           <div id="camada" style="width:110px;"><strong><font color="#FF0000">*</font>Quantidade</strong>
				<input type="text" name="NB_QUANTIDADE" id="NB_QUANTIDADE" value="{$VO->NB_QUANTIDADE}" style="width:100px; text-align:center;" /> </div>
                
           <div id="camada" style="width:110px;"><strong>Qtde Solicitada</strong>
				<input type="text" name="NB_QUANTIDADE_SOLIC" id="NB_QUANTIDADE_SOLIC" value="{$VO->NB_QUANTIDADE_SOLIC}" style="width:100px; text-align:center;" class="leitura" readonly="readonly" /> </div>

			<input type="button" name="inserir" id="inserir" value=" Inserir "  />

			<form action="{$url}src/{$pasta}/detail.php" method="post" style="display:inline;">			
           	 <input type="submit" name="efetivar" id="inserir" value=" Efetivar Recrutamento " {if $dados.CS_SITUACAO[0] == 2}disabled="disabled"{/if} style="float:right;margin-top:15px;"; />
			</form>
            
            


		</fieldset>{/if}

        <div id="tabelaVagas"></div>
 	
        
        <div id="dialog-tabela" title="Candidatos do Recrutamento">
        	<div class="fundoForm"><img src="{$urlimg}icones/loader3.gif" ></div>
            <div id="tabelaCand"></div>
        </div>

	        
        <div id="botoesInferiores">
            <a href="{$url}src/{$pasta}/index.php"><img src="{$urlimg}icones/voltar.png" alt="Voltar" title="Voltar" class="voltar" /></a>
            <a href="{$url}src/{$pasta}/index.php"><img src="{$urlimg}icones/finalizar.png" alt="Finalizar" title="Finalizar" class="finalizar"/></a>
        </div>
        
         
                
    </div>
</div>