<?php

require_once "../../php/define.php";
require_once $path . "src/s_ta/arrays.php";
require_once $pathvo . "s_taVO.php";

$modulo = 79;
$programa = 11;
$pasta = 's_ta';
$current = 2;
$titulopage = 'Solicitação de TA';

require_once "../autenticacao/validaPermissao.php";

$VO = new s_taVO();
unset($_SESSION['ID_SOLICITACAO_DESLIG']);

if ($_POST) {

    $VO->configuracao();
    $VO->setCaracteristica('ID_ORGAO_GESTOR_ESTAGIO,ID_ORGAO_ESTAGIO,ID_CONTRATO,ID_SETORIAL_ESTAGIO,DT_SOLICITACAO,DT_DESLIGAMENTO', 'obrigatorios');
    $VO->setCaracteristica('DT_SOLICITACAO,DT_DESLIGAMENTO', 'datas');

    $validar = $VO->preencher($_POST);

    if ($VO->ID_ORGAO_ESTAGIO) {

        $total = $VO->buscarAgenteSetorial();

        if ($total) {
            $dados = $VO->getVetor();
            $arraybuscarAgenteSetorial = $VO->getArray('TX_FUNCIONARIO');
            $smarty->assign("arraybuscarAgenteSetorial", $arraybuscarAgenteSetorial);
        }else{$smarty->assign("arraybuscarAgenteSetorial", $arrayTipotr[''] = 'Nenhum registro encontrado...');}
    }else{$smarty->assign("arraybuscarAgenteSetorial", $arrayTipotr[''] = 'Nenhum registro encontrado...');}

    if (!$validar)
        $id_pk = $VO->inserir();

    if ($id_pk) {
        $_SESSION['ID_SOLICITACAO_DESLIG'] = $id_pk;
        header("Location: ".$url."src/".$pasta."/detail.php");
    }

}


$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("validar", $validar);
$smarty->assign("VO", $VO);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("arquivoCSS", $pasta);
$smarty->assign("arquivoJS", $pasta);
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>