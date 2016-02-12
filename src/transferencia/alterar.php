<?php

require_once "../../php/define.php";
require_once $path . "src/transferencia/arrays.php";
require_once $pathvo . "transferenciaVO.php";

$modulo = 79;
$programa = 4;
$pasta = 'transferencia';
$current = 2;
$titulopage = 'Transferencia de Estagiário';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new transferenciaVO();

if ($_SESSION['ID_TRANSFERENCIA_ESTAGIO']) {

    $VO->ID_TRANSFERENCIA_ESTAGIO = $_SESSION['ID_TRANSFERENCIA_ESTAGIO'];
    $VO->buscar();
    $VO->preencherVOBD($VO->getVetor());

    $recrutamento = $VO->verificarRecrutamento();

    if ($VO->ID_ORGAO_SOLICITANTE) { //if ($VO->ID_ORGAO_ESTAGIO) 
      $VO->pesquisarOrgaoCedente();
      $smarty->assign("arraypesquisarOrgaoCedente", $VO->getArray("TX_ORGAO_ESTAGIO"));

      if ($VO->ID_ORGAO_ESTAGIO) {  //if ($VO->ID_AGENCIA_ESTAGIO)
      $VO->buscarQuadroVagasEstagio();
      $smarty->assign("arrayQuadroVagasEstagio", $VO->getArray("TX_CODIGO"));
      }
      }

    if ($_POST) {
        $VO->configuracao();
        if ($recrutamento)
            $VO->setCaracteristica('CS_SITUACAO', 'obrigatorios');
        $validar = $VO->preencher($_POST);

        $tamanho_just = strlen($_POST['TX_MOTIVO']);

        if ($tamanho_just > 255) {
            $validar['TX_MOTIVO'] = 'Valor máximo de 255 caracteres, atual de: ' . $tamanho_just;
        } else if (!$validar) {
            $id_pk = $VO->alterar();
            header("Location: " . $url . "src/" . $pasta . "/detail.php");
        }
    }
}else
    header("Location: " . $url . "src/" . $pasta . "/index.php");

$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("validar", $validar);
$smarty->assign("recrutamento", $recrutamento);
$smarty->assign("VO", $VO);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("arquivoCSS", $pasta);
$smarty->assign("arquivoJS", $pasta);
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>