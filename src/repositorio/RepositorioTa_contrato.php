<?php
require_once $path . "src/repositorio/Repositorio.php";

class RepositorioTa_contrato extends Repositorio {
//---------PESQUISA ORGAO GESTOR------------------------------------------------
    function pesquisarOrgaoGestor($VO) {
        $query = "
            select oge.ID_ORGAO_GESTOR_ESTAGIO CODIGO,
                   oge.TX_ORGAO_GESTOR_ESTAGIO
                  from ORGAO_GESTOR_ESTAGIO oge
              order by TX_ORGAO_GESTOR_ESTAGIO
        ";
        return $this->sqlVetor($query);
    }
    
//-----------------PESQUISA CODIGO DO CONTRATO----------------------------------
    function pesquisarCodigoContrato($VO) {
        $query = "
            SELECT ID_CONTRATO_CP CODIGO,
                   NB_CODIGO
              FROM CONTRATO_CP
          ORDER BY ID_CONTRATO_CP
        ";
        return $this->sqlVetor($query);
    }
    
//-------------------PESQUISA TERMO ADITIVO-------------------------------------
    function pesquisarCodTermoAditivo($VO) {
        $query = "
            SELECT  ID_ADITIVO_CONTRATO_CP CODIGO,
                    NB_CODIGO 
               FROM ADITIVO_CONTRATO_CP  
              ORDER BY ID_ADITIVO_CONTRATO_CP
        ";
      //  print_r($query);
        return $this->sqlVetor($query);
    }

//------------PESQUISA UNIDADE ORGAO ORIGEM-------------------------------------
    function buscarUnidadeOrigem($VO) {
        $query = "SELECT ID_UNIDADE_ORG codigo,
                         TX_UNIDADE_ORG tx_unidade_origem
                    FROM UNIDADE_ORG
                ORDER BY TX_UNIDADE_ORG
                 ";
        return $this->sqlVetor($query);
   }
    
//-----PESQUISA UNIDADE ORGAO DESTINO-------------------------------------------
    function buscarUnidadeDestino($VO) {
        $query = "
              SELECT ID_UNIDADE_ORG codigo,
                     TX_UNIDADE_ORG
                FROM UNIDADE_ORG
              WHERE (ID_UNIDADE_ORG not in ".$VO->ID_UNIDADE_ORG_ORIGEM.")
             ORDER BY TX_UNIDADE_ORG
                 ";
        return $this->sqlVetor($query);
    }

//-----------------------PESQUISA PRINCIPAL-------------------------------------  
    function pesquisar($VO) {
        $query = "
       SELECT OGE.TX_ORGAO_GESTOR_ESTAGIO,
       STA.ID_SOLICITACAO_TA_CP,
       CCP.NB_CODIGO NB_CODIGO_CONTRATO, 
       ACCP.NB_CODIGO NB_CODIGO,
       STA.TX_CODIGO,
       STA.DT_SOLICITACAO,
       STA.ID_ORGAO_GESTOR_ESTAGIO,
       STA.ID_ADITIVO_CONTRATO_CP,
       CCP.ID_CONTRATO_CP
  FROM SOLICITACAO_TA_CP STA,
       ORGAO_GESTOR_ESTAGIO OGE,
       CONTRATO_CP CCP,
       ADITIVO_CONTRATO_CP ACCP
 WHERE (STA.ID_CONTRATO_CP = CCP.ID_CONTRATO_CP(+))
       AND (STA.ID_ORGAO_GESTOR_ESTAGIO = OGE.ID_ORGAO_GESTOR_ESTAGIO(+))
       AND CCP.ID_CONTRATO_CP = ACCP.ID_CONTRATO_CP(+)
       ";
($VO->ID_ORGAO_GESTOR_ESTAGIO) ? $query .= " and (ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ") " : false;  
($VO->ID_CONTRATO_CP) ? $query .= " and (CONTRATO_CP.NB_CODIGO = " . $VO->ID_CONTRATO_CP . ") " : false;    
($VO->ID_ADITIVO_CONTRATO_CP) ? $query .= " and (ADITIVO_CONTRATO_CP.ID_ADITIVO_CONTRATO_CP, = " . $VO->ID_ADITIVO_CONTRATO_CP . ") " : false;    
($VO->TX_CODIGO) ? $query .= " and (SOLICITACAO_TA_CP.TX_CODIGO = " . $VO->TX_CODIGO . ") " : false;
        
        $query .= "ORDER BY OGE.TX_ORGAO_GESTOR_ESTAGIO";
  
        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }
      
        return $this->sqlVetor($query);
}
 
//--------------------------------CADASTRAR-------------------------------------
function inserir($VO) {
    
 $queryPK = "select SEMAD.F_G_PK_SOLICITACAO_TA_CP() as ID_SOLICITACAO_TA_CP from dual";
 $this->sqlVetor($queryPK);
 $CodigoPK = $this->getVetor();
        
  $query = " INSERT 
        INTO SOLICITACAO_TA_CP
       (ID_SOLICITACAO_TA_CP,
       TX_CODIGO,
       DT_SOLICITACAO,
       DT_CADASTRO,
       DT_ATUALIZACAO,
       TX_ASSUNTO,
       NB_TOTAL_VAGAS,
       ID_CONTRATO_CP,
       ID_ADITIVO_CONTRATO_CP,
       ID_ORGAO_GESTOR_ESTAGIO,
       ID_USUARIO_ATUALIZACAO,
       ID_USUARIO_CADASTRO,
       CS_SITUACAO,
       TX_SOLICITACAO,
       ID_UNID_ORIGEM,
       ID_UNID_DESTINO)
VALUES
       (" . $CodigoPK['ID_SOLICITACAO_TA_CP'][0] . ",
            SEMAD.F_G_COD_SOLICITACAO_TA_CP(),
            TO_DATE('" . $VO->DT_SOLICITACAO . "','DD/MM/YYYY'),
            SYSDATE,
            SYSDATE,
         '" . $VO->TX_ASSUNTO . "',
         '" . $VO->NB_TOTAL_VAGAS . "',
         " . $VO->ID_CONTRATO_CP . ",
         '" . $VO->ID_ADITIVO_CONTRATO_CP . "',   
         " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ",
         " . $_SESSION['ID_USUARIO'] . ",
         " . $_SESSION['ID_USUARIO'] . ",
         1,
         '" . $VO->TX_SOLICITACAO . "',
         " . $VO->ID_UNIDADE_ORG_ORIGEM . ", 
         " . $VO->ID_UNIDADE_ORG_DESTINO . ")";

        $retorno = $this->sql($query);
        
        print_r($retorno);
        if (!$retorno) {
            return $CodigoPK['ID_SOLICITACAO_TA_CP'][0];
        }
    }
//------------------------------BUSCAR DETAIL-----------------------------------
     function buscar($VO) {
        $query = "SELECT STA.ID_SOLICITACAO_TA_CP,
       AC.NB_CODIGO NB_CONTRATO,
       CCP.NB_CODIGO ,
       STA.TX_CODIGO,
       STA.TX_ASSUNTO,
       STA.CS_SITUACAO,
       STA.TX_SOLICITACAO,
       STA.ID_UNID_ORIGEM ID_UNIDADE_ORG_ORIGEM,
       STA.ID_UNID_DESTINO ID_UNIDADE_ORG_DESTINO,
       OGE.TX_ORGAO_GESTOR_ESTAGIO,
       STA.ID_USUARIO_CADASTRO,
       STA.ID_USUARIO_ATUALIZACAO,
       VFT_CAD.TX_FUNCIONARIO TX_FUNCIONARIO_CAD,
       VFT_ATUAL.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL,
       TO_CHAR(STA.DT_CADASTRO, 'DD/MM/YYYY HH24:MI:SS') DT_CADASTRO,
       TO_CHAR(STA.DT_ATUALIZACAO, 'DD/MM/YYYY HH24:MI:SS') DT_ATUALIZACAO,
       U_CAD.TX_LOGIN,
       ORIGEM.TX_UNIDADE_ORG,
       DESTINO.TX_UNIDADE_ORG TX_DESTINO,
        STA.id_orgao_gestor_estagio,
       U_ATUAL.TX_LOGIN,
       STA.ID_CONTRATO_CP,
       ORIGEM.id_unidade_org,
       DESTINO.id_unidade_org,
       TO_CHAR(STA.DT_SOLICITACAO, 'DD/MM/YYYY HH24:MI:SS')DT_SOLICITACAO
  FROM SOLICITACAO_TA_CP STA,
       CONTRATO_CP CCP,
       UNIDADE_ORG ORIGEM,
       UNIDADE_ORG DESTINO,
       ADITIVO_CONTRATO_CP AC,
       ORGAO_GESTOR_ESTAGIO OGE,
       AGENCIA_ESTAGIO AE,
       USUARIO U_CAD,
       USUARIO U_ATUAL,
       V_FUNCIONARIO_TOTAL VFT_CAD,
       V_FUNCIONARIO_TOTAL VFT_ATUAL
 WHERE STA.ID_ADITIVO_CONTRATO_CP = AC.ID_ADITIVO_CONTRATO_CP(+) 
 AND STA.ID_ORGAO_GESTOR_ESTAGIO = OGE.ID_ORGAO_GESTOR_ESTAGIO(+) 
 AND AC.ID_AGENCIA_ESTAGIO = AE.ID_AGENCIA_ESTAGIO(+) 
 AND STA.ID_USUARIO_CADASTRO = U_CAD.ID_USUARIO(+) 
 AND STA.ID_USUARIO_ATUALIZACAO = U_ATUAL.ID_USUARIO(+) 
 AND U_CAD.ID_PESSOA_FUNCIONARIO = VFT_CAD.ID_PESSOA_FUNCIONARIO(+) 
 AND U_ATUAL.ID_PESSOA_FUNCIONARIO = VFT_ATUAL.ID_PESSOA_FUNCIONARIO(+)
 AND STA.ID_USUARIO_CADASTRO = U_CAD.ID_USUARIO(+) 
 AND STA.ID_USUARIO_ATUALIZACAO = U_ATUAL.ID_USUARIO(+) 
 AND STA.ID_UNID_ORIGEM = ORIGEM.ID_UNIDADE_ORG(+) 
 AND STA.ID_UNID_DESTINO = DESTINO.ID_UNIDADE_ORG(+)
 AND STA.ID_CONTRATO_CP = CCP.ID_CONTRATO_CP(+)
  /*AND STA.ID_UNID_ORIGEM = ".$VO->ID_UNIDADE_ORG_ORIGEM."
  AND STA.ID_UNID_DESTINO = ".$VO->ID_UNIDADE_ORG_DESTINO."*/
 AND STA.ID_SOLICITACAO_TA_CP = " . $VO->ID_SOLICITACAO_TA_CP." ";
        
     //   print_r($query);
        return $this->sqlVetor($query);
    }
    
//----------------------------ALTERAR DO MASTER---------------------------------
 function alterar($VO) {
         $query = " UPDATE SOLICITACAO_TA_CP set
                           DT_SOLICITACAO = TO_DATE('" . $VO->DT_SOLICITACAO . "','DD/MM/YYYY'),
                           DT_ATUALIZACAO = SYSDATE,
			   ID_USUARIO_ATUALIZACAO = " . $_SESSION['ID_USUARIO'] . ",
                           TX_CODIGO = '" . $VO->TX_CODIGO . "',
		           TX_ASSUNTO = '" . $VO->TX_ASSUNTO . "',
                           TX_SOLICITACAO = '" .$VO->TX_SOLICITACAO . "',
                           CS_SITUACAO = '" . $VO->CS_SITUACAO . "'
                     WHERE ID_SOLICITACAO_TA_CP = " . $VO->ID_SOLICITACAO_TA_CP . "       
                       AND ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_GESTOR_ESTAGIO . "
                       AND ID_CONTRATO_CP = " . $VO->ID_CONTRATO_CP . " 
                       AND ID_UNID_ORIGEM = " . $VO->ID_UNIDADE_ORG_ORIGEM . " 
                       AND ID_UNID_DESTINO = " . $VO->ID_UNIDADE_ORG_DESTINO;
 
        //print_r($query);
        return $this->sql($query);
    }
    
//--------------------------EXCLUIR DO MASTER-----------------------------------
    function excluir($VO) {
        $query = "
            delete from SOLICITACAO_TA_CP
                  where ID_SOLICITACAO_TA_CP = " . $VO->ID_SOLICITACAO_TA_CP;

        return $this->sql($query);
    }

  //------------------PESQUISA TIPO VAGAS DO DETAIL-----------------------------
     function pesquisarTipoVaga($VO) {
    $query = "
        SELECT CS_TIPO_VAGA_ESTAGIO,CS_TIPO_VAGA_ESTAGIO CODIGO,
               TX_TIPO_VAGA_ESTAGIO
          FROM TIPO_VAGA_ESTAGIO TVE";
 
        return $this->sqlVetor($query);
    }
 //------------------------CADASTRAR VAGAS DO DETAIL----------------------------
    
     function inserirVagasSolicitadas($VO) {
         
     $query = "    
         INSERT INTO SEMAD.ITEM_SOLIC_TA_CP
      (ID_SOLICITACAO_TA_CP,
       CS_TIPO_VAGA_ESTAGIO,
       NB_QUANTIDADE,
       NB_TAXA_ADMINISTRATIVA,
       NB_AUXILIO_TRANSPORTE,
       ID_USUARIO_ATUALIZACAO,
       NB_BOLSA_AUXILIO,
       ID_USUARIO_CADASTRO,
       ID_USUARIO_ATUALIZACAO,
       DT_CADASTRO,
       DT_ATUALIZACAO)
 VALUES
      (" . $CodigoPK['ID_SOLICITACAO_TA_CP'][0] . ",
            SEMAD.F_G_COD_SOLICITACAO_TA_CP(), 
       " . $VO->CS_TIPO_VAGA_ESTAGIO . ", 
       " . $VO->NB_QUANTIDADE . ",
       " . $VO->NB_TAXA_ADMINISTRATIVA . ",
       " . $VO->NB_AUXILIO_TRANSPORTE . ",
       " . $VO->NB_BOLSA_AUXILIO . ",
       " . $_SESSION['ID_USUARIO'] . ",
       " . $_SESSION['ID_USUARIO'] . ",
       SYSDATE,
       SYSDATE)
         ";
        return $this->sql($query);    
      
    }
//------------------------------------------------------------------------------
/*
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
*/
    
//------------------------------BUSCAR DO DETAIL--------------------------------
    function buscarVagasSolicitadas($VO) {
        $query = "
 SELECT ID_SOLICITACAO_TA_CP,
        NB_QUANTIDADE,
        NB_TAXA_ADMINISTRATIVA,
        NB_AUXILIO_TRANSPORTE,
        NB_BOLSA_AUXILIO,
        ID_USUARIO_ATUALIZACAO,
        ID_USUARIO_CADASTRO,
        VFT_CAD.TX_FUNCIONARIO TX_FUNCIONARIO_CAD,
        VFT_ATUAL.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL,
        TVE.TX_TIPO_VAGA_ESTAGIO,
        ISTC.DT_CADASTRO,
        ISTC.DT_ATUALIZACAO
   FROM ITEM_SOLIC_TA_CP ISTC,
        TIPO_VAGA_ESTAGIO TVE,
        USUARIO U_CAD,
        USUARIO U_ATUAL,
        V_FUNCIONARIO_TOTAL VFT_CAD,
        V_FUNCIONARIO_TOTAL VFT_ATUAL
  WHERE ISTC.ID_USUARIO_CADASTRO = U_CAD.ID_USUARIO
    AND ISTC.ID_USUARIO_ATUALIZACAO = U_ATUAL.ID_USUARIO(+)
    AND U_ATUAL.ID_PESSOA_FUNCIONARIO = VFT_ATUAL.ID_PESSOA_FUNCIONARIO(+)
    AND U_CAD.ID_PESSOA_FUNCIONARIO = VFT_CAD.ID_PESSOA_FUNCIONARIO(+)
    AND ISTC.CS_TIPO_VAGA_ESTAGIO = TVE.CS_TIPO_VAGA_ESTAGIO(+)";

        return $this->sqlVetor($query);
    }
    
//--------------------------------------------------------------------------------    
    function pesquisarVagasSolicitadas($VO) {
        $query = "
        SELECT ID_SOLICITACAO_TA_CP,
        NB_QUANTIDADE,
        NB_TAXA_ADMINISTRATIVA,
        NB_AUXILIO_TRANSPORTE,
        NB_BOLSA_AUXILIO,
        ID_USUARIO_ATUALIZACAO,
        ID_USUARIO_CADASTRO,
        VFT_CAD.TX_FUNCIONARIO TX_FUNCIONARIO_CAD,
        VFT_ATUAL.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL,
        TVE.TX_TIPO_VAGA_ESTAGIO,
        ISTC.DT_CADASTRO,
        ISTC.DT_ATUALIZACAO
   FROM ITEM_SOLIC_TA_CP ISTC,
        TIPO_VAGA_ESTAGIO TVE,
        USUARIO U_CAD,
        USUARIO U_ATUAL,
        V_FUNCIONARIO_TOTAL VFT_CAD,
        V_FUNCIONARIO_TOTAL VFT_ATUAL
  WHERE ISTC.ID_USUARIO_CADASTRO = U_CAD.ID_USUARIO
    AND ISTC.ID_USUARIO_ATUALIZACAO = U_ATUAL.ID_USUARIO(+)
    AND U_ATUAL.ID_PESSOA_FUNCIONARIO = VFT_ATUAL.ID_PESSOA_FUNCIONARIO(+)
    AND U_CAD.ID_PESSOA_FUNCIONARIO = VFT_CAD.ID_PESSOA_FUNCIONARIO(+)
    AND ISTC.CS_TIPO_VAGA_ESTAGIO = TVE.CS_TIPO_VAGA_ESTAGIO(+)";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }
        return $this->sqlVetor($query);
    }

//-------------------------------EXCLUIR DO DETAIL------------------------------
    function excluirVagasSolicitadas($VO) {
        $query = "
          delete from ITEM_SOLIC_TA_CP
                where ID_SOLICITACAO_TA_CP = " . $VO->ID_SOLICITACAO_TA_CP . ")";  
          
        return $this->sql($query);
    }

	
//------------------------------------------------------------------------------	
    function verificarRecrutamento($VO) {
        $query = "select ID_RECRUTAMENTO_ESTAGIO from recrutamento_estagio where ID_SOLICITACAO_ESTAGIO = '".$VO->ID_SOLICITACAO_ESTAGIO."'";

        return $this->sqlVetor($query);
    }

    function alterarVagasSolicitadas($VO) {
        $query = "
                  UPDATE ITEM_SOLIC_TA_CP SET
                  DT_ATUALIZACAO = SYSDATE,
                  ID_USUARIO_ATUALIZACAO = " . $_SESSION['ID_USUARIO'] . ",
                  NB_QUANTIDADE = '" . $VO->NB_QUANTIDADE . "',
                  NB_TAXA_ADMINISTRATIVA = '" . $VO->NB_TAXA_ADMINISTRATIVA . "',
                  NB_AUXILIO_TRANSPORTE = '" . $VO->NB_AUXILIO_TRANSPORTE . "',
                  NB_BOLSA_AUXILIO = '" . $VO->NB_BOLSA_AUXILIO . "'
            WHERE ID_SOLICITACAO_TA_CP = " . $VO->ID_SOLICITACAO_TA_CP . "
              AND CS_TIPO_VAGA_ESTAGIO = " . $VO->CS_TIPO_VAGA_ESTAGIO . "";

        return $this->sql($query);
    }

    function atualizarInf($VO) {

        $query = "
             update ITEM_SOLIC_TA_CP 
                set DT_ATUALIZACAO = sysdate,
                    ID_USUARIO_ATUALIZACAO = " . $_SESSION['ID_USUARIO'] . "
              where CS_TIPO_VAGA_ESTAGIO = " . $VO->CS_TIPO_VAGA_ESTAGIO;

        $this->sql($query);

        $data = "
            select TO_CHAR(a.DT_ATUALIZACAO, 'DD/MM/YYYY hh24:mi:ss') DT_ATUALIZACAO,
                    c.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL
               from ITEM_SOLIC_TA_CP a,
                    USUARIO b,
                    V_FUNCIONARIO_USUARIO c
              where a.ID_SOLICITACAO_TA_CP = '" . $VO->ID_SOLICITACAO_TA_CP . "'
                and a.ID_USUARIO_ATUALIZACAO = b.ID_USUARIO
                and b.ID_PESSOA_FUNCIONARIO = c.ID_PESSOA_FUNCIONARIO
                and b.ID_UNIDADE_GESTORA = c.ID_UNIDADE_GESTORA";

        $this->sqlVetor($data);
        $datahora = $this->getVetor();

        return $datahora;
    }
    
    function efetivarSolicitacao($VO){

            $query = " UPDATE SOLICITACAO_ESTAGIO SET
			      CS_SITUACAO = 2,
	                      ID_USUARIO_ATUALIZACAO = '" . $_SESSION['ID_USUARIO'] . "',
			      DT_ATUALIZACAO = SYSDATE
		              WHERE ID_SOLICITACAO_ESTAGIO = ".$VO->ID_SOLICITACAO_ESTAGIO."";
            
        $this->sql($query);		
		
    }
	
}

?>