<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioTBL_Calc_Recesso extends Repositorio {

    function pesquisarOrgaoGestor($VO) {
        $query = "
            select oge.ID_ORGAO_GESTOR_ESTAGIO CODIGO,
                    oge.TX_ORGAO_GESTOR_ESTAGIO
               from ORGAO_GESTOR_ESTAGIO oge
             order by TX_ORGAO_GESTOR_ESTAGIO
        ";

        return $this->sqlVetor($query);
    }

    function pesquisar($VO) {
        $query = "
            select tr.ID_TABELA_RECESSO,
                    to_char(tr.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,
                    to_char(tr.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
                    tr.ID_USUARIO_CADASTRO,
                    tr.ID_USUARIO_ATUALIZACAO,
                    tr.TX_TABELA,
                    tr.ID_ORGAO_GESTOR_ESTAGIO,
                    to_char(tr.DT_INICIO_VIGENCIA, 'dd/mm/yyyy') DT_INICIO_VIGENCIA,
                    to_char(tr.DT_FIM_VIGENCIA, 'dd/mm/yyyy') DT_FIM_VIGENCIA,
                    oge.TX_ORGAO_GESTOR_ESTAGIO
               from TABELA_RECESSO tr,
                    ORGAO_GESTOR_ESTAGIO oge
              where tr.ID_ORGAO_GESTOR_ESTAGIO = oge.ID_ORGAO_GESTOR_ESTAGIO ";

        ($VO->ID_ORGAO_GESTOR_ESTAGIO) ? $query .= " and (tr.ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ") " : false;
        ($VO->TX_TABELA) ? $query .= " and (tr.TX_TABELA like '%" . $VO->TX_TABELA . "%') " : false;
        ($VO->DT_INICIO_VIGENCIA) ? $query .= " and (tr.DT_INICIO_VIGENCIA = to_date('" . $VO->DT_INICIO_VIGENCIA . "', 'dd/mm/yyyy')) " : false;
        ($VO->DT_FIM_VIGENCIA) ? $query .= " and (tr.DT_FIM_VIGENCIA = to_date('" . $VO->DT_FIM_VIGENCIA . "', 'dd/mm/yyyy')) " : false;

        $query .= "
              order by tr.DT_FIM_VIGENCIA,
                    tr.DT_INICIO_VIGENCIA desc,
                    tr.TX_TABELA,
                    oge.TX_ORGAO_GESTOR_ESTAGIO";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

    function inserir($VO) {
        $queryPK = "select SEMAD.F_G_PK_Tabela_Recesso as ID_TABELA_RECESSO from dual";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "
            insert
                into TABELA_RECESSO
                (ID_TABELA_RECESSO, DT_CADASTRO, DT_ATUALIZACAO, ID_USUARIO_CADASTRO, ID_USUARIO_ATUALIZACAO,
                 TX_TABELA, ID_ORGAO_GESTOR_ESTAGIO, DT_INICIO_VIGENCIA, DT_FIM_VIGENCIA)
                values
                (" . $CodigoPK['ID_TABELA_RECESSO'][0] . ",
                 SYSDATE,
                 SYSDATE,
                 " . $_SESSION['ID_USUARIO'] . ",
                 " . $_SESSION['ID_USUARIO'] . ",
                 '" . $VO->TX_TABELA . "',
                 " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ",
                 to_date('" . $VO->DT_INICIO_VIGENCIA . "', 'dd/mm/yyyy'),
                 to_date('" . $VO->DT_FIM_VIGENCIA . "', 'dd/mm/yyyy'))";

        $retorno = $this->sql($query);

        if (!$retorno) {
            return $CodigoPK['ID_TABELA_RECESSO'][0];
        }
    }

    function buscar($VO) {
        $query = "
            select tr.ID_TABELA_RECESSO,
                    to_char(tr.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,
                    to_char(tr.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
                    tr.ID_USUARIO_CADASTRO, tr.ID_USUARIO_ATUALIZACAO,
                    upper(tr.TX_TABELA) TX_TABELA, tr.ID_ORGAO_GESTOR_ESTAGIO,
                    to_char(tr.DT_INICIO_VIGENCIA, 'dd/mm/yyyy') DT_INICIO_VIGENCIA,
                    to_char(tr.DT_FIM_VIGENCIA, 'dd/mm/yyyy') DT_FIM_VIGENCIA,
                    oge.TX_ORGAO_GESTOR_ESTAGIO,
                    vft_cad.TX_FUNCIONARIO TX_FUNCIONARIO_CAD,
                    vft_atual.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL
               from TABELA_RECESSO tr,
                    ORGAO_GESTOR_ESTAGIO oge,
                    USUARIO u_cad,
                    USUARIO u_atual,
                    V_FUNCIONARIO_TOTAL vft_cad,
                    V_FUNCIONARIO_TOTAL vft_atual
              where tr.ID_ORGAO_GESTOR_ESTAGIO = oge.ID_ORGAO_GESTOR_ESTAGIO
                    and tr.ID_USUARIO_CADASTRO = u_cad.ID_USUARIO
                    and tr.ID_USUARIO_ATUALIZACAO = u_atual.ID_USUARIO
                    and u_cad.ID_PESSOA_FUNCIONARIO = vft_cad.ID_PESSOA_FUNCIONARIO
                    and u_cad.ID_UNIDADE_GESTORA = vft_cad.ID_UNIDADE_GESTORA
                    and u_atual.ID_PESSOA_FUNCIONARIO = vft_atual.ID_PESSOA_FUNCIONARIO
                    and u_atual.ID_UNIDADE_GESTORA = vft_atual.ID_UNIDADE_GESTORA
                    and tr.ID_TABELA_RECESSO = " . $VO->ID_TABELA_RECESSO;

        return $this->sqlVetor($query);
    }

    function excluir($VO) {
        $query = "
            delete
               from TABELA_RECESSO
              where ID_TABELA_RECESSO = " . $VO->ID_TABELA_RECESSO;

        return $this->sql($query);
    }

    function alterar($VO) {
        $query = "
            update TABELA_RECESSO
                set DT_ATUALIZACAO = SYSDATE,
                    ID_USUARIO_ATUALIZACAO = " . $_SESSION['ID_USUARIO'] . ",
                    TX_TABELA = '" . $VO->TX_TABELA . "',
                    DT_INICIO_VIGENCIA = to_date('" . $VO->DT_INICIO_VIGENCIA . "', 'dd/mm/yyyy'),
                    DT_FIM_VIGENCIA = to_date('" . $VO->DT_FIM_VIGENCIA . "', 'dd/mm/yyyy')
              where ID_TABELA_RECESSO = " . $VO->ID_TABELA_RECESSO;

        return $this->sql($query);
    }

    function pesquisarItemTBLRecesso($VO) {
        $query = "
            select itr.ID_TABELA_RECESSO,
                    itr.NB_ITEM_TAB_RECESSO,
                    to_char(itr.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,
                    to_char(itr.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
                    itr.TX_DURACAO_ESTAGIO,
                    itr.NB_DURACAO_RECESSO,
                    itr.TX_FORMULA_RECESSO,
                    itr.ID_USUARIO_CADASTRO,
                    itr.ID_USUARIO_ATUALIZACAO
               from ITEM_TAB_RECESSO itr
              where itr.ID_TABELA_RECESSO = " . $VO->ID_TABELA_RECESSO . "
              order by DT_ATUALIZACAO desc,
                    DT_CADASTRO desc,
                    TX_DURACAO_ESTAGIO desc,
                    NB_DURACAO_RECESSO desc
        ";

        return $this->sqlVetor($query);
    }

    function atualizarInf($VO) {

        $query = "
            update TABELA_RECESSO
                set DT_ATUALIZACAO = sysdate,
                    ID_USUARIO_ATUALIZACAO = " . $_SESSION['ID_USUARIO'] . "
              where ID_TABELA_RECESSO = " . $VO->ID_TABELA_RECESSO;

        $this->sql($query);

        $data = "
            select to_char(a.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO, c.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL
               from TABELA_RECESSO a, USUARIO b, V_FUNCIONARIO_USUARIO c
              where a.ID_TABELA_RECESSO = " . $VO->ID_TABELA_RECESSO . "
                and a.ID_USUARIO_ATUALIZACAO = b.ID_USUARIO
                and b.ID_PESSOA_FUNCIONARIO = c.ID_PESSOA_FUNCIONARIO
                and b.ID_UNIDADE_GESTORA = c.ID_UNIDADE_GESTORA";

        $this->sqlVetor($data);
        $datahora = $this->getVetor();

        return $datahora;
    }

    function inserirTBLRecesso($VO) {
        $queryPK = "select SEMAD.F_G_PK_ITEM_TAB_RECESSO(" . $VO->ID_TABELA_RECESSO . ") as NB_ITEM_TAB_RECESSO from dual";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "
            insert
               into ITEM_TAB_RECESSO
                    (ID_TABELA_RECESSO, NB_ITEM_TAB_RECESSO, DT_CADASTRO, DT_ATUALIZACAO, ID_USUARIO_CADASTRO, ID_USUARIO_ATUALIZACAO,
                     TX_DURACAO_ESTAGIO, NB_DURACAO_RECESSO, TX_FORMULA_RECESSO)
             values
                    (" . $VO->ID_TABELA_RECESSO . ",
                     " . $CodigoPK['NB_ITEM_TAB_RECESSO'][0] . ",
                     SYSDATE,
                     SYSDATE,
                     " . $_SESSION['ID_USUARIO'] . ",
                     " . $_SESSION['ID_USUARIO'] . ",
                     '" . $VO->TX_DURACAO_ESTAGIO . "',
                     " . $VO->NB_DURACAO_RECESSO . ",
                     '" . $VO->TX_FORMULA_RECESSO . "')";

        return $this->sql($query);
    }

    function excluirTBLRecesso($VO) {
        $query = "
            delete
               from ITEM_TAB_RECESSO
              where (ID_TABELA_RECESSO = " . $VO->ID_TABELA_RECESSO . ")
                and (NB_ITEM_TAB_RECESSO = " . $VO->NB_ITEM_TAB_RECESSO . ")";

        return $this->sql($query);
    }

    function buscarTBLRecesso($VO) {
        $query = "
            select itr.ID_TABELA_RECESSO, itr.NB_ITEM_TAB_RECESSO,
                    itr.TX_DURACAO_ESTAGIO, itr.NB_DURACAO_RECESSO, itr.TX_FORMULA_RECESSO,
                    to_char(itr.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,
                    to_char(itr.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
                    itr.ID_USUARIO_CADASTRO, itr.ID_USUARIO_ATUALIZACAO,
                    vft_cad.TX_FUNCIONARIO TX_FUNCIONARIO_CAD, vft_atual.TX_FUNCIONARIO TX_FUNCIONARIO_ATUAL
               from ITEM_TAB_RECESSO itr, USUARIO u_cad, USUARIO u_atual,
                    V_FUNCIONARIO_TOTAL vft_cad, V_FUNCIONARIO_TOTAL vft_atual
              where (itr.ID_USUARIO_CADASTRO = u_cad.ID_USUARIO)
                and (itr.ID_USUARIO_ATUALIZACAO = u_atual.ID_USUARIO)
                and (u_cad.ID_PESSOA_FUNCIONARIO = vft_cad.ID_PESSOA_FUNCIONARIO)
                and (u_cad.ID_UNIDADE_GESTORA = vft_cad.ID_UNIDADE_GESTORA)
                and (u_atual.ID_PESSOA_FUNCIONARIO = vft_atual.ID_PESSOA_FUNCIONARIO)
                and (u_atual.ID_UNIDADE_GESTORA = vft_atual.ID_UNIDADE_GESTORA)
                and (itr.ID_TABELA_RECESSO = " . $VO->ID_TABELA_RECESSO . ")
                and (itr.NB_ITEM_TAB_RECESSO = " . $VO->NB_ITEM_TAB_RECESSO . ")";

        return $this->sqlVetor($query);
    }

    function alterarTBLRecesso($VO) {
        $query = "
            update ITEM_TAB_RECESSO
                set DT_ATUALIZACAO = sysdate,
                    ID_USUARIO_ATUALIZACAO = " . $_SESSION['ID_USUARIO'] . ",
                    TX_DURACAO_ESTAGIO = '" . $VO->TX_DURACAO_ESTAGIO . "',
                    NB_DURACAO_RECESSO = " . $VO->NB_DURACAO_RECESSO . ",
                    TX_FORMULA_RECESSO = '" . $VO->TX_FORMULA_RECESSO . "'
              where (ID_TABELA_RECESSO = " . $VO->ID_TABELA_RECESSO . ")
                and (NB_ITEM_TAB_RECESSO = " . $VO->NB_ITEM_TAB_RECESSO . ")";

        return $this->sql($query);
    }
}
?>