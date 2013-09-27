<?php
require_once $path."src/repositorio/Repositorio.php";

class RepositorioOrgao_Gestor extends Repositorio{

    function pesquisarUnidade($VO){

        $query="select ID_UNIDADE_ORG CODIGO, TX_SIGLA_UNIDADE ||' - '|| TX_UNIDADE_ORG TX_UNIDADE_ORG
			FROM UNIDADE_ORG WHERE ID_SISTEMA_GESTAO = 2 AND CS_ATIVA = 0 AND LENGTH(NB_CODIGO_UNIDADE) = 5 AND CS_TIPO_UNID_ORG = 1 ORDER BY TX_UNIDADE_ORG";

        return $this->sqlVetor($query);
    }

	function pesquisar($VO) {

        $query = "select a.ID_ORGAO_GESTOR_ESTAGIO, a.TX_ORGAO_GESTOR_ESTAGIO, TO_CHAR(a.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,
					  to_char(a.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO, B.TX_SIGLA_UNIDADE, B.TX_UNIDADE_ORG
					from ORGAO_GESTOR_ESTAGIO a, UNIDADE_ORG B
					where a.ID_UNIDADE_ORG = B.ID_UNIDADE_ORG ";

		($VO->TX_ORGAO_GESTOR_ESTAGIO) ? $query .= " AND upper(a.TX_ORGAO_GESTOR_ESTAGIO) like upper('%".$VO->TX_ORGAO_GESTOR_ESTAGIO."%') "  : false;
		($VO->ID_UNIDADE_ORG) ? $query .= " AND a.ID_UNIDADE_ORG = '".$VO->ID_UNIDADE_ORG."' "  : false;

        $query .= " ORDER BY a.DT_ATUALIZACAO desc, a.DT_CADASTRO desc";

        if ($VO->Reg_quantidade){
            !$VO->Reg_inicio? $VO->Reg_inicio = 0: false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (".$query.") PAGING WHERE (ROWNUM <= ".($VO->Reg_quantidade+$VO->Reg_inicio)."))  WHERE (PAGING_RN > ".$VO->Reg_inicio.")";
        }

        return $this->sqlVetor($query);
    }

	function inserir($VO){

		$queryPK = "select SEMAD.F_G_PK_ORGAO_GESTOR_ESTAGIO as ID_ORGAO_GESTOR_ESTAGIO from DUAL";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "
            INSERT INTO ORGAO_GESTOR_ESTAGIO(ID_ORGAO_GESTOR_ESTAGIO, TX_ORGAO_GESTOR_ESTAGIO, DT_CADASTRO, DT_ATUALIZACAO, ID_UNIDADE_ORG,TX_CNPJ)
						values
	    ('".$CodigoPK['ID_ORGAO_GESTOR_ESTAGIO'][0]."', '".$VO->TX_ORGAO_GESTOR_ESTAGIO."', SYSDATE, SYSDATE, '".$VO->ID_UNIDADE_ORG."','".$VO->TX_CNPJ."')
        ";

        $retorno = $this->sql($query);
        return $retorno ? '' : $CodigoPK['ID_ORGAO_GESTOR_ESTAGIO'][0];
    }

	function buscar($VO) {

        $query = "SELECT 
                        ORGAO_GESTOR_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO,
                        ORGAO_GESTOR_ESTAGIO.TX_ORGAO_GESTOR_ESTAGIO,
                        ORGAO_GESTOR_ESTAGIO.TX_CNPJ,
                        TO_CHAR(ORGAO_GESTOR_ESTAGIO.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,
                        TO_CHAR(ORGAO_GESTOR_ESTAGIO.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
                        ORGAO_GESTOR_ESTAGIO.ID_UNIDADE_ORG,
                        UNIDADE_ORG.TX_SIGLA_UNIDADE || ' - ' ||  UNIDADE_ORG.TX_UNIDADE_ORG as  TX_SIGLA_UNIDADE
                FROM 
                        ORGAO_GESTOR_ESTAGIO,
                        UNIDADE_ORG
                WHERE
                    ORGAO_GESTOR_ESTAGIO.ID_UNIDADE_ORG = UNIDADE_ORG.ID_UNIDADE_ORG
                      and   ID_ORGAO_GESTOR_ESTAGIO = '".$VO->ID_ORGAO_GESTOR_ESTAGIO."'";

//        print_r($query);
          return $this->sqlVetor($query);
    }

	function alterar($VO){

        $query = "update ORGAO_GESTOR_ESTAGIO set
					TX_ORGAO_GESTOR_ESTAGIO = '".$VO->TX_ORGAO_GESTOR_ESTAGIO."' ,
					ID_UNIDADE_ORG = '".$VO->ID_UNIDADE_ORG."' ,
					DT_ATUALIZACAO = SYSDATE,
                                        TX_CNPJ ='".$VO->TX_CNPJ."'
				 where
 					ID_ORGAO_GESTOR_ESTAGIO = '".$VO->ID_ORGAO_GESTOR_ESTAGIO."'";

        return $this->sql($query);
    }

	function excluir($VO){

        $query = "delete from ORGAO_GESTOR_ESTAGIO
                	where ID_ORGAO_GESTOR_ESTAGIO = '".$VO->ID_ORGAO_GESTOR_ESTAGIO."'";

        return $this->sql($query);
    }

    /**     +++++++++++++++++++    DETAIL ++++++++++++++++++++++++++++/
     *
     *  
     */
    function buscarEmails($VO) {
		
        $query = "SELECT * FROM ORGAO_GESTOR_EMAIL WHERE ID_ORGAO_GESTOR_ESTAGIO = '".$VO->ID_ORGAO_GESTOR_ESTAGIO."'";

        return $this->sqlVetor($query);
    }
	
	function inserirEmail($VO){

		$query = "
            INSERT INTO ORGAO_GESTOR_EMAIL(ID_ORGAO_GESTOR_ESTAGIO, NB_ORGAO_GESTOR_EMAIL, TX_EMAIL) 
					VALUES (".$VO->ID_ORGAO_GESTOR_ESTAGIO.", SEMAD.F_G_PK_ORGAO_GESTOR_EMAIL(".$VO->ID_ORGAO_GESTOR_ESTAGIO."), '".mb_strtolower($VO->TX_EMAIL)."')";
//                print_r($query);
  return $this->sql($query);
    }
	
	function atualizarInf($VO) {

      $query = "update ORGAO_GESTOR_ESTAGIO set
				  DT_ATUALIZACAO = sysdate
				  where ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_GESTOR_ESTAGIO;

      $this->sql($query);

      $data = "select TO_CHAR(DT_ATUALIZACAO, 'DD/MM/YYYY hh24:mi:ss') DT_ATUALIZACAO
	  			from ORGAO_GESTOR_ESTAGIO
				where ID_ORGAO_GESTOR_ESTAGIO = ".$VO->ID_ORGAO_GESTOR_ESTAGIO;

      $this->sqlVetor($data);
      $datahora = $this->getVetor();

      return $datahora;
    }
	
	
	function excluirEmail($VO){

        $query = "
            delete from ORGAO_GESTOR_EMAIL
                where ID_ORGAO_GESTOR_ESTAGIO = ".$VO->ID_ORGAO_GESTOR_ESTAGIO." 
                  and NB_ORGAO_GESTOR_EMAIL = ".$VO->NB_ORGAO_GESTOR_EMAIL."";

        return $this->sql($query);
    }
}

?>