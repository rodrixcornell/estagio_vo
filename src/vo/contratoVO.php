<?php

require_once $pathvo . "VO.php";
require_once $path . "src/repositorio/RepositorioContrato.php";

class contratoVO extends VO {

    function contratoVO() {
        return $this->repositorio = new RepositorioContrato();
    }

    //################## --------------- VO das Funções dos combosBox ------------------##################
    /*
     * SÃO as funções:
     * 
     *               buscarOrgaoGesto();
     *               buscarOrgaoSolicitante();
     *               buscarCodSelecao();
     *               buscarTipoVaga();
     *               buscarQuadroVaga();
     *               buscarCandidato();
     *               buscarEstagiario();
     *               buscarInstituicaoDeEnsino();
     *               buscarAgenteIntegracao();
     *               buscarSupervisor();
     *               buscarCurso();
     *               
     * 
     *  */

    function buscarBolsa() {
        // Função que pega todas as bolsas de estagio
        return $this->repositorio->buscarBolsa($this);
    }

    function buscarSupervisor() {
        // Função que pega todos os Supervisores
        return $this->repositorio->buscarSupervisor($this);
    }

    function buscarOrgaoGestor() {
        // Função que pega todos os orgãos Getores
        return $this->repositorio->buscarOrgaoGestor($this);
    }

    function buscarCandidato() {
        // Função que pega todos os Cadidatos de uma seleção
        return $this->repositorio->buscarCandidato($this);
    }

    function buscarTipoVaga() {
        // Função que pega todos os tipos de vagas
        return $this->repositorio->buscarTipoVaga($this);
    }

    function buscarInstituicaoDeEnsino() {
        // Função que busca Todas as Instuições de Ensino
        return $this->repositorio->buscarInstituicaoDeEnsino($this);
    }

    function buscarAgenteIntegracao() {
        // Função que pega todas as Agencias de Estagio
        return $this->repositorio->buscarAgenteIntegracao($this);
    }

    function buscarCurso() {
        // Função que pega todos os cursos disponiveis no Banco
        return $this->repositorio->buscarCurso($this);
    }

    function buscarLotacao() {
        // Função que pega todas as lotações de um Orgão Solicitante
        return $this->repositorio->buscarLotacao($this);
    }

    function buscarQuadroVaga() {
        //Função que pegas todos os quadros de vagas
        return $this->repositorio->buscarQuadroVaga($this);
    }

    function buscarOrgaoSolicitante() {
        // Função que pega todos os Orgãos Solicitantes a qual o Usuario pertence
        return $this->repositorio->buscarOrgaoSolicitante($this);
    }

    function buscarCodSelecao() {
        // Função que pega todso os codigos das seleções de orgão Solicitante
        return $this->repositorio->buscarCodSelecao($this);
    }

    //############################ --------------- FIM VO Funções dos combosBox--------------------##################################
    // ###########################------------------- BUSCA ENDEREÇO ORGAO E SECRATARIO -----------################################## 
    /* UTILIZADA NA TELA DE CADASTRAR ....
     * QUANDO O USUARIO CLICAR EM ORGÃO GESTOR(COMBO BOX) AUTOMATICAMENTE CARREGA OS CAMPOS DO ENDEREÇO E DO SECRETARIO DO ORGÃO GESTOR
     */

    function buscarSecretarioOrgaoGestor() {
        //Função que o Secretario do Orgão Gestor e Carrega no campo desabilitado o tpl
        return $this->repositorio->buscarSecretarioOrgaoGestor($this);
    }

    function buscarEnderecoOrgaoGestor() {
        //Função que pega o Enredereço do orgão gestor 
        return $this->repositorio->buscarEnderecoOrgaoGestor($this);
    }

    function buscarDocuments() {
        //Função que pega o Enredereço do orgão gestor 
        return $this->repositorio->buscarDocuments($this);
    }
    function buscarCargoSupervisor() {
        //Função que pega O CARGO DO SUPERVISOR
        return $this->repositorio->buscarCargoSupervisor($this);
    }

    // ###########################---------------- FIM BUSCA ENDEREÇO ORGAO E SECRATARIO -----------################################## 
}

?>