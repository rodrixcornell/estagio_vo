<?php
require_once "../../php/define.php";
require_once $path."src/recrutamento/arrays.php";
require_once $pathvo."recrutamentoVO.php";

$modulo = 79;
$programa = 5;
$pasta = 'recrutamento';
$current = 2;
$titulopage = 'Recrutamento de Estagiário';

session_start();
require_once "../autenticacao/validaPermissao.php";

 //Iniciando Instância
$VO = new recrutamentoVO();

if ($_SESSION['ID_RECRUTAMENTO_ESTAGIO']){
     
    $VO->ID_RECRUTAMENTO_ESTAGIO = $_SESSION['ID_RECRUTAMENTO_ESTAGIO'];
    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];
    $VO->ID_ORGAO_ESTAGIO        = $_SESSION['ID_ORGAO_ESTAGIO'];


    if ($_POST['efetivar']){
	
	  $VO->efetivar(); 
	  header("Location: ".$url."src/".$pasta."/detail.php");
	}	
	
	
    $total = $VO->buscar();
    $total ? $dados = $VO->getVetor() : false;

}
else 
   header("Location: ".$url."src/".$pasta."/index.php");


$VO->pesquisarTipoVagaEstagio();
    $arrayTipoVagaEstagioDetail = $VO->getArray("TX_TIPO_VAGA_ESTAGIO");  
	
$smarty->assign("arrayTipoVagaEstagioDetail", $arrayTipoVagaEstagioDetail);
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