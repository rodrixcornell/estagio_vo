<?php
require_once "../../php/define.php";
require_once $path."src/supervisor/arrays.php";
require_once $pathvo. "supervisorVO.php";

$modulo = 78;
$programa = 1;
$pasta = 'supervisor';
$current = 8;
$titulopage = 'Supervisor de Estágio';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new supervisorVO();
 
if ($_SESSION['ID_PESSOA_FUNCIONARIO']){
    
    $VO->ID_PESSOA_FUNCIONARIO = $_SESSION['ID_PESSOA_FUNCIONARIO'];

    $VO->pesquisar();
    $VO->preencherVOBD($VO->getVetor());
    
   if($_POST){
    $VO->configuracao();
    $VO->setCaracteristica('NB_FUNCIONARIO,TX_CARGO,TX_FORMACAO,ID_CONSELHO,NB_INSCRICAO_CONSELHO,TX_CURRICULO','obrigatorios');
    $VO->setCaracteristica('NB_INSCRICAO_CONSELHO','numeros');
    
    $validar = $VO->preencher($_POST);
    
    if (!$validar) {
        $VO->alterar();
        
        $_SESSION['NB_FUNCIONARIO'] = $VO->ID_PESSOA_FUNCIONARIO.'_'.$VO->NB_FUNCIONARIO; 
        $_SESSION['TX_CARGO'] = $VO->TX_CARGO; 
        $_SESSION['STATUS'] = '*Registro alterado com sucesso!';
        $_SESSION['PAGE'] = '1';
        
     header("Location: ".$url."src/".$pasta."/index.php");
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