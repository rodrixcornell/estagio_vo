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
unset($_SESSION['ID_SOLICITACAO_TA']);

if ($_POST) {

    $VO->configuracao();
    $VO->setCaracteristica('DT_INICIO_PRORROGACAO,DT_FIM_PRORROGACAO,DT_INICIO_RECESSO,DT_FIM_RECESSO,DT_INICIO_JORNADA,DT_INICIO_PAG_BOLSA,ID_ORGAO_GESTOR_ESTAGIO,ID_ORGAO_ESTAGIO,ID_CONTRATO,ID_SETORIAL_ESTAGIO,TX_INICIO_HORARIO,TX_HORAS_JORNADA,TX_FIM_HORARIO,NB_VALOR_BOLSA,TX_OUTRAS_ALTERACOES', 'obrigatorios');
    $VO->setCaracteristica('DT_INICIO_PRORROGACAO,DT_FIM_PRORROGACAO,DT_INICIO_RECESSO,DT_FIM_RECESSO,DT_INICIO_JORNADA,DT_INICIO_PAG_BOLSA', 'datas');
    
    $validar = $VO->preencher($_POST);
   
    
if ($VO->ID_CONTRATO) {

        $codigo = explode('_', $VO->ID_CONTRATO);
        
        $VO->ID_CONTRATO = $codigo[0];
        $VO->buscarContrato();
        $arrayContrato =$VO->getArray('TX_CODIGO');
        $smarty->assign("arrayContrato", $arrayContrato);
   
        $VO->ID_AGENCIA_ESTAGIO = $codigo[1]; 
        
        
         $VO->ID_CONTRATO = implode('_', $codigo);
        }
   
    $tamanho_just = strlen($_POST['TX_OUTRAS_ALTERACOES']);
    if ($tamanho_just > 255) {
       
  $validar['TX_OUTRAS_ALTERACOES'] = 'Valor máximo de 255 caracteres, atual de: ' . $tamanho_just;
    } else if (!$validar) {
        $id_pk = $VO->inserir();
        if ($id_pk) {
            
          
             
            $_SESSION['ID_SOLICITACAO_TA'] = $id_pk;
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