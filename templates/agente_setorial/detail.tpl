<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />
	
    <div id="conteudo">

        <form name="form" action="{$url}src/{$pasta}/excluir.php" method="post" >
            <fieldset>
                <legend>Funcionário</legend>
                <table width="100%" class="dataGrid" >
                    <tr bgcolor="#E0E0E0">
                        <td style="width:125px;"><strong>Usuário</strong></td>
                        <td style="width:500px;">{$dados.TX_LOGIN[0]}</td>
                        <td><strong>Data de Cadastro</strong></td>
                        <td style="text-align:right;">{$dados.DT_CADASTRO[0]}</td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Funcionário</strong></td>
                        <td>{$dados.TX_FUNCIONARIO[0]}</td>
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
        	<legend>Unidades</legend>

            <div id="camada" style="width:510px;"><strong><font color="#FF0000">*</font>Unidade Solicitante</strong>
                <select name="ID_UNIDADE_IRP" id="ID_UNIDADE_IRP" style="width:500px;">
                    {html_options options=$arrayUnidadeDetail selected=$VO->ID_UNIDADE_IRP}
                </select></div>

            <input type="button" name="inserir" id="inserir" value=" Inserir " />
		</fieldset>{/if}

        <div id="tabelaUnidade"></div>
 	
        
        <div id="botoesInferiores">
            <a href="{$url}src/{$pasta}/index.php"><img src="{$urlimg}icones/voltar.png" alt="Voltar" title="Voltar" class="voltar" /></a>
            <a href="{$url}src/{$pasta}/index.php"><img src="{$urlimg}icones/finalizar.png" alt="Finalizar" title="Finalizar" class="finalizar"/></a>
        </div>
    </div>
</div>