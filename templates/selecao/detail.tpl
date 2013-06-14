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
                        <td style="width:350px;">{$dados.TX_ORGAO_GESTOR_ESTAGIO[0]}</td>
                        <td style="width:130px;"><strong>Órgão Solicitante</strong></td>
                        <td style="text-align:left;">{$dados.TX_ORGAO_ESTAGIO[0]}</td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Cód. do Recrutamento</strong></td>
                        <td>{$dados.TX_COD_RECRUTAMENTO[0]}</td>
                        <td><strong>Cód. da Seleção</strong></td>
                        <td>{$dados.TX_COD_SELECAO[0]}</td>
                        
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td><strong>Situação</strong></td>
                        <td colspan="4"><div id="situacao">{$dados.TX_SITUACAO[0]}</div></td>                                                          
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Data de Agendamento</strong></td>
                        <td>{$dados.DT_AGENDAMENTO[0]}</td>
                        <td><strong>Data de Realização</strong></td>
                        <td>{$dados.DT_REALIZACAO[0]}</td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td><strong>Cadastrado por</strong></td>
                        <td>{$dados.TX_FUNCIONARIO_CAD[0]}</td>
                        <td><strong>Data de Cadastro</strong></td>
                        <td>{$dados.DT_CADASTRO[0]}</td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Alterado por</strong></td>
                        <td><div id="funcionario">{$dados.TX_FUNCIONARIO_ALT[0]}</div></td>
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
        
            <fieldset>
                <legend>Candidatos</legend>

                {if $acesso && $dados.CS_SITUACAO[0] != 2}

                 <div id="msg" align="center"> 
                     <font color="#FF0000">{$dados.MENSSAGEM}</font>  
                 </div>                    
                 
                <fieldset>
            	   <legend>Cadastrar Candidato</legend>
    
                    <div id="camada" style="width:300px;"><font color="#FF0000">*</font>Candidato
                        <select name="ESTAGIARIO_SELECAO" id="ESTAGIARIO_SELECAO" style="width:300px;">
                            {html_options options=$arrayCandidato selected=$VO->TX_NOME}
                        </select>
                    </div>
                            
                    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:135px;" ><font color="#FF0000">*</font>Data de Agendamento <br />
                      <input type="text" name="DT_AGENDAMENTO" id="DT_AGENDAMENTO" value="{$VO->DT_AGENDAMENTO}"  style="width:130px;" /></div> 
        
                    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:135px;" ><font color="#FF0000">*</font>Data de Realização <br />
                      <input type="text" name="DT_REALIZACAO" id="DT_REALIZACAO" value="{$VO->DT_REALIZACAO}"  style="width:130px;" /></div> 

                    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" ><font color="#FF0000">*</font>Situação
                        <select name="CS_SITUACAO" id="CS_SITUACAO" style="width:150px;">
                         {html_options options=$arraySituacaoCandidato selected=$VO->CS_SITUACAO}
                    </select></div>
                    <br />
                    
                    <div id="camada" name="motivo" style="font-family:Verdana, Geneva, sans-serif; width:670px;{if !$VO->CS_SITUACAO} display: none;{/if}" ><font color="#FF0000">*</font>Motivo <br />
                      <input type="text" name="TX_MOTIVO_SITUACAO" id="TX_MOTIVO_SITUACAO" value="{$VO->TX_MOTIVO_SITUACAO}"  style="width:665px;" />                       
                    </div> 

                    <input type="button" name="inserir" id="inserir" value=" Inserir " />
                    
                    <form action="{$url}src/{$pasta}/detail.php" method="post" style="display:inline;">         
                        <input type="submit" name="efetivar" id="efetivar" value=" Efetivar Seleção " />
                    </form>
                               
               </fieldset>{/if}              
		          
                <div id="tabelaCandidato"></div>
                <div id="dialog-form" title="Alterar Candidatos">
                    
                    <div id="form_candidatos" style="text-align:left;"></div>
                    
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