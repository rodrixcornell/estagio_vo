<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioQuadro_vagas extends Repositorio {

//---pesquisa agencia de estagio-----
    function pesquisarCodigo($VO) {
        $query = "SELECT ID_QUADRO_VAGAS_ESTAGIO,
                         ID_QUADRO_VAGAS_ESTAGIO CODIGO,
                         TX_CODIGO
                    FROM QUADRO_VAGAS_ESTAGIO";

        return $this->sqlVetor($query);
    }

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
                    FROM AGENCIA_ESTAGIO AG ";

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
                        AG.ID_AGENCIA_ESTAGIO,
                        AG.TX_AGENCIA_ESTAGIO,
                        QVE.TX_CODIGO,
                        QVE.ID_QUADRO_VAGAS_ESTAGIO,
                        QVE.CS_SITUACAO,
                        DECODE(QVE.CS_SITUACAO, 1,'ATIVO ', 2,'DESATIVADO') TX_SITUACAO,
                        TO_CHAR(QVE.DT_CADASTRO,'DD/MM/YYYY HH24:MI:SS')DT_CADASTRO,
                        TO_CHAR(QVE.DT_ATUALIZACAO,'DD/MM/YYYY HH24:MI:SS')DT_ATUALIZACAO,
                        QVE.ID_CONTRATO_CP,
                        CP.NB_CODIGO
                   FROM QUADRO_VAGAS_ESTAGIO QVE,
                        AGENCIA_ESTAGIO AG,
                        ORGAO_GESTOR_ESTAGIO OGE,
                        CONTRATO_CP CP
                  WHERE QVE.ID_AGENCIA_ESTAGIO = AG.ID_AGENCIA_ESTAGIO
                        AND QVE.ID_ORGAO_GESTOR_ESTAGIO = OGE.ID_ORGAO_GESTOR_ESTAGIO
                        AND QVE.ID_CONTRATO_CP = CP.ID_CONTRATO_CP  ";


        if ($VO->ID_QUADRO_VAGAS_ESTAGIO) {
            $query .= " AND QVE.ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . " ";
        }

        if ($VO->ID_ORGAO_GESTOR_ESTAGIO) {
            $query .= " AND OGE.ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_GESTOR_ESTAGIO . " ";
        }

        if ($VO->ID_AGENCIA_ESTAGIO) {
            $query .= " AND AG.ID_AGENCIA_ESTAGIO = " . $VO->ID_AGENCIA_ESTAGIO . " ";
        }

        if ($VO->CS_SITUACAO) {
            $query .= " AND QVE.CS_SITUACAO = " . $VO->CS_SITUACAO . " ";
        }
        
        if ($VO->NB_CODIGO) {
            $query .= " AND CP.NB_CODIGO = " . $VO->NB_CODIGO . " ";
        }

        $query .=" ORDER BY OGE.TX_ORGAO_GESTOR_ESTAGIO";


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
                                                   ID_AGENCIA_ESTAGIO,
                                                   ID_ORGAO_GESTOR_ESTAGIO,
                                                   DT_CADASTRO,
                                                   DT_ATUALIZACAO,
                                                   ID_USUARIO_ATUALIZACAO,
                                                   ID_USUARIO_CADASTRO,
                                                   CS_SITUACAO,
                                                   TX_CODIGO,
                                                   ID_CONTRATO_CP)
		       values(" . $CodigoPK['ID_QUADRO_VAGAS_ESTAGIO'][0] . ",
			      " . $VO->ID_AGENCIA_ESTAGIO . ",
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

//-------------------------------alterar master---------------------------------
    function alterar($VO) {
        $query = "update QUADRO_VAGAS_ESTAGIO set
                                ID_AGENCIA_ESTAGIO = " . $VO->ID_AGENCIA_ESTAGIO . ",
                                ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ",
                                DT_ATUALIZACAO = SYSDATE,
                                ID_USUARIO_ATUALIZACAO =  " . $_SESSION['ID_USUARIO'] . ",
                                CS_SITUACAO = " . $VO->CS_SITUACAO . ",
                                ID_CONTRATO_CP = " . $VO->ID_CONTRATO_CP . "    

		 where
 		    ID_QUADRO_VAGAS_ESTAGIO = '" . $VO->ID_QUADRO_VAGAS_ESTAGIO . "'";
        print_r($query);
        return $this->sql($query);
    }

//---------------------------buscar MASTER -------------------------------------
    function buscar($VO) {
        $query = " SELECT DISTINCT
                        OGE.ID_ORGAO_GESTOR_ESTAGIO,
                        OGE.TX_ORGAO_GESTOR_ESTAGIO,
                        AG.ID_AGENCIA_ESTAGIO,
                        AG.TX_AGENCIA_ESTAGIO,
                        QVE.TX_CODIGO,
                        QVE.ID_QUADRO_VAGAS_ESTAGIO,
                        QVE.CS_SITUACAO,
                        TO_CHAR(QVE.DT_CADASTRO,'DD/MM/YYYY HH24:MI:SS')DT_CADASTRO,
                        TO_CHAR(QVE.DT_ATUALIZACAO,'DD/MM/YYYY HH24:MI:SS')DT_ATUALIZACAO,
                        DECODE(QVE.CS_SITUACAO, 1,'ATIVO', 2,'DESATIVADO')TX_SITUACAO,
                        FUNCIONARIO_CADASTRO.TX_FUNCIONARIO TX_FUNCIONARIO_CADASTRO,
                        FUNCIONARIO_ATUALIZACAO.TX_FUNCIONARIO TX_FUNCIONARIO_ATUALIZACAO,
                        QVE.ID_CONTRATO_CP,
                        CONTRATO_CP.NB_CODIGO
                   FROM QUADRO_VAGAS_ESTAGIO QVE,
                        AGENCIA_ESTAGIO AG,
                        ORGAO_GESTOR_ESTAGIO OGE,
                        USUARIO USUARIO_CADASTRADO,
                        USUARIO USUARIO_ATUALIZACAO,
                        V_FUNCIONARIO_TOTAL FUNCIONARIO_CADASTRO,
                        V_FUNCIONARIO_TOTAL FUNCIONARIO_ATUALIZACAO,
                        CONTRATO_CP
                  WHERE QVE.ID_AGENCIA_ESTAGIO = AG.ID_AGENCIA_ESTAGIO
                        AND QVE.ID_ORGAO_GESTOR_ESTAGIO = OGE.ID_ORGAO_GESTOR_ESTAGIO
                        AND QVE.ID_USUARIO_CADASTRO = USUARIO_CADASTRADO.ID_USUARIO
                        AND QVE.ID_USUARIO_ATUALIZACAO = USUARIO_ATUALIZACAO.ID_USUARIO
                        AND USUARIO_CADASTRADO.ID_PESSOA_FUNCIONARIO = FUNCIONARIO_CADASTRO.ID_PESSOA_FUNCIONARIO
                        AND USUARIO_ATUALIZACAO.ID_PESSOA_FUNCIONARIO = FUNCIONARIO_ATUALIZACAO.ID_PESSOA_FUNCIONARIO
                        AND USUARIO_CADASTRADO.ID_UNIDADE_GESTORA = FUNCIONARIO_CADASTRO.ID_UNIDADE_GESTORA
                        AND USUARIO_ATUALIZACAO.ID_UNIDADE_GESTORA = FUNCIONARIO_ATUALIZACAO.ID_UNIDADE_GESTORA
                        AND QVE.ID_CONTRATO_CP = CONTRATO_CP.ID_CONTRATO_CP
                        AND QVE.ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . " ";

        return $this->sqlVetor($query);
    }

//--------------------------------DETAIL----------------------------------------
//---------ORGÃO SOLICITANTE-----------------
    function orgao_Solicitante($VO) {
        $query = "select distinct a.ID_ORGAO_ESTAGIO CODIGO, a.TX_ORGAO_ESTAGIO
					from ORGAO_ESTAGIO a, ORGAO_AGENTE_SETORIAL B, AGENTE_SETORIAL_ESTAGIO C
					where a.ID_ORGAO_ESTAGIO = B.ID_ORGAO_ESTAGIO
					and B.ID_SETORIAL_ESTAGIO = C.ID_SETORIAL_ESTAGIO
					and c.id_usuario = '" . $_SESSION['ID_USUARIO'] . "'";

        return $this->sqlVetor($query);
    }

//-----------TIPO DE ESTAGIO----------------
    function pesquisarTipo($VO) {
        $query = "SELECT CS_TIPO_VAGA_ESTAGIO,CS_TIPO_VAGA_ESTAGIO CODIGO,
       TX_TIPO_VAGA_ESTAGIO
  FROM TIPO_VAGA_ESTAGIO TVE";

        return $this->sqlVetor($query);
    }

//-----------PESQUISA CURSO------------------------
    function pesquisaCursos($VO) {
        $query = "  SELECT ID_CURSO_ESTAGIO,ID_CURSO_ESTAGIO CODIGO,
                       TX_CURSO_ESTAGIO
                  FROM CURSO_ESTAGIO";

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
                            ID_CURSO_ESTAGIO)
              values
                  (" . $VO->ID_QUADRO_VAGAS_ESTAGIO . ",
                   " . $VO->ID_ORGAO_ESTAGIO . ",
                   " . $VO->NB_QUANTIDADE . ",
                   " . $VO->CS_TIPO_VAGA_ESTAGIO . ",
                     SYSDATE,
                     SYSDATE,
                   " . $_SESSION['ID_USUARIO'] . ",
                   " . $_SESSION['ID_USUARIO'] . ",
                   " . $VO->ID_CURSO_ESTAGIO . ")";

        return $this->sql($query);
    }

//----------TRAZ A PESQUISA DO DETAIL ------------------
    function pesquisarUnidades($VO) {
        $query = "SELECT VE.ID_QUADRO_VAGAS_ESTAGIO,
                    VE.ID_ORGAO_ESTAGIO,
                    VE.NB_QUANTIDADE,
                    VE.CS_TIPO_VAGA_ESTAGIO,
                    to_char(VE.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,
                    to_char(VE.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
                    VE.ID_USUARIO_CADASTRO,
                    VE.ID_USUARIO_ATUALIZACAO,
                    VE.ID_CURSO_ESTAGIO,
                    OE.TX_ORGAO_ESTAGIO,
                    TVE.TX_TIPO_VAGA_ESTAGIO,
                    CE.TX_CURSO_ESTAGIO
               FROM VAGAS_ESTAGIO VE,
                    ORGAO_ESTAGIO OE,
                    TIPO_VAGA_ESTAGIO TVE,
                    CURSO_ESTAGIO CE
              WHERE (VE.ID_ORGAO_ESTAGIO = OE.ID_ORGAO_ESTAGIO)
                AND (VE.CS_TIPO_VAGA_ESTAGIO = TVE.CS_TIPO_VAGA_ESTAGIO)
                AND (VE.ID_CURSO_ESTAGIO = CE.ID_CURSO_ESTAGIO)";


        if ($VO->ID_QUADRO_VAGAS_ESTAGIO) {
            $query .= " AND VE.ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . " ";
        }

        if ($VO->ID_ORGAO_ESTAGIO) {
            $query .= " AND VE.ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . " ";
        }

        if ($VO->CS_TIPO_VAGA_ESTAGIO) {
            $query .= " AND VE.CS_TIPO_VAGA_ESTAGIO = " . $VO->CS_TIPO_VAGA_ESTAGIO . " ";
        }

        $query .= " ORDER BY OE.ID_ORGAO_ESTAGIO";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

//-------alterar da pesquisa detail---------------
    function alterarVaga($VO) {
        $query = "update VAGAS_ESTAGIO set
                                ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . ",
                                NB_QUANTIDADE = " . $VO->NB_QUANTIDADE . ",
                                CS_TIPO_VAGA_ESTAGIO = " . $VO->CS_TIPO_VAGA_ESTAGIO . ",
                                DT_ATUALIZACAO = SYSDATE,
                                ID_USUARIO_ATUALIZACAO =  " . $_SESSION['ID_USUARIO'] . ",
                                ID_CURSO_ESTAGIO = " . $VO->ID_CURSO_ESTAGIO . "
		 where
		 	ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . "   and
 		    ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO_ANT . "   and
            CS_TIPO_VAGA_ESTAGIO = " . $VO->CS_TIPO_VAGA_ESTAGIO_ANT . "  ";

        return $this->sql($query);
    }

//CS_TIPO_VAGA_ESTAGIO = " . $VO->CS_TIPO_VAGA_ESTAGIO . ",
// ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . ",
//------EXCLUIR detail-------------------
    function excluirUnidade($VO) {

        $query = "
            DELETE
              FROM VAGAS_ESTAGIO
             WHERE ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . "
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

}

?>