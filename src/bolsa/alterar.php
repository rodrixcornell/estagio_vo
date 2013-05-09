<?php
require_once "../../php/define.php";
require_once $path."src/bolsa/arrays.php";
require_once $pathvo."bolsaVO.php";

$modulo = 78;
$programa = 1;
$pasta = 'bolsa';
$current = 3;
$titulopage = 'Bolsa de Estágio';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new bolsaVO();

if ($_SESSION['ID_BOLSA_ESTAGIO']){
    
    $VO->ID_BOLSA_ESTAGIO = $_SESSION['ID_BOLSA_ESTAGIO'];

    $VO->pesquisar();
    $VO->preencherVOBD($VO->getVetor());
    
    if($_POST){
		$VO->configuracao();
        $VO->setCaracteristica('TX_BOLSA_ESTAGIO,NB_VALOR','obrigatorios');
        $VO->verificarMoeda('NB_VALOR');
                
		$validar = $VO->preencher($_POST);

        if (!$validar){
            $VO->alterar();
			$_SESSION['ID_BOLSA_ESTAGIO'] = $VO->ID_BOLSA_ESTAGIO;
			$_SESSION['STATUS'] = '*Registro alterado com sucesso!';
			$_SESSION['PAGE'] = '1';
            header("Location: ".$url."src/".$pasta."/index.php");
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