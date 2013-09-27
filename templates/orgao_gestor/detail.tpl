<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />
	
    <div id="conteudo">

        <form name="form" action="{$url}src/{$pasta}/excluir.php" method="post" >
            <fieldset>
                <legend>Unidade</legend>
                <table width="100%" class="dataGrid" >
                    <tr bgcolor="#E0E0E0">
                        <td style="width:166px;"><strong>Órgão Gestor de Estágio </strong></td>
                        <td style="font-weight:bold; color:#00F;">{$dados.TX_ORGAO_GESTOR_ESTAGIO[0]}</td>
                        <td style="width:133px;"><strong>Data de Cadastro</strong></td>
                        <td style="width:130px; text-align:right;">{$dados.DT_CADASTRO[0]}</td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
	                    <td><strong>Unidade Organizacional</strong></td>
                        <td>{$dados.TX_UNIDADE_ORG[0]}</td>	
                        <td><strong>Data de Atualização</strong></td>
                        <td style="text-align:right;"><div id="atualizacao">{$dados.DT_ATUALIZACAO[0]}</div></td>												
					</tr>	
                    <tr bgcolor="#E0E0E0">
	                    <td><strong>CNPJ</strong></td>
                        <td colspan="3">{$dados.TX_CNPJ[0]}</td>
					</tr>
                </table>
{if $acesso}
<div id="botoes">
    <a href="{$url}src/{$pasta}/alterar.php"><img src="{$urlimg}icones/alterar.png"  alt="Alterar" title="Alterar" id="alterarMaster" /></a>
    <a href="{$url}src/{$pasta}/excluir.php"><img src="{$urlimg}icones/excluir.png"  alt="Excluir" title="Excluir" id="excluirMaster" /></a>
</div>{/if}
            </fieldset>
        </form>

        <div class="fundo_pag"><img src="{$urlimg}icones/loader.gif" alt=""></div>
        
{if $acesso}<fieldset>
        	<legend>Cadastrar E-mail</legend>

            <div id="camada" style="width:510px;"><strong><font color="#FF0000">*</font>E-mail</strong>
            	<input type="text" name="TX_EMAIL" id="TX_EMAIL" style="width:500px;" value=""/>
            </div> 
				
            <input type="button" name="inserir" id="inserir" value=" Inserir " />
            </fieldset>{/if}

        <div id="tabelaEmail"></div>

		<div id="botoesInferiores">
            <a href="{$url}src/{$pasta}/index.php"><img src="{$urlimg}icones/voltar.png" alt="Voltar" title="Voltar" class="voltar" /></a>
            <a href="{$url}src/{$pasta}/index.php"><img src="{$urlimg}icones/finalizar.png" alt="Finalizar" title="Finalizar" class="finalizar"/></a>
        </div>
    </div>
</div>