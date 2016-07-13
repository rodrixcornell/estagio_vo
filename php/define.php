<?php
header('Content-Type: text/html; charset=utf-8');
set_time_limit(1000);
date_default_timezone_set("America/Manaus");

/**
 * Resolve o problema de sessões do VO. (Precisa incluir a linha abaixo em todos os outros projetos.)
 *
 * __DIR__ 		   = serve de chave para diferenciar um projeto do outro, já que o VO não tem chave de segurança.
 * REMOVE_ADDR 	   = ip da maquina que acessa o projeto
 * HTTP_USER_AGENT = navegador que acessa o projeto
 *
 * Adicionado em 05/05/2016 por Luiz Schmitt <lzschmitt@gmail.com>
 */
 if(!function_exists('getToken')) {
	 function getToken() {
		 return md5(__DIR__ . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
	 }
 }

$token = getToken();
session_name($token);

// inicia a sessão.
session_start();

// coloca o token na sessão.
$_SESSION['token'] = $token;

/**
 * Valida o token da sessão atual. Basta incluir a função em todo inicio de tela
 * para validar a sessão antes de iniciar uma programa ou ação.
 *
 * @param bool - se for true, mata a sessão por completo
 * @param String - se informado, faz o redirencionamento para url informada.
 * @return bool
 *
 * Adicionado em 05/05/2016 por Luiz Schmitt <lzschmitt@gmail.com>
 */
 if(!function_exists('validar_token')) {
	function validar_token($force = false, $url = null) {
		$bool = ($_SESSION['token'] === getToken()) ? true : false;

		if($bool === false) {
			if($force === true) {
				session_destroy();
				($url) ? header("Location: {$url}") : false;
			}
			return false;
		} else {
			return true;
		}
	}
}

/**
 * Forma para visualizar melhor a saida de debug.
 *
 * @param String
 * @param bool
 * @return String
 *
 * Adicionado em 05/05/2016 por Luiz Schmitt <lzschmitt@gmail.com>
 */
if(!function_exists('dd')) {
	function dd($var, $die = false) {
		echo '<pre style="color:red">', var_dump($var) ,'</pre>';

		($die) ? die('Debug VO - parada forçada!') : false;
	}
}
//

// se alguem alterar a sessão indevidamente, finaliza o acesso por segurança!
validar_token(true);

include dirname( __FILE__ ) . '/config.php';

$url = 'http://' . $_SERVER['HTTP_HOST'] . $projeto;
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

// Debug do Smarty
(in_array(gethostname(), $dev) && (gethostname() != 'daraa')) ? $smarty->debugging = 'true' : false;

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
	$topo = "Bem vindo, " . $_SESSION['NOME'] . "&nbsp;&nbsp;-&nbsp;&nbsp;" . $txBanco
		. "&nbsp;&nbsp;&nbsp;&nbsp;<a href='" . $url . "src/autenticacao/trocaSenha.php'><img src='" . $urlimg . "topo/senha.png' /></a>"
		. "&nbsp;&nbsp;&nbsp;&nbsp;<a href='" . $url . "src/autenticacao/logout.php'><img src='" . $urlimg . "topo/sair.png' /></a>";
} else {
	$topo = "<a href='" . $url . "'><img src='" . $urlimg . "topo/entrar.png' /></a>";
}
$smarty->assign("msgAuthLeft", $topo . "&nbsp;&nbsp;&nbsp;&nbsp;<a href='" . $urlAmbiente . "'><img src='" . $urlimg . "topo/home.png'/></a>");


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

	// (in_array(gethostname(), $dev) || in_array(gethostname(), $hom)) ? $smarty->assign("log", $log) : false;
	(!in_array(gethostname(), $prd)) ? $smarty->assign("log", $log) : false;
}

$smarty->assign("urlcss", $urlcss);
$smarty->assign("titulo", $titulo);
$smarty->assign("urlimg", $urlimg);
$smarty->assign("url", $url);
$smarty->assign("arrayMesExtenso", $arrayMesExtenso);

?>