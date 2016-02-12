<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioTermo_Aditivo extends Repositorio {

    function pesquisarOrgaoGestor($VO) {
        $query = "
            SELECT OGE.ID_ORGAO_GESTOR_ESTAGIO CODIGO,
                    OGE.TX_ORGAO_GESTOR_ESTAGIO
               FROM ORGAO_GESTOR_ESTAGIO OGE
             ORDER BY TX_ORGAO_GESTOR_ESTAGIO
        ";

        return $this->sqlVetor($query);
    }

    function pesquisarNB_Codigo($VO) {
        $query = "
            SELECT ID_CONTRATO_CP CODIGO, NB_CODIGO 
             FROM CONTRATO_CP
        ";

        return $this->sqlVetor($query);
    }

    function pesquisarAgenciaDeEstagio($VO) {
        $query = "
           SELECT ID_AGENCIA_ESTAGIO CODIGO, TX_AGENCIA_ESTAGIO
                FROM AGENCIA_ESTAGIO
                    ORDER BY TX_AGENCIA_ESTAGIO
         ";

        return $this->sqlVetor($query);
    }

    function pesquisar($VO) {

        $query = "select to_char(AC_CP.DT_FIM_VIGENCIA, 'dd/mm/yyyy hh24:mi:ss') DT_FIM_VIGENCIA,
                        to_char(AC_CP.DT_INICIO_VIGENCIA,'dd/mm/yyyy hh24:mi:ss') DT_INICIO_VIGENCIA,
                        to_char(AC_CP.DT_ATUALIZACAO,'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
                        to_char(AC_CP.DT_CADASTRO,'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,
                        AC_CP.ID_ADITIVO_CONTRATO_CP,
                        AC_CP.NB_CODIGO,
                        AC_CP.TX_OBJETO,
                        to_char(AC_CP.DT_ADITIVO, 'dd/mm/yyyy') DT_ADITIVO,
                        AC_CP.NB_VALOR_ESTIMADO,
                        AC_CP.TX_TERMO_ADITIVO,
                        OGE.TX_ORGAO_GESTOR_ESTAGIO,
                        VFT_CAD.TX_FUNCIONARIO TX_FUNCIONARIO_CAD,
                        VFT_ATUAL.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL
                   from ADITIVO_CONTRATO_CP AC_CP,
                          ORGAO_GESTOR_ESTAGIO OGE,
                          USUARIO U_CAD,
                          USUARIO U_ATUAL,
                          V_FUNCIONARIO_TOTAL VFT_CAD,
                          V_FUNCIONARIO_TOTAL VFT_ATUAL
                   where AC_CP.ID_ORGAO_GESTOR_ESTAGIO = OGE.ID_ORGAO_GESTOR_ESTAGIO
                          and AC_CP.ID_USUARIO_CADASTRO = U_CAD.ID_USUARIO
                          and AC_CP.ID_USUARIO_ATUALIZACAO = U_ATUAL.ID_USUARIO
                          and U_CAD.ID_PESSOA_FUNCIONARIO = VFT_CAD.ID_PESSOA_FUNCIONARIO
                          and U_CAD.ID_UNIDADE_GESTORA = VFT_CAD.ID_UNIDADE_GESTORA
                          and U_ATUAL.ID_PESSOA_FUNCIONARIO = VFT_ATUAL.ID_PESSOA_FUNCIONARIO
                          and U_ATUAL.ID_UNIDADE_GESTORA = VFT_ATUAL.ID_UNIDADE_GESTORA
                          and (AC_CP.ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ") ";

        ($VO->NB_CODIGO) ? $query .= " and (AC_CP.NB_CODIGO = " . $VO->NB_CODIGO . ") " : false;

        ($VO->TX_TERMO_ADITIVO) ? $query .= " and (upper(AC_CP.TX_TERMO_ADITIVO) like upper('%" . $VO->TX_TERMO_ADITIVO . "%')) " : false;

        $query .= " order by AC_CP.DT_ADITIVO desc, AC_CP.NB_CODIGO desc ";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

    function inserir($VO) {

        $queryPK = "select SEMAD.F_G_PK_ADITIVO_CONTRATO_CP as ID_ADITIVO_CONTRATO_CP from DUAL";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "INSERT INTO SEMAD.ADITIVO_CONTRATO_CP
                 (ID_ADITIVO_CONTRATO_CP,
                  ID_ORGAO_GESTOR_ESTAGIO,
                  ID_AGENCIA_ESTAGIO,
                  ID_CONTRATO_CP,
                  NB_CODIGO,
                  NB_VALOR_ESTIMADO,
                  TX_OBJETO,
                  TX_TERMO_ADITIVO,
                  DT_ADITIVO,
                  DT_INICIO_VIGENCIA,
                  DT_FIM_VIGENCIA,
                  DT_CADASTRO,
                  DT_ATUALIZACAO,
                  ID_USUARIO_CADASTRO,
                  ID_USUARIO_ATUALIZACAO)
            
		values
                ('" . $CodigoPK['ID_ADITIVO_CONTRATO_CP'][0] . "',
                    '" . $VO->ID_ORGAO_GESTOR_ESTAGIO . "',
                    '" . $VO->ID_AGENCIA_ESTAGIO . "',
                    '" . $VO->ID_CONTRATO_CP . "',
                    SEMAD.F_G_COD_ADITIVO_CONTRATO_CP(),
                    '" . $VO->NB_VALOR_ESTIMADO . "',
                    '" . $VO->TX_OBJETO . "',  
                    '" . $VO->TX_TERMO_ADITIVO . "',     
                    TO_DATE('" . $VO->DT_ADITIVO . "','DD/MM/YYYY'),
                    TO_DATE('" . $VO->DT_INICIO_VIGENCIA . "','DD/MM/YYYY'),
                    TO_DATE('" . $VO->DT_FIM_VIGENCIA . "','DD/MM/YYYY'),
                    SYSDATE,
                    SYSDATE,
                    " . $_SESSION['ID_USUARIO'] . ",
                    " . $_SESSION['ID_USUARIO'] . ")";
        $retorno = $this->sql($query);
        return $retorno ? '' : $CodigoPK['ID_ADITIVO_CONTRATO_CP'][0];
    }

    function buscar($VO) {

        $query = "SELECT AC.ID_ADITIVO_CONTRATO_CP,
       AC.ID_ORGAO_GESTOR_ESTAGIO,
       AC.ID_AGENCIA_ESTAGIO,
       AC.ID_CONTRATO_CP,
       AC.NB_CODIGO,
       AC.NB_VALOR_ESTIMADO,
       AC.TX_OBJETO,
       AC.TX_TERMO_ADITIVO,
       AC.ID_USUARIO_CADASTRO,
       AC.ID_USUARIO_ATUALIZACAO,
       TO_CHAR(AC.DT_CADASTRO, 'DD/MM/YYYY') DT_CADASTRO,
       TO_CHAR(AC.DT_ATUALIZACAO, 'DD/MM/YYYY')DT_ATUALIZACAO,
       TO_CHAR(AC.DT_ADITIVO, 'DD/MM/YYYY')DT_ADITIVO,
       TO_CHAR(AC.DT_INICIO_VIGENCIA, 'DD/MM/YYYY')DT_INICIO_VIGENCIA,
       TO_CHAR(AC.DT_FIM_VIGENCIA, 'DD/MM/YYYY')DT_FIM_VIGENCIA,
       VFT_CAD.TX_FUNCIONARIO TX_FUNCIONARIO_CAD,
       VFT_ATUAL.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL
  FROM ADITIVO_CONTRATO_CP AC,
       USUARIO U_CAD,
       USUARIO U_ATUAL,
       V_FUNCIONARIO_TOTAL VFT_CAD,
       V_FUNCIONARIO_TOTAL VFT_ATUAL
 WHERE AC.ID_USUARIO_CADASTRO = U_CAD.ID_USUARIO
   AND U_CAD.ID_PESSOA_FUNCIONARIO = VFT_ATUAL.ID_PESSOA_FUNCIONARIO
   AND AC.ID_USUARIO_ATUALIZACAO = U_ATUAL.ID_USUARIO
   AND U_ATUAL.ID_PESSOA_FUNCIONARIO = VFT_CAD.ID_PESSOA_FUNCIONARIO
   AND AC.ID_USUARIO_CADASTRO = U_CAD.ID_USUARIO
   AND AC.ID_USUARIO_ATUALIZACAO = U_ATUAL.ID_USUARIO
   AND ID_ADITIVO_CONTRATO_CP = '" . $VO->ID_ADITIVO_CONTRATO_CP . "'                     
";

        return $this->sqlVetor($query);
    }

    function alterar($VO) {

        $query = "UPDATE ADITIVO_CONTRATO_CP SET
                                        ID_ORGAO_GESTOR_ESTAGIO = '" . $VO->ID_ORGAO_GESTOR_ESTAGIO . "' ,
                                        ID_AGENCIA_ESTAGIO = '" . $VO->ID_AGENCIA_ESTAGIO . "',
                                        ID_CONTRATO_CP = '" . $VO->ID_CONTRATO_CP . "',
                                        NB_VALOR_ESTIMADO = '" . $VO->NB_VALOR_ESTIMADO . "',
                                        DT_ADITIVO =  TO_DATE('" . $VO->DT_ADITIVO . "','DD/MM/YYYY'),
                                        DT_INICIO_VIGENCIA =  TO_DATE('" . $VO->DT_INICIO_VIGENCIA . "','DD/MM/YYYY'),
                                        DT_FIM_VIGENCIA = TO_DATE('" . $VO->DT_FIM_VIGENCIA . "','DD/MM/YYYY'),
                                        TX_OBJETO = '" . $VO->TX_OBJETO . "',
                                        DT_ATUALIZACAO = SYSDATE,
                                        ID_USUARIO_ATUALIZACAO = " . $_SESSION['ID_USUARIO'] . "
                                  WHERE ID_ADITIVO_CONTRATO_CP = '" . $VO->ID_ADITIVO_CONTRATO_CP . "'";

        return $this->sql($query);
    }

    function excluir($VO) {

        $query = "DELETE FROM ADITIVO_CONTRATO_CP
                  WHERE ID_ADITIVO_CONTRATO_CP = '" . $VO->ID_ADITIVO_CONTRATO_CP . "'
                            ";
        return $this->sql($query);
    }

}

?>