<?php
$titulo = 'Gestão de Estágio Remunerado - Prefeitura de Manaus';
$system = 'estagio';

$dev = array(
	'daraa',
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
    'chappie',
    'smith-inspiron',
    'smith-Inspiron-5547',
    'ludhriq-t4500',
    'OptiPlex-7010',
    'programador',
    'Eduardo-PC'
);

$hom = array('cruxati');

if (in_array(gethostname(), $dev)) {
	$ipBanco = "172.18.1.160:1521/pmmdev";
    $projeto = "/semad/" . $system . "/";
    $urlAmbiente = "http://" . $_SERVER[HTTP_HOST] . "/semad/";
} else {
    if (in_array(gethostname(), $hom)) {
    	$ipBanco = "172.18.1.160:1521/pmmhom";
    	$projeto = "/sistemaspmm/" . $system . "/";
        $urlAmbiente = "http://" . $_SERVER[HTTP_HOST] . "sistemaspmm/";
    } else {
    	$ipBanco = "172.18.0.33:1521/pmm";
    	$projeto = "/" . $system . "/";
        $urlAmbiente = "http://" . $_SERVER[HTTP_HOST];
    }    
}

$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$sid_oracle = "SEMAD";
?>