<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioQuadro_vagas extends Repositorio {

//----------usuario------
    function pesquisarUsuario($VO) {
        $query = "SELECT DISTINCT V_PERFIL_USUARIO.ID_USUARIO CODIGO,
			     PESSOA.TX_NOME TX_FUNCIONARIO,
			     USUARIO.TX_LOGIN
			FROM V_PERFIL_USUARIO, USUARIO, PESSOA 
		       WHERE V_PERFIL_USUARIO.ID_USUARIO = USUARIO.ID_USUARIO
			 AND USUARIO.ID_PESSOA_FUNCIONARIO = PESSOA.ID_PESSOA
			 AND V_PERFIL_USUARIO.ID_SISTEMA = 75";
        return $this->sqlVetor($query);
    }

    

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

//----------------pesquisa principal--------------------------------------------	
    function pesquisar($VO) {
        $query = "SELECT OGE.ID_ORGAO_GESTOR_ESTAGIO,
                   OGE.TX_ORGAO_GESTOR_ESTAGIO,
                   AG.ID_AGENCIA_ESTAGIO,
                   AG.TX_AGENCIA_ESTAGIO,
                   QVE.TX_CODIGO,
                   QVE.ID_QUADRO_VAGAS_ESTAGIO,
                   QVE.CS_SITUACAO,
                   DECODE(QVE.CS_SITUACAO, 1,'ATIVO ', 2,'DESATIVADO')TX_SITUACAO,
                   TO_CHAR(QVE.DT_CADASTRO,'DD/MM/YYYY')DT_CADASTRO,
                   TO_CHAR(QVE.DT_ATUALIZACAO,'DD/MM/YYYY')DT_ATUALIZACAO
              FROM QUADRO_VAGAS_ESTAGIO QVE,
                   AGENCIA_ESTAGIO AG,
                   ORGAO_GESTOR_ESTAGIO OGE
             WHERE QVE.ID_AGENCIA_ESTAGIO = AG.ID_AGENCIA_ESTAGIO
                   AND QVE.ID_ORGAO_GESTOR_ESTAGIO = OGE.ID_ORGAO_GESTOR_ESTAGIO ";

//DECODE(QVE.CS_SITUACAO, 1,'ATIVADO ', 2,'DESATIVADO')CS_SITUACAO,
        if ($VO->TX_CODIGO) {
            $query .= " AND QVE.TX_CODIGO = " . $VO->TX_CODIGO . " ";
        }

        if ($VO->ID_ORGAO_GESTOR_ESTAGIO) {
            $query .= " AND OGE.ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_GESTOR_ESTAGIO . " ";
        }

        if ($VO->ID_AGENCIA_ESTAGIO) {
            $query .= " AND AG.ID_AGENCIA_ESTAGIO = " . $VO->ID_AGENCIA_ESTAGIO . " ";
        }

        if ($VO->CS_SITUACAO == '1' || $VO->CS_SITUACAO == '2') {
            $query .= " AND AG.CS_SITUACAO = " . $VO->CS_SITUACAO . " ";
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
        $queryPK = "select SEMAD.F_G_PK_QUADRO_VAGAS_ESTAGIO as ID_QUADRO_VAGAS_ESTAGIO from dual";
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
                                                   TX_CODIGO)
		       values(" . $CodigoPK['ID_QUADRO_VAGAS_ESTAGIO'][0] . ",
			      " . $VO->ID_AGENCIA_ESTAGIO . ",
                              " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ",
                                SYSDATE,
                                SYSDATE,
                              " . $_SESSION['ID_USUARIO'] . ",
                              " . $_SESSION['ID_USUARIO'] . ",
                              " . $VO->CS_SITUACAO . ",    
                              '" . $VO->TX_CODIGO . "')";

        $retorno = $this->sql($query);
        if (!$retorno)
            return $CodigoPK['ID_QUADRO_VAGAS_ESTAGIO'][0];
    }

//-------------------------------alterar master---------------------------------
    function alterar($VO) {
        $query = "update QUADRO_VAGAS_ESTAGIO set
                                ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . ",
                                ID_AGENCIA_ESTAGIO = " . $VO->ID_AGENCIA_ESTAGIO . ",
                                ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ",
                                DT_CADASTRO = SYSDATE,
                                DT_ATUALIZACAO = SYSDATE,
                                ID_USUARIO_ATUALIZACAO =  " . $_SESSION['ID_USUARIO'] . ",
                                ID_USUARIO_CADASTRO =  " . $_SESSION['ID_USUARIO'] . ",
                                CS_SITUACAO = " . $VO->CS_SITUACAO . ",
                                TX_CODIGO = '" . $VO->TX_CODIGO . "'    

		 where
 		    ID_QUADRO_VAGAS_ESTAGIO = '" . $VO->ID_QUADRO_VAGAS_ESTAGIO . "'";
        print_r($query);
        return $this->sql($query);
    }

//---------------------------buscar MASTER -------------------------------------	
    function buscar($VO) {
        $query = " SELECT DISTINCT
                        V_PERFIL_USUARIO.ID_USUARIO CODIGO,
                        PESSOA.TX_NOME TX_FUNCIONARIO,
                        USUARIO.TX_LOGIN,
                        OGE.ID_ORGAO_GESTOR_ESTAGIO,
                        OGE.TX_ORGAO_GESTOR_ESTAGIO,
                        AG.ID_AGENCIA_ESTAGIO,
                        AG.TX_AGENCIA_ESTAGIO,
                        QVE.TX_CODIGO,
                        QVE.ID_QUADRO_VAGAS_ESTAGIO,
                        QVE.CS_SITUACAO,
                        TO_CHAR(QVE.DT_CADASTRO,'DD/MM/YYYY')DT_CADASTRO,
                        TO_CHAR(QVE.DT_ATUALIZACAO,'DD/MM/YYYY')DT_ATUALIZACAO,
                        DECODE(QVE.CS_SITUACAO, 1,'ATIVO', 2,'DESATIVADO')TX_SITUACAO
                   FROM QUADRO_VAGAS_ESTAGIO QVE,
                        AGENCIA_ESTAGIO AG,
                        ORGAO_GESTOR_ESTAGIO OGE,
                        USUARIO USUARIO_CADASTRADO,
                        USUARIO USUARIO_ATUALIZACAO,
                        V_PERFIL_USUARIO,
                        USUARIO,
                        PESSOA
                  WHERE QVE.ID_AGENCIA_ESTAGIO = AG.ID_AGENCIA_ESTAGIO
                        AND QVE.ID_ORGAO_GESTOR_ESTAGIO = OGE.ID_ORGAO_GESTOR_ESTAGIO
                        AND QVE.ID_ORGAO_GESTOR_ESTAGIO = OGE.ID_ORGAO_GESTOR_ESTAGIO
                        AND QVE.ID_USUARIO_CADASTRO = USUARIO_CADASTRADO.ID_USUARIO
                        AND QVE.ID_USUARIO_ATUALIZACAO = USUARIO_ATUALIZACAO.ID_USUARIO
                        AND V_PERFIL_USUARIO.ID_USUARIO = USUARIO.ID_USUARIO
                        AND USUARIO.ID_PESSOA_FUNCIONARIO = PESSOA.ID_PESSOA
                        AND USUARIO_ATUALIZACAO.ID_USUARIO = V_PERFIL_USUARIO.ID_USUARIO
                        AND QVE.ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . " ";
        //print_r($query);
        return $this->sqlVetor($query);
    }

//--------------------------------DETAIL----------------------------------------
//---------ORGÃO SOLICITANTE-----------------
    function orgao_Solicitante($VO) {
        $query = "SELECT ID_ORGAO_ESTAGIO,
                     ID_ORGAO_ESTAGIO CODIGO,
                     TX_ORGAO_ESTAGIO
                FROM ORGAO_ESTAGIO ";

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
    function inserirUnidade($VO) {
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
                  (" . $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'] . ", 
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
                    VE.DT_CADASTRO,
                    VE.DT_ATUALIZACAO,
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
              WHERE (VE.ID_ORGAO_ESTAGIO = OE.ID_ORGAO_ESTAGIO(+))
                AND (VE.CS_TIPO_VAGA_ESTAGIO = TVE.CS_TIPO_VAGA_ESTAGIO(+))
                AND (VE.ID_CURSO_ESTAGIO = CE.ID_CURSO_ESTAGIO(+))";

        if ($VO->ID_ORGAO_ESTAGIO) {
            $query .= " AND VE.ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . " ";
        }

        if ($VO->ID_CURSO_ESTAGIO) {
            $query .= " AND VE.ID_CURSO_ESTAGIO = " . $VO->ID_CURSO_ESTAGIO . " ";
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

//------------- PREENCHE O ALTERAR DO DETAIL -------------------------
    function buscarVagasEstagio($VO) {
        $query = "
        select ve.id_quadro_vagas_estagio,
                ve.id_orgao_estagio,
                ve.cs_tipo_vaga_estagio,
                ve.id_curso_estagio,
                ve.nb_quantidade,
                to_char(ve.dt_cadastro, 'dd/mm/YYYY') dt_cadastro,
                to_char(ve.dt_atualizacao, 'dd/mm/yyyy') dt_atualizacao,
                ve.id_usuario_cadastro,
                ve.id_usuario_atualizacao,
                p_cad.tx_nome tx_usuario_cadastro,
                p_alt.tx_nome tx_usuario_atualizacao
           from VAGAS_ESTAGIO ve,
                USUARIO u_cad,
                USUARIO u_alt,
                PESSOA p_cad,
                PESSOA p_alt
          where ve.id_usuario_cadastro = u_cad.id_usuario
                and ve.id_usuario_atualizacao = u_alt.id_usuario
                and u_cad.id_pessoa_funcionario = p_cad.id_pessoa
                and u_alt.id_pessoa_funcionario = p_alt.id_pessoa
              
        and ve.ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . "
         
        and ve.CS_TIPO_VAGA_ESTAGIO = " . $VO->CS_TIPO_VAGA_ESTAGIO . " ";
        // print_r($query);
        return $this->sqlVetor($query);
    }

//-------alterar da pesquisa detail---------------
    function alterarUnidade($VO) {
        $query = "update VAGAS_ESTAGIO set
                                ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . ",
                               
                                NB_QUANTIDADE = " . $VO->NB_QUANTIDADE . ",
                                
                                DT_CADASTRO = SYSDATE,
                                DT_ATUALIZACAO = SYSDATE,
                                ID_USUARIO_ATUALIZACAO =  " . $_SESSION['ID_USUARIO'] . ",
                                ID_USUARIO_CADASTRO =  " . $_SESSION['ID_USUARIO'] . ",
                                ID_CURSO_ESTAGIO = " . $VO->ID_CURSO_ESTAGIO . "     

		 where
 		    ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . "   
                    CS_TIPO_VAGA_ESTAGIO = " . $VO->CS_TIPO_VAGA_ESTAGIO . "    ";

        print_r($query);
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

    /* //-----atualiza não sei o que? --------------------
      function atualizarInf($VO) {
      $query = "update QUADRO_VAGAS_ESTAGIO set
      ID_AGENCIA_ESTAGIO = " . $VO->ID_AGENCIA_ESTAGIO . ",
      ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ",
      CS_SITUACAO = " . $VO->CS_SITUACAO . ",
      DT_ATULIZACAO = sysdate,
      id_usuario_atualizacao = " . $_SESSION['ID_USUARIO'] . "
      where
      ID_QUADRO_VAGAS_ESTAGIO =" . $VO->ID_QUADRO_VAGAS_ESTAGIO;

      $this->sql($query);

      $data = " SELECT USUARIO.TX_LOGIN TX_LOGIN_ATUALIZ,
      TO_CHAR(QUADRO_VAGAS_ESTAGIO.DT_ATUALIZACAO, 'DD/MM/YYYY HH24:MI:SS') AS DT_ATULIZACAO,
      QUADRO_VAGAS_ESTAGIO.ID_AGENCIA_ESTAGIO,
      QUADRO_VAGAS_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO,
      QUADRO_VAGAS_ESTAGIO.CS_SITUACAO
      FROM QUADRO_VAGAS_ESTAGIO,
      USUARIO
      WHERE USUARIO.ID_USUARIO = QUADRO_VAGAS_ESTAGIO.ID_USUARIO_ATUALIZACAO
      AND QUADRO_VAGAS_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO = '" . $VO->ID_QUADRO_VAGAS_ESTAGIO . "'";

      $this->sqlVetor($data);
      $datahora = $this->getVetor();

      return $datahora;
      } */
}

?>