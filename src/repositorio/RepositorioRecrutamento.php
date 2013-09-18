<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioRecrutamento extends Repositorio {

    function pesquisarOrgaoGestor($VO) {

        $query = "SELECT 
                    ID_ORGAO_GESTOR_ESTAGIO ,
                    ID_ORGAO_GESTOR_ESTAGIO CODIGO,
                    TX_ORGAO_GESTOR_ESTAGIO
                  FROM 
                    ORGAO_GESTOR_ESTAGIO";
        return $this->sqlVetor($query);
    }

    function buscarSolicitante($VO) {

        $query = "SELECT DISTINCT 
					  C.ID_ORGAO_ESTAGIO CODIGO,
					  C.TX_ORGAO_ESTAGIO
					FROM 
					  AGENTE_SETORIAL_ESTAGIO A ,
					  ORGAO_AGENTE_SETORIAL B,
					  ORGAO_ESTAGIO C,
					  SOLICITACAO_ESTAGIO D
					WHERE 
					  A.ID_SETORIAL_ESTAGIO = B.ID_SETORIAL_ESTAGIO
					  and C.ID_ORGAO_ESTAGIO = B.ID_ORGAO_ESTAGIO
					  AND D.ID_ORGAO_ESTAGIO = C.ID_ORGAO_ESTAGIO
					  AND D.ID_ORGAO_GESTOR_ESTAGIO = '" . $VO->ID_ORGAO_GESTOR_ESTAGIO . "'
					  AND A.ID_USUARIO = '" . $_SESSION['ID_USUARIO'] . "'";

        return $this->sqlVetor($query);
    }

    function buscarSolicitacao($VO) {

        $query = "select a.ID_SOLICITACAO_ESTAGIO codigo, a.TX_COD_SOLICITACAO 
					from SOLICITACAO_ESTAGIO a
					where a.ID_ORGAO_ESTAGIO = '" . $VO->ID_ORGAO_ESTAGIO . "'
					and a.CS_SITUACAO = 2
					and a.ID_SOLICITACAO_ESTAGIO not in (select id_solicitacao_estagio from RECRUTAMENTO_ESTAGIO where id_orgao_estagio = '" . $VO->ID_ORGAO_ESTAGIO . "')  
					ORDER BY TX_COD_SOLICITACAO";

        return $this->sqlVetor($query);
    }

    function buscarQuadroVagas($VO) {

        $query = "select a.ID_QUADRO_VAGAS_ESTAGIO CODIGO, B.TX_CODIGO 
					from SOLICITACAO_ESTAGIO a, QUADRO_VAGAS_ESTAGIO B
					where a.ID_QUADRO_VAGAS_ESTAGIO = B.ID_QUADRO_VAGAS_ESTAGIO
					AND A.ID_SOLICITACAO_ESTAGIO = '" . $VO->ID_SOLICITACAO_ESTAGIO . "'";

        return $this->sqlVetor($query);
    }

    function pesquisarRecrutamento($VO) {

        $query = "        SELECT RECRUTAMENTO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO, 
        QUADRO_VAGAS_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO,
        RECRUTAMENTO_ESTAGIO.ID_ORGAO_ESTAGIO,

       TO_CHAR(RECRUTAMENTO_ESTAGIO.DT_ATUALIZACAO,'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
       TO_CHAR(RECRUTAMENTO_ESTAGIO.DT_CADASTRO,'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,

       RECRUTAMENTO_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO,
       
       RECRUTAMENTO_ESTAGIO.ID_USUARIO_CADASTRO, RECRUTAMENTO_ESTAGIO.ID_USUARIO_ATUALIZACAO,
       
       
       RECRUTAMENTO_ESTAGIO.TX_DOC_AUTORIZACAO, RECRUTAMENTO_ESTAGIO.TX_MOTIVO, RECRUTAMENTO_ESTAGIO.TX_COD_RECRUTAMENTO,
       V_FUNCIONARIO_TOTAL1.TX_FUNCIONARIO CADASTRADOPOR,
       V_FUNCIONARIO_TOTAL2.TX_FUNCIONARIO ALTERADOPOR,
       
       ORGAO_ESTAGIO1.TX_ORGAO_ESTAGIO TX_ORGAO_SOLICITANTE, 
       
       ORGAO_ESTAGIO2.TX_ORGAO_ESTAGIO TX_ORGAO_GESTOR ,
       
       RECRUTAMENTO_ESTAGIO.CS_SITUACAO ,
       
        case
         when RECRUTAMENTO_ESTAGIO.CS_SITUACAO = '2' then 'Desativado' 
         when RECRUTAMENTO_ESTAGIO.CS_SITUACAO = '1' then 'Ativado'
        end 
        TX_SITUACAO,
        
        QUADRO_VAGAS_ESTAGIO.TX_CODIGO  TX_QUADRO_VAGAS


  FROM RECRUTAMENTO_ESTAGIO RECRUTAMENTO_ESTAGIO , 
  USUARIO USUARIO1, USUARIO USUARIO2,
  V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL1, V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL2, 
  ORGAO_ESTAGIO ORGAO_ESTAGIO1, ORGAO_ESTAGIO ORGAO_ESTAGIO2,
  QUADRO_VAGAS_ESTAGIO QUADRO_VAGAS_ESTAGIO
  
  WHERE 
  
    RECRUTAMENTO_ESTAGIO.ID_ORGAO_ESTAGIO = ORGAO_ESTAGIO1.ID_ORGAO_ESTAGIO

  AND 
    QUADRO_VAGAS_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO = ORGAO_ESTAGIO2.ID_ORGAO_ESTAGIO


  AND  
    RECRUTAMENTO_ESTAGIO.ID_USUARIO_CADASTRO     = USUARIO1.ID_USUARIO
  AND 
    RECRUTAMENTO_ESTAGIO.ID_USUARIO_ATUALIZACAO  = USUARIO2.ID_USUARIO
  AND 
    USUARIO1.ID_PESSOA_FUNCIONARIO  = V_FUNCIONARIO_TOTAL1.ID_PESSOA_FUNCIONARIO
  AND 
    USUARIO2.ID_PESSOA_FUNCIONARIO  = V_FUNCIONARIO_TOTAL2.ID_PESSOA_FUNCIONARIO
  AND 
    RECRUTAMENTO_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO =  QUADRO_VAGAS_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO
";


        return $this->sqlVetor($query);
    }

    function pesquisarEstagiario($VO) {

        $query = "select ID_PESSOA_ESTAGIARIO CODIGO, NB_CPF, TX_NOME 
					from V_ESTAGIARIO 
					where ID_PESSOA_ESTAGIARIO not in 
							(select ID_PESSOA_ESTAGIARIO from ESTAGIARIO_VAGA where ID_RECRUTAMENTO_ESTAGIO = '" . $VO->ID_RECRUTAMENTO_ESTAGIO . "' ) ";
        $VO->ID_PESSOA_ESTAGIARIO ? $query .= " and ID_PESSOA_ESTAGIARIO = '" . $VO->ID_PESSOA_ESTAGIARIO . "'" : false;

        return $this->sqlVetor($query);
    }

    function pesquisar($VO) {

        $query = "select a.ID_RECRUTAMENTO_ESTAGIO, a.TX_COD_RECRUTAMENTO, C.TX_ORGAO_GESTOR_ESTAGIO, D.TX_ORGAO_ESTAGIO, E.TX_CODIGO, 
						 a.TX_DOC_AUTORIZACAO, DECODE(a.CS_SITUACAO, 1, 'Aberto', 2, 'Fechado') TX_SITUACAO, B.TX_COD_SOLICITACAO
				from RECRUTAMENTO_ESTAGIO a, SOLICITACAO_ESTAGIO B, ORGAO_GESTOR_ESTAGIO C, ORGAO_ESTAGIO D, QUADRO_VAGAS_ESTAGIO E 
				where a.ID_SOLICITACAO_ESTAGIO = B.ID_SOLICITACAO_ESTAGIO
				and B.ID_ORGAO_GESTOR_ESTAGIO = C.ID_ORGAO_GESTOR_ESTAGIO
				and a.ID_ORGAO_ESTAGIO = D.ID_ORGAO_ESTAGIO
				and a.ID_QUADRO_VAGAS_ESTAGIO = E.ID_QUADRO_VAGAS_ESTAGIO";

        ($VO->ID_ORGAO_GESTOR_ESTAGIO) ? $query .= " AND b.ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_GESTOR_ESTAGIO : false;
        ($VO->ID_ORGAO_ESTAGIO) ? $query .= " AND a.ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO : false;
        ($VO->CS_SITUACAO) ? $query .= " AND a.CS_SITUACAO = " . $VO->CS_SITUACAO : false;
        ($VO->TX_COD_RECRUTAMENTO) ? $query .= " AND a.TX_COD_RECRUTAMENTO like '%" . $VO->TX_COD_RECRUTAMENTO . "%'" : false;

        $query .= " ORDER BY a.TX_COD_RECRUTAMENTO desc";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

    function inserir($VO) {

        $queryPK = "select SEMAD.F_G_PK_RECRUTAMENTO_ESTAGIO() as ID_RECRUTAMENTO_ESTAGIO from DUAL";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "
            INSERT INTO RECRUTAMENTO_ESTAGIO
            (ID_RECRUTAMENTO_ESTAGIO, DT_CADASTRO, DT_ATUALIZACAO, ID_QUADRO_VAGAS_ESTAGIO, ID_ORGAO_ESTAGIO, ID_USUARIO_CADASTRO, ID_USUARIO_ATUALIZACAO, TX_DOC_AUTORIZACAO, TX_MOTIVO, TX_COD_RECRUTAMENTO, CS_SITUACAO, ID_SOLICITACAO_ESTAGIO)
            VALUES
			(" . $CodigoPK['ID_RECRUTAMENTO_ESTAGIO'][0]
                . ", SYSDATE, SYSDATE"
                . ", '" . $VO->ID_QUADRO_VAGAS_ESTAGIO . "' "
                . ", '" . $VO->ID_ORGAO_ESTAGIO . "' "
                . ", '" . $_SESSION['ID_USUARIO'] . "' "
                . ", '" . $_SESSION['ID_USUARIO'] . "' "
                . ", '" . $VO->TX_DOC_AUTORIZACAO . "' "
                . ", '" . $VO->TX_MOTIVO . "' "
                . ", SEMAD.F_G_COD_RECRUTAMENTO_ESTAGIO() "
                . ", '1' "
                . ", '" . $VO->ID_SOLICITACAO_ESTAGIO . "' ) ";

        $retorno = $this->sql($query);
        return $retorno ? '' : $CodigoPK['ID_RECRUTAMENTO_ESTAGIO'][0];
    }

    function buscar($VO) {

        $query = "select a.ID_RECRUTAMENTO_ESTAGIO, a.TX_COD_RECRUTAMENTO, C.ID_ORGAO_GESTOR_ESTAGIO, C.TX_ORGAO_GESTOR_ESTAGIO, D.ID_ORGAO_ESTAGIO, 
					   D.TX_ORGAO_ESTAGIO, E.TX_CODIGO, a.TX_DOC_AUTORIZACAO, a.CS_SITUACAO, DECODE(a.CS_SITUACAO, 1, 'Aberto', 2, 'Fechado') TX_SITUACAO, a.TX_MOTIVO, b.tx_cod_solicitacao,
					   TO_CHAR(a.DT_CADASTRO,'DD/MM/YYYY HH24:MI:SS')DT_CADASTRO, TO_CHAR(a.DT_ATUALIZACAO,'DD/MM/YYYY HH24:MI:SS')DT_ATUALIZACAO,
					   FUNCIONARIO_CADASTRO.TX_FUNCIONARIO TX_FUNCIONARIO_CADASTRO, FUNCIONARIO_ATUALIZACAO.TX_FUNCIONARIO TX_FUNCIONARIO_ATUALIZACAO
				from RECRUTAMENTO_ESTAGIO a, SOLICITACAO_ESTAGIO B, ORGAO_GESTOR_ESTAGIO C, ORGAO_ESTAGIO D, QUADRO_VAGAS_ESTAGIO E, USUARIO USUARIO_CADASTRADO, 
					  USUARIO USUARIO_ATUALIZACAO, V_FUNCIONARIO_TOTAL FUNCIONARIO_CADASTRO, V_FUNCIONARIO_TOTAL FUNCIONARIO_ATUALIZACAO
				where a.ID_SOLICITACAO_ESTAGIO = B.ID_SOLICITACAO_ESTAGIO
				and B.ID_ORGAO_GESTOR_ESTAGIO = C.ID_ORGAO_GESTOR_ESTAGIO
				and a.ID_ORGAO_ESTAGIO = D.ID_ORGAO_ESTAGIO
				and a.ID_QUADRO_VAGAS_ESTAGIO = E.ID_QUADRO_VAGAS_ESTAGIO
				AND a.ID_USUARIO_CADASTRO = USUARIO_CADASTRADO.ID_USUARIO
				and a.ID_USUARIO_ATUALIZACAO = USUARIO_ATUALIZACAO.ID_USUARIO
				and USUARIO_CADASTRADO.ID_PESSOA_FUNCIONARIO = FUNCIONARIO_CADASTRO.ID_PESSOA_FUNCIONARIO
				AND USUARIO_ATUALIZACAO.ID_PESSOA_FUNCIONARIO = FUNCIONARIO_ATUALIZACAO.ID_PESSOA_FUNCIONARIO
				and USUARIO_CADASTRADO.ID_UNIDADE_GESTORA = FUNCIONARIO_CADASTRO.ID_UNIDADE_GESTORA
				AND USUARIO_ATUALIZACAO.ID_UNIDADE_GESTORA = FUNCIONARIO_ATUALIZACAO.ID_UNIDADE_GESTORA
				and a.ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO;

        return $this->sqlVetor($query);
    }

    function buscarVaga($VO) {

        $query = "select a.ID_RECRUTAMENTO_ESTAGIO, a.NB_VAGAS_RECRUTAMENTO, G.TX_ORGAO_GESTOR_ESTAGIO, F.TX_ORGAO_ESTAGIO, D.TX_CODIGO, E.TX_TIPO_VAGA_ESTAGIO, a.NB_QUANTIDADE 
					from VAGAS_RECRUTAMENTO a, RECRUTAMENTO_ESTAGIO B, SOLICITACAO_ESTAGIO c, QUADRO_VAGAS_ESTAGIO d, TIPO_VAGA_ESTAGIO e, ORGAO_ESTAGIO f, ORGAO_GESTOR_ESTAGIO g
					where a.ID_RECRUTAMENTO_ESTAGIO = B.ID_RECRUTAMENTO_ESTAGIO
					and B.ID_SOLICITACAO_ESTAGIO = C.ID_SOLICITACAO_ESTAGIO
					and a.ID_QUADRO_VAGAS_ESTAGIO = D.ID_QUADRO_VAGAS_ESTAGIO
					and a.CS_TIPO_VAGA_ESTAGIO = E.CS_TIPO_VAGA_ESTAGIO
					and B.ID_ORGAO_ESTAGIO = F.ID_ORGAO_ESTAGIO
					and C.ID_ORGAO_GESTOR_ESTAGIO = G.ID_ORGAO_GESTOR_ESTAGIO
					and a.ID_RECRUTAMENTO_ESTAGIO = '" . $VO->ID_RECRUTAMENTO_ESTAGIO . "' ";

        $VO->NB_VAGAS_RECRUTAMENTO ? $query .= " and a.NB_VAGAS_RECRUTAMENTO = '" . $VO->NB_VAGAS_RECRUTAMENTO . "'" : false;

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

    function buscarCandidato($VO) {

        $query = "
		   select 
        ESTAGIARIO_VAGA.ID_RECRUTAMENTO_ESTAGIO, ESTAGIARIO_VAGA.NB_VAGAS_RECRUTAMENTO, ESTAGIARIO_VAGA.NB_CANDIDATO, 
        ESTAGIARIO_VAGA.CS_SITUACAO, ESTAGIARIO_VAGA.TX_MOTIVO_SITUACAO, ESTAGIARIO_VAGA.ID_PESSOA_ESTAGIARIO, 
        case
         when ESTAGIARIO_VAGA.CS_SITUACAO = '1' then 'Em Análise' 
         when ESTAGIARIO_VAGA.CS_SITUACAO = '2' then 'Aprovado'
         when ESTAGIARIO_VAGA.CS_SITUACAO = '3' then 'Reprovado' 
         when ESTAGIARIO_VAGA.CS_SITUACAO = '4' then 'Cancelado'
        end 
        TX_SITUACAO,
        V_ESTAGIARIO.TX_NOME, V_ESTAGIARIO.NB_CPF

 from ESTAGIARIO_VAGA ESTAGIARIO_VAGA,  VAGAS_RECRUTAMENTO VAGAS_RECRUTAMENTO ,  V_ESTAGIARIO V_ESTAGIARIO

 where
      ESTAGIARIO_VAGA.ID_RECRUTAMENTO_ESTAGIO =  VAGAS_RECRUTAMENTO.ID_RECRUTAMENTO_ESTAGIO
      
AND 
      ESTAGIARIO_VAGA.NB_VAGAS_RECRUTAMENTO   =  VAGAS_RECRUTAMENTO.NB_VAGAS_RECRUTAMENTO
      
AND  
     ESTAGIARIO_VAGA.ID_PESSOA_ESTAGIARIO =  V_ESTAGIARIO.ID_PESSOA_ESTAGIARIO
	  
AND	  
      ESTAGIARIO_VAGA.ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO . "
AND	  
      ESTAGIARIO_VAGA.NB_VAGAS_RECRUTAMENTO = " . $VO->NB_VAGAS_RECRUTAMENTO;

        return $this->sqlVetor($query);
    }

    function pesquisarTipoVagaEstagio($VO) {

        $query = "select B.ID_QUADRO_VAGAS_ESTAGIO, B.ID_ORGAO_ESTAGIO, B.CS_TIPO_VAGA_ESTAGIO, B.NB_QUANTIDADE, B.ID_QUADRO_VAGAS_ESTAGIO||'_'||B.ID_ORGAO_ESTAGIO||'_'||B.CS_TIPO_VAGA_ESTAGIO||'_'||B.NB_QUANTIDADE CODIGO, C.TX_TIPO_VAGA_ESTAGIO
					from RECRUTAMENTO_ESTAGIO a, VAGAS_SOLICITACAO B, TIPO_VAGA_ESTAGIO C
					where a.ID_SOLICITACAO_ESTAGIO = B.ID_SOLICITACAO_ESTAGIO
					AND a.ID_QUADRO_VAGAS_ESTAGIO = B.ID_QUADRO_VAGAS_ESTAGIO
					and a.ID_ORGAO_ESTAGIO = B.ID_ORGAO_ESTAGIO
					and B.CS_TIPO_VAGA_ESTAGIO = C.CS_TIPO_VAGA_ESTAGIO
          			and B.ID_QUADRO_VAGAS_ESTAGIO||'_'||B.ID_ORGAO_ESTAGIO||'_'||B.CS_TIPO_VAGA_ESTAGIO not in 
		  					(select ID_QUADRO_VAGAS_ESTAGIO||'_'||ID_ORGAO_ESTAGIO||'_'||CS_TIPO_VAGA_ESTAGIO from VAGAS_RECRUTAMENTO where ID_RECRUTAMENTO_ESTAGIO = '" . $VO->ID_RECRUTAMENTO_ESTAGIO . "')
					and a.ID_RECRUTAMENTO_ESTAGIO = '" . $VO->ID_RECRUTAMENTO_ESTAGIO . "' order by C.TX_TIPO_VAGA_ESTAGIO";

        return $this->sqlVetor($query);
    }

    function inserirVaga($VO) {

        $query = "
			  INSERT INTO VAGAS_RECRUTAMENTO(ID_QUADRO_VAGAS_ESTAGIO, NB_QUANTIDADE, ID_RECRUTAMENTO_ESTAGIO, NB_VAGAS_RECRUTAMENTO, ID_ORGAO_ESTAGIO, CS_TIPO_VAGA_ESTAGIO )
					values ('" . $VO->ID_QUADRO_VAGAS_ESTAGIO . "', '"
                . $VO->NB_QUANTIDADE . "', '"
                . $VO->ID_RECRUTAMENTO_ESTAGIO . "', "
                . "SEMAD.F_G_PK_VAGAS_RECRUTAMENTO('" . $VO->ID_RECRUTAMENTO_ESTAGIO . "'), '"
                . $VO->ID_ORGAO_ESTAGIO . "', '"
                . $VO->CS_TIPO_VAGA_ESTAGIO . "')";

        return $this->sql($query);
    }

    function atualizarInf($VO) {

        $query = "update RECRUTAMENTO_ESTAGIO set
		  DT_ATUALIZACAO = sysdate,
		  id_usuario_atualizacao = " . $_SESSION['ID_USUARIO'] . "
		  where ID_RECRUTAMENTO_ESTAGIO =" . $VO->ID_RECRUTAMENTO_ESTAGIO;

        $this->sql($query);

        $data = "select TO_CHAR(a.DT_ATUALIZACAO, 'DD/MM/YYYY hh24:mi:ss') DT_ATUALIZACAO, c.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL
               from RECRUTAMENTO_ESTAGIO a, USUARIO b, V_FUNCIONARIO_USUARIO c
              where a.ID_RECRUTAMENTO_ESTAGIO = '" . $VO->ID_RECRUTAMENTO_ESTAGIO . "'
                and a.ID_USUARIO_ATUALIZACAO = b.ID_USUARIO
                and b.ID_PESSOA_FUNCIONARIO = c.ID_PESSOA_FUNCIONARIO
                and b.ID_UNIDADE_GESTORA = c.ID_UNIDADE_GESTORA";

        $this->sqlVetor($data);
        $datahora = $this->getVetor();

        return $datahora;
    }

    function excluirVaga($VO) {

        $query = "
		  delete from  VAGAS_RECRUTAMENTO
		  	where ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO . "
		  	and NB_VAGAS_RECRUTAMENTO     = " . $VO->NB_VAGAS_RECRUTAMENTO;

        return $this->sql($query);
    }

    function excluirCandidato($VO) {

        $query = "
      delete from  ESTAGIARIO_VAGA
		  where ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO . "
		  and NB_VAGAS_RECRUTAMENTO     = " . $VO->NB_VAGAS_RECRUTAMENTO . "
		  and NB_CANDIDATO              = " . $VO->NB_CANDIDATO;

        return $this->sql($query);
    }

    function alterar($VO) {

        $query = "update RECRUTAMENTO_ESTAGIO set
				  DT_ATUALIZACAO = SYSDATE ,
				  ID_USUARIO_ATUALIZACAO =" . $_SESSION['ID_USUARIO'] . ",
				  CS_SITUACAO     		 ='" . $VO->CS_SITUACAO . "',
				  TX_DOC_AUTORIZACAO     ='" . $VO->TX_DOC_AUTORIZACAO . "',
				  TX_MOTIVO              ='" . $VO->TX_MOTIVO . "'
			 	 where ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO;
        return $this->sql($query);
    }

    function alterarVaga($VO) {

        $query = "update VAGAS_RECRUTAMENTO set NB_QUANTIDADE = '" . $VO->NB_QUANTIDADE . "'  
					 where ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO . "
					 and NB_VAGAS_RECRUTAMENTO     = " . $VO->NB_VAGAS_RECRUTAMENTO;

        return $this->sql($query);
    }

    function efetivar($VO) {
        $query = "update RECRUTAMENTO_ESTAGIO set CS_SITUACAO = 2 where ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO;

        return $this->sql($query);
    }

    function excluir($VO) {

        $query = " delete from RECRUTAMENTO_ESTAGIO where ID_RECRUTAMENTO_ESTAGIO = '" . $VO->ID_RECRUTAMENTO_ESTAGIO . "'";
        return $this->sql($query);
    }

    function inserirCandidato($VO) {

        $query = " INSERT INTO ESTAGIARIO_VAGA(ID_RECRUTAMENTO_ESTAGIO, NB_VAGAS_RECRUTAMENTO, NB_CANDIDATO, CS_SITUACAO ,  ID_PESSOA_ESTAGIARIO )
      			values ("
                . $VO->ID_RECRUTAMENTO_ESTAGIO . ", "
                . $VO->NB_VAGAS_RECRUTAMENTO . ", "
                . "SEMAD.F_G_PK_ESTAGIARIO_VAGA(" . $VO->ID_RECRUTAMENTO_ESTAGIO . ", " . $VO->NB_VAGAS_RECRUTAMENTO . " ), "
                . "1, "
                . $VO->ID_PESSOA_ESTAGIARIO . ") ";

        return $this->sql($query);
    }

    function verificarSelecao($VO) {
        $query = "select ID_SELECAO_ESTAGIO from SELECAO_ESTAGIO where ID_RECRUTAMENTO_ESTAGIO = '" . $VO->ID_RECRUTAMENTO_ESTAGIO . "' and CS_SITUACAO = 2";

        return $this->sqlVetor($query);
    }

    /*
     * 
     * funções para relatorio 
     * 
     */

    function buscarOrgaoSolicitanteRel($VO) {

        // Função que pega todos os Orgãos Solicitantes a qual o Usuario pertence
        // Utilizada na Index chamada pelo arrays.php
        $query = "SELECT DISTINCT 
                    C.ID_ORGAO_ESTAGIO ||'_'|| V_UNIDADE_ORG.NB_COD_UNIDADE CODIGO,
                    C.TX_ORGAO_ESTAGIO,
                    C.ID_ORGAO_ESTAGIO,
                    V_UNIDADE_ORG.NB_COD_UNIDADE,
                    C.ID_UNIDADE_ORG
                    
                  FROM 
                    AGENTE_SETORIAL_ESTAGIO A ,
                    ORGAO_AGENTE_SETORIAL B,
                    ORGAO_ESTAGIO C,
                    V_Unidade_org 
                  WHERE 
                    A.ID_SETORIAL_ESTAGIO = B.ID_SETORIAL_ESTAGIO
                    AND C.ID_ORGAO_ESTAGIO = B.ID_ORGAO_ESTAGIO
                    and V_UNidade_org.ID_UNIDADE_ORG =C.ID_UNIDADE_ORG
                    AND A.ID_USUARIO=" . $_SESSION['ID_USUARIO'];

        return $this->sqlVetor($query);
    }


    function buscarRecrutamentoRel($VO) {

        $query = "SELECT 
                        ID_RECRUTAMENTO_ESTAGIO codigo,
                        ID_RECRUTAMENTO_ESTAGIO,
                        TX_COD_RECRUTAMENTO
                  FROM
                        RECRUTAMENTO_ESTAGIO
                  WHERE ID_ORGAO_ESTAGIO = '" . $VO->ID_ORGAO_ESTAGIO . "'
                    AND CS_SITUACAO      = '" . $VO->CS_SITUACAO . "'";
        return $this->sqlVetor($query);
    }
    function buscarDadosPdf(){
        $query ="";
        return $this->sqlVetor($query);
        
    }
    /*
     * 
     * Fim funções para relatorio 
     * 
     */
}

?>