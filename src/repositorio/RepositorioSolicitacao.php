<?php
require_once $path . "src/repositorio/Repositorio.php";

class RepositorioSolicitacao extends Repositorio {

    function pesquisarOrgaoGestor($VO) {
        $query = "
            select oge.ID_ORGAO_GESTOR_ESTAGIO CODIGO,
                    oge.TX_ORGAO_GESTOR_ESTAGIO
               from ORGAO_GESTOR_ESTAGIO oge
             order by TX_ORGAO_GESTOR_ESTAGIO
        ";

        return $this->sqlVetor($query);
    }

    function pesquisarOrgaoSolicitante($VO) {
        $query = "
            select distinct
                    oe.ID_ORGAO_ESTAGIO CODIGO,
                    oe.TX_ORGAO_ESTAGIO
               from AGENTE_SETORIAL_ESTAGIO ase,
                    ORGAO_AGENTE_SETORIAL oas,
                    ORGAO_ESTAGIO oe
              where (ase.ID_SETORIAL_ESTAGIO = oas.ID_SETORIAL_ESTAGIO)
                and (oe.ID_ORGAO_ESTAGIO = oas.ID_ORGAO_ESTAGIO)
                and (ase.ID_USUARIO = " . $_SESSION['ID_USUARIO'] . ")
             order by oe.TX_ORGAO_ESTAGIO
        ";

        return $this->sqlVetor($query);
    }


    function buscarQuadroVagasEstagio($VO) {
        $query = "
            select distinct a.ID_QUADRO_VAGAS_ESTAGIO CODIGO, B.TX_CODIGO
				from VAGAS_ESTAGIO a, QUADRO_VAGAS_ESTAGIO B
				where a.ID_QUADRO_VAGAS_ESTAGIO = B.ID_QUADRO_VAGAS_ESTAGIO
				and B.ID_AGENCIA_ESTAGIO = '".$VO->ID_AGENCIA_ESTAGIO."'
				and a.ID_ORGAO_ESTAGIO = '".$VO->ID_ORGAO_ESTAGIO."'
				and B.CS_SITUACAO = 1
				order by B.TX_CODIGO
        ";

        return $this->sqlVetor($query);
    }
	
	function buscarAgenciaEstagio($VO) {
        $query = "
            select distinct C.ID_AGENCIA_ESTAGIO CODIGO, C.TX_AGENCIA_ESTAGIO from VAGAS_ESTAGIO a, QUADRO_VAGAS_ESTAGIO B, AGENCIA_ESTAGIO C
				where a.ID_QUADRO_VAGAS_ESTAGIO = B.ID_QUADRO_VAGAS_ESTAGIO
				and B.ID_AGENCIA_ESTAGIO = C.ID_AGENCIA_ESTAGIO
				and a.ID_ORGAO_ESTAGIO = '".$VO->ID_ORGAO_ESTAGIO."'
				and B.CS_SITUACAO = 1
				ORDER BY C.TX_AGENCIA_ESTAGIO
        ";

        return $this->sqlVetor($query);
    }

	

    function pesquisar($VO) {
        $query = "
            select se.ID_SOLICITACAO_ESTAGIO,
                    se.TX_COD_SOLICITACAO,
                    se.ID_ORGAO_ESTAGIO,
                    se.ID_ORGAO_GESTOR_ESTAGIO,
                    se.ID_AGENCIA_ESTAGIO,
                    se.CS_SITUACAO,
                    oe.TX_ORGAO_ESTAGIO,
                    oge.TX_ORGAO_GESTOR_ESTAGIO,
                    ae.TX_AGENCIA_ESTAGIO
               from SOLICITACAO_ESTAGIO se,
                    ORGAO_ESTAGIO oe,
                    ORGAO_GESTOR_ESTAGIO oge,
                    AGENCIA_ESTAGIO ae
              where (se.ID_ORGAO_ESTAGIO = oe.ID_ORGAO_ESTAGIO)
                and (se.ID_ORGAO_GESTOR_ESTAGIO = oge.ID_ORGAO_GESTOR_ESTAGIO)
                and (se.ID_AGENCIA_ESTAGIO = ae.ID_AGENCIA_ESTAGIO(+)) ";

        ($VO->ID_ORGAO_ESTAGIO) ? $query .= " and (se.ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . ") " : false;
        ($VO->ID_ORGAO_GESTOR_ESTAGIO) ? $query .= " and (se.ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ") " : false;
        ($VO->ID_AGENCIA_ESTAGIO) ? $query .= " and (se.ID_AGENCIA_ESTAGIO = " . $VO->ID_AGENCIA_ESTAGIO . ") " : false;
        ($VO->CS_SITUACAO) ? $query .= " and (se.CS_SITUACAO = " . $VO->CS_SITUACAO . ") " : false;
        ($VO->TX_COD_SOLICITACAO) ? $query .= " and (se.TX_COD_SOLICITACAO like '%" . $VO->TX_COD_SOLICITACAO . "%') " : false;

        $query .= "
              order by se.DT_CADASTRO desc";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

    function inserir($VO) {
        $queryPK = "select SEMAD.F_G_PK_SOLICITACAO_ESTAGIO as ID_SOLICITACAO_ESTAGIO from dual";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "
            insert
                into SOLICITACAO_ESTAGIO
                (ID_SOLICITACAO_ESTAGIO, DT_CADASTRO, DT_ATUALIZACAO, TX_COD_SOLICITACAO, ID_USUARIO_ATUALIZACAO, ID_USUARIO_CADASTRO,
                 ID_ORGAO_ESTAGIO, ID_ORGAO_GESTOR_ESTAGIO, TX_JUSTIFICATIVA, CS_SITUACAO, ID_QUADRO_VAGAS_ESTAGIO, ID_AGENCIA_ESTAGIO)
                values
                (" . $CodigoPK['ID_SOLICITACAO_ESTAGIO'][0] . ",
                 SYSDATE,
                 SYSDATE,
                 SEMAD.F_G_COD_SOLICITACAO_ESTAGIO(),
                 " . $_SESSION['ID_USUARIO'] . ",
                 " . $_SESSION['ID_USUARIO'] . ",
                 " . $VO->ID_ORGAO_ESTAGIO . ",
                 " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ",
                 '" . $VO->TX_JUSTIFICATIVA . "',
                 '1',
                 " . $VO->ID_QUADRO_VAGAS_ESTAGIO . ",
                 " . $VO->ID_AGENCIA_ESTAGIO . ")";

        $retorno = $this->sql($query);

        if (!$retorno) {
            return $CodigoPK['ID_SOLICITACAO_ESTAGIO'][0];
        }
    }

    function buscar($VO) {
        $query = "
            select se.ID_SOLICITACAO_ESTAGIO, se.ID_ORGAO_GESTOR_ESTAGIO, se.ID_AGENCIA_ESTAGIO, se.ID_ORGAO_ESTAGIO, se.CS_SITUACAO, se.ID_QUADRO_VAGAS_ESTAGIO,
                    se.TX_COD_SOLICITACAO, se.TX_JUSTIFICATIVA,
                    to_char(se.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,
                    to_char(se.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
                    se.ID_USUARIO_CADASTRO, se.ID_USUARIO_ATUALIZACAO,
                    oge.TX_ORGAO_GESTOR_ESTAGIO, ae.TX_AGENCIA_ESTAGIO, oe.TX_ORGAO_ESTAGIO, qve.TX_CODIGO,
                    vft_cad.TX_FUNCIONARIO TX_FUNCIONARIO_CAD, vft_atual.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL
               from SOLICITACAO_ESTAGIO se,
                    ORGAO_GESTOR_ESTAGIO oge,
                    AGENCIA_ESTAGIO ae,
                    ORGAO_ESTAGIO oe,
                    QUADRO_VAGAS_ESTAGIO qve,
                    USUARIO u_cad,
                    USUARIO u_atual,
                    V_FUNCIONARIO_TOTAL vft_cad,
                    V_FUNCIONARIO_TOTAL vft_atual
              where se.ID_ORGAO_GESTOR_ESTAGIO = oge.ID_ORGAO_GESTOR_ESTAGIO
                    and se.ID_AGENCIA_ESTAGIO = ae.ID_AGENCIA_ESTAGIO(+)
                    and se.ID_ORGAO_ESTAGIO = oe.ID_ORGAO_ESTAGIO
                    and se.ID_QUADRO_VAGAS_ESTAGIO = qve.ID_QUADRO_VAGAS_ESTAGIO
                    and se.ID_USUARIO_CADASTRO = u_cad.ID_USUARIO
                    and se.ID_USUARIO_ATUALIZACAO = u_atual.ID_USUARIO
                    and u_cad.ID_PESSOA_FUNCIONARIO = vft_cad.ID_PESSOA_FUNCIONARIO
                    and u_atual.ID_PESSOA_FUNCIONARIO = vft_atual.ID_PESSOA_FUNCIONARIO
                and se.ID_SOLICITACAO_ESTAGIO = " . $VO->ID_SOLICITACAO_ESTAGIO;

        return $this->sqlVetor($query);
    }

    function alterar($VO) {
        
		$query = "update SOLICITACAO_ESTAGIO
					set DT_ATUALIZACAO = SYSDATE,
						ID_USUARIO_ATUALIZACAO = " . $_SESSION['ID_USUARIO'] . ",
						TX_JUSTIFICATIVA = '" . $VO->TX_JUSTIFICATIVA . "' ";		
		$VO->CS_SITUACAO ? $query .= " ,CS_SITUACAO = '" . $VO->CS_SITUACAO . "' " : false;
        $query .= " where ID_SOLICITACAO_ESTAGIO = " . $VO->ID_SOLICITACAO_ESTAGIO;

        return $this->sql($query);
    }

    function excluir($VO) {
        $query = "
            delete
               from SOLICITACAO_ESTAGIO
              where ID_SOLICITACAO_ESTAGIO = " . $VO->ID_SOLICITACAO_ESTAGIO;

        return $this->sql($query);
    }

    function pesquisarTipoVaga($VO) {
        $query = "
            select C.CS_TIPO_VAGA_ESTAGIO codigo, C.TX_TIPO_VAGA_ESTAGIO  
				from QUADRO_VAGAS_ESTAGIO a, VAGAS_ESTAGIO B, TIPO_VAGA_ESTAGIO C
				where a.ID_QUADRO_VAGAS_ESTAGIO = B.ID_QUADRO_VAGAS_ESTAGIO
				and B.CS_TIPO_VAGA_ESTAGIO = C.CS_TIPO_VAGA_ESTAGIO
				and B.ID_QUADRO_VAGAS_ESTAGIO = '".$VO->ID_QUADRO_VAGAS_ESTAGIO."'
				and B.ID_ORGAO_ESTAGIO = '".$VO->ID_ORGAO_ESTAGIO."'
				and a.CS_SITUACAO = 1
				and B.CS_TIPO_VAGA_ESTAGIO not in (select cs_tipo_vaga_estagio 
													from VAGAS_SOLICITACAO 
													  where ID_SOLICITACAO_ESTAGIO = '".$VO->ID_SOLICITACAO_ESTAGIO."'
													  and ID_QUADRO_VAGAS_ESTAGIO = '".$VO->ID_QUADRO_VAGAS_ESTAGIO."'
													  and ID_ORGAO_ESTAGIO = '".$VO->ID_ORGAO_ESTAGIO."')";

        return $this->sqlVetor($query);
    }

    function buscarQuantidade($VO) {
        $query = "
            select NB_QUANTIDADE
               from VAGAS_ESTAGIO
              where ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . "
                and ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . "
                and CS_TIPO_VAGA_ESTAGIO = " . $VO->CS_TIPO_VAGA_ESTAGIO . "
        ";

        return $this->sqlVetor($query);
    }

    function buscarCursos($VO) {
        $query = "
            select ID_CURSO_ESTAGIO CODIGO, TX_CURSO_ESTAGIO
               from CURSO_ESTAGIO
              order by TX_CURSO_ESTAGIO
        ";

        return $this->sqlVetor($query);
    }

    function pesquisarVagasSolicitadas($VO) {
        $query = "
            select vs.ID_SOLICITACAO_ESTAGIO,
                    vs.ID_ORGAO_ESTAGIO,
                    vs.ID_QUADRO_VAGAS_ESTAGIO,
                    vs.CS_TIPO_VAGA_ESTAGIO,
                    vs.ID_CURSO_ESTAGIO,
                    vs.NB_QUANTIDADE,
                    oe.TX_ORGAO_ESTAGIO,
                    ae.TX_AGENCIA_ESTAGIO,
                    tve.TX_TIPO_VAGA_ESTAGIO,
                    ce.TX_CURSO_ESTAGIO
               from VAGAS_SOLICITACAO vs,
                    QUADRO_VAGAS_ESTAGIO qve,
                    AGENCIA_ESTAGIO ae,
                    ORGAO_ESTAGIO oe,
                    TIPO_VAGA_ESTAGIO tve,
                    CURSO_ESTAGIO ce
              where (vs.ID_ORGAO_ESTAGIO = oe.ID_ORGAO_ESTAGIO)
                    and (vs.ID_QUADRO_VAGAS_ESTAGIO = qve.ID_QUADRO_VAGAS_ESTAGIO)
                    and (qve.ID_AGENCIA_ESTAGIO = ae.ID_AGENCIA_ESTAGIO)
                    and (vs.CS_TIPO_VAGA_ESTAGIO = tve.CS_TIPO_VAGA_ESTAGIO)
                    and (vs.ID_CURSO_ESTAGIO = ce.ID_CURSO_ESTAGIO(+))
                    and (vs.ID_SOLICITACAO_ESTAGIO = " . $VO->ID_SOLICITACAO_ESTAGIO . ")
                    and (vs.ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . ")
                    and (vs.ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . ")
              order by oe.TX_ORGAO_ESTAGIO,
                    ae.TX_AGENCIA_ESTAGIO
        ";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

    function inserirVagasSolicitadas($VO) {
        $query = "
            INSERT
                INTO VAGAS_SOLICITACAO
                (ID_SOLICITACAO_ESTAGIO, ID_ORGAO_ESTAGIO, ID_QUADRO_VAGAS_ESTAGIO, CS_TIPO_VAGA_ESTAGIO, ID_CURSO_ESTAGIO, NB_QUANTIDADE,
                 DT_CADASTRO, DT_ATUALIZACAO, ID_USUARIO_CADASTRO, ID_USUARIO_ATUALIZACAO)
                values
                (" . $VO->ID_SOLICITACAO_ESTAGIO . ",
                 " . $VO->ID_ORGAO_ESTAGIO . ",
                 " . $VO->ID_QUADRO_VAGAS_ESTAGIO . ",
                 '" . $VO->CS_TIPO_VAGA_ESTAGIO . "',
                 '" . $VO->ID_CURSO_ESTAGIO . "',
                 '" . $VO->NB_QUANTIDADE . "',
                 SYSDATE,
                 SYSDATE,
                 " . $_SESSION['ID_USUARIO'] . ",
                 " . $_SESSION['ID_USUARIO'] . ")
        ";

        return $this->sql($query);
    }

    function excluirVagasSolicitadas($VO) {
        $query = "
            delete
               from VAGAS_SOLICITACAO
              where (ID_SOLICITACAO_ESTAGIO 	= " . $VO->ID_SOLICITACAO_ESTAGIO . ")
                and (ID_ORGAO_ESTAGIO 			= " . $VO->ID_ORGAO_ESTAGIO . ")
                and (ID_QUADRO_VAGAS_ESTAGIO 	= " . $VO->ID_QUADRO_VAGAS_ESTAGIO . ")
                and (CS_TIPO_VAGA_ESTAGIO 		= " . $VO->CS_TIPO_VAGA_ESTAGIO . ")";

        return $this->sql($query);
    }

    function buscarVagasSolicitadas($VO) {
        $query = "
            select vs.ID_SOLICITACAO_ESTAGIO,
                    vs.ID_ORGAO_ESTAGIO,
                    vs.ID_QUADRO_VAGAS_ESTAGIO,
                    vs.CS_TIPO_VAGA_ESTAGIO,
                    vs.ID_CURSO_ESTAGIO,
                    vs.NB_QUANTIDADE,
                    tve.TX_TIPO_VAGA_ESTAGIO,
                    ce.TX_CURSO_ESTAGIO,
                    to_char(vs.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,
                    to_char(vs.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
                    vs.ID_USUARIO_CADASTRO,
                    vs.ID_USUARIO_ATUALIZACAO,
                    vft_cad.TX_FUNCIONARIO TX_FUNCIONARIO_CAD,
                    vft_atual.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL
               from VAGAS_SOLICITACAO vs,
                    TIPO_VAGA_ESTAGIO tve,
                    CURSO_ESTAGIO ce,
                    USUARIO u_cad,
                    USUARIO u_atual,
                    V_FUNCIONARIO_TOTAL vft_cad,
                    V_FUNCIONARIO_TOTAL vft_atual
              where (vs.CS_TIPO_VAGA_ESTAGIO = tve.CS_TIPO_VAGA_ESTAGIO)
                    and (vs.ID_CURSO_ESTAGIO = ce.ID_CURSO_ESTAGIO(+))
                    and (vs.ID_USUARIO_CADASTRO = u_cad.ID_USUARIO)
                    and (vs.ID_USUARIO_ATUALIZACAO = u_atual.ID_USUARIO)
                    and (u_cad.ID_PESSOA_FUNCIONARIO = vft_cad.ID_PESSOA_FUNCIONARIO)
                    and (u_cad.ID_UNIDADE_GESTORA = vft_cad.ID_UNIDADE_GESTORA)
                    and (u_atual.ID_PESSOA_FUNCIONARIO = vft_atual.ID_PESSOA_FUNCIONARIO)
                    and (u_atual.ID_UNIDADE_GESTORA = vft_atual.ID_UNIDADE_GESTORA)
                    and (vs.ID_SOLICITACAO_ESTAGIO = " . $VO->ID_SOLICITACAO_ESTAGIO . ")
                    and (vs.ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . ")
                    and (vs.ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . ")
                    and (vs.CS_TIPO_VAGA_ESTAGIO = " . $VO->CS_TIPO_VAGA_ESTAGIO . ")";

        return $this->sqlVetor($query);
    }
	
	
	function verificarRecrutamento($VO) {
        $query = "select ID_RECRUTAMENTO_ESTAGIO from recrutamento_estagio where ID_SOLICITACAO_ESTAGIO = '".$VO->ID_SOLICITACAO_ESTAGIO."'";

        return $this->sqlVetor($query);
    }

    function alterarVagasSolicitadas($VO) {
        $query = "
            update VAGAS_SOLICITACAO
                set DT_ATUALIZACAO = sysdate,
                    ID_USUARIO_ATUALIZACAO = " . $_SESSION['ID_USUARIO'] . ",
                    NB_QUANTIDADE = '" . $VO->NB_QUANTIDADE . "',
                    ID_CURSO_ESTAGIO = '" . $VO->ID_CURSO_ESTAGIO . "'
              where (ID_SOLICITACAO_ESTAGIO = " . $VO->ID_SOLICITACAO_ESTAGIO . ")
                and (ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . ")
                and (ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . ")
                and (CS_TIPO_VAGA_ESTAGIO = " . $VO->CS_TIPO_VAGA_ESTAGIO . ")";

        return $this->sql($query);
    }

    function atualizarInf($VO) {

        $query = "
            update SOLICITACAO_ESTAGIO
                set DT_ATUALIZACAO = sysdate,
                    ID_USUARIO_ATUALIZACAO = " . $_SESSION['ID_USUARIO'] . "
              where ID_SOLICITACAO_ESTAGIO = " . $VO->ID_SOLICITACAO_ESTAGIO;

        $this->sql($query);

        $data = "
            select TO_CHAR(a.DT_ATUALIZACAO, 'DD/MM/YYYY hh24:mi:ss') DT_ATUALIZACAO, c.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL
               from SOLICITACAO_ESTAGIO a, USUARIO b, V_FUNCIONARIO_USUARIO c
              where a.ID_SOLICITACAO_ESTAGIO = '" . $VO->ID_SOLICITACAO_ESTAGIO . "'
                and a.ID_USUARIO_ATUALIZACAO = b.ID_USUARIO
                and b.ID_PESSOA_FUNCIONARIO = c.ID_PESSOA_FUNCIONARIO
                and b.ID_UNIDADE_GESTORA = c.ID_UNIDADE_GESTORA";

        $this->sqlVetor($data);
        $datahora = $this->getVetor();

        return $datahora;
    }


	function efetivarSolicitacao($VO){

            $query = " UPDATE solicitacao_estagio SET
						   CS_SITUACAO = 2,
						   ID_USUARIO_ATUALIZACAO = '" . $_SESSION['ID_USUARIO'] . "',
						   DT_ATUALIZACAO = SYSDATE
					   WHERE ID_SOLICITACAO_ESTAGIO = ".$VO->ID_SOLICITACAO_ESTAGIO."";
			
        $this->sql($query);		
		
    }
	
}

?>