<div id="centro">
    <img src="{$urlimg}icones/{$pasta}.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        {*Mostra Botao de Novo Registro Somente se Tiver Acesso Completo a Tela*}
    {if $acesso}<br /><a href="{$url}src/{$pasta}/cadastrar.php" id="nova_rm"><img src="{$urlimg}icones/novo.png" /></a>{/if}
    <br /><br />
  {*------Órgão Gestor------*}
    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;"><strong><font color="#FF0000">*</font>Órgão Gestor: </strong></div>
    <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:400px;">
        {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
    </select><br />
  
    {*------------Órgão Solicitante---------------*}
    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" ><strong><font color="#FF0000">*</font>Órgão Solicitante: </strong></div>
    <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO" style="width:400px;">
        {html_options options=$arrayOrgaoSolicitante selected=$VO->ID_ORGAO_ESTAGIO}
    </select><br />
 
    {*-----------Agente de Integração----------------*}
    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" ><strong>Agente de Integração: </strong></div>
    <select name="ID_AGENCIA_ESTAGIO" id="ID_AGENCIA_ESTAGIO" style="width:400px;">
        {html_options options=$arraybuscarAgenteIntegracao selected=$VO->ID_AGENCIA_ESTAGIO}
    </select><br />
    
     {*------------Nome do Estagiário---------------*}
    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:159px;" ><strong>Nome do Estagiário: </strong></div>
    <input type="text" name="TX_NOME" id="TX_NOME" value="{$VO->TX_NOME}"  style="width:399px;" /><br />    

     {*------------CPF do Estagiário---------------*}
    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" ><strong>CPF do Estagiário: </strong></div>
    <input type="text" name="NB_CPF" id="NB_CPF" value="{$VO->NB_CPF}"  style="width:200px;" /><br />    

     {*----------Cód. do Contrato-----------------*}
    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" ><strong>Cód. do Contrato: </strong></div>
    <input type="text" name="TX_CODIGO_CONTRATO" id="TX_CODIGO_CONTRATO" value="{$VO->TX_CODIGO_CONTRATO}"  style="width:200px;" /><br /> 
    
     {*----------Código da Solicitação-----------------*}
    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:160px;" ><strong>Código da Solicitação: </strong></div>
    <input type="text" name="TX_CODIGO_SOLICITACAO" id="TX_CODIGO_SOLICITACAO" value="{$VO->TX_CODIGO_SOLICITACAO}"  style="width:200px;" /><br />    
    <br />

    <input type="button" name="pesquisar" id="pesquisar" value="Pesquisar" />

    <script charset="UTF-8" type="text/javascript" language="JavaScript">
        $(document).ready(function(){
        function showLoader(){ $('.fundo_pag').fadeIn(200); }
    function hideLoader(){ $('.fundo_pag').fadeOut(200); };
	
	
if ("{$VO->ID_ORGAO_GESTOR_ESTAGIO}" || "{$VO->ID_ORGAO_ESTAGIO}" ){
showLoader();
                
$("#tabela").load('acoes.php?identifier=tabela',{
ID_ORGAO_GESTOR_ESTAGIO:$('#ID_ORGAO_GESTOR_ESTAGIO').val(),
ID_ORGAO_ESTAGIO:$('#ID_ORGAO_ESTAGIO').val(),
ID_AGENCIA_ESTAGIO:$('#ID_AGENCIA_ESTAGIO').val(),
TX_CODIGO_CONTRATO:$('#TX_CODIGO_CONTRATO').val(),
TX_NOME:$('#TX_NOME').val(),
NB_CPF:$('#NB_CPF').val(),
TX_CODIGO_SOLICITACAO:$('#TX_CODIGO_SOLICITACAO').val(),                
PAGE:"{$VO->PAGE}"
}, hideLoader); 
      
               
}
});
    </script>

    <br /><br />
    <div class="fundo_pag">
        <img src="{$urlimg}icones/loader.gif" alt="">
    </div>

    <div id="tabela"></div><br />

    <br />

</div>

</div>