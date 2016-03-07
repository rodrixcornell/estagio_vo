<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioInstituicao_estagio extends Repositorio {

    function pesquisar($VO) {

        $query = "

		SELECT ID_AGENCIA_ESTAGIO,
        TX_AGENCIA_ESTAGIO,
        to_char(DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,
        to_char(DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
        TX_SIGLA,
        ID_USUARIO_CADASTRO,
        ID_USUARIO_ATUALIZACAO,
        TX_CNPJ,
        AGENCIA_ESTAGIO.TX_EMAIL,
		USU_CAD.TX_LOGIN USUARIO_CADASTRO,
		USU_ATU.TX_LOGIN USUARIO_ATUALIZACAO
        FROM AGENCIA_ESTAGIO, USUARIO USU_CAD, USUARIO USU_ATU
		WHERE AGENCIA_ESTAGIO.ID_Usuario_Cadastro = USU_CAD.ID_USUARIO
		AND AGENCIA_ESTAGIO.ID_Usuario_Atualizacao = USU_ATU.ID_USUARIO
        ";

        $VO->TX_AGENCIA_ESTAGIO ? $query .= " and upper(TX_AGENCIA_ESTAGIO)  like upper('%" .$VO->TX_AGENCIA_ESTAGIO. "%')" : false;

        $VO->TX_SIGLA ? $query .= "and upper(TX_SIGLA)  like upper('%".$VO->TX_SIGLA. "%')" : false;

		$VO->ID_AGENCIA_ESTAGIO ? $query .= "and ID_AGENCIA_ESTAGIO  = '".$VO->ID_AGENCIA_ESTAGIO. "'" : false;

        $query .= " ORDER BY TX_AGENCIA_ESTAGIO";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }
        return $this->sqlVetor($query);
    }



   function inserir($VO){

        $query = "
            INSERT INTO AGENCIA_ESTAGIO(ID_AGENCIA_ESTAGIO,TX_AGENCIA_ESTAGIO,DT_CADASTRO,DT_ATUALIZACAO,TX_SIGLA,TX_CNPJ,ID_USUARIO_CADASTRO,ID_USUARIO_ATUALIZACAO,TX_EMAIL)
						values
	(SEMAD.F_G_PK_AGENCIA_ESTAGIO(),'".$VO->TX_AGENCIA_ESTAGIO."',sysdate,sysdate,'".$VO->TX_SIGLA."','".$VO->TX_CNPJ."','".$_SESSION["ID_USUARIO"]."','".$_SESSION["ID_USUARIO"]."','".mb_strtolower($VO->TX_EMAIL)."') ";

        return $this->sql($query);

   }

//ALTERAR
    function alterar($VO) {
        $query = "UPDATE AGENCIA_ESTAGIO SET
                                           TX_AGENCIA_ESTAGIO = '".$VO->TX_AGENCIA_ESTAGIO."',
                                           TX_SIGLA = '".$VO->TX_SIGLA."',
                                           TX_CNPJ = '".$VO->TX_CNPJ."',
                                           DT_ATUALIZACAO = SYSDATE,
					ID_Usuario_Atualizacao = '".$_SESSION["ID_USUARIO"]."',
                                            TX_EMAIL= '".mb_strtolower($VO->TX_EMAIL)."'
			            WHERE  ID_AGENCIA_ESTAGIO = " . $VO->ID_AGENCIA_ESTAGIO;
        return $this->sql($query);
    }

    //EXCLUIR
    function excluir($VO) {
        $query = "delete from  AGENCIA_ESTAGIO where ID_AGENCIA_ESTAGIO = '".$VO->ID_AGENCIA_ESTAGIO."'";

        return $this->sql($query);
    }

}

?>