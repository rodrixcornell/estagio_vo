<?php
set_time_limit(180);
//error_reporting(0);
session_start();

$srv = 0;

switch ($srv){
    case 0: // Desenvolvimento
        $projeto 		= "/semad/estagio/";
        $url 			= 'http://'.$_SERVER[SERVER_NAME].$projeto;
        $path 			= $_SERVER['DOCUMENT_ROOT'].$projeto;
        break;
    case 1: // Homologacao
        $projeto                = "/semad/estagio/";
        $url                    = 'http://'.$_SERVER[SERVER_NAME].$projeto;
        $path                   = $_SERVER['DOCUMENT_ROOT'].$projeto;
        break;
    case 3: // Producao
        $projeto 		= "/estagio/";
        $url 			= 'http://'.$_SERVER[SERVER_NAME].$projeto;
        $path 			= $_SERVER['DOCUMENT_ROOT'].$projeto;
        break;
}

    $titulo 		= 'Gestão de Estágiarios - Prefeitura de Manaus';
	$urlcss 		= $url.'css/';
	$urlimg 		= $url.'img/';
	$pathvo 		= $path.'src/vo/';
	$pathimg 		= $path.'img/';
	$pathArquivo    = $path.'arquivo/';


//banco
    
	$ipBanco 		= "172.18.0.33:1521/pmm";
	//$ipBanco 		= "172.18.1.160:1521/pmm";
	$usuario 		= $_SESSION['usuario'];
	$senha 			= $_SESSION['senha'];
	$sid_oracle             = "SEMAD"; 
	
	$GLOBALS["pathimg"] = $pathimg;
	$GLOBALS["pathArquivo"] = $pathArquivo;
	$GLOBALS["projeto"] = $projeto; //caminho do projeto depois de document_root	

//Configurações Smarty

require_once($path."php/Smarty/Smarty.class.php");
$smarty = new Smarty;

$smarty -> template_dir 	= $path.'templates/';
$smarty -> compile_dir		= $path.'templates_c/';
$smarty -> config_dir		= $path.'configs/';
$smarty -> cache_dir		= $path.'cache/';
$smarty -> force_compile	= 'true';
$smarty -> compile_check    = 'true';
//$smarty -> debugging            = 'true';


//Mes por extenso
$arrayMesExtenso[1] = "janeiro";
$arrayMesExtenso[2] = "fevereiro";
$arrayMesExtenso[3] = "março";
$arrayMesExtenso[4] = "abril";
$arrayMesExtenso[5] = "maio";
$arrayMesExtenso[6] = "junho";
$arrayMesExtenso[7] = "julho";
$arrayMesExtenso[8] = "agosto";
$arrayMesExtenso[9] = "setembro";
$arrayMesExtenso[10] = "outubro";
$arrayMesExtenso[11] = "novembro";
$arrayMesExtenso[12] = "dezembro";

//Se nao estiver logado redireciona para  pagina de login
	if(!$_SESSION['usuario'] && $projeto."src/autenticacao/index.php" != $_SERVER['PHP_SELF'] && strpos($_SERVER['PHP_SELF'], 'estagio') > 0 ){
		header("Location: ".$url."src/autenticacao/index.php");
	}
	
//Topo Bem vindo usuario	
	if ($usuario){
		$smarty->assign("msgAuthLeft", "Bem vindo, ".$_SESSION['NOME']
						."&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$url."src/autenticacao/trocaSenha.php'><img src='".$urlimg."topo/senha.png' /></a>"
						."&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$url."src/autenticacao/logout.php'><img src='".$urlimg."topo/sair.png' /></a>"
						."&nbsp;&nbsp;&nbsp;&nbsp;<a href='http://sistemaspmm.manaus.am.gov.br/'><img src='".$urlimg."topo/home.png' /></a>");
	}
	else{
		$smarty->assign("msgAuthLeft", "<a href='".$url."'><img src='".$urlimg."topo/entrar.png' /></a>"
		."&nbsp;&nbsp;&nbsp;&nbsp;<a href='http://sistemaspmm.manaus.am.gov.br/'><img src='".$urlimg."topo/home.png' /></a>");
	}

$arraySessao = array('ID_USUARIO', 'ID_PESSOA_FUNCIONARIO', 'TX_LOGIN', 'NOME', 'ID_UNIDADE_GESTORA', 'TX_UNIDADE_ORG', 'TX_SIGLA_UNIDADE', 'TX_EMAIL_PMM', 'usuario', 'senha');
	
	//Limpar Session
	if ($_REQUEST['s']){
		while(list($key,$val) = each($_SESSION))
			if (!in_array($key, $arraySessao))
				unset($_SESSION[$key]);
		$smarty -> assign("s"	,$_REQUEST['s']);
	}

@$nomeArquivo = array_shift(explode(".",array_pop(explode("/",$_SERVER['SCRIPT_FILENAME']))));


$smarty -> assign("urlcss"				,$urlcss);
$smarty -> assign("titulo"				,$titulo);
$smarty -> assign("urlimg"				,$urlimg);
$smarty -> assign("url"					,$url);
$smarty -> assign("arrayMesExtenso"		,$arrayMesExtenso);
?>
