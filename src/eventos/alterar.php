<?php
require_once "../../php/define.php";
require_once $path."src/eventos/arrays.php";
require_once $pathvo."eventosVO.php";

$modulo = 80;
$programa = 2;
$pasta = 'eventos';
$current = 3;
$titulopage = 'Evento de Pagamento';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new eventosVO();

if ($_SESSION['ID_ITEM_PAGAMENTO_ESTAGIO']){
    
    $VO->ID_ITEM_PAGAMENTO_ESTAGIO = $_SESSION['ID_ITEM_PAGAMENTO_ESTAGIO'];
    $VO->pesquisarEventos();
    $VO->preencherVOBD($VO->getVetor());
  
    if($_POST){
		$VO->configuracao();
		$VO->setCaracteristica('TX_CODIGO,TX_DESCRICAO,TX_SIGLA,CS_TIPO,CS_SITUACAO','obrigatorios');
		$validar = $VO->preencher($_POST);

        if (!$validar){
            $VO->alterar();
            header("Location: ".$url."src/".$pasta."/detail.php");
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