<?php
require_once "../../php/define.php";
require_once $path."src/estagiario/arrays.php";
require_once $pathvo."estagiarioVO.php";

$modulo = 79;
$programa = 2;
$pasta = 'estagiario';
$current = 2;
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
        $VO->setCaracteristica('TX_NOME,CS_SEXO,NB_CPF,DT_NASCIMENTO,TX_CEP,ID_CURSO_ESTAGIO,CS_TURNO', 'obrigatorios');
    	$VO->setCaracteristica('DT_NASCIMENTO', 'datas');
    	$VO->setCaracteristica('NB_CPF', 'cpfs');

        $validar = $VO->preencher($_POST);
		
		if (!$validar){
            $retorno = $VO->alterar();
			if (!$retorno){
				$_SESSION['NB_CPF'] = $VO->NB_CPF;
				$_SESSION['TX_NOME'] = $VO->TX_NOME;
				$_SESSION['STATUS'] = '*Registro alterado com sucesso!';
				$_SESSION['PAGE'] = '1';
				header("Location: ".$url."src/".$pasta."/index.php");
			}else
				$validar['NB_CPF'] = 'Registro já existe';
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