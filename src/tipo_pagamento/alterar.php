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

//Iniciando Instância
$VO = new tipo_pagamentoVO();
if ($_SESSION['CS_TIPO_PAG_ESTAGIO']) {

    $VO->CS_TIPO_PAG_ESTAGIO = $_SESSION['CS_TIPO_PAG_ESTAGIO'];

    $VO->buscar();
    $VO->preencherVOBD($VO->getVetor());

    if ($_POST) {
        $VO->configuracao();
        $VO->setCaracteristica('CS_TIPO_PAG_ESTAGIO,TX_TIPO_PAG_ESTAGIO', 'obrigatorios');
        $VO->setCaracteristica('CS_TIPO_PAG_ESTAGIO', 'numeros');
        $VO->preencher($_POST);

        if (!$validar) {
			if (!$validar){
				$VO->alterar();
				$_SESSION['CS_TIPO_PAG_ESTAGIO'] = $VO->CS_TIPO_PAG_ESTAGIO;
				$_SESSION['STATUS'] = '*Registro alterado com sucesso!';
				$_SESSION['PAGE'] = '1';
				header("Location: ".$url."src/".$pasta."/index.php");
        	}
        }
    }
}
$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("erro", $erro);
$smarty->assign("validar", $validar);
$smarty->assign("VO", $VO);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("arquivoCSS", $pasta);
$smarty->assign("arquivoJS", $pasta);
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>