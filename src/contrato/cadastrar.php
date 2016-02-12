<?php

require_once "../../php/define.php";
require_once $path . "src/contrato/arrays.php";
require_once $pathvo . "contratoVO.php";

$modulo = 79;
$programa = 7;
$pasta = 'contrato';
$current = 2;
$titulopage = 'Contrato de Estágio';

session_start();
require_once "../autenticacao/validaPermissao.php";

$VO = new contratoVO();
unset($_SESSION['ID_CONTRATO']);

if ($_POST) {

    $VO->configuracao();
    $VO->setCaracteristica('CS_SELECAO,ID_BOLSA_ESTAGIO,ID_ORGAO_GESTOR_ESTAGIO,ID_ORGAO_ESTAGIO,CS_PERIODO,CS_TIPO,ID_PESSOA_ESTAGIARIO,TX_TELEFONE,TX_ENDERECO,DT_INICIO_VIGENCIA,DT_FIM_VIGENCIA,NB_INICIO_HORARIO,NB_FIM_HORARIO,ID_INSTITUICAO_ENSINO,ID_CURSO_ESTAGIO,CS_HORARIO_CURSO,ID_AGENCIA_ESTAGIO,ID_PESSOA_SUPERVISOR,ID_LOTACAO,TX_TCE,TX_PLANO_ATIVIDADE', 'obrigatorios');
    $VO->setCaracteristica('DT_FIM_VIGENCIA,DT_INICIO_VIGENCIA', 'datas');
    $VO->setCaracteristica('NB_INICIO_HORARIO,NB_FIM_HORARIO', 'horas');

    $validar = $VO->preencher($_POST);
    if ($VO->ID_ORGAO_ESTAGIO) {

        $codigo = explode('_', $VO->ID_ORGAO_ESTAGIO);

        $VO->ID_ORGAO_ESTAGIO = $codigo[0];
        $VO->buscarCodSelecao();
        $arrayCodSelecao = $VO->getArray('TX_COD_SELECAO');
        $smarty->assign("arrayCodSelecao", $arrayCodSelecao);

        $VO->NB_COD_UNIDADE = $codigo[1];
        $VO->buscarLotacao();
        $arrayLotacao = $VO->getArray('ORGAO');
        $smarty->assign("arrayLotacao", $arrayLotacao);


        $VO->ID_ORGAO_ESTAGIO = implode('_', $codigo);
    }

    if ($VO->ID_SELECAO_ESTAGIO) {

        $VO->buscarCandidato();
        $arrayPessoaEstagiario = $VO->getArray('TX_NOME');
        $smarty->assign("arrayPessoaEstagiario", $arrayPessoaEstagiario);
    }

    if ($VO->ID_QUADRO_VAGAS_ESTAGIO_2) {
        $VO->ID_QUADRO_VAGAS_ESTAGIO = $VO->ID_QUADRO_VAGAS_ESTAGIO_2;
    }

    if ($VO->CS_SELECAO == 1) {

        $codigo = explode('_', $VO->ID_PESSOA_ESTAGIARIO);
        $VO->CS_TIPO_VAGA_ESTAGIO = $codigo[4];
        $VO->ID_PESSOA_ESTAGIARIO = implode('_', $codigo);
    }
    $id_pk = $VO->inserir();
    if (!$validar) {
    
      
        $_SESSION['ID_CONTRATO'] = $id_pk;

        $_SESSION['CS_SELECAO'] = $VO->CS_SELECAO;
         
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