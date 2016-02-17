<?php
require_once "../../php/define.php";
require_once $pathvo . "tipo_pagamentoVO.php";

$modulo = 80;
$programa = 4;
$pasta = 'tipo_pagamento';
$current = 3;
$titulopage = 'Tipo de Pagamento';

session_start();
require_once "../autenticacao/validaPermissao.php";

unset($_SESSION['CS_TIPO_PAG_ESTAGIO']);

// Iniciando Instância
$VO = new tipo_pagamentoVO();

if ($_POST) {
    $VO->configuracao();
    $VO->setCaracteristica('CS_TIPO_PAG_ESTAGIO,TX_TIPO_PAG_ESTAGIO', 'obrigatorios');
    $VO->setCaracteristica('CS_TIPO_PAG_ESTAGIO', 'numeros');
    $validar = $VO->preencher($_POST);
	
	if (!$validar){
		 if (!$VO->inserir()){
			 $_SESSION['CS_TIPO_PAG_ESTAGIO'] = $VO->CS_TIPO_PAG_ESTAGIO;
			 $_SESSION['STATUS'] = '*Registro inserido com sucesso!';
			 $_SESSION['PAGE'] = '1';
			 header("Location: " . $url . "src/" . $pasta . "/index.php");
		 }else
			 $validar['CS_TIPO_PAG_ESTAGIO'] = 'Registro já existe!';
		
	}
	
}

$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("validar", $validar);
$smarty->assign("VO", $VO);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("arquivoCSS", $pasta);
$smarty->assign("arquivoJS", $pasta);
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>