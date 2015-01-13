<?php

require_once "../../php/define.php";
require_once $path . "src/calendario/arrays.php";
require_once $pathvo . "calendarioVO.php";

$modulo = 80;
$programa = 9;
$pasta = 'calendario';
$current = 3;
$titulopage = 'Calendário da Folha de Pagamento de Estágio';

session_start();
require_once "../autenticacao/validaPermissao.php";

unset($_SESSION['ID_ORGAO_GESTOR_ESTAGIO']);

// Iniciando Instância
$VO = new calendarioVO();

if ($_POST) {
    $VO->configuracao();
    $VO->setCaracteristica('ID_ORGAO_GESTOR_ESTAGIO,NB_ANO_REFERENCIA,NB_MES_REFERENCIA', 'obrigatorios');
    $validar = $VO->preencher($_POST);

    if (!$validar) {
        $id_pk = $VO->inserir();

        if ($id_pk) {
            $_SESSION['ID_ORGAO_GESTOR_ESTAGIO'] = $id_pk;

            header("Location: " . $url . "src/" . $pasta . "/detail.php");
        } else {
            $validar['ID_ORGAO_GESTOR_ESTAGIO'] = "Erro de Cadastro!";
        }
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