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

unset($_SESSION['ID_ITEM_PAGAMENTO_ESTAGIO']);

// Iniciando Instância
$VO = new eventosVO();

    if($_POST){
    
        $VO->configuracao();
        $VO->setCaracteristica('TX_CODIGO,TX_DESCRICAO,TX_SIGLA,CS_TIPO,CS_SITUACAO','obrigatorios');
        $validar = $VO->preencher($_POST);
    	
    	(!$validar) ? $id_pk = $VO->inserir() : false;
    	
        if (!$validar) {
            $_SESSION['ID_ITEM_PAGAMENTO_ESTAGIO'] = $id_pk;
    		header("Location: ".$url."src/".$pasta."/detail.php");
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