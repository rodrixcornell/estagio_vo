<?php
require_once "../../php/define.php";
require_once $path . "src/quadro_vagas/arrays.php";
require_once $pathvo . "quadro_vagasVO.php";

$modulo = 78;
$programa = 2;
$pasta = 'quadro_vagas';
$current = 1;
$titulopage = 'Quadro de Vagas';

session_start();
require_once "../autenticacao/validaPermissao.php";

unset($_SESSION['ID_QUADRO_VAGAS_ESTAGIO']);

// Iniciando Instância
$VO = new quadro_vagasVO();

$ativo = $VO->verificarAtivo();

if ($ativo)
	$smarty->assign("msg", '<font color="#FF0000">*Não é possível cadastrar um novo Quadro de Vagas pois já existe um outro com situação ATIVO, para cadastrar um novo desative o anterior.</font><br /><br />');

if ($_POST) {

	if (!$ativo){

		$VO->configuracao();
		$VO->setCaracteristica('ID_ORGAO_GESTOR_ESTAGIO,CS_SITUACAO,ID_CONTRATO_CP', 'obrigatorios');
		$validar = $VO->preencher($_POST);
	
		if (!$validar)
			$id_pk = $VO->inserir();
	
		if ($id_pk) {
			$_SESSION['ID_QUADRO_VAGAS_ESTAGIO'] = $id_pk;
			header("Location: " . $url . "src/" . $pasta . "/detail.php");
		}
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