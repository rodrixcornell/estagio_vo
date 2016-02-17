<?php
require_once "../../php/define.php";
require_once $pathvo . "selecaoPDF.php";

$modulo = 81;
$programa = 1;
$pasta = 'selecao';
$current = 4;
require_once "../autenticacao/validaPermissao.php";

if ($_SESSION['ID_SELECAO_ESTAGIO']) {

    //$pdf = new PDF('L');
    $pdf = new PDF();
    //$pdf->titulo = 'Encaminhamento de Estudantes';
    $pdf->tamanho = '16';
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Conteudo();
    $pdf->SetMargins(10, 30);
    //print_r($pdf);
    $pdf->Output();
}
else
    header("Location: " . $url . "src/" . $pasta . "/detail.php");
?>