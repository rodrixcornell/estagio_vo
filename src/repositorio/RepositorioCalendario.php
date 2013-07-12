<?php

require_once $path . "src/repositorio/Repositorio.php";

class RepositorioCalendario extends Repositorio {

//----------------pesquisa orgão gestor--------------------
    function pesquisarOrgaoGestor($VO) {
        $query = "
            select oge.ID_ORGAO_GESTOR_ESTAGIO CODIGO,
                   oge.TX_ORGAO_GESTOR_ESTAGIO
              from ORGAO_GESTOR_ESTAGIO oge
          order by TX_ORGAO_GESTOR_ESTAGIO
        ";

        return $this->sqlVetor($query);
    }

//----------------pesquisa calendário folha pag--------------------
    function pesquisar($VO) {
        $query = "
            select cfp.ID_CALENDARIO_FOLHA_PAG,
                    cfp.ID_ORGAO_GESTOR_ESTAGIO,
                    cfp.NB_ANO_REFERENCIA,
                    cfp.NB_MES_REFERENCIA,
                    to_char(cfp.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,
                    to_char(cfp.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
                    oge.TX_ORGAO_GESTOR_ESTAGIO
               from CALENDARIO_FOLHA_PAG cfp,
                    ORGAO_GESTOR_ESTAGIO oge
              where (cfp.ID_ORGAO_GESTOR_ESTAGIO = oge.ID_ORGAO_GESTOR_ESTAGIO)
                and (cfp.ID_ORGAO_GESTOR_ESTAGIO = " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ") ";

        ($VO->NB_ANO_REFERENCIA) ? $query .= " and (cfp.NB_ANO_REFERENCIA = '" . $VO->NB_ANO_REFERENCIA . "') " : false;

        ($VO->NB_MES_REFERENCIA) ? $query .= " and (cfp.NB_MES_REFERENCIA = '" . $VO->NB_MES_REFERENCIA . "') " : false;

        $query .= "
              order by NB_ANO_REFERENCIA desc,
                    NB_MES_REFERENCIA desc,
                    DT_ATUALIZACAO desc,
                    DT_CADASTRO desc";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

    function inserir($VO) {
        $queryPK = "select SEMAD.F_G_PK_CALENDARIO_FOLHA_PAG as ID_CALENDARIO_FOLHA_PAG from dual";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "
            INSERT
                INTO CALENDARIO_FOLHA_PAG
                (ID_CALENDARIO_FOLHA_PAG, DT_CADASTRO, DT_ATUALIZACAO, ID_ORGAO_GESTOR_ESTAGIO, NB_ANO_REFERENCIA, NB_MES_REFERENCIA)
                values
                (" . $CodigoPK['ID_CALENDARIO_FOLHA_PAG'][0] . ",
                 SYSDATE,
                 SYSDATE,
                 " . $VO->ID_ORGAO_GESTOR_ESTAGIO . ",
                 " . $VO->NB_ANO_REFERENCIA . ",
                 " . $VO->NB_MES_REFERENCIA . ")";

        $retorno = $this->sql($query);
        if (!$retorno) {
            return $CodigoPK['ID_CALENDARIO_FOLHA_PAG'][0];
        }
    }

    function buscar($VO) {
        $query = "
            select cfp.ID_CALENDARIO_FOLHA_PAG,
                    cfp.ID_ORGAO_GESTOR_ESTAGIO,
                    cfp.NB_ANO_REFERENCIA,
                    cfp.NB_MES_REFERENCIA,
                    to_char(cfp.DT_CADASTRO, 'dd/mm/yyyy hh24:mi:ss') DT_CADASTRO,
                    to_char(cfp.DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO,
                    oge.TX_ORGAO_GESTOR_ESTAGIO
               from CALENDARIO_FOLHA_PAG cfp,
                    ORGAO_GESTOR_ESTAGIO oge
              where (cfp.ID_ORGAO_GESTOR_ESTAGIO = oge.ID_ORGAO_GESTOR_ESTAGIO)
                and (cfp.ID_CALENDARIO_FOLHA_PAG = " . $VO->ID_CALENDARIO_FOLHA_PAG . ")";

        return $this->sqlVetor($query);
    }

    function excluir($VO) {
        $query = "
            delete
               from CALENDARIO_FOLHA_PAG
              where ID_CALENDARIO_FOLHA_PAG = " . $VO->ID_CALENDARIO_FOLHA_PAG;

        return $this->sql($query);
    }

    function alterar($VO) {
        $query = "
            update CALENDARIO_FOLHA_PAG
                set DT_ATUALIZACAO = sysdate,
                    NB_ANO_REFERENCIA = " . $VO->NB_ANO_REFERENCIA . ",
                    NB_MES_REFERENCIA = " . $VO->NB_MES_REFERENCIA . "
              where ID_CALENDARIO_FOLHA_PAG = " . $VO->ID_CALENDARIO_FOLHA_PAG;

        return $this->sql($query);
    }

    function atualizarInf($VO) {

        $query = "
            update CALENDARIO_FOLHA_PAG
                set DT_ATUALIZACAO = sysdate
              where ID_CALENDARIO_FOLHA_PAG = " . $VO->ID_CALENDARIO_FOLHA_PAG;

        $this->sql($query);

        $data = "
            select to_char(DT_ATUALIZACAO, 'dd/mm/yyyy hh24:mi:ss') DT_ATUALIZACAO
               from CALENDARIO_FOLHA_PAG
              where ID_CALENDARIO_FOLHA_PAG = " . $VO->ID_CALENDARIO_FOLHA_PAG;

        $this->sqlVetor($data);
        $datahora = $this->getVetor();

        return $datahora;
    }

    function pesquisarGrupoPagamento($VO) {
        $query = "
            select gp.ID_GRUPO_PAGAMENTO CODIGO, gp.TX_GRUPO_PAGAMENTO
               from GRUPO_PAGAMENTO gp";

        if (!$VO->NB_NOT_IN) {
            $query .= "
                  where gp.ID_GRUPO_PAGAMENTO
                    not in (select ID_GRUPO_PAGAMENTO from ITEM_CALENDARIO where ID_CALENDARIO_FOLHA_PAG = " . $VO->ID_CALENDARIO_FOLHA_PAG . ")
            ";
        }

        $query .= "
              order by gp.TX_GRUPO_PAGAMENTO";

        return $this->sqlVetor($query);
    }

    function pesquisarItemCalendario($VO) {
        $query = "
            select ic.ID_CALENDARIO_FOLHA_PAG,
                    ic.ID_GRUPO_PAGAMENTO,
                    ic.ID_CALENDARIO_FOLHA_PAG ||'_'|| ic.ID_GRUPO_PAGAMENTO CODIGO,
                    to_char(ic.DT_FECHAMENTO, 'dd/mm/yyyy') DT_FECHAMENTO,
                    to_char(ic.DT_ENCAM_DOC, 'dd/mm/yyyy') DT_ENCAM_DOC,
                    to_char(ic.DT_TRANSF_BANCO, 'dd/mm/yyyy') DT_TRANSF_BANCO,
                    to_char(ic.DT_PAGAMENTO, 'dd/mm/yyyy') DT_PAGAMENTO,
                    to_char(ic.DT_INICIO_TRANSF_ESTAG, 'dd/mm/yyyy') DT_INICIO_TRANSF_ESTAG,
                    to_char(ic.DT_FIM_TRANSF_ESTAG, 'dd/mm/yyyy') DT_FIM_TRANSF_ESTAG,
                    gp.TX_GRUPO_PAGAMENTO
               from ITEM_CALENDARIO ic,
                    GRUPO_PAGAMENTO gp
              where ic.ID_GRUPO_PAGAMENTO = gp.ID_GRUPO_PAGAMENTO
                and ic.ID_CALENDARIO_FOLHA_PAG = " . $VO->ID_CALENDARIO_FOLHA_PAG . "
             order by DT_FECHAMENTO desc,
                   DT_PAGAMENTO desc,
                   DT_FIM_TRANSF_ESTAG desc,
                   DT_INICIO_TRANSF_ESTAG desc";

        if ($VO->Reg_quantidade) {
            !$VO->Reg_inicio ? $VO->Reg_inicio = 0 : false;
            $query = "SELECT * FROM (SELECT PAGING.*, ROWNUM PAGING_RN FROM (" . $query . ") PAGING WHERE (ROWNUM <= " . ($VO->Reg_quantidade + $VO->Reg_inicio) . "))  WHERE (PAGING_RN > " . $VO->Reg_inicio . ")";
        }

        return $this->sqlVetor($query);
    }

    function inserirItemCalendario($VO) {
        $query = "
            insert
                into ITEM_CALENDARIO
                    (ID_CALENDARIO_FOLHA_PAG, ID_GRUPO_PAGAMENTO,
                     DT_FECHAMENTO, DT_ENCAM_DOC, DT_TRANSF_BANCO, DT_PAGAMENTO, DT_INICIO_TRANSF_ESTAG, DT_FIM_TRANSF_ESTAG)
                values
                    (" . $VO->ID_CALENDARIO_FOLHA_PAG . ",
                     " . $VO->ID_GRUPO_PAGAMENTO . ",
                     to_date('" . $VO->DT_FECHAMENTO . "', 'dd/mm/yyyy'),
                     to_date('" . $VO->DT_ENCAM_DOC . "', 'dd/mm/yyyy'),
                     to_date('" . $VO->DT_TRANSF_BANCO . "', 'dd/mm/yyyy'),
                     to_date('" . $VO->DT_PAGAMENTO . "', 'dd/mm/yyyy'),
                     to_date('" . $VO->DT_INICIO_TRANSF_ESTAG . "', 'dd/mm/yyyy'),
                     to_date('" . $VO->DT_FIM_TRANSF_ESTAG . "', 'dd/mm/yyyy'))";

        return $this->sql($query);
    }

    function excluirItemCalendario($VO) {

        $query = "
            delete
               from ITEM_CALENDARIO
              where ID_CALENDARIO_FOLHA_PAG = " . $VO->ID_CALENDARIO_FOLHA_PAG . "
                and ID_GRUPO_PAGAMENTO = " . $VO->ID_GRUPO_PAGAMENTO . "
      ";

        return $this->sql($query);
    }

    function buscarItemCalendario($VO) {
        $query = "
            select ic.ID_CALENDARIO_FOLHA_PAG,
                    ic.ID_GRUPO_PAGAMENTO,
                    to_char(ic.DT_FECHAMENTO, 'dd/mm/yyyy') DT_FECHAMENTO,
                    to_char(ic.DT_ENCAM_DOC, 'dd/mm/yyyy') DT_ENCAM_DOC,
                    to_char(ic.DT_TRANSF_BANCO, 'dd/mm/yyyy') DT_TRANSF_BANCO,
                    to_char(ic.DT_PAGAMENTO, 'dd/mm/yyyy') DT_PAGAMENTO,
                    to_char(ic.DT_INICIO_TRANSF_ESTAG, 'dd/mm/yyyy') DT_INICIO_TRANSF_ESTAG,
                    to_char(ic.DT_FIM_TRANSF_ESTAG, 'dd/mm/yyyy') DT_FIM_TRANSF_ESTAG
               from ITEM_CALENDARIO ic
              where ic.ID_GRUPO_PAGAMENTO = " . $VO->ID_GRUPO_PAGAMENTO ."
                and ic.ID_CALENDARIO_FOLHA_PAG = " . $VO->ID_CALENDARIO_FOLHA_PAG;

        return $this->sqlVetor($query);
    }

    function alterarItemCalendario($VO) {
        $query = "
            update ITEM_CALENDARIO
                set DT_FECHAMENTO = to_date('" . $VO->DT_FECHAMENTO . "', 'dd/mm/yyyy'),
                    DT_ENCAM_DOC = to_date('" . $VO->DT_ENCAM_DOC . "', 'dd/mm/yyyy'),
                    DT_TRANSF_BANCO = to_date('" . $VO->DT_TRANSF_BANCO . "', 'dd/mm/yyyy'),
                    DT_PAGAMENTO = to_date('" . $VO->DT_PAGAMENTO . "', 'dd/mm/yyyy'),
                    DT_INICIO_TRANSF_ESTAG = to_date('" . $VO->DT_INICIO_TRANSF_ESTAG . "', 'dd/mm/yyyy'),
                    DT_FIM_TRANSF_ESTAG = to_date('" . $VO->DT_FIM_TRANSF_ESTAG . "', 'dd/mm/yyyy'),
                    ID_GRUPO_PAGAMENTO = " . $VO->ID_GRUPO_PAGAMENTO . "
              where ID_GRUPO_PAGAMENTO = " . $VO->ID_GRUPO_PAGAMENTO_OLD ."
                and ID_CALENDARIO_FOLHA_PAG = " . $VO->ID_CALENDARIO_FOLHA_PAG;

        return $this->sql($query);
    }
}
?>