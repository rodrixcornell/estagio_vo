<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Novo {$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        <form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">
            Para um novo cadastro de Solicitação de TR preencha o formulário abaixo e clique em Avançar:<br /><br />
            <fieldset>
                <legend>Solicitante</legend>

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:300px;" > <font color="#FF0000">*</font>Órgão Gestor <font color="#FF0000">{$validar.ID_ORGAO_GESTOR_ESTAGIO}</font><br />
                    <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:295px;">
                        {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
                    </select>
                </div>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:300px;" > <font color="#FF0000">*</font>Órgão Solicitante <font color="#FF0000">{$validar.ID_ORGAO_ESTAGIO}</font><br />
                    <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO" style="width:295px;">
                        {html_options options=$arrayOrgaoSolicitante selected=$VO->ID_ORGAO_ESTAGIO}
                    </select>
                </div>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:305px;" >Secretário do Órgão Gestor
                    <input type="text" name="TX_FUNCIONARIO" id="TX_FUNCIONARIO" value="{$VO->TX_FUNCIONARIO}"  style="width:300px;" class="leitura" readonly="readonly" />
                </div>  
                <br />              
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:175px;" > <font color="#FF0000">*</font>Cód. Contrato <font color="#FF0000">{$validar.ID_CONTRATO}</font><br />
                    <select name="ID_CONTRATO" id="ID_CONTRATO" style="width:170px;">
                        {html_options options=$arrayContrato selected=$VO->ID_CONTRATO}
                    </select>
                </div>                              
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:205px;" >Tipo de Vaga
                    <input type="text" name="TX_TIPO_VAGA_ESTAGIO" id="TX_TIPO_VAGA_ESTAGIO" value="{$VO->TX_TIPO_VAGA_ESTAGIO}"  style="width:200px;" class="leitura" readonly="readonly" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:205px;" >TCE
                    <input type="text" name="TX_TCE" id="TX_TCE" value="{$VO->TX_TCE}"  style="width:200px;" class="leitura" readonly="readonly" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:205px;" >Nome do Estagiário
                    <input type="text" name="TX_NOME" id="TX_NOME" value="{$VO->TX_NOME}"  style="width:310px;" class="leitura" readonly="readonly" />
                </div>  
                <br />
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" >CPF do Estagiário 
                    <input type="text" name="NB_CPF" id="NB_CPF" value="{$VO->NB_CPF}"  style="width:145px;" class="leitura" readonly="readonly" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:376px;" >Instituição do Estagiário 
                    <input type="text" name="TX_INSTITUICAO_ENSINO" id="TX_INSTITUICAO_ENSINO" value="{$VO->TX_INSTITUICAO_ENSINO}"  style="width:371px;" class="leitura" readonly="readonly" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:376px;" >Curso 
                    <input type="text" name="TX_CURSO_ESTAGIO" id="TX_CURSO_ESTAGIO" value="{$VO->TX_CURSO_ESTAGIO}"  style="width:374px;" class="leitura" readonly="readonly" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:250px;" >Nível 
                    <input type="text" name="TX_NIVEL" id="TX_NIVEL" value="{$VO->TX_NIVEL}"  style="width:245px;" class="leitura" readonly="readonly" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" >Período/Ano 
                    <input type="text" name="TX_PERIODO" id="TX_PERIODO" value="{$VO->TX_PERIODO}"  style="width:145px;" class="leitura" readonly="readonly" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:502px;" > <font color="#FF0000">*</font>Agente Setorial <font color="#FF0000">{$validar.ID_SETORIAL_ESTAGIO}</font><br />
                    <select name="ID_SETORIAL_ESTAGIO" id="ID_SETORIAL_ESTAGIO" style="width:502px;">
                        {html_options options=$arraybuscarAgenteSetorial selected=$VO->ID_SETORIAL_ESTAGIO}
                    </select>
                </div>  
                <br />               
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:300px;" > <font color="#FF0000">*</font>Cargo/Função <font color="#FF0000">{$validar.TX_CARGO_AGENTE}</font><br />
                    <input type="text" name=" TX_CARGO_AGENTE" id=" TX_CARGO_AGENTE" value="{$VO-> TX_CARGO_AGENTE}"  style="width:295px;"/>
                </div>              
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" ><font color="#FF0000">*</font>Telefone <font color="#FF0000">{$validar.TX_TELEFONE_AGENTE}</font><br />
                    <input type="text" name="TX_TELEFONE_AGENTE" id="TX_TELEFONE_AGENTE" value="{$VO->TX_TELEFONE_AGENTE}"  style="width:155px;" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:270px;" ><font color="#FF0000">*</font>Email <font color="#FF0000">{$validar.TX_EMAIL_AGENTE}</font>
                    <input type="text" name="TX_EMAIL_AGENTE" id="TX_EMAIL_AGENTE" value="{$VO->TX_EMAIL_AGENTE}"  style="width:265px;" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:165px;" > <font color="#FF0000">*</font>Data de Desligamento <font color="#FF0000">{$validar.DT_TERMINO_ESTAGIO}</font><br />
                    <input type="text" name="DT_TERMINO_ESTAGIO" id="DT_TERMINO_ESTAGIO" value="{$VO->DT_TERMINO_ESTAGIO}"  style="width:165px;" />
                </div>  
            </fieldset>

            <br />

            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />

        </form>

    </div>
</div>