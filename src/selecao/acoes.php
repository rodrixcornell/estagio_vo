<?php
include "../../php/define.php";
require_once $path."src/selecao/arrays.php";
require_once $pathvo . "selecaoVO.php";

$modulo = 79;
$programa = 6;

require_once "../autenticacao/validaPermissao.php";

session_start();

function gerarTabela($param = '') {
    include "../../php/define.php";
    require_once $pathvo . "selecaoVO.php";
    global $arraySituacaoCandidato;
    $acesso = $GLOBALS['acesso']; //Acessar a Variavel global;

    $VO = new selecaoVO();

    $VO->ID_SELECAO_ESTAGIO = $_SESSION['ID_SELECAO_ESTAGIO'];
    $page = $_REQUEST['PAGE'];

    $VO->verificarContrato() ? $acesso = 0 : false;

    $qtd = 15;
    !$page ? $page = 1 : false;
    $primeiro = ($page * $qtd) - $qtd;

    $total = $VO->buscarCandidatoVaga();

    $total_page = ceil($total / $qtd);

    $VO->Reg_inicio = $primeiro;
    $VO->Reg_quantidade = $qtd;
    $tot_da_pagina = $VO->buscarCandidatoVaga();

    echo '
        <table width="100%" id="tabelaItens" >
            <tr>
                <th>Candidato</th>
                <th>CPF</th>
                <th>Situação</th>
                <th>Motivo</th>
        ';

    //Somente ver a coluna de alterar se tiver acesso completo a tela
    if ($acesso)
        echo '<th style="width:50px;"></th>';

    echo '</tr>';

    if ($tot_da_pagina) {
        $dados = $VO->getVetor();

        for ($i = 0; $i < $tot_da_pagina; $i++) {

            ($bgcolor == '#F0F0F0') ? $bgcolor = '#DDDDDD' : $bgcolor = '#F0F0F0';

            echo '<tr bgcolor="' . $bgcolor . '" onmouseover="mudarCor(this);" onmouseout="mudarCor(this);">
                <td align="center" style="width:240px;">' . $dados['TX_NOME'][$i] . '</td>
                <td align="center">' . $dados['NB_CPF'][$i] . '</td>
                <td align="center" style="width:80px;">' . $arraySituacaoCandidato[$dados['CS_SITUACAO'][$i]] . '</td>
                <td align="center">' . $dados['TX_MOTIVO_SITUACAO'][$i] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela
            if ($acesso) {
                echo '<td align="center" class="icones">';
                echo '<a href="' . $dados['ID_PESSOA_ESTAGIARIO'][$i] . '" id="alterarCandidato" ><img src="' . $urlimg . 'icones/alterarItem.png" title="Alterar Registro"/></a>';
                echo '<a href="' . $dados['ID_PESSOA_ESTAGIARIO'][$i] . '" id="excluirCandidato" ><img src="' . $urlimg . 'icones/excluirItem.png" title="Excluir Registro"/></a></td>';
            }
        }

        echo '</tr>';

        echo '</table>';

        if ($acesso) {
            echo '
                <div id="camada2" style="margin-top:4px; text-align:right; ">
                    <input type="button" name="efetivar" id="efetivar" value=" Efetivar Seleção " /></div>';
        }

        if ($total_page > 1) {
            echo '<div id="paginacao" align="center">
					<ul>';

            for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $page)
                    echo '<li id="' . $i . '" class="selecionado">' . $i . '</li>';
                else
                    echo '<li id="' . $i . '">' . $i . '</li>';
            }
            echo '</ul></div><br><br>';
        }
    }
    else
        echo '<tr><td colspan="5" class="nenhum">Nenhum registro encontrado.</td></tr></table><br /> ';

    if ($param)
        echo '<script>alert("' . $param . '")</script>';
}
//------------------------------------------------------------------------------

$VO = new selecaoVO();

if ($_REQUEST['identifier'] == "tabela") {

    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_REQUEST['ID_ORGAO_GESTOR_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];
    $VO->ID_OFERTA_VAGA = $_REQUEST['ID_OFERTA_VAGA'];
    $VO->CS_SITUACAO = $_REQUEST['CS_SITUACAO'];
    $VO->TX_COD_SELECAO = $_REQUEST['TX_COD_SELECAO'];
    $page = $_REQUEST['PAGE'];

    $VO->preencherSessionPesquisar($_REQUEST);

    $qtd = 15;
    !$page ? $page = 1 : false;
    $primeiro = ($page * $qtd) - $qtd;

    $total = $VO->pesquisar();

    $total_page = ceil($total / $qtd);

    $VO->Reg_inicio = $primeiro;
    $VO->Reg_quantidade = $qtd;
    $tot_da_pagina = $VO->pesquisar();

    if ($tot_da_pagina) {

        $dados = $VO->getVetor();

        echo '<table width="100%" class="dataGrid">
                <th>Código Seleção</th>
                <th>Órgão Gestor</th>
                <th>Órgão Solicitante</th>
                <th>Tipo</th>
                <th>Código Oferta de Vaga</th>
                <th>Quadro de Vagas</th>
                <th>Situação</th>
             ';
        //Somente ver a coluna de alterar se tiver acesso completo a tela
        //if ($acesso)
        echo '<th style="width:30px;"></th>';
        echo '</tr>';

        for ($i = 0; $i < $tot_da_pagina; $i++) {
            ($bgcolor == '#E6E6E6') ? $bgcolor = '#F0EFEF' : $bgcolor = '#E6E6E6';

            echo '<tr bgcolor="' . $bgcolor . '">
                <td align="center">' . $dados['TX_COD_SELECAO'][$i] . '</td>
                <td align="center">' . $dados['TX_ORGAO_GESTOR_ESTAGIO'][$i] . '</td>
                <td align="center">' . $dados['TX_ORGAO_ESTAGIO'][$i] . '</td>
                <td align="center">' . $dados['TX_SELECAO'][$i] . '</td>
                <td align="center">' . $dados['TX_CODIGO_OFERTA_VAGA'][$i] . '</td>
                <td align="center">' . $dados['TX_CODIGO'][$i] . '</td>
                <td align="center">' . $dados['TX_SITUACAO'][$i] . '</td>';

            //Somente ver a coluna de alterar se tiver acesso completo a tela
            // if ($acesso)
            echo '<td align="center">
		  <a href="' . $dados['ID_SELECAO_ESTAGIO'][$i] . '" id="alterar"><img src="' . $urlimg . 'icones/editar.png" alt="itens" title="Visualizar"/></a></td>';

            echo '</tr>';
        }

        echo '</table>';

        if ($total_page > 1) {
            echo '<div id="paginacao" align="center">
					<ul>';

            for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $page)
                    echo '<li id="' . $i . '" class="selecionado">' . $i . '</li>';
                else
                    echo '<li id="' . $i . '">' . $i . '</li>';
            }
            echo '	</ul>
				  </div>';
        }
    }else {
        echo '<div id="nao_encontrado">Nenhum registro encontrado.</div>';
    }
} else if ($_REQUEST['identifier'] == "buscarOfertaVaga") {

    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];
    $total = $VO->buscarOfertaVaga();

    echo '<option value="">Escolha...</option>';
    if ($total) {
        $dados = $VO->getVetor();
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_CODIGO_OFERTA_VAGA'][$i] . '</option>';
        }
    }
} else if ($_REQUEST['identifier'] == "tabelaCandidato") {
    gerarTabela();
} else if ($_REQUEST['identifier'] == "atualizarInf") {

    $VO->ID_SELECAO_ESTAGIO = $_SESSION['ID_SELECAO_ESTAGIO'];

    $dados = $VO->atualizarInf();

    echo json_encode($dados);
}
else if ($_REQUEST['identifier'] == "formInserirCandidato") {?>

    <script>
        $(document).ready(function() {
            function validarCPF(cpf) {
                exp = /\.|-/g;
                cpf = cpf.toString().replace(exp, "");
                var digitoDigitado = eval(cpf.charAt(9) + cpf.charAt(10));
                var digitoGerado = 0;
                var soma1 = 0, soma2 = 0;
                var vlr = 11;

                for (i = 0; i < 9; i++) {
                    soma1 += eval(cpf.charAt(i) * (vlr - 1));
                    soma2 += eval(cpf.charAt(i) * vlr);
                    vlr--;
                }

                soma1 = (soma1 % 11) < 2 ? 0 : 11 - (soma1 % 11);
                aux = soma1 * 2;
                soma2 = soma2 + aux;
                soma2 = (soma2 % 11) < 2 ? 0 : 11 - (soma2 % 11);

                if (cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555"
                    || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999" || cpf == "00000000000") {
                    digitoGerado = null;
                } else {
                    digitoGerado = eval(soma1.toString().charAt(0) + soma2.toString().charAt(0));
                }

                if (digitoGerado != digitoDigitado) {
                    return false;
                }
                return true;
            }

            $("#TX_NOME,#NB_RG,#DT_NASCIMENTO,#CS_SEXO,#TX_CEP,#TX_ENDERECO,#NB_NUMERO,#TX_BAIRRO,#TX_COMPLEMENTO").val('');
            $("#TX_CONTATO,#TX_EMAIL,#TX_AGENCIA,#TX_CONTA_CORRENTE,#ID_PESSOA_ESTAGIARIO").val('');
            $('#NB_CPF,#NB_RG').setMask({mask: '99999999999'});
            $('#TX_AGENCIA,#TX_CONTA_CORRENTE').setMask({mask: '***********'});
            $('#TX_CEP').setMask({mask: '999999999'});
            $('#NB_NUMERO,#NB_PERIODO_ANO').setMask({mask: '*****'});
            $('#DT_NASCIMENTO').setMask({mask: '99/99/9999'});
            $('#DT_NASCIMENTO').datepicker({
                changeMonth: true,
                changeYear: true
            });

            $('#NB_INICIO_HORARIO,#NB_FIM_HORARIO').setMask({mask: '99:99'});
            $('#NB_INICIO_HORARIO,#NB_FIM_HORARIO').timepicker();

            //CPF
            $("#NB_CPF").live('blur', function() {
                //if($.trim($('#NB_CPF').val()) != ""){
                if(validarCPF($("#NB_CPF").val())){
                    $("#carregando1").show();
                    $.getJSON('acoes.php',{
                        NB_CPF:$('#NB_CPF').val(),
                        identifier:'buscarCPF'
                    }, function(campo) {
                        //console.log();
                        if(campo['ID_PESSOA'] != 0){
                            $("#TX_NOME").val(campo['TX_NOME'][0]);
                            $("#NB_RG").val(campo['NB_RG'][0]);
                            $("#DT_NASCIMENTO").val(campo['DT_NASCIMENTO'][0]);
                            $("#CS_SEXO").val(campo['CS_SEXO'][0]);
                            $("#TX_CEP").val(campo['TX_CEP'][0]);
                            $("#TX_ENDERECO").val(campo['TX_ENDERECO'][0]);
                            $("#NB_NUMERO").val(campo['NB_NUMERO'][0]);
                            $("#TX_BAIRRO").val(campo['TX_BAIRRO'][0]);
                            $("#TX_COMPLEMENTO").val(campo['TX_COMPLEMENTO'][0]);
                            $("#TX_CONTATO").val(campo['TX_CONTATO'][0]);
                            $("#TX_EMAIL").val(campo['TX_EMAIL'][0]);
                            $("#TX_AGENCIA").val(campo['TX_AGENCIA'][0]);
                            $("#TX_CONTA_CORRENTE").val(campo['TX_CONTA_CORRENTE'][0]);
                            $("#ID_PESSOA_ESTAGIARIO").val(campo['ID_PESSOA_ESTAGIARIO'][0]);
                            $("#ID_PESSOA").val(campo['ID_PESSOA'][0]);
                            $("#carregando1").hide();
                            $(".salvar").focus();
                        }else{
                            //$("#TX_NOME,#NB_RG,#DT_NASCIMENTO,#CS_SEXO,#TX_CEP,#TX_ENDERECO,#NB_NUMERO,#TX_BAIRRO,#TX_COMPLEMENTO").val('');
                            //$("#TX_CONTATO,#TX_EMAIL,#TX_AGENCIA,#TX_CONTA_CORRENTE,#ID_PESSOA_ESTAGIARIO").val('');
                            $("#ID_PESSOA,#ID_PESSOA_ESTAGIARIO").val('');
                            $("#carregando1").hide();
                            //$("#TX_NOME").focus();
                        }
                    });
                }else{
                    alert('CPF Inválido!');
                    //$("#NB_CPF").val('');
                    //$("#NB_CPF").focus();
                    $(".cancelar").focus();
                }
            });

            //CEP
            $('#TX_CEP').blur(function() {
                if($.trim($('#TX_CEP').val()) != ""){
                    $("#carregando2").show();
                    $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$('#TX_CEP').val(), function(){
                        if(resultadoCEP["resultado"] != 0){
                            //$('#TX_UF]').val(unescape(resultadoCEP["uf"]));
                            //$('#TX_MUNICIPIO]').val(unescape(resultadoCEP["cidade"]));
                            $('#TX_BAIRRO').val(unescape(resultadoCEP["bairro"]));
                            $('#TX_ENDERECO').val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
                            $("#carregando2").hide();
                            $('#NB_NUMERO').focus();
                        }else{
                            alert('Cep não encontrado, por favor verifique o cep digitado.');
                            //$('#TX_UF]').val('');
                            //$('#TX_MUNICIPIO]').val('');
                            $('#TX_BAIRRO]').val('');
                            $('#TX_ENDERECO]').val('');
                            $("#carregando2").hide();
                            $('#TX_CEP]').focus();
                        }
                    });
                }else{
                    //$('#TX_UF]').val('');
                    //$('#TX_MUNICIPIO]').val('');
                    $('#TX_BAIRRO]').val('');
                    $('#TX_ENDERECO]').val('');
                }
            });
        });
    </script>

    <div id="camada" style="width:110px;"><font color="#FF0000">*</font>CPF
        <font color="#FF0000"><div id="carregando1" style="display:none; float:right;">Verificando...</div></font>
        <input type="text" name="NB_CPF" id="NB_CPF" style="width:100px;" /></div>

    <div id="camada" style="width:390px;"><font color="#FF0000">*</font>Nome
        <input type="text" name="TX_NOME" id="TX_NOME" style="width:380px;" /></div>

    <br />
    <div id="camada" style="width:110px;">RG
        <input type="text" name="NB_RG" id="NB_RG" style="width:100px;" /></div>

    <div id="camada" style="width:130px;"><font color="#FF0000">*</font>Dt. Nascimento
        <input type="text" name="DT_NASCIMENTO" id="DT_NASCIMENTO" style="width:120px;" /></div>

    <div id="camada" style="width:130px;"><font color="#FF0000">*</font>Sexo
        <select name="CS_SEXO" id="CS_SEXO" style="width:120px;">
            <option value="">Escolha...</option>
            <option value="1">Masculino</option>
            <option value="2">Feminino</option>
        </select></div>

    <br />
    <div id="camada" style="width:110px;"><font color="#FF0000">*</font>CEP
        <font color="#FF0000"><div id="carregando2" style="display:none; float:right;">Verificando...</div></font>
        <input type="text" name="TX_CEP" id="TX_CEP" style="width:100px;" /></div>

    <div id="camada" style="width:390px;" >Endereço
        <input type="text" name="TX_ENDERECO" id="TX_ENDERECO" style="width:380px;" /></div>

    <div id="camada" style="width:90px;" >Nº
        <input type="text" name="NB_NUMERO" id="NB_NUMERO" style="width:80px;" /></div>

    <div id="camada" style="width:290px;" >Bairro
        <input type="text" name="TX_BAIRRO" id="TX_BAIRRO" style="width:280px;" /></div>

    <div id="camada" style="width:390px;" >Complemento
        <input type="text" name="TX_COMPLEMENTO" id="TX_COMPLEMENTO" style="width:380px;" /></div>

    <div id="camada" style="width:390px;" >Contatos
        <input type="text" name="TX_CONTATO" id="TX_CONTATO" style="width:380px;" /></div>

    <div id="camada" style="width:370px;" >E-Mail
        <input type="text" name="TX_EMAIL" id="TX_EMAIL" style="width:360px;" /></div>

    <div id="camada" style="width:110px;" >Agencia
        <input type="text" name="TX_AGENCIA" id="TX_AGENCIA" style="width:100px;" /></div>

    <div id="camada" style="width:110px;" >Conta Corrente
        <input type="text" name="TX_CONTA_CORRENTE" id="TX_CONTA_CORRENTE" style="width:100px;" /></div>

    <input type="hidden" name="ID_PESSOA_ESTAGIARIO" id="ID_PESSOA_ESTAGIARIO" />
    <input type="hidden" name="ID_PESSOA" id="ID_PESSOA" />
<?
}
else if ($_REQUEST['identifier'] == "buscarCPF") {

    $VO->NB_CPF = $_REQUEST['NB_CPF'];

    $VO->buscarCPF();
    $dados = $VO->getVetor();

    echo json_encode($dados);

} else if ($_REQUEST['identifier'] == "inserirEstagiario") {

    $VO->configuracao();
    $VO->setCaracteristica('TX_NOME,CS_SEXO,NB_CPF,DT_NASCIMENTO,TX_CEP', 'obrigatorios');
    $VO->setCaracteristica('DT_NASCIMENTO', 'datas');
    $VO->setCaracteristica('NB_CPF', 'cpfs');

    $validar = $VO->preencher($_REQUEST);

    if ($acesso) {
        if(!$validar){
            $VO->inserirEstagiario();
            $dados = $VO->getVetor();
        }
        else
            $dados =  'Para inserir preencha os campos obrigatórios.';
    }
    else
        $dados =  "Você não tem permissão para realizar esta ação.";

    echo json_encode($dados);

} else if ($_REQUEST['identifier'] == "atualizarEstagiario") {

    $VO->configuracao();
    $VO->setCaracteristica('TX_NOME,CS_SEXO,NB_CPF,DT_NASCIMENTO,TX_CEP', 'obrigatorios');
    $VO->setCaracteristica('DT_NASCIMENTO', 'datas');
    $VO->setCaracteristica('NB_CPF', 'cpfs');

    $validar = $VO->preencher($_REQUEST);

    if ($acesso) {
        if(!$validar){
            $dados = $VO->alterarEstagiario();
            //$dados = $VO->getVetor();
        }
        else
            $dados =  'Para inserir preencha os campos obrigatórios.';
    }
    else
        $dados =  "Você não tem permissão para realizar esta ação.";

    echo json_encode($dados);

} else if ($_REQUEST['identifier'] == "inserirCandidato") {

    $VO->ID_SELECAO_ESTAGIO = $_SESSION['ID_SELECAO_ESTAGIO'];
    $VO->ID_PESSOA_ESTAGIARIO = $_REQUEST['ID_PESSOA_ESTAGIARIO'];

    if ($acesso) {
        if ($VO->ID_PESSOA_ESTAGIARIO) {
            $retorno = $VO->inserirCandidato();

            if ($retorno)
                $erro = 'Registro já existe.';
        }
        else
            $erro = 'Para inserir preencha os campos obrigatórios.';
    }
    else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);

}
else if ($_REQUEST['identifier'] == "excluirCandidato") {

    $VO->ID_SELECAO_ESTAGIO = $_SESSION['ID_SELECAO_ESTAGIO'];
    $VO->ID_PESSOA_ESTAGIARIO = $_REQUEST['ID_PESSOA_ESTAGIARIO'];

    //$_SESSION['AUX_ID_RECRUTAMENTO_ESTAGIO'] = $VO->ID_RECRUTAMENTO_ESTAGIO; //Jogar pra sessao recuperar no pesquisarCandidatos e é dado unset la.

    if ($acesso) {
        $retorno = $VO->excluirCandidato();

        if (is_array($retorno))
            $erro = 'Este registro não pode ser excluído pois possui dependentes.';
    }
    else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);

}
else if ($_REQUEST['identifier'] == "formAlterarCandidato") {

    global $arraySituacaoCandidato;

    $arrayEscolaridade = array('' => 'Escolha...', 1 => 'Médio', 2 => 'Técnico', 3 => 'Superior', 4 => 'Educação Especial');

    $VO->buscarSolicitante();
    $arraySolicitante = $VO->getArray('TX_UNIDADE_ORG');

    $VO->buscarCursoEstagio();
    $arrayCursoEstagio = $VO->getArray('TX_CURSO_ESTAGIO');

    $VO->buscarTurno();
    $arrayTurno = $VO->getArray('TX_TURNO_CURSO');

    $VO->buscarInstituicaoEnsino();
    $arrayInstituicaoEnsino = $VO->getArray('TX_INSTITUICAO_ENSINO');

    $VO->buscarTipoVagaEstagio();
    $arrayTipoVagaEstagio = $VO->getArray('TX_TIPO_VAGA_ESTAGIO');

    $VO->buscarBolsaEstagio();
    $arrayBolsaEstagio = $VO->getArray('TX_BOLSA_ESTAGIO');

    $VO->buscarSupervisorEstagio();
    $arraySupervisorEstagio = $VO->getArray('TX_NOME');

    $VO->ID_SELECAO_ESTAGIO = $_SESSION['ID_SELECAO_ESTAGIO'];
    $VO->ID_PESSOA_ESTAGIARIO = $_REQUEST['ID_PESSOA_ESTAGIARIO'];

    $VO->buscarCandidatoEstagiario();
    $dados = $VO->getVetor();

    $VO->buscarDadosOfertaVaga();
    $dadosOV = $VO->getVetor();

    foreach ($arraySituacaoCandidato as $key => $val) {
        ($dados['CS_SITUACAO'][0] == $key) ? $selected = 'selected' : $selected = '';
        $optionSituacaoCandidato .= '<option value="' . $key . '" ' . $selected . '>' . $val . '</option> ';
    }

    foreach ($arrayEscolaridade as $key => $val) {
        if ($dados['CS_ESCOLARIDADE'][0])
            ($dados['CS_ESCOLARIDADE'][0] == $key) ? $selected = 'selected' : $selected = '';
        else
            ($dadosOV['CS_ESCOLARIDADE'][0] == $key) ? $selected = 'selected' : $selected = '';
        $optionEscolaridade .= '<option value="' . $key . '" ' . $selected . '>' . $val . '</option> ';
    }

    foreach ($arrayCursoEstagio as $key => $val) {
        if ($dados['ID_CURSO_ESTAGIO'][0])
            ($dados['ID_CURSO_ESTAGIO'][0] == $key) ? $selected = 'selected' : $selected = '';
        else
            ($dadosOV['ID_CURSO_ESTAGIO'][0] == $key) ? $selected = 'selected' : $selected = '';
        $optionCursoEstagio .= '<option value="' . $key . '" ' . $selected . '>' . $val . '</option> ';
    }

    foreach ($arrayTurno as $key => $val) {
        if ($dados['CS_TURNO'][0])
            ($dados['CS_TURNO'][0] == $key) ? $selected = 'selected' : $selected = '';
        else
            ($dadosOV['CS_TURNO'][0] == $key) ? $selected = 'selected' : $selected = '';
        $optionTurno .= '<option value="' . $key . '" ' . $selected . '>' . $val . '</option> ';
    }

    foreach ($arrayInstituicaoEnsino as $key => $val) {
        if ($dados['ID_INSTITUICAO_ENSINO'][0])
            ($dados['ID_INSTITUICAO_ENSINO'][0] == $key) ? $selected = 'selected' : $selected = '';
        else
            ($dadosOV['ID_INSTITUICAO_ENSINO'][0] == $key) ? $selected = 'selected' : $selected = '';
        $optionInstituicaoEnsino .= '<option value="' . $key . '" ' . $selected . '>' . $val . '</option> ';
    }

    foreach ($arraySolicitante as $key => $val) {
        if ($dados['ID_ORGAO_ESTAGIO'][0])
            ($dados['ID_ORGAO_ESTAGIO'][0] == $key) ? $selected = 'selected' : $selected = '';
        else
            ($dadosOV['ID_ORGAO_ESTAGIO'][0] == $key) ? $selected = 'selected' : $selected = '';
        $optionSolicitante .= '<option value="' . $key . '" ' . $selected . '>' . $val . '</option> ';
    }

    foreach ($arrayTipoVagaEstagio as $key => $val) {
        if ($dados['CS_TIPO_VAGA_ESTAGIO'][0])
            ($dados['CS_TIPO_VAGA_ESTAGIO'][0] == $key) ? $selected = 'selected' : $selected = '';
        else
            ($dadosOV['CS_TIPO_VAGA_ESTAGIO'][0] == $key) ? $selected = 'selected' : $selected = '';
        $optionTipoVagaEstagio .= '<option value="' . $key . '" ' . $selected . '>' . $val . '</option> ';
    }

    foreach ($arrayBolsaEstagio as $key => $val) {
        if ($dados['ID_BOLSA_ESTAGIO'][0])
            ($dados['ID_BOLSA_ESTAGIO'][0] == $key) ? $selected = 'selected' : $selected = '';
        else
            ($dadosOV['ID_BOLSA_ESTAGIO'][0] == $key) ? $selected = 'selected' : $selected = '';
        $optionBolsaEstagio .= '<option value="' . $key . '" ' . $selected . '>' . $val . '</option> ';
    }

    foreach ($arraySupervisorEstagio as $key => $val) {
        ($dados['ID_PESSOA_SUPERVISOR'][0] == $key) ? $selected = 'selected' : $selected = '';
        $optionSupervisorEstagio .= '<option value="' . $key . '" ' . $selected . '>' . $val . '</option> ';
    }

//    print_r($dados);
//    echo '<br /><br />';
//    print_r($dadosOV);
    ?>

    <script>
        $(document).ready(function() {

            //$("#TX_NOME,#NB_RG,#DT_NASCIMENTO,#CS_SEXO,#TX_CEP,#TX_ENDERECO,#NB_NUMERO,#TX_BAIRRO,#TX_COMPLEMENTO").val('');
            //$("#TX_CONTATO,#TX_EMAIL,#TX_AGENCIA,#TX_CONTA_CORRENTE,#ID_PESSOA_ESTAGIARIO").val('');
            $('#NB_CPF,#NB_RG').setMask({mask: '99999999999'});
            $('#TX_AGENCIA,#TX_CONTA_CORRENTE').setMask({mask: '***********'});
            $('#TX_CEP').setMask({mask: '999999999'});
            $('#NB_NUMERO,#NB_PERIODO_ANO').setMask({mask: '*****'});
            $('#DT_NASCIMENTO').setMask({mask: '99/99/9999'});
            $('#DT_NASCIMENTO').datepicker({
                changeMonth: true,
                changeYear: true
            });
            $('#TX_HORA_INICIO,#TX_HORA_FINAL').setMask({mask: '99:99:99'});
            $('#TX_HORA_INICIO,#TX_HORA_FINAL').timepicker({ 'timeFormat': 'hh:mm:ss' });

            $('#CS_SITUACAO').live('change', function() {
                if ((($('#CS_SITUACAO').val() == 3) || ($('#CS_SITUACAO').val() == 4))) {
                    $('.comMotivo').show("slow");
                    $('.semMotivo').hide("slow");
                } else if (($('#CS_SITUACAO').val() == 2)) {
                    $('.semMotivo').show("slow");
                    $('.comMotivo').hide("slow");
                } else {
                    $('.semMotivo').hide("slow");
                    $('.comMotivo').hide("slow");
                }
            });

            if ((($('#CS_SITUACAO').val() == 3) || ($('#CS_SITUACAO').val() == 4))) {
                $('.comMotivo').show("slow");
                $('.semMotivo').hide("slow");
            } else if (($('#CS_SITUACAO').val() == 2)) {
                $('.semMotivo').show("slow");
                $('.comMotivo').hide("slow");
            } else {
                $('.semMotivo').hide("slow");
                $('.comMotivo').hide("slow");
            }

            $('#ID_PESSOA_SUPERVISOR').live('change', function() {
                if ($('#ID_PESSOA_SUPERVISOR').val() != '') {
                    $.getJSON('acoes.php',{
                        ID_PESSOA_SUPERVISOR:$('#ID_PESSOA_SUPERVISOR').val(),
                        identifier:'buscarDadosSupervisor'
                    }, function(campo) {
                        $("#TX_CARGO").val(campo['TX_CARGO'][0]);
                        $("#TX_FORMACAO").val(campo['TX_FORMACAO'][0]);
                        $("#TX_TEMPO_EXPERIENCIA").val(campo['TX_TEMPO_EXPERIENCIA'][0]);
                        $("#TX_CONSELHO").val(campo['TX_CONSELHO'][0]);
                        //$("#carregando1").hide();
                        $(".salvar").focus();
                    });
                }else{
                    $("#TX_CARGO,#TX_FORMACAO,#TX_TEMPO_EXPERIENCIA,#TX_CONSELHO").val('');
                    //$("#carregando1").hide();
                }
            });
        });
    </script>

    <table width="100%" class="dataGrid" >
        <tr bgcolor="#E0E0E0">
            <td style="width:150px;"><strong>Candidato</strong></td>
            <td><?= $dados['TX_NOME'][0] ?></td>
        </tr>
        <tr bgcolor="#F0EFEF">
            <td style="width:150px;"><strong>Quadro Vagas</strong></td>
            <td><?= $dados['NB_CPF'][0] ?></td>
        </tr>
    </table>

    <input id="ID_PESSOA_ESTAGIARIO" name="ID_PESSOA_ESTAGIARIO" type="hidden" value="<?= $dados['ID_PESSOA_ESTAGIARIO'][0] ?>" />
    <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:193px; margin-bottom:4px;" >
        <strong><font color="#FF0000">*</font>Situação</strong>
        <select name="CS_SITUACAO" id="CS_SITUACAO" style="width:183px;"><?= $optionSituacaoCandidato ?></select></div>

    <br />
    <div id="camada2" class="comMotivo" style="display:none;">
        <fieldset>
            <legend>Com Motivo</legend>
            <textarea name="TX_MOTIVO_SITUACAO" id="TX_MOTIVO_SITUACAO" maxlength="255" style="width:460px; height:65px;" ><?= $dados['TX_MOTIVO_SITUACAO'][0] ?></textarea>
        </fieldset>
    </div>

    <div id="camada2" class="semMotivo" style="display:none;">
        <fieldset>
            <legend>Dados Bancários</legend>
            <div id="camada" style="width:110px;" ><font color="#FF0000">*</font>Agencia
                <input type="text" name="TX_AGENCIA" id="TX_AGENCIA" style="width:100px;" /></div>

            <div id="camada" style="width:110px;" ><font color="#FF0000">*</font>Conta Corrente
                <input type="text" name="TX_CONTA_CORRENTE" id="TX_CONTA_CORRENTE" style="width:100px;" /></div>
        </fieldset>

        <fieldset>
            <legend>Dados Escolares/Acadêmicos</legend>
            <div id="camada" style="width:260px;" >
                <font color="#FF0000">*</font>Nível de Escolaridade
                <select name="CS_ESCOLARIDADE" id="CS_ESCOLARIDADE" style="width:250px;"><?= $optionEscolaridade ?></select></div>

            <div id="camada" style="width:460px;" >
                <font color="#FF0000">*</font>Curso
                <select name="ID_CURSO_ESTAGIO" id="ID_CURSO_ESTAGIO" style="width:450px;"><?= $optionCursoEstagio ?></select></div>

            <div id="camada" style="width:90px;">Período/Ano
                <input type="text" name="NB_PERIODO_ANO" id="NB_PERIODO_ANO" style="width:80px;" value="
                        <?= ($dados['NB_PERIODO_ANO'][0]) ? $dados['NB_PERIODO_ANO'][0] : $dadosOV['NB_SEMESTRE'][0]; ?>" /></div>

            <div id="camada" style="width:160px;" >
                <font color="#FF0000">*</font>Turno
                <select name="CS_TURNO" id="CS_TURNO" style="width:150px;"><?= $optionTurno ?></select></div>

            <div id="camada" style="width:460px;" >
                <font color="#FF0000">*</font>Instituição de Ensino
                <select name="ID_INSTITUICAO_ENSINO" id="ID_INSTITUICAO_ENSINO" style="width:450px;"><?= $optionInstituicaoEnsino ?></select></div>
        </fieldset>

        <fieldset>
            <legend>Dados Institucionais</legend>
            <div id="camada" style="width:460px;">
                <font color="#FF0000">*</font>Órgão Municipal
                <select name="ID_ORGAO_ESTAGIO" id="ID_ORGAO_ESTAGIO" style="width:450px;"><?= $optionSolicitante ?></select></div>

            <div id="camada" style="width:210px;">
                <font color="#FF0000">*</font>Tipo de Vaga
                <select name="CS_TIPO_VAGA_ESTAGIO" id="CS_TIPO_VAGA_ESTAGIO" style="width:200px;"><?= $optionTipoVagaEstagio ?></select></div>

            <div id="camada" style="width:160px;" >
                <font color="#FF0000">*</font>Valor da Bolsa
                <select name="ID_BOLSA_ESTAGIO" id="ID_BOLSA_ESTAGIO" style="width:150px;"><?= $optionBolsaEstagio ?></select></div>

            <div id="camada" style="width:355px; border:dotted 1px; padding-bottom:4px; padding-left:4px;">
                <span style="margin:3px;">Horário de Estágio</span>
                <br />

                <div id="camada" style="width:70px;">
                    <font color="#FF0000">*</font>Início<br />
                    <input type="text" name="TX_HORA_INICIO" id="TX_HORA_INICIO" style="width:60px;" value="
                        <?= ($dados['TX_HORA_INICIO'][0]) ? $dados['TX_HORA_INICIO'][0] : $dadosOV['TX_HORA_INICIO'][0]; ?>" /></div>

                <div id="camada" style="width:275px;">
                    <font color="#FF0000">*</font>Fim<br />
                    <input type="text" name="TX_HORA_FINAL" id="TX_HORA_FINAL" style="width:60px;" value="
                        <?= ($dados['TX_HORA_FINAL'][0]) ? $dados['TX_HORA_FINAL'][0] : $dadosOV['TX_HORA_FINAL'][0]; ?>" /> (conforme Lei 11.788/2008, art. 10)</div>
            </div>

            <br />
            <div id="camada" style="width:290px;">
                <font color="#FF0000">*</font>Supervisor
                <select name="ID_PESSOA_SUPERVISOR" id="ID_PESSOA_SUPERVISOR" style="width:280px;"><?= $optionSupervisorEstagio ?></select></div>

            <div id="camada" style="width:370px;">
                Cargo/Função
                <input type="text" name="TX_CARGO" id="TX_CARGO" style="width:360px;" class="leitura" readonly="readonly" /></div>

            <div id="camada" style="width:370px;">
                Formação
                <input type="text" name="TX_FORMACAO" id="TX_FORMACAO" style="width:360px;" class="leitura" readonly="readonly" /></div>

            <div id="camada" style="width:140px;">
                Tempo de Experiência
                <input type="text" name="TX_TEMPO_EXPERIENCIA" id="TX_TEMPO_EXPERIENCIA" style="width:130px;" class="leitura" readonly="readonly" /></div>

            <div id="camada" style="width:315px;">
                Conselho Regional
                <input type="text" name="TX_CONSELHO" id="TX_CONSELHO" style="width:305px;" class="leitura" readonly="readonly" /></div>
        </fieldset>
    </div>
<?
}
else if ($_REQUEST['identifier'] == "buscarDadosSupervisor") {

    $VO->ID_PESSOA_SUPERVISOR = $_REQUEST['ID_PESSOA_SUPERVISOR'];

    $VO->buscarSupervisorEstagio();
    $dados = $VO->getVetor();

    echo json_encode($dados);

}
else if ($_REQUEST['identifier'] == "alterarCandidato") {

    $VO->ID_SELECAO_ESTAGIO = $_SESSION['ID_SELECAO_ESTAGIO'];
    $VO->ID_PESSOA_ESTAGIARIO = $_REQUEST['ID_PESSOA_ESTAGIARIO'];
    $VO->CS_SITUACAO = $_REQUEST['CS_SITUACAO'];
    // com motivo
    $VO->TX_MOTIVO_SITUACAO = $_REQUEST['TX_MOTIVO_SITUACAO'];
    // sem motivo
    $VO->TX_MOTIVO_SITUACAO = $_REQUEST['TX_MOTIVO_SITUACAO'];
    $VO->TX_MOTIVO_SITUACAO = $_REQUEST['TX_MOTIVO_SITUACAO'];
    $VO->TX_MOTIVO_SITUACAO = $_REQUEST['TX_MOTIVO_SITUACAO'];
    $VO->TX_MOTIVO_SITUACAO = $_REQUEST['TX_MOTIVO_SITUACAO'];
    $VO->TX_MOTIVO_SITUACAO = $_REQUEST['TX_MOTIVO_SITUACAO'];
    $VO->TX_MOTIVO_SITUACAO = $_REQUEST['TX_MOTIVO_SITUACAO'];
    $VO->TX_MOTIVO_SITUACAO = $_REQUEST['TX_MOTIVO_SITUACAO'];
    $VO->TX_MOTIVO_SITUACAO = $_REQUEST['TX_MOTIVO_SITUACAO'];
    $VO->TX_MOTIVO_SITUACAO = $_REQUEST['TX_MOTIVO_SITUACAO'];
    $VO->TX_MOTIVO_SITUACAO = $_REQUEST['TX_MOTIVO_SITUACAO'];


    if ($acesso) {
        if ($VO->ID_PESSOA_ESTAGIARIO) {
            // situação 3 ou 4 com motivo
            if ($VO->CS_SITUACAO == 3 || $VO->CS_SITUACAO == 4) {
                if ($VO->TX_MOTIVO_SITUACAO) {
                    $retorno = $VO->alterarCandidatoComMotivo();

                    if ($retorno)
                        $erro = 'Registro já existe.';
                }
                else
                    $erro = 'Para inserir preencha o campo motivo.';
            }
            //situação 2 sem motivo
            else if ($VO->CS_SITUACAO == 2) {
                if ($VO->TX_MOTIVO_SITUACAO) {
                    $retorno = $VO->alterarCandidatoSemComMotivo();

                    if ($retorno)
                        $erro = 'Registro já existe.';
                }
            }
            // situação 0
            else if ($VO->CS_SITUACAO == 0) {
                $erro = 'Para inserir escolha uma situação.';
            }
        }
        else
            $erro = 'Para inserir preencha os campos obrigatórios.';
    }
    else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);

}


/*-----------------------------------------------------------------------------
} else if ($_REQUEST['identifier'] == 'excluirCandidato') {

    $VO->ID_SELECAO_ESTAGIO = $_SESSION['ID_SELECAO_ESTAGIO'];
    $VO->NB_CANDIDATO = $_REQUEST['NB_CANDIDATO'];

    //$_SESSION['AUX_ID_RECRUTAMENTO_ESTAGIO'] = $VO->ID_RECRUTAMENTO_ESTAGIO; //Jogar pra sessao recuperar no pesquisarCandidatos e é dado unset la.

    if ($acesso) {
        $retorno = $VO->excluirCandidato();

        if (is_array($retorno))
            $erro = 'Este registro não pode ser excluído pois possui dependentes.';
    }
    else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);
//}else if ($_REQUEST['identifier'] == "buscarRecrutamentoCad") {
//
//    $VO->ID_ORGAO_ESTAGIO = $_REQUEST['ID_ORGAO_ESTAGIO'];
//    $total = $VO->buscarRecrutamentoCad();
//
//    echo '<option value="">Escolha...</option>';
//    if ($total) {
//        $dados = $VO->getVetor();
//        for ($i = 0; $i < $total; $i++) {
//            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_COD_RECRUTAMENTO'][$i] . '</option>';
//        }
//    }
//} else if ($_REQUEST['identifier'] == 'form_Candidatos') {
//
//    $VO->ID_SELECAO_ESTAGIO = $_SESSION['ID_SELECAO_ESTAGIO'];
//    $aux = explode("_", $_REQUEST['ESTAGIARIO_SELECAO']);
//
//    $VO->ID_RECRUTAMENTO_ESTAGIO = $aux[0];
//    $VO->NB_VAGAS_RECRUTAMENTO = $aux[1];
//    $VO->NB_CANDIDATO = $aux[2];
//
//    $VO->buscarEstagiarioVaga();
//    $dados = $VO->getVetor();
//
//    $arraySituacaoCandidato = array('' => "Escolha...", 1 => "Em Análise", 2 => "Aprovado", 3 => "Reprovado", 4 => "Cancelado");
//
//    foreach ($arraySituacaoCandidato as $key => $val) {
//        ($dados['CS_SITUACAO'][0] == $key) ? $selected = 'selected' : $selected = '';
//        $arraySituacaoCandidato .= '<option value="' . $key . '" ' . $selected . '>' . $val . '</option> ';
//    }
//    ?>

    <script>
        $(document).ready(function() {
            $("#DT_AGENDAMENTO_ALT,#DT_REALIZACAO_ALT").setMask({mask: "99/99/9999"});

            $("#DT_AGENDAMENTO_ALT,#DT_REALIZACAO_ALT").datepicker({
                changeMonth: true,
                changeYear: true
            });

            $('#CS_SITUACAO_ALT').live('change', function() {
                if ((($('#CS_SITUACAO_ALT').val() == 3) || ($('#CS_SITUACAO_ALT').val() == 4))) {
                    $('#motivo_alt').show("slow");
                } else {
                    $("#motivo_alt").hide("slow");
                    $("#TX_MOTIVO_SITUACAO_ALT").val('');
                }

            });

        })
    </script>
    <table width="100%" class="dataGrid" >
        <tr bgcolor="#E0E0E0">
            <td style="width:150px;"><strong>Candidato </strong></td>
            <td>//<?= $dados['TX_NOME'][0] ?></td>
        </tr>
        <tr bgcolor="#F0EFEF">
            <td style="width:150px;"><strong>Quadro Vagas </strong></td>
            <td>//<?= $dados['TX_CODIGO'][0] ?></td>
        </tr>
    </table>
    <br />

    <fieldset>

        <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:130px;" ><strong><font color="#FF0000">*</font>Dt. Agendamento</strong><br />
            <input type="text" name="DT_AGENDAMENTO_ALT" id="DT_AGENDAMENTO_ALT" value="//<?= $dados['DT_AGENDAMENTO'][0] ?>" style="width:120px;" /></div>

        <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:120px;" ><strong><font color="#FF0000">*</font>Dt. Realização</strong><br />
            <input type="text" name="DT_REALIZACAO_ALT" id="DT_REALIZACAO_ALT" value="//<?= $dados['DT_REALIZACAO'][0] ?>"  style="width:110px;" /></div>

        <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:193px;" ><strong><font color="#FF0000">*</font>Situação</strong>
            <select name="CS_SITUACAO_ALT" id="CS_SITUACAO_ALT" style="width:183px;">
    //<?= $arraySituacaoCandidato ?>
            </select></div>

        <div id="motivo_alt" style="width:450px; //<?php if ($dados["CS_SITUACAO"][0] == 2 || $dados["CS_SITUACAO"][0] == 1) echo 'display:none;'; ?>" ><strong><font color="#FF0000">*</font>Motivo</strong> <br />
            <input type="text" name="TX_MOTIVO_SITUACAO_ALT" id="TX_MOTIVO_SITUACAO_ALT" value="//<?= $dados['TX_MOTIVO_SITUACAO'][0] ?>"  style="width:440px;" /></div>

        <div id="camada" style="font-family:Verdana, Geneva, sans-serif; width:450px;" ><strong>Usuário Selecionador</strong><br />
            <input type="text" name="ID_USUARIO_SELECIONADOR" id="ID_USUARIO_SELECIONADOR" value="//<?= $dados['TX_FUNCIONARIO'][0] ?>"  style="width:440px;" class="leitura" readonly="readonly"/></div>

        <br /><br />
        <input type="hidden" name="ESTAGIARIO_SELECAO_ALT" id="ESTAGIARIO_SELECAO_ALT" value="//<?= $_REQUEST['ESTAGIARIO_SELECAO'] ?>" />
    </fieldset>

    //<?php
} else if ($_REQUEST['identifier'] == 'excluirCandidato') {

    $VO->ID_SELECAO_ESTAGIO = $_SESSION['ID_SELECAO_ESTAGIO'];
    $aux = explode("_", $_REQUEST['ESTAGIARIO_SELECAO']);

    $VO->ID_RECRUTAMENTO_ESTAGIO = $aux[0];
    $VO->NB_VAGAS_RECRUTAMENTO = $aux[1];
    $VO->NB_CANDIDATO = $aux[2];

    $_SESSION['AUX_ID_RECRUTAMENTO_ESTAGIO'] = $VO->ID_RECRUTAMENTO_ESTAGIO; //Jogar pra sessao recuperar no pesquisarCandidatos e é dado unset la.

    if ($acesso) {
        $retorno = $VO->excluirCandidato();

        if (is_array($retorno))
            $erro = 'Este registro não pode ser excluído pois possui dependentes.';
    }
    else
        $erro = "Você não tem permissão para realizar esta ação.";

    gerarTabela($erro);
}
//Buscar ComboBox de Candidato
else if ($_REQUEST['identifier'] == "pesquisarCandidatos") {

    $VO->ID_SELECAO_ESTAGIO = $_SESSION['ID_SELECAO_ESTAGIO'];

    $total = $VO->pesquisarCandidatos();

    if ($total) {
        $dados = $VO->getVetor();
        echo '<option value="">Escolha...</option>';
        for ($i = 0; $i < $total; $i++) {
            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_NOME'][$i] . '</option>';
        }
    }
} else if ($_REQUEST['identifier'] == 'alterarCandidato') {

    $VO->ID_SELECAO_ESTAGIO = $_SESSION['ID_SELECAO_ESTAGIO'];

    $aux = explode("_", $_REQUEST['ESTAGIARIO_SELECAO']);

    $VO->ID_RECRUTAMENTO_ESTAGIO = $aux[0];
    $VO->NB_VAGAS_RECRUTAMENTO = $aux[1];
    $VO->NB_CANDIDATO = $aux[2];
    $VO->DT_REALIZACAO = $_REQUEST['DT_REALIZACAO'];
    $VO->DT_AGENDAMENTO = $_REQUEST['DT_AGENDAMENTO'];

    $VO->CS_SITUACAO = $_REQUEST['CS_SITUACAO'];
    $VO->TX_MOTIVO_SITUACAO = $_REQUEST['TX_MOTIVO_SITUACAO'];


    if ($VO->ID_SELECAO_ESTAGIO && $VO->ID_RECRUTAMENTO_ESTAGIO && $VO->NB_VAGAS_RECRUTAMENTO && $VO->NB_CANDIDATO && $VO->DT_AGENDAMENTO && $VO->DT_REALIZACAO && $VO->CS_SITUACAO) {

        $retorno = $VO->alterarCandidato();

        if (is_array($retorno)) {
            $posicao = stripos($retorno['message'], ":");
            $string1 = substr($retorno['message'], $posicao + 1);
            $posicao2 = stripos($string1, "ORA");
            $erro = substr($retorno['message'], $posicao + 1, $posicao2 - 1);
        }
    }
    else
        $erro = "Todos os campos devem ser preenchidos.";

    gerarTabela($erro);
//}else if ($_REQUEST['identifier'] == "gerarCandidatos") {
//
//    $VO->ID_SELECAO_ESTAGIO = $_SESSION['ID_SELECAO_ESTAGIO'];
//    $VO->ID_RECRUTAMENTO_ESTAGIO = $_SESSION['AUX_ID_RECRUTAMENTO_ESTAGIO'];
//
//    $total = $VO->pesquisarCandidatos();
//
//    echo '<option value="">Escolha...</option>';
//    if ($total) {
//        $dados = $VO->getVetor();
//        for ($i = 0; $i < $total; $i++) {
//            echo '<option value="' . $dados['CODIGO'][$i] . '">' . $dados['TX_NOME'][$i] . '</option>';
//        }
//    }
//
//    unset($_SESSION['AUX_ID_RECRUTAMENTO_ESTAGIO']);
}*/
?>