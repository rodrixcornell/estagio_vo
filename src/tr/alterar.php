<?php

require_once "../../php/define.php";
require_once $path . "src/tr/arrays.php";
require_once $pathvo . "trVO.php";

$modulo = 79;
$programa = 8;
$pasta = 'tr';
$current = 2;
$titulopage = 'Solicitação de TR';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new TrVO();

if ($_SESSION['ID_SOLICITACAO_TR']){
    
    $VO->ID_SOLICITACAO_TR = $_SESSION['ID_SOLICITACAO_TR'];
    $VO->pesquisar();
    $VO->preencherVOBD($VO->getVetor());
  
    if($_POST){

        $VO->configuracao();
        $VO->setCaracteristica('ID_ORGAO_GESTOR_ESTAGIO,ID_ORGAO_ESTAGIO,ID_CONTRATO,TX_CARGO_AGENTE,TX_TELEFONE_AGENTE,TX_EMAIL_AGENTE,DT_TERMINO_ESTAGIO,ID_SETORIAL_ESTAGIO,TX_MOTIVO', 'obrigatorios');
        $VO->setCaracteristica('DT_TERMINO_ESTAGIO', 'datas');
        $VO->setCaracteristica('TX_EMAIL', 'emails');
		$validar = $VO->preencher($_POST);

        if (!$validar){
            $VO->alterar();
            header("Location: ".$url."src/".$pasta."/detail.php");
        }               
            
    }
    
    if ($VO->ID_ORGAO_ESTAGIO) {
    
        $total = $VO->buscarAgenteSetorial();

        if ($total) {
            $dados = $VO->getVetor();
            $arraybuscarAgenteSetorial = $VO->getArray('TX_FUNCIONARIO');
            $smarty->assign("arraybuscarAgenteSetorial", $arraybuscarAgenteSetorial);
        }else{$smarty->assign("arraybuscarAgenteSetorial", $arrayTipotr[''] = 'Nenhum registro encontrado...');}
    }else{$smarty->assign("arraybuscarAgenteSetorial", $arrayTipotr[''] = 'Nenhum registro encontrado...');}
        
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