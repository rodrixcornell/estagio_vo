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

unset($_SESSION['ID_OFERTA_VAGA']);

// Iniciando Instância
$VO = new solicitacaoVO();

if ($_POST) {
    $VO->configuracao();
    $VO->setCaracteristica('ID_ORGAO_GESTOR_ESTAGIO,ID_ORGAO_ESTAGIO,ID_AGENCIA_ESTAGIO,CS_TIPO_VAGA_ESTAGIO,ID_QUADRO_VAGAS_ESTAGIO,TX_PESSOA_CONTATO,TX_TELEFONE,TX_CARGO_FUNCAO,TX_EMAIL,TX_ENDERECO,NB_QUANTIDADE,NB_QTDE_EMCAMINHADO,DT_ENTREVISTA,TX_HORARIO,NB_DURACAO_ESTAGIO,ID_BOLSA_ESTAGIO,NB_VALOR_TRANSPORTE,CS_ESCOLARIDADE,TX_HORA_INICIO,TX_HORA_FINAL,TX_ATIVIDADES', 'obrigatorios');
	$VO->setCaracteristica('TX_EMAIL', 'emails');
	$VO->setCaracteristica('DT_ENTREVISTA', 'datas');
    $validar = $VO->preencher($_POST);

    (strlen($_POST['TX_ATIVIDADES']) > 400) ? $validar['TX_ATIVIDADES'] = 'Valor máximo de 200 caracteres, atual de: ' . strlen($_POST['TX_ATIVIDADES']) : false;
	
    if (!$validar) 
        $id_pk = $VO->inserir();

	if ($id_pk) {
		$_SESSION['ID_OFERTA_VAGA'] = $id_pk;
		header("Location: " . $url . "src/" . $pasta . "/detail.php");
		exit;
	}
    


    if ($VO->ID_ORGAO_ESTAGIO) {
        $VO->buscarAgenciaEstagio();
        $smarty->assign("arrayAgenciaEstagio", $VO->getArray("TX_AGENCIA_ESTAGIO"));
		
		if ($VO->ID_AGENCIA_ESTAGIO && $VO->ID_QUADRO_VAGAS_ESTAGIO) {
        	$VO->buscarTipoVaga();
        	$smarty->assign("arrayTipoVaga", $VO->getArray("TX_TIPO_VAGA_ESTAGIO"));
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