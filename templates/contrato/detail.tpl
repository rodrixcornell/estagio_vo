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
                        <td style="width:430px; text-align:left;"><font color="#0000FF"><strong>{$dados.TX_ORGAO_GESTOR_ESTAGIO[0]}</strong></font></td>
                        <td style="width:150px;"><strong>Órgão Solicitante</strong></td>
                        <td style="text-align:right;"><font color="#0000FF"><strong>{$dados.TX_ORGAO_ESTAGIO[0]}</strong></font></td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td ><strong>Endereço Órgão Gestor</strong></td>
                        <td >{$dados.TX_ENDERECO_ORG_GESTOR[0]}</td>
                        <td ><strong>Secretário Órg. Gestor</strong></td>
                        <td style="text-align:right;">{$dados.SECRETARIO[0]}</td>    
                    </tr>    
                    <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Quadro de Vagas</strong></td>
                        <td style="text-align:left;">{$dados.TX_VAGAS[0]}</td>	
                        <td style="text-align:left;"><strong>Tipo de Vaga</strong></td>
                        <td style="text-align:right;">{$arrayTipoVagas[$dados.CS_TIPO_VAGA_ESTAGIO[0]]}</td>    
                    </tr>
                    <tr bgcolor="#F0EFEF">                                        
                        <td><strong>Código da Seleção</strong></td>
                        <td>{$dados.TX_COD_SELECAO[0]}</td>
                        <td><strong>Tipo de Contrato</strong></td>
                        <td style="text-align:right;"><div id="atualizacao"> {$arrayTipoContrato[$dados.CS_TIPO[0]]}</div></td>    
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Código do Contrato</strong></td>
                        <td style="text-align:left;">{$dados.TX_CODIGO[0]}</td>	
                        <td style="text-align:left;"></td>
                        <td style="text-align:right;"></td>    
                    </tr>
                    <tr bgcolor="#F0EFEF">                                        
                        <td><strong>Cadastrado por</strong></td>
                        <td>{$dados.FUNCIONARIO_CADASTRO[0]}</td>
                        <td><strong>Data de Cadastro</strong></td>
                        <td style="text-align:right;"><div id="atualizacao"> {$dados.DT_CADASTRO[0]}</div></td>    
                    </tr>
                     <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Alterado por</strong></td>
                        <td style="text-align:left;">{$dados.FUNCIONARIO_ATUALIZACAO[0]}</td>	
                        <td style="text-align:left;"><strong>Data de Atualização</strong></td>
                        <td style="text-align:right;">{$dados.DT_ATUALIZACAO[0]}</td>    
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
                        <td style="width:430px; text-align:left;"><font color="#0000FF"><strong>{$dados.TX_NOME_ESTAGIARIO[0]}</strong></font></td>
                        <td style="width:150px;">
                        <td style="text-align:right;"></td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td ><strong>CPF</strong></td>
                        <td >{$dados.NB_CPF[0]}</td>
                        <td ><strong>RG</strong></td>
                        <td style="text-align:right;">{$dados.NB_RG[0]}</td>    
                    </tr>    
                    <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Telefone</strong></td>
                        <td style="text-align:left;">{$dados.TX_TELEFONE[0]}</td>	
                        <td style="text-align:left;"><strong>Email</strong></td>
                        <td style="text-align:right;">{$dados.TX_EMAIL[0]}</td>    
                    </tr>
                    <tr bgcolor="#F0EFEF">                                        
                        <td><strong>Endereço do Estagiário</strong></td>
                        <td>{$dados.TX_ENDERECO[0]}</td>
                        <td><strong>Data Inicio Vigência</strong></td>
                        <td style="text-align:right;"><div id="atualizacao"> {$dados.DT_INICIO_VIGENCIA[0]}</div></td>    
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Instituição de Ensino</strong></td>
                        <td style="text-align:left;">{$dados.TX_INSTITUICAO_ENSINO[0]}</td>	
                        <td style="text-align:left;"><strong>Data Fim Vigência </strong></td>
                        <td style="text-align:right;">{$dados.DT_FIM_VIGENCIA[0]}</td>    
                    </tr>
                    <tr bgcolor="#F0EFEF">                                        
                        <td><strong>Curso</strong></td>
                        <td>{$dados.TX_CURSO_ESTAGIO[0]}</td>
                        <td><strong>Inicio Horário do Estagio</strong></td>
                        <td style="text-align:right;"><div id="atualizacao"> {$dados.NB_INICIO_HORARIO[0]}</div></td>    
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Período</strong></td>
                        <td style="text-align:left;">{$arrayPeriodoEstagio[$dados.CS_PERIODO[0]]}</td>	
                        <td style="text-align:left;"><strong>Fim Horário do Estágio</strong></td>
                        <td style="text-align:right;">{$dados.NB_INICIO_HORARIO[0]}</td>    
                    </tr>
                    <tr bgcolor="#F0EFEF">                                        
                        <td><strong>Horário do Curso</strong></td>
                        <td>{$arrayHorarioCurso[$dados.CS_HORARIO_CURSO[0]]}</td>
                        <td><strong>Agente de Integração</strong></td>
                        <td style="text-align:right;"><div id="atualizacao"> {$dados.TX_AGENCIA_ESTAGIO[0]}</div></td>    
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Supervisor</strong></td>
                        <td style="text-align:left;">{$dados.SUPERVISOR[0]}</td>	
                        <td style="text-align:left;"><strong>Cargo/Função</strong></td>
                        <td style="text-align:right;">{$dados.TX_CARGO[0]}</td>    
                    </tr>
                    <tr bgcolor="#F0EFEF">                                        
                        <td><strong>Lotação</strong></td>
                        <td>{$dados.ORGAO[0]}</td>
                        <td><strong>TCE</strong></td>
                        <td style="text-align:right;"><div id="atualizacao"> {$dados.TX_TCE[0]}</div></td>    
                    </tr>
                      <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Plano de Atividade</strong></td>
                        <td style="text-align:left;">{$dados.TX_PLANO_ATIVIDADE[0]}</td>	
                        <td style="text-align:left;"><strong>Data de Desligamento</strong></td>
                        <td style="text-align:right;">{$dados.DT_DESLIGAMENTO[0]}</td>    
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