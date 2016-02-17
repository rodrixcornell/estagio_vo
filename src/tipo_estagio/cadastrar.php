<?php
require_once "../../php/define.php";
require_once $path."src/tipo_estagio/arrays.php";
require_once $pathvo."tipo_estagioVO.php";

$modulo = 78;
$programa = 4;
$pasta = 'tipo_estagio';
$current = 1;
$titulopage = 'Tipo de Vaga de Estágio';

session_start();
require_once "../autenticacao/validaPermissao.php";

unset($_SESSION['CS_TIPO_VAGA_ESTAGIO']);

// Iniciando Instância
$VO = new tipo_estagioVO();

if($_POST){
    $VO->configuracao();
    $VO->setCaracteristica('CS_TIPO_VAGA_ESTAGIO,TX_TIPO_VAGA_ESTAGIO','obrigatorios');
	$VO->setCaracteristica('CS_TIPO_VAGA_ESTAGIO','numeros');
   
    $validar = $VO->preencher($_POST);

	(!$validar) ? $validar = $VO->inserir() : false;

    if (!$validar) {
        $_SESSION['CS_TIPO_VAGA_ESTAGIO'] = $VO->CS_TIPO_VAGA_ESTAGIO;
        $_SESSION['TX_TIPO_VAGA_ESTAGIO'] = $VO->TX_TIPO_VAGA_ESTAGIO;
		$_SESSION['STATUS'] = '*Registro inserido com sucesso!';
		$_SESSION['PAGE'] = '1';
		header("Location: ".$url."src/".$pasta."/index.php");
    }else{
		$validar['CS_TIPO_VAGA_ESTAGIO'] = 'Registro já existe!';	
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