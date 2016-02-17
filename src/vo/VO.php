<?php
	class VO{

		var
		$datas,
		$numeros,
		$moedas,
		$obrigatorios,
		$jaExiste,
		$emails,
		$cpfs,
		$validar,
		$repositorio,
		$imagens,
		$caminhoImagens, //organize da maior para a menor
		$tamanhoImagens,	//organize da maior para a menor
		$extensoesImagens,
		$arquivos,
		$caminhoArquivos,
		$extensoesArquivos,
		$reg_inicio,
		$reg_quantidade;

	function VO(){
	}

	function configuracao(){
		$this->extensoesImagens = array("jpg","jpeg", "png", "gif", "bmp");
		$this->extensoesArquivos = array("pdf","doc","docx","jpg","jpeg","swf");
		$this->datas = array();
		$this->horas = array();
		$this->anoMes = array();	//Formato 'yyyymm'
		$this->datahora = array();
		$this->numeros = array();
		$this->moedas = array();
		$this->obrigatorios = array();
		$this->obrigatoriosPART = array();
		$this->cpfs = array();
		$this->cnpjs = array();
		$this->imagens = array();
		$this->arquivos = array();
		$this->idade = array();
		$this->feriado = array();
	}

	function setCaracteristica($lista,$caracteristica){
		$this->$caracteristica = explode(',',$lista);
	}

	function preencher($post){

		while(list($key,$val) = each($post)){
				$val = trim($val);
				$this->$key = $val;
		}
		$this->validar();
		return $this->validar;
	}

	function preencherComArquivos($post,$files){

		while(list($key,$val) = each($post)){
				$val = trim($val, 'utf-8');
				$this->$key = $val;
		}

		$this->PreencheVOArquivos($files);
		$this->validar();
		return $this->validar;
	}

	function preencherSession($post){
		while(list($key,$val) = each($post))
				$_SESSION[$key] = $val[0];
	}

	function preencherSemValidar($post){

		while(list($key,$val) = each($post)){
				$val = trim(mb_strtoupper($val, 'utf-8'));
				$this->$key = $val;
		}
	}

	//Telas Pesquisar
	function preencherSessionPesquisar($request){
		global $modulo, $programa;

		while(list($key,$val) = each($request)){
				$_SESSION[$modulo.$programa.'_'.$key] = $val;
		}
	}

	function preencherVOSession($campo){
		global $smarty, $modulo, $programa;

		while(list($key,$val) = each($campo)){
			$str = explode('_', $key, 2);

			if ($str[0] == $modulo.$programa){
				if ($_REQUEST['s'])
					unset($_SESSION[$key]);
				else
					$this->$str[1] = $val;
			}
		}

		$smarty -> assign("s"	,$_REQUEST['s']);
	}

	function preencherVOBD($campo){

		while(list($key,$val) = each($campo)){
				$this->$key = $val[0];
		}
	}



	function PreencheVOArquivos($files){

		while (list($key, $val) = each($files)) {

  			if($val['tmp_name']){

				if($this->$key){ //se tiver valor no campo e tiver tmp_name, apagar o arquivo anterior
					$this->apagarArquivoUnico($key,$this->$key);
				}

				if($this->isImagem($key)){ //verifica se é imagem
					$path = $GLOBALS["pathimg"];
					$caminhos = $this->caminhoImagens;
					$extensoes = $this->extensoesImagens;
				}
				else{
					$path = $GLOBALS["pathArquivo"];
					$caminhos = $this->caminhoArquivos;
					$extensoes = $this->extensoesArquivos;
				}
				$this->$key = $this->uploadArquivo($key, $caminhos, $val['tmp_name'], strtolower($val['name']),$path);
			}
		}
	}


	function uploadArquivo($campo, $caminhos, $sCaminho_tmp, $sCaminho,$path){

		$ultpos = strrpos($sCaminho,'.');
		$nome = substr($sCaminho,0,$ultpos);
		$ext = substr($sCaminho,$ultpos+1);
		$nome = $nome.date("his");
		$nome = md5($nome);
		$nome = $nome.".".$ext;

		if($this->validarExtensao($ext, $campo)){

			while (list($key, $val) = each($caminhos)) {
				!$arquivo? $arquivo = $path.$val.$nome:false;
				!$key? move_uploaded_file($sCaminho_tmp, $path.$val.$nome): copy($arquivo, $path.$val.$nome);
				$this->isImagem($campo)? $this->adequaDimensaoMaxima($path.$val.$nome, $ext, $this->tamanhoImagens[$key]):false;
			}

		}
		return $nome;
	}

	function adequaDimensaoMaxima($imagePath, $extensaoImagem, $tamanhoMaximo)
	{
		$tamMaxLarg = strtok($tamanhoMaximo,',');
		$tamMaxAlt = strtok(',');
		!$tamMaxAlt? $tamMaxAlt = $tamMaxLarg: false;

		if($extensaoImagem == "jpg")
		{
			$imagem_orig = ImageCreateFromJPEG($imagePath);
		}
		elseif($extensaoImagem == "jpeg")
		{
			$imagem_orig = ImageCreateFromJPEG($imagePath);
		}
		else
		{
			$imagem_orig = ImageCreateFromPNG($imagePath);
		}

		$pontoX          =   ImagesX($imagem_orig);
		$pontoY          =   ImagesY($imagem_orig);

		$fator = $pontoX/$tamMaxLarg;

		if (ceil($pontoY/$fator)>$tamMaxAlt){
			$fator = $pontoY/$tamMaxAlt;
		}

		if($fator < 1){
			$fator = 1;
		}

		$largura = ceil($pontoX/$fator);
		$altura = ceil($pontoY/$fator);

		$imagem_fin    =   ImageCreateTrueColor($largura, $altura);
		ImageCopyResampled($imagem_fin, $imagem_orig, 0, 0, 0, 0, $largura+1, $altura+1, $pontoX, $pontoY);

		if($extensaoImagem == "jpg")
		{
			ImageJPEG($imagem_fin, $imagePath);
		}
		elseif($extensaoImagem == "jpeg")
		{
			ImageJPEG($imagem_fin, $imagePath);
		}
		else
		{
			ImagePNG($imagem_fin, $imagePath);
		}

		ImageDestroy($imagem_orig);
		ImageDestroy($imagem_fin);
	}


	function apagarArquivoUnico($key, $arquivo){

		$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
		if($this->isImagem($key)){ //verifica se é imagem
			$path = $GLOBALS["pathimg"];
			$caminhos = $this->caminhoImagens;
			while (list($keyCam, $valCam) = each($caminhos)) {
				@unlink($DOCUMENT_ROOT.'/'.$GLOBALS["projeto"].'img/'.$valCam.$arquivo);
			}
		}
		elseif($this->isArquivo($key)){ //verifica se é Arquivo
			$path = $GLOBALS["pathArquivo"];
			$caminhos = $this->caminhoArquivos;
			while (list($keyCam, $valCam) = each($caminhos)) {
				@unlink($DOCUMENT_ROOT.'/'.$GLOBALS["projeto"].'arquivo/'.$valCam.$arquivo);
			}
		}
	}


	function validarExtensao($ext, $campo){
		$this->isImagem($campo)? $extensoes = $this->extensoesImagens : $extensoes = $this->extensoesArquivos;
		return in_array($ext, $extensoes);
	}

	function verificarExtensoes(){
		$campos = $this->imagens;
		$obrigatorio = '';

		while (list($key, $val) = each($campos)) {
			$ext=strtok($this->$val,".");
			$ext=strtok(".");
			if($this->$val){
				!$this->validarExtensao($ext, $val)? $this->validar[$val] = 'Formato inválido, somente JPEG, JPG ou PNG.': false;
			}
		}
		return $obrigatorio;
	}

	function isImagem($campo){
		return in_array($campo,$this->imagens);
	}

	function isArquivo($campo){
		return in_array($campo,$this->arquivos);
	}

	function montaLista($listaMarcados){
		foreach($listaMarcados as $marcado){
			$lista .= $marcado."','";
		}
		$lista = substr($lista, 0, -3);
		return  $lista;
	}

	//Obrigatorio
	function verificarObrigatorio($campo){
		!$campo? $aux = 'Obrigatório': false;
		return $aux;
	}

	function validarObrigatorios(){
		while(list($key,$val) = each($this->obrigatorios)){
			$aux = $this->verificarObrigatorio($this->$val);
			$aux? $this->validar[$val] = $aux:false;
		}
	}

	//Data
	function verificarData($data){

		(!@checkdate( substr($data,3,2),substr($data,0,2),substr($data,6,4)) && $data)? $aux = 'Data Inválida': false;
		return $aux;
	}

	function validarDatas(){
		reset($this->datas);
		while(list($key,$val) = each($this->datas)){
			$aux = $this->verificarData($this->$val);
			$aux? $this->validar[$val] = $aux:false;
		}
	}

	function dataIngles($data){
		if($data){
			return substr($data,6,4).'/'.substr($data,3,2).'/'.substr($data,0,2);
		}
	}

	function trafDataIngles(){
		reset($this->datas);
		while(list($key,$val) = each($this->datas)){
			$this->$val = $this->dataIngles($this->$val);
		}
	}

	function dataPortugues($data){
		if($data){
			return substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4);
		}
	}

	function trafDataPortugues(){
		reset($this->datas);
		while(list($key,$val) = each($this->datas)){
			$this->$val = $this->dataPortugues($this->$val);
		}
	}

	//Hora
	function verificarHora($valor){
		list($hora, $minuto) = explode(':', $valor);
                if ($hora != '' && $minuto != '' && is_numeric($hora) && is_numeric($minuto)){
                    ($hora > -1 && $hora < 24 && $minuto > -1 && $minuto < 60) ? false : $aux = 'Hora Inválida';
                }else $aux = 'Hora Inválida';
		return $aux;
	}

	function validarHoras(){
		reset($this->horas);
		while(list($key,$val) = each($this->horas)){
			$aux = $this->verificarHora($this->$val);
			$aux? $this->validar[$val] = $aux:false;
		}
	}

	//Data e Hora
	function validarDataHora(){
		reset($this->datahora);
			while(list($key,$val) = each($this->datahora)){

				if ($this->$val){
					$data = explode(" ",$this->$val);

					if ($this->verificarData($data[0]) || $this->verificarHora($data[1]))
						$this->validar[$val] = "Data ou Hora Inválida";
				}
			}

		return $aux;
	}


	//Ano e Mes
	function validarAnoMes(){
		reset($this->anoMes);
			while(list($key,$val) = each($this->anoMes)){

				if ($this->$val){
					if (strlen($this->$val) == 6){

					$ano = substr($this->$val, 0, 4);
					$mes = substr($this->$val, 4, 2);

					if ((date('Y')-10 > $ano || date('Y')+10 < $ano) || ($mes < 1 || $mes > 12)){
						return $this->validar[$val] = "Ano ou Mês Inválido";
					}
					}else
						return $this->validar[$val] = "Ano ou Mês Inválido";
				}
			}


	}


	//Números
	function verificarNumero($num){
		!is_numeric($num) && $num? $aux = 'Número Inválido': false;
		return $aux;
	}

	function validarNumeros(){
		reset($this->numeros);
		while(list($key,$val) = each($this->numeros)){
			$aux = $this->verificarNumero($this->$val);
			$aux? $this->validar[$val] = $aux:false;
		}
	}

	function verificarMoeda($numero){
		if($numero){
			$numero = preg_replace('[. ,]', ' ', $numero);
			$posSep = strpos(strrev($numero),' ');
			$inteiro = $numero;

			if($posSep && $posSep<3){
				$inteiro = substr($numero,0,strlen($numero)-$posSep-1);
				$centavo = substr($numero,-$posSep);
			}

			if(isset($centavo) && strlen($centavo)!=2){
				$erro = true;
			}

			if(strpos($inteiro, ' ')===0){
				$erro = true;
			}
			elseif(strpos($inteiro, ' ')){
				$num = explode(' ',$inteiro);
				while (list($key, $val) = each($num)) {
					if(!strlen($val) || strlen($val)>3){
						$erro = true;
						break;
					}
				}
			}

			$numero = str_replace(' ','',$inteiro).'.'.$centavo;
			$validou = is_numeric($numero)&&!$erro;

			if(!$validou){
				return 'Valor Invalido';
			}
		}
	}

	function validarMoedas(){
		while(list($key,$val) = each($this->moedas)){
			$aux = $this->verificarMoeda($this->$val);
			$aux? $this->validar[$val] = $aux:false;
		}
	}

	function mostrarMoedaArray($num){
		while (list($key, $val) = each($num)) {
			if($val>0){
				$numero = explode('.',$val);
				$numero[1] = str_pad($numero[1], 2, "0", STR_PAD_RIGHT);
				$numero[1] = substr($numero[1],0,2);
				$num[$key] = $numero[0].','.$numero[1];
			}
			else{
				$num[$key] = '';
			}
		}
		return $num;
	}

	function mostrarMoeda($num){
		if($num>=0){
			$numero = explode('.',$num);
			$numero[1] = str_pad($numero[1], 2, "0", STR_PAD_RIGHT);
			$numero[1] = substr($numero[1],0,2);
			$num = $numero[0].','.$numero[1];
			return $num;
		}
		else{
			return "";
		}
	}


	//Emails
	function verificarEmail($valor){
		$valor && @!ereg("^([0-9,a-z,A-Z]+)([.,_]([0-9,a-z,A-Z]+))*[@]([0-9,a-z,A-Z]+)([.,_,-]([0-9,a-z,A-Z]+))*[.]([0-9,a-z,A-Z]){2}([0-9,a-z,A-Z])?$", $valor)?$aux = 'Email Inválido':false;

		return $aux;
	}

	function validarEmails(){
		if (is_array($this->emails)){
			while(list($key,$val) = each($this->emails)){
				$aux = $this->verificarEmail($this->$val);
				$aux? $this->validar[$val] = $aux:false;
			}
		}
	}

	function verificarCpf($cpf) {
		// verifica se e numerico
		if(!is_numeric($cpf)) {
			return 'CPF Inválido';
		}
		// verifica se esta usando a repeticao de um numero
		if( ($cpf == '11111111111') || ($cpf == '22222222222') || ($cpf == '33333333333') || ($cpf == '44444444444') || ($cpf == '55555555555') || ($cpf == '66666666666') || ($cpf == '77777777777') || ($cpf == '88888888888') || ($cpf == '99999999999') || ($cpf == '00000000000') ) {
			return 'CPF Inválido';
		}
		//PEGA O DIGITO VERIFIACADOR
		$dv_informado = substr($cpf, 9,2);
		for($i=0; $i<=8; $i++) {
			$digito[$i] = substr($cpf, $i,1);
		}
		//CALCULA O VALOR DO 10º DIGITO DE VERIFICAÇÂO
		$posicao = 10;
		$soma = 0;
		for($i=0; $i<=8; $i++) {
			$soma = $soma + $digito[$i] * $posicao;
			$posicao = $posicao - 1;
		}
		$digito[9] = $soma % 11;
		if($digito[9] < 2) {
			$digito[9] = 0;
		} else {
			$digito[9] = 11 - $digito[9];
		}
		//CALCULA O VALOR DO 11º DIGITO DE VERIFICAÇÃO
		$posicao = 11;
		$soma = 0;
		for ($i=0; $i<=9; $i++) {
			$soma = $soma + $digito[$i] * $posicao;
			$posicao = $posicao - 1;
		}
		$digito[10] = $soma % 11;
		if ($digito[10] < 2) {
			$digito[10] = 0;
		}
		else {
			$digito[10] = 11 - $digito[10];
		}
		//VERIFICA SE O DV CALCULADO É IGUAL AO INFORMADO
		$dv = $digito[9] * 10 + $digito[10];
		if ($dv != $dv_informado) {
			return 'CPF Inválido';
		}
			return '';
	} // function valida_cpf($cpf)

	function validarCpfs(){
		while(list($key,$val) = each($this->cpfs)){
			$this->$val?$aux = $this->verificarCpf($this->$val):false;
			$aux? $this->validar[$val] = $aux:false;
		}
	}

	function validar(){
		!$this->validar? $this->validarObrigatorios():false;
		!$this->validar? $this->validarDatas():false;
		!$this->validar? $this->validarHoras():false;
		!$this->validar? $this->validarAnoMes():false;
		!$this->validar? $this->validarDataHora():false;
		!$this->validar? $this->validarNumeros():false;
		!$this->validar? $this->validarMoedas():false;
		!$this->validar? $this->validarEmails():false;
		!$this->validar? $this->validarCpfs():false;
        !$this->validar? $this->validarCnpjs():false;
		!$this->validar? $this->verificarExtensoes():false;
	}

	function getArray($Nomecampo){
		$campo = $this->getVetor();

		$arraySetor[""] = 'Escolha...';
		if  (is_array($campo)){
			while(list($key,$val) = each($campo[$Nomecampo])){
					$arraySetor[$campo['CODIGO'][$key]] = $val;
			}
		}
			return $arraySetor;


	}

	function getVetor(){
		return $this->repositorio->getVetor();
	}

	function inserir(){
		return $this->repositorio->inserir($this);
	}

	function pesquisar(){
		return $this->repositorio->pesquisar($this);
	}

	function buscar(){
		return $this->repositorio->buscar($this);
	}

	function pesquisarLista(){
		return $this->repositorio->pesquisarLista($this);
	}

	function alterar(){
		return $this->repositorio->alterar($this);
	}

	function excluir(){
		//$this->apagarArquivo();
		return $this->repositorio->excluir($this);
	}

	function jaExiste(){
		return $this->repositorio->jaExiste($this);
	}

	function excluirLista($lista){
		$this->lista = $lista;
		//$this->apagarListaArquivo();
		return $this->repositorio->excluirLista($this);
	}

	function calculaIdade($nasc){
		$hoje = explode("-",date("d-m-Y"));
		$niver = explode("/",$nasc);
		$idade = $hoje[2] - $niver[2];

		if ($hoje[1] < $niver[1])
			$idade--;
		elseif ($hoje[1] == $niver[1] && $hoje[0] < $niver[0])
			$idade--;

		return $idade;
	}

	function formataTimeStamp($valor) {
		$array = explode(" ",$valor);
		$array = explode("-",$array[0]);
		$data = $array[2].'/'.$array[1].'/'.$array[0];
		return $data;
	}

	//Formata moeda para o oracle
	function moeda($get_valor) {
		$source = array('.', ',');
		$replace = array('', '.');
		$valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
		return $valor; //retorna o valor formatado para gravar no banco
	}

	function extenso($valor = 0, $maiusculas = false) {

		$singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
		$plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões", "quatrilhões");

		$c = array("", "cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
		$d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa");
		$d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezesete", "dezoito", "dezenove");
		$u = array("", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove");

		$z = 0;
		$rt = "";

		$valor = number_format($valor, 2, ".", ".");
		$inteiro = explode(".", $valor);
		for($i=0;$i<count($inteiro);$i++)
			for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
				$inteiro[$i] = "0".$inteiro[$i];

		$fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
		for ($i=0;$i<count($inteiro);$i++) {
			$valor = $inteiro[$i];
			$rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
			$rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
			$ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

			$r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd && $ru) ? " e " : "").$ru;
			$t = count($inteiro)-1-$i;
			$r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
			if ($valor == "000")$z++; elseif ($z > 0) $z--;
			if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t];
			if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
		}

		if(!$maiusculas){
			return($rt ? $rt : "zero");
		} else {
			if ($rt) $rt=ereg_replace(" E "," e ",ucwords($rt));
			return (($rt) ? ($rt) : "Zero");
		}
}
//CNPJ
	function verificarCnpj($cnpj)
 	{
		 $cnpj = preg_replace( "@[./-]@", "", $cnpj );
		 if( strlen( $cnpj ) <> 14 or !is_numeric( $cnpj ) ){
			 return 'CNPJ Inválido';
		 }
		 $k = 6;
		 $soma1 = "";
		 $soma2 = "";
		 for( $i = 0; $i < 13; $i++ ){
			 $k = $k == 1 ? 9 : $k;
			 $soma2 += ( $cnpj[$i] * $k );
			 $k--;
			 if($i < 12){
				 if($k == 1){
					 $k = 9;
					 $soma1 += ( $cnpj[$i] * $k );
					 $k = 1;
				 }else{
					 $soma1 += ( $cnpj[$i] * $k );
				 }
			}
		 }

		 $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
		 $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

		if ($cnpj[12] == $digito1 and $cnpj[13] == $digito2) {
			return '';
		}
			return 'CNPJ Inválido';
 }

	function validarCnpjs(){
		while(list($key,$val) = each($this->cnpjs)){
			$this->$val?$aux = $this->verificarCnpj($this->$val):false;
			$aux? $this->validar[$val] = $aux:false;
		}
	}

	function erroOracle($arrayErro){
		switch ($arrayErro['code']){
			case 1 : $erro = 'Registro já Existe!'; break;
			default : $erro = 'Erro: '.$arrayErro['message']; break;
		}

		return $erro;

	}

}
?>