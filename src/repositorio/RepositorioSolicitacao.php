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
				and oe.CS_STATUS = 1
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

	function buscarNomeOrgao($VO) {
        $query = "
            select B.TX_SIGLA_UNIDADE||' - '||B.TX_UNIDADE_ORG  TX_UNIDADE_ORG, a.TX_CNPJ
				from ORGAO_ESTAGIO a, UNIDADE_ORG B
				where a.ID_UNIDADE_ORG = B.ID_UNIDADE_ORG
				and a.ID_ORGAO_ESTAGIO = '".$VO->ID_ORGAO_ESTAGIO."'";

        return $this->sqlVetor($query);
    }



	function buscarQuadroVagas($VO) {
        $query = "
			select distinct a.ID_QUADRO_VAGAS_ESTAGIO from QUADRO_VAGAS_ESTAGIO a, VAGAS_ESTAGIO B
				where a.ID_QUADRO_VAGAS_ESTAGIO = B.ID_QUADRO_VAGAS_ESTAGIO
				and a.CS_SITUACAO = 1
				and B.ID_ORGAO_ESTAGIO = '".$VO->ID_ORGAO_ESTAGIO."'";

        return $this->sqlVetor($query);
    }


	function buscarAgenciaEstagio($VO) {
        $query = "
            select distinct B.ID_AGENCIA_ESTAGIO CODIGO, C.TX_AGENCIA_ESTAGIO from QUADRO_VAGAS_ESTAGIO a, VAGAS_ESTAGIO B, AGENCIA_ESTAGIO c
				where a.ID_QUADRO_VAGAS_ESTAGIO = B.ID_QUADRO_VAGAS_ESTAGIO
				and B.ID_AGENCIA_ESTAGIO = C.ID_AGENCIA_ESTAGIO
				and a.CS_SITUACAO = 1
				and B.ID_ORGAO_ESTAGIO = '".$VO->ID_ORGAO_ESTAGIO."'";

        return $this->sqlVetor($query);
    }

	function buscarTipoVaga($VO) {
        $query = "select DISTINCT B.CS_TIPO_VAGA_ESTAGIO CODIGO, C.TX_TIPO_VAGA_ESTAGIO
					from QUADRO_VAGAS_ESTAGIO a, VAGAS_ESTAGIO B, TIPO_VAGA_ESTAGIO C
					where a.ID_QUADRO_VAGAS_ESTAGIO = B.ID_QUADRO_VAGAS_ESTAGIO
					and B.CS_TIPO_VAGA_ESTAGIO = C.CS_TIPO_VAGA_ESTAGIO";
        //  print_r($query);
        return $this->sqlVetor($query);
    }





    function pesquisar($VO) {
        $query = "select a.ID_OFERTA_VAGA, a.TX_CODIGO_OFERTA_VAGA, B.TX_ORGAO_GESTOR_ESTAGIO, C.TX_ORGAO_ESTAGIO, D.TX_AGENCIA_ESTAGIO, E.TX_TIPO_VAGA_ESTAGIO,
						   DECODE(A.CS_SITUACAO, 1, 'Aberta', 2, 'Efetivada', 3, 'Oferta Encaminhada', 4, 'Cancelada') tx_situacao, to_char(a.DT_ATUALIZACAO, 'dd/mm/yyyy') DT_ATUALIZACAO
					from OFERTA_VAGA a, ORGAO_GESTOR_ESTAGIO B, ORGAO_ESTAGIO c, AGENCIA_ESTAGIO d, TIPO_VAGA_ESTAGIO e
					where a.ID_ORGAO_GESTOR_ESTAGIO = B.ID_ORGAO_GESTOR_ESTAGIO
					and a.ID_ORGAO_ESTAGIO = C.ID_ORGAO_ESTAGIO
					and a.ID_AGENCIA_ESTAGIO = D.ID_AGENCIA_ESTAGIO
					and a.CS_TIPO_VAGA_ESTAGIO = E.CS_TIPO_VAGA_ESTAGIO
					and a.ID_ORGAO_ESTAGIO = ".$VO->ID_ORGAO_ESTAGIO."
					and a.ID_ORGAO_GESTOR_ESTAGIO = ".$VO->ID_ORGAO_GESTOR_ESTAGIO;

        ($VO->CS_SITUACAO) ? $query .= " and a.CS_SITUACAO = " . $VO->CS_SITUACAO: false;
        ($VO->TX_CODIGO_OFERTA_VAGA) ? $query .= " and (a.TX_CODIGO_OFERTA_VAGA like '%" . $VO->TX_CODIGO_OFERTA_VAGA . "%') " : false;

        $query .= "
              order by a.DT_ATUALIZACAO desc";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }



    function buscar($VO) {
        $query = "select a.ID_OFERTA_VAGA, a.TX_CODIGO_OFERTA_VAGA, B.TX_AGENCIA_ESTAGIO, C.TX_ORGAO_GESTOR_ESTAGIO, D.TX_TIPO_VAGA_ESTAGIO, E.TX_ORGAO_ESTAGIO, F.TX_SIGLA_UNIDADE||' - '||F.TX_UNIDADE_ORG TX_ORGAO,
						   E.TX_CNPJ, a.TX_PESSOA_CONTATO, a.TX_TELEFONE, a.TX_CARGO_FUNCAO, a.TX_EMAIL, a.TX_ENDERECO, a.TX_PONTO_REFERENCIA, a.TX_NUM_ONIBUS, a.NB_QUANTIDADE, a.NB_QTDE_EMCAMINHADO,
						   TO_CHAR(a.DT_ENTREVISTA, 'dd/mm/yyyy') DT_ENTREVISTA, a.TX_HORARIO, a.NB_DURACAO_ESTAGIO, G.NB_VALOR, a.NB_VALOR_TRANSPORTE,
						   DECODE(a.CS_ESCOLARIDADE, 1, 'Médio', 2, 'Técnico', 3, 'Superior', 4, 'Educação Especial') TX_ESCOLARIDADE, H.TX_CURSO_ESTAGIO, a.TX_HORA_INICIO, a.TX_HORA_FINAL, a.TX_OUTROS_HORARIOS,
						   a.CS_WINDOWS, a.CS_WORD, a.CS_EXCEL, a.CS_POWERPOINT, a.CS_INTERNET, a.CS_CORELDRAW, a.CS_PHOTOSHOP, a.CS_WEBDESIGN, a.CS_AUTOCAD, a.CS_INGLES, a.CS_ESPANHOL, a.CS_FRANCES, a.CS_ALEMAO,
						   a.TX_OUTRAS_LINGUAS, a.TX_OUTROS_REQUISITOS, DECODE(a.CS_SEXO, 1, 'Masculino', 2, 'Feminino') TX_SEXO, a.TX_ATIVIDADES, a.TX_OBSERVACAO, a.ID_QUADRO_VAGAS_ESTAGIO, a.ID_AGENCIA_ESTAGIO,
						   a.ID_ORGAO_GESTOR_ESTAGIO, a.CS_TIPO_VAGA_ESTAGIO, a.ID_ORGAO_ESTAGIO, a.CS_ESCOLARIDADE, a.CS_SEXO, a.ID_BOLSA_ESTAGIO, a.ID_CURSO_ESTAGIO, a.NB_SEMESTRE,
						   TO_CHAR(a.DT_CADASTRO,'DD/MM/YYYY HH24:MI:SS')DT_CADASTRO,
						   TO_CHAR(a.DT_ATUALIZACAO,'DD/MM/YYYY HH24:MI:SS')DT_ATUALIZACAO, TO_CHAR(a.DT_ATUALIZACAO,'DD/MM/YYYY')DT_ATUALIZACAO_REL, FUNCIONARIO_CADASTRO.TX_FUNCIONARIO TX_FUNCIONARIO_CADASTRO,
						   FUNCIONARIO_ATUALIZACAO.TX_FUNCIONARIO TX_FUNCIONARIO_ATUALIZACAO, A.CS_SITUACAO, DECODE(A.CS_SITUACAO, 1, 'Aberta', 2, 'Efetivada', 3, 'Oferta Encaminhada', 4, 'Cancelada') TX_SITUACAO
				    from OFERTA_VAGA a, AGENCIA_ESTAGIO B, ORGAO_GESTOR_ESTAGIO C, TIPO_VAGA_ESTAGIO D, ORGAO_ESTAGIO E, UNIDADE_ORG F, BOLSA_ESTAGIO G, CURSO_ESTAGIO H, USUARIO USUARIO_CADASTRADO,
						 USUARIO USUARIO_ATUALIZACAO, V_FUNCIONARIO_TOTAL FUNCIONARIO_CADASTRO, V_FUNCIONARIO_TOTAL FUNCIONARIO_ATUALIZACAO
					where a.ID_AGENCIA_ESTAGIO = B.ID_AGENCIA_ESTAGIO
					and a.ID_ORGAO_GESTOR_ESTAGIO = C.ID_ORGAO_GESTOR_ESTAGIO
					and a.CS_TIPO_VAGA_ESTAGIO = D.CS_TIPO_VAGA_ESTAGIO
					and a.ID_ORGAO_ESTAGIO = E.ID_ORGAO_ESTAGIO
					and E.ID_UNIDADE_ORG = F.ID_UNIDADE_ORG
					and a.ID_BOLSA_ESTAGIO = G.ID_BOLSA_ESTAGIO
					and a.ID_CURSO_ESTAGIO = H.ID_CURSO_ESTAGIO(+)
					and a.ID_USUARIO_CADASTRO = USUARIO_CADASTRADO.ID_USUARIO
					and a.ID_USUARIO_ATUALIZACAO = USUARIO_ATUALIZACAO.ID_USUARIO
					and USUARIO_CADASTRADO.ID_PESSOA_FUNCIONARIO = FUNCIONARIO_CADASTRO.ID_PESSOA_FUNCIONARIO
					and USUARIO_ATUALIZACAO.ID_PESSOA_FUNCIONARIO = FUNCIONARIO_ATUALIZACAO.ID_PESSOA_FUNCIONARIO
					and USUARIO_CADASTRADO.ID_UNIDADE_GESTORA = FUNCIONARIO_CADASTRO.ID_UNIDADE_GESTORA
					and USUARIO_ATUALIZACAO.ID_UNIDADE_GESTORA = FUNCIONARIO_ATUALIZACAO.ID_UNIDADE_GESTORA
					and a.ID_OFERTA_VAGA = ".$VO->ID_OFERTA_VAGA;


        return $this->sqlVetor($query);
    }

	function inserir($VO) {
        $queryPK = "select SEMAD.F_G_PK_OFERTA_VAGA as ID_OFERTA_VAGA from dual";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "
            insert
                into OFERTA_VAGA
                (ID_OFERTA_VAGA, TX_CODIGO_OFERTA_VAGA, ID_ORGAO_GESTOR_ESTAGIO, ID_ORGAO_ESTAGIO, ID_QUADRO_VAGAS_ESTAGIO, ID_AGENCIA_ESTAGIO, CS_TIPO_VAGA_ESTAGIO, TX_PESSOA_CONTATO, TX_TELEFONE, TX_CARGO_FUNCAO, TX_EMAIL, TX_ENDERECO, TX_PONTO_REFERENCIA, TX_NUM_ONIBUS, NB_QUANTIDADE, NB_QTDE_EMCAMINHADO, DT_ENTREVISTA, TX_HORARIO, NB_DURACAO_ESTAGIO, NB_BOLSA_ESTAGIO, NB_VALOR_TRANSPORTE, CS_ESCOLARIDADE, ID_CURSO_ESTAGIO, NB_SEMESTRE, TX_HORA_INICIO, TX_HORA_FINAL, TX_OUTROS_HORARIOS, CS_WINDOWS, CS_WORD, CS_EXCEL, CS_POWERPOINT, CS_INTERNET, CS_CORELDRAW, CS_PHOTOSHOP, CS_WEBDESIGN, CS_AUTOCAD, CS_INGLES, CS_ESPANHOL, CS_FRANCES, CS_ALEMAO, TX_OUTRAS_LINGUAS, TX_OUTROS_REQUISITOS, CS_SEXO, TX_ATIVIDADES, TX_OBSERVACAO, CS_SITUACAO, ID_USUARIO_CADASTRO, ID_USUARIO_ATUALIZACAO, DT_CADASTRO, DT_ATUALIZACAO)
                values
                (" . $CodigoPK['ID_OFERTA_VAGA'][0] . ",
				 SEMAD.F_G_COD_OFERTA_VAGA(),
				 " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ",
				 " . $VO->ID_ORGAO_ESTAGIO . ",
				 " . $VO->ID_QUADRO_VAGAS_ESTAGIO . ",
				 " . $VO->ID_AGENCIA_ESTAGIO . ",
				 " . $VO->CS_TIPO_VAGA_ESTAGIO . ",
				 '" . $VO->TX_PESSOA_CONTATO . "',
				 '" . $VO->TX_TELEFONE . "',
				 '" . $VO->TX_CARGO_FUNCAO . "',
				 '" . mb_strtolower($VO->TX_EMAIL) . "',
				 '" . $VO->TX_ENDERECO . "',
				 '" . $VO->TX_PONTO_REFERENCIA . "',
				 '" . $VO->TX_NUM_ONIBUS . "',
				 '" . $VO->NB_QUANTIDADE . "',
				 '" . $VO->NB_QTDE_EMCAMINHADO . "',
				 TO_DATE('" . $VO->DT_ENTREVISTA . "', 'DD/MM/YYYY'),
				 '" . $VO->TX_HORARIO . "',
				 '" . $VO->NB_DURACAO_ESTAGIO . "',
				 '" . $VO->NB_BOLSA_ESTAGIO . "',
				 " . $VO->moeda($VO->NB_VALOR_TRANSPORTE) . ",
				 '" . $VO->CS_ESCOLARIDADE . "',
				 '" . $VO->ID_CURSO_ESTAGIO . "',
				 '" . $VO->NB_SEMESTRE . "',
				 '" . $VO->TX_HORA_INICIO . "',
				 '" . $VO->TX_HORA_FINAL . "',
				 '" . $VO->TX_OUTROS_HORARIOS . "',
				 '" . $VO->CS_WINDOWS . "',
				 '" . $VO->CS_WORD . "',
				 '" . $VO->CS_EXCEL . "',
				 '" . $VO->CS_POWERPOINT . "',
				 '" . $VO->CS_INTERNET . "',
				 '" . $VO->CS_CORELDRAW . "',
				 '" . $VO->CS_PHOTOSHOP . "',
				 '" . $VO->CS_WEBDESIGN . "',
				 '" . $VO->CS_AUTOCAD . "',
				 '" . $VO->CS_INGLES . "',
				 '" . $VO->CS_ESPANHOL . "',
				 '" . $VO->CS_FRANCES . "',
				 '" . $VO->CS_ALEMAO . "',
				 '" . $VO->TX_OUTRAS_LINGUAS . "',
				 '" . $VO->TX_OUTROS_REQUISITOS . "',
				 '" . $VO->CS_SEXO . "',
				 '" . $VO->TX_ATIVIDADES . "',
				 '" . $VO->TX_OBSERVACAO . "',
				 1,
				 " . $_SESSION['ID_USUARIO'] . ",
				 " . $_SESSION['ID_USUARIO'] . ",
                 SYSDATE,
                 SYSDATE "
                   . ")";

        $retorno = $this->sql($query);

        if (!$retorno) {
            return $CodigoPK['ID_OFERTA_VAGA'][0];
        }
    }

    function alterar($VO) {

		$query = "UPDATE OFERTA_VAGA SET
						TX_NUM_ONIBUS         	= '" . $VO->TX_NUM_ONIBUS . "',
						CS_EXCEL                = '" . $VO->CS_EXCEL . "',
						CS_SEXO                 = '" . $VO->CS_SEXO . "',
						ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . ",
						TX_HORA_FINAL           = '" . $VO->TX_HORA_FINAL . "',
						NB_QUANTIDADE           = '" . $VO->NB_QUANTIDADE . "',
						TX_HORA_INICIO          = '" . $VO->TX_HORA_INICIO . "',
						CS_INGLES               = '" . $VO->CS_INGLES . "',
						TX_ATIVIDADES           = '" . $VO->TX_ATIVIDADES . "',
						TX_OUTRAS_LINGUAS       = '" . $VO->TX_OUTRAS_LINGUAS . "',
						TX_OUTROS_REQUISITOS    = '" . $VO->TX_OUTROS_REQUISITOS . "',
						CS_WINDOWS              = '" . $VO->CS_WINDOWS . "',
						CS_CORELDRAW            = '" . $VO->CS_CORELDRAW . "',
						TX_PONTO_REFERENCIA     = '" . $VO->TX_PONTO_REFERENCIA . "',
						ID_ORGAO_ESTAGIO        = " . $VO->ID_ORGAO_ESTAGIO . ",
						CS_INTERNET             = '" . $VO->CS_INTERNET . "',
						TX_CARGO_FUNCAO         = '" . $VO->TX_CARGO_FUNCAO . "',
						TX_OBSERVACAO           = '" . $VO->TX_OBSERVACAO . "',
						CS_FRANCES              = '" . $VO->CS_FRANCES . "',";

$VO->CS_SITUACAO? $query .= "CS_SITUACAO        = '" . $VO->CS_SITUACAO . "'," : false;

			 $query .= "ID_USUARIO_ATUALIZACAO  = " . $_SESSION['ID_USUARIO'] . ",
						CS_WORD                 = '" . $VO->CS_WORD . "',
						ID_CURSO_ESTAGIO        = '" . $VO->ID_CURSO_ESTAGIO . "',
						DT_ENTREVISTA           = TO_DATE('" . $VO->DT_ENTREVISTA . "', 'DD/MM/YYYY'),
						NB_BOLSA_ESTAGIO        = '" . $VO->NB_BOLSA_ESTAGIO . "',
						NB_QTDE_EMCAMINHADO     = '" . $VO->NB_QTDE_EMCAMINHADO . "',
						TX_OUTROS_HORARIOS      = '" . $VO->TX_OUTROS_HORARIOS . "',
						TX_TELEFONE             = '" . $VO->TX_TELEFONE . "',
						CS_AUTOCAD              = '" . $VO->CS_AUTOCAD . "',
						CS_TIPO_VAGA_ESTAGIO    = " . $VO->CS_TIPO_VAGA_ESTAGIO . ",
						CS_PHOTOSHOP            = '" . $VO->CS_PHOTOSHOP . "',
						ID_AGENCIA_ESTAGIO      = " . $VO->ID_AGENCIA_ESTAGIO . ",
						CS_POWERPOINT           = '" . $VO->CS_POWERPOINT . "',
						CS_ALEMAO               = '" . $VO->CS_ALEMAO . "',
						CS_WEBDESIGN            = '" . $VO->CS_WEBDESIGN . "',
						NB_VALOR_TRANSPORTE     = " . $VO->moeda($VO->NB_VALOR_TRANSPORTE) . ",
						ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ",
						TX_PESSOA_CONTATO       = '" . $VO->TX_PESSOA_CONTATO . "',
						TX_HORARIO              = '" . $VO->TX_HORARIO . "',
						CS_ESCOLARIDADE         = '" . $VO->CS_ESCOLARIDADE . "',
						TX_EMAIL                = '" . mb_strtolower($VO->TX_EMAIL) . "',
						DT_ATUALIZACAO          = sysdate,
						CS_ESPANHOL             = '" . $VO->CS_ESPANHOL . "',
						TX_ENDERECO             = '" . $VO->TX_ENDERECO . "',
						NB_DURACAO_ESTAGIO      = '" . $VO->NB_DURACAO_ESTAGIO . "',
						NB_SEMESTRE             = '" . $VO->NB_SEMESTRE . "'
				  WHERE ID_OFERTA_VAGA      = " . $VO->ID_OFERTA_VAGA;

        return $this->sql($query);
    }

    function excluir($VO) {
        $query = "
            delete from OFERTA_VAGA where ID_OFERTA_VAGA = " . $VO->ID_OFERTA_VAGA;

        return $this->sql($query);
    }

	function verficarGestor($VO) {

        $query = "SELECT Grupo_usuario.ID_USUARIO, Grupo_usuario.ID_GRUPO, Usuario.TX_LOGIN, Pessoa.Tx_Nome
					FROM GRUPO_USUARIO Grupo_usuario, USUARIO Usuario , PESSOA Pessoa
					WHERE  (Grupo_usuario.ID_USUARIO = Usuario.ID_USUARIO)
					and usuario.id_pessoa_funcionario = pessoa.id_pessoa
					and GRUPO_USUARIO.ID_GRUPO = 458
					and Grupo_usuario.ID_USUARIO = ".$_SESSION['ID_USUARIO']."
					ORDER BY Usuario.TX_LOGIN, Pessoa.Tx_Nome";

        return $this->sqlVetor($query);
    }

	function efetivarOferta($VO) {
        $query = "update oferta_vaga set
							cs_situacao = 2,
							dt_atualizacao = sysdate,
							id_usuario_atualizacao = ".$_SESSION['ID_USUARIO']."
				where id_oferta_vaga = ".$VO->ID_OFERTA_VAGA;

        return $this->sql($query);
    }

	function encaminharOferta($VO) {
        $query = "update oferta_vaga set
							cs_situacao = 3,
							dt_atualizacao = sysdate,
							id_usuario_atualizacao = ".$_SESSION['ID_USUARIO']."
				where id_oferta_vaga = ".$VO->ID_OFERTA_VAGA;

        return $this->sql($query);
    }



	function buscarAgencia($VO) {
        $query = "select a.id_agencia_estagio, a.tx_codigo_oferta_vaga, b.tx_orgao_estagio, to_char(a.dt_atualizacao, 'dd/mm/yyyy') dt_atualizacao
					from oferta_vaga a, orgao_estagio b
					where a.id_orgao_estagio = b.id_orgao_estagio
					and a.id_oferta_vaga = ".$VO->ID_OFERTA_VAGA;

        return $this->sqlVetor($query);
    }

	function buscarEmails($VO) {
        $query = "select DISTINCT B.TX_EMAIL
					from OFERTA_VAGA a, ORGAO_GESTOR_EMAIL B
					where a.ID_ORGAO_GESTOR_ESTAGIO = B.ID_ORGAO_GESTOR_ESTAGIO
					and a.ID_OFERTA_VAGA = ".$VO->ID_OFERTA_VAGA;

        return $this->sqlVetor($query);
    }

	function buscarEmailAgencia($VO) {
        $query = "select TX_EMAIL from agencia_estagio where id_agencia_estagio = ".$VO->ID_AGENCIA_ESTAGIO;

        return $this->sqlVetor($query);
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

                            print_r($query);

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


	function pesquisarValorBolsa($VO) {
        $query = "select NB_BOLSA_ESTAGIO CODIGO, to_char(NB_VALOR, 'FM999G999G999D90') NB_VALOR from BOLSA_ESTAGIO";

        return $this->sqlVetor($query);
    }

}

?>
