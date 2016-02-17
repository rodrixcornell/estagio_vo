<?php
require_once "../../php/define.php";
require_once $path."src/orgao_solicitante/arrays.php";
require_once $pathvo."orgao_solicitanteVO.php";

$modulo = 78;
$programa = 2;
$pasta = 'orgao_solicitante';
$current = 1;
$titulopage = 'Órgão Solicitante';

session_start();
require_once "../autenticacao/validaPermissao.php";

 //Iniciando Instância
$VO = new orgao_solicitanteVO();

if ($_SESSION['ID_ORGAO_ESTAGIO']){
     
    $VO->ID_ORGAO_ESTAGIO = $_SESSION['ID_ORGAO_ESTAGIO'];
    
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