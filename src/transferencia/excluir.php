<?php

require_once "../../php/define.php";
require_once $path . "src/transferencia/arrays.php";
require_once $pathvo . "transferenciaVO.php";

$modulo = 79;
$programa = 4;
$pasta = 'transferencia';
$current = 2;
$titulopage = 'Transferência de Vagas';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
if ($_SESSION['ID_TRANSFERENCIA_ESTAGIO']&& $_REQUEST['CS_TIPO_VAGA_ESTAGIO']) {
    $VO = new transferenciaVO();
    $VO->ID_TRANSFERENCIA_ESTAGIO = $_SESSION['ID_TRANSFERENCIA_ESTAGIO'];
    //$VO->ID_QUADRO_VAGAS_ESTAGIO = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];
    //$VO->ID_ORGAO_EST_ORIGEM     = $_SESSION['ID_ORGAO_ESTAGIO']; 
    //$VO->ID_ORGAO_EST_DESTINO    = $_SESSION['ID_ORGAO_SOLICITANTE'];
    //$VO->NB_QUANTIDADE           = $_SESSION['NB_QUANTIDADE'];
    $VO->CS_TIPO_VAGA_ESTAGIO    = $_REQUEST['CS_TIPO_VAGA_ESTAGIO']; 
    
    
    $retorno = $VO->excluir();

    if (!$retorno) {
        $msg = 'A ' . $titulopage . ' foi excluída com sucesso.<br><br> <a href="' . $url . 'src/' . $pasta . '/index.php">Clique aqui</a> para voltar';
        unset($_SESSION['ID_TRANSFERENCIA_ESTAGIO']);
        //unset($_SESSION['ID_QUADRO_VAGAS_ESTAGIO']);
        //unset($_SESSION['ID_ORGAO_ESTAGIO']); 
        //unset($_SESSION['ID_ORGAO_SOLICITANTE']);
        //unset($_SESSION['NB_QUANTIDADE']);
      //  unset($_REQUEST['CS_TIPO_VAGA_ESTAGIO']); 
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