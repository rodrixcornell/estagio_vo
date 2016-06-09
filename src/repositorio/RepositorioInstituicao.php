<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioInstituicao extends Repositorio {

//--------------------
    function pesquisar($VO) {
        $query = " SELECT ID_INSTITUICAO_ENSINO,
                          TX_INSTITUICAO_ENSINO,
                          TX_SIGLA
                     FROM INSTITUICAO_ENSINO";

        if ($VO->TX_INSTITUICAO_ENSINO != '0') {
            $query .= " where UPPER(INSTITUICAO_ENSINO.TX_INSTITUICAO_ENSINO) LIKE UPPER('%" . $VO->TX_INSTITUICAO_ENSINO . "%') ";
        }

        if ($VO->TX_SIGLA) {
            $query .= " AND UPPER(INSTITUICAO_ENSINO.TX_SIGLA) LIKE UPPER('%" . $VO->TX_SIGLA . "%') ";
        }
        $query .="  order by TX_INSTITUICAO_ENSINO";


        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }
        return $this->sqlVetor($query);
    }


//-------------------
    function inserir($VO) {
        $queryPK = "select SEMAD.F_G_PK_INSTITUICAO_ENSINO() as ID_INSTITUICAO_ENSINO from dual";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "INSERT INTO INSTITUICAO_ENSINO
                            (ID_INSTITUICAO_ENSINO,
                            TX_INSTITUICAO_ENSINO,
                            TX_SIGLA)
			       values('" . $CodigoPK['ID_INSTITUICAO_ENSINO'][0] . "',
                    '" . $VO->TX_INSTITUICAO_ENSINO . "',
                       UPPER('" . $VO->TX_SIGLA . "'))";

        $retorno = $this->sql($query);
        if (!$retorno)
            return $CodigoPK['ID_INSTITUICAO_ENSINO'][0];
    }


//-------------------
    function buscar($VO) {
        $query = "SELECT ID_INSTITUICAO_ENSINO,
                         TX_INSTITUICAO_ENSINO,
                         TX_SIGLA
                   FROM INSTITUICAO_ENSINO
                  WHERE ID_INSTITUICAO_ENSINO = '" . $VO->ID_INSTITUICAO_ENSINO . "'";

        return $this->sqlVetor($query);
    }


//-----------------
    function alterar($VO) {

        $query = "update INSTITUICAO_ENSINO set
					TX_INSTITUICAO_ENSINO = '" . $VO->TX_INSTITUICAO_ENSINO . "' ,
					TX_SIGLA = UPPER('" . $VO->TX_SIGLA . "')
                                   where
 					ID_INSTITUICAO_ENSINO = '" . $VO->ID_INSTITUICAO_ENSINO . "'";

        return $this->sql($query);
    }

//---------------
    function excluir($VO) {
        $query = "delete
                    from INSTITUICAO_ENSINO
                   where (ID_INSTITUICAO_ENSINO = '" . $VO->ID_INSTITUICAO_ENSINO . "')";

        return $this->sql($query);
    }

    function buscarInstituicoes() {
        $query = "SELECT
                    ID_INSTITUICAO_ENSINO CODIGO,
                    TX_INSTITUICAO_ENSINO
                  FROM
                    INSTITUICAO_ENSINO";

        return $this->sqlVetor($query);
    }

}

?>
