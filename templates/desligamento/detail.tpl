<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">

            <fieldset>
                
                <!-- Primeiro fieldset do detail-->
                <legend>Solicitação</legend>
                <table width="100%" class="dataGrid" >
                    <tr bgcolor="#E0E0E0">
                        <td style="width:150px;"><strong>Órgão Gestor</strong></td>
                        <td style="width:300px; text-align:left;"><font color="#0000FF"><strong>{$dados.TX_ORGAO_GESTOR_ESTAGIO[0]}</strong></font></td>
                        <td style="width:150px;"><strong>Órgão Solicitante</strong></td>
                        <td><font color="#0000FF"><strong>{$dados.TX_ORGAO_ESTAGIO[0]}</strong></font></td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td ><strong>Secretário Órg. Gestor</strong></td>
                        <td>{$dados.SECRETARIO[0]}</td>    
                        <td ><strong>Cód. Solicitação</strong></td>
                        <td >{$dados.TX_CODIGO[0]}</td>
                    </tr>    
                    <tr bgcolor="#E0E0E0">
                        <td ><strong>Cód. Contrato</strong></td>
                        <td >{$dados.TX_CODIGO_CONTRATO[0]}</td>
                        <td style="text-align:left;"><strong>Tipo de Vaga </strong></td>
                        <td style="text-align:left;">{$dados.TX_TIPO_VAGA_ESTAGIO[0]}</td>  
                    </tr>
                    <tr bgcolor="#F0EFEF">                                        
                        <td><strong>Nome do Estagiário </strong></td>
                        <td>{$dados.TX_NOME[0]}</td>
                        <td><strong>CPF do Estagiário </strong></td>
                        <td >{$dados.NB_CPF[0]}</td>    
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td><strong>Instituição de Ensino </strong></td>
                        <td>{$dados.TX_INSTITUICAO_ENSINO[0]}</td> 
                        <td><strong>Curso </strong></td>
                        <td>{$dados.TX_CURSO_ESTAGIO[0]}</td>    
                    </tr>
                    <tr bgcolor="#F0EFEF">                                        
                        <td><strong>Nível </strong></td>
                        <td>{$dados.TX_NIVEL[0]}</td>
                        <td><strong>Período/Ano </strong></td>
                        <td > {$dados.TX_PERIODO[0]}</td>    
                    </tr>
                     <tr bgcolor="#E0E0E0">
                        <td><strong>Agente de Integração </strong></td>
                        <td>{$dados.TX_AGENCIA_ESTAGIO[0]}</td>
                        <td><strong>TCE </strong></td>
                        <td>{$dados.TX_TCE[0]}</td>                             
                    </tr>
                    <tr bgcolor="#F0EFEF">             
                        <td><strong>Agente Setorial </strong></td>
                        <td>{$dados.TX_AGENTE_SETORIAL[0]}</td>   
                        <td><strong>Data de Solicitação </strong></td>
                        <td >{$dados.DT_SOLICITACAO[0]}</td>    
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td><strong>Data de Desligamento </strong></td>
                        <td>{$dados.DT_DESLIGAMENTO[0]}</td>   
                        <td><strong>Nº Ofício </strong></td>
                        <td >{$dados.TX_OFICIO[0]}</td>    
                    </tr>
                    <tr bgcolor="#F0EFEF">                                        
                        <td><strong>Situação </strong></td>
                        <td colspan="3"><div id="situacao">{$dados.TX_SITUACAO[0]}</div></td>    
                    </tr>    
                    <tr bgcolor="#E0E0E0">                                        
                        <td><strong>Cadastrado por </strong></td>
                        <td>{$dados.TX_FUNCIONARIO_CADASTRO[0]}</td>
                        <td><strong>Data do Cadastro </strong></td>
                        <td >{$dados.DT_CADASTRO[0]}</td>    
                    </tr>  
                    <tr bgcolor="#F0EFEF">                                        
                        <td><strong>Alterado por </strong></td>
                        <td><div id="func_atualizacao">{$dados.TX_FUNCIONARIO_ALTERACAO[0]}</div></td>
                        <td><strong>Data da Atualização </strong></td>
                        <td ><div id="atualizacao"> {$dados.DT_ATUALIZACAO[0]}</div></td>    
                    </tr>  
                </table>
				<div id="botoes">				
					{if $acesso}                    
							<form action="{$url}src/{$pasta}/detail.php" method="post" style="display:inline;">         
								<input type="submit" name="efetivar" id="efetivar" value=" Efetivar Seleção "/>
							</form>											
                    <a href="{$url}src/{$pasta}/alterar.php"><img src="{$urlimg}icones/alterar.png"  alt="Alterar" title="Alterar" id="alterarMaster" /></a>
                    <a href="{$url}src/{$pasta}/excluir.php"><img src="{$urlimg}icones/excluir.png"  alt="Excluir" title="Excluir" id="excluirMaster" /></a>					
					{/if}					
                </div>				

        <div id="tabelaBase"></div>

        </fieldset>   

        <div id="botoesInferiores">
            <a href="{$url}src/{$pasta}/index.php"><img src="{$urlimg}icones/voltar.png" alt="Voltar" title="Voltar" class="voltar" /></a>
        </div>

        </div>

    </div>