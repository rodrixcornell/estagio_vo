<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioRecesso extends Repositorio {

     function efetivar($VO) {
		  $query = "update RECESSO_ESTAGIO set CS_SITUACAO = 2 where ID_RECESSO_ESTAGIO = " . $VO->ID_RECESSO_ESTAGIO;

		  return $this->sql($query);
      }

    function buscarAgenteSetorial($VO) {
        // fun��o que busca no banco todas as agencias de integra��o
        // utilizada no arrays.php
        $query = "SELECT
                    C.ID_USUARIO ID_USUARIO_RESP,
                    C.ID_SETORIAL_ESTAGIO  CODIGO,
                    B.TX_LOGIN  TX_LOGIN,
                    A.TX_FUNCIONARIO  TX_FUNCIONARIO,
                    to_char(C.DT_CADASTRO,'dd/mm/yyyy')  DT_CADASTRO,
                    to_char(C.DT_ATULIZACAO,'dd/mm/yyyy') DT_ATULIZACAO
                 FROM
                            V_FUNCIONARIO_TOTAl A,
                            USUARIO B ,
                            AGENTE_SETORIAL_ESTAGIO  C
                            WHERE B.ID_USUARIO = C.ID_USUARIO
                            AND A.ID_UNIDADE_GESTORA=B.ID_UNIDADE_GESTORA
                            and A.ID_PESSOA_FUNCIONARIO=B.ID_PESSOA_FUNCIONARIO";
        return $this->sqlVetor($query);
    }

    function pesquisarAgenteSetorial($VO) {
        // fun��o que busca no banco todas as agencias de integra��o
        // utilizada no arrays.php
        $query = "SELECT
                    C.ID_USUARIO ID_USUARIO_RESP,
                    C.ID_SETORIAL_ESTAGIO  CODIGO,
                    B.TX_LOGIN  TX_LOGIN,
                    A.TX_FUNCIONARIO  TX_FUNCIONARIO,
                    to_char(C.DT_CADASTRO,'dd/mm/yyyy')  DT_CADASTRO,
                    to_char(C.DT_ATULIZACAO,'dd/mm/yyyy') DT_ATULIZACAO
                 FROM
                            V_FUNCIONARIO_TOTAl A,
                            USUARIO B ,
                            AGENTE_SETORIAL_ESTAGIO  C
                            WHERE B.ID_USUARIO = C.ID_USUARIO
                            AND A.ID_UNIDADE_GESTORA=B.ID_UNIDADE_GESTORA
                            and A.ID_PESSOA_FUNCIONARIO=B.ID_PESSOA_FUNCIONARIO";
        return $this->sqlVetor($query);
    }

    function pesquisarOrgaoSolicitante($VO) {

        $query = "SELECT TX_ORGAO_ESTAGIO,
            ID_ORGAO_ESTAGIO ID_ORGAO_SOLICITANTE,
            ID_ORGAO_ESTAGIO CODIGO

            from ORGAO_ESTAGIO ORDER BY TX_ORGAO_ESTAGIO";

        return $this->sqlVetor($query);
    }

    function pesquisarOrgaoGestor($VO) {


        // Fun��o que pega todos os org�os Getores
        // Utilizada na Index chamada pelo arrays.php

        $query = "SELECT
                    ID_ORGAO_GESTOR_ESTAGIO ,
                    ID_ORGAO_GESTOR_ESTAGIO ||'_'||ID_UNIDADE_ORG CODIGO,
                    TX_ORGAO_GESTOR_ESTAGIO,
                    ID_UNIDADE_ORG
                  FROM
                    ORGAO_GESTOR_ESTAGIO";
        return $this->sqlVetor($query);


//   $query = "SELECT TX_ORGAO_ESTAGIO || ID_ORGAO_ESTAGIO TX_ORGAO_GESTOR_ESTAGIO,
//             ID_ORGAO_ESTAGIO ID_ORGAO_GESTOR_ESTAGIO,
//            ID_ORGAO_ESTAGIO CODIGO
//
//            from ORGAO_ESTAGIO ORGAO_ESTAGIO ORDER BY TX_ORGAO_GESTOR_ESTAGIO";
//        return $this->sqlVetor($query);
    }

    function buscarContrato($VO) {

        $query = "SELECT ID_CONTRATO CODIGO,
            ID_CONTRATO,
            TX_CODIGO,
            TX_CODIGO TX_CONTRATO
            FROM
            CONTRATO_ESTAGIO
	WHERE ";
        ($VO->ID_ORGAO_GESTOR_ESTAGIO) ? $query.=" ID_ORGAO_GESTOR_ESTAGIO = '" . $VO->ID_ORGAO_GESTOR_ESTAGIO . "' " : false;
        ($VO->ID_ORGAO_ESTAGIO) ? $query.="  and ($VO->ID_ORGAO_ESTAGIO) = '" . $VO->ID_ORGAO_ESTAGIO . "' " : false;

        $query.="ORDER BY TX_CODIGO";
        return $this->sqlVetor($query);
    }

    function buscarDadosContrato($VO) {
        $query = "SELECT
                  A.ID_CONTRATO CODIGO,
                  D.TX_NOME  || '_' ||
                  D.NB_CPF || '_' ||
                  T.TX_TIPO_VAGA_ESTAGIO || '_' ||
                  I.TX_INSTITUICAO_ENSINO || '_' ||
                  CE.TX_CURSO_ESTAGIO
                  || '_' || DECODE(A.CS_PERIODO, 1,'1º Ano', 2,'2º Ano', 3,'3º Ano', 4,'4º Ano', 5,'5º Ano', 6,'1º Periodo', 7,'2º Periodo',8,'3º Periodo',
                                       9,'4º Periodo', 10,'5º Periodo', 11,'6º Periodo', 12,'7º Periodo', 13,'8º Periodo', 14,'9º Periodo', 15,'10º Periodo')
                  || '_' ||  SUBSTR(T.TX_TIPO_VAGA_ESTAGIO, 0, (CASE WHEN INSTR(T.TX_TIPO_VAGA_ESTAGIO, ' ') <> 0 THEN INSTR(T.TX_TIPO_VAGA_ESTAGIO, ' ') - 1 ELSE LENGTH(T.TX_TIPO_VAGA_ESTAGIO) END)) || '_' || A.TX_TCE || '_' ||
  	         to_char(A.DT_INICIO_VIGENCIA,'dd/mm/yyyy') || '_' ||  to_char(A.DT_FIM_VIGENCIA,'dd/mm/yyyy') || '_' ||  A.ID_AGENCIA_ESTAGIO TUDO
            FROM
                  CONTRATO_ESTAGIO A,
                  ORGAO_GESTOR_ESTAGIO B,
                  ORGAO_ESTAGIO C,
                  V_ESTAGIARIO D,
                  AGENCIA_ESTAGIO E ,
                  SELECAO_ESTAGIO F,
                  TIPO_VAGA_ESTAGIO T,
                  INSTITUICAO_ENSINO I,
                  CURSO_ESTAGIO CE
            WHERE
                      A.ID_AGENCIA_ESTAGIO      = E.ID_AGENCIA_ESTAGIO
                  AND B.ID_ORGAO_GESTOR_ESTAGIO = A.ID_ORGAO_GESTOR_ESTAGIO
                  AND A.ID_ORGAO_ESTAGIO        = C.ID_ORGAO_ESTAGIO
                  AND A.ID_PESSOA_ESTAGIARIO    = D.ID_PESSOA_ESTAGIARIO
                  AND F.ID_SELECAO_ESTAGIO(+)      = A.ID_SELECAO_ESTAGIO
                  AND A.CS_TIPO_VAGA_ESTAGIO    = T.CS_TIPO_VAGA_ESTAGIO
                  AND A.ID_INSTITUICAO_ENSINO   = I.ID_INSTITUICAO_ENSINO
                  AND A.ID_CURSO_ESTAGIO        = CE.ID_CURSO_ESTAGIO ";

        $VO->ID_CONTRATO ? $query .= " AND A.ID_CONTRATO = " . $VO->ID_CONTRATO . " " : false;
        return $this->sqlVetor($query);
    }

    function pesquisar($VO) {

        $codigoOrgaoGestor = explode('_', $VO->ID_ORGAO_GESTOR_ESTAGIO);


        $query = "

SELECT
        RECESSO_ESTAGIO.id_recesso_estagio,
        RECESSO_ESTAGIO.tx_codigo CODIGO_RECESSO,
        RECESSO_ESTAGIO.tx_cargo_agente,
       RECESSO_ESTAGIO.tx_email_agente,
       RECESSO_ESTAGIO.tx_telefone_agente,
       RECESSO_ESTAGIO.dt_inicio_vig_estagio,
       RECESSO_ESTAGIO.tx_justificativa_adiamento,
       to_char(RECESSO_ESTAGIO.dt_adiamento,'dd/mm/yyyy') dt_adiamento,
       RECESSO_ESTAGIO.id_contrato ,
       RECESSO_ESTAGIO.id_setorial_estagio,
       RECESSO_ESTAGIO.id_agencia_estagio,
       RECESSO_ESTAGIO.id_orgao_estagio,
       RECESSO_ESTAGIO.dt_cadastro,
       RECESSO_ESTAGIO.dt_atualizacao,
       RECESSO_ESTAGIO.id_usuario_cadastro,
       RECESSO_ESTAGIO.id_usuario_atualizacao,
       RECESSO_ESTAGIO.cs_situacao,
       RECESSO_ESTAGIO.dt_fim_vigencia_estagio,
       to_char(RECESSO_ESTAGIO.dt_inicio_recesso,'dd/mm/yyyy') dt_inicio_recesso,
       to_char(RECESSO_ESTAGIO.dt_fim_recesso,'dd/mm/yyyy') dt_fim_recesso,
       RECESSO_ESTAGIO.nb_mes_referencia,
       RECESSO_ESTAGIO.nb_ano_referencia,
       to_char(RECESSO_ESTAGIO.dt_assinatura,'dd/mm/yyyy') dt_assinatura,
       RECESSO_ESTAGIO.tx_matricula,
       RECESSO_ESTAGIO.nb_dias_restantes,
       RECESSO_ESTAGIO.tx_chefia_imediata,
       RECESSO_ESTAGIO.cs_realizacao,
       USUARIO_ATUALIZACAO_fun.TX_FUNCIONARIO FUNCIONARIO_CADASTRO,
       USUARIO_CADASTRO_FUN.TX_FUNCIONARIO FUNCIONARIO_ATUALIZACAO,
       V_RESP_UNID_ORG.tx_nome TX_SECRETARIO_ORGAO_GESTOR,
       A.TX_FUNCIONARIO  TX_AGENTE_SETORIAL,
       ORGAO_ESTAGIO1.TX_ORGAO_ESTAGIO TX_ORGAO_SOLICITANTE,
       CONTRATO_ESTAGIO.TX_CODIGO TX_CONTRATO,
       CONTRATO_ESTAGIO.TX_TCE,
        case
         when CONTRATO_ESTAGIO.CS_TIPO = '1' then '1 - Contrato Inicial'
         when CONTRATO_ESTAGIO.CS_TIPO = '2' then '2 - Aditivo Contratual'
        end
        TX_TIPO_VAGA_ESTAGIO,
        TIPO_VAGA_ESTAGIO.TX_TIPO_VAGA_ESTAGIO TX_NIVEL,
      ORGAO_GESTOR_ESTAGIO.TX_ORGAO_GESTOR_ESTAGIO TX_ORGAO_GESTOR,
        case
         when CONTRATO_ESTAGIO.CS_PERIODO = '1' then '1 ano'
         when CONTRATO_ESTAGIO.CS_PERIODO = '2' then '2 ano'
         when CONTRATO_ESTAGIO.CS_PERIODO = '3' then '3 ano'
         when CONTRATO_ESTAGIO.CS_PERIODO = '4' then '4 ano'
         when CONTRATO_ESTAGIO.CS_PERIODO = '5' then '5 ano'
         when CONTRATO_ESTAGIO.CS_PERIODO = '6' then '1 periodo'
         when CONTRATO_ESTAGIO.CS_PERIODO = '7' then '2 periodo'
         when CONTRATO_ESTAGIO.CS_PERIODO = '8' then '3 periodo'
         when CONTRATO_ESTAGIO.CS_PERIODO = '9' then '4 periodo'
         when CONTRATO_ESTAGIO.CS_PERIODO = '10' then '5 periodo'
         when CONTRATO_ESTAGIO.CS_PERIODO = '11' then '6 periodo'
         when CONTRATO_ESTAGIO.CS_PERIODO = '12' then '7 periodo'
         when CONTRATO_ESTAGIO.CS_PERIODO = '13' then '8 periodo'
         when CONTRATO_ESTAGIO.CS_PERIODO = '14' then '9 periodo'
         when CONTRATO_ESTAGIO.CS_PERIODO = '15' then '10 periodo'

        end
        TX_PERIODO,
       V_ESTAGIARIO.TX_NOME TX_NOME_ESTAGIARIO,
       V_ESTAGIARIO.NB_CPF,
       AGENCIA_ESTAGIO.TX_AGENCIA_ESTAGIO,
        case
         when RECESSO_ESTAGIO.CS_SITUACAO = '2' then 'Fechado'
         when RECESSO_ESTAGIO.CS_SITUACAO = '1' then 'Aberto'
        end
        TX_SITUACAO,
        case
         when RECESSO_ESTAGIO.CS_REALIZACAO = '3' then '3 - Postergado Parcialmente'
         when RECESSO_ESTAGIO.CS_REALIZACAO = '2' then '2 - Postergado Totalmente'
         when RECESSO_ESTAGIO.CS_REALIZACAO = '1' then '1 - Realizado'
        end
        TX_REALIZACAO,
       CURSO_ESTAGIO.TX_CURSO_ESTAGIO,
       INSTITUICAO_ENSINO.TX_INSTITUICAO_ENSINO

  FROM RECESSO_ESTAGIO RECESSO_ESTAGIO


    , ORGAO_ESTAGIO ORGAO_ESTAGIO1
    , ORGAO_GESTOR_ESTAGIO ORGAO_GESTOR_ESTAGIO
    , CONTRATO_ESTAGIO CONTRATO_ESTAGIO
    , AGENCIA_ESTAGIO AGENCIA_ESTAGIO

    , V_ESTAGIARIO V_ESTAGIARIO

    , AGENTE_SETORIAL_ESTAGIO AGENTE_SETORIAL_ESTAGIO
    , CURSO_ESTAGIO CURSO_ESTAGIO

    , INSTITUICAO_ENSINO INSTITUICAO_ENSINO

    , USUARIO USUARIO_CADASTRO
    , USUARIO USUARIO_ATUALIZACAO
    , V_FUNCIONARIO_TOTAL USUARIO_CADASTRO_FUN
    , V_FUNCIONARIO_TOTAL USUARIO_ATUALIZACAO_fun

    , V_RESP_UNID_ORG

    ,V_FUNCIONARIO_TOTAl A
    , USUARIO B

    , TIPO_VAGA_ESTAGIO TIPO_VAGA_ESTAGIO

  WHERE
    RECESSO_ESTAGIO.ID_ORGAO_ESTAGIO = ORGAO_ESTAGIO1.ID_ORGAO_ESTAGIO

    AND RECESSO_ESTAGIO.ID_CONTRATO = CONTRATO_ESTAGIO.ID_CONTRATO

    AND CONTRATO_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO = ORGAO_GESTOR_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO

    AND RECESSO_ESTAGIO.ID_AGENCIA_ESTAGIO = AGENCIA_ESTAGIO.ID_AGENCIA_ESTAGIO

    AND CONTRATO_ESTAGIO.ID_PESSOA_ESTAGIARIO = V_ESTAGIARIO.ID_PESSOA_ESTAGIARIO

    AND RECESSO_ESTAGIO.ID_SETORIAL_ESTAGIO = AGENTE_SETORIAL_ESTAGIO.ID_SETORIAL_ESTAGIO


    AND CONTRATO_ESTAGIO.ID_CURSO_ESTAGIO = CURSO_ESTAGIO.ID_CURSO_ESTAGIO

    AND CONTRATO_ESTAGIO.ID_INSTITUICAO_ENSINO = INSTITUICAO_ENSINO.ID_INSTITUICAO_ENSINO

                    AND USUARIO_CADASTRO.ID_USUARIO                = RECESSO_ESTAGIO.ID_USUARIO_CADASTRO
                    AND USUARIO_CADASTRO.ID_PESSOA_FUNCIONARIO     = USUARIO_CADASTRO_FUN.ID_PESSOA_FUNCIONARIO
                    AND USUARIO_CADASTRO.ID_UNIDADE_GESTORA        = USUARIO_CADASTRO_FUN.ID_UNIDADE_GESTORA
                    AND USUARIO_ATUALIZACAO.ID_USUARIO             = CONTRATO_ESTAGIO.ID_USUARIO_ATUALIZACAO
                    AND USUARIO_ATUALIZACAO.ID_PESSOA_FUNCIONARIO  = USUARIO_ATUALIZACAO_fun.ID_PESSOA_FUNCIONARIO
                    AND USUARIO_ATUALIZACAO.ID_UNIDADE_GESTORA     = USUARIO_ATUALIZACAO_fun.ID_UNIDADE_GESTORA

                    AND AGENTE_SETORIAL_ESTAGIO.ID_USUARIO  =  B.ID_USUARIO
                    and A.ID_PESSOA_FUNCIONARIO=B.ID_PESSOA_FUNCIONARIO


                    AND   ORGAO_GESTOR_ESTAGIO.id_unidade_org  = V_RESP_UNID_ORG.id_unidade_org(+)

AND CONTRATO_ESTAGIO.CS_TIPO_VAGA_ESTAGIO    = TIPO_VAGA_ESTAGIO.CS_TIPO_VAGA_ESTAGIO
 ";

        ($VO->ID_ORGAO_ESTAGIO) ? $query .= " AND RECESSO_ESTAGIO.ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . " " : false;
        ($VO->TX_CODIGO_CONTRATO ) ? $query .= "AND CONTRATO_ESTAGIO.TX_CODIGO = '" . $VO->TX_CODIGO_CONTRATO . "'" : false;
        ($VO->ID_ORGAO_GESTOR_ESTAGIO ) ? $query .= "AND CONTRATO_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO = " . $codigoOrgaoGestor[0] . " " : false;
        ($VO->TX_NOME_ESTAGIARIO) ? $query .= "AND  V_ESTAGIARIO.TX_NOME LIKE '%" . $VO->TX_NOME_ESTAGIARIO . "%'" : false;
        ($VO->NB_CPF) ? $query .= "AND  V_ESTAGIARIO.NB_CPF =  '" . $VO->NB_CPF . "'" : false;
        ($VO->CODIGO_RECESSO) ? $query .= "AND  RECESSO_ESTAGIO.tx_codigo =  '" . $VO->CODIGO_RECESSO . "'" : false;

        $query .= " ORDER BY RECESSO_ESTAGIO.TX_CODIGO";
        //echo $query;

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }


        return $this->sqlVetor($query);
    }

    function buscar($VO) {

        $query = "
SELECT
        RECESSO_ESTAGIO.id_recesso_estagio,
        RECESSO_ESTAGIO.tx_codigo CODIGO_RECESSO,
        RECESSO_ESTAGIO.tx_cargo_agente,
       RECESSO_ESTAGIO.tx_email_agente,
       RECESSO_ESTAGIO.tx_telefone_agente,
       to_char(RECESSO_ESTAGIO.dt_inicio_vig_estagio,'dd/mm/yyyy')dt_inicio_vig_estagio,
       RECESSO_ESTAGIO.tx_justificativa_adiamento,
       to_char(RECESSO_ESTAGIO.dt_adiamento,'dd/mm/yyyy')dt_adiamento,
       RECESSO_ESTAGIO.id_contrato,
       RECESSO_ESTAGIO.id_setorial_estagio,
       RECESSO_ESTAGIO.id_agencia_estagio,
      RECESSO_ESTAGIO.id_orgao_estagio,
       RECESSO_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO || '_' || ORGAO_ESTAGIO1.ID_UNIDADE_ORG  ID_ORGAO_GESTOR_ESTAGIO,
       to_char(RECESSO_ESTAGIO.dt_cadastro,'dd/mm/yyyy') dt_cadastro,
       to_char(RECESSO_ESTAGIO.dt_atualizacao,'dd/mm/yyyy')dt_atualizacao,
       RECESSO_ESTAGIO.id_usuario_cadastro,
       RECESSO_ESTAGIO.id_usuario_atualizacao,
       RECESSO_ESTAGIO.cs_situacao,
       to_char(RECESSO_ESTAGIO.dt_fim_vigencia_estagio,'dd/mm/yyyy') dt_fim_vigencia_estagio,
       to_char(RECESSO_ESTAGIO.dt_inicio_recesso,'dd/mm/yyyy') dt_inicio_recesso,
       to_char(RECESSO_ESTAGIO.dt_fim_recesso,'dd/mm/yyyy') dt_fim_recesso,
       RECESSO_ESTAGIO.nb_mes_referencia,
       RECESSO_ESTAGIO.nb_ano_referencia,
       RECESSO_ESTAGIO.dt_assinatura,
       RECESSO_ESTAGIO.tx_matricula,
       RECESSO_ESTAGIO.nb_dias_restantes,
       RECESSO_ESTAGIO.tx_chefia_imediata,
       RECESSO_ESTAGIO.cs_realizacao,
       USUARIO_ATUALIZACAO_fun.TX_FUNCIONARIO FUNCIONARIO_CADASTRO,
       USUARIO_CADASTRO_FUN.TX_FUNCIONARIO FUNCIONARIO_ATUALIZACAO,
       V_RESP_UNID_ORG.tx_nome TX_SECRETARIO_ORGAO_GESTOR,
       A.TX_FUNCIONARIO  TX_AGENTE_SETORIAL,
       ORGAO_ESTAGIO1.TX_ORGAO_ESTAGIO TX_ORGAO_SOLICITANTE,
       CONTRATO_ESTAGIO.TX_CODIGO TX_CONTRATO,
       CONTRATO_ESTAGIO.TX_TCE,
        case
         when CONTRATO_ESTAGIO.CS_TIPO = '1' then '1 - Contrato Inicial'
         when CONTRATO_ESTAGIO.CS_TIPO = '2' then '2 - Aditivo Contratual'
        end
        TX_TIPO_VAGA_ESTAGIO,

        TIPO_VAGA_ESTAGIO.TX_TIPO_VAGA_ESTAGIO TX_NIVEL,

      ORGAO_GESTOR_ESTAGIO.TX_ORGAO_GESTOR_ESTAGIO TX_ORGAO_GESTOR,
        case
         when CONTRATO_ESTAGIO.CS_PERIODO = '1' then '1 ano'
         when CONTRATO_ESTAGIO.CS_PERIODO = '2' then '2 ano'
         when CONTRATO_ESTAGIO.CS_PERIODO = '3' then '3 ano'
         when CONTRATO_ESTAGIO.CS_PERIODO = '4' then '4 ano'
         when CONTRATO_ESTAGIO.CS_PERIODO = '5' then '5 ano'
         when CONTRATO_ESTAGIO.CS_PERIODO = '6' then '1 periodo'
         when CONTRATO_ESTAGIO.CS_PERIODO = '7' then '2 periodo'
         when CONTRATO_ESTAGIO.CS_PERIODO = '8' then '3 periodo'
         when CONTRATO_ESTAGIO.CS_PERIODO = '9' then '4 periodo'
         when CONTRATO_ESTAGIO.CS_PERIODO = '10' then '5 periodo'
         when CONTRATO_ESTAGIO.CS_PERIODO = '11' then '6 periodo'
         when CONTRATO_ESTAGIO.CS_PERIODO = '12' then '7 periodo'
         when CONTRATO_ESTAGIO.CS_PERIODO = '13' then '8 periodo'
         when CONTRATO_ESTAGIO.CS_PERIODO = '14' then '9 periodo'
         when CONTRATO_ESTAGIO.CS_PERIODO = '15' then '10 periodo'
        end
        TX_PERIODO,
       V_ESTAGIARIO.TX_NOME TX_NOME_ESTAGIARIO,
       V_ESTAGIARIO.NB_CPF,
       AGENCIA_ESTAGIO.TX_AGENCIA_ESTAGIO,
        case
         when RECESSO_ESTAGIO.CS_SITUACAO = '2' then 'Fechado'
         when RECESSO_ESTAGIO.CS_SITUACAO = '1' then 'Aberto'
        end
        TX_SITUACAO,
        case
         when RECESSO_ESTAGIO.CS_REALIZACAO = '3' then '3 - Postergado Parcialmente'
         when RECESSO_ESTAGIO.CS_REALIZACAO = '2' then '2 - Postergado Totalmente'
         when RECESSO_ESTAGIO.CS_REALIZACAO = '1' then '1 - Realizado'
        end
        TX_REALIZACAO,
       CURSO_ESTAGIO.TX_CURSO_ESTAGIO,
       INSTITUICAO_ENSINO.TX_INSTITUICAO_ENSINO
  FROM RECESSO_ESTAGIO RECESSO_ESTAGIO


    , ORGAO_ESTAGIO ORGAO_ESTAGIO1
    , ORGAO_GESTOR_ESTAGIO ORGAO_GESTOR_ESTAGIO
    , CONTRATO_ESTAGIO CONTRATO_ESTAGIO
    , AGENCIA_ESTAGIO AGENCIA_ESTAGIO

    , V_ESTAGIARIO V_ESTAGIARIO

    , AGENTE_SETORIAL_ESTAGIO AGENTE_SETORIAL_ESTAGIO
    , CURSO_ESTAGIO CURSO_ESTAGIO

    , INSTITUICAO_ENSINO INSTITUICAO_ENSINO

    , USUARIO USUARIO_CADASTRO
    , USUARIO USUARIO_ATUALIZACAO
    , V_FUNCIONARIO_TOTAL USUARIO_CADASTRO_FUN
    , V_FUNCIONARIO_TOTAL USUARIO_ATUALIZACAO_fun

    , V_RESP_UNID_ORG

    ,V_FUNCIONARIO_TOTAl A
    , USUARIO B

    , TIPO_VAGA_ESTAGIO TIPO_VAGA_ESTAGIO

  WHERE
    RECESSO_ESTAGIO.ID_ORGAO_ESTAGIO = ORGAO_ESTAGIO1.ID_ORGAO_ESTAGIO

    AND RECESSO_ESTAGIO.ID_CONTRATO = CONTRATO_ESTAGIO.ID_CONTRATO

    AND CONTRATO_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO = ORGAO_GESTOR_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO

    AND RECESSO_ESTAGIO.ID_AGENCIA_ESTAGIO = AGENCIA_ESTAGIO.ID_AGENCIA_ESTAGIO

    AND CONTRATO_ESTAGIO.ID_PESSOA_ESTAGIARIO = V_ESTAGIARIO.ID_PESSOA_ESTAGIARIO

    AND RECESSO_ESTAGIO.ID_SETORIAL_ESTAGIO = AGENTE_SETORIAL_ESTAGIO.ID_SETORIAL_ESTAGIO


    AND CONTRATO_ESTAGIO.ID_CURSO_ESTAGIO = CURSO_ESTAGIO.ID_CURSO_ESTAGIO

    AND CONTRATO_ESTAGIO.ID_INSTITUICAO_ENSINO = INSTITUICAO_ENSINO.ID_INSTITUICAO_ENSINO

                    AND USUARIO_CADASTRO.ID_USUARIO                = RECESSO_ESTAGIO.ID_USUARIO_CADASTRO
                    AND USUARIO_CADASTRO.ID_PESSOA_FUNCIONARIO     = USUARIO_CADASTRO_FUN.ID_PESSOA_FUNCIONARIO
                    AND USUARIO_CADASTRO.ID_UNIDADE_GESTORA        = USUARIO_CADASTRO_FUN.ID_UNIDADE_GESTORA
                    AND USUARIO_ATUALIZACAO.ID_USUARIO             = CONTRATO_ESTAGIO.ID_USUARIO_ATUALIZACAO
                    AND USUARIO_ATUALIZACAO.ID_PESSOA_FUNCIONARIO  = USUARIO_ATUALIZACAO_fun.ID_PESSOA_FUNCIONARIO
                    AND USUARIO_ATUALIZACAO.ID_UNIDADE_GESTORA     = USUARIO_ATUALIZACAO_fun.ID_UNIDADE_GESTORA

                    AND AGENTE_SETORIAL_ESTAGIO.ID_USUARIO  =  B.ID_USUARIO
                    and A.ID_PESSOA_FUNCIONARIO=B.ID_PESSOA_FUNCIONARIO


                    AND   ORGAO_GESTOR_ESTAGIO.id_unidade_org  = V_RESP_UNID_ORG.id_unidade_org(+)

                    AND CONTRATO_ESTAGIO.CS_TIPO_VAGA_ESTAGIO    = TIPO_VAGA_ESTAGIO.CS_TIPO_VAGA_ESTAGIO


                AND RECESSO_ESTAGIO.ID_RECESSO_ESTAGIO=" . $VO->ID_RECESSO_ESTAGIO;

//echo $query;
        return $this->sqlVetor($query);
    }

    function alterar($VO) {

        $query = "update recesso_estagio
                  set
		      TX_CARGO_AGENTE= '" . $VO->TX_CARGO_AGENTE . "' ,
		      TX_EMAIL_AGENTE= '" . $VO->TX_EMAIL_AGENTE . "' ,
		      TX_TELEFONE_AGENTE= '" . $VO->TX_TELEFONE_AGENTE . "' ,
		      TX_JUSTIFICATIVA_ADIAMENTO= '" . $VO->TX_JUSTIFICATIVA_ADIAMENTO . "' ,
		      DT_ADIAMENTO =  to_date('" . $VO->DT_ADIAMENTO . "','dd/mm/yyyy'),
		      ID_SETORIAL_ESTAGIO= '" . $VO->ID_SETORIAL_ESTAGIO . "' ,
		      ID_AGENCIA_ESTAGIO= '" . $VO->ID_AGENCIA_ESTAGIO . "' ,
		      DT_ATUALIZACAO= SYSDATE  ,
		      ID_USUARIO_ATUALIZACAO= '" . $_SESSION['ID_USUARIO'] . "' ,
		      DT_INICIO_RECESSO=  to_date('" . $VO->DT_INICIO_RECESSO . "','dd/mm/yyyy'),
		      DT_FIM_RECESSO=     to_date('" . $VO->DT_FIM_RECESSO . "','dd/mm/yyyy'),
		      NB_MES_REFERENCIA= '" . $VO->NB_MES_REFERENCIA . "' ,
		      NB_ANO_REFERENCIA= '" . $VO->NB_ANO_REFERENCIA . "' ,
		      TX_CHEFIA_IMEDIATA= '" . $VO->TX_CHEFIA_IMEDIATA . "' ,
		      CS_REALIZACAO= " . $VO->CS_REALIZACAO . "
		   where
 			ID_RECESSO_ESTAGIO = " . $VO->ID_RECESSO_ESTAGIO;
//        print_r($query);
        return $this->sql($query);
    }

    function excluir($VO) {

        $query = "delete from recesso_estagio
                where ID_RECESSO_ESTAGIO = " . $VO->ID_RECESSO_ESTAGIO;

        return $this->sql($query);
    }

    function inserir($VO) {
        $codigoOrgaoGestor = explode('_', $VO->ID_ORGAO_GESTOR_ESTAGIO);

        $queryPK = "select SEMAD.F_G_PK_RECESSO_ESTAGIO as ID_RECESSO_ESTAGIO from DUAL";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();
        $query = "
       INSERT INTO RECESSO_ESTAGIO
       (ID_RECESSO_ESTAGIO,
       TX_CODIGO ,
       TX_CARGO_AGENTE,
       TX_EMAIL_AGENTE,
       TX_TELEFONE_AGENTE,
       DT_INICIO_VIG_ESTAGIO,
       DT_FIM_VIGENCIA_ESTAGIO,
       TX_JUSTIFICATIVA_ADIAMENTO,
       DT_ADIAMENTO ,
       ID_CONTRATO,
       ID_SETORIAL_ESTAGIO,
       ID_AGENCIA_ESTAGIO,
       ID_ORGAO_ESTAGIO,
       DT_CADASTRO,
       ID_USUARIO_CADASTRO,
       DT_ATUALIZACAO,
       ID_USUARIO_ATUALIZACAO,
       CS_SITUACAO,
       DT_INICIO_RECESSO,
       DT_FIM_RECESSO,
       NB_MES_REFERENCIA,
       NB_ANO_REFERENCIA,
       DT_ASSINATURA,
       TX_CHEFIA_IMEDIATA,
       CS_REALIZACAO,
       ID_ORGAO_GESTOR_ESTAGIO)

      values
      (" . $CodigoPK['ID_RECESSO_ESTAGIO'][0] . ",
	   SEMAD.F_G_COD_RECESSO_ESTAGIO(),
	   '" . $VO->TX_CARGO_AGENTE . "' ,
	   '" . $VO->TX_EMAIL_AGENTE . "' ,
	   '" . $VO->TX_TELEFONE_AGENTE . "' ,
            to_date('" . $VO->DT_INICIO_VIG_ESTAGIO . "','dd/mm/yyyy'),
            to_date('" . $VO->DT_FIM_VIGENCIA_ESTAGIO . "','dd/mm/yyyy'),
	   '" . $VO->TX_JUSTIFICATIVA_ADIAMENTO . "' ,
  	    to_date('" . $VO->DT_ADIAMENTO . "','dd/mm/yyyy'),
	    " . $VO->ID_CONTRATO . "  ,
	    " . $VO->ID_SETORIAL_ESTAGIO . ",
	    " . $VO->ID_AGENCIA_ESTAGIO . ",
	    " . $VO->ID_ORGAO_ESTAGIO . ",
	    SYSDATE  ,
	    " . $_SESSION['ID_USUARIO'] . " ,
	    SYSDATE  ,
	    " . $_SESSION['ID_USUARIO'] . " ,
             1 ,
	     to_date('" . $VO->DT_INICIO_RECESSO . "','dd/mm/yyyy'),
	     to_date('" . $VO->DT_FIM_RECESSO . "','dd/mm/yyyy'),
	     " . $VO->NB_MES_REFERENCIA . " ,
	      " . $VO->NB_ANO_REFERENCIA . " ,
	      SYSDATE,
	      '" . $VO->TX_CHEFIA_IMEDIATA . "' ,
	      " . $VO->CS_REALIZACAO . ",
                " . $codigoOrgaoGestor[0] . "
              )   ";

              
        $retorno = $this->sql($query);
//        echo $query;
        return $retorno ? '' : $CodigoPK['ID_RECESSO_ESTAGIO'][0];
    }

    function buscarSecretarioOrgaoGestor($VO) {

        $codigoOrgaoGestor = explode('_', $VO->ID_ORGAO_GESTOR_ESTAGIO);
        // fun��o responasvel o Secretario do org�o gestor
        // Fun��o utilizada no acaos.php
        $query = "select
                    FUNC.TX_FUNCIONARIO || RESP.id_unidade_org TX_FUNCIONARIO
					from
                    responsavel_unid_org resp, v_funcionario_total func
                  where
                    resp.id_pessoa_funcionario = func.id_pessoa_funcionario
                    and resp.id_unidade_gestora = func.id_unidade_gestora
                    and id_unidade_org =" . $codigoOrgaoGestor[1];
        // echo $query;
        return $this->sqlVetor($query);
    }

    function buscarOrgaoGestor($VO) {

        // Fun��o que pega todos os org�os Getores
        // Utilizada na Index chamada pelo arrays.php

        $query = "SELECT
                    ID_ORGAO_GESTOR_ESTAGIO ,
                    ID_ORGAO_GESTOR_ESTAGIO ||'_'||ID_UNIDADE_ORG CODIGO,
                    TX_ORGAO_GESTOR_ESTAGIO,
                    ID_UNIDADE_ORG
                  FROM
                    ORGAO_GESTOR_ESTAGIO";
        return $this->sqlVetor($query);
    }

}

?>
