<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">

        <form name="form" action="{$url}src/{$pasta}/detail.php" method="post" >
            <fieldset>

                <!-- Primeiro fieldset do detail-->
                <legend>Recesso</legend>
                <table width="100%" class="dataGrid" >
                    <tr bgcolor="#E0E0E0">
                        <td style="width:150px;"><strong>Órgão Gestor</strong></td>
                        <td style="width:430px; text-align:left;"><font color="#0000FF"><strong>{$dados.TX_ORGAO_GESTOR[0]}</strong></font></td>
                        <td style="width:150px;"><strong>Órgão Solicitante</strong></td>
                        <td style="text-align:left;"><font color="#0000FF"><strong>{$dados.TX_ORGAO_SOLICITANTE[0]}</strong></font></td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td ><strong>Secretário Órgão Gestor</strong></td>
                        <td >{$dados.TX_SECRETARIO_ORGAO_GESTOR[0]}</td>
                        <td ><strong>Código do Contrato</strong></td>
                        <td style="text-align:left;">{$dados.TX_CONTRATO[0]}</td>    
                    </tr>    
                    <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Tipo de Vaga</strong></td>
                        <td style="text-align:left;">{$dados.TX_TIPO_VAGA_ESTAGIO[0]}</td>	
                        <td style="text-align:left;"><strong>TCE</strong></td>
                        <td style="text-align:left;">{$dados.TX_TCE[0]}</td>    
                    </tr>
                    <tr bgcolor="#F0EFEF">                                        
                        <td><strong>Nome do Estagiário</strong></td>
                        <td>{$dados.TX_NOME_ESTAGIARIO[0]}</td>
                        <td><strong>CPF</strong></td>
                        <td style="text-align:left;"><div id="atualizacao"> {$dados.NB_CPF[0]}</div></td>    
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Instituição de Ensino</strong></td>
                        <td style="text-align:left;">{$dados.TX_INSTITUICAO_ENSINO[0]}</td>	
                        <td style="text-align:left;"><strong>Curso</strong></td>
                        <td style="text-align:left;">{$dados.TX_CURSO_ESTAGIO[0]}</td>	
                    </tr>

                    <tr bgcolor="#F0EFEF">
                        <td style="text-align:left;"><strong>Nível</strong></td>
                        <td style="text-align:left;">{$dados.TX_NIVEL[0]}</td>	
                        <td style="text-align:left;"><strong>Período</strong></td>
                        <td style="text-align:left;">{$dados.TX_PERIODO[0]}</td>	
                    </tr>


                    <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Início de Vigência</strong></td>
                        <td style="text-align:left;">{$dados.DT_INICIO_VIG_ESTAGIO[0]}</td>	
                        <td style="text-align:left;"><strong>Fim de Vigência</strong></td>
                        <td style="text-align:left;">{$dados.DT_FIM_VIGENCIA_ESTAGIO[0]}</td>	
                    </tr>


                    <tr bgcolor="#F0EFEF">
                        <td style="text-align:left;"><strong>Ano de Referência</strong></td>
                        <td style="text-align:left;">{$dados.NB_ANO_REFERENCIA[0]}</td>	
                        <td style="text-align:left;"><strong>Mês de Referência</strong></td>
                        <td style="text-align:left;">{$dados.NB_MES_REFERENCIA[0]}</td>	
                    </tr>


                    <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Início do Recesso</strong></td>
                        <td style="text-align:left;">{$dados.DT_INICIO_RECESSO[0]}</td>	
                        <td style="text-align:left;"><strong>Fim do Recesso</strong></td>
                        <td style="text-align:left;">{$dados.DT_FIM_RECESSO[0]}</td>	
                    </tr>


                    <tr bgcolor="#F0EFEF">
                        <td style="text-align:left;"><strong>Agente Setorial</strong></td>
                        <td style="text-align:left;">{$dados.TX_AGENTE_SETORIAL[0]}</td>	
                        <td style="text-align:left;"><strong>Cargo / Função</strong></td>
                        <td style="text-align:left;">{$dados.TX_CARGO_AGENTE[0]}</td>	
                    </tr>


                    <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>E-mail</strong></td>
                        <td style="text-align:left;">{$dados.TX_EMAIL_AGENTE[0]}</td>	
                        <td style="text-align:left;"><strong>Telefone</strong></td>
                        <td style="text-align:left;">{$dados.TX_TELEFONE_AGENTE[0]}</td>	
                    </tr>


                    <tr bgcolor="#F0EFEF">
                        <td style="text-align:left;"><strong>Chefia Imediata</strong></td>
                        <td style="text-align:left;">{$dados.TX_CHEFIA_IMEDIATA[0]}</td>	
                        <td style="text-align:left;"><strong>Situação do Cadastro</strong></td>
                        <td style="text-align:left;">{$dados.TX_SITUACAO[0]}</td>	
                    </tr>


                    <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Situação Gozo</strong></td>
                        <td style="text-align:left;">{$dados.TX_REALIZACAO[0]}</td>	
                        <td style="text-align:left;"><strong>Data do Adiamento</strong></td>
                        <td style="text-align:left;">{$dados.DT_ADIAMENTO[0]}</td>	
                    </tr>



                    <tr bgcolor="#F0EFEF">                                        
                        <td><strong>Cadastrado por</strong></td>
                        <td>{$dados.FUNCIONARIO_CADASTRO[0]}</td>
                        <td><strong>Data de Cadastro</strong></td>
                        <td style="text-align:left;"><div id="atualizacao"> {$dados.DT_CADASTRO[0]}</div></td>    
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Alterado por</strong></td>
                        <td style="text-align:left;">{$dados.FUNCIONARIO_ATUALIZACAO[0]}</td>	
                        <td style="text-align:left;"><strong>Data de Atualização</strong></td>
                        <td style="text-align:left;">{$dados.DT_ATUALIZACAO[0]}</td>    
                    </tr>

                </table>

                <!-- fim Primeiro fieldset do detail-->

            </fieldset>






            <div id="tabelaBase"></div>



            </fieldset>   

            <div id="botoesInferiores">
                <a href="{$url}src/{$pasta}/index.php"><img src="{$urlimg}icones/voltar.png" alt="Voltar" title="Voltar" class="voltar" /></a>
                {if $acesso}<div id="botoes">
                        <input type="submit" name="efetivar" id="inserir" value=" Efetivar Recesso " {if $dados.CS_SITUACAO[0] == 2}disabled="disabled"{/if} style="float:left;margin-top:3px;margin-right: 20px;" />
                        <a href="{$url}src/{$pasta}/alterar.php"><img src="{$urlimg}icones/alterar.png"  alt="Alterar" title="Alterar" id="alterarMaster" /></a>
                        <a href="{$url}src/{$pasta}/excluir.php"><img src="{$urlimg}icones/excluir.png"  alt="Excluir" title="Excluir" id="excluirMaster" /></a>
                    </div>{/if}
                </div>
            </form>
        </div>

    </div>