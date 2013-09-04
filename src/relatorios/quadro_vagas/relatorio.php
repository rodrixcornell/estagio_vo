<?php
require_once "../../../php/define.php";
require_once $pathvo . "quadro_vagasPDF.php";

$modulo = 81;
$programa = 1;
$pasta = 'quadro_vagas';
$current = 4;
require_once "../../autenticacao/validaPermissao.php";

if ($_SESSION['ID_AGENCIA_ESTAGIO']) {
    $pdf = new PDF('L');
    $pdf->titulo = 'QUADRO DE VAGAS';
    $pdf->tamanho = '16';
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Conteudo();
    $pdf->Output();
}else
    header("Location: " . $url . "src/relatorios/" . $pasta . "/index.php");
?>