<?php
require_once "../../php/define.php";
require_once $path."src/quadro_vagas/arrays.php";
require_once $pathvo."quadro_vagasVO.php";

$modulo = 79;
$programa = 1;
$pasta = 'quadro_vagas';
$current = 2;
$titulopage = 'Quadro de Vagas';

session_start();
require_once "../autenticacao/validaPermissao.php";

unset($_SESSION['ID_QUADRO_VAGAS_ESTAGIO']);

// Iniciando Instância
$VO = new quadro_vagasVO();

/*if($_POST){
    $VO->configuracao();
    $VO->setCaracteristica('ID_ORGAO_GESTOR_ESTAGIO,ID_AGENCIA_ESTAGIO,CS_SITUACAO','obrigatorios');
    $validar = $VO->preencher($_POST);
  
(!$validar) ? $id_pk = $VO->inserir() : false;

	
      print_r($id_pk);
    if (!$validar) {
        $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'] = $id_pk;
		header("Location: ".$url."src/".$pasta."/detail.php");
    }
}*/

if($_POST){
    
    $VO->configuracao(); 
    $VO->setCaracteristica('TX_CODIGO,ID_ORGAO_GESTOR_ESTAGIO,ID_AGENCIA_ESTAGIO','obrigatorios');
    //$VO->setCaracteristica('TX_CODIGO','numeros');   
    $validar = $VO->preencher($_POST);  
    
    if(($_REQUEST['CS_SITUACAO'] == "0") || ($_REQUEST['CS_SITUACAO'] == "1")){
        unset ($validar['CS_SITUACAO']);
    }
    if (!$validar) $id_pk = $VO->inserir();
    
    
	if ($id_pk){	
           $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'] = $id_pk;    
           header("Location: ".$url."src/".$pasta."/detail.php");
        }       
 //else {            echo('Você não tem permisssão para está '); } 	
}

$smarty->assign("current"       , $current);
$smarty->assign("pasta"         , $pasta);
$smarty->assign("validar"	, $validar);
$smarty->assign("VO"		, $VO);
$smarty->assign("titulopage"    , $titulopage);
$smarty->assign("arquivoCSS"    , $pasta);
$smarty->assign("arquivoJS"     , $pasta);
$smarty->assign("nomeArquivo"   , $pasta."/".$nomeArquivo.".tpl");	
$smarty->display('index.tpl');
?>