<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioTipo_Pagamento extends Repositorio {

//PESQUISA POR CODIGO E DESCRIÇÃO
    function pesquisarTipo($VO) {
        $query = "SELECT CS_TIPO_PAG_ESTAGIO CODIGO, 
                         TX_TIPO_PAG_ESTAGIO
                    FROM TIPO_PAG_ESTAGIO";

        
        $query .= " ORDER BY CS_TIPO_PAG_ESTAGIO";
        return $this->sqlVetor($query);
    }

//PESQUISAR
    function pesquisar($VO) {
        $query = "SELECT CS_TIPO_PAG_ESTAGIO CODIGO,
                         CS_TIPO_PAG_ESTAGIO, 
                         TX_TIPO_PAG_ESTAGIO
                  FROM TIPO_PAG_ESTAGIO ";
					
		$VO->CS_TIPO_PAG_ESTAGIO ? $query .= " WHERE CS_TIPO_PAG_ESTAGIO = " . $VO->CS_TIPO_PAG_ESTAGIO. " " : false;

        $query .= " ORDER BY CS_TIPO_PAG_ESTAGIO";

        //Carregar
        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }
        return $this->sqlVetor($query);
    }

//CADASTRAR
    function inserir($VO) {
        $query = " INSERT INTO TIPO_PAG_ESTAGIO
                               (CS_TIPO_PAG_ESTAGIO, TX_TIPO_PAG_ESTAGIO) 
	           values
	          (" . $VO->CS_TIPO_PAG_ESTAGIO . ",'" . $VO->TX_TIPO_PAG_ESTAGIO . "')";
        
        return $this->sql($query);
    }

//ALTERAR
    function alterar($VO) {
        $query = "UPDATE TIPO_PAG_ESTAGIO SET
                         TX_TIPO_PAG_ESTAGIO = '" . $VO->TX_TIPO_PAG_ESTAGIO . "'          
	           WHERE CS_TIPO_PAG_ESTAGIO = '" . $VO->CS_TIPO_PAG_ESTAGIO . "'";

        return $this->sql($query);
    }

//EXCLUIR
    function excluir($VO) {
        $query = "DELETE FROM TIPO_PAG_ESTAGIO WHERE CS_TIPO_PAG_ESTAGIO = '" . $VO->CS_TIPO_PAG_ESTAGIO . "'";

        return $this->sql($query);
    }

//BUSCAR    
    function buscar($VO) {
        $query = "SELECT CS_TIPO_PAG_ESTAGIO, TX_TIPO_PAG_ESTAGIO
                      FROM TIPO_PAG_ESTAGIO
                     WHERE (CS_TIPO_PAG_ESTAGIO = " . $VO->CS_TIPO_PAG_ESTAGIO . ") 
                  ORDER BY CS_TIPO_PAG_ESTAGIO";

        return $this->sqlVetor($query);
    }

}

?>