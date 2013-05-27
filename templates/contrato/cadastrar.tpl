<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Novo {$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        <form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">
            Para um novo cadastro de Contrato de Estágio preencha o formulário abaixo e clique em Avançar:<br /><br />

            <!-- FildSet da Unidade Solicitante -->
            <fieldset>
                <legend>Unidade Concedente</legend>

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:300px;" > <font color="#FF0000">*</font>Órgão Gestor
                    <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:290px;">
                        {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
                    </select>
                </div>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:300px;" > <font color="#FF0000">*</font>Órgão Solicitante
                    <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO" style="width:290px;">
                        {html_options options=$arrayOrgaoSolicitante selected=$VO->ID_ORGAO_ESTAGIO}
                    </select>
                </div>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:280px;" > <font color="#FF0000">*</font>Secretário do Órgão Gestor
                    <input type="text" name="TX_FUNCIONARIO" id="TX_FUNCIONARIO" value="{$VO->TX_FUNCIONARIO}"  style="width:300px;" class="leitura" readonly="readonly" />
                </div>  
                <br />              

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:920px;" > <font color="#FF0000">*</font>Endereço do Órgão Gestor
                    <input type="text" name="TX_ENDERECO" id="TX_ENDERECO" value="{$VO->TX_ENDERECO}"  style="width:910px;" class="leitura" readonly="readonly" />
                </div>
                <br /> 
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" > <font color="#FF0000">*</font>Quadro de Vagas:
                    <select name="ID_QUADRO_VAGAS_ESTAGIO" id="ID_QUADRO_VAGAS_ESTAGIO" style="width:170px;">
                        {html_options options=$arrayQuadroVagas selected=$VO->ID_QUADRO_VAGAS_ESTAGIO}
                    </select>
                </div>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" > <font color="#FF0000">*</font>Tipo de Vagas:
                    <select name="CS_TIPO_VAGA_ESTAGIO" id="CS_TIPO_VAGA_ESTAGIO" style="width:300px;">
                        {html_options options=$arrayTipoVagas selected=$VO->CS_TIPO_VAGA_ESTAGIO}
                    </select>
                </div>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" > <font color="#FF0000">*</font>Código da seleção:
                    <select name="ID_SELECAO_ESTAGIO" id="ID_SELECAO_ESTAGIO" style="width:170px;">
                        {html_options options=$arrayCodSelecao selected=$VO->ID_SELECAO_ESTAGIO}
                    </select>
                </div>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" > <font color="#FF0000">*</font>Tipo de Contrato:
                    <select name="CS_TIPO" id="CS_TIPO" style="width:200px;">
                        {html_options options=$arrayTipoContrato selected=$VO->CS_TIPO}
                    </select>
                </div>

            </fieldset>
            <!-- FIm FildSet da Unidade Solicitante -->          

            <!-- FildSet do Estagiário -->
            <fieldset>

                <legend>Estagiário</legend>
                <!-- Primeira linha do cadastro                -->

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:300px;" > <font color="#FF0000">*</font>Candidato
                    <select name="ID_PESSOA_ESTAGIARIO" id="ID_PESSOA_ESTAGIARIO" style="width:290px;">
                        {html_options options=$arrayPessoaEstagiario selected=$VO->ID_PESSOA_ESTAGIARIO}
                    </select>
                </div>    

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:70px;" > <font color="#FF0000">*</font>Codigo
                    <input type="text" name="TX_CODIGO" id="TX_CODIGO" value="{$VO->TX_CODIGO}"  style="width:60px;" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" > <font color="#FF0000">*</font>CPF
                    <input type="text" name="TX_CPF" id="TX_CPF" value="{$VO->TX_CPF}"  style="width:150px;" class="leitura" readonly="readonly" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" > <font color="#FF0000">*</font>Fone
                    <input type="text" name="TX_TELEFONE" id="TX_TELEFONE" value="{$VO->TX_TELEFONE}"  style="width:150px;" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:200px;" >Email
                    <input type="text" name="TX_EMAIL" id="TX_EMAIL" value="{$VO->TX_EMAIL}"  style="width:195px;" />
                </div>  
                <!-- fim Primeira linha do cadastro                -->
                <br />
                <!-- Segunda linha do cadastro        -->

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" > <font color="#FF0000">*</font>RG
                    <input type="text" name="TX_RG" id="TX_RG" value="{$VO->TX_RG}"  style="width:200px;" class="leitura" readonly="readonly" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:695px;" > <font color="#FF0000">*</font>Endereço do Estagiario
                    <input type="text" name="TX_TELEFONE" id="TX_TELEFONE" value="{$VO->TX_TELEFONE}"  style="width:685px;" />
                </div>  
                <!-- fim Segunda linha do cadastro        -->
                <br />

                <!-- terceira linha do Cadastro               -->
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" > <font color="#FF0000">*</font>Data Início Vigência
                    <input type="text" name="DT_INICIO_VIGENCIA" id="DT_INICIO_VIGENCIA" value="{$VO->DT_INICIO_VIGENCIA}"  style="width:140px;" />
                </div>  

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" > <font color="#FF0000">*</font>Data Fim Vigência
                    <input type="text" name="DT_FIM_VIGENCIA" id="DT_FIM_VIGENCIA" value="{$VO->DT_FIM_VIGENCIA}"  style="width:140px;" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" > <font color="#FF0000">*</font> Início Horário Estágio
                    <input type="text" name="NB_INICIO_HORARIO" id="NB_INICIO_HORARIO" value="{$VO->NB_INICIO_HORARIO}"  style="width:140px;" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" >  <font color="#FF0000">*</font>Fim Horário Estágio
                    <input type="text" name="NB_FIM_HORARIO" id="NB_FIM_HORARIO" value="{$VO->NB_FIM_HORARIO}"  style="width:140px;" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:290px;" >  <font color="#FF0000">*</font>Instituição de Ensino
                    <select name="ID_INSTITUICAO_ENSINO" id="ID_INSTITUICAO_ENSINO" style="width:280px;">
                        {html_options options=$arrayInstituicaoeEnsino selected=$VO->ID_INSTITUICAO_ENSINO}
                    </select>
                </div>    
                <!-- fim terceira linha do Cadastro               -->
                <br />

                <!--  quarta linha do cadastro              -->
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:290px;" > <font color="#FF0000">*</font>Curso
                    <select name="ID_CURSO_ESTAGIO" id="ID_CURSO_ESTAGIO" style="width:280px;">
                        {html_options options=$arrayCursoEstagio selected=$VO->ID_CURSO_ESTAGIO}
                    </select>
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" > <font color="#FF0000">*</font>Período
                    <select name="CS_PERIODO" id="CS_PERIODO" style="width:150px;">
                        {html_options options=$arrayPeriodoEstagio selected=$VO->CS_PERIODO}
                    </select>
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" > <font color="#FF0000">*</font>Horário do Curso
                    <select name="CS_HORARIO_CURSO" id="CS_HORARIO_CURSO" style="width:150px;">
                        {html_options options=$arrayHorarioCurso selected=$VO->CS_HORARIO_CURSO}
                    </select>
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:285px;" > <font color="#FF0000">*</font>Agente de Integração
                    <select name="ID_AGENCIA_ESTAGIO" id="ID_AGENCIA_ESTAGIO" style="width:273px;">
                        {html_options options=$arrayAgenteIntegracao selected=$VO->ID_AGENCIA_ESTAGIO}
                    </select>
                </div>  
                <!-- fim quarta linha do cadastro              -->
                <br />
                <!--  quinta linha do cadastro              -->

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:290px;" > <font color="#FF0000">*</font>Supervisor
                    <select name="ID_PESSOA_SUPERVISOR" id="ID_PESSOA_SUPERVISOR" style="width:280px;">
                        {html_options options=$arrayPessoaSupervisor selected=$VO->ID_PESSOA_SUPERVISOR}
                    </select>
                </div>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" > <font color="#FF0000">*</font>Cargo/Função
                    <input type="text" name="TX_CARGO" id="TX_CARGO" value="{$VO->TX_CARGO}"  style="width:150px;" />
                </div>  

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:290px;" > <font color="#FF0000">*</font>Lotação
                    <select name="ID_LOTACAO" id="ID_LOTACAO" style="width:280px;">
                        {html_options options=$arrayLotacao selected=$VO->ID_LOTACAO}
                    </select>
                </div> 


                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" > <font color="#FF0000">*</font>TCE
                    <input type="text" name="TX_TCE" id="TX_TCE" value="{$VO->TX_TCE}"  style="width:140px;" />
                </div>  

                <!--  fim quinta linha do cadastro              -->

                <br />

                <!--     Quinta linha   do cadastro        -->

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:900px;"> <font color="#FF0000">*</font>Plano de Atividade <font color="#FF0000">{$validar.TX_OBSERVACAO}</font><br />
                    <textarea name="" id="" style="width:890px; height:80px;">{$VO->TX_OBSERVACAO}</textarea></div><br />						  				

                <br /><br />

                <!--   fim  Quinta linha   do cadastro        -->



            </fieldset>
            <!-- fim FildSet do Estagiário -->

            <br />

            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />

        </form>

    </div>
</div>