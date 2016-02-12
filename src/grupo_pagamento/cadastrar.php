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

unset($_SESSION['ID_GRUPO_PAGAMENTO']);

// Iniciando Instância
$VO = new grupo_pagamentoVO();

if($_POST){
        $VO->configuracao();
    $VO->setCaracteristica('ID_GRUPO_PAGAMENTO,TX_GRUPO_PAGAMENTO', 'obrigatorios');
    $VO->setCaracteristica('ID_GRUPO_PAGAMENTO', 'numeros');
    $validar = $VO->preencher($_POST);
	
	if (!$validar){
		 if (!$VO->inserir()){
			 $_SESSION['ID_GRUPO_PAGAMENTO'] = $VO->ID_GRUPO_PAGAMENTO;
			 $_SESSION['STATUS'] = '*Registro inserido com sucesso!';
			 $_SESSION['PAGE'] = '1';
			 header("Location: " . $url . "src/" . $pasta . "/index.php");
		 }else
			 $validar['ID_GRUPO_PAGAMENTO'] = 'Registro já existe!';
		
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