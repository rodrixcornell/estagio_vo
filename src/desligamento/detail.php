<?php
require_once "../../php/define.php";
require_once $path . "src/desligamento/arrays.php";
require_once $pathvo . "desligamentoVO.php";

$modulo = 79;
$programa = 10;
$pasta = 'desligamento';
$current = 2;
$titulopage = 'Solicitação de Desligamento';

session_start();
require_once "../autenticacao/validaPermissao.php";

 //Iniciando Instância
$VO = new desligamentoVO();
$dados['MENSSAGEM'] = " ";    
if ($_SESSION['ID_SOLICITACAO_DESLIG']){
    //$dados['MENSSAGEM'] = " ";
    $VO->ID_SOLICITACAO_DESLIG = $_SESSION['ID_SOLICITACAO_DESLIG'];
    
    $total = $VO->pesquisar();
    $total ? $dados = $VO->getVetor() : false;

    if ($_POST['efetivar']){
                        
      $VO->ID_SOLICITACAO_DESLIG = $dados['ID_SOLICITACAO_DESLIG'][0];
      
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