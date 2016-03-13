<?php
require_once $pathvo . "VO.php";
require_once $path . "src/repositorio/RepositorioInstituicao_estagio.php";

class instituicao_estagioVO extends VO {

    function instituicao_estagioVO() {
        $this->repositorio = new RepositorioInstituicao_estagio();
    }

}

?>