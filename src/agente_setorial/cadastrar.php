<?php
require_once "../../php/define.php";
require_once $path."src/agente_setorial/arrays.php";
require_once $pathvo."agente_setorialVO.php";

$modulo = 78;
$programa = 3;
$pasta = 'agente_setorial';
$current = 1;
$titulopage = 'Agente Setorial';

session_start();
require_once "../autenticacao/validaPermissao.php";

unset($_SESSION['ID_RESP_UNID_IRP']);

// Iniciando Instância
$VO = new agente_setorialVO();

if($_POST){
    $VO->configuracao();
    $VO->setCaracteristica('ID_USUARIO_RESP','obrigatorios');
    $validar = $VO->preencher($_POST);
	
	(!$validar) ? $id_pk = $VO->inserir() : false;
	
    if (!$validar) {
        $_SESSION['ID_RESP_UNID_IRP'] = $id_pk;
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