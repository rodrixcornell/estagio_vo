<?php
require_once "../../php/define.php";
require_once $path."src/curso/arrays.php";
require_once $pathvo."cursoVO.php";

$modulo = 78;
$programa = 5;
$pasta = 'curso';
$current = 1;
$titulopage = 'Curso';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new cursoVO();

if ($_SESSION['ID_CURSO_ESTAGIO']){
    
    $VO->ID_CURSO_ESTAGIO = $_SESSION['ID_CURSO_ESTAGIO'];
    $VO->buscar();
    $VO->preencherVOBD($VO->getVetor());
  
    if($_POST){
		$VO->configuracao();
		$VO->setCaracteristica('TX_CURSO_ESTAGIO,CS_AREA_CONHECIMENTO','obrigatorios');
		$validar = $VO->preencher($_POST);

        if (!$validar){
            $VO->alterar();
			$_SESSION['TX_CURSO_ESTAGIO'] = $VO->TX_CURSO_ESTAGIO;
			$_SESSION['CS_AREA_CONHECIMENTO'] = $VO->CS_AREA_CONHECIMENTO;
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