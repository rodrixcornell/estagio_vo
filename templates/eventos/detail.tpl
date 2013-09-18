<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />
	
    <div id="conteudo">

        <form name="form" action="{$url}src/{$pasta}/excluir.php" method="post" >
            <fieldset>
                <legend>Evento de Pagamento</legend>
                <table width="100%" class="dataGrid" >
                    <tr bgcolor="#E0E0E0">
                        <td style="width:150px;"><strong>Código</strong></td>
                        <td style="width:430px; text-align:left;"><font color="#0000FF"><strong>{$dados.TX_CODIGO[0]}</strong></font></td>
                        <td style="width:150px;"><strong>Descrição</strong></td>
                        <td style="text-align:right;"><font color="#0000FF"><strong>{$dados.TX_DESCRICAO[0]}</strong></font></td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td ><strong>Sigla</strong></td>
                        <td >{$dados.TX_SIGLA[0]}</td>
                        <td ><strong>Tipo</strong></td>
                        <td style="text-align:right;">{$dados.TX_TIPO[0]}</td>    
                    </tr>    
                    <tr bgcolor="#E0E0E0">
                    	<td style="text-align:left;"><strong>Situação</strong></td>
                        <td style="text-align:left;">{$dados.TX_SITUACAO[0]}</td>	
                        <td style="text-align:left;"><strong>Data de Realização</strong></td>
                        <td style="text-align:right;">{$dados.DT_CADASTRO[0]}</td>    
                    </tr>
                    <tr bgcolor="#F0EFEF">                                        
                        <td><strong>Data de Cadastro</strong></td>
                        <td>{$dados.DT_CADASTRO[0]}</td>
                        <td><strong>Data de Atualização</strong></td>
                        <td style="text-align:right;"><div id="atualizacao"> {$dados.DT_ATUALIZACAO[0]}</div></td>    
                    </tr>
                </table>

    {if $acesso}<div id="botoes">
                    <a href="{$url}src/{$pasta}/alterar.php"><img src="{$urlimg}icones/alterar.png"  alt="Alterar" title="Alterar" id="alterarMaster" /></a>
                    <a href="{$url}src/{$pasta}/excluir.php"><img src="{$urlimg}icones/excluir.png"  alt="Excluir" title="Excluir" id="excluirMaster" /></a>
                </div>{/if}
            </fieldset>
        </form>

        <div class="fundo_pag"><img src="{$urlimg}icones/loader.gif" alt=""></div>
        
    {if $acesso}
            <fieldset>
                <legend>Valores</legend>

                <fieldset>
            	    <legend>Cadastrar Valor</legend>
                    
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:130px;" ><font color="#FF0000">*</font><strong>Valor </strong>
                    <input type="text" name="NB_VALOR_BASE" id="NB_VALOR_BASE" value="{$VO->NB_VALOR_BASE}"  style="width:120px; text-align:center;" />
                </div>
                
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:140px;" ><font color="#FF0000">*</font><strong>Início de Vigência </strong>
                    <input type="text" name="DT_INICIO_VIGENCIA" id="DT_INICIO_VIGENCIA" value="{$VO->DT_INICIO_VIGENCIA}"  style="width:130px; text-align:center;" />
                </div>
                
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><font color="#FF0000">*</font><strong>Fim de Vigência </strong>
                    <input type="text" name="DT_FIM_VIGENCIA" id="DT_FIM_VIGENCIA" value="{$VO->DT_FIM_VIGENCIA}"  style="width:140px; text-align:center;" />
                </div>
                    
    
                    <input type="button" name="inserir" id="inserir" value=" Inserir " />
             </fieldset>
	 {/if}

     <div id="tabelaBase"></div>

 	    <div id="dialog" title="Alterar Valor">
            <div id="tabela_base" style="text-align:left;"></div>
            <div class="fundoForm">
                <img src="{$urlimg}icones/loader3.gif" >
            </div>
        </div>

     </fieldset>   
      
    <div id="botoesInferiores">
        <a href="{$url}src/{$pasta}/index.php"><img src="{$urlimg}icones/voltar.png" alt="Voltar" title="Voltar" class="voltar" /></a>
        <a href="{$url}src/{$pasta}/index.php"><img src="{$urlimg}icones/finalizar.png" alt="Finalizar" title="Finalizar" class="finalizar"/></a>
    </div>
   
   </div>
    
</div>