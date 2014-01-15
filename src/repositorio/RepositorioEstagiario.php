<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioEstagiario extends Repositorio {

    function pesquisarLocalidade($VO) {

        $query = "select ID_LOCALIDADE CODIGO, TX_LOCALIDADE ||' - '|| ID_UF TX_LOCALIDADE
			FROM LOCALIDADE ORDER BY TX_LOCALIDADE";

        return $this->sqlVetor($query);
    }

    function pesquisarFuncionario($VO) {

        $query = "select ID_PESSOA_FUNCIONARIO CODIGO, TX_FUNCIONARIO FROM V_FUNCIONARIO ORDER BY TX_FUNCIONARIO";

        return $this->sqlVetor($query);
    }

	function pesquisarCurso($VO) {
		$query = "
			select a.ID_CURSO_ESTAGIO CODIGO,
			       a.TX_CURSO_ESTAGIO, a.CS_AREA_CONHECIMENTO
			  from CURSO_ESTAGIO a
			order by CS_AREA_CONHECIMENTO, TX_CURSO_ESTAGIO
		";

		return $this->sqlVetor($query);
	}

	function pesquisarOfertaVaga($VO) {
		$query = "
			select d.ID_OFERTA_VAGA CODIGO,
			       d.TX_CODIGO_OFERTA_VAGA
			  from OFERTA_VAGA d
			 where d.ID_ORGAO_ESTAGIO
			       in (select b.ID_ORGAO_ESTAGIO
			           from AGENTE_SETORIAL_ESTAGIO a, ORGAO_AGENTE_SETORIAL b
			           where a.ID_SETORIAL_ESTAGIO = b.ID_SETORIAL_ESTAGIO
			                 and a.ID_USUARIO = " . $_SESSION['ID_USUARIO'] . ")
			       and d.ID_OFERTA_VAGA
			        not in (select d.ID_OFERTA_VAGA
			                from SELECAO_ESTAGIO d,
			                     AGENTE_SETORIAL_ESTAGIO a,
			                     ORGAO_AGENTE_SETORIAL b
			               where a.ID_SETORIAL_ESTAGIO = b.ID_SETORIAL_ESTAGIO
			                     and a.ID_USUARIO = " . $_SESSION['ID_USUARIO'] . "
			                     and b.ID_ORGAO_ESTAGIO = d.ID_ORGAO_ESTAGIO
			                     and d.CS_SELECAO = 1)
			       and d.CS_SITUACAO in 3
			order by TX_CODIGO_OFERTA_VAGA desc
		";

		return $this->sqlVetor($query);
	}

    function pesquisar($VO) {

        $query = "
        	select trim(upper(t.TX_NOME)) TX_NOME,
                        t.CS_SEXO,
                        to_char(t.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
                        replace(replace(t.NB_RG, '.',''), '-','') NB_RG,
                        replace(replace(t.NB_CPF, '.',''), '-','') NB_CPF,
                        to_char(t.DT_NASCIMENTO, 'dd/mm/yyyy') DT_NASCIMENTO,
                        t.ID_PESSOA_ESTAGIARIO,
                        t.ID_PESSOA_FUNCIONARIO,
                        t.NB_FUNCIONARIO,
                        replace(replace(t.TX_CEP, '.',''), '-','') TX_CEP,
                        upper(t.TX_ENDERECO) TX_ENDERECO,
                        replace(replace(t.NB_NUMERO, '.',''), '-','') NB_NUMERO,
                        upper(t.TX_COMPLEMENTO) TX_COMPLEMENTO,
                        upper(t.TX_BAIRRO) TX_BAIRRO,
                        upper(t.TX_CONTATO) TX_CONTATO,
                        upper(t.TX_EMAIL) TX_EMAIL,
                        upper(t.TX_AGENCIA) TX_AGENCIA,
                        upper(t.TX_CONTA_CORRENTE) TX_CONTA_CORRENTE
                   from V_ESTAGIARIO t
        ";

        $cond = " WHERE ";

        if ($VO->TX_NOME) {
            $query .= $cond . " upper(t.TX_NOME) like upper('%" . $VO->TX_NOME . "%') ";
            $cond = " AND ";
        }

        if ($VO->NB_CPF) {
            $query .= $cond . " t.NB_CPF = '" . $VO->NB_CPF . "' ";
            $cond = " AND ";
        }

        if ($VO->ID_PESSOA_ESTAGIARIO) {
            $query .= $cond . " t.ID_PESSOA_ESTAGIARIO = '" . $VO->ID_PESSOA_ESTAGIARIO . "' ";
            $cond = " AND ";
        }

        $query .= " ORDER BY t.TX_NOME";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

    function checacpf($VO) {

        $query = "
        	SELECT *
            FROM PESSOA_FISICA PF, FUNCIONARIO_2 F2
            WHERE PF.ID_PESSOA = F2.ID_PESSOA_FUNCIONARIO
            AND REPLACE(REPLACE(PF.NB_CPF, '.',''),'-','') = REPLACE(REPLACE('" . $VO->NB_CPF . "', '.',''),'-','')";

        return $this->sqlVetor($query);
    }

	function inserirestagiario($VO) {
        $query = "
            INSERT
                INTO ESTAGIARIO
                    (ID_PESSOA_ESTAGIARIO, TX_CEP, TX_ENDERECO, NB_NUMERO, TX_COMPLEMENTO, TX_BAIRRO, TX_CONTATO, TX_EMAIL, TX_AGENCIA, TX_CONTA_CORRENTE)
                values
                    ('" . $VO->ID_PESSOA . "',
                     replace(replace('" . $VO->TX_CEP . "', '.',''),'-',''),
                     '" . $VO->TX_ENDERECO . "',
                     replace(replace('" . $VO->NB_NUMERO . "', '.',''),'-',''),
                     '" . $VO->TX_COMPLEMENTO . "',
                     '" . $VO->TX_BAIRRO . "',
                     '" . $VO->TX_CONTATO . "',
                     '" . $VO->TX_EMAIL . "',
                     replace(replace('" . $VO->TX_AGENCIA . "', '.',''),'-',''),
                     replace(replace('" . $VO->TX_CONTA_CORRENTE . "','.',''),'-',''))";

        return $this->sql($query);
    }

    function inserir($VO) {
        $query = "
            insert
                into V_ESTAGIARIO
                        (ID_PESSOA_ESTAGIARIO, TX_NOME, CS_SEXO, NB_RG, NB_CPF, DT_NASCIMENTO, TX_CEP, TX_ENDERECO, NB_NUMERO,
                         TX_COMPLEMENTO, TX_BAIRRO, TX_CONTATO, TX_EMAIL, TX_AGENCIA, TX_CONTA_CORRENTE, DT_ATUALIZACAO, CS_TIPO_PESSOA)
                values
                    (SEMAD.F_G_PK_PESSOA(),
                     '" . $VO->TX_NOME . "',
                     '" . $VO->CS_SEXO . "',
                     replace(replace('" . $VO->NB_RG . "', '.',''),'-',''),
                     replace(replace('" . $VO->NB_CPF . "', '.',''),'-',''),
                     to_date('" . $VO->DT_NASCIMENTO . "','DD/MM/YYYY'),
                     replace(replace('" . $VO->TX_CEP . "', '.',''),'-',''),
                     '" . $VO->TX_ENDERECO . "',
                     replace(replace('" . $VO->NB_NUMERO . "', '.',''),'-',''),
                     '" . $VO->TX_COMPLEMENTO . "',
                     '" . $VO->TX_BAIRRO . "',
                     '" . $VO->TX_CONTATO . "',
                     '" . $VO->TX_EMAIL . "',
                     replace(replace('" . $VO->TX_AGENCIA . "', '.',''),'-',''),
                     replace(replace('" . $VO->TX_CONTA_CORRENTE . "', '.',''),'-',''),
                     SYSDATE,
                     '0')";

        return $this->sql($query);
    }

    function alterar($VO) {

        $query = "
        	update V_ESTAGIARIO
			   set TX_NOME = '" . $VO->TX_NOME . "',
			       CS_SEXO = '" . $VO->CS_SEXO . "',
			       NB_RG = replace(replace('" . $VO->NB_RG . "', '.',''),'-',''),
			       NB_CPF = replace(replace('" . $VO->NB_CPF . "', '.',''),'-',''),
			       DT_NASCIMENTO = TO_DATE('" . $VO->DT_NASCIMENTO . "','DD/MM/YYYY'),
			       TX_CEP = replace(replace('" . $VO->TX_CEP . "', '.',''),'-',''),
			       TX_ENDERECO = '" . $VO->TX_ENDERECO . "',
			       NB_NUMERO = replace(replace('" . $VO->NB_NUMERO . "', '.',''),'-',''),
			       TX_COMPLEMENTO = '" . $VO->TX_COMPLEMENTO . "',
			       TX_BAIRRO = '" . $VO->TX_BAIRRO . "',
			       TX_CONTATO = '" . $VO->TX_CONTATO . "',
			       TX_EMAIL = '" . $VO->TX_EMAIL . "',
			       TX_AGENCIA = replace(replace('" . $VO->TX_AGENCIA . "', '.',''),'-',''),
			       TX_CONTA_CORRENTE = replace(replace('" . $VO->TX_CONTA_CORRENTE . "', '.',''),'-',''),
			       DT_ATUALIZACAO = SYSDATE,
			       CS_TIPO_PESSOA = '0'
			 where ID_PESSOA_ESTAGIARIO = '" . $VO->ID_PESSOA_ESTAGIARIO . "'";

        return $this->sql($query);
    }

    function excluir($VO) {

        $query = "
        	delete
        		from V_ESTAGIARIO
        	   where ID_PESSOA_ESTAGIARIO = '" . $VO->ID_PESSOA_ESTAGIARIO . "'";

        return $this->sql($query);
    }

}

?>