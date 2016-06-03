<?php
require_once "../../php/define.php";
require_once $path . "src/quadro_vagas/arrays.php";
require_once $pathvo . "quadro_vagasVO.php";

$modulo = 78;
$programa = 9;
$pasta = 'quadro_vagas';
$current = 1;
$titulopage = 'Quadro de Vagas';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new quadro_vagasVO();


if ($_SESSION['ID_QUADRO_VAGAS_ESTAGIO']) {

    $VO->ID_QUADRO_VAGAS_ESTAGIO = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];

	$ativo = $VO->verificarAtivo();

	if ($ativo)
		$smarty->assign("msg", '<font color="#FF0000">*Não é possível alterar a situação do Quadro vagas pois já existe um outro com situação ATIVO, para alterar desative o anterior.</font><br /><br />');

    $VO->buscar();
    $VO->preencherVOBD($VO->getVetor());

    if ($_POST) {

		(!$ativo) ? $obrigatorios = 'ID_ORGAO_GESTOR_ESTAGIO,CS_SITUACAO' : $obrigatorios ='ID_ORGAO_GESTOR_ESTAGIO';

		$VO->configuracao();
		$VO->setCaracteristica($obrigatorios, 'obrigatorios');
		$validar = $VO->preencher($_POST);

		if (!$validar) {
			$VO->alterar();
			header("Location: " . $url . "src/" . $pasta . "/detail.php");
		}

    }
}else
    header("Location: " . $url . "src/" . $pasta . "/index.php");

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
