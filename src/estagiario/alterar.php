<?php
require_once "../../php/define.php";
require_once $path."src/estagiario/arrays.php";
require_once $pathvo."estagiarioVO.php";

$modulo = 79;
$programa = 1;
$pasta = 'estagiario';
$current = 1;
$titulopage = 'Estagiário';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new estagiarioVO();

if ($_SESSION['ID_PESSOA_ESTAGIARIO']){
    
    $VO->ID_PESSOA_ESTAGIARIO = $_SESSION['ID_PESSOA_ESTAGIARIO'];

    $VO->pesquisar();
    $VO->preencherVOBD($VO->getVetor());
    
    if($_POST){
		$VO->configuracao();
        $VO->setCaracteristica('TX_NOME,NB_CPF,NB_RG,TX_ORGAO_EMISSOR,DT_EMISSAO,CS_SEXO','obrigatorios');
    	$VO->setCaracteristica('DT_EMISSAO,DT_NASCIMENTO','datas'); 

               
		$validar = $VO->preencher($_POST);
        if (!$validar){
            $VO->alterar();
			$_SESSION['ID_PESSOA_ESTAGIARIO'] = $VO->ID_PESSOA_ESTAGIARIO;
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