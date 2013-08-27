<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">

        <form name="form" action="{$url}src/{$pasta}/excluir.php" method="post" >
            <fieldset>

                <!-- Primeiro fieldset do detail-->
                <legend>Solicitante</legend>
                <table width="100%" class="dataGrid" >
                    <tr bgcolor="#E0E0E0">
                        <td style="width:150px;"><strong>Órgão Gestor</strong></td>
                        <td style="width:300px; text-align:left;"><font color="#0000FF"><strong>{$dados.TX_ORGAO_GESTOR_ESTAGIO[0]}</strong></font></td>
                        <td style="width:150px;"><strong>Órgão Solicitante</strong></td>
                        <td>{$dados.TX_ORGAO_ESTAGIO[0]}</font></td>
                        </tr>
                    {*-----Secretário Órg. Gestor-----*}
                        <tr bgcolor="#F0EFEF">
                        <td ><strong>Secretário Órg. Gestor</strong></td>
                        <td>{$dados.SECRETARIO[0]}</td>    
                        <td ><strong>Cód. Contrato</strong></td>
                        <td >{$dados.TX_CODIGO_CONTRATO[0]}</td>
                        </tr>  
                    {*-----Tipo de Vaga-----*}    
                        <tr bgcolor="#E0E0E0">
                        <td style="text-align:left;"><strong>Tipo de Vaga </strong></td>
                        <td style="text-align:left;">{$dados.TX_TIPO_VAGA_ESTAGIO[0]}</td> 
                        <td><strong>TCE </strong></td>
                        <td>{$dados.TX_TCE[0]}</td> 
                        </tr>
                    {*--------Nome do Estagiário-----------*}    
                        <tr bgcolor="#F0EFEF">                                        
                        <td><strong>Nome do Estagiário </strong></td>
                        <td>{$dados.TX_NOME[0]}</td>
                        <td><strong>CPF do Estagiário </strong></td>
                        <td >{$dados.NB_CPF[0]}</td>    
                        </tr>
                        {*------Instituição de Ensino------------*}
                        <tr bgcolor="#E0E0E0">
                        <td><strong>Instituição de Ensino </strong></td>
                        <td>{$dados.TX_INSTITUICAO_ENSINO[0]}</td> 
                        <td><strong>Curso </strong></td>
                        <td>{$dados.TX_CURSO_ESTAGIO[0]}</td>    
                        </tr>
                        {*-----Período/Ano---------*}
                        <tr bgcolor="#F0EFEF">                                        
                        <td><strong>Período/Ano </strong></td>
                        <td > {$dados.TX_PERIODO[0]}</td>
                        <td><strong>Agente de Integração </strong></td>
                        <td >{$dados.TX_AGENCIA_ESTAGIO[0]}</td>
                        <td></td>
                        </tr>
                        {*---Agente Setorial------*}
                        <tr bgcolor="#E0E0E0"> 
                        <td><strong>Agente Setorial </strong></td>
                        <td>{$dados.TX_AGENTE_SETORIAL[0]}</td>   
                        <td><strong>Cargo / Função </strong></td>
                        <td>{$dados.TX_CARGO_AGENTE[0]}</td>
                        </tr>
                        {*------Email--------*}
                        <tr bgcolor="#F0EFEF">  
                        <td><strong>Email </strong></td>
                        <td>{$dados.TX_EMAIL_AGENTE[0]}</td>   
                        <td><strong>Telefone </strong></td>
                        <td >{$dados.TX_FONE_AGENTE[0]}</td>    
                        </tr>
                        {*----Motivo-------*}
                        <tr bgcolor="#E0E0E0">   
                        <td><strong>Motivo </strong></td>
                        <td >{$dados.TX_MOTIVO_SITUACAO[0]}</td> 
                        <td><strong>Situação </strong></td>
                        <td > {$dados.TX_SITUACAO[0]}</td>    
                        </tr> 
                        {*------Cadastrado por -----------*}
                        <tr bgcolor="#F0EFEF">                                      
                        <td><strong>Cadastrado por </strong></td>
                        <td>{$dados.TX_FUNCIONARIO_CADASTRO[0]}</td>
                        <td><strong>Data do Cadastro </strong></td>
                        <td >{$dados.DT_CADASTRO[0]}</td >    
                        </tr> 
                        {*------Alterado por-----------*}
                        <tr bgcolor="#E0E0E0">                                        
                        <td><strong>Alterado por </strong></td>
                        <td><div id="func_atualizacao">{$dados.TX_FUNCIONARIO_ALTERACAO[0]}</div></td>
                        <td><strong>Data da Atualização </strong></td>
                        <td ><div id="atualizacao"> {$dados.DT_ATUALIZACAO[0]}</div></td>    
                    </tr>
                </table>
            </fieldset>{*---------fimdo fildset------------*}
              <fieldset>
{*------------------Inicio de Vigência---------------*}
                <legend>Alterações</legend>
                <table width="100%" class="dataGrid" >
                    
                    <input type="checkbox" name="VIGENCIA" value="1"disabled="disabled">Nova Vigência
                    <tr bgcolor="#E0E0E0">
                        <td style="width:150px;"><strong>Data Inicio de Vigência</strong></td>
                        <td style="width:300px; text-align:left;">{$dados.DT_INICIO_PRORROGACAO[0]}</td>
                        <td style="width:150px;"><strong>Data Fim de Vigência</strong></td>
                        <td>{$dados.DT_FIM_PRORROGACAO[0]}</td>
                        </tr>
                        
                        <tr bgcolor="#F0EFEF">
                        <td ><strong>Meses </strong></td>
                        <td>{$dados.SECRTARIO[0]}</td>
                        <td ><strong> </strong></td>
                        <td> </td>
                        </tr>
                        
                        <tr bgcolor="#E0E0E0">
                        <td ><strong>Data Inicio Recesso</strong></td>
                        <td >{$dados.DT_INICIO_RECESSO[0]}</td>
                        <td style="text-align:left;"><strong>Data Fim Recesso </strong></td>
                        <td style="text-align:left;">{$dados.DT_FIM_RECESSO[0]}</td>  
                       </table></tr> </tr></tr> <br />  

                <table width="100%" class="dataGrid" >
                <input type="checkbox" name="JORNADA" value="1"disabled="disabled">Alteração de Horário  <br />

                    <tr bgcolor="#E0E0E0">
                        <td style="width:150px;"><strong>Data Inicio de Vigência</strong></td></td></td>
                        <td style="width:300px; text-align:left;">{$dados.DT_INICIO_PRORROGACAO[0]}</td>
                        <td style="width:150px;"><strong>Total de Horas </strong></td>
                        <td>{$dados.TX_HORAS_JORNADA[0]}</td> 
                        </tr>
                    
                        <tr bgcolor="#F0EFEF">
                        <td><strong>Horário de Entrada </strong></td>
                        <td>{$dados.TX_INICIO_HORARIO[0]}</td> 
                        <td><strong>Horário de Saída </strong></td>
                        <td>{$dados.TX_FIM_HORARIO[0]}</td>  
                         </table></tr> </tr></tr> <br />

                <table width="100%" class="dataGrid" >
                <input type="checkbox" name="BOLSA" value="1"disabled="disabled">Alteração de Bolsa  <br />
                
                        <tr bgcolor="#E0E0E0">
                        <td style="width:150px;"><strong>Data Inicio de Vigência</strong></td></td></td>
                        <td style="width:300px; text-align:left;">{$dados.DT_INICIO_PAG_BOLSA[0]}</td>
                        <td style="width:150px;"><strong>Valo(R$)  </strong></td>
                        <td>{$dados.NB_VALOR_BOLSA[0]}</td>     
                        </table></tr> </tr></tr> <br />

                <table width="100%" class="dataGrid" >
                <input type="checkbox" name="ALTERACOES" value="1"disabled="disabled">Outras Alterações  <br />
                
                        <tr bgcolor="#E0E0E0">
                        <td style="vertical-align:baseline; padding-top:4px;"><strong>Descrição</strong></td>
                        <td colspan="3">{$dados.TX_OUTRAS_ALTERACOES[0]}</td>   
                        </table></tr> </tr>

                {*-----------*}               
                </tr>
                </table>
            </fieldset>

        </form>

        <div id="tabelaBase"></div>

        </fieldset>   

        <div id="botoesInferiores">
            <a href="{$url}src/{$pasta}/index.php"><img src="{$urlimg}icones/voltar.png" alt="Voltar" title="Voltar" class="voltar" /></a>
            {if $acesso}<div id="botoes">

                    <form action="{$url}src/{$pasta}/detail.php" method="post" style="display:inline;">         
                        <input type="submit" name="efetivar" id="efetivar" value=" Efetivar Seleção "/>
                    </form>	
                    <a href="{$url}src/{$pasta}/alterar.php"><img src="{$urlimg}icones/alterar.png"  alt="Alterar" title="Alterar" id="alterarMaster" /></a>
                    <a href="{$url}src/{$pasta}/excluir.php"><img src="{$urlimg}icones/excluir.png"  alt="Excluir" title="Excluir" id="excluirMaster" /></a>
                </div>{/if}
            </div>

        </div>

    </div>