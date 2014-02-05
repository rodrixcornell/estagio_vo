<?php
require_once "../../php/define.php";
require_once $path."src/agente_setorial/arrays.php";
require_once $pathvo."agente_setorialVO.php";

$modulo = 78;
$programa = 3;
$pasta = 'agente_setorial';
$current = 1;
$titulopage = 'Agente Setorial';

session_start();
require_once "../autenticacao/validaPermissao.php";

 //Iniciando Instância
$VO = new agente_setorialVO();

if ($_SESSION['ID_SETORIAL_ESTAGIO']){
     
    $VO->ID_SETORIAL_ESTAGIO = $_SESSION['ID_SETORIAL_ESTAGIO'];

    $total = $VO->buscar();
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