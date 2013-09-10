<?php
require_once "../../../php/define.php";
require_once $path."src/relatorios/recrutamento/arrays.php";
require_once $pathvo."recrutamentoVO.php";

$modulo = 81;
$programa = 7;
$pasta = 'recrutamento';
$current = 4;
$titulopage = 'Recrutamento de Estágio';

require_once "../../autenticacao/validaPermissao.php";

session_start();


if ($_POST){
    $VO = new recrutamentoVO();
    $VO->setCaracteristica('ID_RECRUTAMENTO_ESTAGIO','obrigatorios'); 
    $validar = $VO->preencher($_POST);
	
  if (!$validar){
      
       $_SESSION['ID_RECRUTAMENTO_ESTAGIO'] = $VO->ID_RECRUTAMENTO_ESTAGIO;
       header("Location: ".$url."src/relatorios/".$pasta."/relatorio.php");
	}
}

$smarty->assign("current"       , $current);
$smarty->assign("pasta"         , $pasta);
$smarty->assign("titulopage"    , $titulopage);
$smarty->assign("validar"		, $validar);
$smarty->assign("VO"			, $VO);
$smarty->assign("arquivoJS"     , $pasta);
$smarty->assign("nomeArquivo"   , "relatorios/".$pasta."/".$nomeArquivo.".tpl");	
$smarty->display('index.tpl');
?>