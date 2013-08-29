<div id="centro">
    <img src="{$urlimg}icones/relatorio.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />
	
        <div id="conteudo">
          <form name="form" action="{$url}src/relatorios/recrutamento/index.php" method="post">
                 Preencha o formulário abaixo e clique em Gerar.<br /><br />
    
				
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" ><font color="#FF0000">*</font>Órgão Gestor: </div><br />
                    <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO" style="width:300px;">
                        {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
                    </select><br />

                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" ><font color="#FF0000">*</font>Órgão Solicitante:</div><br />
                    <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO" style="width:300px;">
                        {html_options options=$arrayOrgaoSolicitante selected=$VO->ID_ORGAO_ESTAGIO}
                    </select><br />
                    
                <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" >Situação:</div><br />
                    <select name="CS_SITUACAO" id="CS_SITUACAO" style="width:200px;">
                        {html_options options=$arraySituacao selected=$VO->CS_SITUACAO}
                    </select><br />   

                 <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" >Código do Recrutamento:</div><br />
                    <input type="text" name="TX_COD_RECRUTAMENTO" id="TX_COD_RECRUTAMENTO" value="{$VO->TX_COD_RECRUTAMENTO}" style="width:200px;" /><br />
                    <br />
                                
<script charset="UTF-8" type="text/javascript" language="JavaScript">
$(document).ready(function(){
	function showLoader(){ $('.fundo_pag').fadeIn(200); }
	function hideLoader(){ $('.fundo_pag').fadeOut(200); };
	
	
	if ("{$VO->ID_ORGAO_GESTOR_ESTAGIO}" && "{$VO->ID_ORGAO_ESTAGIO}" ){
		showLoader();
		$("#tabela").load('acoes.php?identifier=tabela',{
			ID_ORGAO_GESTOR_ESTAGIO:"{$VO->ID_ORGAO_GESTOR_ESTAGIO}",
			ID_ORGAO_ESTAGIO:"{$VO->ID_ORGAO_ESTAGIO}",
			CS_SITUACAO:"{$VO->CS_SITUACAO}",
			TX_COD_RECRUTAMENTO:"{$VO->TX_COD_RECRUTAMENTO}",
			PAGE:"{$VO->PAGE}"
		}, hideLoader); 
	}
	
});
</script>

                
            
                
           <input type="submit" name="gerar" value=" Gerar " />
        </form>
                

     </div>

</div>
   