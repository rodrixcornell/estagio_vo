<?php
header('Content-Type: text/html; charset=utf-8');
set_time_limit(1000);
date_default_timezone_set("America/Manaus");
//error_reporting(0);
session_start();

include dirname( __FILE__ ) . '/config.php';

$urlAmbiente = "http://" . $_SERVER[HTTP_HOST];
$url = 'http://' . $_SERVER[HTTP_HOST] . $projeto;
$path = $_SERVER['DOCUMENT_ROOT'] . $projeto;


$urlcss = $url . 'css/';
$urlimg = $url . 'img/';
$pathvo = $path . 'src/vo/';
$pathimg = $path . 'img/';
$pathArquivo = $path . 'arquivo/';

$GLOBALS["pathimg"] = $pathimg;
$GLOBALS["pathArquivo"] = $pathArquivo;
//$GLOBALS["projeto"] = $projeto; //caminho do projeto depois de document_root

//Configurações Smarty
require_once $path . "php/Smarty/Smarty.class.php";
$smarty = new Smarty;

$smarty->template_dir = $path . 'templates/';
$smarty->compile_dir = $path . 'templates_c/';
$smarty->config_dir = $path . 'configs/';
$smarty->cache_dir = $path . 'cache/';
$smarty->force_compile = 'true';
$smarty->compile_check = 'true';
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
//if (!$_SESSION['usuario'] && $projeto . "src/autenticacao/index.php" != $_SERVER['PHP_SELF'] && strpos($_SERVER['PHP_SELF'], $system) > 0) {
if (!$_SESSION['usuario'] && $projeto . "src/autenticacao/index.php" != $_SERVER['PHP_SELF'] && strpos($path, $system) > 0) {
    header("Location: " . $url . "src/autenticacao/index.php");
}

//Topo Bem vindo usuario

if ($usuario) {
    $smarty->assign("msgAuthLeft", "Bem vindo, " . $_SESSION['NOME']
        . "&nbsp;&nbsp;&nbsp;&nbsp;<a href='" . $url . "src/autenticacao/trocaSenha.php'><img src='" . $urlimg . "topo/senha.png' /></a>"
        . "&nbsp;&nbsp;&nbsp;&nbsp;<a href='" . $url . "src/autenticacao/logout.php'><img src='" . $urlimg . "topo/sair.png' /></a>"
        . "&nbsp;&nbsp;&nbsp;&nbsp;<a href='$urlAmbiente'><img src='" . $urlimg . "topo/home.png' /></a>");
} else {
    $smarty->assign("msgAuthLeft", "<a href='" . $url . "'><img src='" . $urlimg . "topo/entrar.png' /></a>"
        . "&nbsp;&nbsp;&nbsp;&nbsp;<a href='$urlAmbiente'><img src='" . $urlimg . "topo/home.png' /></a>");
}

@$nomeArquivo = array_shift(explode(".", array_pop(explode("/", $_SERVER['SCRIPT_NAME']))));

if(file_exists($path."/log")) {
	$ponteiro = fopen ($path."/log", "r");

	//LÊ O ARQUIVO ATÉ CHEGAR AO FIM
	$log = "";
	while (!feof ($ponteiro)) {
		//LÊ UMA LINHA DO ARQUIVO
		$log .= fgets($ponteiro, 4096)."<br />";
	}//FECHA WHILE

	//FECHA  O PONTEIRO DO ARQUIVO
	fclose ($ponteiro);

	$smarty->assign("log", $log);
}

$smarty->assign("urlcss", $urlcss);
$smarty->assign("titulo", $titulo);
$smarty->assign("urlimg", $urlimg);
$smarty->assign("url", $url);
$smarty->assign("arrayMesExtenso", $arrayMesExtenso);
?>
