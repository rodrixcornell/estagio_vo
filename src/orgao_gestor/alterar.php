<?php

require_once "../../php/define.php";
require_once $path . "src/orgao_gestor/arrays.php";
require_once $pathvo . "orgao_gestorVO.php";

$modulo = 78;
$programa = 1;
$pasta = 'orgao_gestor';
$current = 1;
$titulopage = 'Órgão Gestor de Estágio';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new orgao_gestorVO();

if ($_SESSION['ID_ORGAO_GESTOR_ESTAGIO']) {

    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_SESSION['ID_ORGAO_GESTOR_ESTAGIO'];
    $VO->buscar();
    $VO->preencherVOBD($VO->getVetor());

    if ($_POST) {
        $VO->configuracao();
        $VO->setCaracteristica('TX_ORGAO_GESTOR_ESTAGIO,ID_UNIDADE_ORG,TX_CNPJ', 'obrigatorios');
        $VO->setCaracteristica('TX_CNPJ', 'cnpjs');
        $validar = $VO->preencher($_POST);

        if (!$validar) {
            $VO->alterar();
           // $_SESSION['TX_ORGAO_GESTOR_ESTAGIO'] = $VO->TX_ORGAO_GESTOR_ESTAGIO;
          //  $_SESSION['ID_UNIDADE_ORG'] = $VO->ID_UNIDADE_ORG;
          //  $_SESSION['STATUS'] = '*Registro alterado com sucesso!';
             $_SESSION['ID_ORGAO_GESTOR_ESTAGIO']=$VO->ID_ORGAO_GESTOR_ESTAGIO;
            $_SESSION['PAGE'] = '1';
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