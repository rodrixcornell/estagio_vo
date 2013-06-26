<?php
require_once "../../php/define.php";
require_once $path."src/recrutamento/arrays.php";
require_once $pathvo."recrutamentoVO.php";

$modulo = 79;
$programa = 5;
$pasta = 'recrutamento';
$current = 2;
$titulopage = 'Recrutamento de Estagiário';

session_start();
require_once "../autenticacao/validaPermissao.php";

unset($_SESSION['ID_RECRUTAMENTO_ESTAGIO']);

// Iniciando Instância
$VO = new recrutamentoVO();

if($_POST){
    $VO->configuracao();
    $VO->setCaracteristica('ID_ORGAO_GESTOR_ESTAGIO,ID_ORGAO_ESTAGIO,ID_SOLICITACAO_ESTAGIO,ID_QUADRO_VAGAS_ESTAGIO','obrigatorios');
    $validar = $VO->preencher($_POST);
	
	(!$validar) ? $id_pk = $VO->inserir() : false;
	
    if ($id_pk) {
        $_SESSION['ID_RECRUTAMENTO_ESTAGIO'] = $id_pk;
		 header("Location: ".$url."src/".$pasta."/detail.php");
		 exit;
    }
	
	if ($VO->ID_ORGAO_GESTOR_ESTAGIO) {
		$VO->buscarSolicitante();
		$smarty->assign("arrayOrgaoSolicitante", $VO->getArray("TX_ORGAO_ESTAGIO"));
		
		if ($VO->ID_ORGAO_ESTAGIO) {
			$VO->buscarSolicitacao();
			$smarty->assign("arraySolicitacao", $VO->getArray("TX_COD_SOLICITACAO"));
			
			if ($VO->ID_SOLICITACAO_ESTAGIO) {
				$VO->buscarQuadroVagas();
				$smarty->assign("arrayQuadroVagas", $VO->getArray("TX_CODIGO"));
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