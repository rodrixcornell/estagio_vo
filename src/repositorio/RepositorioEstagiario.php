<?php
require_once $path."src/repositorio/Repositorio.php";

class RepositorioEstagiario extends Repositorio{

    function pesquisarLocalidade($VO){
        
        $query="select ID_LOCALIDADE CODIGO, TX_LOCALIDADE ||' - '|| ID_UF TX_LOCALIDADE  
			FROM LOCALIDADE ORDER BY TX_LOCALIDADE";
			
        return $this->sqlVetor($query);	
    }

   function pesquisarFuncionario($VO){
        
        $query="select ID_PESSOA_FUNCIONARIO CODIGO, TX_FUNCIONARIO
			FROM V_FUNCIONARIO ORDER BY TX_FUNCIONARIO";
			
        return $this->sqlVetor($query);	
    }

   function checacpf($VO){
        
        $query="select id_pessoa from pessoa_fisica where replace ( replace(nb_cpf, '.','') ,  '-','') = '".$VO->NB_CPF."'";
			
        return $this->sqlVetor($query);	
    }


	function pesquisar($VO) {
		
        $query = "SELECT V_ESTAGIARIO.TX_NOME, V_ESTAGIARIO.CS_TIPO_PESSOA, V_ESTAGIARIO.CS_SEXO, V_ESTAGIARIO.DT_ATUALIZACAO,
       V_ESTAGIARIO.CS_TIPO, V_ESTAGIARIO.NB_RG, V_ESTAGIARIO.TX_ORGAO_EMISSOR, V_ESTAGIARIO.ID_UF_RG, V_ESTAGIARIO.DT_EMISSAO,
       V_ESTAGIARIO.NB_CPF, V_ESTAGIARIO.DT_NASCIMENTO, V_ESTAGIARIO.ID_LOCALIDADE_NATAL, 
       V_ESTAGIARIO.ID_PESSOA_FUNCIONARIO, 
       V_ESTAGIARIO.NB_FUNCIONARIO, V_ESTAGIARIO.ID_PESSOA_ESTAGIARIO
  FROM V_ESTAGIARIO V_ESTAGIARIO ";
		
		if ("{$VO->TX_NOME}" || "{$VO->NB_CPF}"){
		   $query .= " WHERE ";	
		 }
		 
		($VO->TX_NOME) ? $query .= " upper(V_ESTAGIARIO.TX_NOME) like upper('%".$VO->TX_NOME."%') "  : false;


         if ("{$VO->TX_NOME}" && "{$VO->NB_CPF}"){

		   $query .= " AND ";	
		 }
		
		($VO->NB_CPF) ? $query  .= " V_ESTAGIARIO.NB_CPF = '".$VO->NB_CPF."' "  : false;
        
        $query .= " ORDER BY V_ESTAGIARIO.TX_NOME";

        if ($VO->Reg_quantidade){
            !$VO->Reg_inicio? $VO->Reg_inicio = 0: false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (".$query.") PAGING WHERE (ROWNUM <= ".($VO->Reg_quantidade+$VO->Reg_inicio)."))  WHERE (PAGING_RN > ".$VO->Reg_inicio.")";
        }
      //   echo $query;
		return $this->sqlVetor($query);
    }
	
	
	function alterar($VO){

        $query = "update V_ESTAGIARIO set
					TX_NOME = '".$VO->TX_NOME."' ,
					CS_TIPO_PESSOA = '".$VO->CS_TIPO_PESSOA."' ,
					CS_SEXO        = '".$VO->CS_SEXO."' ,
					NB_RG          = '".$VO->NB_RG."' ,
					TX_ORGAO_EMISSOR = '".$VO->TX_ORGAO_EMISSOR."' ,
					ID_UF_RG = '".$VO->ID_UF_RG."' ,
					DT_EMISSAO = TO_DATE('".$VO->DT_EMISSAO."','DD/MM/YYYY'),
					NB_CPF = '".$VO->NB_CPF."' ,
					DT_NASCIMENTO = TO_DATE('".$VO->DT_NASCIMENTO."','DD/MM/YYYY'),
					ID_LOCALIDADE_NATAL = '".$VO->ID_LOCALIDADE_NATAL."' ,
					ID_PESSOA_FUNCIONARIO = '".$VO->ID_PESSOA_FUNCIONARIO."' ,
					DT_ATUALIZACAO = SYSDATE
				 where
 					ID_PESSOA_ESTAGIARIO = '".$VO->ID_PESSOA_ESTAGIARIO."'";
        echo $query;
        return $this->sql($query);
    }
	
	
	function inserir($VO){
		
		$queryPK = "select SEMAD.F_G_PK_PESSOA as ID_PESSOA_ESTAGIARIO from DUAL";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "
            INSERT INTO V_ESTAGIARIO (ID_PESSOA_ESTAGIARIO, TX_NOME, CS_TIPO_PESSOA , CS_SEXO, DT_ATUALIZACAO, NB_RG, TX_ORGAO_EMISSOR, ID_UF_RG, DT_EMISSAO, NB_CPF, DT_NASCIMENTO, ID_LOCALIDADE_NATAL) 
						values
								('".$CodigoPK['ID_PESSOA_ESTAGIARIO'][0]."', '".$VO->TX_NOME."','0', 
																	      '".$VO->CS_SEXO."', SYSDATE, '".$VO->NB_RG."', '".$VO->TX_ORGAO_EMISSOR."', '".$VO->ID_UF_RG."',   TO_DATE('".$VO->DT_NASCIMENTO."','DD/MM/YYYY'),  '".$VO->NB_CPF."', 
																		  TO_DATE('".$VO->DT_NASCIMENTO."','DD/MM/YYYY'),  '".$VO->ID_LOCALIDADE_NATAL."')  ";
//   	    echo $query;
        $retorno = $this->sql($query);
        return $retorno ? '' : $CodigoPK['ID_PESSOA_ESTAGIARIO'][0];
    }
	
	function inserirestagiario($VO){
		
        $query = "
            INSERT INTO ESTAGIARIO (ID_PESSOA_ESTAGIARIO ) 
						values
								(  '".$VO->ID_PESSOA."')";
//								echo $query;
        $retorno = $this->sql($query);
    }
	

   function excluir($VO){

        $query = "delete from V_ESTAGIARIO
                	where ID_PESSOA_ESTAGIARIO = '".$VO->ID_PESSOA_ESTAGIARIO."'";
        // echo $query;
        return $this->sql($query);
    }
	
	
/*	function buscar($VO) {
		
        $query = "select id_unidade_irp, TX_UNIDADE_IRP, TO_CHAR(DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO, to_char(DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO, ID_UNIDADE_ORG from unidade_irp where id_unidade_irp = '".$VO->ID_UNIDADE_IRP."'";
       

        return $this->sqlVetor($query);
    }
	
	*/
}

?>