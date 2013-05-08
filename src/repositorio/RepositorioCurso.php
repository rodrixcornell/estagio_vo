<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioCurso extends Repositorio {

    function pesquisarAreaConhecimento($VO) {

        $query = "select CS_AREA_CONHECIMENTO,
                CS_AREA_CONHECIMENTO CODIGO,
                TX_AREA_CONHECIMENTO
                from area_conhecimento_ge
                order by CS_AREA_CONHECIMENTO ";

        return $this->sqlVetor($query);
    }

    function pesquisar($VO) {

        $query = "select ID_CURSO_ESTAGIO,
                    tx_curso_estagio TX_CURSO_ESTAGIO,
                    TX_AREA_CONHECIMENTO
                    from curso_estagio,area_conhecimento_ge
                    where curso_estagio.CS_AREA_CONHECIMENTO = area_conhecimento_ge.CS_AREA_CONHECIMENTO ";

        ($VO->TX_CURSO_ESTAGIO) ? $query .= " AND upper(TX_CURSO_ESTAGIO) like upper('%" . $VO->TX_CURSO_ESTAGIO . "%') " : false;
        ($VO->CS_AREA_CONHECIMENTO) ? $query .= " AND curso_estagio.CS_AREA_CONHECIMENTO = " . $VO->CS_AREA_CONHECIMENTO . "" : false;

        $query .= " ORDER BY TX_CURSO_ESTAGIO";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

    function inserir($VO) {

        $queryPK = "select SEMAD.F_G_PK_Curso_Estagio() as ID_CURSO_ESTAGIO from DUAL";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "
            INSERT INTO curso_estagio(ID_CURSO_ESTAGIO, TX_CURSO_ESTAGIO, cs_area_conhecimento) 
						values
	   ('" . $CodigoPK['ID_CURSO_ESTAGIO'][0] . "', '" . $VO->TX_CURSO_ESTAGIO . "','" . $VO->CS_AREA_CONHECIMENTO . "')
        ";

        $retorno = $this->sql($query);
        return $retorno ? '' : $CodigoPK['ID_CURSO_ESTAGIO'][0];
    }

    function buscar($VO) {

        $query = "select ID_CURSO_ESTAGIO,
            tx_curso_estagio TX_CURSO_ESTAGIO,
            TX_AREA_CONHECIMENTO,
            curso_estagio.CS_AREA_CONHECIMENTO CS_AREA_CONHECIMENTO
                from curso_estagio,area_conhecimento_ge
                where curso_estagio.CS_AREA_CONHECIMENTO = area_conhecimento_ge.CS_AREA_CONHECIMENTO 
                AND ID_CURSO_ESTAGIO=" . $VO->ID_CURSO_ESTAGIO;


        return $this->sqlVetor($query);
    }

    function alterar($VO) {

        $query = "update curso_estagio
                  set
		      TX_CURSO_ESTAGIO = '" . $VO-> TX_CURSO_ESTAGIO . "' ,
		      CS_AREA_CONHECIMENTO = '" . $VO-> CS_AREA_CONHECIMENTO . "' 
		   where
 			ID_CURSO_ESTAGIO = '" . $VO->ID_CURSO_ESTAGIO . "'";

        return $this->sql($query);
    }

    function excluir($VO) {

        $query = "delete from curso_estagio
                where ID_CURSO_ESTAGIO = " . $VO->ID_CURSO_ESTAGIO ;

        return $this->sql($query);
    }

}

?>