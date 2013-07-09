<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioTransferencia extends Repositorio {

//-------------orgao gestor----------------------------------------    
    function pesquisarOrgaoGestor($VO) {
        $query = "
            select oge.ID_ORGAO_GESTOR_ESTAGIO CODIGO,
                    oge.TX_ORGAO_GESTOR_ESTAGIO
               from ORGAO_GESTOR_ESTAGIO oge
             order by TX_ORGAO_GESTOR_ESTAGIO
        ";

        return $this->sqlVetor($query);
    }

//-------------orgão solicitante--------------------------------------
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

//---------BUSCA orgão cedente---------------------------------    
    function pesquisarOrgaoCedente($VO) {
        $query = "SELECT DISTINCT
                    OE.ID_ORGAO_ESTAGIO CODIGO,
                    OE.TX_ORGAO_ESTAGIO 
               FROM AGENTE_SETORIAL_ESTAGIO ASE,
                    ORGAO_AGENTE_SETORIAL OAS,
                    ORGAO_ESTAGIO OE
              WHERE (ASE.ID_SETORIAL_ESTAGIO = OAS.ID_SETORIAL_ESTAGIO)
                AND (OE.ID_ORGAO_ESTAGIO = OAS.ID_ORGAO_ESTAGIO)
                AND (OE.ID_ORGAO_ESTAGIO NOT IN " . $VO->ID_ORGAO_SOLICITANTE . ")
                AND (ASE.ID_USUARIO = " . $_SESSION['ID_USUARIO'] . ")
           ORDER BY OE.TX_ORGAO_ESTAGIO ";

        return $this->sqlVetor($query);
    }

//-------------busca QUADRO DE VAGAS DO CADASTRAR-------------------------------
    function buscarQuadroVagasEstagio($VO) {
        $query = "SELECT ID_QUADRO_VAGAS_ESTAGIO,
                         ID_QUADRO_VAGAS_ESTAGIO CODIGO,
                         TX_CODIGO
                    FROM QUADRO_VAGAS_ESTAGIO";

        return $this->sqlVetor($query);
    }

//--------------pesquisa principal----------------------------------------------    
    function pesquisar($VO) {
        $query = " SELECT TV.ID_TRANSFERENCIA_ESTAGIO,
                          TV.TX_COD_TRANSFERENCIA,
                          TV.ID_ORGAO_GESTOR_ESTAGIO,
                          OGE.TX_ORGAO_GESTOR_ESTAGIO,
                          TV.ID_ORGAO_ESTAGIO,
                          OE.TX_ORGAO_ESTAGIO,
                          TV.ID_ORGAO_SOLICITANTE,
                          OS.TX_ORGAO_ESTAGIO TX_SOLICITANTE,
                          TV.CS_SITUACAO
                     FROM TRANSFERENCIA_VAGAS TV,
                          ORGAO_ESTAGIO OE,
                          ORGAO_ESTAGIO OS,
                          ORGAO_GESTOR_ESTAGIO OGE
                   WHERE (TV.ID_ORGAO_ESTAGIO = OE.ID_ORGAO_ESTAGIO)
                     AND (TV.ID_ORGAO_GESTOR_ESTAGIO = OGE.ID_ORGAO_GESTOR_ESTAGIO)
                     AND (TV.ID_ORGAO_SOLICITANTE = OS.ID_ORGAO_ESTAGIO(+)) ";

        ($VO->ID_ORGAO_GESTOR_ESTAGIO) ? $query .= " and (TV.ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ") " : false;
        ($VO->ID_ORGAO_SOLICITANTE) ? $query .= " and (TV.ID_ORGAO_SOLICITANTE = " . $VO->ID_ORGAO_SOLICITANTE . ") " : false;
        ($VO->ID_ORGAO_ESTAGIO) ? $query .= " and (TV.ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . ") " : false;
        ($VO->CS_SITUACAO) ? $query .= " and (TV.CS_SITUACAO = " . $VO->CS_SITUACAO . ") " : false;
        ($VO->TX_COD_TRANSFERENCIA) ? $query .= " and (TV.TX_COD_TRANSFERENCIA like '%" . $VO->TX_COD_TRANSFERENCIA . "%') " : false;

        $query .= "order by OGE.TX_ORGAO_GESTOR_ESTAGIO,                       
                            OE.TX_ORGAO_ESTAGIO,
                            OS.TX_ORGAO_ESTAGIO,
                            TV.CS_SITUACAO,
                            TV.TX_COD_TRANSFERENCIA ";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

//-----------------inserir-----------------------------------------
//SEMAD.F_G_COD_TRANSFERENCIA_ESTAGIO()

    function inserir($VO) {

        $queryPK = "select SEMAD.F_G_PK_TRANSFERENCIA_VAGAS() as ID_TRANSFERENCIA_ESTAGIO from dual";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "INSERT 
                     INTO TRANSFERENCIA_VAGAS
                            (ID_TRANSFERENCIA_ESTAGIO,
                             DT_CADASTRO,
                             DT_ATUALIZACAO,
                             CS_SITUACAO,
                             ID_USUARIO_ATUALIZACAO,
                             ID_USUARIO_CADASTRO,
                             TX_COD_TRANSFERENCIA,
                             ID_ORGAO_ESTAGIO,
                             ID_ORGAO_GESTOR_ESTAGIO,
                             TX_MOTIVO,
                             ID_ORGAO_SOLICITANTE,
                             ID_QUADRO_VAGAS_ESTAGIO)
                    values
                    (" . $CodigoPK['ID_TRANSFERENCIA_ESTAGIO'][0] . ",
                                  SYSDATE,
                                  SYSDATE,
                                 '1',
                                " . $_SESSION['ID_USUARIO'] . ",
                                " . $_SESSION['ID_USUARIO'] . ",
                                SEMAD.F_G_COD_TRANSFERENCIA_ESTAGIO(),
                                " . $VO->ID_ORGAO_ESTAGIO . ",
                                " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ",  
                               '" . $VO->TX_MOTIVO . "',
                                " . $VO->ID_ORGAO_SOLICITANTE . ",
                                " . $VO->ID_QUADRO_VAGAS_ESTAGIO . ")";

        $retorno = $this->sql($query);
        print_r($retorno);
        if (!$retorno) {

            return $CodigoPK['ID_TRANSFERENCIA_ESTAGIO'][0];
        }
    }

//----------------BUSCAR--------------------------------------------------------    
    function buscar($VO) {
        $query = "SELECT    OGE.TX_ORGAO_GESTOR_ESTAGIO,
                            SOLICITANTE.TX_ORGAO_ESTAGIO TX_SOLICITANTE,
                            OE.TX_ORGAO_ESTAGIO,
                            TV.ID_TRANSFERENCIA_ESTAGIO,
                            TO_CHAR(TV.DT_CADASTRO, 'DD/MM/YYYY hh24:mi:ss') DT_CADASTRO,
                            TO_CHAR(TV.DT_ATUALIZACAO, 'DD/MM/YYYY hh24:mi:ss') DT_ATUALIZACAO,
                            TV.CS_SITUACAO,
                            TV.ID_USUARIO_ATUALIZACAO,
                            TV.ID_USUARIO_CADASTRO,
                            TV.TX_COD_TRANSFERENCIA,
                            TV.ID_ORGAO_ESTAGIO,
                            TV.ID_ORGAO_GESTOR_ESTAGIO,
                            TV.TX_MOTIVO,
                            U_CAD.TX_LOGIN,
                            U_ATUAL.TX_LOGIN,
                            VFT_CAD.TX_FUNCIONARIO TX_FUNCIONARIO_CAD,
                            VFT_ATUAL.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL,
                            TV.ID_ORGAO_SOLICITANTE,
                            TV.ID_QUADRO_VAGAS_ESTAGIO,
                            QVE.TX_CODIGO
                       FROM TRANSFERENCIA_VAGAS TV,
                            QUADRO_VAGAS_ESTAGIO QVE,
                            ORGAO_GESTOR_ESTAGIO OGE,
                            ORGAO_ESTAGIO SOLICITANTE,
                            ORGAO_ESTAGIO OE,
                            USUARIO U_CAD,
                            USUARIO U_ATUAL,
                            V_FUNCIONARIO_TOTAL VFT_CAD,
                            V_FUNCIONARIO_TOTAL VFT_ATUAL
                      WHERE U_CAD.ID_PESSOA_FUNCIONARIO = VFT_CAD.ID_PESSOA_FUNCIONARIO
                            AND U_ATUAL.ID_PESSOA_FUNCIONARIO = VFT_ATUAL.ID_PESSOA_FUNCIONARIO
                            AND TV.ID_ORGAO_GESTOR_ESTAGIO = OGE.ID_ORGAO_GESTOR_ESTAGIO
                            AND TV.ID_ORGAO_ESTAGIO = OE.ID_ORGAO_ESTAGIO
                            AND TV.ID_USUARIO_CADASTRO = U_CAD.ID_USUARIO
                            AND TV.ID_USUARIO_ATUALIZACAO = U_ATUAL.ID_USUARIO
                            AND TV.ID_ORGAO_SOLICITANTE = SOLICITANTE.ID_ORGAO_ESTAGIO
                            AND TV.ID_QUADRO_VAGAS_ESTAGIO = QVE.ID_QUADRO_VAGAS_ESTAGIO                            
                            AND TV.ID_TRANSFERENCIA_ESTAGIO = " . $VO->ID_TRANSFERENCIA_ESTAGIO . " ";


        return $this->sqlVetor($query);
    }

//----------------------detail--------------------------------------------------
    function alterar($VO) {
        $query = "update TRANSFERENCIA_VAGAS
					set DT_ATUALIZACAO = SYSDATE,
					    ID_USUARIO_ATUALIZACAO = " . $_SESSION['ID_USUARIO'] . ",
					    TX_MOTIVO = '" . $VO->TX_MOTIVO . "' ";
        $VO->CS_SITUACAO ? $query .= " ,CS_SITUACAO = '" . $VO->CS_SITUACAO . "' " : false;
        $query .= " where ID_TRANSFERENCIA_ESTAGIO = " . $VO->ID_TRANSFERENCIA_ESTAGIO;

        return $this->sql($query);
    }

//------------------EXCLUIR-------------------------------------------------
    function excluir($VO) {
        $query = " delete
                     from TRANSFERENCIA_VAGAS
                    where (ID_TRANSFERENCIA_ESTAGIO = " . $VO->ID_TRANSFERENCIA_ESTAGIO . ")";

        return $this->sql($query);
    }

   

//-------------PESQUISA TIPO VAGAS-----------------------------
    function pesquisarTipoVaga($VO) {
        $query = "
            select C.CS_TIPO_VAGA_ESTAGIO ||'_'|| B.NB_QUANTIDADE CODIGO,
                    C.TX_TIPO_VAGA_ESTAGIO
               from QUADRO_VAGAS_ESTAGIO A,
                    VAGAS_ESTAGIO B,
                    TIPO_VAGA_ESTAGIO C
              where A.ID_QUADRO_VAGAS_ESTAGIO = B.ID_QUADRO_VAGAS_ESTAGIO
                    and B.CS_TIPO_VAGA_ESTAGIO = C.CS_TIPO_VAGA_ESTAGIO
                    and B.ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . "
                    and A.CS_SITUACAO = " . $VO->CS_SITUACAO . "
                    and B.CS_TIPO_VAGA_ESTAGIO
                    not in (select CS_TIPO_VAGA_ESTAGIO
                            from VAGAS_TRANSFERIDAS
                            where ID_TRANSFERENCIA_ESTAGIO = " . $VO->ID_TRANSFERENCIA_ESTAGIO . "
                            and ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . ")
             order by C.TX_TIPO_VAGA_ESTAGIO desc";

        return $this->sqlVetor($query);
    }

//--------------QUANTIDADE DO DETAIL------------------
    function buscarQuantidade($VO) {
        $query = 
        "select NB_QUANTIDADE
          from VAGAS_ESTAGIO
          where ID_ORGAO_ESTAGIO = " . $VO->ID_ORGAO_ESTAGIO . "
          and ID_QUADRO_VAGAS_ESTAGIO = " . $VO->ID_QUADRO_VAGAS_ESTAGIO . "
          and CS_TIPO_VAGA_ESTAGIO = " . $VO->CS_TIPO_VAGA_ESTAGIO . " ";
          
        return $this->sqlVetor($query);
    }

//-------------pesquisa- do detail-------------------
    function pesquisarVagasSolicitadas($VO) {
        $query = "
            select oge.tx_orgao_gestor_estagio TX_ORGAO_GESTOR, oe_origem.tx_orgao_estagio TX_ORGAO_CEDENTE,
                    oe_destino.tx_orgao_estagio TX_ORGAO_SOLICITANTE,
                    tve.TX_TIPO_VAGA_ESTAGIO,
                    vft_cad.tx_funcionario TX_FUNCIONARIO_CAD, vft_atual.tx_funcionario TX_FUNCIONARIO_ATUAL,
                    vt.ID_TRANSFERENCIA_ESTAGIO, vt.ID_QUADRO_VAGAS_ESTAGIO, vt.ID_ORGAO_EST_ORIGEM, vt.ID_ORGAO_EST_DESTINO,
                    vt.NB_QUANTIDADE, vt.NB_VAGAS_TRANSFERIDAS, vt.CS_TIPO_VAGA_ESTAGIO, vt.TX_DOC_AUTORIZACAO,
                    vt.ID_USUARIO_CADASTRO, vt.ID_USUARIO_ATUALIZACAO,
                    to_char(vt.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,
                    to_char(vt.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO
               from VAGAS_TRANSFERIDAS vt,
                    TRANSFERENCIA_VAGAS tv,
                    ORGAO_GESTOR_ESTAGIO oge,
                    ORGAO_ESTAGIO oe_origem,
                    ORGAO_ESTAGIO oe_destino,
                    TIPO_VAGA_ESTAGIO tve,
                    USUARIO u_cad,
                    USUARIO u_atual,
                    V_FUNCIONARIO_TOTAL vft_cad,
                    V_FUNCIONARIO_TOTAL vft_atual
              where vt.id_transferencia_estagio = tv.id_transferencia_estagio
                    and vt.id_quadro_vagas_estagio = tv.id_quadro_vagas_estagio
                    and vt.id_orgao_est_origem = tv.id_orgao_estagio
                    and vt.id_orgao_est_destino = tv.id_orgao_solicitante
                    and tv.id_orgao_gestor_estagio = oge.id_orgao_gestor_estagio
                    and vt.id_orgao_est_origem = oe_origem.id_orgao_estagio
                    and vt.id_orgao_est_destino = oe_destino.id_orgao_estagio
                    and vt.cs_tipo_vaga_estagio = tve.cs_tipo_vaga_estagio
                    and vt.id_usuario_cadastro = u_cad.id_usuario
                    and vt.id_usuario_atualizacao = u_atual.id_usuario
                    and u_cad.id_pessoa_funcionario = vft_cad.id_pessoa_funcionario
                    and u_cad.id_unidade_gestora = vft_cad.id_unidade_gestora
                    and u_atual.id_pessoa_funcionario = vft_atual.id_pessoa_funcionario
                    and u_atual.id_unidade_gestora = vft_atual.id_unidade_gestora
                    and ( vt.ID_TRANSFERENCIA_ESTAGIO =  " . $VO->ID_TRANSFERENCIA_ESTAGIO . ")
              order by oge.TX_ORGAO_GESTOR_ESTAGIO";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

    
//--------------------------iserir do detail------------------------------------------------
    function inserirVagasSolicitadas($VO) {
        $query = " INSERT
                     INTO SEMAD.VAGAS_TRANSFERIDAS
                           (ID_TRANSFERENCIA_ESTAGIO,
                            ID_QUADRO_VAGAS_ESTAGIO,
                            ID_ORGAO_EST_ORIGEM,
                            ID_ORGAO_EST_DESTINO,
                            NB_QUANTIDADE,
                            NB_VAGAS_TRANSFERIDAS,
                            CS_TIPO_VAGA_ESTAGIO,
                            ID_USUARIO_CADASTRO,
                            ID_USUARIO_ATUALIZACAO,
                            DT_CADASTRO,
                            DT_ATUALIZACAO)
                
      values (" . $VO->ID_TRANSFERENCIA_ESTAGIO . ",   
              " . $VO->ID_QUADRO_VAGAS_ESTAGIO . ",   
              " . $VO->ID_ORGAO_EST_ORIGEM . ",
              " . $VO->ID_ORGAO_EST_DESTINO . ",
              " . $VO->NB_QUANTIDADE . ",
             '" . $VO->NB_VAGAS_TRANSFERIDAS . "',
             '" . $VO->CS_TIPO_VAGA_ESTAGIO . "',
              " . $_SESSION['ID_USUARIO'] . ",
              " . $_SESSION['ID_USUARIO'] . ",    
                   SYSDATE,
                   SYSDATE) ";
        print_r($query);
        return $this->sql($query);
}

//------------------------------------------------------
    function buscarVagasSolicitadas($VO) {
        $query = " select VT.ID_TRANSFERENCIA_ESTAGIO,
                        VT.ID_QUADRO_VAGAS_ESTAGIO,
                        VT.CS_TIPO_VAGA_ESTAGIO,
                        VT.NB_QUANTIDADE,
                        tve.TX_TIPO_VAGA_ESTAGIO,
                        to_char(VT.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,
                        to_char(VT.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
                        VT.ID_USUARIO_CADASTRO,
                        VT.ID_USUARIO_ATUALIZACAO,
                        vft_cad.TX_FUNCIONARIO TX_FUNCIONARIO_CAD,
                        vft_atual.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL

                   from VAGAS_TRANSFERIDAS VT,
                        TIPO_VAGA_ESTAGIO tve,
                        USUARIO u_cad,
                        USUARIO u_atual,
                        V_FUNCIONARIO_TOTAL vft_cad,
                        V_FUNCIONARIO_TOTAL vft_atual
                  where (VT.CS_TIPO_VAGA_ESTAGIO = tve.CS_TIPO_VAGA_ESTAGIO)
                    and (VT.ID_USUARIO_CADASTRO = u_cad.ID_USUARIO)
                    and (VT.ID_USUARIO_ATUALIZACAO = u_atual.ID_USUARIO)
                    and (u_cad.ID_PESSOA_FUNCIONARIO = vft_cad.ID_PESSOA_FUNCIONARIO)
                    and (u_cad.ID_UNIDADE_GESTORA = vft_cad.ID_UNIDADE_GESTORA)
                    and (u_atual.ID_PESSOA_FUNCIONARIO = vft_atual.ID_PESSOA_FUNCIONARIO)
                    and (u_atual.ID_UNIDADE_GESTORA = vft_atual.ID_UNIDADE_GESTORA)
                    AND (VT.ID_TRANSFERENCIA_ESTAGIO = " . $VO->ID_TRANSFERENCIA_ESTAGIO . ")
                    AND (ID_QUADRO_VAGAS_ESTAGIO = ".$VO->ID_QUADRO_VAGAS_ESTAGIO.")";

    
        return $this->sqlVetor($query);
    }

    
//-------------------ALTERAR DO DETAIL --------------------------------------
    function alterarVagasSolicitadas($VO) {
        $query = "update VAGAS_TRANSFERIDAS
                     set DT_ATUALIZACAO = sysdate,
                         ID_USUARIO_ATUALIZACAO = " . $_SESSION['ID_USUARIO'] . ",
                         NB_QUANTIDADE = '" . $VO->NB_QUANTIDADE . "',
                         CS_TIPO_VAGA_ESTAGIO = '" . $VO->CS_TIPO_VAGA_ESTAGIO . "'    
                  where (ID_TRANSFERENCIA_ESTAGIO = " . $VO->ID_TRANSFERENCIA_ESTAGIO . ")
                    ";
       print_r($query);

        return $this->sql($query);
}

//-------EXCLUIR DO DETAIL--------------------------------------------------------------
    function excluirVagasSolicitadas($VO) {
        $query = "
            delete
               from VAGAS_TRANSFERIDAS
              WHERE (ID_TRANSFERENCIA_ESTAGIO  =  " . $VO->ID_TRANSFERENCIA_ESTAGIO . ")
             
                ";
        
        return $this->sql($query);
    }


//---------------------RECRUTAMENTO--------------------------------------------	
    function verificarRecrutamento($VO) {
        $query = " SELECT ID_RECRUTAMENTO_ESTAGIO
                     FROM RECRUTAMENTO_ESTAGIO
                    WHERE ID_ORGAO_ESTAGIO = '" . $VO->ID_ORGAO_ESTAGIO . "'";

        return $this->sqlVetor($query);
    }

//---------ATUALIZA  ------------------------
    function atualizarInf($VO) {
        $query = " update TRANSFERENCIA_VAGAS
               set DT_ATUALIZACAO = sysdate,
                   ID_USUARIO_ATUALIZACAO = " . $_SESSION['ID_USUARIO'] . "
             where ID_TRANSFERENCIA_ESTAGIO = " . $VO->ID_TRANSFERENCIA_ESTAGIO;

        $this->sql($query);

        $data = "select TO_CHAR(a.DT_ATUALIZACAO, 'DD/MM/YYYY hh24:mi:ss') DT_ATUALIZACAO,
                        c.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL
                   from TRANSFERENCIA_VAGAS a,
                        USUARIO b,
                        V_FUNCIONARIO_USUARIO c
                  where a.ID_TRANSFERENCIA_ESTAGIO =  " . $VO->ID_TRANSFERENCIA_ESTAGIO . "
                    and b.ID_PESSOA_FUNCIONARIO = c.ID_PESSOA_FUNCIONARIO
                    and b.ID_UNIDADE_GESTORA = c.ID_UNIDADE_GESTORA
                    and a.id_usuario_atualizacao = b.id_usuario  ";

        $this->sqlVetor($data);
        $datahora = $this->getVetor();

        return $datahora;
    }

//-----------busca tipo-----------------------------------
    function buscarTipo($VO) {
      $query = "
      SELECT CS_TIPO_VAGA_ESTAGIO CODIGO, TX_TIPO_VAGA_ESTAGIO
      FROM TIPO_VAGA_ESTAGIO
      ORDER BY TX_TIPO_VAGA_ESTAGIO
      ";

      return $this->sqlVetor($query);
      }
//------------------EFETIVA SOLICITAÇÃO DE VAGAS---------------------------------
    function efetivarSolicitacao($VO) {
        $query = " UPDATE TRANSFERENCIA_VAGAS 
               SET
                CS_SITUACAO = 2,
		ID_USUARIO_ATUALIZACAO = '" . $_SESSION['ID_USUARIO'] . "',
		DT_ATUALIZACAO = SYSDATE
          WHERE ID_TRANSFERENCIA_ESTAGIO = " . $VO->ID_TRANSFERENCIA_ESTAGIO . "";

        $this->sql($query);
    }

}

?>