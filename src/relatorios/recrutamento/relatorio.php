<?php
require_once "../../../php/define.php";

require_once $pathvo."recrutamentoPDF.php";

$modulo = 81;
$programa = 7;
$pasta = 'recrutamento';
$current = 4;

require_once "../../autenticacao/validaPermissao.php";	

if ($_SESSION['ID_RECRUTAMENTO_ESTAGIO']){
    $pdf=new PDF();
    $pdf->titulo = 'Recrutamento de Estágio';
    $pdf->tamanho = '16';
    $pdf->AliasNbPages();
    $pdf->AddPage();
//    $pdf->conteudo();
    $pdf->Output();
    
}else
   header("Location: ".$url."src/relatorios/".$pasta."/index.php");	

?>
