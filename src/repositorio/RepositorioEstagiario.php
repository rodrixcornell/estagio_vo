<?php
require_once $path."src/repositorio/Repositorio.php";

class RepositorioEstagiario extends Repositorio{

    function pesquisarLocalidade($VO){
        
        $query="select ID_LOCALIDADE CODIGO, TX_LOCALIDADE ||' - '|| ID_UF TX_LOCALIDADE  
			FROM LOCALIDADE ORDER BY TX_LOCALIDADE";
			
        return $this->sqlVetor($query);	
    }
	
	function pesquisarFuncionario($VO){
        
        $query="select ID_PESSOA_FUNCIONARIO CODIGO, TX_FUNCIONARIO FROM V_FUNCIONARIO ORDER BY TX_FUNCIONARIO";
			
        return $this->sqlVetor($query);	
    }

   function checacpf($VO){
        
        $query="select id_pessoa from pessoa_fisica where replace ( replace(nb_cpf, '.','') ,  '-','') = '".$VO->NB_CPF."'";
			
        return $this->sqlVetor($query);	
    }


	function pesquisar($VO) {
		
        $query = "SELECT V_ESTAGIARIO.TX_NOME, V_ESTAGIARIO.CS_TIPO_PESSOA, V_ESTAGIARIO.CS_SEXO, to_char(V_ESTAGIARIO.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
				   V_ESTAGIARIO.CS_TIPO, V_ESTAGIARIO.NB_RG, V_ESTAGIARIO.TX_ORGAO_EMISSOR, V_ESTAGIARIO.ID_UF_RG, 
				   to_char(V_ESTAGIARIO.DT_EMISSAO, 'dd/mm/yyyy') DT_EMISSAO, 
				   replace ( replace(V_ESTAGIARIO.NB_CPF, '.','') ,  '-','') NB_CPF, 
				   to_char(V_ESTAGIARIO.DT_NASCIMENTO, 'dd/mm/yyyy') DT_NASCIMENTO, 
				   V_ESTAGIARIO.ID_LOCALIDADE_NATAL, 
				   V_ESTAGIARIO.ID_PESSOA_FUNCIONARIO, 
				   V_ESTAGIARIO.NB_FUNCIONARIO, 
				   V_ESTAGIARIO.ID_PESSOA_ESTAGIARIO
			  FROM V_ESTAGIARIO V_ESTAGIARIO ";
			
		$cond = " WHERE ";	
		
		if ($VO->TX_NOME){
			$query .= $cond." upper(V_ESTAGIARIO.TX_NOME) like upper('%".$VO->TX_NOME."%') ";
			$cond = " AND ";
		}

		if ($VO->NB_CPF){
			$query .= $cond." V_ESTAGIARIO.NB_CPF = '".$VO->NB_CPF."' ";
			$cond = " AND ";
		}
		
		if ($VO->ID_PESSOA_ESTAGIARIO){
			$query .= $cond." V_ESTAGIARIO.ID_PESSOA_ESTAGIARIO = '".$VO->ID_PESSOA_ESTAGIARIO."' ";
			$cond = " AND ";
		}
        
        $query .= " ORDER BY V_ESTAGIARIO.TX_NOME";

        if ($VO->Reg_quantidade){
            !$VO->Reg_inicio? $VO->Reg_inicio = 0: false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (".$query.") PAGING WHERE (ROWNUM <= ".($VO->Reg_quantidade+$VO->Reg_inicio)."))  WHERE (PAGING_RN > ".$VO->Reg_inicio.")";
        }

		return $this->sqlVetor($query);
    }
	
	
	function alterar($VO){

        $query = "update V_ESTAGIARIO set
					TX_NOME = '".$VO->TX_NOME."' ,
					CS_TIPO_PESSOA = '0' ,
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
        
        return $this->sql($query);
    }
	
	
	function inserir($VO){
		
        $query = "
            INSERT INTO V_ESTAGIARIO (ID_PESSOA_ESTAGIARIO, TX_NOME, CS_TIPO_PESSOA , CS_SEXO, DT_ATUALIZACAO, NB_RG, TX_ORGAO_EMISSOR, ID_UF_RG, DT_EMISSAO, NB_CPF, DT_NASCIMENTO, ID_LOCALIDADE_NATAL) 
						values
								(SEMAD.F_G_PK_PESSOA(),
								 '".$VO->TX_NOME."',
								 '0',
								 '".$VO->CS_SEXO."', 
								 SYSDATE, 
								 '".$VO->NB_RG."', 
								 '".$VO->TX_ORGAO_EMISSOR."', 
								 '".$VO->ID_UF_RG."',   
								 TO_DATE('".$VO->DT_NASCIMENTO."','DD/MM/YYYY'),  
								 '".$VO->NB_CPF."', 
								 TO_DATE('".$VO->DT_NASCIMENTO."','DD/MM/YYYY'),  
								 '".$VO->ID_LOCALIDADE_NATAL."')  ";

        return $this->sql($query);
    }
	
	function inserirestagiario($VO){
		
        $query = "
            INSERT INTO ESTAGIARIO (ID_PESSOA_ESTAGIARIO ) values (  '".$VO->ID_PESSOA."')";

        return $this->sql($query);
    }
	

   function excluir($VO){

        $query = "delete from V_ESTAGIARIO
                	where ID_PESSOA_ESTAGIARIO = '".$VO->ID_PESSOA_ESTAGIARIO."'";

        return $this->sql($query);
    }
	

}

?>