<style>	.ui-combobox input{	width: 410px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Alterar {$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        Para alterar um Supervisor de Estágio preencha o formulário abaixo e clique em Salvar:<br /><br />
         
          <form name="form" action="{$url}src/{$pasta}/alterar.php" method="post">

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:420px;">
                <font color="#FF0000">*</font>Funcionário <font color="#FF0000">{$validar.ID_PESSOA_FUNCIONARIO}</font><br />
                <select name="ID_PESSOA_FUNCIONARIO" id="ID_PESSOA_FUNCIONARIO" value="{$VO->ID_PESSOA_FUNCIONARIO}" style="width:410px;">
                	{html_options options=$arrayFuncionario selected=$VO->ID_PESSOA_FUNCIONARIO}
                </select></div>
            
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:270px;">
                <font color="#FF0000">*</font>Cargo <font color="#FF0000">{$validar.TX_CARGO}</font><br />
                <input type="text" name="TX_CARGO" id="TX_CARGO" value="{$VO->TX_CARGO}" style="width:260px;">                   
                </input></div>
                
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:140px;">
                <font color="#FF0000">*</font>Tempo Experiência <font color="#FF0000">{$validar.TX_TEMPO_EXPERIENCIA}</font><br />
                <input type="text" name="TX_TEMPO_EXPERIENCIA" id="TX_TEMPO_EXPERIENCIA" value="{$VO->TX_TEMPO_EXPERIENCIA}" style="width:130px;" /></div>
                <br />
<!-- linha 2 -->
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:420px;">
                <font color="#FF0000">*</font>Formação <font color="#FF0000">{$validar.TX_FORMACAO}</font><br />
                <input type="text" name="TX_FORMACAO" id="TX_FORMACAO" value="{$VO->TX_FORMACAO}" style="width:410px;">
                </input></div>
            
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:270px;">
                Conselho Regional <font color="#FF0000">{$validar.ID_CONSELHO}</font><br />
                <select name="ID_CONSELHO" id="ID_CONSELHO" value="{$VO->ID_CONSELHO}" style="width:260px;">
                {html_options options=$arrayConselho selected=$VO->ID_CONSELHO}
                </select></div>
                
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:140px;">
                Num. Inscrição <font color="#FF0000">{$validar.NB_INSCRICAO_CONSELHO}</font><br />
                <input type="text" name="NB_INSCRICAO_CONSELHO" id="NB_INSCRICAO_CONSELHO" value="{$VO->NB_INSCRICAO_CONSELHO}" style="width:130px;" /></div>
                <br />
               
             <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:140px;">
                <font color="#FF0000">*</font>Email <font color="#FF0000">{$validar.TX_EMAIL}</font><br />
                <input type="text" name="TX_EMAIL" id="TX_EMAIL" value="{$VO->TX_EMAIL}" style="width:410px;" /></div>
                <br />
                
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:835px;">
                Curriculo<font color="#FF0000">{$validar.TX_CURRICULO}</font>&nbsp;<br />
    	        <textarea name="TX_CURRICULO" id="TX_CURRICULO" value="{$VO->TX_CURRICULO}" style="width:825px; height:400px;"/>{$VO->TX_CURRICULO}</textarea></div> 
                </br> <br/><br />

            <input type="hidden" name="ID_PESSOA_SUPERVISOR_ANT" id="ID_PESSOA_SUPERVISOR_ANT" value="{$VO->ID_PESSOA_SUPERVISOR}" />
            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
   
            
            
            
