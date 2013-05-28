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

unset($_SESSION['ID_PESSOA_ESTAGIARIO']);

// Iniciando Instância
$VO = new estagiarioVO();

if($_POST){
    $VO->configuracao();
    $VO->setCaracteristica('TX_NOME,NB_CPF,NB_RG,TX_ORGAO_EMISSOR,DT_EMISSAO,CS_SEXO','obrigatorios');
  	$VO->setCaracteristica('DT_EMISSAO,DT_NASCIMENTO','datas'); 
	
   
    $validar = $VO->preencher($_POST);

	if (!$validar) {
		
		if ($VO->checacpf())
		{
			 $VO->preencherVOBD($VO->getVetor());
  			 $VO->inserirestagiario(); 
		}
		else
		{
    		$id_pk = $VO->inserir() ;
		}
		}

    if (!$validar) {
        $_SESSION['ID_PESSOA_ESTAGIARIO'] = $id_pk;
		$_SESSION['STATUS'] = '*Registro inserido com sucesso!';
		$_SESSION['PAGE'] = '1';
   	    header("Location: ".$url."src/".$pasta."/index.php");
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