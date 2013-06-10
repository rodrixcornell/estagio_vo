<?php

require_once "../../php/define.php";
require_once $path . "src/contrato/arrays.php";
require_once $pathvo . "contratoVO.php";

$modulo = 79;
$programa = 7;
$pasta = 'contrato';
$current = 2;
$titulopage = 'Contrato de Estágio';

require_once "../autenticacao/validaPermissao.php";

$VO = new contratoVO();
unset($_SESSION['ID_CONTRATO']);

if ($_POST) {

    $VO->configuracao();
    $VO->setCaracteristica('ID_ORGAO_GESTOR_ESTAGIO,ID_ORGAO_ESTAGIO,ID_QUADRO_VAGAS_ESTAGIO,CS_PERIODO,CS_TIPO_VAGA_ESTAGIO,ID_SELECAO_ESTAGIO,CS_TIPO,ID_PESSOA_ESTAGIARIO,TX_CODIGO,TX_TELEFONE,TX_ENDERECO,DT_INICIO_VIGENCIA,DT_FIM_VIGENCIA,NB_INICIO_HORARIO,NB_FIM_HORARIO,ID_INSTITUICAO_ENSINO,ID_CURSO_ESTAGIO,CS_HORARIO_CURSO,ID_AGENCIA_ESTAGIO,ID_PESSOA_SUPERVISOR,ID_LOTACAO,TX_TCE,TX_OBSERVACAO', 'obrigatorios');
    $VO->setCaracteristica('DT_FIM_VIGENCIA,DT_INICIO_VIGENCIA','datas');
    $VO->setCaracteristica('NB_INICIO_HORARIO,NB_FIM_HORARIO', 'horas');
    $validar = $VO->preencher($_POST);
    print_r($_POST);
    if (!$validar)
        $id_pk = $VO->inserir();

    if ($id_pk) {
        $_SESSION['ID_CONTRATO_ESTAGIO'] = $id_pk;
        header("Location: " . $url . "src/" . $pasta . "/index.php");
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