<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Novo {$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        Para um novo cadastro de Curso preencha o formulário abaixo e clique em Avançar:<br /><br />
        <form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;">
                <font color="#FF0000">*</font>Órgão Gestor <font color="#FF0000">{$validar.ID_ORGAO_GESTOR_ESTAGIO}</font><br />
                <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:300px;">
                    {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
                </select></div> 

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;">
                <font color="#FF0000">*</font>Órgão Solicitante<font color="#FF0000">{$validar.ID_ORGAO_ESTAGIO}</font><br />
                <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO" style="width:300px;">
                    {html_options options=$arrayOrgaoSolicitante selected=$VO->ID_ORGAO_ESTAGIO}
                </select></div> 

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:311px;">
                <font color="#FF0000"></font>Secretário do Órgão Gestor<font color="#FF0000"></font><br />
                <input type="text" name="TX_SECRETARIO_ORGAO_GESTOR" id="TX_SECRETARIO_ORGAO_GESTOR" value="{$VO->TX_SECRETARIO_ORGAO_GESTOR}" style="width:300px;" class="leitura" readonly="readonly" /></div>  



            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:190px;" > <font color="#FF0000">*</font>Cód. Contrato <font color="#FF0000">{$validar.ID_CONTRATO}</font><br />
                <select name="ID_CONTRATO" id="ID_CONTRATO" style="width:180px;">
                    {html_options options=$arrayContrato selected=$VO->ID_CONTRATO}
                </select>
            </div>                              
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" >Tipo de Vaga
                <input type="text" name="TX_TIPO_VAGA_ESTAGIO" id="TX_TIPO_VAGA_ESTAGIO" value="{$VO->TX_TIPO_VAGA_ESTAGIO}"  style="width:200px;" class="leitura" readonly="readonly" />
            </div>  
            <input type="hidden" name="ID_AGENCIA_ESTAGIO" id="ID_AGENCIA_ESTAGIO" value="{$VO->ID_AGENCIA_ESTAGIO}"  />

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:215px;" >TCE
                <input type="text" name="TX_TCE" id="TX_TCE" value="{$VO->TX_TCE}"  style="width:205px;" class="leitura" readonly="readonly" />
            </div>  
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" >Nome do Estagiário
                <input type="text" name="TX_NOME" id="TX_NOME" value="{$VO->TX_NOME}"  style="width:300px;" class="leitura" readonly="readonly" />
            </div>  
            <br />
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" >CPF do Estagiário 
                <input type="text" name="NB_CPF" id="NB_CPF" value="{$VO->NB_CPF}"  style="width:170px;" class="leitura" readonly="readonly" />
            </div>  
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" >Instituição do Estagiário 
                <input type="text" name="TX_INSTITUICAO_ENSINO" id="TX_INSTITUICAO_ENSINO" value="{$VO->TX_INSTITUICAO_ENSINO}"  style="width:300px;" class="leitura" readonly="readonly" />
            </div>  
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:270px;" >Curso 
                <input type="text" name="TX_CURSO_ESTAGIO" id="TX_CURSO_ESTAGIO" value="{$VO->TX_CURSO_ESTAGIO}"  style="width:260px;" class="leitura" readonly="readonly" />
            </div>  
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" >Nível 
                <input type="text" name="TX_NIVEL" id="TX_NIVEL" value="{$VO->TX_NIVEL}"  style="width:150px;" class="leitura" readonly="readonly" />
            </div>  
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" >Período/Ano 
                <input type="text" name="TX_PERIODO" id="TX_PERIODO" value="{$VO->TX_PERIODO}"  style="width:170px;" class="leitura" readonly="readonly" />
            </div>  



            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;">
                <font color="#FF0000"></font>Inicio da Vigência<font color="#FF0000"></font><br/>
                <input type="text" name="DT_INICIO_VIG_ESTAGIO" id="DT_INICIO_VIG_ESTAGIO" value="{$VO->DT_INICIO_VIG_ESTAGIO}" style="width:140px;" class="leitura" readonly="readonly" />                
            </div>  



            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:155px;">
                <font color="#FF0000"></font>Fim da Vigência<font color="#FF0000"></font>
                <input type="text" name="DT_FIM_VIGENCIA_ESTAGIO" id="DT_FIM_VIGENCIA_ESTAGIO"  style="width:145px;" value="{$VO->DT_FIM_VIGENCIA_ESTAGIO}" class="leitura" readonly="readonly" />
            </div>  



            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:90px;">
                <font color="#FF0000">*</font>Ano Ref.<font color="#FF0000">{$validar.NB_ANO_REFERENCIA}</font><br />
                <input type="text" name="NB_ANO_REFERENCIA" id="NB_ANO_REFERENCIA" value="{$VO->NB_ANO_REFERENCIA}" color="#00FF00" style="width:80px;" /></div>  

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:90px;">
                <font color="#FF0000">*</font>Mês Ref.<font color="#FF0000">{$validar.NB_MES_REFERENCIA}</font><br />
                <input type="text" name="NB_MES_REFERENCIA" id="NB_MES_REFERENCIA" value="{$VO->NB_MES_REFERENCIA}" color="#00FF00" style="width:80px;" /></div>  

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:125px;">
                <font color="#FF0000">* </font>Início do Recesso<font color="#FF0000">{$validar.DT_INICIO_RECESSO}</font>
                <input type="text" name="DT_INICIO_RECESSO" id="DT_INICIO_RECESSO" value="{$VO->DT_INICIO_RECESSO}" color="#00FF00" style="width:115px;" /></div>  

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:120px;">
                <font color="#FF0000">* </font>Fim do Recesso<font color="#FF0000">{$validar.DT_FIM_RECESSO}</font><br />
                <input type="text" name="DT_FIM_RECESSO" id="DT_FIM_RECESSO" value="{$VO->DT_FIM_RECESSO}" color="#00FF00" style="width:110px;" /></div>  


            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;">
                <font color="#FF0000">* </font>Situação do Cadastro<font color="#FF0000"></font>
                <input type="text" name="CS_SITUACAO" id="TX_SITUACAO" value="ABERTA" class="leitura" readonly="readonly" />  </div>  

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;">
                <font color="#FF0000">*</font>Situação do Gozo<font color="#FF0000">{$validar.CS_REALIZACAO}</font><br />
                <select name="CS_REALIZACAO" id="CS_REALIZACAO" style="width:200px;">
                    {html_options options=$arraySituacaoGozo selected=$VO->CS_REALIZACAO}
                </select></div> 


            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" > *<font color="#FF0000"></font>Agente Setorial <font color="#FF0000">{$validar.ID_SETORIAL_ESTAGIO}</font><br />
                <select name="ID_SETORIAL_ESTAGIO" id="ID_SETORIAL_ESTAGIO" style="width:200px;">
                    {html_options options=$arrayAgenteSetorial selected=$VO->ID_SETORIAL_ESTAGIO}
                </select>
            </div>                              

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:320px;" > 
                <font color="#FF0000">*</font>Cargo/Função <font color="#FF0000">{$validar.TX_CARGO_AGENTE}</font>
                <input type="text" name="TX_CARGO_AGENTE" id="TX_CARGO_AGENTE" value="{$VO-> TX_CARGO_AGENTE}"  style="width:310px;"/>
            </div>              

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" >
                <font color="#FF0000">*</font>Telefone <font color="#FF0000">{$validar.TX_TELEFONE_AGENTE}</font>
                <input type="text" name="TX_TELEFONE_AGENTE" id="TX_TELEFONE_AGENTE" value="{$VO->TX_TELEFONE_AGENTE}"  style="width:170px;" />
            </div>  

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:270px;" ><font color="#FF0000">*</font>Email <font color="#FF0000">{$validar.TX_EMAIL_AGENTE}</font>
                <input type="text" name="TX_EMAIL_AGENTE" id="TX_EMAIL_AGENTE" value="{$VO->TX_EMAIL_AGENTE}"  style="width:260px;" />
                </div>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;">
                    <font color="#FF0000">*</font>Chefia Imediata<font color="#FF0000">{$validar.TX_CHEFIA_IMEDIATA}</font>
                    <input type="text" name="TX_CHEFIA_IMEDIATA" id="TX_CHEFIA_IMEDIATA" value="{$VO->TX_CHEFIA_IMEDIATA}" color="#00FF00" style="width:300px;" /></div>  


                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;">
                    <font color="#FF0000"></font> Data do adiamento<font color="#FF0000">{$validar.DT_ADIAMENTO}</font>
                    <input type="text" name="DT_ADIAMENTO" id="DT_ADIAMENTO" value="{$VO->DT_ADIAMENTO}" color="#00FF00" style="width:150px;" /></div>  
            <br />



                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:410px;">
                    <font color="#FF0000"></font>Justificativa do Adiamento<font color="#FF0000">{$validar.TX_JUSTIFICATIVA_ADIAMENTO}</font><br />
                    <textarea name="TX_JUSTIFICATIVA_ADIAMENTO" id="TX_JUSTIFICATIVA_ADIAMENTO"  style="width:920px;"  cols="45" rows="5"> {$VO->TX_JUSTIFICATIVA_ADIAMENTO} </textarea>  </div>




                <br />
                <br />

                <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
