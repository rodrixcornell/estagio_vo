<?php
require_once "../../php/define.php";
require_once $path."src/selecao/arrays.php";
require_once $pathvo."selecaoVO.php";

$modulo = 78;
$programa = 6;
$pasta = 'selecao';
$current = 1;
$titulopage = 'Seleção de Estágio';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new selecaoVO();

if ($_SESSION['ID_SELECAO_ESTAGIO']){
    
    $VO->ID_SELECAO_ESTAGIO = $_SESSION['ID_SELECAO_ESTAGIO'];
    $VO->pesquisarSelecao_Estagio();
    $VO->preencherVOBD($VO->getVetor());
  
    if($_POST){
		$VO->configuracao();
        $VO->setCaracteristica('ID_ORGAO_GESTOR_ESTAGIO,ID_ORGAO_ESTAGIO,ID_RECRUTAMENTO_ESTAGIO,CS_SITUACAO','obrigatorios');
		$validar = $VO->preencher($_POST);

        if (!$validar){
            $VO->alterar();
            header("Location: ".$url."src/".$pasta."/detail.php");
        }               
            
    }
    
    if($VO->ID_RECRUTAMENTO_ESTAGIO){
            $VO->buscarRecrutamento();
            $arrayRecrutamento =$VO->getArray('TX_COD_RECRUTAMENTO');
            $smarty->assign('arrayRecrutamento',$arrayRecrutamento);
    }
    
}else header("Location: ".$url."src/".$pasta."/index.php");

$smarty->assign("current"       , $current);
$smarty->assign("pasta"         , $pasta);
$smarty->assign("validar"		, $validar);
$smarty->assign("VO"			, $VO);
$smarty->assign("titulopage"    , $titulopage);
$smarty->assign("arquivoCSS"    , $pasta);
$smarty->assign("arquivoJS"     , $pasta);
$smarty->assign("nomeArquivo"   , $pasta."/".$nomeArquivo.".tpl");	
$smarty->display('index.tpl');
?>