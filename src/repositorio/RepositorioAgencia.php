<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioAgencia extends Repositorio {

    function pesquisar($VO) {

        $query = " 
 SELECT ID_AGENCIA_ESTAGIO,
        TX_AGENCIA_ESTAGIO,
        DT_CADASTRO,
        DT_ATUALIZACAO,
        TX_SIGLA,
        ID_USUARIO_CADASTRO,
        ID_USUARIO_ATUALIZACAO,
        TX_CNPJ
        FROM AGENCIA_ESTAGIO
        ";
        $cond = " where ";
        if ($VO->TX_AGENCIA_ESTAGIO) {
            $query .= $cond ." upper(TX_AGENCIA_ESTAGIO)  like upper('%" .$VO->TX_AGENCIA_ESTAGIO. "%')";
            $cond = " AND ";
        }

        if ($VO->TX_SIGLA) {
            $query .= $cond . " upper(TX_SIGLA)  like upper('%".$VO->TX_SIGLA. "%')";
            $cond = " AND ";
        }

        $query .= " ORDER BY ID_AGENCIA_ESTAGIO";
        //carregar
        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }
        return $this->sqlVetor($query);
    }

//INSERIR CADASTRAR COM ID_USUARIO/PK
   
   function inserir($VO){

        $query = "
            INSERT INTO AGENCIA_ESTAGIO(ID_AGENCIA_ESTAGIO,TX_AGENCIA_ESTAGIO,DT_CADASTRO,DT_ATUALIZACAO,TX_SIGLA,TX_CNPJ,ID_USUARIO_CADASTRO,ID_USUARIO_ATUALIZACAO) 
						values
	(SEMAD.F_G_PK_AGENCIA_ESTAGIO(),'".$VO->TX_AGENCIA_ESTAGIO."',sysdate,sysdate,'".$VO->TX_SIGLA."','".$VO->TX_CNPJ."','".$_SESSION["ID_USUARIO"]."','".$_SESSION["ID_USUARIO"]."') ";

        return $this->sql($query);
      
   }
    
//ALTERAR 
    function alterar($VO) {
        $query = "UPDATE AGENCIA_ESTAGIO SET 
                                           TX_AGENCIA_ESTAGIO = '".$VO->TX_AGENCIA_ESTAGIO."',
                                           TX_SIGLA = '".$VO->TX_SIGLA."',
                                           TX_CNPJ = '".$VO->TX_CNPJ."',
                                           DT_CADASTRO = SYSDATE,
                                           DT_ATUALIZACAO = SYSDATE
			            WHERE  ID_AGENCIA_ESTAGIO = '".$VO->ID_AGENCIA_ESTAGIO."'";
        return $this->sql($query);
    }

    //EXCLUIR 
    function excluir($VO) {
        $query = "delete from  AGENCIA_ESTAGIO where TX_AGENCIA_ESTAGIO = '".$VO->TX_AGENCIA_ESTAGIO."'";

        return $this->sql($query);
    }

//BUSCAR 
    function buscar($VO) {
        $query = " 
 SELECT ID_AGENCIA_ESTAGIO,
        TX_AGENCIA_ESTAGIO,
        DT_CADASTRO,
        DT_ATUALIZACAO,
        TX_SIGLA,
        ID_USUARIO_CADASTRO,
        ID_USUARIO_ATUALIZACAO,
        TX_CNPJ
        FROM AGENCIA_ESTAGIO
        ";
       $VO->TX_AGENCIA_ESTAGIO ? $query .= "where TX_AGENCIA_ESTAGIO = '".$VO->TX_AGENCIA_ESTAGIO."'" : false;
   
        $query .= " ORDER BY TX_AGENCIA_ESTAGIO ";
   
       
        return $this->sqlVetor($query);
    }
}
        
?>