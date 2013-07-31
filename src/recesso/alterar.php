<?php
require_once "../../php/define.php";
require_once $path."src/recesso/arrays.php";
require_once $pathvo."recessoVO.php";

$modulo = 79;
$programa = 9;
$pasta = 'recesso';
$current = 1;
$titulopage = 'Recesso de Estágio';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new recessoVO();

if ($_SESSION['ID_RECESSO_ESTAGIO']){
    
    $VO->ID_RECESSO_ESTAGIO = $_SESSION['ID_RECESSO_ESTAGIO'];
    $VO->buscar();
    $VO->preencherVOBD($VO->getVetor());
  
    if($_POST){
		$VO->configuracao();
    $VO->setCaracteristica('ID_ORGAO_ESTAGIO,ID_ORGAO_GESTOR_ESTAGIO,ID_CONTRATO,TX_CARGO_AGENTE,TX_EMAIL_AGENTE,TX_TELEFONE_AGENTE,DT_INICIO_VIG_ESTAGIO,DT_FIM_VIGENCIA_ESTAGIO,ID_AGENCIA_ESTAGIO,NB_ANO_REFERENCIA,
						   NB_MES_REFERENCIA,DT_INICIO_RECESSO,DT_FIM_RECESSO,ID_SETORIAL_ESTAGIO,TX_CHEFIA_IMEDIATA,CS_REALIZACAO', 'obrigatorios');
		$validar = $VO->preencher($_POST);

        if (!$validar){
            $VO->alterar();
			$_SESSION['ID_RECESSO_ESTAGIO'] = $VO->ID_RECESSO_ESTAGIO;
			$_SESSION['STATUS'] = '*Registro alterado com sucesso!';
			$_SESSION['PAGE'] = '1';
       //     header("Location: ".$url."src/".$pasta."/index.php");
        }
    }
}else header("Location: ".$url."src/".$pasta."/index.php");

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