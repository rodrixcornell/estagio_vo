<?php
require_once "../../php/define.php";
require_once $path."src/selecao/arrays.php";
require_once $pathvo."selecaoVO.php";

$modulo = 79;
$programa = 6;
$pasta = 'selecao';
$current = 2;
$titulopage = 'Seleção de Estagiário';

session_start();
require_once "../autenticacao/validaPermissao.php";

unset($_SESSION['ID_SELECAO_ESTAGIO']);

// Iniciando Instância
$VO = new selecaoVO();

if($_POST){
    $VO->configuracao();
    $VO->setCaracteristica('ID_ORGAO_GESTOR_ESTAGIO,ID_ORGAO_ESTAGIO,ID_RECRUTAMENTO_ESTAGIO','obrigatorios');
	$VO->setCaracteristica('DT_AGENDAMENTO,DT_REALIZACAO','datas');
    $validar = $VO->preencher($_POST);
	
	(!$validar) ? $id_pk = $VO->inserir() : false;
	
    if ($id_pk) {
        $_SESSION['ID_SELECAO_ESTAGIO'] = $id_pk;
		header("Location: ".$url."src/".$pasta."/detail.php");
    }
	
	if ($VO->ID_ORGAO_GESTOR_ESTAGIO) {
		$VO->buscarSolicitante();
		$smarty->assign("arrayOrgaoSolicitante", $VO->getArray("TX_ORGAO_ESTAGIO"));
		
		if ($VO->ID_ORGAO_ESTAGIO) {
			$VO->buscarRecrutamento();
			$smarty->assign("arrayRecrutamento", $VO->getArray("TX_COD_RECRUTAMENTO"));
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