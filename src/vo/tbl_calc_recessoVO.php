<?php

require_once $pathvo."VO.php";
require_once $path."src/repositorio/RepositorioTBL_Calc_Recesso.php";

class tbl_calc_recessoVO extends VO{

    function tbl_calc_recessoVO(){
        return $this->repositorio = new RepositorioTBL_Calc_Recesso();
    }

    function pesquisarOrgaoGestor(){
        return $this->repositorio->pesquisarOrgaoGestor($this);
    }

    function pesquisarItemTBLRecesso(){
        return $this->repositorio->pesquisarItemTBLRecesso($this);
    }

    function atualizarInf(){
        return $this->repositorio->atualizarInf($this);
    }

    function inserirTBLRecesso(){
        return $this->repositorio->inserirTBLRecesso($this);
    }

    function excluirTBLRecesso(){
        return $this->repositorio->excluirTBLRecesso($this);
    }

    function buscarTBLRecesso(){
        return $this->repositorio->buscarTBLRecesso($this);
    }

    function alterarTBLRecesso(){
        return $this->repositorio->alterarTBLRecesso($this);
    }
}
?>
