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
    'DSIS-4002'
);
$hom = array('daraa');

$titulo = 'Gestão de Estágio Remunerado - Prefeitura de Manaus';
$system = 'estagio';

if (in_array(gethostname(), $dev)) {
    $projeto = "/semad/" . $system . "/";
    $url = 'http://' . $_SERVER[HTTP_HOST] . $projeto;
    $path = $_SERVER['DOCUMENT_ROOT'] . $projeto;
    $urlAmbiente = $url ;
    $ipBanco = "172.18.1.160:1521/pmmdev";
} else {
    if (in_array(gethostname(), $hom)) {
        $projeto = "/" . $system . "/";
        $url = 'http://' . $_SERVER[HTTP_HOST]. $projeto;
        $path = $_SERVER['DOCUMENT_ROOT'] . $projeto;
        $urlAmbiente = "http://daraa.manaus.am.gov.br/";
        $ipBanco = "172.18.1.160:1521/pmmdev";
    } else {
        $projeto = "/" . $system . "/";
        $url = 'http://' . $_SERVER[HTTP_HOST] . $projeto;
        $path = $_SERVER['DOCUMENT_ROOT'] . $projeto;
        $urlAmbiente = "http://sistemaspmm.manaus.am.gov.br/";
        $ipBanco = "172.18.0.33:1521/pmm";
    }
}

$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$sid_oracle = "SEMAD";
?>