<?php
require_once $path."php/conexao.php";
class Repositorio {
		 
	var
		$vetor,
		$codErro,
		$msgErro,
		$sqlErro,
		$conexao,
		$vetErro;

	function Repositorio() {
		global $smarty;
	}
	
	function sql($query, $mensagem=""){
		$conexao = new Conexao();	
		$conexao -> executar( $query );		
				
		if ( $conexao -> ocorreuErro() ) {
			return $conexao -> ocorreuErro();
		} 
		else {
			return $mensagem;
		}	
	}	
	
	function sqlVetor($query){
		
		$conexao = new Conexao();
		$conexao -> executar($query);		
		
		if ( $conexao -> ocorreuErro() ) {
			$this -> codErro = 99;	
			$total = 0;
		} 
		else {
			$this -> codErro = 0;
            $this->vetor = $conexao ->getVetor();
			$total = $conexao -> getNumeroLinhas();
                        

		}

		return $total;	
	}
	
	// ---------------------------------------------------------------------
	
	function storedProcedure($Procedure){
    	$this -> sp = $Procedure;    	
   	} 
	
	function addParametro($novoParametro) {   		   		
   		$this->valParametro[":varINPUT".$this->numParametros] = $novoParametro;   		
   		$this->parametros .= ":varINPUT".$this->numParametros.", ";
   		$this->numParametros++;
   	}
	
	function addParametroData($novoParametro) {
   		$this->valParametro[":varINPUT".$this->numParametros] = $novoParametro;
   		$this->parametros .= "TO_DATE(:varINPUT".$this->numParametros.", 'DD/MM/YYYY'), ";

   		$this->numParametros++;
   	}
	
	function addOutParametro($novoOutParametro, $tamanho) {   		
   		$this->valParametro[":varOUTPUT".$this->numParametros] = $novoOutParametro;
   		$this->valOutParametro[$valOutParametro] = null;   		
   		$this->tamParametro[":varOUTPUT".$this->numParametros] = $tamanho;   		
   		$this->parametros .= ":varOUTPUT".$this -> numParametros.", ";
   		$this -> possuiSaida = true;   	         		   		   		   	
   		$this -> numParametros++;	
   	}

	function executarSP(){
		$conexao = new Conexao();
		$conexao -> executarSP($this);	
		if ($conexao->erro){
			return $conexao->CodErro;		
		}
	}
	
	function getSaida($pos) {   		
   		return $this -> valOutParametro[$pos];
   	}
	//----------------------------------------------------------------------	
	
	function executarBlob(){
		$conexao = new Conexao();
		$conexao -> executarBlob($this);	
	}
	
	//----------------------------------------------------------------------	
	
	function functionOracle($nomeFunction){
    	$this -> fc = $nomeFunction;    	
   	}
	
	function addParametroFunction($novoParametro) {   		   		
   		$this->valParametro[":varINPUT".$this->numParametros] = $novoParametro;   		
   		$this->parametros .= ":varINPUT".$this->numParametros.", ";
   		$this->numParametros++;
   	}
	//get saida tera que ser sempre retorno
	function addOutParametroFunction($tamanho) {   		
		$this->tamParametro[":retorno"] = $tamanho;  	
   	}
	
	function executarFC(){
		$conexao = new Conexao();
		$conexao -> executarFC($this);	
	} 
	
	
	
	//----------------------------------------------------------------------
	
	function ocorreuErro() {
		return ( $this -> codErro != 0 ); 
	}

	function getVetor() {										
		return $this -> vetor;		 
	}
	
	function getVetorGrafico() {										
		return $this -> vetor;		 
	}

	function getMensagemErro() {
		return $this -> msgErro;
	}

	function getSqlErro() {
		return $this -> sqlErro;
	}
	
	function getCamposObrigatorios() {
		return $this -> vetErro;
	}
	
	function id($id, $tabela){
            $query = "select max(".$id.")+1 as CODIGO from ".$tabela;
			
            $this->sqlVetor($query);			
            
			$ID = $this->getVetor();
			
			!$ID['CODIGO'][0] ? $ID['CODIGO'][0] = 1 : false;
           
		   	return $ID['CODIGO'][0];
    }

	//-------------------------------------------------------- 
	function pesquisarCampos($tabela){
		$query = "SELECT COLUMN_NAME AS FIELD, 
       				DATA_TYPE AS TYPE, 
       				DATA_LENGTH, 
       				DATA_PRECISION 
  				 FROM ALL_TAB_COLUMNS 
				 WHERE UPPER(TABLE_NAME)='".strtoupper($tabela)."'";
		
		$this->sqlVetor($query);
		return $this->getVetor();

	}	

	//-------------------------------------------------------- 	
	function inserir($VO){
		$campos = $this->pesquisarCampos($VO->tabela);
		
		if ($this->jaExiste($VO)){ 
			$obrigatorio[strtoupper($VO->jaExiste[0])] = "Registro já cadastrado";
			return $obrigatorio;
		}
		else{

			//$VO->trafDataIngles();
			$query = "INSERT INTO ".$VO->tabela." (";
			
			//next($campos['FIELD']);
			while(list($key,$val) = each($campos['FIELD'])){
				$lista .= strtoupper($val).",";
			}
			$query .= substr($lista, 0, -1);
			$query .= ") VALUES (";
			$lista = "";
	
			reset($campos['FIELD']);
			$query .= $VO->autoincremento ?  $VO->autoincremento.", " : $this->id($VO->id, $VO->tabela).", ";
			next($campos['FIELD']);
			while(list($key,$val) = each($campos['FIELD'])){
				$atributo = strtoupper($val);
				$valor = $VO->$atributo;
				
				if ($VO->dt_cadastro == $atributo){
					$lista = substr($lista, 0, -1);
					$lista .= " TO_DATE('".$valor."', 'DD/MM/YYYY hh24:mi:ss'), ";
					continue;
				}
                                
                if ($VO->dt_atualizacao == $atributo){
					$lista = substr($lista, 0, -1);
					$lista .= " TO_DATE('".$valor."', 'DD/MM/YYYY hh24:mi:ss'), ";
					continue;
				}
				
				
				foreach($VO->datas as $data){
					if ($atributo == $data){
						$lista = substr($lista, 0, -1);
						$lista .= " TO_DATE('".$valor."', 'DD/MM/YYYY'), ";
						break;
					}
				}
				
				if ($atributo != $data)
					$lista .= " '".$valor."', ";
			}
			$query .= substr($lista, 0, -2);
			$query .= ")";

			$obrigatorio["mensagem"] = $this->sql($query, "Registro inserido com sucesso!");
			//$VO->trafDataPortugues();
			
			return $obrigatorio;
		}
	}	
	
	
	//-------------------------------------------------------- 
		
	function pesquisar($VO){

		$campos = $this->pesquisarCampos($VO->tabela);	
		
		$query = "SELECT ".strtoupper($campos['FIELD'][0])." AS CODIGO,";
		next($campos['FIELD']);
		while(list($key,$val) = each($campos['FIELD'])){
			
			if ($VO->dt_cadastro == $val){
				$lista .= " TO_CHAR(".strtoupper($val).", 'DD/MM/YYYY hh24:mi:ss') AS ".strtoupper($val).",";
				continue;
			}
                        
            if ($VO->dt_atualizacao == $val){
				$lista .= " TO_CHAR(".strtoupper($val).", 'DD/MM/YYYY hh24:mi:ss') AS ".strtoupper($val).",";
				continue;
			}
			
			foreach($VO->datas as $data){
				if ($val == $data){
					$lista .= " TO_CHAR(".strtoupper($val).", 'DD/MM/YYYY') AS ".strtoupper($val).",";
					break;
				}
			}
			
			if ($val != $data)
				$lista .= strtoupper($val).",";

			
		}
		
		$query .= substr($lista, 0, -1);
		$query .= " FROM ".$VO->tabela;
		$cond = ' WHERE ';
		
		reset($campos['FIELD']);
		next($campos['FIELD']);
		$lista = "";
		
		while(list($key,$val) = each($campos['FIELD'])){
			$atributo = strtoupper($campos['FIELD'][$key]);
			$valor = $VO->$atributo;
			
			if($valor || $valor === 0){
				
				if($campos['TYPE'][$key]=='NUMBER'){
					$lista .= $cond." ".strtoupper($val)." = ".$valor." ";
                    $VO->operadorPesquisar ? $cond = ' '.$VO->operadorPesquisar.' ' : $cond = ' AND ';									
				}
				else if ($campos['TYPE'][$key]=='DATE'){
					$lista .= $cond." ".strtoupper($val)." = TO_DATE('".$valor."', 'DD/MM/YYYY') ";
                    $VO->operadorPesquisar ? $cond = ' '.$VO->operadorPesquisar.' ' : $cond = ' AND ';	
				}
				else{
					$lista .= $cond." ".strtoupper($val)." LIKE '%".$valor."%' ";
					$VO->operadorPesquisar ? $cond = ' '.$VO->operadorPesquisar.' ' : $cond = ' AND ';
				}
			}
		}
		$query .= $lista;
		if($VO->orderBy){
			$query .= " ORDER BY ".$VO->orderBy;
		}

		if ($VO->Reg_quantidade){
			!$VO->Reg_inicio? $VO->Reg_inicio = 0: false;
			$query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (".$query.") PAGING WHERE (ROWNUM <= ".($VO->Reg_quantidade+$VO->Reg_inicio)."))  WHERE (PAGING_RN > ".$VO->Reg_inicio.")";

		}

        return $this->sqlVetor($query);		

	}
	
	//-------------------------------------------------------- 

	function buscar($VO){
	
		$campos = $this->pesquisarCampos($VO->tabela);	

		$query = "SELECT ".strtoupper($campos['FIELD'][0])." AS CODIGO,";
		while(list($key,$val) = each($campos['FIELD'])){
			
			if ($VO->dt_cadastro == $val){
				$lista .= " TO_CHAR(".strtoupper($val).", 'DD/MM/YYYY hh24:mi:ss') AS ".strtoupper($val).",";
				continue;
			}
                        
                        if ($VO->dt_atualizacao == $val){
				$lista .= " TO_CHAR(".strtoupper($val).", 'DD/MM/YYYY hh24:mi:ss') AS ".strtoupper($val).",";
				continue;
			}
			
			foreach($VO->datas as $data){
				if ($val == $data){
					$lista .= " TO_CHAR(".strtoupper($val).", 'DD/MM/YYYY') AS ".strtoupper($val).",";
					break;
				}
			}
			
			if ($val != $data)
			$lista .= strtoupper($val).",";
			
		}
		$query .= substr($lista, 0, -1);

		$atributo = strtoupper($campos['FIELD'][0]);
		$valor = $VO->$atributo;
		
		$query .= " FROM ".$VO->tabela;
		$query .= " WHERE ".strtoupper($campos['FIELD'][0])." = ".$valor;
		
		return $this->sqlVetor($query);
	}
	
	//-------------------------------------------------------- 

	function pesquisarLista($VO){

		$campos = $this->pesquisarCampos($VO->tabela);	
		
		$query = "SELECT ".strtoupper($campos['FIELD'][0])." FROM ".$VO->tabela.
					" WHERE ".strtoupper($campos['FIELD'][0])." in (".$VO->lista.");";

		return $this->sqlVetor($query);
	}	
	
	//-------------------------------------------------------- 
	function jaExiste($VO){
		$campos = $this->pesquisarCampos($VO->tabela);		
		$query = "SELECT ".strtoupper($campos['FIELD'][0])." AS CODIGO";		
		$query .= " FROM ".$VO->tabela;
		$cond = ' WHERE (';		
		
		while(list($key,$val) = each($VO->jaExiste)){
			$val = trim($val);
			$valor = strtoupper($VO->$val);
			if($valor){
				$lista .= $cond." upper(".strtoupper($val).") = '".$valor."' ";
				$cond = ' '.$VO->operador.' ';
			}			
		}
		$query .= $lista.") ";
		
		$valor = "";
		$atributo = strtoupper($campos['FIELD'][0]);
		$valor = $VO->$atributo;

		if($valor){
			$query .= " AND ".$atributo." <> ".$valor;
		}

		return $this->sqlVetor($query);
	
	}	

	//-------------------------------------------------------- 	
	function alterar($VO){
		

		$campos = $this->pesquisarCampos($VO->tabela);

		if ($this->jaExiste($VO)){ 
			$obrigatorio[strtoupper($VO->jaExiste[0])] = "Registro já cadastrado";
			return $obrigatorio;
		}
		else{

			//$VO->trafDataIngles();
			$query = "UPDATE ".$VO->tabela." SET ";
			reset($campos['FIELD']);		
			while(list($key,$val) = each($campos['FIELD'])){
				if(!$vez){
					$atributoPK = strtoupper($val);
					$valorPK = $VO->$atributoPK;
				}
				else{
					$atributo = strtoupper($val);
					$valor = $VO->$atributo;
					
					if ($VO->dt_cadastro == $atributo){
						$lista .= $atributo."=TO_DATE('".$valor."', 'DD/MM/YYYY hh24:mi:ss'),";
						continue;
					}
                                        
                                        if ($VO->dt_atualizacao == $atributo){
						$lista .= $atributo."=TO_DATE('".$valor."', 'DD/MM/YYYY hh24:mi:ss'),";
						continue;
					}
					
					foreach($VO->datas as $data){
						if ($atributo == $data){
							$lista .= $atributo."=TO_DATE('".$valor."', 'DD/MM/YYYY hh24:mi:ss'),";
							break;
						}
					}
				
				if ($atributo != $data)
					$lista .= $atributo."='".$valor."',";	
								
				}
				$vez = 1;
			}
			$query .= substr($lista, 0, -1);
			$query .= " WHERE ".$atributoPK." = ".$VO->$atributoPK;
			//$VO->trafDataPortugues();
		
			$obrigatorio[$atributoPK] = $this->sql($query);
			!$obrigatorio[$atributoPK]? $obrigatorio = "":false;
			
			return $obrigatorio;
		}
	}	



	//-------------------------------------------------------- 	
	function excluir($VO){
		
		$campos = $this->pesquisarCampos($VO->tabela);
		$atributo = strtoupper($campos['FIELD'][0]);
		$valor = $VO->$atributo;

		$query = "DELETE FROM ".$VO->tabela.
					" WHERE ".$campos['FIELD'][0]." = ".$valor;

		return $this->sql($query);
	}
	
	//-------------------------------------------------------- 
	function excluirLista($VO){

		$campos = $this->pesquisarCampos($VO->tabela);

		$query = "DELETE FROM ".$VO->tabela.
					" WHERE ".strtoupper($campos['FIELD'][0])." in ('".$VO->lista."')";
		
		return $this->sql($query);
	}
	

}
?>