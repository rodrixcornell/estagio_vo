<?php
require_once "../../php/define.php";
require_once $path."src/selecao/arrays.php";
require_once $pathvo."selecaoVO.php";

$modulo = 78;
$programa = 6;
$pasta = 'selecao';
$current = 1;
$titulopage = 'Seleção de Estagiário';

session_start();
require_once "../autenticacao/validaPermissao.php";

 //Iniciando Instância
$VO = new selecaoVO();
$dados['MENSSAGEM'] = " ";    
if ($_SESSION['ID_SELECAO_ESTAGIO']){
    //$dados['MENSSAGEM'] = " ";
    $VO->ID_SELECAO_ESTAGIO = $_SESSION['ID_SELECAO_ESTAGIO'];
    
    $total = $VO->buscarSelecao_Estagio();
    $total ? $dados = $VO->getVetor() : false;

    if ($_POST['efetivar']){
                        
      $VO->ID_SELECAO_ESTAGIO = $dados['ID_SELECAO_ESTAGIO'][0];
      $VO->ID_RECRUTAMENTO_ESTAGIO = $dados['ID_RECRUTAMENTO_ESTAGIO'][0];  
      $VO->NB_VAGAS_RECRUTAMENTO =  $dados['NB_VAGAS_RECRUTAMENTO'][0];
      
      $aux = $VO->efetivar();  
      
      if (!$aux) {          
          $VO->EFETIVAR = 2; 
          $VO->atualizarInf(); 
      //    $dados['MENSSAGEM'] = " ";          
          header("Location: ".$url."src/".$pasta."/detail.php");
      }else{
          $dados['MENSSAGEM'] = "A seleção não pode ser efetivada pois existe(m) candidatos em análise!";
      }
      
    }       
    
    $VO->ID_RECRUTAMENTO_ESTAGIO = $dados['ID_RECRUTAMENTO_ESTAGIO'][0];
    $_SESSION['ID_RECRUTAMENTO_ESTAGIO'] = $dados['ID_RECRUTAMENTO_ESTAGIO'][0];
    $VO->pesquisarCandidatos();
    $arrayCandidato =$VO->getArray('TX_NOME');
    $smarty->assign('arrayCandidato',$arrayCandidato);

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