<?php

require_once "../../php/define.php";
require_once $path . "src/s_ta/arrays.php";
require_once $pathvo . "s_taVO.php";

$modulo = 79;
$programa = 11;
$pasta = 's_ta';
$current = 2;
$titulopage = 'Solicitação de TA';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new s_taVO();

if ($_SESSION['ID_SOLICITACAO_DESLIG']){

    $VO->ID_SOLICITACAO_DESLIG = $_SESSION['ID_SOLICITACAO_DESLIG'];
    $VO->pesquisar();
    $VO->preencherVOBD($VO->getVetor());

    if($_POST){

        $VO->configuracao();
        $VO->setCaracteristica('ID_CONTRATO,ID_SETORIAL_ESTAGIO,CS_SITUACAO', 'obrigatorios');
        $VO->setCaracteristica('DT_SOLICITACAO,DT_DESLIGAMENTO', 'datas');
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
        }else{$smarty->assign("arraybuscarAgenteSetorial", $arrayTipodesligamento[''] = 'Nenhum regisdesligamentoo encondesligamentoado...');}
    }else{$smarty->assign("arraybuscarAgenteSetorial", $arrayTipodesligamento[''] = 'Nenhum regisdesligamentoo encondesligamentoado...');}

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