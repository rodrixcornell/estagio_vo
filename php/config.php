<?php
$titulo = 'Gestão de Estágio Remunerado - Prefeitura de Manaus';
$system = 'estagio';

$prod = array(
	'apuau',
	'liberdade'
	);

$hom = array('cruxati');

if (in_array(gethostname(), $prod)) {
	error_reporting(0);
	$ipBanco = "172.18.0.33:1521/pmm";
	$txBanco = 'Produção';
	$projeto = "/" . $system . "/";
	$urlAmbiente = "http://" . $_SERVER['HTTP_HOST'];
} else {
	error_reporting(0);
	if (in_array(gethostname(), $hom)) {
		$ipBanco = "172.18.1.160:1521/pmmhom";
		$txBanco = gethostname().' - Homologação';
		$projeto = "/sistemaspmm/" . $system . "/";
		$urlAmbiente = "http://" . $_SERVER['HTTP_HOST'] . "/sistemaspmm/";
	} else {
		(gethostname() == 'daraa') ? error_reporting(0) : FALSE;
		$ipBanco = "172.18.1.160:1521/pmmdev";
		$txBanco = gethostname().' - Desenvolvimento';
		$projeto = "/semad/" . $system . "/";
		$urlAmbiente = "http://" . $_SERVER['HTTP_HOST'] . "/semad/";
	}
}


$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$sid_oracle = "SEMAD";
?>
