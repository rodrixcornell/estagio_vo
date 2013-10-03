<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">

        <form name="formEvetivar" id="formEvetivar" action="{$url}src/{$pasta}/detail.php" method="post" >
        	<div style="text-align:center; color:#00F">{$msg}</div>
        	<fieldset>
            <legend>Solicitação</legend>
            	<table width="100%" class="dataGrid">
                    <tr bgcolor="#E0E0E0">
                        <td style="width:210px;"><strong>Código</strong></td>
                        <td style="width:450px;" ><font color="#0000FF" class="num_em"><strong>{$dados.TX_CODIGO_OFERTA_VAGA[0]}</strong></font></td>
                        <td style="width:210px;"><strong>Situação</strong></td>
                        <td style="width:200px; text-align:left;"><font color="#0000FF"><strong>{$dados.TX_SITUACAO[0]}</strong></font></td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Órgão Gestor</strong></td>
                        <td>{$dados.TX_ORGAO_GESTOR_ESTAGIO[0]}</td>
                        <td><strong>Agência de Estágio</strong></td>
                        <td style="text-align:left;">{$dados.TX_AGENCIA_ESTAGIO[0]}</td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td><strong>Órgão Solicitante</strong></td>
                        <td>{$dados.TX_ORGAO_ESTAGIO[0]}</td>
                        <td><strong>Tipo de Vaga</strong></td>
                        <td style="text-align:left;">{$dados.TX_TIPO_VAGA_ESTAGIO[0]}</td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Cadastrado por</strong></td>
                        <td>{$dados.TX_FUNCIONARIO_CADASTRO[0]}</td>
                        <td><strong>Data Cadastro</strong></td>
                        <td style="text-align:left;">{$dados.DT_CADASTRO[0]}</div></td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td><strong>Alterado por</strong></td>
                        <td><div id="funcionario">{$dados.TX_FUNCIONARIO_ATUALIZACAO[0]}</div></td>
                        <td><strong>Data Atualização</strong></td>
                        <td style="text-align:left;"><div id="atualizacao">{$dados.DT_ATUALIZACAO[0]}</div>
                        </td>
                    </tr>
                </table>
            </fieldset><br />
            
            <fieldset>
            <legend>Dados do Solicitante</legend>
            	<table width="100%" class="dataGrid">
                    <tr bgcolor="#E0E0E0">
                        <td style="width:210px;"><strong>Órgão Público Municipal</strong></td>
                        <td style="width:450px;">{$dados.TX_ORGAO[0]}</td>
                        <td style="width:210px;"><strong>CNPJ</strong></td>
                        <td style="width:200px; text-align:left;">{$dados.TX_CNPJ[0]}</td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Pessoa de Contato</strong></td>
                        <td>{$dados.TX_PESSOA_CONTATO[0]}</td>
                        <td><strong>Telefone</strong></td>
                        <td style="text-align:left;">{$dados.TX_PESSOA_CONTATO[0]}</td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td><strong>Cargo/Função</strong></td>
                        <td>{$dados.TX_CARGO_FUNCAO[0]}</td>
                        <td><strong>Email</strong></td>
                        <td style="text-align:left;">{$dados.TX_EMAIL[0]}</td>
                    </tr>
                </table>
            </fieldset><br />
            
            <fieldset>
            <legend>Informações da Vaga</legend>
            	<table width="100%" class="dataGrid">
                    <tr bgcolor="#E0E0E0">
                        <td style="width:210px;"><strong>Endereço para Entrevista</strong></td>
                        <td colspan="3">{$dados.TX_ENDERECO[0]}</td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Ponto de Referência</strong></td>
                        <td style="width:450px;">{$dados.TX_PONTO_REFERENCIA[0]}</td>
                        <td style="width:210px;"><strong>Nº Ônibus</strong></td>
                        <td style="width:200px; text-align:left;">{$dados.TX_NUM_ONIBUS[0]}</td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td><strong>Nº Total de Vagas</strong></td>
                        <td>{$dados.NB_QUANTIDADE[0]}</td>
                        <td><strong>Nº de alunos a serem encaminhados para entrevista</strong></td>
                        <td style="text-align:left;">{$dados.NB_QTDE_EMCAMINHADO[0]}</td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Data para Entrevista</strong></td>
                        <td>{$dados.DT_ENTREVISTA[0]}</td>
                        <td><strong>Horário da Entrevista</strong></td>
                        <td style="text-align:left;">{$dados.TX_HORARIO[0]}</td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Duração do Estágio (meses)</strong></td>
                        <td colspan="3">{$dados.NB_DURACAO_ESTAGIO[0]}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>(minimo de 06 meses e máximo de 24 meses, conforme Lei n.º 11.788/2008, art. 11)</strong></td>
                    </tr>
                </table>
            </fieldset><br />

            <fieldset>
            <legend>Benefícios ao Estagiário</legend>
            	<table width="100%" class="dataGrid">
                    <tr bgcolor="#E0E0E0">
                        <td style="width:210px;"><strong>Valor da Bolsa</strong></td>
                        <td style="width:450px;">{number_format($dados.NB_VALOR[0], 2, ',', '.')}</td>
                        <td style="width:210px;"><strong>Valor do Transporte (R$)</strong></td>
                        <td style="width:200px; text-align:left;">{number_format($dados.NB_VALOR_TRANSPORTE[0], 2, ',', '.')}</td>
                    </tr>
                </table>
            </fieldset><br />
            
            <fieldset>
            <legend>Requisitos da Oferta</legend>
            	<table width="100%" class="dataGrid">
                    <tr bgcolor="#E0E0E0">
                        <td style="width:210px;"><strong>Nível de Escolaridade</strong></td>
                        <td colspan="3">{$dados.TX_ESCOLARIDADE[0]}</td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Curso Desejado</strong></td>
                        <td style="width:450px;">{$dados.TX_CURSO_ESTAGIO[0]}</td>
                        <td style="width:210px;"><strong>Ano/Semestre/Módulo</strong></td>
                        <td style="width:200px; text-align:left;">{$dados.NB_SEMESTRE[0]}</td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td><strong>Horário do Estágio</strong></td>
                        <td>{$dados.TX_HORA_INICIO[0]} A {$dados.TX_HORA_FINAL[0]}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(conforme Lei 11.788/2008, art. 10)</td>
                        <td><strong>Outros Horários (se houver)</strong></td>
                        <td style="text-align:left;">{$dados.TX_OUTROS_HORARIOS[0]}</td>
                    </tr>
                </table>
      
            </fieldset><br />
            
            <fieldset>
            <legend>Habilidades do Aluno</legend>
            	<table width="100%" class="dataGrid">
                    <tr bgcolor="#E0E0E0">
                        <td style="width:210px;"><strong>Informática Básica</strong></td>
                        <td>
                        {if $dados.CS_WINDOWS[0]} <img src="{$urlimg}icones/checked.png" /> {else} <img src="{$urlimg}icones/unchecked.gif" /> {/if} <div id="camada" style="width:100px;">Windows</div>
                        {if $dados.CS_WORD[0]} <img src="{$urlimg}icones/checked.png" /> {else} <img src="{$urlimg}icones/unchecked.gif" /> {/if} <div id="camada" style="width:100px;">Word</div>
                        {if $dados.CS_EXCEL[0]} <img src="{$urlimg}icones/checked.png" /> {else} <img src="{$urlimg}icones/unchecked.gif" /> {/if} <div id="camada" style="width:100px;">Excel</div>
                        {if $dados.CS_POWERPOINT[0]} <img src="{$urlimg}icones/checked.png" /> {else} <img src="{$urlimg}icones/unchecked.gif" /> {/if} <div id="camada" style="width:100px;">Power Point</div>
                        {if $dados.CS_INTERNET[0]} <img src="{$urlimg}icones/checked.png" /> {else} <img src="{$urlimg}icones/unchecked.gif" /> {/if} <div id="camada" style="width:100px;">Internet</div>
                        </td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td style="width:210px;"><strong>Informática Avançada</strong></td>
                        <td>
                        {if $dados.CS_CORELDRAW[0]} <img src="{$urlimg}icones/checked.png" /> {else} <img src="{$urlimg}icones/unchecked.gif" /> {/if} <div id="camada" style="width:100px;">Corel Draw</div>
                        {if $dados.CS_PHOTOSHOP[0]} <img src="{$urlimg}icones/checked.png" /> {else} <img src="{$urlimg}icones/unchecked.gif" /> {/if} <div id="camada" style="width:100px;">Photoshop</div>
                        {if $dados.CS_WEBDESIGN[0]} <img src="{$urlimg}icones/checked.png" /> {else} <img src="{$urlimg}icones/unchecked.gif" /> {/if} <div id="camada" style="width:100px;">Web design</div>
                        {if $dados.CS_AUTOCAD[0]} <img src="{$urlimg}icones/checked.png" /> {else} <img src="{$urlimg}icones/unchecked.gif" /> {/if} <div id="camada" style="width:100px;">AutoCAD</div>
                        </td>
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td style="width:210px;"><strong>Língua Estrangeira</strong></td>
                        <td>
                        {if $dados.CS_INGLES[0]} <img src="{$urlimg}icones/checked.png" /> {else} <img src="{$urlimg}icones/unchecked.gif" /> {/if} <div id="camada" style="width:100px;">Inglês</div>
                        {if $dados.CS_ESPANHOL[0]} <img src="{$urlimg}icones/checked.png" /> {else} <img src="{$urlimg}icones/unchecked.gif" /> {/if} <div id="camada" style="width:100px;">Espanhol</div>
                        {if $dados.CS_FRANCES[0]} <img src="{$urlimg}icones/checked.png" /> {else} <img src="{$urlimg}icones/unchecked.gif" /> {/if} <div id="camada" style="width:100px;">Francês</div>
                        {if $dados.CS_ALEMAO[0]} <img src="{$urlimg}icones/checked.png" /> {else} <img src="{$urlimg}icones/unchecked.gif" /> {/if} <div id="camada" style="width:100px;">Alemão</div>
                        <div id="camada" style="width:40px;">Outra:</div> {$dados.TX_OUTRAS_LINGUAS[0]}
                        </td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Outros Pré-Requisitos Desejáveis</strong></td>
                        <td>{$dados.TX_OUTROS_REQUISITOS[0]}</td>
                        
                    </tr>
                    <tr bgcolor="#E0E0E0">
                        <td><strong>Sexo</strong></td>
                        <td>{$dados.TX_SEXO[0]}</td>
                    </tr>
                    
                </table>
                </fieldset><br />
            
            <fieldset>
            <legend>Principais atividades a serem desempenhadas pelo Estagiário</legend>
            	<table width="100%" class="dataGrid">
                    <tr bgcolor="#E0E0E0">
                        <td style="width:210px;"><strong>Principais Atividades</strong></td>
                        <td>{$dados.TX_ATIVIDADES[0]|nl2br}</td>
                    </tr>
                    <tr bgcolor="#F0EFEF">
                        <td><strong>Observações</strong></td>
                        <td>{$dados.TX_OBSERVACAO[0]}</td>
                    </tr>
                </table>    
            </fieldset>
        
        


{if $acesso}
    <div id="botoes">
	    {if $dados.CS_SITUACAO[0] == 1}
        	<input type="hidden" name="BT_EFETIVAR" id="BT_EFETIVAR" value="1" /> <img src="{$urlimg}icones/efetivar.png"  alt="Efetivar" title="Efetivar" id="efetivar" style="cursor:pointer;" />{/if}
        {if $dados.CS_SITUACAO[0] == 2 && $gestor}
        	<input type="hidden" name="BT_ENCAMINHAR" id="BT_ENCAMINHAR" value="1" />
        	<img src="{$urlimg}icones/encaminhar.png"  alt="Encaminhar Oferta" title="Encaminhar Oferta" id="encaminhar" style="cursor:pointer;" />{/if}
    	
        {if $dados.CS_SITUACAO[0] == 1 ||  $gestor}
        <a href="{$url}src/{$pasta}/alterar.php"><img src="{$urlimg}icones/alterar.png"  alt="Alterar" title="Alterar" id="alterarMaster" /></a>
        <a href="{$url}src/{$pasta}/excluir.php"><img src="{$urlimg}icones/excluir.png"  alt="Excluir" title="Excluir" id="excluirMaster" /></a>
        {/if}
    </div>
{/if}
</form>
        <div id="botoesInferiores">
            <a href="{$url}src/{$pasta}/index.php"><img src="{$urlimg}icones/voltar.png" alt="Voltar" title="Voltar" class="voltar" /></a>
        </div>
    </div>
</div>