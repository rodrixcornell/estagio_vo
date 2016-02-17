<?php
require_once "../../php/define.php";
require_once $path . "src/solicitacao/arrays.php";
require_once $pathvo . "solicitacaoVO.php";

$modulo = 79;
$programa = 3;
$pasta = 'solicitacao';
$current = 2;
$titulopage = 'Oferta de Vaga';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new solicitacaoVO();

if ($_SESSION['ID_OFERTA_VAGA']) {

    $VO->ID_OFERTA_VAGA = $_SESSION['ID_OFERTA_VAGA'];
    $VO->buscar();
    $VO->preencherVOBD($VO->getVetor());
	$VO->NB_VALOR_TRANSPORTE ? $VO->NB_VALOR_TRANSPORTE = number_format($VO->NB_VALOR_TRANSPORTE, 2, ',', '.') : false;
	
	$gestor = $VO->verficarGestor();
	
    if ($VO->ID_ORGAO_ESTAGIO) {
        $VO->buscarAgenciaEstagio();
        $smarty->assign("arrayAgenciaEstagio", $VO->getArray("TX_AGENCIA_ESTAGIO"));
		
		if ($VO->ID_AGENCIA_ESTAGIO && $VO->ID_QUADRO_VAGAS_ESTAGIO) {
        	$VO->buscarTipoVaga();
        	$smarty->assign("arrayTipoVaga", $VO->getArray("TX_TIPO_VAGA_ESTAGIO"));
		}
    }

    if ($_POST) {
		
		unset($VO->CS_WINDOWS,  $VO->CS_WORD, $VO->CS_EXCEL, $VO->CS_POWERPOINT, $VO->CS_INTERNET, $VO->CS_CORELDRAW, $VO->CS_PHOTOSHOP, $VO->CS_WEBDESIGN, $VO->CS_AUTOCAD, $VO->CS_INGLES, $VO->CS_ESPANHOL, $VO->CS_FRANCES, $VO->CS_ALEMAO);
		
		$gestor ? $situacao = ',CS_SITUACAO' : false;
		
        $VO->configuracao();
		$VO->setCaracteristica('ID_ORGAO_GESTOR_ESTAGIO,ID_ORGAO_ESTAGIO,ID_AGENCIA_ESTAGIO,CS_TIPO_VAGA_ESTAGIO,ID_QUADRO_VAGAS_ESTAGIO,TX_PESSOA_CONTATO,TX_TELEFONE,TX_CARGO_FUNCAO,TX_EMAIL,TX_ENDERECO,NB_QUANTIDADE,NB_QTDE_EMCAMINHADO,DT_ENTREVISTA,TX_HORARIO,NB_DURACAO_ESTAGIO,ID_BOLSA_ESTAGIO,NB_VALOR_TRANSPORTE,CS_ESCOLARIDADE,TX_HORA_INICIO,TX_HORA_FINAL,TX_ATIVIDADES'.$situacao, 'obrigatorios');
		$VO->setCaracteristica('TX_EMAIL', 'emails');
		$VO->setCaracteristica('DT_ENTREVISTA', 'datas');
		$validar = $VO->preencher($_POST);
		
		(strlen($_POST['TX_ATIVIDADES']) > 400) ? $validar['TX_ATIVIDADES'] = 'Valor máximo de 200 caracteres, atual de: ' . strlen($_POST['TX_ATIVIDADES']) : false;
		
		if (!$validar) {
			$VO->alterar();
			header("Location: " . $url . "src/" . $pasta . "/detail.php");
			exit;
    	}
	
	}
}else
    header("Location: " . $url . "src/" . $pasta . "/index.php");

$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("validar", $validar);
$smarty->assign("recrutamento", $recrutamento);
$smarty->assign("gestor", $gestor);
$smarty->assign("VO", $VO);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("arquivoCSS", $pasta);
$smarty->assign("arquivoJS", $pasta);
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>