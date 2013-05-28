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
 
if ($_SESSION['TX_AGENCIA_ESTAGIO']){
    
    $VO->TX_AGENCIA_ESTAGIO = $_SESSION['TX_AGENCIA_ESTAGIO'];

    $VO->pesquisar();
    $VO->preencherVOBD($VO->getVetor());
    
    if($_POST){
        $VO->configuracao();
        $VO->setCaracteristica('TX_AGENCIA_ESTAGIO,TX_SIGLA,TX_CNPJ','obrigatorios');
                
	$validar = $VO->preencher($_POST);

        if (!$validar){
            $VO->alterar();
			$_SESSION['TX_AGENCIA_ESTAGIO'] = $VO->TX_AGENCIA_ESTAGIO;
                        $_SESSION['TX_SIGLA'] = $VO->TX_SIGLA;
                        $_SESSION['TX_CNPJ'] = $VO->TX_CNPJ;
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