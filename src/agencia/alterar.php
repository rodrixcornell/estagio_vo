<?php

require_once "../../php/define.php";
require_once $pathvo . "agenciaVO.php";

$modulo = 78;
$programa = 7;
$pasta = 'agencia';
$current = 1;
$titulopage = 'Agência de Estágio';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new agenciaVO();

if ($_SESSION['ID_AGENCIA_ESTAGIO']) {

    $VO->ID_AGENCIA_ESTAGIO = $_SESSION['ID_AGENCIA_ESTAGIO'];

    $VO->pesquisar();
    $VO->preencherVOBD($VO->getVetor());

    if ($_POST) {
        $VO->configuracao();
        $VO->setCaracteristica('TX_AGENCIA_ESTAGIO,TX_SIGLA,TX_CNPJ,TX_EMAIL', 'obrigatorios');
        $VO->setCaracteristica('TX_CNPJ', 'cnpjs');
        $VO->setCaracteristica('TX_EMAIL', 'emails');
        
        $validar = $VO->preencher($_POST);

        if (!$validar) {
            $VO->alterar();
            $_SESSION['TX_AGENCIA_ESTAGIO'] = $VO->TX_AGENCIA_ESTAGIO;
            $_SESSION['TX_SIGLA'] = $VO->TX_SIGLA;
            $_SESSION['STATUS'] = '*Registro alterado com sucesso!';
            $_SESSION['PAGE'] = '1';
            header("Location: " . $url . "src/" . $pasta . "/index.php");
        }
    }
}else
    header("Location: " . $url . "src/" . $pasta . "/index.php");


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