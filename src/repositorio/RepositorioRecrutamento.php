<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioRecrutamento extends Repositorio {

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

       // $VO->ID_USUARIO ? $query .= " AND V_PERFIL_USUARIO.ID_USUARIO = " . $VO->ID_USUARIO : false;

        return $this->sqlVetor($query);
    }

    function pesquisarEstagiario($VO) {

        $query = "SELECT V_ESTAGIARIO.NB_CPF CODIGO, V_ESTAGIARIO.NB_CPF  ,  V_ESTAGIARIO.TX_NOME FROM V_ESTAGIARIO";
		if ($VO->NB_CPF) $query.= ' WHERE V_ESTAGIARIO.NB_CPF = '.$VO->NB_CPF;


        return $this->sqlVetor($query);
    }


  
    function pesquisar($VO) {

        $query = "          SELECT RECRUTAMENTO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO, 
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

        ($VO->ID_ORGAO_ESTAGIO) ? $query .= " AND RECRUTAMENTO_ESTAGIO.ID_ORGAO_ESTAGIO = ".$VO->ID_ORGAO_ESTAGIO : false;
        ($VO->ID_ORGAO_GESTOR_ESTAGIO)   ? $query .= " AND QUADRO_VAGAS_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO  = ".$VO->ID_ORGAO_GESTOR_ESTAGIO : false;
        ($VO->ID_QUADRO_VAGAS_ESTAGIO)   ? $query .= " AND RECRUTAMENTO_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO = ".$VO->ID_QUADRO_VAGAS_ESTAGIO : false;
        ($VO->TX_COD_RECRUTAMENTO)   ? $query .= " AND RECRUTAMENTO_ESTAGIO.TX_COD_RECRUTAMENTO = '".$VO->TX_COD_RECRUTAMENTO."'" : false;
		
		
		


        $query .= " ORDER BY RECRUTAMENTO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }
 
       // echo $query;
        return $this->sqlVetor($query);
    }

    function inserir($VO) {

        $queryPK = "select SEMAD.F_G_PK_RECRUTAMENTO_ESTAGIO as ID_RECRUTAMENTO_ESTAGIO from DUAL";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "
            INSERT INTO RECRUTAMENTO_ESTAGIO
            (ID_RECRUTAMENTO_ESTAGIO,DT_CADASTRO,DT_ATUALIZACAO, ID_USUARIO_CADASTRO,ID_USUARIO_ATUALIZACAO,ID_ORGAO_ESTAGIO, ID_QUADRO_VAGAS_ESTAGIO, TX_DOC_AUTORIZACAO, TX_MOTIVO, TX_COD_RECRUTAMENTO, CS_SITUACAO)
            VALUES
	(" . $CodigoPK['ID_RECRUTAMENTO_ESTAGIO'][0] . ", SYSDATE, SYSDATE," . $_SESSION['ID_USUARIO'] . "," . $_SESSION['ID_USUARIO'] . ",".$VO->ID_ORGAO_ESTAGIO."," .$VO->ID_QUADRO_VAGAS_ESTAGIO.", '".$VO->TX_DOC_AUTORIZACAO."', '".$VO->TX_MOTIVO."', SEMAD.F_G_COD_RECRUTAMENTO_ESTAGIO() , 2) ";

    //    print_r($query);

        $retorno = $this->sql($query);
        return $retorno ? '' : $CodigoPK['ID_RECRUTAMENTO_ESTAGIO'][0];
    }

    function buscar($VO) {

        $query = "
		
		
		   
 SELECT RECRUTAMENTO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO, 
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

  AND	
    RECRUTAMENTO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO;


        return $this->sqlVetor($query);
    }

    function buscarRecrutamento($VO) {

        $query = "
		
		    SELECT RECRUTAMENTO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO, 
        VAGAS_RECRUTAMENTO.ID_ORGAO_ESTAGIO ID_ORGAO_ESTAGIO_GEST,
        RECRUTAMENTO_ESTAGIO.ID_ORGAO_ESTAGIO ID_ORGAO_ESTAGIO,

       TO_CHAR(RECRUTAMENTO_ESTAGIO.DT_ATUALIZACAO,'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
       TO_CHAR(RECRUTAMENTO_ESTAGIO.DT_CADASTRO,'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,

       RECRUTAMENTO_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO, RECRUTAMENTO_ESTAGIO.ID_ORGAO_ESTAGIO,
       
       RECRUTAMENTO_ESTAGIO.ID_USUARIO_CADASTRO, RECRUTAMENTO_ESTAGIO.ID_USUARIO_ATUALIZACAO,
       
       
       RECRUTAMENTO_ESTAGIO.TX_DOC_AUTORIZACAO, RECRUTAMENTO_ESTAGIO.TX_MOTIVO, RECRUTAMENTO_ESTAGIO.TX_COD_RECRUTAMENTO,
       VAGAS_RECRUTAMENTO.TX_DOC_AUTORIZACAO TX_QUADRO_VAGAS,
       V_FUNCIONARIO_TOTAL1.TX_FUNCIONARIO CADASTRADOPOR,
       V_FUNCIONARIO_TOTAL2.TX_FUNCIONARIO ALTERADOPOR,
       
       ORGAO_ESTAGIO1.TX_ORGAO_ESTAGIO TX_ORGAO_SOLICITANTE, 
       
       ORGAO_ESTAGIO2.TX_ORGAO_ESTAGIO TX_ORGAO_GESTOR ,
       
       RECRUTAMENTO_ESTAGIO.CS_SITUACAO ,
       
        case
         when RECRUTAMENTO_ESTAGIO.CS_SITUACAO = '2' then 'Desativado' 
         when RECRUTAMENTO_ESTAGIO.CS_SITUACAO = '1' then 'Ativado'
        end 
        TX_SITUACAO


  FROM RECRUTAMENTO_ESTAGIO RECRUTAMENTO_ESTAGIO , VAGAS_RECRUTAMENTO VAGAS_RECRUTAMENTO, USUARIO USUARIO1, USUARIO USUARIO2,
  V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL1, V_FUNCIONARIO_TOTAL V_FUNCIONARIO_TOTAL2, ORGAO_ESTAGIO ORGAO_ESTAGIO1, ORGAO_ESTAGIO ORGAO_ESTAGIO2,
  QUADRO_VAGAS_ESTAGIO QUADRO_VAGAS_ESTAGIO
  
  WHERE 
  
  RECRUTAMENTO_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO   = VAGAS_RECRUTAMENTO.ID_QUADRO_VAGAS_ESTAGIO 
 
  AND 
    RECRUTAMENTO_ESTAGIO.ID_ORGAO_ESTAGIO = ORGAO_ESTAGIO1.ID_ORGAO_ESTAGIO

  AND 
    VAGAS_RECRUTAMENTO.ID_ORGAO_ESTAGIO = ORGAO_ESTAGIO2.ID_ORGAO_ESTAGIO


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
	
  AND 
      RECRUTAMENTO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO;

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }
 // echo $query;
 return $this->sqlVetor($query);
    }


 function buscarVaga($VO) {

        $query = "
		
		select 
       ORGAO_ESTAGIO1.TX_ORGAO_ESTAGIO TX_ORGAO_SOLICITANTE, 
       
       ORGAO_ESTAGIO2.TX_ORGAO_ESTAGIO TX_ORGAO_GESTOR ,
       
       
       RECRUTAMENTO_ESTAGIO.TX_DOC_AUTORIZACAO TX_QUADRO_VAGAS,
       
       TIPO_VAGA_ESTAGIO.TX_TIPO_VAGA_ESTAGIO  ,
       
     
       
       VAGAS_RECRUTAMENTO.NB_QUANTIDADE,
       
       VAGAS_RECRUTAMENTO.NB_VAGAS_RECRUTAMENTO,
       
       VAGAS_RECRUTAMENTO.ID_RECRUTAMENTO_ESTAGIO


 from VAGAS_RECRUTAMENTO VAGAS_RECRUTAMENTO,
      TIPO_VAGA_ESTAGIO TIPO_VAGA_ESTAGIO,
        ORGAO_ESTAGIO ORGAO_ESTAGIO1, 
        ORGAO_ESTAGIO ORGAO_ESTAGIO2,
        QUADRO_VAGAS_ESTAGIO QUADRO_VAGAS_ESTAGIO,
        RECRUTAMENTO_ESTAGIO RECRUTAMENTO_ESTAGIO

 where
  VAGAS_RECRUTAMENTO.CS_TIPO_VAGA_ESTAGIO =  TIPO_VAGA_ESTAGIO.CS_TIPO_VAGA_ESTAGIO

 AND 
   VAGAS_RECRUTAMENTO.ID_QUADRO_VAGAS_ESTAGIO =  QUADRO_VAGAS_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO
   
 AND 
    VAGAS_RECRUTAMENTO.ID_ORGAO_ESTAGIO = ORGAO_ESTAGIO1.ID_ORGAO_ESTAGIO
AND
  VAGAS_RECRUTAMENTO.ID_QUADRO_VAGAS_ESTAGIO  = RECRUTAMENTO_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO 

AND 

 QUADRO_VAGAS_ESTAGIO.ID_ORGAO_GESTOR_ESTAGIO = ORGAO_ESTAGIO2.ID_ORGAO_ESTAGIO

AND
      RECRUTAMENTO_ESTAGIO.ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO;

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }
  // echo $query;
 return $this->sqlVetor($query);
    }



 function buscarCandidato($VO) {

        $query = "
		   select 
        ESTAGIARIO_VAGA.ID_RECRUTAMENTO_ESTAGIO, ESTAGIARIO_VAGA.NB_VAGAS_RECRUTAMENTO, ESTAGIARIO_VAGA.NB_CANDIDATO, 
       
        ESTAGIARIO_VAGA.CS_SITUACAO, ESTAGIARIO_VAGA.TX_MOTIVO_SITUACAO, ESTAGIARIO_VAGA.ID_PESSOA_ESTAGIARIO, 
		
		
        case
         when ESTAGIARIO_VAGA.CS_SITUACAO = '1' then 'Em An�lise' 
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

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }
  //echo $query;
 return $this->sqlVetor($query);
    }
        function pesquisarOrgaoGestor($VO) {

        $query = "SELECT TX_ORGAO_ESTAGIO,
            ID_ORGAO_ESTAGIO ID_ORGAO_GESTOR,
            ID_ORGAO_ESTAGIO CODIGO

            from ORGAO_ESTAGIO ORDER BY TX_ORGAO_ESTAGIO";

        return $this->sqlVetor($query);
    }

    function pesquisarTipoVagaEstagio($VO) {
	   $recrutamento = "SELECT ID_QUADRO_VAGAS_ESTAGIO , ID_ORGAO_ESTAGIO 
      FROM RECRUTAMENTO_ESTAGIO      
      WHERE  ID_RECRUTAMENTO_ESTAGIO = " .$_SESSION['ID_RECRUTAMENTO_ESTAGIO'];
	  //echo "recrutamento:".$recrutamento;
      $this->sqlVetor($recrutamento);
      $CodRecrutamento = $this->getVetor();

      $query = "SELECT VAGAS_ESTAGIO.CS_TIPO_VAGA_ESTAGIO CODIGO,
            QUADRO_VAGAS_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO,  TIPO_VAGA_ESTAGIO.TX_TIPO_VAGA_ESTAGIO

            from QUADRO_VAGAS_ESTAGIO QUADRO_VAGAS_ESTAGIO, VAGAS_ESTAGIO VAGAS_ESTAGIO, TIPO_VAGA_ESTAGIO TIPO_VAGA_ESTAGIO
     

  WHERE
      QUADRO_VAGAS_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO  = VAGAS_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO 
     AND
      VAGAS_ESTAGIO.CS_TIPO_VAGA_ESTAGIO  =  TIPO_VAGA_ESTAGIO.CS_TIPO_VAGA_ESTAGIO
     AND 
      VAGAS_ESTAGIO.ID_QUADRO_VAGAS_ESTAGIO = ". $CodRecrutamento['ID_QUADRO_VAGAS_ESTAGIO'][0]."
     AND 
      VAGAS_ESTAGIO.ID_ORGAO_ESTAGIO = ". $CodRecrutamento['ID_ORGAO_ESTAGIO'][0];
	  
	//   echo "query". $query;

        return $this->sqlVetor($query);
    }
	
    function pesquisarOrgaoSolicitante($VO) {

        $query = "SELECT TX_ORGAO_ESTAGIO,
            ID_ORGAO_ESTAGIO ID_ORGAO_SOLICITANTE,
            ID_ORGAO_ESTAGIO CODIGO

            from ORGAO_ESTAGIO ORDER BY TX_ORGAO_ESTAGIO";

        return $this->sqlVetor($query);
    }

    function pesquisarQuadroVagas($VO) {
     
	  
	  
        $query = "SELECT TX_CODIGO,
            ID_QUADRO_VAGAS_ESTAGIO,
            ID_QUADRO_VAGAS_ESTAGIO CODIGO

            from QUADRO_VAGAS_ESTAGIO ORDER BY ID_QUADRO_VAGAS_ESTAGIO DESC";

        return $this->sqlVetor($query);
    }


   
      function inserirVaga($VO) {
      $queryPK = "select SEMAD.F_G_PK_VAGAS_RECRUTAMENTO(". $VO->ID_RECRUTAMENTO_ESTAGIO.") as NB_VAGAS_RECRUTAMENTO from DUAL";
      $this->sqlVetor($queryPK);
      $CodigoPK = $this->getVetor();

      $recrutamento = "SELECT ID_QUADRO_VAGAS_ESTAGIO , ID_ORGAO_ESTAGIO 
      FROM RECRUTAMENTO_ESTAGIO      
      WHERE  ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO;
      $this->sqlVetor($recrutamento);
      $CodRecrutamento = $this->getVetor();
	  
	  
      $query = "
      INSERT INTO VAGAS_RECRUTAMENTO  (ID_QUADRO_VAGAS_ESTAGIO, NB_QUANTIDADE, ID_RECRUTAMENTO_ESTAGIO, NB_VAGAS_RECRUTAMENTO,ID_ORGAO_ESTAGIO, CS_TIPO_VAGA_ESTAGIO )
      values
      (" . $CodRecrutamento['ID_QUADRO_VAGAS_ESTAGIO'][0]. ", " . $VO->NB_QUANTIDADE . ", " . $VO->ID_RECRUTAMENTO_ESTAGIO . "," . $CodigoPK['NB_VAGAS_RECRUTAMENTO'][0] . ",
	   
	   " .$CodRecrutamento['ID_ORGAO_ESTAGIO'][0].   "," . $VO->CS_TIPO_VAGA_ESTAGIO . ")   ";

//      echo $query;
	
      return // $this->sql($query);
	  
	  $retorno = $this->sql($query);
        return $retorno ? '' : $CodigoPK['NB_VAGAS_RECRUTAMENTO'][0];
     }


      function atualizarInf($VO) {
 
      $query = "update RECRUTAMENTO_ESTAGIO set
      DT_ATUALIZACAO = sysdate,
      id_usuario_atualizacao = ".$_SESSION['ID_USUARIO']."
      where
      ID_RECRUTAMENTO_ESTAGIO =" . $VO->ID_RECRUTAMENTO_ESTAGIO ;

      $this->sql($query);

      $data = "SELECT TO_CHAR(RECRUTAMENTO_ESTAGIO.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') AS DT_ATUALIZACAO
      FROM RECRUTAMENTO_ESTAGIO      
      WHERE    ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO;

      $this->sqlVetor($data);
      $datahora = $this->getVetor();

      return $datahora;
      }

      function excluirVaga($VO) {

      $query = "
      delete from  VAGAS_RECRUTAMENTO
      where ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO . "
      and NB_VAGAS_RECRUTAMENTO     = " . $VO->NB_VAGAS_RECRUTAMENTO ;
      // print_r($query);
      return $this->sql($query);
      }

    function excluirCandidato($VO) {

      $query = "
      delete from  ESTAGIARIO_VAGA
      where ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO . "
      and NB_VAGAS_RECRUTAMENTO     = " . $VO->NB_VAGAS_RECRUTAMENTO. "
	  and NB_CANDIDATO              = " . $VO->NB_CANDIDATO;
      // print_r($query);
      return $this->sql($query);
      }
	  

      function alterar($VO) {

      $query = "update RECRUTAMENTO_ESTAGIO set
      DT_ATUALIZACAO = SYSDATE ,
      ID_USUARIO_ATUALIZACAO =".$_SESSION['ID_USUARIO'].",
      ID_QUADRO_VAGAS_ESTAGIO =".$VO->ID_QUADRO_VAGAS_ESTAGIO.",
      ID_ORGAO_ESTAGIO       =".$VO->ID_ORGAO_ESTAGIO.",
      TX_DOC_AUTORIZACAO     ='".$VO->TX_DOC_AUTORIZACAO."',
      TX_MOTIVO              ='".$VO->TX_MOTIVO."'
 
	  
     where ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO;
//      and NB_VAGAS_RECRUTAMENTO     = " . $VO->NB_VAGAS_RECRUTAMENTO ;

    //  print_r($query);
      return $this->sql($query);
      }

    function alterarVaga($VO) {

      $query = "update VAGAS_RECRUTAMENTO set
      NB_QUANTIDADE              =".$VO->NB_QUANTIDADE."
 
	  
     where ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO."
     and NB_VAGAS_RECRUTAMENTO     = " . $VO->NB_VAGAS_RECRUTAMENTO ;

      return $this->sql($query);
      }
	  
	  
      function efetivar($VO) {

      $query = "update RECRUTAMENTO_ESTAGIO set
      CS_SITUACAO = 1 ".
 
	  
     " where ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO;
    //  print_r($query);
      return $this->sql($query);
      }
	  

      function excluir($VO) {

      $query = "
      delete from RECRUTAMENTO_ESTAGIO
      where ID_RECRUTAMENTO_ESTAGIO = " . $VO->ID_RECRUTAMENTO_ESTAGIO . "
      ";

      return $this->sql($query);
      }
    



    function inserirCandidato($VO) {
      $queryPK = "select SEMAD.F_G_PK_ESTAGIARIO_VAGA(". $VO->ID_RECRUTAMENTO_ESTAGIO.", ". $VO->NB_VAGAS_RECRUTAMENTO." ) as NB_CANDIDATO from DUAL";
      $this->sqlVetor($queryPK);
      $CodigoPK = $this->getVetor();

      $estagiario = "SELECT ID_PESSOA_ESTAGIARIO 
      FROM V_ESTAGIARIO
      WHERE  NB_CPF  = '" . $VO->NB_CPF."'";
      // echo $estagiario;
      $this->sqlVetor($estagiario);
      $CodEstagiario = $this->getVetor();
	  
	  
      $query = "
      INSERT INTO ESTAGIARIO_VAGA  (ID_PESSOA_ESTAGIARIO, NB_VAGAS_RECRUTAMENTO, ID_RECRUTAMENTO_ESTAGIO, CS_SITUACAO ,  NB_CANDIDATO )
      values
      (" . $CodEstagiario['ID_PESSOA_ESTAGIARIO'][0]. ", " . $VO->NB_VAGAS_RECRUTAMENTO . ", " . $VO->ID_RECRUTAMENTO_ESTAGIO . ",1, " . $CodigoPK['NB_CANDIDATO'][0] . ")   ";

	  return $this->sql($query);
     }
}

?>