<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">

        <form name="form" action="{$url}src/{$pasta}/excluir.php" method="post" >
            <fieldset>
                
                <!-- Primeiro fieldset do detail-->
                <legend>Unidade Concedente</legend>
                <table width="100%" class="dataGrid" >
                    <tr bgcolor="#E0E0E0">
                        <td style="width:150px;"><strong>Órgão Gestor</strong></td>
                        <td style="width:430px; text-align:left;"><font color="#0000FF"><strong>{$dados}</strong></font></td>
                        <td style="width:150px;"><strong>Órgão Solicitante</strong></td>
                        <td style="text-align:right;"><font color="#0000FF"><strong>{$dados}</strong></font></td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td ><strong>Endereço Órgão Gestor</strong></td>
                        <td >{$dados}</td>
                        <td ><strong>Secretário Órg. Gestor</strong></td>
                        <td style="text-align:right;">{$dados}</td>    
                    </tr>    
                    <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Quadro de Vagas</strong></td>
                        <td style="text-align:left;">{$dados}</td>	
                        <td style="text-align:left;"><strong>Tipo de Vaga</strong></td>
                        <td style="text-align:right;">{$dados}</td>    
                    </tr>
                    <tr bgcolor="#F0EFEF">                                        
                        <td><strong>Código da Seleção</strong></td>
                        <td>{$dados}</td>
                        <td><strong>Tipo de Contrato</strong></td>
                        <td style="text-align:right;"><div id="atualizacao"> {$dados}</div></td>    
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Código do Contrato</strong></td>
                        <td style="text-align:left;">{$dados}</td>	
                        <td style="text-align:left;"></td>
                        <td style="text-align:right;"></td>    
                    </tr>
                    <tr bgcolor="#F0EFEF">                                        
                        <td><strong>Cadastrado por</strong></td>
                        <td>{$dados}</td>
                        <td><strong>Data de Cadastro</strong></td>
                        <td style="text-align:right;"><div id="atualizacao"> {$dados}</div></td>    
                    </tr>
                     <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Alterado por</strong></td>
                        <td style="text-align:left;">{$dados}</td>	
                        <td style="text-align:left;"><strong>Data de Atualização</strong></td>
                        <td style="text-align:right;">{$dados}</td>    
                    </tr>
            
                </table>

                <!-- fim Primeiro fieldset do detail-->

            </fieldset>
            <fieldset>
                
                <!-- segundo fieldset do detail-->
                
                <legend>Estágiario</legend>
                <table width="100%" class="dataGrid" >
                    <tr bgcolor="#E0E0E0">
                        <td style="width:150px;"><strong>Candidato</strong></td>
                        <td style="width:430px; text-align:left;"><font color="#0000FF"><strong>{$dados}</strong></font></td>
                        <td style="width:150px;"><strong>Código</strong></td>
                        <td style="text-align:right;"><font color="#0000FF"><strong>{$dados}</strong></font></td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td ><strong>CPF</strong></td>
                        <td >{$dados}</td>
                        <td ><strong>RG</strong></td>
                        <td style="text-align:right;">{$dados}</td>    
                    </tr>    
                    <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Telefone</strong></td>
                        <td style="text-align:left;">{$dados}</td>	
                        <td style="text-align:left;"><strong>Email</strong></td>
                        <td style="text-align:right;">{$dados}</td>    
                    </tr>
                    <tr bgcolor="#F0EFEF">                                        
                        <td><strong>Endereço do Estagiário</strong></td>
                        <td>{$dados}</td>
                        <td><strong>Data Inicio Vigência</strong></td>
                        <td style="text-align:right;"><div id="atualizacao"> {$dados}</div></td>    
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Instituição de Ensino</strong></td>
                        <td style="text-align:left;">{$dados}</td>	
                        <td style="text-align:left;"><strong>Dara Fim Vigência </strong></td>
                        <td style="text-align:right;">{$dados}</td>    
                    </tr>
                    <tr bgcolor="#F0EFEF">                                        
                        <td><strong>Curso</strong></td>
                        <td>{$dados}</td>
                        <td><strong>Inicio Horário do Estagio</strong></td>
                        <td style="text-align:right;"><div id="atualizacao"> {$dados}</div></td>    
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Período</strong></td>
                        <td style="text-align:left;">{$dados}</td>	
                        <td style="text-align:left;"><strong>Fim Horário do Estágio</strong></td>
                        <td style="text-align:right;">{$dados}</td>    
                    </tr>
                    <tr bgcolor="#F0EFEF">                                        
                        <td><strong>Horário do Curso</strong></td>
                        <td>{$dados}</td>
                        <td><strong>Agente de Integração</strong></td>
                        <td style="text-align:right;"><div id="atualizacao"> {$dados}</div></td>    
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Supervisor</strong></td>
                        <td style="text-align:left;">{$dados}</td>	
                        <td style="text-align:left;"><strong>Cargo/Função</strong></td>
                        <td style="text-align:right;">{$dados}</td>    
                    </tr>
                    <tr bgcolor="#F0EFEF">                                        
                        <td><strong>Lotação</strong></td>
                        <td>{$dados}</td>
                        <td><strong>TCE</strong></td>
                        <td style="text-align:right;"><div id="atualizacao"> {$dados}</div></td>    
                    </tr>
                      <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Plano de Atividade</strong></td>
                        <td style="text-align:left;">{$dados}</td>	
                        <td style="text-align:left;"><strong>Data de Desligamento</strong></td>
                        <td style="text-align:right;">{$dados}</td>    
                    </tr>
                </table>

                <!-- fim segundo fieldset do detail-->

            </fieldset>
        </form>





        <div id="tabelaBase"></div>



        </fieldset>   

        <div id="botoesInferiores">
            <a href="{$url}src/{$pasta}/index.php"><img src="{$urlimg}icones/voltar.png" alt="Voltar" title="Voltar" class="voltar" /></a>
            {if $acesso}<div id="botoes">
                    <a href="{$url}src/{$pasta}/alterar.php"><img src="{$urlimg}icones/alterar.png"  alt="Alterar" title="Alterar" id="alterarMaster" /></a>
                    <a href="{$url}src/{$pasta}/excluir.php"><img src="{$urlimg}icones/excluir.png"  alt="Excluir" title="Excluir" id="excluirMaster" /></a>
                </div>{/if}
            </div>

        </div>

    </div>