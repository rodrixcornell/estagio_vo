<style>	.ui-combobox input{ width: 420px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Alterar {$titulopage}</div>

    <br /><br /><br /><hr />
    <div id="conteudo">
        Para alterar a {$titulopage} preencha o formulário abaixo e clique em Salvar:<br /><br />

        <form name="form" action="{$url}src/{$pasta}/alterar.php" method="post">

            <fieldset>
            <legend>Solicitação</legend>
            	<div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" >
                <font color="#FF0000">*</font>Órgão Gestor <font color="#FF0000">{$validar.ID_ORGAO_GESTOR_ESTAGIO}</font>
                <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:200px;">
                    {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
                </select></div>

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:260px;" >
                <font color="#FF0000">*</font>Órgão Solicitante <font color="#FF0000">{$validar.ID_ORGAO_ESTAGIO}</font>
                <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO" style="width:250px;">
                    {html_options options=$arrayOrgaoSolicitante selected=$VO->ID_ORGAO_ESTAGIO}
                </select></div>

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" >
                <font color="#FF0000">*</font>Agência de Estágio <font color="#FF0000">{$validar.ID_AGENCIA_ESTAGIO}</font>
                <select name="ID_AGENCIA_ESTAGIO" id="ID_AGENCIA_ESTAGIO" style="width:200px;">
                    {html_options options=$arrayAgenciaEstagio selected=$VO->ID_AGENCIA_ESTAGIO}
                </select></div>

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" >
                <font color="#FF0000">*</font>Tipo de Vaga <font color="#FF0000">{$validar.CS_TIPO_VAGA_ESTAGIO}</font>
                <select name="CS_TIPO_VAGA_ESTAGIO" id="CS_TIPO_VAGA_ESTAGIO" style="width:200px;">
                    {html_options options=$arrayTipoVaga selected=$VO->CS_TIPO_VAGA_ESTAGIO}
                </select></div>

    {if $gestor}<div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:210px;" >
                <font color="#FF0000">*</font>Situação <font color="#FF0000">{$validar.CS_SITUACAO}</font>
                <select name="CS_SITUACAO" id="CS_SITUACAO" style="width:200px;">
                    {html_options options=$arraySituacao selected=$VO->CS_SITUACAO}
                </select></div>{/if}

                <input type="hidden" name="ID_QUADRO_VAGAS_ESTAGIO" id="ID_QUADRO_VAGAS_ESTAGIO" value="{$VO->ID_QUADRO_VAGAS_ESTAGIO}" /> <br />

            </fieldset><br />

            <fieldset>
            <legend>Dados do Solicitante</legend>
            	<div id="camada" style="width:700px;">Órgão Público Municipal
                <input type="text" name="TX_ORGAO_ESTAGIO" id="TX_ORGAO_ESTAGIO" value="{$VO->TX_ORGAO}" style="width:690px;" class="leitura" readonly="readonly" /></div>

                <div id="camada" style="width:195px;">CNPJ
                <input type="text" name="TX_CNPJ" id="TX_CNPJ" value="{$VO->TX_CNPJ}" style="width:185px;" class="leitura" readonly="readonly" /></div><br />

                <div id="camada" style="width:660px;"><font color="#FF0000">*</font>Pessoa de Contato <font color="#FF0000">{$validar.TX_PESSOA_CONTATO}</font>
                <input type="text" name="TX_PESSOA_CONTATO" id="TX_PESSOA_CONTATO" value="{$VO->TX_PESSOA_CONTATO}" style="width:650px;" /></div>

                <div id="camada" style="width:235px;"><font color="#FF0000">*</font>Telefone <font color="#FF0000">{$validar.TX_TELEFONE}</font>
                <input type="text" name="TX_TELEFONE" id="TX_TELEFONE" value="{$VO->TX_TELEFONE}" style="width:225px;" /></div>

                <div id="camada" style="width:510px;"><font color="#FF0000">*</font>Cargo/Função <font color="#FF0000">{$validar.TX_CARGO_FUNCAO}</font>
                <input type="text" name="TX_CARGO_FUNCAO" id="TX_CARGO_FUNCAO" value="{$VO->TX_CARGO_FUNCAO}" style="width:500px;" /></div>

                <div id="camada" style="width:387px;"><font color="#FF0000">*</font>Email <font color="#FF0000">{$validar.TX_EMAIL}</font>
                <input type="text" name="TX_EMAIL" id="TX_EMAIL" value="{$VO->TX_EMAIL}" style="width:377px;" /></div>
            </fieldset><br />

            <fieldset>
            <legend>Informações da Vaga</legend>
            	<div id="camada" style="width:700px;"><font color="#FF0000">*</font>Endereço para Entrevista <font color="#FF0000">{$validar.TX_ENDERECO}</font>
                <input type="text" name="TX_ENDERECO" id="TX_ENDERECO" value="{$VO->TX_ENDERECO}" style="width:890px;" /></div><br />

                <div id="camada" style="width:660px;">Ponto de Referência <font color="#FF0000">{$validar.TX_PONTO_REFERENCIA}</font>
                <input type="text" name="TX_PONTO_REFERENCIA" id="TX_PONTO_REFERENCIA" value="{$VO->TX_PONTO_REFERENCIA}" style="width:650px;" /></div>

                <div id="camada" style="width:235px;">Nº Ônibus <font color="#FF0000">{$validar.TX_NUM_ONIBUS}</font>
                <input type="text" name="TX_NUM_ONIBUS" id="TX_NUM_ONIBUS" value="{$VO->TX_NUM_ONIBUS}" style="width:225px;" /></div>

                <div id="camada" style="width:130px;"><font color="#FF0000">*</font>Nº Total de Vagas <font color="#FF0000">{$validar.NB_QUANTIDADE}</font>
                <input type="text" name="NB_QUANTIDADE" id="NB_QUANTIDADE" value="{$VO->NB_QUANTIDADE}" style="width:120px; text-align:center;" /></div>

                <div id="camada" style="width:330px;"><font color="#FF0000">*</font>Nº de alunos a serem encaminhados para entrevista <font color="#FF0000">{$validar.NB_QTDE_EMCAMINHADO}</font>
                <input type="text" name="NB_QTDE_EMCAMINHADO" id="NB_QTDE_EMCAMINHADO" value="{$VO->NB_QTDE_EMCAMINHADO}" style="width:320px; text-align:center;" /></div>

                <div id="camada" style="width:150px;"><font color="#FF0000">*</font>Data para Entrevista <font color="#FF0000">{$validar.DT_ENTREVISTA}</font>
                <input type="text" name="DT_ENTREVISTA" id="DT_ENTREVISTA" value="{$VO->DT_ENTREVISTA}" style="width:140px; text-align:center;"/></div>

                <div id="camada" style="width:279px;"><font color="#FF0000">*</font>Horário da Entrevista <font color="#FF0000">{$validar.TX_HORARIO}</font>
                <input type="text" name="TX_HORARIO" id="TX_HORARIO" value="{$VO->TX_HORARIO}" style="width:269px;" /></div>

                <div id="camada" style="width:800px;"><font color="#FF0000">*</font>Duração do Estágio (meses) <font color="#FF0000">{$validar.NB_DURACAO_ESTAGIO}</font><br />
                <input type="text" name="NB_DURACAO_ESTAGIO" id="NB_DURACAO_ESTAGIO" value="{$VO->NB_DURACAO_ESTAGIO}" style="width:175px;" readonly="readonly"/> <strong>(minimo de 06 meses e máximo de 24 meses, conforme Lei n.º 11.788/2008, art. 11)</strong></div>
            </fieldset><br />

            <fieldset>
            <legend>Benefícios ao Estagiário</legend>
            	<div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" >
                <font color="#FF0000">*</font>Valor da Bolsa <font color="#FF0000">{$validar.NB_BOLSA_ESTAGIO}</font>
                <select name="NB_BOLSA_ESTAGIO" id="NB_BOLSA_ESTAGIO" style="width:150px;">
                    {html_options options=$arrayBolsa selected=$VO->NB_BOLSA_ESTAGIO}
                </select></div>

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:300px;" >
                <font color="#FF0000">*</font>Valor do Transporte (R$)<font color="#FF0000"> {$validar.NB_VALOR_TRANSPORTE}</font>
                <input type="text" name="NB_VALOR_TRANSPORTE" id="NB_VALOR_TRANSPORTE" value="{$VO->NB_VALOR_TRANSPORTE}" style="width:160px;" /></div>
            </fieldset><br />

            <fieldset>
            <legend>Requisitos da Oferta</legend>
            	<div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:260px;" >
                <font color="#FF0000">*</font>Nível de Escolaridade <font color="#FF0000">{$validar.CS_ESCOLARIDADE}</font>
                <select name="CS_ESCOLARIDADE" id="CS_ESCOLARIDADE" style="width:250px;">
                    {html_options options=$arrayEscolaridade selected=$VO->CS_ESCOLARIDADE}
                </select></div>

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:460px;" >
                Curso Desejado <font color="#FF0000">{$validar.ID_CURSO_ESTAGIO}</font>
                <select name="ID_CURSO_ESTAGIO" id="ID_CURSO_ESTAGIO" style="width:450px;">
                    {html_options options=$arrayCurso selected=$VO->ID_CURSO_ESTAGIO}
                </select></div>

                <div id="camada" style="width:178px;">Ano/Semestre/Módulo <font color="#FF0000">{$validar.NB_SEMESTRE}</font>
                <input type="text" name="NB_SEMESTRE" id="NB_SEMESTRE" value="{$VO->NB_SEMESTRE}" style="width:168px;" /></div>



                <fieldset style="width:878px;">
            		<legend style="background:none; color:#000; padding-left:2px; padding-right:4px;">Horário do Estágio</legend>

           			<div id="camada" style="width:90px;" ><font color="#FF0000">*</font>Início <font color="#FF0000">{$validar.TX_HORA_INICIO}</font><br />
              		<input type="text" name="TX_HORA_INICIO" id="TX_HORA_INICIO" value="{$VO->TX_HORA_INICIO}"  style="width:80px;" /></div>

           			<div id="camada" style="width:350px;" ><font color="#FF0000">*</font>Fim <font color="#FF0000">{$validar.TX_HORA_FINAL}</font><br />
              		<input type="text" name="TX_HORA_FINAL" id="TX_HORA_FINAL" value="{$VO->TX_HORA_FINAL}"  style="width:80px;" /> (conforme Lei 11.788/2008, art. 10)</div>

                    <div id="camada" style="width:430px;" >Outros Horários (se houver)<font color="#FF0000">{$validar.TX_OUTROS_HORARIOS}</font><br />
              		<input type="text" name="TX_OUTROS_HORARIOS" id="TX_OUTROS_HORARIOS" value="{$VO->TX_OUTROS_HORARIOS}"  style="width:420px;" /></div>
            	</fieldset>

            </fieldset><br />

            <fieldset>
            <legend>Habilidades do Aluno</legend>
            	<fieldset style="width:878px;">
            		<legend style="background:none; color:#000; padding-left:2px; padding-right:4px;">Informática Básica</legend>
						<input type="checkbox" name="CS_WINDOWS" id="CS_WINDOWS" value="1" {if $VO->CS_WINDOWS} checked {/if} /> <div id="camada" style="width:100px;">Windows</div>
           				<input type="checkbox" name="CS_WORD" id="CS_WORD" value="1" {if $VO->CS_WORD} checked {/if} /> <div id="camada" style="width:100px;">Word</div>
                        <input type="checkbox" name="CS_EXCEL" id="CS_EXCEL" value="1" {if $VO->CS_EXCEL} checked {/if}  /> <div id="camada" style="width:100px;">Excel</div>
                        <input type="checkbox" name="CS_POWERPOINT" id="CS_POWERPOINT" value="1" {if $VO->CS_POWERPOINT} checked {/if}  /> <div id="camada" style="width:100px;">Power Point</div>
                        <input type="checkbox" name="CS_INTERNET" id="CS_INTERNET" value="1" {if $VO->CS_INTERNET} checked {/if} /> <div id="camada" style="width:100px;">Internet</div>
            	</fieldset> <br />

                <fieldset style="width:878px;">
            		<legend style="background:none; color:#000; padding-left:2px; padding-right:4px;">Informática Avançada</legend>
						<input type="checkbox" name="CS_CORELDRAW" id="CS_CORELDRAW" value="1" {if $VO->CS_CORELDRAW} checked {/if} /> <div id="camada" style="width:100px;">Corel Draw</div>
           				<input type="checkbox" name="CS_PHOTOSHOP" id="CS_PHOTOSHOP" value="1" {if $VO->CS_PHOTOSHOP} checked {/if} /> <div id="camada" style="width:100px;">Photoshop</div>
                        <input type="checkbox" name="CS_WEBDESIGN" id="CS_WEBDESIGN" value="1" {if $VO->CS_WEBDESIGN} checked {/if} /> <div id="camada" style="width:100px;">Web design</div>
                        <input type="checkbox" name="CS_AUTOCAD" id="CS_AUTOCAD" value="1" {if $VO->CS_AUTOCAD} checked {/if} /> <div id="camada" style="width:100px;">AutoCAD</div>
            	</fieldset> <br />

                <fieldset style="width:878px;">
            		<legend style="background:none; color:#000; padding-left:2px; padding-right:4px;">Língua Estrangeira</legend>
						<input type="checkbox" name="CS_INGLES" id="CS_INGLES" value="1" {if $VO->CS_INGLES} checked {/if} /> <div id="camada" style="width:100px;">Inglês</div>
           				<input type="checkbox" name="CS_ESPANHOL" id="CS_ESPANHOL" value="1" {if $VO->CS_ESPANHOL} checked {/if} /> <div id="camada" style="width:100px;">Espanhol</div>
                        <input type="checkbox" name="CS_FRANCES" id="CS_FRANCES" value="1" {if $VO->CS_FRANCES} checked {/if} /> <div id="camada" style="width:100px;">Francês</div>
                        <input type="checkbox" name="CS_ALEMAO" id="CS_ALEMAO" value="1" {if $VO->CS_ALEMAO} checked {/if} /> <div id="camada" style="width:100px;">Alemão</div>

                        <div id="camada" style="width:350px;" >Outra:<font color="#FF0000">{$validar.TX_OUTRAS_LINGUAS}</font>
              			<input type="text" name="TX_OUTRAS_LINGUAS" id="TX_OUTRAS_LINGUAS" value="{$VO->TX_OUTRAS_LINGUAS}"  style="width:300px;" /></div>
            	</fieldset>

                <div id="camada" style="width:710px;" >Outros Pré-Requisitos Desejáveis<font color="#FF0000">{$validar.TX_OUTROS_REQUISITOS}</font><br />
              	<input type="text" name="TX_OUTROS_REQUISITOS" id="TX_OUTROS_REQUISITOS" value="{$VO->TX_OUTROS_REQUISITOS}"  style="width:700px;" /></div>

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" >
                Sexo <font color="#FF0000">{$validar.CS_SEXO}</font>
                <select name="CS_SEXO" id="CS_SEXO" style="width:150px;">
                    {html_options options=$arraySexo selected=$VO->CS_SEXO}
                </select></div>

            </fieldset><br />

            <fieldset>
            <legend>Principais atividades a serem desempenhadas pelo Estagiário</legend>
            	<div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:910px;" >
                <font color="#FF0000">*</font>Principais Atividades <font color="#FF0000">{$validar.TX_ATIVIDADES}</font>
                <textarea name="TX_ATIVIDADES" id="TX_ATIVIDADES" style="width:900px; height:100px;">{$VO->TX_ATIVIDADES}</textarea></div>

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:910px;" >
                Observações <font color="#FF0000">{$validar.TX_OBSERVACAO}</font>
                <input type="text" name="TX_OBSERVACAO" id="TX_OBSERVACAO" value="{$VO->TX_OBSERVACAO}"  style="width:900px;" /></div>

            </fieldset>

            <br /><br />

            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/detail.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
