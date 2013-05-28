<style>	.ui-combobox input{ width: 400px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Alterar {$titulopage}</div>

    <br /><br /><br /><hr />
	
            <div id="conteudo">
                Para alterar um estagiário preencha o formulario abaixo e clique em Salvar:<br /><br /><br />
				<form name="form" action="{$url}src/{$pasta}/alterar.php" method="post">

                
               
                 <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" ><strong>*Nome:</strong><font color="#FF0000">{$validar.TX_NOME}</font></div>
                    <input type="text" name="TX_NOME" id="TX_NOME" value="{$VO->TX_NOME}" style="width:400px;" />
				
                 <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:50px;" ><strong>*CPF:</strong><font color="#FF0000">{$validar.NB_CPF}</font></div>
                    <input type="text" name="NB_CPF" id="NB_CPF" value="{$VO->NB_CPF}" style="width:100px;" />

                 <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:50px;" ><strong>*RG:</strong><font color="#FF0000">{$validar.NB_RG}</font></div>
                    <input type="text" name="NB_RG" id="NB_RG" value="{$VO->NB_RG}" style="width:100px;" /><br /><br />

                 <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" ><strong>*Órgão RG:</strong><font color="#FF0000">{$validar.TX_ORGAO_EMISSOR}</font></div>
                    <input type="text" name="TX_ORGAO_EMISSOR" id="TX_ORGAO_EMISSOR" value="{$VO->TX_ORGAO_EMISSOR}" style="width:100px;" />

                 <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:120px;" ><strong>*Dt. Emissão RG:</strong><font color="#FF0000">{$validar.DT_EMISSAO}</font></div>
                    <input type="text" name="DT_EMISSAO" id="DT_EMISSAO" value="{$VO->DT_EMISSAO}" style="width:100px;" />

                 <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:120px;" ><strong>Dt. Nascimento:</strong></div>
                    <input type="text" name="DT_NASCIMENTO" id="DT_NASCIMENTO" value="{$VO->DT_NASCIMENTO}" style="width:100px;" /><br /><br />

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" ><strong>Localidade do Nascimento: </strong></div>
                    <select name="ID_LOCALIDADE_NATAL" id="ID_LOCALIDADE_NATAL" style="width:250px;">
                        {html_options options=$arrayLocalidade selected=$VO->ID_LOCALIDADE_NATAL}
                    </select>
                
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:50px;" ><strong>*Sexo: </strong><font color="#FF0000">{$validar.CS_SEXO}</font></div>
                    <select name="CS_SEXO" id="CS_SEXO" style="width:50px;">
                        {html_options options=$arraySexo selected=$VO->CS_SEXO}
                    </select>
                
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:90px;" ><strong>Funcionário: </strong><font color="#FF0000">{$validar.ID_PESSOA_FUNCIONARIO}</font></div>
                    <select name="ID_PESSOA_FUNCIONARIO" id="ID_PESSOA_FUNCIONARIO" style="width:270px;">
                        {html_options options=$arrayFuncionario selected=$VO->ID_PESSOA_FUNCIONARIO}
                    </select><br />

                <br /><br />
                <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" name="salvar" id="salvar" value="Salvar" />
</div>
</div>
