<?php
require_once "../../php/define.php";
require_once $path . "src/tr/arrays.php";
require_once $pathvo . "trVO.php";

$modulo = 79;
$programa = 8;
$pasta = 'tr';
$current = 2;
$titulopage = 'Solicitação de TR';

session_start();
require_once "../autenticacao/validaPermissao.php";

 //Iniciando Instância
$VO = new TrVO();
$dados['MENSSAGEM'] = " ";    
if ($_SESSION['ID_SOLICITACAO_TR']){
    //$dados['MENSSAGEM'] = " ";
    $VO->ID_SOLICITACAO_TR = $_SESSION['ID_SOLICITACAO_TR'];
    
    $total = $VO->pesquisar();
    $total ? $dados = $VO->getVetor() : false;

    if ($_POST['efetivar']){
                        
      $VO->ID_SOLICITACAO_TR = $dados['ID_SOLICITACAO_TR'][0];
      
//      $aux = $VO->efetivar();  
      
//      if (!$aux) {          
          $VO->EFETIVAR = 2; 
          $VO->atualizarInf(); 
      //    $dados['MENSSAGEM'] = " ";          
          header("Location: ".$url."src/".$pasta."/detail.php");
//      }else{
//          $dados['MENSSAGEM'] = "A seleção não pode ser efetivada pois existe(m) candidatos em análise!";
//      }
      
    }       
    
//    $VO->ID_RECRUTAMENTO_ESTAGIO = $dados['ID_RECRUTAMENTO_ESTAGIO'][0];
//    $_SESSION['ID_RECRUTAMENTO_ESTAGIO'] = $dados['ID_RECRUTAMENTO_ESTAGIO'][0];
//    $VO->pesquisarCandidatos();
//    $arrayCandidato =$VO->getArray('TX_NOME');
//    $smarty->assign('arrayCandidato',$arrayCandidato);

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