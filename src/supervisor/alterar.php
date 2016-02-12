<?php
require_once "../../php/define.php";
require_once $path."src/supervisor/arrays.php";
require_once $pathvo. "supervisorVO.php";

$modulo = 78;
$programa = 8;
$pasta = 'supervisor';
$current = 1;
$titulopage = 'Supervisor de Estágio';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new supervisorVO();

if ($_SESSION['ID_PESSOA_SUPERVISOR']){
    
    $VO->ID_PESSOA_SUPERVISOR = $_SESSION['ID_PESSOA_SUPERVISOR'];

    $VO->buscar();
    $VO->preencherVOBD($VO->getVetor());
    
   if($_POST){
    $VO->configuracao();
    $VO->setCaracteristica('ID_PESSOA_FUNCIONARIO,TX_CARGO,TX_FORMACAO,TX_TEMPO_EXPERIENCIA','obrigatorios');
    $VO->setCaracteristica('NB_INSCRICAO_CONSELHO','numeros');
    $validar = $VO->preencher($_POST);
    
    if (!$validar) {
		$retorno = $VO->alterar();        
		if (!$retorno){
			
			$codigo = explode('_', $VO->ID_PESSOA_FUNCIONARIO);
		    $VO->ID_PESSOA_SUPERVISOR = $codigo[0];
			$VO->pesquisar();
			$dados = $VO->getVetor();
			
			$_SESSION['TX_NOME'] = $dados['TX_NOME'][0];
			$_SESSION['TX_CARGO'] = $VO->TX_CARGO;      
			$_SESSION['STATUS'] = '*Registro alterado com sucesso!';
			$_SESSION['PAGE'] = '1';
			header("Location: ".$url."src/".$pasta."/index.php");
		}else{
			$validar['ID_PESSOA_FUNCIONARIO'] = 'Registro já existe.';
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