<div id="centro">
    <img src="{$urlimg}icones/relatorio.png"  id="imgTitulo"/>
    <div id="titulo">{$titulopage}</div>

    <br /><br /><br /><hr />

    <div id="conteudo">
        <form name="form" action="{$url}src/relatorios/quadro_vagas/index.php" method="post">
            Preencha o formulário abaixo e clique em Gerar.<br /><br />

            <div id="camada" style="width:305px;"><font color="#FF0000">*</font>Agência Estágio<font color="#FF0000"> {$validar.ID_AGENCIA_ESTAGIO} </font>&nbsp;<br />
                <select name="ID_AGENCIA_ESTAGIO" id="ID_AGENCIA_ESTAGIO" style="width:300px;">
                    {html_options options=$pesquisarAgenciaestagio selected=$VO->ID_AGENCIA_ESTAGIO}
                </select></div><br />

            <br />

            <br />
            <br />

            <input type="submit" name="gerar" value=" Gerar " />
        </form>


    </div>

</div>