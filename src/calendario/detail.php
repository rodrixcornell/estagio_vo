<?php

require_once "../../php/define.php";
require_once $path . "src/calendario/arrays.php";
require_once $pathvo . "calendarioVO.php";

$modulo = 80;
$programa = 9;
$pasta = 'calendario';
$current = 3;
$titulopage = 'Calendário da Folha de Pagamento de Estágio';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new calendarioVO();

if ($_SESSION['ID_CALENDARIO_FOLHA_PAG']) {

    $VO->ID_CALENDARIO_FOLHA_PAG = $_SESSION['ID_CALENDARIO_FOLHA_PAG'];

    $total = $VO->buscar();
    if ($total) {
        $dados = $VO->getVetor();

        $_SESSION['ID_ORGAO_GESTOR_ESTAGIO'] = $dados['ID_ORGAO_GESTOR_ESTAGIO'][0];
    }

    $VO->pesquisarGrupoPagamento();
    $smarty->assign("arrayGrupoPagamento", $VO->getArray("TX_GRUPO_PAGAMENTO"));
}else
    header("Location: " . $url . "src/" . $pasta . "/index.php");


$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("dados", $dados);
$smarty->assign("censo", $censo);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("arquivoCSS", $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("arquivoJS", $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>