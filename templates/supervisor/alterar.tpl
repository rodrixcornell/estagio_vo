


<style>	.ui-combobox input{	width: 380px;} </style>
<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo"> {$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        Para alterar a Agência de Estágio preencha o formulário abaixo e clique em Salvar:<br /><br /><br />
         
          <form name="form" action="{$url}src/{$pasta}/alterar.php" method="post">

<!-- linha 1 -->
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:420px;">
                <font color="#FF0000"></font>Funcionário <font color="#FF0000">{$validar.TX_NOME}</font><br />
                <input name="TX_NOME" id="TX_NOME" value="{$VO->TX_NOME}" style="width:410px;" disabled="disabled" class="leitura" readonly="readonly">
                </input></div>
            
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:415px;">
                <font color="#FF0000">*</font>Cargo <font color="#FF0000">{$validar.TX_CARGO}</font><br />
                <input type="text" name="TX_CARGO" id="TX_CARGO" value="{$VO->TX_CARGO}" style="width:405px;">
                </input></div><br />
<!-- linha 2 -->
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:420px;">
                <font color="#FF0000">*</font>Formação <font color="#FF0000">{$validar.TX_FORMACAO}</font><br />
                <input type="text" name="TX_FORMACAO" id="TX_FORMACAO" value="{$VO->TX_FORMACAO}" style="width:410px;">
                </input></div>
            
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:270px;">
                <font color="#FF0000">*</font>Conselho Regional <font color="#FF0000">{$validar.ID_CONSELHO}</font><br />
                <select name="ID_CONSELHO" id="ID_CONSELHO" value="{$VO->ID_CONSELHO}" style="width:260px;">
                {html_options options=$arrayConselho selected=$VO->ID_CONSELHO}
                </select></div>
                
            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:140px;">
                <font color="#FF0000">*</font>Num.Inscrição <font color="#FF0000">{$validar.NB_INSCRICAO_CONSELHO}</font><br />
                <input type="text" name="NB_INSCRICAO_CONSELHO" id="NB_INSCRICAO_CONSELHO" value="{$VO->NB_INSCRICAO_CONSELHO}" style="width:130px;" /></div>
                <br />
           <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:415px;">
                <font color="#FF0000">*</font>Curriculo<font color="#FF0000">{$validar.TX_CURRICULO}</font>&nbsp;<br />
    	        <textarea name="TX_CURRICULO" id="TX_CURRICULO" value="{$VO->TX_CURRICULO}" style="width:830px; height:70px;"/>{$VO->TX_CURRICULO}</textarea></div> 
                <br /><br />
          
            <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="window.location.href='{$url}src/{$pasta}/index.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="salvar" id="salvar" value=" Salvar " />
        </form>
    </div>
</div>
   
            
            
            
