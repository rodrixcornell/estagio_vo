<style>	.ui-combobox input{	width: 100px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />
	
            <div id="conteudo">
                Para cadastrar um novo Estagiário preencha o formulario abaixo e clique em Salvar:<br /><br />
				<form name="form" action="{$url}src/{$pasta}/cadastrar.php" method="post">

				
                <div id="camada" style="width:390px;"><font color="#FF0000">*</font>Nome<font color="#FF0000"> {$validar.TX_NOME} </font></br>
                	<input type="text" name="TX_NOME" id="TX_NOME" value="{$VO->TX_NOME}" style="width:380px;" /></div>

                <div id="camada" style="width:150px;"><font color="#FF0000">*</font>CPF<font color="#FF0000"> {$validar.NB_CPF} </font><br />
                    <input type="text" name="NB_CPF" id="NB_CPF" value="{$VO->NB_CPF}" style="width:120px;" /></div>
                    
                <br />
                 
                <div id="camada" style="width:170px;"> <font color="#FF0000">*</font>RG<font color="#FF0000"> {$validar.NB_RG} </font><br />
                    <input type="text" name="NB_RG" id="NB_RG" value="{$VO->NB_RG}" style="width:160px;" /></div>
                    
                <div id="camada" style="width:175px;"> <font color="#FF0000">*</font>Órgão RG<font color="#FF0000"> {$validar.TX_ORGAO_EMISSOR} </font><br />
                    <input type="text" name="TX_ORGAO_EMISSOR" id="TX_ORGAO_EMISSOR" value="{$VO->TX_ORGAO_EMISSOR}" style="width:165px;" /></div>
                    
                <div id="camada" style="width:170px;"> <font color="#FF0000">*</font>Dt. Emissão RG<font color="#FF0000"> {$validar.DT_EMISSAO} </font><br />
                    <input type="text" name="DT_EMISSAO" id="DT_EMISSAO" value="{$VO->DT_EMISSAO}" style="width:160px;" /></div>
                
                <br />
                    
                <div id="camada" style="width:130px;">Dt. Nascimento<font color="#FF0000"> {$validar.DT_NASCIMENTO} </font><br />
                    <input type="text" name="DT_NASCIMENTO" id="DT_NASCIMENTO" value="{$VO->DT_NASCIMENTO}" style="width:120px;" /></div>
                    
                <div id="camada" style="width:260px;">Localidade do Nascimento<font color="#FF0000"> {$validar.ID_LOCALIDADE_NATAL} </font><br />
                    <select name="ID_LOCALIDADE_NATAL" id="ID_LOCALIDADE_NATAL" style="width:250px;">
                        {html_options options=$arrayLocalidade selected=$VO->ID_LOCALIDADE_NATAL}
                    </select></div>
                    
                <div id="camada" style="width:130px;"><font color="#FF0000">*</font>Sexo<font color="#FF0000"> {$validar.CS_SEXO} </font><br />
                    <select name="CS_SEXO" id="CS_SEXO" style="width:120px;">
                        {html_options options=$arraySexo selected=$VO->CS_SEXO}
                    </select></div>
               
                </br> <br/><br />
                
                <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" name="salvar" id="salvar" value="Salvar" />
</div>
</div>
