<?php
class Conexao {
	
var $recurso,
	$usuario,
	$senha,
	$ipBanco,
	$esquema,
	$possuiTransacao,
	$erro;

	/* ---------------------------------------------------------------------------- */
	function Conexao() {
		global $ipBanco, $usuario, $senha, $esquema;		

		$this -> usuario = $usuario;
		$this -> senha = $senha;
		$this -> ipBanco = $ipBanco;
		$this -> esquema = $esquema;

	}
 
 	/* ---------------------------------------------------------------------------- */
	
	function AbriConexao() {
		set_time_limit(60);
		$this->ora_conecta = @oci_connect($this->usuario, $this->senha, $this->ipBanco, 'AL32UTF8');		
		$stmt = @oci_parse($this->ora_conecta, "ALTER SESSION set NLS_LANGUAGE = 'BRAZILIAN PORTUGUESE'");
		@oci_execute($stmt);
		

		if(!$this->ora_conecta) {
			echo "<p><strong>N&atilde;o foi possivel conectar-se ao servidor Oracle.</strong></p>\n"."<p>Tente novamente mais tarde.</p>\n";
			exit();
		}
		
	}
	
 	/* ---------------------------------------------------------------------------- */
	
	function executar($query){
	
            $this->AbriConexao();
            $this->query = $query;
  	    	$this->rc = @oci_parse($this->ora_conecta, $this->query);
            if(@oci_execute($this->rc)){
					$this->fecharConexao();
					$this -> erro = 0;

            }  else {
				
					$erro = oci_error($this->rc);
                    //echo("<p>Erro Oracle: " . $erro[code] . ' Dados recebidos incorretos. Clique aqui para <a href="javascript:history.go(-1)">Voltar</a></p>');
					$this -> erro = $erro;
                    $this->fecharConexao();
            }

            return $this -> erro;
	}

	function cursor(){
		return $this->rc;
	}

	function ocorreuErro() {
		return ( $this -> erro ); 
	}

	function getNumeroLinhas(){
		return $this -> maxVetor;
	}

	function getVetor(){
		$this -> maxVetor = OCIFetchStatement($this->rc,$results);
		return $results;
	}

	function fecharConexao() {  
		return oci_close($this->ora_conecta);        
	}
	
	/* ---------------------------------------------------------------------------- */
	

	function executarSP($repo){
		$this->AbriConexao();
		$variaveis = $repo->parametros;			
		
		if ( $repo->numParametros > 0 ) {				
			$variaveis = substr($variaveis, 0, strlen($variaveis) - 2); 
		}
		
		$str_procedure = "BEGIN ".
						 	$repo->sp."(".$variaveis.");".
						 "END;";
		set_time_limit(60);
		$this->rc = oci_parse($this->ora_conecta, $str_procedure);
		
		if ( preg_match_all( "/(?:\:varINPUT\d+|\:varOUTPUT\d+|\:varCURSOR)/", $variaveis, $result) ) {	
			oci_bind_by_name($this->rc, ':varINPUT', $repo->valParametro[':varINPUT']);
			
			foreach($result[0] as $campo) {							
				//INPUT																
				if ( preg_match( "/\:varINPUT\d+/", $campo) ) {					
					oci_bind_by_name($this->rc, $campo, $repo->valParametro[$campo]);
				} 
				//OUTPUT
				else if ( preg_match( "/\:varOUTPUT\d+/", $campo) ){
					oci_bind_by_name($this->rc, $campo, $repo->valOutParametro[$repo->valParametro[$campo]], $repo->tamParametro[$campo]);
				}
			}
		}
		
		if(@oci_execute($this->rc)){
			$this->fecharConexao();
			$this->erro = false;
		} else {
			$erra = oci_error($this->rc);
			$this->CodErro = $erra;
			$this->erro = true;
			$this->msgErro = $this->msgErro."Cod Erro: ${erra['code']} ${erra['message']}";
			$this->fecharConexao(); 
		}
					
	}
	
	//-----------------------------------------------------------------------------------
	
	function executarBlob($repo){
		$this->AbriConexao();	
		
		$lob = oci_new_descriptor($this->ora_conecta, OCI_D_LOB);		
		$this->rc = oci_parse($this->ora_conecta, $repo->query);
		
		oci_bind_by_name($this->rc, ':blob', $lob, -1, OCI_B_BLOB);
		
		if(oci_execute($this->rc, OCI_DEFAULT)){
			$lob->savefile($repo->arquivo);
			oci_commit($this->ora_conecta);
			oci_free_descriptor($lob);
			$this->fecharConexao();
			$this->erro = false;
		} else {
			$erra = oci_error($this->rc);
			$this->erro = true;
			$this->msgErro = $this->msgErro."Cod Erro: ${erra['code']} ${erra['message']}";
			$this->fecharConexao(); 
		}	
	}
	
	//-----------------------------------------------------------------------------------
	
	function executarFC($repo){
		$this->AbriConexao();
		$variaveis = $repo->parametros;			
		
		if ( $repo->numParametros > 0 ) {				
			$variaveis = substr($variaveis, 0, strlen($variaveis) - 2); 
		}
		
		$function = "BEGIN :retorno := ".
						 	$repo->fc."(".$variaveis.");".
						 "END;";
		$this->rc = oci_parse($this->ora_conecta, $function);
		
		if ( preg_match_all( "/(?:\:varINPUT\d+|\:varOUTPUT\d+|\:varCURSOR)/", $variaveis, $result) ) {	
			oci_bind_by_name($this->rc, ':varINPUT', $repo->valParametro[':varINPUT']);
			
			foreach($result[0] as $campo) {							
				//INPUT																
				if ( preg_match( "/\:varINPUT\d+/", $campo) ) {					
					oci_bind_by_name($this->rc, $campo, $repo->valParametro[$campo]);
				} 
			}
			oci_bind_by_name($this->rc, ':retorno', $repo->valOutParametro['retorno'], $repo->tamParametro[':retorno']);
		}
		
		if(oci_execute($this->rc)){
			$this->fecharConexao();
			$this->erro = false;
		} else {
			$erra = oci_error($this->rc);
			$this->erro = true;
			$this->msgErro = $this->msgErro."Cod Erro: ${erra['code']} ${erra['message']}";
			$this->fecharConexao(); 
		}
					
	}
	
}
?>
