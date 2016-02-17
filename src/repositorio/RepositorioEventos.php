<?php
require_once $path."src/repositorio/Repositorio.php";

class RepositorioEventos extends Repositorio{

    function pesquisarEventos($VO){

        $query="SELECT I.ID_ITEM_PAGAMENTO_ESTAGIO, I.TX_CODIGO, I.TX_DESCRICAO, I.TX_SIGLA, TO_CHAR(I.DT_CADASTRO,'DD/MM/YYYY HH24:MI:SS') DT_CADASTRO,
                TO_CHAR(I.DT_ATUALIZACAO,'DD/MM/YYYY HH24:MI:SS') DT_ATUALIZACAO, I.CS_TIPO, DECODE(I.CS_TIPO, 1,'Crédito', 2,'Débito', 3, 'Informativo') TX_TIPO, CS_SITUACAO, DECODE(I.CS_SITUACAO, 1, 'Ativado', 2, 'Desativado') TX_SITUACAO
                FROM SEMAD.ITEM_PAGAMENTO_ESTAGIO I ";

        $AUX = " WHERE ";

        IF ($VO->ID_ITEM_PAGAMENTO_ESTAGIO){
            $query .= $AUX." I.ID_ITEM_PAGAMENTO_ESTAGIO = ".$VO->ID_ITEM_PAGAMENTO_ESTAGIO;
            $AUX = " AND ";
        }

        IF ($VO->CS_TIPO){
            $query .= $AUX." I.CS_TIPO = ".$VO->CS_TIPO;
            $AUX = " AND ";
        }

        IF ($VO->CS_SITUACAO){
            $query .= $AUX." I.CS_SITUACAO = ".$VO->CS_SITUACAO;
                $AUX = " AND ";
        }

        IF ($VO->TX_CODIGO){
            $query .= $AUX." UPPER(I.TX_CODIGO) LIKE UPPER('%".$VO->TX_CODIGO."%')";
            $AUX = " AND ";
        }

        IF ($VO->TX_DESCRICAO){
            $query .= $AUX." UPPER(I.TX_DESCRICAO) LIKE UPPER('%".$VO->TX_DESCRICAO."%')";
            $AUX = " AND ";
        }

        return $this->sqlVetor($query);

    }

    function inserir($VO){

        $queryPK = "SELECT SEMAD.F_G_PK_ITEM_PAGAMENTO_ESTAGIO AS ID_ITEM_PAGAMENTO_ESTAGIO FROM DUAL";
        $this->sqlVetor($queryPK);
        $CodigoPK = $this->getVetor();

        $query = "
            INSERT INTO SEMAD.ITEM_PAGAMENTO_ESTAGIO (ID_ITEM_PAGAMENTO_ESTAGIO, TX_CODIGO, TX_DESCRICAO, TX_SIGLA, DT_CADASTRO,
                DT_ATUALIZACAO, CS_TIPO, CS_SITUACAO )
            VALUES
                (".$CodigoPK['ID_ITEM_PAGAMENTO_ESTAGIO'][0].", '".$VO->TX_CODIGO."', '".$VO->TX_DESCRICAO."', '".$VO->TX_SIGLA."', SYSDATE, SYSDATE, ".$VO->CS_TIPO.", ".$VO->CS_SITUACAO.")";

        $retorno = $this->sql($query);
        return $retorno ? '' : $CodigoPK['ID_ITEM_PAGAMENTO_ESTAGIO'][0];

    }

    function excluir($VO){

        $query = "
            DELETE FROM SEMAD.ITEM_PAGAMENTO_ESTAGIO
            WHERE ID_ITEM_PAGAMENTO_ESTAGIO = ".$VO->ID_ITEM_PAGAMENTO_ESTAGIO."
        ";

        return $this->sql($query);
    }

    function pesquisarBase($VO) {

        $query = "SELECT ID_ITEM_PAGAMENTO_ESTAGIO, NB_VALOR_BASE_ITEM_PAG, TO_CHAR(DT_CADASTRO,'DD/MM/YYYY hh24:mi:ss') DT_CADASTRO, TO_CHAR(DT_ATUALIZACAO,'DD/MM/YYYY hh24:mi:ss') DT_ATUALIZACAO, TO_CHAR(DT_INICIO_VIGENCIA,'DD/MM/YYYY') DT_INICIO_VIGENCIA, TO_CHAR(DT_FIM_VIGENCIA,'DD/MM/YYYY') DT_FIM_VIGENCIA, NB_VALOR_BASE, TX_DESCRICAO_BASE
                  FROM SEMAD.VALOR_BASE_ITEM_PAG
                  WHERE ID_ITEM_PAGAMENTO_ESTAGIO = ".$VO->ID_ITEM_PAGAMENTO_ESTAGIO;

        return $this->sqlVetor($query);
    }

    function alterar($VO){

        $query = "UPDATE SEMAD.ITEM_PAGAMENTO_ESTAGIO SET
                    TX_CODIGO = '".$VO->TX_CODIGO."',
                    TX_DESCRICAO = '".$VO->TX_DESCRICAO."',
                    TX_SIGLA = '".$VO->TX_SIGLA."',
                    CS_TIPO = ".$VO->CS_TIPO.",
                    CS_SITUACAO = ".$VO->CS_SITUACAO.",
                    DT_ATUALIZACAO = SYSDATE
                 WHERE
                    ID_ITEM_PAGAMENTO_ESTAGIO = '".$VO->ID_ITEM_PAGAMENTO_ESTAGIO."'";

        return $this->sql($query);
    }

    function inserirBase($VO){

        $query = "INSERT INTO SEMAD.VALOR_BASE_ITEM_PAG(ID_ITEM_PAGAMENTO_ESTAGIO, NB_VALOR_BASE_ITEM_PAG, DT_CADASTRO, DT_ATUALIZACAO, DT_INICIO_VIGENCIA, DT_FIM_VIGENCIA, NB_VALOR_BASE)
                  VALUES
                  (".$VO->ID_ITEM_PAGAMENTO_ESTAGIO.", SEMAD.F_G_PK_VALOR_BASE_ITEM_PAG(".$VO->ID_ITEM_PAGAMENTO_ESTAGIO."), SYSDATE, SYSDATE, TO_DATE('".$VO->DT_INICIO_VIGENCIA."','DD/MM/YYYY'), TO_DATE('".$VO->DT_FIM_VIGENCIA."','DD/MM/YYYY'), ".$VO->moeda($VO->NB_VALOR_BASE).")";

        return $this->sql($query);
    }


    function alterarBase($VO){

        $query = "UPDATE SEMAD.VALOR_BASE_ITEM_PAG SET
                    DT_INICIO_VIGENCIA = TO_DATE('".$VO->DT_INICIO_VIGENCIA."','DD/MM/YYYY'),
                    DT_FIM_VIGENCIA = TO_DATE('".$VO->DT_FIM_VIGENCIA."','DD/MM/YYYY'),
                    NB_VALOR_BASE = ".$VO->moeda($VO->NB_VALOR_BASE).",
                    DT_ATUALIZACAO = SYSDATE
                    WHERE
                    ID_ITEM_PAGAMENTO_ESTAGIO = ".$VO->ID_ITEM_PAGAMENTO_ESTAGIO."
                    AND NB_VALOR_BASE_ITEM_PAG = ".$VO->NB_VALOR_BASE_ITEM_PAG;

        return $this->sql($query);
    }

    function excluirBase($VO){

        $query = "
                   DELETE FROM SEMAD.VALOR_BASE_ITEM_PAG
                   WHERE ID_ITEM_PAGAMENTO_ESTAGIO = ".$_SESSION[ID_ITEM_PAGAMENTO_ESTAGIO]."
                   AND NB_VALOR_BASE_ITEM_PAG = ".$VO->NB_VALOR_BASE_ITEM_PAG."
                 ";

        return $this->sql($query);

    }

    function atualizarInfMaster($VO){

        $query = "UPDATE SEMAD.ITEM_PAGAMENTO_ESTAGIO SET
                    DT_ATUALIZACAO = SYSDATE
                 WHERE
                    ID_ITEM_PAGAMENTO_ESTAGIO = ".$VO->ID_ITEM_PAGAMENTO_ESTAGIO."";

        return $this->sql($query);
    }

}

?>