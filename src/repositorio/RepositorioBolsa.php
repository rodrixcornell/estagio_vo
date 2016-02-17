<?php
require_once $path."src/repositorio/Repositorio.php";

class RepositorioBolsa extends Repositorio{


    function pesquisarBolsa($VO){

        $query="SELECT ID_BOLSA_ESTAGIO CODIGO, ID_BOLSA_ESTAGIO, TX_BOLSA_ESTAGIO, NB_VALOR FROM BOLSA_ESTAGIO
        ORDER BY TX_BOLSA_ESTAGIO";

        return $this->sqlVetor($query);
    }

	function pesquisar($VO) {

        $query = "SELECT ID_BOLSA_ESTAGIO CODIGO, ID_BOLSA_ESTAGIO, TX_BOLSA_ESTAGIO, NB_VALOR FROM BOLSA_ESTAGIO";

		($VO->ID_BOLSA_ESTAGIO) ? $query .= " WHERE ID_BOLSA_ESTAGIO = ".$VO->ID_BOLSA_ESTAGIO.""  : false;

        $query .= " ORDER BY TX_BOLSA_ESTAGIO";

        if ($VO->Reg_quantidade){
            !$VO->Reg_inicio? $VO->Reg_inicio = 0: false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (".$query.") PAGING WHERE (ROWNUM <= ".($VO->Reg_quantidade+$VO->Reg_inicio)."))  WHERE (PAGING_RN > ".$VO->Reg_inicio.")";
        }

        return $this->sqlVetor($query);
    }

    function excluir($VO){

        $query = "DELETE FROM BOLSA_ESTAGIO
                    WHERE ID_BOLSA_ESTAGIO = '".$VO->ID_BOLSA_ESTAGIO."'";

        return $this->sql($query);
    }

	function inserir($VO){

		$queryPK = "select SEMAD.F_G_PK_Bolsa_Estagio as ID_BOLSA_ESTAGIO from DUAL";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "
            INSERT INTO BOLSA_ESTAGIO(ID_BOLSA_ESTAGIO, TX_BOLSA_ESTAGIO, NB_VALOR)
						values
								('".$CodigoPK['ID_BOLSA_ESTAGIO'][0]."', '".$VO->TX_BOLSA_ESTAGIO."' ,'".$VO->moeda($VO->NB_VALOR)."')
        ";

        $retorno = $this->sql($query);
        return $retorno ? '' : $CodigoPK['ID_BOLSA_ESTAGIO'][0];
    }

    function alterar($VO){

        $query = "update BOLSA_ESTAGIO set
                    TX_BOLSA_ESTAGIO = '".$VO->TX_BOLSA_ESTAGIO."' ,
                    NB_VALOR = '".$VO->moeda($VO->NB_VALOR)."'
                  where
                    ID_BOLSA_ESTAGIO = '".$VO->ID_BOLSA_ESTAGIO."'";

        return $this->sql($query);
    }

}

?>