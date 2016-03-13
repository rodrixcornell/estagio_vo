<?php

require_once "../../php/define.php";
require_once $pathvo . "instituicao_estagioVO.php";

$modulo = 78;
$programa = 7;
$pasta = 'instituicao_estagio';
$current = 1;
$titulopage = 'Instituição de Estágio';

session_start();
require_once "../autenticacao/validaPermissao.php";

unset($_SESSION['ID_AGENCIA_ESTAGIO']);

// Iniciando Instância
$VO = new instituicao_estagioVO();

if ($_POST) {
    $VO->configuracao();
    $VO->setCaracteristica('TX_AGENCIA_ESTAGIO,TX_SIGLA,TX_EMAIL,TX_CNPJ', 'obrigatorios');
    $VO->setCaracteristica('TX_CNPJ', 'cnpjs');
    $VO->setCaracteristica('TX_EMAIL', 'emails');
    $validar = $VO->preencher($_POST);

    if (!$validar) {
        $VO->inserir();
        $_SESSION['TX_AGENCIA_ESTAGIO'] = $VO->TX_AGENCIA_ESTAGIO;
        $_SESSION['TX_SIGLA'] = $VO->TX_SIGLA;
        $_SESSION['STATUS'] = '*Registro inserido com sucesso!';
        $_SESSION['PAGE'] = '1';

        header("Location: " . $url . "src/" . $pasta . "/index.php");
    }
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