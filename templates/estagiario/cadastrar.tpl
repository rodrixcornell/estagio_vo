<style>	.ui-combobox input{	width: 100px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Novo {$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        Para cadastrar um novo Estagiário preencha o formulário abaixo e clique em Salvar:<br /><br />
        <form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">

            <div id="camada" style="width:390px;"><font color="#FF0000">*</font>Nome<font color="#FF0000"> {$validar.TX_NOME} </font></br>
                <input type="text" name="TX_NOME" id="TX_NOME" value="{$VO->TX_NOME}" style="width:380px;" /></div>

            <div id="camada" style="width:110px;"><font color="#FF0000">*</font>CPF<font color="#FF0000"> {$validar.NB_CPF} </font><br />
                <input type="text" name="NB_CPF" id="NB_CPF" value="{$VO->NB_CPF}" style="width:100px;" /></div>

            <div id="camada" style="width:110px;">RG<font color="#FF0000"> {$validar.NB_RG} </font><br />
                <input type="text" name="NB_RG" id="NB_RG" value="{$VO->NB_RG}" style="width:100px;" /></div>

            <div id="camada" style="width:130px;"><font color="#FF0000">*</font>Dt. Nascimento<font color="#FF0000"> {$validar.DT_NASCIMENTO} </font><br />
                <input type="text" name="DT_NASCIMENTO" id="DT_NASCIMENTO" value="{$VO->DT_NASCIMENTO}" style="width:120px;" /></div>

            <div id="camada" style="width:130px;"><font color="#FF0000">*</font>Sexo<font color="#FF0000"> {$validar.CS_SEXO} </font><br />
                <select name="CS_SEXO" id="CS_SEXO" style="width:120px;">
                    {html_options options=$arraySexo selected=$VO->CS_SEXO}
                </select></div>

			<br />
            <div id="camada" style="width:110px;"><font color="#FF0000">*</font>CEP<font color="#FF0000"> {$validar.TX_CEP}
            	<div id="carregando" style="display:none; float:right;">Verificando...</div></font><br />
                <input type="text" name="TX_CEP" id="TX_CEP" value="{$VO->TX_CEP}" style="width:100px;" /></div>
            {*<div id="carregando" style="display:none"><img src="{$urlimg}botoes/ajax-loader.gif" /> Verificando CEP ...</div>*} 
                
            <div id="camada" style="width:390px;" >Endereço<font color="#FF0000"> {$validar.TX_ENDERECO}</font><br />
                <input type="text" name="TX_ENDERECO" id="TX_ENDERECO" style="width:380px;" value="{$VO->TX_ENDERECO}" {*class="leitura" readonly="readonly"*} /></div>

			<div id="camada" style="width:90px;" >Nº<font color="#FF0000"> {$validar.NB_NUMERO}</font><br />
                <input type="text" name="NB_NUMERO" id="NB_NUMERO" style="width:80px;" value="{$VO->NB_NUMERO}" /></div>

			<div id="camada" style="width:390px;" >Complemento<font color="#FF0000"> {$validar.TX_COMPLEMENTO}</font><br />
                <input type="text" name="TX_COMPLEMENTO" id="TX_COMPLEMENTO" style="width:380px;" value="{$VO->TX_COMPLEMENTO}" /></div>

			<div id="camada" style="width:280px;" >Bairro<font color="#FF0000"> {$validar.TX_BAIRRO}</font><br />
                <input type="text" name="TX_BAIRRO" id="TX_BAIRRO" style="width:280px;" value="{$VO->TX_BAIRRO}" /></div>

			<br />
            <div id="camada" style="width:265px;"><font color="#FF0000">*</font>Curso<font color="#FF0000"> {$validar.ID_CURSO_ESTAGIO} </font><br />
                <select name="ID_CURSO_ESTAGIO" id="ID_CURSO_ESTAGIO" style="width:260px;">
                    {html_options options=$arrayCurso selected=$VO->ID_CURSO_ESTAGIO}
                </select></div>

            <div id="camada" style="width:120px;">Periodo<font color="#FF0000"> {$validar.NB_PERIODO_ANO} </font><br />
                <input type="text" name="NB_PERIODO_ANO" id="NB_PERIODO_ANO" value="{$VO->NB_PERIODO_ANO}" style="width:110px;" /></div>

            <div id="camada" style="width:130px;"><font color="#FF0000">*</font>Turno<font color="#FF0000"> {$validar.CS_TURNO} </font><br />
                <select name="CS_TURNO" id="CS_TURNO" style="width:120px;">
                    {html_options options=$arrayTurno selected=$VO->CS_TURNO}
                </select></div>

            <div id="camada" style="width:150px;">Cód. da Oferta de Vaga<font color="#FF0000"> {$validar.ID_OFERTA_VAGA} </font><br />
                <select name="ID_OFERTA_VAGA" id="ID_OFERTA_VAGA" style="width:140px;">
                    {html_options options=$arrayOfertaVaga selected=$VO->ID_OFERTA_VAGA}
                </select></div>

            </br> <br/><br />

            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href = '{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value="Salvar" />
    </div>
</div>
