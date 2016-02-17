<?php
require_once "../../php/define.php";
require_once $path . "src/ta_contrato/arrays.php";
require_once $pathvo . "ta_contratoVO.php";

$modulo = 80;
$programa = 7;
$pasta = 'ta_contrato';
$current = 3;
$titulopage = 'Solicitação de Termo Aditivo de Contrato';

session_start();
require_once "../autenticacao/validaPermissao.php";

unset($_SESSION['ID_SOLICITACAO_TA_CP']);

// Iniciando Instância
$VO = new ta_contratoVO();

if ($_POST) {
    $VO->configuracao();
    $VO->setCaracteristica('ID_ORGAO_GESTOR_ESTAGIO,ID_CONTRATO_CP,ID_UNIDADE_ORG_ORIGEM,ID_UNIDADE_ORG_DESTINO,TX_ASSUNTO,DT_SOLICITACAO','obrigatorios');
    $VO->setCaracteristica('DT_SOLICITACAO', 'datas');

    $validar = $VO->preencher($_POST);

    $tamanho_just = strlen($_POST['TX_SOLICITACAO']);

    if ($tamanho_just > 255) {
        $validar['TX_SOLICITACAO'] = 'Valor máximo de 255 caracteres, atual de: ' . $tamanho_just;
     }else if (!$validar) {
        $id_pk = $VO->inserir();

        //print_r($id_pk);

        if ($id_pk) {
            $_SESSION['ID_SOLICITACAO_TA_CP'] = $id_pk;
            header("Location: " . $url . "src/" . $pasta . "/detail.php");
        }else {
            $validar['ID_ORGAO_GESTOR_ESTAGIO'] = "Erro de Cadastro!";
        }

    if ($VO->ID_UNIDADE_ORG_ORIGEM) {
        $VO->buscarUnidadeDestino();
        $smarty->assign("buscarUnidadeDestino", $VO->getArray("TX_UNIDADE_ORG_DESTINO"));
         }
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