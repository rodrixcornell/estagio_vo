<?php
require_once $path."src/repositorio/Repositorio.php";

class RepositorioGrupo_pagamento extends Repositorio{


    function pesquisarGrupo_pagamento($VO){

        $query="SELECT ID_GRUPO_PAGAMENTO CODIGO,
                       TX_GRUPO_PAGAMENTO
                  FROM GRUPO_PAGAMENTO
              ";
          $query .= " ORDER BY ID_GRUPO_PAGAMENTO";

        return $this->sqlVetor($query);
    }

    function pesquisar($VO) {

        $query = "SELECT ID_GRUPO_PAGAMENTO,
                         TX_GRUPO_PAGAMENTO
                  FROM  GRUPO_PAGAMENTO";

	$VO->ID_GRUPO_PAGAMENTO ? $query .= " WHERE (ID_GRUPO_PAGAMENTO = " . $VO->ID_GRUPO_PAGAMENTO. ") " : false;

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
    $query = "
            INSERT INTO GRUPO_PAGAMENTO(ID_GRUPO_PAGAMENTO,TX_GRUPO_PAGAMENTO)
						values
	         ('".$VO->ID_GRUPO_PAGAMENTO."','".$VO->TX_GRUPO_PAGAMENTO."') ";

        return $this->sql($query);

    }

    function alterar($VO){

   $query = "UPDATE GRUPO_PAGAMENTO SET
                         TX_GRUPO_PAGAMENTO = '" . $VO->TX_GRUPO_PAGAMENTO . "'
	           WHERE ID_GRUPO_PAGAMENTO = '" . $VO->ID_GRUPO_PAGAMENTO . "'
                  ";

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