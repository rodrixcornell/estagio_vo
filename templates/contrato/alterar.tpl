<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Novo {$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        <form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">
            Para alterar Contrato de Estágio preencha o formulário abaixo e clique em Avançar:<br /><br />

            <!-- FildSet da Unidade Solicitante -->
            <fieldset>
                <legend>Unidade Concedente</legend>

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:300px;" > <font color="#FF0000">*</font>Órgão Gestor<font color="#FF0000">{$validar.ID_ORGAO_GESTOR_ESTAGIO}</font><br />
                    <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:290px;">
                        {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
                    </select>
                </div>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:300px;" > <font color="#FF0000">*</font>Órgão Solicitante<font color="#FF0000">{$validar.ID_ORGAO_ESTAGIO}</font><br />
                    <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO" style="width:290px;">
                        {html_options options=$arrayOrgaoSolicitante selected=$VO->ID_ORGAO_ESTAGIO}
                    </select>
                </div>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:280px;" >Secretário do Órgão Gestor
                    <input type="text" name="TX_FUNCIONARIO" id="TX_FUNCIONARIO" value="{$VO->TX_FUNCIONARIO}"  style="width:300px;" class="leitura" readonly="readonly" />
                </div>  
                <br />              

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:920px;" >Endereço do Órgão Gestor
                    <input type="text" name="TX_ENDERECO_SEC" id="TX_ENDERECO_SEC" value="{$VO->TX_ENDERECO_SEC}"  style="width:910px;" class="leitura" readonly="readonly" />
                </div>
                <br />
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" > <font color="#FF0000">*</font>Quadro de Vagas:<font color="#FF0000">{$validar.ID_QUADRO_VAGAS_ESTAGIO}</font><br />
                    <select name="ID_QUADRO_VAGAS_ESTAGIO" id="ID_QUADRO_VAGAS_ESTAGIO" style="width:170px;">
                        {html_options options=$arrayQuadroVagas selected=$VO->ID_QUADRO_VAGAS_ESTAGIO}
                    </select>
                </div>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" > <font color="#FF0000">*</font>Tipo de Vagas:<font color="#FF0000">{$validar.CS_TIPO_VAGA_ESTAGIO}</font><br />
                    <select name="CS_TIPO_VAGA_ESTAGIO" id="CS_TIPO_VAGA_ESTAGIO" style="width:300px;">
                        {html_options options=$arrayTipoVagas selected=$VO->CS_TIPO_VAGA_ESTAGIO}
                    </select>
                </div>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" > <font color="#FF0000">*</font>Código da seleção:<font color="#FF0000">{$validar.ID_SELECAO_ESTAGIO}</font><br />
                    <select name="ID_SELECAO_ESTAGIO" id="ID_SELECAO_ESTAGIO" style="width:170px;">
                        {html_options options=$arrayCodSelecao selected=$VO->ID_SELECAO_ESTAGIO}
                    </select>
                </div>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" > <font color="#FF0000">*</font>Tipo de Contrato:<font color="#FF0000">{$validar.CS_TIPO}</font><br />
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

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:300px;" > <font color="#FF0000">*</font>Candidato<font color="#FF0000">{$validar.ID_PESSOA_ESTAGIARIO}</font><br />
                    <select name="ID_PESSOA_ESTAGIARIO" id="ID_PESSOA_ESTAGIARIO" style="width:290px;">
                        {html_options options=$arrayPessoaEstagiario selected=$VO->ID_PESSOA_ESTAGIARIO}
                    </select>
                </div>                 
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" >CPF
                    <input type="text" name="NB_CPF" id="NB_CPF" value="{$VO->NB_CPF}"  style="width:150px;" class="leitura" readonly="readonly" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" > <font color="#FF0000">*</font>Fone<font color="#FF0000">{$validar.TX_TELEFONE}</font><br />
                    <input type="text" name="TX_TELEFONE" id="TX_TELEFONE" value="{$VO->TX_TELEFONE}"  style="width:150px;" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:270px;" >Email
                    <input type="text" name="TX_EMAIL" id="TX_EMAIL" value="{$VO->TX_EMAIL}"  style="width:260px;" />
                </div>  
                <!-- fim Primeira linha do cadastro                -->
                <br />
                <!-- Segunda linha do cadastro        -->

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" >RG
                    <input type="text" name="NB_RG" id="NB_RG" value="{$VO->NB_RG}"  style="width:200px;" class="leitura" readonly="readonly" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:690px;" > <font color="#FF0000">*</font>Endereço do Estagiario<font color="#FF0000">{$validar.TX_ENDERECO}</font><br />
                    <input type="text" name="TX_ENDERECO" id="TX_ENDERECO" value="{$VO->TX_ENDERECO}"  style="width:680px;" />
                </div>  
                <!-- fim Segunda linha do cadastro        -->
                <br />

                <!-- terceira linha do Cadastro               -->
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" > <font color="#FF0000">*</font>Data Início Vigência<font color="#FF0000">{$validar.DT_INICIO_VIGENCIA}</font><br />
                    <input type="text" name="DT_INICIO_VIGENCIA" id="DT_INICIO_VIGENCIA" value="{$VO->DT_INICIO_VIGENCIA}"  style="width:140px;" />
                </div>  

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" > <font color="#FF0000">*</font>Data Fim Vigência<font color="#FF0000">{$validar.DT_FIM_VIGENCIA}</font><br />
                    <input type="text" name="DT_FIM_VIGENCIA" id="DT_FIM_VIGENCIA" value="{$VO->DT_FIM_VIGENCIA}"  style="width:140px;" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" > <font color="#FF0000">*</font> Início Horário Estágio<font color="#FF0000">{$validar.NB_INICIO_HORARIO}</font><br />
                    <input type="text" name="NB_INICIO_HORARIO" id="NB_INICIO_HORARIO" value="{$VO->NB_INICIO_HORARIO}"  style="width:140px;" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" >  <font color="#FF0000">*</font>Fim Horário Estágio<font color="#FF0000">{$validar.NB_FIM_HORARIO}</font><br />
                    <input type="text" name="NB_FIM_HORARIO" id="NB_FIM_HORARIO" value="{$VO->NB_FIM_HORARIO}"  style="width:140px;" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:290px;" >  <font color="#FF0000">*</font>Instituição de Ensino<font color="#FF0000">{$validar.ID_INSTITUICAO_ENSINO}</font><br />
                    <select name="ID_INSTITUICAO_ENSINO" id="ID_INSTITUICAO_ENSINO" style="width:280px;">
                        {html_options options=$arrayInstituicaoDeEnsino selected=$VO->ID_INSTITUICAO_ENSINO}
                    </select>
                </div>    
                <!-- fim terceira linha do Cadastro               -->
                <br />

                <!--  quarta linha do cadastro              -->
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:290px;" > <font color="#FF0000">*</font>Curso<font color="#FF0000">{$validar.ID_CURSO_ESTAGIO}</font><br />
                    <select name="ID_CURSO_ESTAGIO" id="ID_CURSO_ESTAGIO" style="width:280px;">
                        {html_options options=$arrayCursoEstagio selected=$VO->ID_CURSO_ESTAGIO}
                    </select>
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" > <font color="#FF0000">*</font>Período<font color="#FF0000">{$validar.CS_PERIODO}</font><br />
                    <select name="CS_PERIODO" id="CS_PERIODO" style="width:150px;">
                        {html_options options=$arrayPeriodoEstagio selected=$VO->CS_PERIODO}
                    </select>
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" > <font color="#FF0000">*</font>Horário do Curso<font color="#FF0000">{$validar.CS_HORARIO_CURSO}</font><br />
                    <select name="CS_HORARIO_CURSO" id="CS_HORARIO_CURSO" style="width:150px;">
                        {html_options options=$arrayHorarioCurso selected=$VO->CS_HORARIO_CURSO}
                    </select>
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:285px;" > <font color="#FF0000">*</font>Agente de Integração<font color="#FF0000">{$validar.ID_AGENCIA_ESTAGIO}</font><br />
                    <select name="ID_AGENCIA_ESTAGIO" id="ID_AGENCIA_ESTAGIO" style="width:273px;">
                        {html_options options=$arrayAgenteIntegracao selected=$VO->ID_AGENCIA_ESTAGIO}
                    </select>
                </div>  
                <!-- fim quarta linha do cadastro              -->
                <br />
                <!--  quinta linha do cadastro              -->

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:290px;" > <font color="#FF0000">*</font>Supervisor<font color="#FF0000">{$validar.ID_PESSOA_SUPERVISOR}</font><br />
                    <select name="ID_PESSOA_SUPERVISOR" id="ID_PESSOA_SUPERVISOR" style="width:280px;">
                        {html_options options=$arrayPessoaSupervisor selected=$VO->ID_PESSOA_SUPERVISOR}
                    </select>
                </div>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" > Cargo/Função
                    <input type="text" name="TX_CARGO" id="TX_CARGO" value="{$VO->TX_CARGO}"  style="width:150px;"  class="leitura" readonly="readonly"  />
                </div>  

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:290px;" > <font color="#FF0000">*</font>Lotação<font color="#FF0000">{$validar.ID_LOTACAO}</font><br />
                    <select name="ID_LOTACAO" id="ID_LOTACAO" style="width:280px;">
                        {html_options options=$arrayLotacao selected=$VO->ID_LOTACAO}
                    </select>
                </div> 


                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" > <font color="#FF0000">*</font>TCE<font color="#FF0000">{$validar.TX_TCE}</font><br />
                    <input type="text" name="TX_TCE" id="TX_TCE" value="{$VO->TX_TCE}"  style="width:140px;" />
                </div>  

                <!--  fim quinta linha do cadastro              -->

                <br />

                <!--      Sexta linha          -->

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:190px;" > <font color="#FF0000">*</font>Bolsa<font color="#FF0000">{$validar.ID_BOLSA_ESTAGIO}</font><br />
                    <select name="ID_BOLSA_ESTAGIO" id="ID_BOLSA_ESTAGIO" style="width:180px;">
                        {html_options options=$arrayBolsa selected=$VO->ID_BOLSA_ESTAGIO}
                    </select>
                </div>     

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" >Valor
                    <input type="text" name="NB_VALOR" id="NB_VALOR" value="{$VO->NB_VALOR}"  style="width:150px;"  class="leitura" readonly="readonly"  />
                </div>  


                <!--    fim  Sexta linha          -->

                <br />

                <!--     Setima linha   do cadastro        -->

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:900px;"> <font color="#FF0000">*</font>Plano de Atividade <font color="#FF0000">{$validar.TX_PLANO_ATIVIDADE}</font><br />
                    <textarea name="TX_PLANO_ATIVIDADE" id="TX_PLANO_ATIVIDADE" style="width:890px; height:80px;">{$VO->TX_PLANO_ATIVIDADE}</textarea></div><br />						  				

                <br /><br />

                <!--   fim  Setima linha   do cadastro        -->



            </fieldset>
            <!-- fim FildSet do Estagiário -->

            <br />

            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />

        </form>

    </div>
</div>