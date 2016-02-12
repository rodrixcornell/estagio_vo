<?php
require_once $path."src/repositorio/Repositorio.php";

class RepositorioTipo_Estagio extends Repositorio{
	
	function pesquisar($VO) {
		
        $query = "SELECT CS_TIPO_VAGA_ESTAGIO CODIGO, CS_TIPO_VAGA_ESTAGIO, TX_TIPO_VAGA_ESTAGIO FROM TIPO_VAGA_ESTAGIO";
					
		if (($VO->CS_TIPO_VAGA_ESTAGIO) && ($VO->TX_TIPO_VAGA_ESTAGIO)){
		  $query .= " WHERE CS_TIPO_VAGA_ESTAGIO = ".$VO->CS_TIPO_VAGA_ESTAGIO."";
          $query .= " AND TX_TIPO_VAGA_ESTAGIO LIKE '%".$VO->TX_TIPO_VAGA_ESTAGIO."%'";  
        }else{
            ($VO->TX_TIPO_VAGA_ESTAGIO) ? $query .= " WHERE TX_TIPO_VAGA_ESTAGIO LIKE '%".$VO->TX_TIPO_VAGA_ESTAGIO."%'"  : false;
            ($VO->CS_TIPO_VAGA_ESTAGIO) ? $query .= " WHERE CS_TIPO_VAGA_ESTAGIO = ".$VO->CS_TIPO_VAGA_ESTAGIO.""  : false;
        }   
             
        $query .= " ORDER BY TX_TIPO_VAGA_ESTAGIO";

        if ($VO->Reg_quantidade){
            !$VO->Reg_inicio? $VO->Reg_inicio = 0: false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (".$query.") PAGING WHERE (ROWNUM <= ".($VO->Reg_quantidade+$VO->Reg_inicio)."))  WHERE (PAGING_RN > ".$VO->Reg_inicio.")";
        }

        return $this->sqlVetor($query);
    }            
    
    function excluir($VO){

        $query = "DELETE FROM TIPO_VAGA_ESTAGIO
                    WHERE CS_TIPO_VAGA_ESTAGIO = '".$VO->CS_TIPO_VAGA_ESTAGIO."'";
                    
        return $this->sql($query);
    }    
    	
	function inserir($VO){
		
        $query = "
            INSERT INTO TIPO_VAGA_ESTAGIO(CS_TIPO_VAGA_ESTAGIO, TX_TIPO_VAGA_ESTAGIO) 
						values
								('".$VO->CS_TIPO_VAGA_ESTAGIO."' ,'".$VO->TX_TIPO_VAGA_ESTAGIO."')
        ";
     
        return  $this->sql($query);
    }

    function alterar($VO){

        $query = "update TIPO_VAGA_ESTAGIO set
                    TX_TIPO_VAGA_ESTAGIO = '".$VO->TX_TIPO_VAGA_ESTAGIO."'
                  where
                    CS_TIPO_VAGA_ESTAGIO = '".$VO->CS_TIPO_VAGA_ESTAGIO."'";

        return $this->sql($query);
    }
 
}

?>