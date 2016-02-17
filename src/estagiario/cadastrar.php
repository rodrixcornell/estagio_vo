<?php

require_once "../../php/define.php";
require_once $path . "src/estagiario/arrays.php";
require_once $pathvo . "estagiarioVO.php";

$modulo = 79;
$programa = 2;
$pasta = 'estagiario';
$current = 2;
$titulopage = 'Estagiário';

session_start();
require_once "../autenticacao/validaPermissao.php";

unset($_SESSION['ID_PESSOA_ESTAGIARIO']);

// Iniciando Instância
$VO = new estagiarioVO();

if ($_POST) {
    //T.TX_NOME, T.CS_TIPO_PESSOA, T.CS_SEXO, T.DT_ATUALIZACAO, T.CS_TIPO, T.NB_RG, T.NB_CPF, T.DT_NASCIMENTO, T.ID_PESSOA_ESTAGIARIO,
    //T.ID_PESSOA_FUNCIONARIO, T.NB_FUNCIONARIO, T.ID_OFERTA_VAGA, T.TX_CEP, T.TX_ENDERECO, T.NB_NUMERO, T.TX_COMPLEMENTO, T.TX_BAIRRO,
    //T.TX_AGENCIA, T.TX_CONTA_CORRENTE, T.CS_ESCOLARIDADE, T.ID_CURSO_ESTAGIO, T.NB_PERIODO_ANO, T.CS_TURNO, T.ID_INSTITUICAO_ENSINO,
    //T.ID_ORGAO_ESTAGIO, T.CS_TIPO_VAGA_ESTAGIO, T.TX_HORA_INICIO, T.TX_HORA_FINAL, T.ID_BOLSA_ESTAGIO, T.ID_PESSOA_SUPERVISOR
    $VO->configuracao();
    $VO->setCaracteristica('TX_NOME,CS_SEXO,NB_CPF,DT_NASCIMENTO,TX_CEP', 'obrigatorios');
    $VO->setCaracteristica('DT_NASCIMENTO', 'datas');
    $VO->setCaracteristica('NB_CPF', 'cpfs');

    $validar = $VO->preencher($_POST);

    if (!$validar) {
        if ($VO->checacpf()) {
            $VO->preencherVOBD($VO->getVetor());
            $retorno = $VO->inserirestagiario();
        } else {
            $retorno = $VO->inserir();
        }
    }

    if (!$validar && !$retorno) {
        $_SESSION['NB_CPF'] = $VO->NB_CPF;
        $_SESSION['TX_NOME'] = $VO->TX_NOME;
        $_SESSION['STATUS'] = '*Registro inserido com sucesso!';
        $_SESSION['PAGE'] = '1';
        header("Location: " . $url . "src/" . $pasta . "/index.php");
    }
    if ($retorno)
        $validar['NB_CPF'] = 'Registro já existe';
}

$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("validar", $validar);
$smarty->assign("VO", $VO);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("arquivoCSS", $pasta);
$smarty->assign("arquivoJS", $pasta);
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>