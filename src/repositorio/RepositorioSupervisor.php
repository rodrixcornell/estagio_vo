<?php
require_once $path . "src/repositorio/Repositorio.php";

class RepositorioSupervisor extends Repositorio {
 

function pesquisar($VO){

        $query = "
        select A.ID_PESSOA_SUPERVISOR, C.TX_NOME, A.TX_CARGO, A.TX_FORMACAO 
		from SUPERVISOR_ESTAGIO A, PESSOA_FISICA B, PESSOA C
			where A.ID_PESSOA_SUPERVISOR = B.ID_PESSOA
			and B.ID_PESSOA = C.ID_PESSOA
  		";
		
		$VO->TX_CARGO ? $query .= " and UPPER(A.TX_CARGO) like UPPER('%".$VO->TX_CARGO."%')" : false;
		$VO->TX_NOME ? $query .= " and UPPER(C.TX_NOME) like UPPER('%".$VO->TX_NOME."%')" : false;
		$VO->ID_PESSOA_SUPERVISOR ? $query .= " and ID_PESSOA_SUPERVISOR = '".$VO->ID_PESSOA_SUPERVISOR."'" : false; //Utilizado na volta para a tela index.php
      
        $query .= " order by C.TX_NOME";
 
        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }
     
        return $this->sqlVetor($query);    
} 

function pesquisarFuncionario($VO){
	$query ="SELECT A.ID_PESSOA_FUNCIONARIO||'_'||A.NB_FUNCIONARIO CODIGO, B.TX_NOME 
		   FROM FUNCIONARIO_PE A, PESSOA B
		  where a.ID_PESSOA_FUNCIONARIO = B.ID_PESSOA
			ORDER BY B.TX_NOME ";

	return $this->sqlVetor($query);
}
 
    
function pesquisarConselho($VO){
        $query =" SELECT 
                         ID_CONSELHO CODIGO,
                         TX_CONSELHO       
                    FROM CONSELHO_PROFISSIONAL 
          ";
             return $this->sqlVetor($query);
  }
         
function inserir($VO){
       
       $codigo = explode('_', $VO->ID_PESSOA_FUNCIONARIO);
       $VO->ID_PESSOA_FUNCIONARIO = $codigo[0];
       $VO->NB_FUNCIONARIO = $codigo[1];

       $query = "
            INSERT INTO SUPERVISOR_ESTAGIO(ID_PESSOA_SUPERVISOR, ID_PESSOA_FUNCIONARIO, NB_FUNCIONARIO, TX_CURRICULO, TX_FORMACAO, ID_CONSELHO, NB_INSCRICAO_CONSELHO, TX_CARGO, TX_EMAIL, TX_TEMPO_EXPERIENCIA) 
            VALUES
            (".$VO->ID_PESSOA_FUNCIONARIO.",'"
			  .$VO->ID_PESSOA_FUNCIONARIO."','"
			  .$VO->NB_FUNCIONARIO."','"
			  .$VO->TX_CURRICULO."','"
			  .$VO->TX_FORMACAO."','"
			  .$VO->ID_CONSELHO."','"
                          .$VO->NB_INSCRICAO_CONSELHO."','"
                          .$VO->TX_CARGO."','"
                          .$VO->TX_EMAIL."','"
                          .$VO->TX_TEMPO_EXPERIENCIA."') ";
			  
     	$VO->ID_PESSOA_FUNCIONARIO = implode('_', $codigo);
		
        return $this->sql($query); 
   }
   
function buscar($VO) {
	$query ="select ID_PESSOA_SUPERVISOR, ID_PESSOA_FUNCIONARIO||'_'||NB_FUNCIONARIO ID_PESSOA_FUNCIONARIO, 
					TX_CURRICULO, ID_CONSELHO, NB_INSCRICAO_CONSELHO, TX_FORMACAO, TX_CARGO,TX_TEMPO_EXPERIENCIA,TX_EMAIL
				from SUPERVISOR_ESTAGIO
				where ID_PESSOA_SUPERVISOR = '".$VO->ID_PESSOA_SUPERVISOR."'";
       
        return $this->sqlVetor($query);
    }
    
function alterar($VO) {
	
		$codigo = explode('_', $VO->ID_PESSOA_FUNCIONARIO);
      	$VO->ID_PESSOA_FUNCIONARIO = $codigo[0];
       	$VO->NB_FUNCIONARIO = $codigo[1];
            
        $query = "UPDATE SUPERVISOR_ESTAGIO SET 
						   ID_PESSOA_SUPERVISOR = '".$VO->ID_PESSOA_FUNCIONARIO."',
						   ID_PESSOA_FUNCIONARIO = '".$VO->ID_PESSOA_FUNCIONARIO."',
						   NB_FUNCIONARIO = '".$VO->NB_FUNCIONARIO."',
						   TX_CURRICULO = '".$VO->TX_CURRICULO."',
						   TX_FORMACAO = '".$VO->TX_FORMACAO."',
						   ID_CONSELHO = '".$VO->ID_CONSELHO."',
						   NB_INSCRICAO_CONSELHO = '".$VO->NB_INSCRICAO_CONSELHO."',
                                                   TX_TEMPO_EXPERIENCIA = '".$VO->TX_TEMPO_EXPERIENCIA."',
                                                   TX_EMAIL = '".$VO->TX_EMAIL."',    
						   TX_CARGO = '".$VO->TX_CARGO."'
			            WHERE  ID_PESSOA_SUPERVISOR = '".$VO->ID_PESSOA_SUPERVISOR_ANT."'";
		
		$VO->ID_PESSOA_FUNCIONARIO = implode('_', $codigo);
		
        return $this->sql($query);
    }

function excluir($VO){
        $query = "delete from  SUPERVISOR_ESTAGIO where ID_PESSOA_SUPERVISOR = '".$VO->ID_PESSOA_SUPERVISOR."'";

        return $this->sql($query);
    }
 
}
        
?>