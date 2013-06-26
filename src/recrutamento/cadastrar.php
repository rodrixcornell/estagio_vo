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

unset($_SESSION['ID_RECRUTAMENTO_ESTAGIO']);

// Iniciando Instância
$VO = new recrutamentoVO();

if($_POST){
    $VO->configuracao();
    $VO->setCaracteristica('ID_QUADRO_VAGAS_ESTAGIO,ID_ORGAO_ESTAGIO','obrigatorios');
    $validar = $VO->preencher($_POST);
	
	(!$validar) ? $id_pk = $VO->inserir() : false;
	
    if (!$validar) {
        $_SESSION['ID_RECRUTAMENTO_ESTAGIO'] = $id_pk;
		 header("Location: ".$url."src/".$pasta."/detail.php");
    }
}

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