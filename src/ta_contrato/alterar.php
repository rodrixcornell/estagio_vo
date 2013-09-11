<?php
require_once "../../php/define.php";
require_once $path . "src/ta_contrato/arrays.php";
require_once $pathvo . "ta_contratoVO.php";

$modulo = 80;
$programa = 7;
$pasta = 'ta_contrato';
$current = 3;
$titulopage = 'Solicitação de Termo de Aditivo de Contrato';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new ta_contratoVO();

if ($_SESSION['ID_SOLICITACAO_TA_CP']) {

    $VO->ID_SOLICITACAO_TA_CP = $_SESSION['ID_SOLICITACAO_TA_CP'];
    $VO->buscar();
    $VO->preencherVOBD($VO->getVetor());
    
    //$recrutamento = $VO->verificarRecrutamento();
    
    
   
    if ($_POST){
        $VO->configuracao();
        $VO->setCaracteristica('ID_ORGAO_GESTOR_ESTAGIO,ID_CONTRATO_CP,ID_UNIDADE_ORG_ORIGEM,ID_UNIDADE_ORG_DESTINO,DT_SOLICITACAO,CS_SITUACAO','obrigatorios');
        $VO->setCaracteristica('DT_SOLICITACAO', 'datas');
        
        $validar = $VO->preencher($_POST);

        $tamanho_just = strlen($_POST['TX_ASSUNTO']);

    if ($tamanho_just > 255) {
        $validar['TX_ASSUNTO'] = 'Valor máximo de 255 caracteres, atual de: ' . $tamanho_just;
    }if (!$validar) {
            $VO->alterar();
            header("Location: " . $url . "src/" . $pasta . "/detail.php");
        }
    }
    if ($VO->ID_UNIDADE_ORG_ORIGEM) {
        $VO->buscarUnidadeDestino();
        $smarty->assign("buscarUnidadeDestino", $VO->getArray("TX_UNIDADE_ORG_DESTINO"));
         }
    
}else header("Location: " . $url . "src/" . $pasta . "/index.php");

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