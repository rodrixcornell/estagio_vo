<?php
require_once "../../php/define.php";
require_once $path."src/supervisor/arrays.php";
require_once $pathvo."supervisorVO.php";

$modulo = 78;
$programa = 1;
$pasta = 'supervisor';
$current = 8;
$titulopage = 'Supervisor de Estágio';

session_start();
require_once "../autenticacao/validaPermissao.php";

unset($_SESSION['id_pessoa_supervisor']);

// Iniciando Instância
$VO = new supervisorVO();
  print_r($query);
if($_POST){
    $VO->configuracao();
    $VO->setCaracteristica('NB_FUNCIONARIO,TX_CARGO,TX_FORMACAO,ID_CONSELHO,NB_INSCRICAO_CONSELHO,TX_CURRICULO','obrigatorios');
 
   $validar = $VO->preencher($_POST);
    
    if (!$validar) {
        $VO->inserir();
        $_SESSION['NB_FUNCIONARIO'] = $VO->NB_FUNCIONARIO;
        $_SESSION['TX_CARGO'] = $VO->TX_CARGO;
        $_SESSION['TX_FORMACAO'] = $VO->TX_FORMACAO;
        $_SESSION['ID_CONSELHO'] = $VO->ID_CONSELHO;
        $_SESSION['NB_INSCRICAO_CONSELHO'] = $VO->NB_INSCRICAO_CONSELHO;
        $_SESSION['TX_CURRICULO'] = $VO->TX_CURRICULO;
        $_SESSION['STATUS'] = '*Registro inserido com sucesso!';
        $_SESSION['PAGE'] = '1';
        
     header("Location: ".$url."src/".$pasta."/index.php");
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