<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Novo {$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        <form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">
            Para um novo cadastro de Solicitação de TR preencha o formulário abaixo e clique em Avançar:<br /><br />
            <fieldset>
                <legend>Solicitante</legend>

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:300px;" > <font color="#FF0000">*</font>Órgão Gestor<font color="#FF0000">{$validar.ID_ORGAO_GESTOR_ESTAGIO}</font><br />
                    <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:295px;">
                        {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
                    </select>
                </div>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:300px;" > <font color="#FF0000">*</font>Órgão Solicitante<font color="#FF0000">{$validar.ID_ORGAO_ESTAGIO}</font><br />
                    <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO" style="width:295px;">
                        {html_options options=$arrayOrgaoSolicitante selected=$VO->ID_ORGAO_ESTAGIO}
                    </select>
                </div>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:305px;" >Secretário do Órgão Gestor
                    <input type="text" name="TX_FUNCIONARIO" id="TX_FUNCIONARIO" value="{$VO->TX_FUNCIONARIO}"  style="width:300px;" class="leitura" readonly="readonly" />
                </div>  
                <br />              
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:175px;" > <font color="#FF0000">*</font>Cód. Contrato:<font color="#FF0000">{$validar.ID_CONTRATO}</font><br />
                    <select name="ID_CONTRATO" id="ID_CONTRATO" style="width:170px;">
                        {html_options options=$arrayContrato selected=$VO->ID_CONTRATO}
                    </select>
                </div>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:205px;" >Tipo de Vaga
                    <input type="text" name="TX_FUNCIONARIO" id="TX_FUNCIONARIO" value="{$VO->TX_FUNCIONARIO}"  style="width:200px;" class="leitura" readonly="readonly" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:205px;" >TCE
                    <input type="text" name="TX_FUNCIONARIO" id="TX_FUNCIONARIO" value="{$VO->TX_FUNCIONARIO}"  style="width:200px;" class="leitura" readonly="readonly" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:205px;" >Nome do Estagiário
                    <input type="text" name="TX_FUNCIONARIO" id="TX_FUNCIONARIO" value="{$VO->TX_FUNCIONARIO}"  style="width:310px;" class="leitura" readonly="readonly" />
                </div>  
                <br />
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" >CPF do Estagiário
                    <input type="text" name="TX_FUNCIONARIO" id="TX_FUNCIONARIO" value="{$VO->TX_FUNCIONARIO}"  style="width:145px;" class="leitura" readonly="readonly" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:376px;" >Instituição do Estagiário
                    <input type="text" name="TX_FUNCIONARIO" id="TX_FUNCIONARIO" value="{$VO->TX_FUNCIONARIO}"  style="width:371px;" class="leitura" readonly="readonly" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:376px;" >Curso
                    <input type="text" name="TX_FUNCIONARIO" id="TX_FUNCIONARIO" value="{$VO->TX_FUNCIONARIO}"  style="width:371px;" class="leitura" readonly="readonly" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:250px;" >Nível
                    <input type="text" name="TX_FUNCIONARIO" id="TX_FUNCIONARIO" value="{$VO->TX_FUNCIONARIO}"  style="width:245px;" class="leitura" readonly="readonly" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" >Período/Ano
                    <input type="text" name="TX_FUNCIONARIO" id="TX_FUNCIONARIO" value="{$VO->TX_FUNCIONARIO}"  style="width:145px;" class="leitura" readonly="readonly" />
                </div>                  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:250px;" > <font color="#FF0000">*</font>Agente Setorial:<font color="#FF0000">{$validar.CS_TIPO_VAGA_ESTAGIO}</font><br />
                    <select name="CS_TIPO_VAGA_ESTAGIO" id="CS_TIPO_VAGA_ESTAGIO" style="width:245px;">
                        {html_options options=$arrayTipoVagas selected=$VO->CS_TIPO_VAGA_ESTAGIO}
                    </select>
                </div>
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:250px;" > <font color="#FF0000">*</font>Cargo/Função
                    <input type="text" name="TX_CARGO" id="TX_CARGO" value="{$VO->TX_CARGO}"  style="width:243px;"/>
                </div>              
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" ><font color="#FF0000">*</font>Telefone<font color="#FF0000">{$validar.TX_TELEFONE}</font><br />
                    <input type="text" name="TX_TELEFONE" id="TX_TELEFONE" value="{$VO->TX_TELEFONE}"  style="width:150px;" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:270px;" ><font color="#FF0000">*</font>Email
                    <input type="text" name="TX_EMAIL" id="TX_EMAIL" value="{$VO->TX_EMAIL}"  style="width:260px;" />
                </div>  
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:150px;" > <font color="#FF0000">*</font>Data de Desligamento<font color="#FF0000">{$validar.DT_INICIO_VIGENCIA}</font><br />
                    <input type="text" name="DT_INICIO_VIGENCIA" id="DT_INICIO_VIGENCIA" value="{$VO->DT_INICIO_VIGENCIA}"  style="width:140px;" />
                </div>  
            </fieldset>

            <br />

            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />

        </form>

    </div>
</div>