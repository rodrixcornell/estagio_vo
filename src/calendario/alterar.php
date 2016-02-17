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
    $VO->buscar();
    $VO->preencherVOBD($VO->getVetor());

    if ($_POST) {
        $VO->configuracao();
        $VO->setCaracteristica('ID_ORGAO_GESTOR_ESTAGIO,NB_ANO_REFERENCIA,NB_MES_REFERENCIA', 'obrigatorios');
        $validar = $VO->preencher($_POST);

        if (!$validar) {
            $VO->alterar();
            header("Location: " . $url . "src/" . $pasta . "/detail.php");
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