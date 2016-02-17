<?php

require_once $pathvo . "VO.php";
require_once $path . "src/repositorio/RepositorioTipo_Pagamento.php";

class tipo_pagamentoVO extends VO {

    function tipo_pagamentoVO() {
        return $this->repositorio = new RepositorioTipo_Pagamento();
    }

    function pesquisar() {
        return $this->repositorio->pesquisar($this);
    }

    function inserir() {
        return $this->repositorio->inserir($this);
    }

    function alterar() {
        return $this->repositorio->alterar($this);
    }

    function buscar() {
        return $this->repositorio->buscar($this);
    }

    function pesquisarTipo() {
        return $this->repositorio->pesquisarTipo($this);
    }

}

?>
