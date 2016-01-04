<?php

$dev = array(
    'DSIS-4003',
    'DSIS-4024',
    'DSIS-4023',
    'DSIS-4022',
    'DSIS-4010',
    'DSIS-4025',
    'DSIS-4004',
    'DSIS-4018',
    'DSIS-4001',
    'DSIS-4026',
    'DSIS-4021',
    'DSIS-4019',
    'DSIS-4002',
    'smith-Inspiron-5547',
    'ludhriq-t4500',
    'OptiPlex-7010',
    'programador',
    'Eduardo-PC'
);
$hom = array('daraa');

$titulo = 'Gestão de Estágio Remunerado - Prefeitura de Manaus';
$system = 'estagio';

$ipBanco = "curuduri";

if (in_array(gethostname(), $dev)) {
    $projeto = "/semad/" . $system . "/";
    //$urlAmbiente = $url;
} else {
    if (in_array(gethostname(), $hom)) {
        $urlAmbiente = "http://daraa.manaus.am.gov.br/sistemaspmm/";
    } else {
        $urlAmbiente = "http://sistemaspmm.manaus.am.gov.br/";
        $ipBanco = "pitua";
    }
    $projeto = "/" . $system . "/";
}

$_SESSION['DOMINIO'] = $urlAmbiente;
$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$sid_oracle = "SEMAD";
?>