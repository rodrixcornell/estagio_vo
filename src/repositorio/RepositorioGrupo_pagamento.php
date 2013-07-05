<?php
require_once $path."src/repositorio/Repositorio.php";

class RepositorioGrupo_pagamento extends Repositorio{


    function pesquisargrupo_pagamento($VO){
        
        $query="SELECT ID_GRUPO_PAGAMENTO CODIGO,
                       TX_GRUPO_PAGAMENTO
                  FROM GRUPO_PAGAMENTO
              ORDER BY TX_GRUPO_PAGAMENTO";
			
        return $this->sqlVetor($query);	
    }
	
	function pesquisar($VO) {
		
        $query = "SELECT ID_GRUPO_PAGAMENTO CODIGO,
                        TX_GRUPO_PAGAMENTO
                  FROM  GRUPO_PAGAMENTO";
					
		($VO->ID_GRUPO_PAGAMENTO) ? $query .= " WHERE ID_GRUPO_PAGAMENTO = ".$VO->ID_GRUPO_PAGAMENTO.""  : false;
        
        $query .= " ORDER BY ID_GRUPO_PAGAMENTO";

        if ($VO->Reg_quantidade){
            !$VO->Reg_inicio? $VO->Reg_inicio = 0: false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (".$query.") PAGING WHERE (ROWNUM <= ".($VO->Reg_quantidade+$VO->Reg_inicio)."))  WHERE (PAGING_RN > ".$VO->Reg_inicio.")";
        }

        return $this->sqlVetor($query);
    }            
    
    function excluir($VO){

        $query = "DELETE FROM GRUPO_PAGAMENTO
                    WHERE ID_GRUPO_PAGAMENTO = '".$VO->ID_GRUPO_PAGAMENTO."'";
                    
        return $this->sql($query);
    }    
    	
	function inserir($VO){
     $queryPK = "select SEMAD.F_G_PK_GRUPO_PAGAMENTO as ID_GRUPO_PAGAMENTO from DUAL";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "
            INSERT INTO BOLSA_ESTAGIO(ID_GRUPO_PAGAMENTO, TX_GRUPO_PAGAMENTO) 
						values
	('".$CodigoPK['ID_GRUPO_PAGAMENTO'][0]."', '".$VO->TX_GRUPO_PAGAMENTO."')
        ";

        $retorno = $this->sql($query);
        return $retorno ? '' : $CodigoPK['ID_GRUPO_PAGAMENTO'][0];
    }

    function alterar($VO){

$query = "update GRUPO_PAGAMENTO set
                                 TX_GRUPO_PAGAMENTO = '".$VO->TX_GRUPO_PAGAMENTO."'                 
                               where
                                 ID_GRUPO_PAGAMENTO = '".$VO->ID_GRUPO_PAGAMENTO."'";

        return $this->sql($query);
    }
    function buscar($VO) {
	$query ="SELECT ID_GRUPO_PAGAMENTO CODIGO,
                        TX_GRUPO_PAGAMENTO
                  FROM  GRUPO_PAGAMENTO
	          where ID_GRUPO_PAGAMENTO = '".$VO->ID_GRUPO_PAGAMENTO."'";
       
        return $this->sqlVetor($query);
    }
 
}

?>