<div id="centro">
    <img src="{$urlimg}icones/relatorio.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        
        <form name="form" action="{$url}src/relatorios/recrutamento/index.php" method="post">
            Preencha o formulário abaixo e clique em Gerar.<br /><br />

<!--            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:180px;" ><font color="#FF0000">*</font>Órgão Gestor: </div><br />
            <select name="ID_ORGAO_GESTOR_ESTAGIO" id="ID_ORGAO_GESTOR_ESTAGIO_REL" style="width:300px;">
                {html_options options=$arrayOrgaoGestor selected=$VO->ID_ORGAO_GESTOR_ESTAGIO}
            </select><br />-->

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:290px;" ><font color="#FF0000">*</font>Órgão Solicitante:<font color="#FF0000"> {$validar.ID_ORGAO_ESTAGIO} </font></div><br />
            <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO_REL" style="width:300px;" >
                {html_options options=$arrayOrgaoSolicitanteRel selected=$VO->ID_ORGAO_ESTAGIO}
            </select><br />

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:190px;" > <font color="#FF0000">*</font>Situação<font color="#FF0000"> {$validar.CS_SITUACAO} </font>:</div><br />
            <select name="CS_SITUACAO" id="CS_SITUACAO_REL" style="width:200px;" >
                {html_options options=$arraySituacao selected=$VO->CS_SITUACAO}
            </select><br />   

            <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:240px;" ><font color="#FF0000">*</font>Código do Recrutamento:<font color="#FF0000"> {$validar.ID_RECRUTAMENTO_ESTAGIO} </font></div><br />
            <select name="ID_RECRUTAMENTO_ESTAGIO" id="ID_RECRUTAMENTO_ESTAGIO_REL" style="width:200px;"  disabled="disabled">
                {html_options options=$arraySituacao selected=$VO->ID_RECRUTAMENTO_ESTAGIO_REL}
            </select>
            <br />
            <br />
            <input type="submit" name="gerar" value=" Gerar " />
        </form>

    </div>

</div>
