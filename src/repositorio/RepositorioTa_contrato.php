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
          select OGE.TX_ORGAO_GESTOR_ESTAGIO,
       CCP.NB_CODIGO ,
       ACCP.NB_CODIGO NB_CODIGO_CONTRATO,
       STA.TX_CODIGO,
       STA.DT_SOLICITACAO,
       STA.ID_ORGAO_GESTOR_ESTAGIO,
       STA.id_aditivo_contrato_cp,
       CCP.id_contrato_cp
  from SOLICITACAO_TA_CP STA,
       ORGAO_GESTOR_ESTAGIO OGE,
       CONTRATO_CP CCP,
       ADITIVO_CONTRATO_CP ACCP
 where (STA.ID_CONTRATO_CP = CCP.ID_CONTRATO_CP(+))
       AND (STA.ID_ORGAO_GESTOR_ESTAGIO = OGE.ID_ORGAO_GESTOR_ESTAGIO(+))
       and CCP.id_contrato_cp = ACCP.id_contrato_cp(+)  
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
       // print_r($query);
        return $this->sqlVetor($query);
}
 
//--------------------------------CADASTRAR-------------------------------------
function inserir($VO) {
    
 $queryPK = "select SEMAD.F_G_PK_SOLICITACAO_TA_CP() as ID_SOLICITACAO_TA_CP from dual";
 $this->sqlVetor($queryPK);
 $CodigoPK = $this->getVetor();
        
  $query = " INSERT 
                INTO  SOLICITACAO_TA_CP
       (ID_SOLICITACAO_TA_CP,
        TX_CODIGO,
        DT_SOLICITACAO,
        DT_CADASTRO,
        DT_ATUALIZACAO,
        TX_ASSUNTO,
        ID_CONTRATO_CP,
        ID_ORGAO_GESTOR_ESTAGIO,
        ID_USUARIO_ATUALIZACAO,
        ID_USUARIO_CADASTRO,
        CS_SITUACAO,
        TX_SOLICITACAO,
        ID_UNIDADE_ORIGEM,
        ID_UNIDADE_DESTINO)
   
VALUES
       (" . $CodigoPK['ID_SOLICITACAO_TA_CP'][0] . ",
        '".$VO->TX_CODIGO."',
           SYSDATE,
           SYSDATE,
           SYSDATE,
        '".$VO->TX_ASSUNTO . "', 
         ".$VO->ID_CONTRATO_CP . ",
         ".$VO->ID_ORGAO_GESTOR_ESTAGIO . ",
         ".$_SESSION['ID_USUARIO'] . ",
         ".$_SESSION['ID_USUARIO'] . ",
         '1',
         ".$VO->TX_SOLICITACAO . ",
         ".$VO->ID_UNIDADE_ORG_ORIGEM . ", 
         ".$VO->ID_UNIDADE_ORG_DESTINO . ")";

        $retorno = $this->sql($query);
        if (!$retorno) {
            print_r($retorno);
            return $CodigoPK['ID_SOLICITACAO_TA_CP'][0];
        }
    }
//------------------------BUSCAR DETAIL / CLICANDO NO ALTERAR-------------------
     function buscar($VO) {
        $query = "
            SELECT STA.ID_SOLICITACAO_TA_CP,
              AC.NB_CODIGO,
              STA.TX_CODIGO,
              STA.TX_ASSUNTO,
              STA.CS_SITUACAO,
              STA.TX_SOLICITACAO,
              STA.ID_UNID_ORIGEM,
              STA.ID_UNID_DESTINO,
              OGE.TX_ORGAO_GESTOR_ESTAGIO,
              AE.TX_AGENCIA_ESTAGIO,
              STA.ID_USUARIO_CADASTRO, STA.ID_USUARIO_ATUALIZACAO,
              VFT_CAD.TX_FUNCIONARIO TX_FUNCIONARIO_CAD,
              VFT_ATUAL.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL,
              to_char(STA.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,
              to_char(STA.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO
         FROM ADITIVO_CONTRATO_CP AC,
              SOLICITACAO_TA_CP STA,
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
              AND U_CAD.ID_USUARIO = VFT_CAD.ID_PESSOA_FUNCIONARIO(+)
              AND U_ATUAL.ID_USUARIO = VFT_ATUAL.ID_PESSOA_FUNCIONARIO(+)
              AND STA.ID_SOLICITACAO_TA_CP = " . $VO->ID_SOLICITACAO_TA_CP." ";
        print_r($query);
        return $this->sqlVetor($query);
    }
//------------------------------------------------------------------------------

    function alterar($VO) {
        
		$query = "update SOLICITACAO_ESTAGIO
					set DT_ATUALIZACAO = SYSDATE,
						ID_USUARIO_ATUALIZACAO = " . $_SESSION['ID_USUARIO'] . ",
						TX_JUSTIFICATIVA = '" . $VO->TX_JUSTIFICATIVA . "' ";		
		$VO->CS_SITUACAO ? $query .= " ,CS_SITUACAO = '" . $VO->CS_SITUACAO . "' " : false;
        $query .= " where ID_SOLICITACAO_ESTAGIO = " . $VO->ID_SOLICITACAO_ESTAGIO;

        return $this->sql($query);
    }
//------------------------------------------------------------------------------
    function excluir($VO) {
        $query = "
            delete
               from SOLICITACAO_ESTAGIO
              where ID_SOLICITACAO_ESTAGIO = " . $VO->ID_SOLICITACAO_ESTAGIO;

        return $this->sql($query);
    }

    function pesquisarTipoVaga($VO) {
        $query = "
                   select distinct C.CS_TIPO_VAGA_ESTAGIO ||'_'|| B.NB_QUANTIDADE CODIGO,
                    C.TX_TIPO_VAGA_ESTAGIO,
                    B.NB_QUANTIDADE NB_QUANTIDADE_ATUAL
               from QUADRO_VAGAS_ESTAGIO A,
                    VAGAS_ESTAGIO B,
                    TIPO_VAGA_ESTAGIO C
              where A.ID_QUADRO_VAGAS_ESTAGIO = B.ID_QUADRO_VAGAS_ESTAGIO
                    and B.CS_TIPO_VAGA_ESTAGIO = C.CS_TIPO_VAGA_ESTAGIO
                    and B.ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . "
                    and a.id_quadro_vagas_estagio = '".$VO->ID_QUADRO_VAGAS_ESTAGIO."'
                    and A.CS_SITUACAO = 1
                    --and B.CS_TIPO_VAGA_ESTAGIO
                    --not in (select CS_TIPO_VAGA_ESTAGIO
                    --from VAGAS_TRANSFERIDAS
                    --where ID_TRANSFERENCIA_ESTAGIO = " . $VO->ID_TRANSFERENCIA_ESTAGIO . "
                    --and ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . ")
            order by C.TX_TIPO_VAGA_ESTAGIO desc";
 
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