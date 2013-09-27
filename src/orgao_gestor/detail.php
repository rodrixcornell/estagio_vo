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

if ($_SESSION['ID_ORGAO_GESTOR_ESTAGIO']){
    
   
    $VO->ID_ORGAO_GESTOR_ESTAGIO = $_SESSION['ID_ORGAO_GESTOR_ESTAGIO'];

	
    $total = $VO->buscar();
    $total ? $dados = $VO->getVetor() : false;


}else header("Location: ".$url."src/".$pasta."/index.php");




$smarty->assign("current"       , $current);
$smarty->assign("pasta"         , $pasta);
$smarty->assign("dados"         , $dados);
$smarty->assign("acesso"        , $acesso);
$smarty->assign("titulopage"    , $titulopage);
$smarty->assign("arquivoCSS"    , $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("arquivoJS"     , $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("nomeArquivo"   , $pasta."/".$nomeArquivo.".tpl");	
$smarty->display('index.tpl');
?>