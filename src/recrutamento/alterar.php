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

// Iniciando Instância
$VO = new recrutamentoVO();

if ($_SESSION['ID_RECRUTAMENTO_ESTAGIO']){
    
    $VO->ID_RECRUTAMENTO_ESTAGIO = $_SESSION['ID_RECRUTAMENTO_ESTAGIO'];
    $VO->buscar();
    $VO->preencherVOBD($VO->getVetor());
  
    if($_POST){
		$VO->configuracao();
        $VO->setCaracteristica('ID_QUADRO_VAGAS_ESTAGIO,ID_ORGAO_ESTAGIO,TX_DOC_AUTORIZACAO','obrigatorios');
		$validar = $VO->preencher($_POST);

        if (!$validar){
             $VO->alterar();
             header("Location: ".$url."src/".$pasta."/detail.php");
        }
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