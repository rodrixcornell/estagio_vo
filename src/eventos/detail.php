<?php
require_once "../../php/define.php";
require_once $path."src/eventos/arrays.php";
require_once $pathvo."eventosVO.php";

$modulo = 80;
$programa = 2;
$pasta = 'eventos';
$current = 3;
$titulopage = 'Evento de Pagamento';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new eventosVO();

if ($_SESSION['ID_ITEM_PAGAMENTO_ESTAGIO']){

    $VO->ID_ITEM_PAGAMENTO_ESTAGIO = $_SESSION['ID_ITEM_PAGAMENTO_ESTAGIO'];

    $total = $VO->pesquisarEventos();
    $total ? $dados = $VO->getVetor() : false;

}else header("Location: ".$url."src/".$pasta."/index.php");


$smarty->assign("current"       , $current);
$smarty->assign("pasta"         , $pasta);
$smarty->assign("dados"         , $dados);
$smarty->assign("censo"         , $censo);
$smarty->assign("titulopage"    , $titulopage);
$smarty->assign("arquivoCSS"    , $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("arquivoJS"     , $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("nomeArquivo"   , $pasta."/".$nomeArquivo.".tpl");
$smarty->display('index.tpl');
?>