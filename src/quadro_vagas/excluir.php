<?php
require_once "../../php/define.php";
require_once $pathvo . "quadro_vagasVO.php";

$modulo = 78;
$programa = 9;
$pasta = 'quadro_vagas';
$current = 1;
$titulopage = 'Quadro de Vagas';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
if ($_SESSION['ID_QUADRO_VAGAS_ESTAGIO']) {
    $VO = new quadro_vagasVO();
    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];

    $retorno = $VO->excluir();

    if (!$retorno) {
        $msg = 'Quadro de Vaga excluída com sucesso.<br><br> <a href="' . $url . 'src/' . $pasta . '/index.php">Clique aqui</a> para voltar';
        unset($_SESSION['ID_QUADRO_VAGAS_ESTAGIO']);
    } else {
        $msg = 'Este registro não pode ser excluído pois possui dependentes.<br /> <a href="' . $url . 'src/' . $pasta . '/detail.php">clique aqui</a> para voltar';
    }
}else
    header("Location: " . $url . "src/" . $pasta . "/index.php");

$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("msg", $msg);
$smarty->assign("arquivoCSS", $pasta);
$smarty->assign("arquivoJS", $pasta);
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>