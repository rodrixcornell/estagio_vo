<style> .ui-combobox input{ width: 400px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Alterar {$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        Para alterar a Solicitação TA preencha o formulário abaixo e clique em Avançar:<br /><br />
        <form name="form" action="{$url}src/{$pasta}/alterar.php" method="post">
            {*------------------*}
            <fieldset>
                <legend>Solicitante</legend>

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:300px;" >Órgão Gestor
                    <input type="text" name="TX_ORGAO_GESTOR_ESTAGIO" id="TX_ORGAO_GESTOR_ESTAGIO" value="{$VO->TX_ORGAO_GESTOR_ESTAGIO}"  style="width:295px;" class="leitura" readonly="readonly" />
                </div>  
                {*--------*}

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:300px;" >Órgão Solicitante
                    <input type="text" name="TX_ORGAO_ESTAGIO" id="TX_ORGAO_ESTAGIO" value="{$VO->TX_ORGAO_ESTAGIO}"  style="width:295px;" class="leitura" readonly="readonly" />
                </div>  
                {*--------*}
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:308px;" >Secretário do Órgão Gestor
                    <input type="text" name="TX_FUNCIONARIO" id="TX_FUNCIONARIO" value="{$VO->SECRETARIO}"  style="width:305px;" class="leitura" readonly="readonly" />
                </div>  
                <br />   
                {*--------*}

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:155px;" >Cód. Contrato
                    <input type="text" name="TX_CODIGO" id="TX_CODIGO" value="{$VO->TX_CODIGO}"  style="width:150px;" class="leitura" readonly="readonly" />
                </div>  

                {*---TX_CODIGO,TX_FUNCIONARIO----*}
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:110px;" >Tipo de Vaga
                    <input type="text" name="TX_TIPO_VAGA_ESTAGIO" id="TX_TIPO_VAGA_ESTAGIO" value="{$VO->TX_TIPO_VAGA_ESTAGIO}"  style="width:105px;" class="leitura" readonly="readonly" />
                </div>  
                {*--------*}
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:155px;" >TCE
                    <input type="text" name="TX_TCE" id="TX_TCE" value="{$VO->TX_TCE}"  style="width:150px;" class="leitura" readonly="readonly" />
                </div>  

                {*--------*}
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:332px;" >Nome do Estagiário
                    <input type="text" name="TX_NOME" id="TX_NOME" value="{$VO->TX_NOME}"  style="width:329px;" class="leitura" readonly="readonly" />
                </div>
                {*--------*}
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" >CPF do Estagiário 
                    <input type="text" name="NB_CPF" id="NB_CPF" value="{$VO->NB_CPF}"  style="width:145px;" class="leitura" readonly="readonly" />
                </div>
                {*--------*}
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:400px;" >Instituição de Ensino 
                    <input type="text" name="TX_INSTITUICAO_ENSINO" id="TX_INSTITUICAO_ENSINO" value="{$VO->TX_INSTITUICAO_ENSINO}"  style="width:395px;" class="leitura" readonly="readonly" />
                </div>  

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:400px;" >Curso 
                    <input type="text" name="TX_CURSO_ESTAGIO" id="TX_CURSO_ESTAGIO" value="{$VO->TX_CURSO_ESTAGIO}"  style="width:395px;" class="leitura" readonly="readonly" />
                </div>  

                {*--------*}
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:110px;" >Período/Ano 
                    <input type="text" name="TX_PERIODO" id="TX_PERIODO" value="{$VO->TX_PERIODO}"  style="width:105px;" class="leitura" readonly="readonly" />
                </div> <br />               
      {*--------------------------------------------*}
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:310px;" >Agente Setorial 
                    <input type="text" name="TX_AGENTE_SETORIAL" id="TX_AGENTE_SETORIAL" value="{$VO->TX_AGENTE_SETORIAL}"  style="width:305px;" class="leitura" readonly="readonly" />
                </div>

      {*---------------------------------------------------*}
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" >Cargo / Função 
                    <input type="text" name="TX_CARGO_AGENTE" id="TX_CARGO_AGENTE" value="{$VO->TX_CARGO_AGENTE}"  style="width:156px;" class="leitura" readonly="readonly" />
                </div>				               
                {*--------*}
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" >Telefone 
                    <input type="text" name="TX_FONE_AGENTE" id="TX_FONE_AGENTE" value="{$VO->TX_FONE_AGENTE}"  style="width:156px;" class="leitura" readonly="readonly">
                </div>                     				
                {*--------*}
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:165px;" >Email 
                    <input type="text" name="TX_EMAIL_AGENTE" id="TX_EMAIL_AGENTE" value="{$VO->TX_EMAIL_AGENTE}"  style="width:160px;" class="leitura" readonly="readonly">
                </div>  

                {*--------*}
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:107px;" ><font color="#FF0000">*</font>Situação <font color="#FF0000">{$validar.CS_SITUACAO}</font>
                    <select name="CS_SITUACAO" id="CS_SITUACAO" style="width:103px;">
                        {html_options options=$arraySituacao selected=$VO->CS_SITUACAO}
                    </select>
                </div><br />

                {*----------*}
                <div id="camada" style="width:720px;"><font color="#FF0000">*</font>Motivo <font color="#FF0000"> {$validar.TX_MOTIVO_SITUACAO} </font><br />     
                    <textarea   maxlength="255" name="TX_MOTIVO_SITUACAO" id="TX_MOTIVO_SITUACAO" rows="2" style="width:710px;" >{$VO->TX_MOTIVO_SITUACAO}</textarea></div>

                <br /><br />

            </fieldset>
            <fieldset>
                {*-------------------------------------------------Alteração----nova vigencia-------------------*}
                <legend>Alterações</legend>

                <input name="VIGENCIA" type="checkbox" id="VIGENCIA" value="1" {if $VO->VIGENCIA}checked{/if} />Nova Vigência  <br />  
                <div id="camada" style="width:150px;"><font color="#FF0000">*</font>Inicio de Vigência<font color="#FF0000"> {$validar.DT_INICIO_PRORROGACAO} </font><br />     
                    <input type="text" name="DT_INICIO_PRORROGACAO" id="DT_INICIO_PRORROGACAO" value="{$VO->DT_INICIO_PRORROGACAO}" style="width:140px; text-align:center;" />
                </div>

                {*-------*}
                <div id="camada" style="width:150px;"><font color="#FF0000">*</font>Fim de Vigência<font color="#FF0000"> {$validar.DT_FIM_PRORROGACAO} </font><br />     
                    <input type="text" name="DT_FIM_PRORROGACAO" id="DT_FIM_PRORROGACAO" value="{$VO->DT_FIM_PRORROGACAO}" style="width:140px; text-align:center;"  />
                </div>

                {*-------*}
                <div id="camada" style="width:110px;">Meses<br />     
                    <input type="text" name="NB_MES" id="NB_MES" value="{$VO->NB_MES}" style="width:100px; text-align:center;"  />
                </div>

                {*-------*}
                <div id="camada" style="width:150px;"><font color="#FF0000">*</font>Inicio de Recesso<font color="#FF0000"> {$validar.DT_INICIO_RECESSO} </font><br />     
                    <input type="text" name="DT_INICIO_RECESSO" id="DT_INICIO_RECESSO" value="{$VO->DT_INICIO_RECESSO}" style="width:140px; text-align:center;"  />
                </div>

                {*-------*}
                <div id="camada" style="width:150px;"><font color="#FF0000">*</font>Fim de Recesso<font color="#FF0000"> {$validar.DT_FIM_RECESSO} </font><br />     
                    <input type="text" name="DT_FIM_RECESSO" id="DT_FIM_RECESSO" value="{$VO->DT_FIM_RECESSO}" style="width:140px; text-align:center;"  />
                </div></br><br />

                {*------------------Aletracao de horarios-------------------------------------*}
                <input name="JORNADA" type="checkbox" id="JORNADA" value="1" {if $VO->JORNADA}checked{/if} />Alteração de Horário <br /> 
                <div id="camada" style="width:150px;"><font color="#FF0000">*</font>Inicio de Vigência<font color="#FF0000"> {$validar.DT_INICIO_JORNADA} </font><br />     
                    <input type="text" name="DT_INICIO_JORNADA" id="DT_INICIO_JORNADA" value="{$VO->DT_INICIO_JORNADA}" style="width:140px; text-align:center;"  />
                </div>

                <div id="camada" style="width:150px;"><font color="#FF0000">*</font>Total de Horas <font color="#FF0000"> {$validar.TX_HORAS_JORNADA} </font><br />     
                    <input type="text" name="TX_HORAS_JORNADA" id="TX_HORAS_JORNADA" value="{$VO->TX_HORAS_JORNADA}" style="width:140px; text-align:center;"  />
                </div>

                <div id="camada" style="width:150px;"><font color="#FF0000">*</font>Horário de Entrada<font color="#FF0000"> {$validar.TX_INICIO_HORARIO} </font><br />     
                    <input type="text" name="TX_INICIO_HORARIO" id="TX_INICIO_HORARIO" value="{$VO->TX_INICIO_HORARIO}" style="width:140px; text-align:center;"  />
                </div>

                <div id="camada" style="width:150px;"><font color="#FF0000">*</font>Horário de Saída<font color="#FF0000"> {$validar.TX_FIM_HORARIO} </font><br />     
                    <input type="text" name="TX_FIM_HORARIO" id="TX_FIM_HORARIO" value="{$VO->TX_FIM_HORARIO}" style="width:140px; text-align:center;"  />
                </div><br /><br />

                {*--------------Alteracao de  bolsa--------------------------------------*}
                <input name="BOLSA" type="checkbox" id="BOLSA" value="1" {if $VO->BOLSA}checked{/if} /></font>Alteração de Bolsa <font color="#FF0000"> {$validar.DT_INICIO_PAG_BOLSA} </font><br />
                <div id="camada" style="width:150px;"><font color="#FF0000">*</font>Inicio de Vigência:<font color="#FF0000"> {$validar.DT_INICIO_PAG_BOLSA} </font><br />     
                    <input type="text" name="DT_INICIO_PAG_BOLSA" id="DT_INICIO_PAG_BOLSA" value="{$VO->DT_INICIO_PAG_BOLSA}" style="width:140px; text-align:center;"  />
                </div>

                <div id="camada" style="width:150px;"><font color="#FF0000">*</font>Valor (R$)<font color="#FF0000"> {$validar.NB_VALOR_BOLSA} </font><br />     
                    <input type="text" name="NB_VALOR_BOLSA" id="NB_VALOR_BOLSA" value="{$VO->NB_VALOR_BOLSA}" style="width:140px; text-align:center;"  />
                </div><br /><br />

                {*-----------Outras Alterações---------------------*}
                <input name="ALTERACOES" type="checkbox" id="ALTERACOES" value="1" {if $VO->ALTERACOES}checked{/if} /><font color="#FF0000"></font>Outras Alterações <br />
                <div id="camada" style="width:720px;"><font color="#FF0000">*</font>Descrever as Outras Alterações:<font color="#FF0000"> {$validar.TX_OUTRAS_ALTERACOES} </font><br />     
                    <textarea maxlength="255" name="TX_OUTRAS_ALTERACOES" id="TX_OUTRAS_ALTERACOES" style="width:710px;" rows="2">{$VO->TX_OUTRAS_ALTERACOES}</textarea></div>
                <br /><br />
                {*--------*}

                <br /><br />

                <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/detail.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>