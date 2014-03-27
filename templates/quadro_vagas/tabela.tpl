<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">Tabela {$titulopage}</div>
    <br />
    <br />
    <br />
    <hr />
    <fieldset>
    	<legend>CONTROLE DE VAGAS</legend>
    	<fieldset>
    		<legend>VAGAS ESTABELECIDAS</legend>
    		  {$tabelaEstabelecida}	
    	</fieldset>
    	<fieldset>
    		<legend>VAGAS PREENCHIDAS</legend>
    		<table id="tabela" align="center" style="margin-top:3px; collapse; border: solid 1px #CCC;">
    		</table>
    	</fieldset>
    	<fieldset>
    		<legend>VAGAS EM ABERTO</legend>
    		<table id="tabela" align="center" style="margin-top:3px; collapse; border: solid 1px #CCC;">
    		</table> 
    	</fieldset>
    </fieldset>
   
</div>