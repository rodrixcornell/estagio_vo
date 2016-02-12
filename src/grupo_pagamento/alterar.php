<?php
require_once "../../php/define.php";
require_once $path."src/grupo_pagamento/arrays.php";
require_once $pathvo."grupo_pagamentoVO.php";

$modulo = 80;
$programa = 8;
$pasta = 'grupo_pagamento';
$current = 3;
$titulopage = 'Grupo de Pagamento';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new grupo_pagamentoVO();

if ($_SESSION['ID_GRUPO_PAGAMENTO']){
    
    $VO->ID_GRUPO_PAGAMENTO = $_SESSION['ID_GRUPO_PAGAMENTO'];

    $VO->pesquisar();
    $VO->preencherVOBD($VO->getVetor());
    
    if($_POST){
        $VO->configuracao();
        $VO->setCaracteristica('TX_GRUPO_PAGAMENTO','obrigatorios');
	$validar = $VO->preencher($_POST);

       if (!$validar) {
			if (!$validar){
				$VO->alterar();
				$_SESSION['ID_GRUPO_PAGAMENTO'] = $VO->ID_GRUPO_PAGAMENTO;
				$_SESSION['STATUS'] = '*Registro alterado com sucesso!';
				$_SESSION['PAGE'] = '1';
			  header("Location: ".$url."src/".$pasta."/index.php");
        }
    }
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