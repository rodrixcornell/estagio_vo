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
        
        $query .= " ORDER BY a.TX_ORGAO_GESTOR_ESTAGIO";

        if ($VO->Reg_quantidade){
            !$VO->Reg_inicio? $VO->Reg_inicio = 0: false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (".$query.") PAGING WHERE (ROWNUM <= ".($VO->Reg_quantidade+$VO->Reg_inicio)."))  WHERE (PAGING_RN > ".$VO->Reg_inicio.")";
        }

        return $this->sqlVetor($query);
    }
	/*
	function inserir($VO){
		
		$queryPK = "select SEMAD.F_G_PK_UNIDADE_IRP as ID_UNIDADE_IRP from DUAL";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "
            INSERT INTO UNIDADE_IRP(ID_UNIDADE_IRP, TX_UNIDADE_IRP, DT_CADASTRO, DT_ATUALIZACAO, ID_UNIDADE_ORG) 
						values
								('".$CodigoPK['ID_UNIDADE_IRP'][0]."', '".$VO->TX_UNIDADE_IRP."', SYSDATE, SYSDATE, '".$VO->ID_UNIDADE_ORG."')
        ";

        $retorno = $this->sql($query);
        return $retorno ? '' : $CodigoPK['ID_UNIDADE_IRP'][0];
    }
	
	function buscar($VO) {
		
        $query = "select id_unidade_irp, TX_UNIDADE_IRP, TO_CHAR(DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO, to_char(DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO, ID_UNIDADE_ORG from unidade_irp where id_unidade_irp = '".$VO->ID_UNIDADE_IRP."'";
       

        return $this->sqlVetor($query);
    }
	
	function alterar($VO){

        $query = "update unidade_irp set
					TX_UNIDADE_IRP = '".$VO->TX_UNIDADE_IRP."' ,
					ID_UNIDADE_ORG = '".$VO->ID_UNIDADE_ORG."' ,
					DT_ATUALIZACAO = SYSDATE
				 where
 					ID_UNIDADE_IRP = '".$VO->ID_UNIDADE_IRP."'";

        return $this->sql($query);
    }
	
	function excluir($VO){

        $query = "delete from unidade_irp
                	where ID_UNIDADE_IRP = '".$VO->ID_UNIDADE_IRP."'";
        
        return $this->sql($query);
    }
	*/
}

?>