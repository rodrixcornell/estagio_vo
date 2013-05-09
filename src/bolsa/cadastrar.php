<?php
require_once "../../php/define.php";
require_once $path."src/bolsa/arrays.php";
require_once $pathvo."bolsaVO.php";

$modulo = 78;
$programa = 1;
$pasta = 'bolsa';
$current = 3;
$titulopage = 'Bolsa de Estágio';

session_start();
require_once "../autenticacao/validaPermissao.php";

unset($_SESSION['ID_BOLSA_ESTAGIO']);

// Iniciando Instância
$VO = new bolsaVO();

if($_POST){
    $VO->configuracao();
    $VO->setCaracteristica('TX_BOLSA_ESTAGIO,NB_VALOR','obrigatorios');
   
    $validar = $VO->preencher($_POST);

	(!$validar) ? $id_pk = $VO->inserir() : false;

    if (!$validar) {
        $_SESSION['ID_BOLSA_ESTAGIO'] = $id_pk;
		$_SESSION['STATUS'] = '*Registro inserido com sucesso!';
		$_SESSION['PAGE'] = '1';
		header("Location: ".$url."src/".$pasta."/index.php");
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