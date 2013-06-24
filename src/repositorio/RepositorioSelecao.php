<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioSelecao extends Repositorio {

    function pesquisarSelecao_Estagio($VO) {

      $query = "SELECT SELECAO_ESTAGIO.ID_SELECAO_ESTAGIO, TO_CHAR(SELECAO_ESTAGIO.DT_CADASTRO,'DD/MM/YYYY  HH24:MI:SS') DT_CADASTRO, TO_CHAR(SELECAO_ESTAGIO.DT_ATUALIZACAO,'DD/MM/YYYY HH24:MI:SS') DT_ATUALIZACAO,
                TO_CHAR(SELECAO_ESTAGIO.DT_REALIZACAO,'DD/MM/YYYY') DT_REALIZACAO, SELECAO_ESTAGIO.ID_ORGAO_ESTAGIO, SELECAO_ESTAGIO.ID_USUARIO_CADASTRO, SELECAO_ESTAGIO.TX_COD_SELECAO, 
                SELECAO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO, SELECAO_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO, TO_CHAR(SELECAO_ESTAGIO.DT_AGENDAMENTO,'DD/MM/YYYY') DT_AGENDAMENTO, SELECAO_ESTAGIO.ID_USUARIO_ATUALIZACAO,
                ORGAO_ESTAGIO.TX_ORGAO_ESTAGIO, ORGAO_GESTOR_ESTAGIO.TX_ORGAO_GESTOR_ESTAGIO, RECRUTAMENTO_ESTAGIO.TX_COD_RECRUTAMENTO,
                V_FUNCIONARIO_TOTAL.TX_FUNCIONARIO TX_FUNCIONARIO_ALT, V_FUNCIONARIO_TOTAL1.TX_FUNCIONARIO AS TX_FUNCIONARIO_CAD, QUADRO_VAGAS_ESTAGIO.TX_CODIGO, DECODE(SELECAO_ESTAGIO.CS_SITUACAO,1,'ABERTA',2,'FECHADA') TX_SITUACAO, SELECAO_ESTAGIO.CS_SITUACAO
                
                FROM SEMAD.SELECAO_ESTAGIO, SEMAD.RECRUTAMENTO_ESTAGIO, SEMAD.ORGAO_GESTOR_ESTAGIO, SEMAD.USUARIO, SEMAD.USUARIO USUARIO1, SEMAD.ORGAO_ESTAGIO,
                SEMAD.V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL1, SEMAD.V_FUNCIONARIO_TOTAL, SEMAD.QUADRO_VAGAS_ESTAGIO
                
                WHERE RECRUTAMENTO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO = SELECAO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO
                AND ORGAO_GESTOR_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO   = SELECAO_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO
                AND USUARIO.ID_USUARIO                             = SELECAO_ESTAGIO.ID_USUARIO_ATUALIZACAO
                AND USUARIO1.ID_USUARIO                            = SELECAO_ESTAGIO.ID_USUARIO_CADASTRO
                AND ORGAO_ESTAGIO.ID_ORGAO_ESTAGIO                 = SELECAO_ESTAGIO.ID_ORGAO_ESTAGIO
                AND USUARIO1.ID_UNIDADE_GESTORA                    = V_FUNCIONARIO_TOTAL1.ID_UNIDADE_GESTORA
                AND USUARIO1.ID_PESSOA_FUNCIONARIO                 = V_FUNCIONARIO_TOTAL1.ID_PESSOA_FUNCIONARIO
                AND USUARIO.ID_PESSOA_FUNCIONARIO                  = V_FUNCIONARIO_TOTAL.ID_PESSOA_FUNCIONARIO
                AND USUARIO.ID_UNIDADE_GESTORA                     = V_FUNCIONARIO_TOTAL.ID_UNIDADE_GESTORA
                AND RECRUTAMENTO_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO   = QUADRO_VAGAS_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO
               ";

       $VO->ID_ORGAO_ESTAGIO ? $query .= " AND SELECAO_ESTAGIO.ID_ORGAO_ESTAGIO = " .$VO->ID_ORGAO_ESTAGIO."" : false;
       $VO->ID_ORGAO_GESTOR_ESTAGIO ? $query .= " AND SELECAO_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO = " .$VO->ID_ORGAO_GESTOR_ESTAGIO."" : false;                              
       $VO->TX_COD_SELECAO ? $query .= " AND UPPER(RECRUTAMENTO_ESTAGIO.TX_COD_SELECAO) LIKE UPPER('" .$VO->TX_COD_SELECAO."')" : false;
       $VO->CS_SITUACAO ? $query .= " AND SELECAO_ESTAGIO.CS_SITUACAO = ".$VO->CS_SITUACAO."" : false;
       $VO->ID_RECRUTAMENTO_ESTAGIO && empty($VO->ID_RECRUTAMENTO_ESTAGIO) ? $query .= " AND SELECAO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO = ".$VO->ID_RECRUTAMENTO_ESTAGIO."" : false;

       return $this->sqlVetor($query);
    }

    function buscarSelecao_Estagio($VO) {

      $query = "SELECT SELECAO_ESTAGIO.ID_SELECAO_ESTAGIO, TO_CHAR(SELECAO_ESTAGIO.DT_CADASTRO,'DD/MM/YYYY  HH24:MI:SS') DT_CADASTRO, TO_CHAR(SELECAO_ESTAGIO.DT_ATUALIZACAO,'DD/MM/YYYY HH24:MI:SS') DT_ATUALIZACAO,
                TO_CHAR(SELECAO_ESTAGIO.DT_REALIZACAO,'DD/MM/YYYY') DT_REALIZACAO, SELECAO_ESTAGIO.ID_ORGAO_ESTAGIO, SELECAO_ESTAGIO.ID_USUARIO_CADASTRO, SELECAO_ESTAGIO.TX_COD_SELECAO, 
                SELECAO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO, SELECAO_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO, TO_CHAR(SELECAO_ESTAGIO.DT_AGENDAMENTO,'DD/MM/YYYY') DT_AGENDAMENTO, SELECAO_ESTAGIO.ID_USUARIO_ATUALIZACAO,
                ORGAO_ESTAGIO.TX_ORGAO_ESTAGIO, ORGAO_GESTOR_ESTAGIO.TX_ORGAO_GESTOR_ESTAGIO, RECRUTAMENTO_ESTAGIO.TX_COD_RECRUTAMENTO,
                V_FUNCIONARIO_TOTAL.TX_FUNCIONARIO TX_FUNCIONARIO_ALT, V_FUNCIONARIO_TOTAL1.TX_FUNCIONARIO AS TX_FUNCIONARIO_CAD, QUADRO_VAGAS_ESTAGIO.TX_CODIGO, DECODE(SELECAO_ESTAGIO.CS_SITUACAO,1,'ABERTA',2,'FECHADA') TX_SITUACAO, SELECAO_ESTAGIO.CS_SITUACAO
                FROM SEMAD.SELECAO_ESTAGIO, SEMAD.RECRUTAMENTO_ESTAGIO, SEMAD.ORGAO_GESTOR_ESTAGIO, SEMAD.USUARIO, SEMAD.USUARIO USUARIO1, SEMAD.ORGAO_ESTAGIO,
                SEMAD.V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL1, SEMAD.V_FUNCIONARIO_TOTAL, SEMAD.QUADRO_VAGAS_ESTAGIO
                
                WHERE RECRUTAMENTO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO = SELECAO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO
                AND ORGAO_GESTOR_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO   = SELECAO_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO
                AND USUARIO.ID_USUARIO                             = SELECAO_ESTAGIO.ID_USUARIO_ATUALIZACAO
                AND USUARIO1.ID_USUARIO                            = SELECAO_ESTAGIO.ID_USUARIO_CADASTRO
                AND ORGAO_ESTAGIO.ID_ORGAO_ESTAGIO                 = SELECAO_ESTAGIO.ID_ORGAO_ESTAGIO
                AND USUARIO1.ID_UNIDADE_GESTORA                    = V_FUNCIONARIO_TOTAL1.ID_UNIDADE_GESTORA
                AND USUARIO1.ID_PESSOA_FUNCIONARIO                 = V_FUNCIONARIO_TOTAL1.ID_PESSOA_FUNCIONARIO
                AND USUARIO.ID_PESSOA_FUNCIONARIO                  = V_FUNCIONARIO_TOTAL.ID_PESSOA_FUNCIONARIO
                AND USUARIO.ID_UNIDADE_GESTORA                     = V_FUNCIONARIO_TOTAL.ID_UNIDADE_GESTORA
                AND RECRUTAMENTO_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO   = QUADRO_VAGAS_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO
               ";

       $VO->ID_SELECAO_ESTAGIO ? $query .= " AND SELECAO_ESTAGIO.ID_SELECAO_ESTAGIO = ".$VO->ID_SELECAO_ESTAGIO."" : false;               

       return $this->sqlVetor($query);
    }
        
    function buscarOrgaoGestor($VO) {

        // Função que pega todos os orgãos Getores
        // Utilizada na Index chamada pelo arrays.php

        $query = "SELECT 
                    ID_ORGAO_GESTOR_ESTAGIO,
                    ID_ORGAO_GESTOR_ESTAGIO CODIGO,
                    TX_ORGAO_GESTOR_ESTAGIO 
                FROM ORGAO_GESTOR_ESTAGIO";
        return $this->sqlVetor($query);
    }

    function buscarOrgaoSolicitante($VO) {

        // Função que pega todos os Orgãos Solicitantes a qual o Usuario pertence
        // Utilizada na Index chamada pelo arrays.php
        $query = "SELECT DISTINCT 
                    C.ID_ORGAO_ESTAGIO CODIGO,
                    C.TX_ORGAO_ESTAGIO,
                    C.ID_ORGAO_ESTAGIO 
                FROM 
                    AGENTE_SETORIAL_ESTAGIO A ,
                    ORGAO_AGENTE_SETORIAL B,
                    ORGAO_ESTAGIO C
                WHERE 
                    A.ID_SETORIAL_ESTAGIO = B.ID_SETORIAL_ESTAGIO
                    AND C.ID_ORGAO_ESTAGIO = B.ID_ORGAO_ESTAGIO
                    AND A.ID_USUARIO=" . $_SESSION['ID_USUARIO'];
        return $this->sqlVetor($query);
    }

    function buscarRecrutamento($VO) {

        $query = "SELECT RECRUTAMENTO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO CODIGO, TX_COD_RECRUTAMENTO 
                  FROM SEMAD.RECRUTAMENTO_ESTAGIO
                  WHERE CS_SITUACAO = 2
                  AND ID_ORGAO_ESTAGIO = ".$VO->ID_ORGAO_ESTAGIO;

        $query .= " ORDER BY TX_COD_RECRUTAMENTO";

        return $this->sqlVetor($query);
        
    }

    function inserir($VO) {

        $queryPK = "select SEMAD.F_G_PK_Selecao_Estagio as ID_SELECAO_ESTAGIO from DUAL";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "
            INSERT INTO SELECAO_ESTAGIO
            (ID_SELECAO_ESTAGIO,ID_ORGAO_GESTOR_ESTAGIO,ID_ORGAO_ESTAGIO,ID_RECRUTAMENTO_ESTAGIO,DT_AGENDAMENTO,DT_REALIZACAO,CS_SITUACAO,ID_USUARIO_ATUALIZACAO,ID_USUARIO_CADASTRO,DT_ATUALIZACAO,DT_CADASTRO,TX_COD_SELECAO)
            VALUES
    (" . $CodigoPK['ID_SELECAO_ESTAGIO'][0] . ", ".$VO->ID_ORGAO_GESTOR_ESTAGIO.", ".$VO->ID_ORGAO_ESTAGIO.", ".$VO->ID_RECRUTAMENTO_ESTAGIO.", TO_DATE('".$VO->DT_AGENDAMENTO."','DD/MM/YYYY'), TO_DATE('".$VO->DT_REALIZACAO.
    "','DD/MM/YYYY'),1,".$_SESSION['ID_USUARIO'].",".$_SESSION['ID_USUARIO'].",SYSDATE,SYSDATE,SEMAD.F_G_COD_SELECAO_ESTAGIO()) ";

        $retorno = $this->sql($query);
        return $retorno ? '' : $CodigoPK['ID_SELECAO_ESTAGIO'][0];
    }

    function alterar($VO) {

          $query = "update SELECAO_ESTAGIO set
                    ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_GESTOR_ESTAGIO . " ,
                    ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . " ,
                    ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO . " ,
                    DT_ATUALIZACAO = SYSDATE ,
                    ID_USUARIO_ATUALIZACAO =".$_SESSION['ID_USUARIO'].",
                    CS_SITUACAO = " . $VO->CS_SITUACAO . "
                    where
                    ID_SELECAO_ESTAGIO = " . $VO->ID_SELECAO_ESTAGIO;

          return $this->sql($query);
    }      

    function pesquisarCandidatos($VO) {

        $query = "SELECT                      
                  C.ID_RECRUTAMENTO_ESTAGIO || '_' || C.NB_VAGAS_RECRUTAMENTO  || '_' || C.NB_CANDIDATO CODIGO
                  ,D.TX_NOME
                  FROM                    
                  ESTAGIARIO_VAGA C,                      
                  V_ESTAGIARIO D,
                  RECRUTAMENTO_ESTAGIO R
                  WHERE C.ID_PESSOA_ESTAGIARIO = D.ID_PESSOA_ESTAGIARIO                     
                  AND C.ID_RECRUTAMENTO_ESTAGIO = R.ID_RECRUTAMENTO_ESTAGIO
                  AND C.CS_SITUACAO = 1
                  AND C.NB_CANDIDATO NOT IN (SELECT ESTAGIARIO_SELECAO.NB_CANDIDATO FROM ESTAGIARIO_SELECAO 
                                             WHERE ESTAGIARIO_SELECAO.ID_RECRUTAMENTO_ESTAGIO = C.ID_RECRUTAMENTO_ESTAGIO
                                            )
                  
                  AND C.ID_RECRUTAMENTO_ESTAGIO = " . $_SESSION['ID_RECRUTAMENTO_ESTAGIO'] . "                  
                 ";
               
        return $this->sqlVetor($query);
    }
    
    function pesquisar($VO) {

       $query = "SELECT ID_SELECAO_ESTAGIO, E.ID_RECRUTAMENTO_ESTAGIO, E.NB_VAGAS_RECRUTAMENTO, ID_USUARIO_SELECIONADOR, 
                 E.CS_SITUACAO, E.TX_MOTIVO_SITUACAO, U.ID_USUARIO, TO_CHAR(DT_AGENDAMENTO,'DD/MM/YYYY') DT_AGENDAMENTO, TO_CHAR(DT_REALIZACAO,'DD/MM/YYYY') DT_REALIZACAO, E.NB_CANDIDATO,D.TX_NOME,
                 DECODE(E.CS_SITUACAO,1,'EM ANÁLISE',2,'APROVADO',3,'REPROVADO',4,'CANCELADO') TX_SITUACAO, T.TX_TIPO_VAGA_ESTAGIO, Q.TX_CODIGO,
                 C.ID_RECRUTAMENTO_ESTAGIO || '_' || C.NB_VAGAS_RECRUTAMENTO  || '_' || C.NB_CANDIDATO ESTAGIARIO_SELECAO
                 FROM ESTAGIARIO_SELECAO E,
                 ESTAGIARIO_VAGA C,                      
                 V_ESTAGIARIO D,
                 RECRUTAMENTO_ESTAGIO R,
                 USUARIO U,
                 V_FUNCIONARIO_TOTAL V,
                 USUARIO U1,
                 V_FUNCIONARIO_TOTAL V1,
                 TIPO_VAGA_ESTAGIO T,
                 VAGAS_RECRUTAMENTO VR,
                 QUADRO_VAGAS_ESTAGIO Q
                 WHERE E.ID_RECRUTAMENTO_ESTAGIO = C.ID_RECRUTAMENTO_ESTAGIO
                 AND E.NB_VAGAS_RECRUTAMENTO = C.NB_VAGAS_RECRUTAMENTO
                 AND E.NB_CANDIDATO = C.NB_CANDIDATO
                 AND C.ID_PESSOA_ESTAGIARIO = D.ID_PESSOA_ESTAGIARIO                     
                 AND C.ID_RECRUTAMENTO_ESTAGIO = R.ID_RECRUTAMENTO_ESTAGIO
                 AND C.CS_SITUACAO = 1        
                 AND E.ID_USUARIO_SELECIONADOR = U.ID_USUARIO
                 AND U.ID_UNIDADE_GESTORA                    = V.ID_UNIDADE_GESTORA
                 AND U.ID_PESSOA_FUNCIONARIO                 = V.ID_PESSOA_FUNCIONARIO
                 AND E.ID_USUARIO = U1.ID_USUARIO
                 AND U1.ID_UNIDADE_GESTORA                    = V1.ID_UNIDADE_GESTORA
                 AND U1.ID_PESSOA_FUNCIONARIO                 = V1.ID_PESSOA_FUNCIONARIO
                 AND C.ID_RECRUTAMENTO_ESTAGIO = VR.ID_RECRUTAMENTO_ESTAGIO
                 AND C.NB_VAGAS_RECRUTAMENTO = VR.NB_VAGAS_RECRUTAMENTO
                 AND VR.CS_TIPO_VAGA_ESTAGIO = T.CS_TIPO_VAGA_ESTAGIO
                 AND R.ID_QUADRO_VAGAS_ESTAGIO = Q.ID_QUADRO_VAGAS_ESTAGIO
               ";

       $query .= " AND E.ID_SELECAO_ESTAGIO = " . $_SESSION[ID_SELECAO_ESTAGIO];        

//        $query .= " ORDER BY A.TX_FUNCIONARIO";


        if ($VO->Reg_quantidade){
            !$VO->Reg_inicio? $VO->Reg_inicio = 0: false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (".$query.") PAGING WHERE (ROWNUM <= ".($VO->Reg_quantidade+$VO->Reg_inicio)."))  WHERE (PAGING_RN > ".$VO->Reg_inicio.")";
        }
        
        return $this->sqlVetor($query);
    }


    function buscar($VO) {

       $query = "SELECT ID_SELECAO_ESTAGIO, E.ID_RECRUTAMENTO_ESTAGIO, E.NB_VAGAS_RECRUTAMENTO, ID_USUARIO_SELECIONADOR, 
                 E.CS_SITUACAO, E.TX_MOTIVO_SITUACAO, U.ID_USUARIO, TO_CHAR(DT_AGENDAMENTO,'DD/MM/YYYY') DT_AGENDAMENTO, TO_CHAR(DT_REALIZACAO,'DD/MM/YYYY') DT_REALIZACAO, E.NB_CANDIDATO,D.TX_NOME,
                 DECODE(E.CS_SITUACAO,1,'EM ANÁLISE',2,'APROVADO',3,'REPROVADO',4,'CANCELADO') TX_SITUACAO, T.TX_TIPO_VAGA_ESTAGIO, Q.TX_CODIGO,
                 C.ID_RECRUTAMENTO_ESTAGIO || '_' || C.NB_VAGAS_RECRUTAMENTO  || '_' || C.NB_CANDIDATO ESTAGIARIO_SELECAO
                 FROM ESTAGIARIO_SELECAO E,
                 ESTAGIARIO_VAGA C,                      
                 V_ESTAGIARIO D,
                 RECRUTAMENTO_ESTAGIO R,
                 USUARIO U,
                 V_FUNCIONARIO_TOTAL V,
                 USUARIO U1,
                 V_FUNCIONARIO_TOTAL V1,
                 TIPO_VAGA_ESTAGIO T,
                 VAGAS_RECRUTAMENTO VR,
                 QUADRO_VAGAS_ESTAGIO Q
                 WHERE E.ID_RECRUTAMENTO_ESTAGIO = C.ID_RECRUTAMENTO_ESTAGIO
                 AND E.NB_VAGAS_RECRUTAMENTO = C.NB_VAGAS_RECRUTAMENTO
                 AND E.NB_CANDIDATO = C.NB_CANDIDATO
                 AND C.ID_PESSOA_ESTAGIARIO = D.ID_PESSOA_ESTAGIARIO                     
                 AND C.ID_RECRUTAMENTO_ESTAGIO = R.ID_RECRUTAMENTO_ESTAGIO
                 AND C.CS_SITUACAO = 1        
                 AND E.ID_USUARIO_SELECIONADOR = U.ID_USUARIO
                 AND U.ID_UNIDADE_GESTORA                    = V.ID_UNIDADE_GESTORA
                 AND U.ID_PESSOA_FUNCIONARIO                 = V.ID_PESSOA_FUNCIONARIO
                 AND E.ID_USUARIO = U1.ID_USUARIO
                 AND U1.ID_UNIDADE_GESTORA                    = V1.ID_UNIDADE_GESTORA
                 AND U1.ID_PESSOA_FUNCIONARIO                 = V1.ID_PESSOA_FUNCIONARIO
                 AND C.ID_RECRUTAMENTO_ESTAGIO = VR.ID_RECRUTAMENTO_ESTAGIO
                 AND C.NB_VAGAS_RECRUTAMENTO = VR.NB_VAGAS_RECRUTAMENTO
                 AND VR.NB_VAGAS_RECRUTAMENTO = T.CS_TIPO_VAGA_ESTAGIO
                 AND R.ID_QUADRO_VAGAS_ESTAGIO = Q.ID_QUADRO_VAGAS_ESTAGIO
                 AND E.ID_SELECAO_ESTAGIO = ".$_SESSION[ID_SELECAO_ESTAGIO]."
                 AND E.NB_CANDIDATO = ".$VO->NB_CANDIDATO."
                 AND E.NB_VAGAS_RECRUTAMENTO = ".$VO->NB_VAGAS_RECRUTAMENTO."
                 AND E.ID_RECRUTAMENTO_ESTAGIO = ".$VO->ID_RECRUTAMENTO_ESTAGIO."
               ";

        return $this->sqlVetor($query);
                
    }
    
      function inserirCandidato($VO) {

          $query = "INSERT INTO ESTAGIARIO_SELECAO
                    (ID_SELECAO_ESTAGIO, ID_RECRUTAMENTO_ESTAGIO, NB_VAGAS_RECRUTAMENTO, ID_USUARIO_SELECIONADOR, 
                    CS_SITUACAO, TX_MOTIVO_SITUACAO, ID_USUARIO, DT_AGENDAMENTO, DT_REALIZACAO, NB_CANDIDATO)
                    VALUES
                    (".$_SESSION[ID_SELECAO_ESTAGIO].", ".$VO->ID_RECRUTAMENTO_ESTAGIO.", ".$VO->NB_VAGAS_RECRUTAMENTO.", ".$_SESSION['ID_USUARIO'].", 
                    ".$VO->CS_SITUACAO.", '".$VO->TX_MOTIVO_SITUACAO."', ".$_SESSION['ID_USUARIO'].", TO_DATE('".$VO->DT_AGENDAMENTO."','DD/MM/YYYY'), TO_DATE('".$VO->DT_REALIZACAO."','DD/MM/YYYY'), ".$VO->NB_CANDIDATO.")
                   ";

          return $this->sql($query);

     }

      function atualizarInf($VO) {

          $query = "UPDATE SELECAO_ESTAGIO SET
              DT_ATUALIZACAO = SYSDATE,
              ID_USUARIO_ATUALIZACAO = ".$_SESSION['ID_USUARIO'];
              $VO->EFETIVAR ? $query .= " ,CS_SITUACAO = 2 " : false;              
              $query .= "WHERE ID_SELECAO_ESTAGIO = " . $_SESSION[ID_SELECAO_ESTAGIO];

          $this->sql($query);

          $data = "SELECT TO_CHAR(SELECAO_ESTAGIO.DT_ATUALIZACAO,'DD/MM/YYYY HH24:MI:SS') DT_ATUALIZACAO,
                  V_FUNCIONARIO_TOTAL.TX_FUNCIONARIO TX_FUNCIONARIO_ALT, DECODE(SELECAO_ESTAGIO.CS_SITUACAO,1,'ABERTA',2,'FECHADA') TX_SITUACAO               
                  FROM SEMAD.SELECAO_ESTAGIO, SEMAD.RECRUTAMENTO_ESTAGIO, SEMAD.USUARIO,SEMAD.V_FUNCIONARIO_TOTAL                
                  WHERE RECRUTAMENTO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO = SELECAO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO
                  AND USUARIO.ID_USUARIO                             = SELECAO_ESTAGIO.ID_USUARIO_ATUALIZACAO
                  AND USUARIO.ID_PESSOA_FUNCIONARIO                  = V_FUNCIONARIO_TOTAL.ID_PESSOA_FUNCIONARIO
                  AND USUARIO.ID_UNIDADE_GESTORA                     = V_FUNCIONARIO_TOTAL.ID_UNIDADE_GESTORA
                  AND ID_SELECAO_ESTAGIO = " . $_SESSION[ID_SELECAO_ESTAGIO];
    
          $this->sqlVetor($data);
          $datahora = $this->getVetor();

          return $datahora;
              
      }

      function excluirCandidato($VO) {

          $query = "
              DELETE FROM ESTAGIARIO_SELECAO
              WHERE ID_SELECAO_ESTAGIO = " . $VO->ID_SELECAO_ESTAGIO . "
              and ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO ."
              AND NB_VAGAS_RECRUTAMENTO = " . $VO->NB_VAGAS_RECRUTAMENTO . "
              and NB_CANDIDATO = " . $VO->NB_CANDIDATO ;
    
          return $this->sql($query);
      }     

      function excluir($VO) {

          $query = "
              DELETE FROM SELECAO_ESTAGIO
              WHERE ID_SELECAO_ESTAGIO = " . $VO->ID_SELECAO_ESTAGIO;
        
          return $this->sql($query);
      }

    function alterarCandidato($VO) {

          $query = "UPDATE ESTAGIARIO_SELECAO SET
                    CS_SITUACAO = " . $VO->CS_SITUACAO . " ,
                    TX_MOTIVO_SITUACAO = '" . $VO->TX_MOTIVO_SITUACAO . "' ,
                    ID_USUARIO_SELECIONADOR = ".$_SESSION['ID_USUARIO'].",
                    DT_AGENDAMENTO = TO_DATE('" . $VO->DT_AGENDAMENTO . "','DD/MM/YYYY') ,
                    DT_REALIZACAO = TO_DATE('" . $VO->DT_REALIZACAO . "','DD/MM/YYYY')
                    WHERE ID_SELECAO_ESTAGIO = " . $VO->ID_SELECAO_ESTAGIO . "
                    AND ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO ."
                    AND NB_VAGAS_RECRUTAMENTO = " . $VO->NB_VAGAS_RECRUTAMENTO . "
                    AND NB_CANDIDATO = " . $VO->NB_CANDIDATO ;

          return $this->sql($query);
    }      

    function efetivar($VO) {

        $query = "
                    SELECT (ESTAGIARIO_SELECAO.ID_SELECAO_ESTAGIO) CONTADOR FROM ESTAGIARIO_SELECAO
                    WHERE CS_SITUACAO = 1
                    AND ID_SELECAO_ESTAGIO = " . $VO->ID_SELECAO_ESTAGIO . "
                    AND ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO ."
                ";

        return $this->sqlVetor($query);
          
    }      
    
    
}

?>