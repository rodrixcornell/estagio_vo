<?php
require_once "../../php/define.php";
require_once $path . "src/s_ta/arrays.php";
require_once $pathvo . "s_taVO.php";

$modulo = 79;
$programa = 11;
$pasta = 's_ta';
$current = 2;
$titulopage = 'Solicitação de Desligamento';

session_start();
require_once "../autenticacao/validaPermissao.php";

 //Iniciando Instância
$VO = new s_taVO();

if ($_SESSION['ID_SOLICITACAO_DESLIG']){

    $VO->ID_SOLICITACAO_DESLIG = $_SESSION['ID_SOLICITACAO_DESLIG'];

    $total = $VO->pesquisar();
    $total ? $dados = $VO->getVetor() : false;

	if ($dados['CS_SITUACAO'][0] == 2){
	  $acesso = 0;
	}

    if ($_POST['efetivar']){

      $VO->ID_SOLICITACAO_DESLIG = $dados['ID_SOLICITACAO_DESLIG'][0];

          $VO->EFETIVAR = 2;
          $VO->atualizarInf();
          header("Location: ".$url."src/".$pasta."/detail.php");
    }

}else header("Location: ".$url."src/".$pasta."/index.php");


$smarty->assign("current"       , $current);
$smarty->assign("pasta"         , $pasta);
$smarty->assign("dados"         , $dados);
$smarty->assign("acesso"        , $acesso);
$smarty->assign("censo"         , $censo);
$smarty->assign("titulopage"    , $titulopage);
$smarty->assign("arquivoCSS"    , $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("arquivoJS"     , $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("nomeArquivo"   , $pasta."/".$nomeArquivo.".tpl");
$smarty->display('index.tpl');
?>