<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioQuadro_vagas extends Repositorio {


    //----pesquisa orgão gestor-------
    function pesquisarOrgaogestor($VO) {
        $query = " select ID_ORGAO_GESTOR_ESTAGIO,
                       ID_ORGAO_GESTOR_ESTAGIO CODIGO,
                       TX_ORGAO_GESTOR_ESTAGIO
                  from ORGAO_GESTOR_ESTAGIO OGE";
        return $this->sqlVetor($query);
    }

//---pesquisa agencia de estagio-----
    function pesquisarAgenciaestagio($VO) {
        $query = "SELECT ID_AGENCIA_ESTAGIO,
                         ID_AGENCIA_ESTAGIO CODIGO,
                         TX_AGENCIA_ESTAGIO
                    FROM AGENCIA_ESTAGIO AG 
					ORDER BY TX_AGENCIA_ESTAGIO";

        return $this->sqlVetor($query);
    }
//---------------------------------------
    function  pesquisaContrato($vO){
        $query = "SELECT ID_CONTRATO_CP, ID_CONTRATO_CP CODIGO,
                         NB_CODIGO
                    FROM CONTRATO_CP";

        return $this->sqlVetor($query);
    }



//----------------pesquisa principal--------------------------------------------
    function pesquisar($VO) {
        $query = "SELECT OGE.ID_ORGAO_GESTOR_ESTAGIO,
                        OGE.TX_ORGAO_GESTOR_ESTAGIO,
                        QVE.TX_CODIGO,
                        QVE.ID_QUADRO_VAGAS_ESTAGIO,
                        QVE.CS_SITUACAO,
                        DECODE(QVE.CS_SITUACAO, 1,'ATIVADO', 2,'DESATIVADO') TX_SITUACAO,
                        TO_CHAR(QVE.DT_CADASTRO,'DD/MM/YYYY HH24:MI:SS')DT_CADASTRO,
                        TO_CHAR(QVE.DT_ATUALIZACAO,'DD/MM/YYYY HH24:MI:SS')DT_ATUALIZACAO,
                        QVE.ID_CONTRATO_CP
                   FROM QUADRO_VAGAS_ESTAGIO QVE,
                        ORGAO_GESTOR_ESTAGIO OGE
                  WHERE QVE.ID_ORGAO_GESTOR_ESTAGIO = OGE.ID_ORGAO_GESTOR_ESTAGIO";


        if ($VO->ID_ORGAO_GESTOR_ESTAGIO) {
            $query .= " AND OGE.ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_GESTOR_ESTAGIO . " ";
        }

        if ($VO->CS_SITUACAO) {
            $query .= " AND QVE.CS_SITUACAO = " . $VO->CS_SITUACAO . " ";
        }

        $query .=" ORDER BY DT_ATUALIZACAO desc, DT_CADASTRO desc, QVE.TX_CODIGO";


        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

//--------------------------CADASTRAR ------------------------------------------
    function inserir($VO) {
        $queryPK = "select SEMAD.F_G_PK_QUADRO_VAGAS_ESTAGIO() as ID_QUADRO_VAGAS_ESTAGIO from dual";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "INSERT INTO QUADRO_VAGAS_ESTAGIO(ID_QUADRO_VAGAS_ESTAGIO,
                                                   ID_ORGAO_GESTOR_ESTAGIO,
                                                   DT_CADASTRO,
                                                   DT_ATUALIZACAO,
                                                   ID_USUARIO_ATUALIZACAO,
                                                   ID_USUARIO_CADASTRO,
                                                   CS_SITUACAO,
                                                   TX_CODIGO,
                                                   ID_CONTRATO_CP)
		       values(" . $CodigoPK['ID_QUADRO_VAGAS_ESTAGIO'][0] . ",
			      	  " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ",
			              SYSDATE,
				  		  SYSDATE,
		              " . $_SESSION['ID_USUARIO'] . ",
			      	  " . $_SESSION['ID_USUARIO'] . ",
			      	  " . $VO->CS_SITUACAO . ",
				  		  SEMAD.F_G_COD_QUADRO_VAGAS_ESTAGIO(),
                      " . $VO->ID_CONTRATO_CP . ")";

        $retorno = $this->sql($query);

        if (!$retorno)
            return $CodigoPK['ID_QUADRO_VAGAS_ESTAGIO'][0];
    }
	
	function verificarAtivo($VO) {
        $query = "select ID_QUADRO_VAGAS_ESTAGIO from QUADRO_VAGAS_ESTAGIO where CS_SITUACAO = 1";
		
		$VO->ID_QUADRO_VAGAS_ESTAGIO ? $query .= " and ID_QUADRO_VAGAS_ESTAGIO not in (".$VO->ID_QUADRO_VAGAS_ESTAGIO.")" : false;

        return $this->sqlVetor($query);
    }
	
	

//-------------------------------alterar master---------------------------------
    function alterar($VO) {
        $query = "update QUADRO_VAGAS_ESTAGIO set
                                ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ",
                                DT_ATUALIZACAO = SYSDATE,
                                ID_USUARIO_ATUALIZACAO =  " . $_SESSION['ID_USUARIO'] . ",
                                CS_SITUACAO = " . $VO->CS_SITUACAO . ",
                                ID_CONTRATO_CP = " . $VO->ID_CONTRATO_CP . "

		 where
 		    ID_QUADRO_VAGAS_ESTAGIO = '" . $VO->ID_QUADRO_VAGAS_ESTAGIO . "'";

        return $this->sql($query);
    }

//---------------------------buscar MASTER -------------------------------------
    function buscar($VO) {
        $query = "select a.ID_QUADRO_VAGAS_ESTAGIO, a.ID_ORGAO_GESTOR_ESTAGIO, a.TX_CODIGO, C.ID_CONTRATO_CP, C.NB_CODIGO, B.TX_ORGAO_GESTOR_ESTAGIO, a.CS_SITUACAO, DECODE(a.CS_SITUACAO, 1,'ATIVADO', 2,'DESATIVADO') TX_SITUACAO,
							TO_CHAR(a.DT_CADASTRO,'DD/MM/YYYY HH24:MI:SS')DT_CADASTRO, TO_CHAR(a.DT_ATUALIZACAO,'DD/MM/YYYY HH24:MI:SS')DT_ATUALIZACAO,
							FUNCIONARIO_CADASTRO.TX_FUNCIONARIO TX_FUNCIONARIO_CADASTRO, FUNCIONARIO_ATUALIZACAO.TX_FUNCIONARIO TX_FUNCIONARIO_ATUALIZACAO
							from QUADRO_VAGAS_ESTAGIO a, ORGAO_GESTOR_ESTAGIO B, CONTRATO_CP C, USUARIO USUARIO_CADASTRADO, USUARIO USUARIO_ATUALIZACAO, 
							V_FUNCIONARIO_TOTAL FUNCIONARIO_CADASTRO, V_FUNCIONARIO_TOTAL FUNCIONARIO_ATUALIZACAO
							where a.ID_ORGAO_GESTOR_ESTAGIO = B.ID_ORGAO_GESTOR_ESTAGIO
							and a.ID_CONTRATO_CP = C.ID_CONTRATO_CP
							and a.ID_USUARIO_CADASTRO = USUARIO_CADASTRADO.ID_USUARIO
							and a.ID_USUARIO_ATUALIZACAO = USUARIO_ATUALIZACAO.ID_USUARIO
							and USUARIO_CADASTRADO.ID_PESSOA_FUNCIONARIO = FUNCIONARIO_CADASTRO.ID_PESSOA_FUNCIONARIO
							and USUARIO_ATUALIZACAO.ID_PESSOA_FUNCIONARIO = FUNCIONARIO_ATUALIZACAO.ID_PESSOA_FUNCIONARIO
							and USUARIO_CADASTRADO.ID_UNIDADE_GESTORA = FUNCIONARIO_CADASTRO.ID_UNIDADE_GESTORA
							and USUARIO_ATUALIZACAO.ID_UNIDADE_GESTORA = FUNCIONARIO_ATUALIZACAO.ID_UNIDADE_GESTORA
                        	AND a.ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . " ";

        return $this->sqlVetor($query);
    }

//--------------------------------DETAIL----------------------------------------
//---------ORGÃO SOLICITANTE-----------------
    function orgao_Solicitante($VO) {
        $query = "select distinct a.ID_ORGAO_ESTAGIO CODIGO, a.TX_ORGAO_ESTAGIO
					from ORGAO_ESTAGIO a, ORGAO_AGENTE_SETORIAL B, AGENTE_SETORIAL_ESTAGIO C
					where a.ID_ORGAO_ESTAGIO = B.ID_ORGAO_ESTAGIO
					and B.ID_SETORIAL_ESTAGIO = C.ID_SETORIAL_ESTAGIO
					and c.id_usuario = '" . $_SESSION['ID_USUARIO'] . "'
					ORDER BY a.TX_ORGAO_ESTAGIO";

        return $this->sqlVetor($query);
    }

//-----------TIPO DE ESTAGIO----------------
    function pesquisarTipo($VO) {
        $query = "SELECT CS_TIPO_VAGA_ESTAGIO,CS_TIPO_VAGA_ESTAGIO CODIGO,
					   TX_TIPO_VAGA_ESTAGIO
				  FROM TIPO_VAGA_ESTAGIO TVE
				  ORDER BY TX_TIPO_VAGA_ESTAGIO";

        return $this->sqlVetor($query);
    }

//-----------PESQUISA CURSO------------------------
    function pesquisaCursos($VO) {
        $query = "  SELECT ID_CURSO_ESTAGIO,ID_CURSO_ESTAGIO CODIGO,
                       TX_CURSO_ESTAGIO
                  FROM CURSO_ESTAGIO
				  ORDER BY TX_CURSO_ESTAGIO";

        return $this->sqlVetor($query);
    }

//-----------ISERIR O ORGÃO SOLICITANTE, TIPO, CURSO,QTD ---------------------------
    function inserirVaga($VO) {
        $query = " INSERT INTO SEMAD.VAGAS_ESTAGIO(
                            ID_QUADRO_VAGAS_ESTAGIO,
                            ID_ORGAO_ESTAGIO,
                            NB_QUANTIDADE,
                            CS_TIPO_VAGA_ESTAGIO,
                            DT_CADASTRO,
                            DT_ATUALIZACAO,
                            ID_USUARIO_CADASTRO,
                            ID_USUARIO_ATUALIZACAO,
                            ID_CURSO_ESTAGIO,
							ID_AGENCIA_ESTAGIO)
              values
                  (" . $VO->ID_QUADRO_VAGAS_ESTAGIO . ",
                   " . $VO->ID_ORGAO_ESTAGIO . ",
                   " . $VO->NB_QUANTIDADE . ",
                   " . $VO->CS_TIPO_VAGA_ESTAGIO . ",
                     SYSDATE,
                     SYSDATE,
                   " . $_SESSION['ID_USUARIO'] . ",
                   " . $_SESSION['ID_USUARIO'] . ",
                   '" . $VO->ID_CURSO_ESTAGIO . "',
				   " . $VO->ID_AGENCIA_ESTAGIO . ")";

        return $this->sql($query);
    }

//----------TRAZ A PESQUISA DO DETAIL ------------------
    function pesquisarUnidades($VO) {
        $query = "
					select a.ID_QUADRO_VAGAS_ESTAGIO, a.ID_AGENCIA_ESTAGIO, a.ID_ORGAO_ESTAGIO, a.CS_TIPO_VAGA_ESTAGIO, a.NB_QUANTIDADE, E.ID_CURSO_ESTAGIO, B.TX_AGENCIA_ESTAGIO, 
				  C.TX_ORGAO_ESTAGIO, D.TX_TIPO_VAGA_ESTAGIO, E.TX_CURSO_ESTAGIO
			from VAGAS_ESTAGIO a, AGENCIA_ESTAGIO B, ORGAO_ESTAGIO C, TIPO_VAGA_ESTAGIO D, CURSO_ESTAGIO E, USUARIO USUARIO_CADASTRADO, 
			USUARIO USUARIO_ATUALIZACAO, V_FUNCIONARIO_TOTAL FUNCIONARIO_CADASTRO, V_FUNCIONARIO_TOTAL FUNCIONARIO_ATUALIZACAO
			where a.ID_AGENCIA_ESTAGIO = B.ID_AGENCIA_ESTAGIO
			and a.ID_ORGAO_ESTAGIO = C.ID_ORGAO_ESTAGIO
			and a.CS_TIPO_VAGA_ESTAGIO = D.CS_TIPO_VAGA_ESTAGIO
			and a.ID_CURSO_ESTAGIO = E.ID_CURSO_ESTAGIO(+)
			and a.ID_USUARIO_CADASTRO = USUARIO_CADASTRADO.ID_USUARIO
			and a.ID_USUARIO_ATUALIZACAO = USUARIO_ATUALIZACAO.ID_USUARIO
			and USUARIO_CADASTRADO.ID_PESSOA_FUNCIONARIO = FUNCIONARIO_CADASTRO.ID_PESSOA_FUNCIONARIO
			and USUARIO_ATUALIZACAO.ID_PESSOA_FUNCIONARIO = FUNCIONARIO_ATUALIZACAO.ID_PESSOA_FUNCIONARIO
			and USUARIO_CADASTRADO.ID_UNIDADE_GESTORA = FUNCIONARIO_CADASTRO.ID_UNIDADE_GESTORA
			and USUARIO_ATUALIZACAO.ID_UNIDADE_GESTORA = FUNCIONARIO_ATUALIZACAO.ID_UNIDADE_GESTORA
			and a.ID_QUADRO_VAGAS_ESTAGIO = ".$VO->ID_QUADRO_VAGAS_ESTAGIO;
		
		$VO->ID_AGENCIA_ESTAGIO ? $query .= " AND a.ID_AGENCIA_ESTAGIO = " . $VO->ID_AGENCIA_ESTAGIO : false;
		$VO->ID_ORGAO_ESTAGIO ?   $query .= " AND a.ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO : false;
		$VO->CS_TIPO_VAGA_ESTAGIO ? $query .= " AND a.CS_TIPO_VAGA_ESTAGIO = " . $VO->CS_TIPO_VAGA_ESTAGIO : false;

        $query .= " ORDER BY B.TX_AGENCIA_ESTAGIO, C.TX_ORGAO_ESTAGIO, D.TX_TIPO_VAGA_ESTAGIO";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

//-------alterar da pesquisa detail---------------
    function alterarVaga($VO) {
        $query = "update VAGAS_ESTAGIO set
                                NB_QUANTIDADE = " . $VO->NB_QUANTIDADE . ",
                                DT_ATUALIZACAO = SYSDATE,
                                ID_USUARIO_ATUALIZACAO =  " . $_SESSION['ID_USUARIO'] . ",
                                ID_CURSO_ESTAGIO = '" . $VO->ID_CURSO_ESTAGIO . "'
		 where
		 	ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . "   and
			ID_AGENCIA_ESTAGIO = " . $VO->ID_AGENCIA_ESTAGIO . "   and
 		    ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . "   and
            CS_TIPO_VAGA_ESTAGIO = " . $VO->CS_TIPO_VAGA_ESTAGIO;

        return $this->sql($query);
    }

//------EXCLUIR detail-------------------
    function excluirUnidade($VO) {

        $query = "
            DELETE
              FROM VAGAS_ESTAGIO
             WHERE ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . "
			   AND ID_AGENCIA_ESTAGIO = " . $VO->ID_AGENCIA_ESTAGIO . "
               AND ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . "
               AND CS_TIPO_VAGA_ESTAGIO = " . $VO->CS_TIPO_VAGA_ESTAGIO . "  ";

        return $this->sql($query);
    }

//---------------excluir do master--------------------
    function excluir($VO) {
        $query = "
            delete from QUADRO_VAGAS_ESTAGIO
             where ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . " ";

        return $this->sql($query);
    }

    function atualizarInf($VO) {

        $query = "update QUADRO_VAGAS_ESTAGIO set
				  DT_ATUALIZACAO = sysdate,
				  ID_USUARIO_ATUALIZACAO = " . $_SESSION['ID_USUARIO'] . "
				  where ID_QUADRO_VAGAS_ESTAGIO =" . $VO->ID_QUADRO_VAGAS_ESTAGIO;

        $this->sql($query);

        $data = "select TO_CHAR(a.DT_ATUALIZACAO, 'DD/MM/YYYY hh24:mi:ss') DT_ATUALIZACAO, C.TX_FUNCIONARIO
	  			from QUADRO_VAGAS_ESTAGIO A, USUARIO B, V_FUNCIONARIO_USUARIO C
				where A.ID_QUADRO_VAGAS_ESTAGIO = '" . $VO->ID_QUADRO_VAGAS_ESTAGIO . "'
				and a.ID_USUARIO_ATUALIZACAO = B.ID_USUARIO
				and B.ID_PESSOA_FUNCIONARIO = C.ID_PESSOA_FUNCIONARIO
				AND B.ID_UNIDADE_GESTORA = C.ID_UNIDADE_GESTORA";

        $this->sqlVetor($data);
        $datahora = $this->getVetor();

        return $datahora;
    }


//--------------------Relatorio-----------------------------------------

    function buscarOrgaoEstagio($VO) {
        $query = "
            select distinct
                    oe.id_orgao_estagio,
                    oe.id_orgao_estagio CODIGO,
                    oe.tx_orgao_estagio
               from ORGAO_ESTAGIO oe
              order by tx_orgao_estagio
        ";

        return $this->sqlVetor($query);
    }

    function buscarQuadroVagas($VO) {
        $query = "
            select distinct
                    nvl(
                        (select sum(a.NB_QUANTIDADE)
                          from VAGAS_ESTAGIO a, QUADRO_VAGAS_ESTAGIO b
                         where a.ID_QUADRO_VAGAS_ESTAGIO = b.ID_QUADRO_VAGAS_ESTAGIO
                           and a.CS_TIPO_VAGA_ESTAGIO = 1
                           and a.ID_ORGAO_ESTAGIO = ".$VO->ID_ORGAO_ESTAGIO."
                           and b.ID_AGENCIA_ESTAGIO = ".$VO->ID_AGENCIA_ESTAGIO.")
                    , 0) NB_VAGA_MEDIO,
                    nvl(
                        (select sum(a.NB_QUANTIDADE)
                          from VAGAS_ESTAGIO a, QUADRO_VAGAS_ESTAGIO b
                         where a.ID_QUADRO_VAGAS_ESTAGIO = b.ID_QUADRO_VAGAS_ESTAGIO
                           and a.CS_TIPO_VAGA_ESTAGIO = 2
                           and a.ID_ORGAO_ESTAGIO = ".$VO->ID_ORGAO_ESTAGIO."
                           and b.ID_AGENCIA_ESTAGIO = ".$VO->ID_AGENCIA_ESTAGIO.")
                    , 0) NB_VAGA_SUP4H,
                    nvl(
                        (select sum(a.NB_QUANTIDADE)
                          from VAGAS_ESTAGIO a, QUADRO_VAGAS_ESTAGIO b
                         where a.ID_QUADRO_VAGAS_ESTAGIO = b.ID_QUADRO_VAGAS_ESTAGIO
                           and a.CS_TIPO_VAGA_ESTAGIO = 3
                           and a.ID_ORGAO_ESTAGIO = ".$VO->ID_ORGAO_ESTAGIO."
                           and b.ID_AGENCIA_ESTAGIO = ".$VO->ID_AGENCIA_ESTAGIO.")
                    , 0) NB_VAGA_SUP5H,
                    nvl(
                        (select sum(a.NB_QUANTIDADE)
                          from VAGAS_ESTAGIO a, QUADRO_VAGAS_ESTAGIO b
                         where a.ID_QUADRO_VAGAS_ESTAGIO = b.ID_QUADRO_VAGAS_ESTAGIO
                           and a.CS_TIPO_VAGA_ESTAGIO = 4
                           and a.ID_ORGAO_ESTAGIO = ".$VO->ID_ORGAO_ESTAGIO."
                           and b.ID_AGENCIA_ESTAGIO = ".$VO->ID_AGENCIA_ESTAGIO.")
                    , 0) NB_VAGA_SUP6H,
                    nvl(
                        (select sum(a.NB_QUANTIDADE)
                          from VAGAS_ESTAGIO a, QUADRO_VAGAS_ESTAGIO b
                         where a.ID_QUADRO_VAGAS_ESTAGIO = b.ID_QUADRO_VAGAS_ESTAGIO
                           and a.ID_ORGAO_ESTAGIO = ".$VO->ID_ORGAO_ESTAGIO."
                           and b.ID_AGENCIA_ESTAGIO = ".$VO->ID_AGENCIA_ESTAGIO.")
                    , 0) NB_VAGA_TOTAL
               from VAGAS_ESTAGIO ve,
                    QUADRO_VAGAS_ESTAGIO qve
              where ve.ID_QUADRO_VAGAS_ESTAGIO = qve.ID_QUADRO_VAGAS_ESTAGIO
                and ve.ID_ORGAO_ESTAGIO = ".$VO->ID_ORGAO_ESTAGIO."
                and qve.ID_AGENCIA_ESTAGIO = ".$VO->ID_AGENCIA_ESTAGIO;
        //print_r($query);
        return $this->sqlVetor($query);
    }

    // Funçõe de tabela de visualizãção de quadra de vagas
    function buscarAgenteIntegracao($VO){
      $query = "SELECT 
                  TX_SIGLA,
                  A.TX_AGENCIA_ESTAGIO,
                  A.ID_AGENCIA_ESTAGIO,
                  A.ID_AGENCIA_ESTAGIO CODIGO
                FROM AGENCIA_ESTAGIO A";
      return $this->sqlVetor($query);

    }
    function buscarQuadroVagasUnidades($VO){
      $query ="SELECT DISTINCT O.TX_ORGAO_ESTAGIO,
                  O.ID_ORGAO_ESTAGIO,
                  O.ID_ORGAO_ESTAGIO CODIGO,
                  NVL(
                  (SELECT VI.NB_QUANTIDADE
                  FROM VAGAS_ESTAGIO VI,
                    TIPO_VAGA_ESTAGIO T
                  WHERE VI.CS_TIPO_VAGA_ESTAGIO = T.CS_TIPO_VAGA_ESTAGIO
                  AND VI.ID_ORGAO_ESTAGIO       = O.ID_ORGAO_ESTAGIO
                  AND VI.ID_AGENCIA_ESTAGIO     = V.ID_AGENCIA_ESTAGIO
                  AND VI.CS_TIPO_VAGA_ESTAGIO   =1
                  ),0) VAGAS_NIVEL_MEDIO,
                  NVL(
                  (SELECT VI.NB_QUANTIDADE
                  FROM VAGAS_ESTAGIO VI,
                    TIPO_VAGA_ESTAGIO T
                  WHERE VI.CS_TIPO_VAGA_ESTAGIO = T.CS_TIPO_VAGA_ESTAGIO
                  AND VI.ID_ORGAO_ESTAGIO       = O.ID_ORGAO_ESTAGIO
                  AND VI.ID_AGENCIA_ESTAGIO     = V.ID_AGENCIA_ESTAGIO
                  AND VI.CS_TIPO_VAGA_ESTAGIO   =2
                  ) ,0)VAGAS_SUP_4_HORAS,
                  NVL(
                  (SELECT VI.NB_QUANTIDADE
                  FROM VAGAS_ESTAGIO VI,
                    TIPO_VAGA_ESTAGIO T
                  WHERE VI.CS_TIPO_VAGA_ESTAGIO = T.CS_TIPO_VAGA_ESTAGIO
                  AND VI.ID_ORGAO_ESTAGIO       = O.ID_ORGAO_ESTAGIO
                  AND VI.ID_AGENCIA_ESTAGIO     = V.ID_AGENCIA_ESTAGIO
                  AND VI.CS_TIPO_VAGA_ESTAGIO   =3
                  ) ,0)VAGAS_SUP_5_HORAS,
                  NVL(
                  (SELECT VI.NB_QUANTIDADE
                  FROM VAGAS_ESTAGIO VI,
                    TIPO_VAGA_ESTAGIO T
                  WHERE VI.CS_TIPO_VAGA_ESTAGIO = T.CS_TIPO_VAGA_ESTAGIO
                  AND VI.ID_ORGAO_ESTAGIO       = O.ID_ORGAO_ESTAGIO
                  AND VI.ID_AGENCIA_ESTAGIO     = V.ID_AGENCIA_ESTAGIO
                  AND VI.CS_TIPO_VAGA_ESTAGIO   =4
                  ) ,0)VAGAS_SUP_6_HORAS,
                  NVL(
                  (SELECT SUM(VI.NB_QUANTIDADE)
                  FROM VAGAS_ESTAGIO VI,
                    TIPO_VAGA_ESTAGIO T
                  WHERE VI.CS_TIPO_VAGA_ESTAGIO = T.CS_TIPO_VAGA_ESTAGIO
                  AND VI.ID_ORGAO_ESTAGIO       = O.ID_ORGAO_ESTAGIO
                  AND VI.ID_AGENCIA_ESTAGIO     = V.ID_AGENCIA_ESTAGIO
                  ) ,0)VAGAS_TOTAL
                FROM QUADRO_VAGAS_ESTAGIO Q,
                  VAGAS_ESTAGIO V,
                  ORGAO_ESTAGIO O
                WHERE V.ID_ORGAO_ESTAGIO      = O.ID_ORGAO_ESTAGIO
                AND Q.ID_QUADRO_VAGAS_ESTAGIO = V.ID_QUADRO_VAGAS_ESTAGIO
                AND V.ID_AGENCIA_ESTAGIO = '".$VO->ID_AGENCIA_ESTAGIO_TABELA ."'";
      return $this->sqlVetor($query);
    }
    
}
?>