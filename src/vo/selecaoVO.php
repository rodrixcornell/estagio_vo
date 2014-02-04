<?php

require_once $pathvo . "VO.php";
require_once $path . "src/repositorio/RepositorioSelecao.php";
require_once $path."php/phpmailer_connect.php";

class selecaoVO extends VO {

    function selecaoVO() {
        return $this->repositorio = new RepositorioSelecao();
    }

    function buscarOrgaoGestor() {
        return $this->repositorio->buscarOrgaoGestor($this);
    }

    function buscarSolicitante() {
        return $this->repositorio->buscarSolicitante($this);
    }

    function buscarOfertaVaga() {
        return $this->repositorio->buscarOfertaVaga($this);
    }

    function buscarOrgaoSolicitante() {
        return $this->repositorio->buscarOrgaoSolicitante($this);
    }

    function verficarGestor() {
        return $this->repositorio->verficarGestor($this);
    }

//
    function verificarSituacaoAnalise() {
        return $this->repositorio->verificarSituacaoAnalise($this);
    }

//
    function verificarContrato() {
        return $this->repositorio->verificarContrato($this);
    }

    function checaCPF() {
        return $this->repositorio->checaCPF($this);
    }

    function buscarCPF() {
        return $this->repositorio->buscarCPF($this);
    }

    function buscarCandidatoVaga() {
        return $this->repositorio->buscarCandidatoVaga($this);
    }

    function pesquisarCandidatos() {
        return $this->repositorio->pesquisarCandidatos($this);
    }

    function inserirCandidato() {
        return $this->repositorio->inserirCandidato($this);
    }

    function inserirEstagiario() {
        return $this->repositorio->inserirEstagiario($this);
    }

    function alterarEstagiario() {
        return $this->repositorio->alterarEstagiario($this);
    }

    function buscarCandidatoEstagiario() {
        return $this->repositorio->buscarCandidatoEstagiario($this);
    }

    function buscarDadosOfertaVaga() {
        return $this->repositorio->buscarDadosOfertaVaga($this);
    }

    function buscarCursoEstagio() {
        return $this->repositorio->buscarCursoEstagio($this);
    }

    function buscarTurno() {
        return $this->repositorio->buscarTurno($this);
    }

    function buscarInstituicaoEnsino() {
        return $this->repositorio->buscarInstituicaoEnsino($this);
    }

    function buscarTipoVagaEstagio() {
        return $this->repositorio->buscarTipoVagaEstagio($this);
    }

    function buscarBolsaEstagio() {
        return $this->repositorio->buscarBolsaEstagio($this);
    }

    function buscarSupervisorEstagio() {
        return $this->repositorio->buscarSupervisorEstagio($this);
    }

    function alterarCandidatoComMotivo() {
        return $this->repositorio->alterarCandidatoComMotivo($this);
    }

    function alterarCandidatoSemMotivo() {
        return $this->repositorio->alterarCandidatoSemMotivo($this);
    }

    function atualizarInf() {
        return $this->repositorio->atualizarInf($this);
    }

    function excluirCandidato() {
        return $this->repositorio->excluirCandidato($this);
    }

    function efetivarSelecao() {
        return $this->repositorio->efetivarSelecao($this);
    }

    function buscarAprovados() {
        return $this->repositorio->buscarAprovados($this);
    }

    function alterarCandidatoAprovado() {
        return $this->repositorio->alterarCandidatoAprovado($this);
    }

    function buscarSelecao() {
        return $this->repositorio->buscarSelecao($this);
    }

    function encaminharSelecao() {
        return $this->repositorio->encaminharSelecao($this);
    }

    function autorizarSelecao() {
        return $this->repositorio->autorizarSelecao($this);
    }

    function buscarAgencia() {
        return $this->repositorio->buscarAgencia($this);
    }

    function enviarEmailEfetivado() {

        global $path, $url, $pathArquivo;
        $phpmailer = new phpmailer_connect();
        $phpmailer->Priority = '1';
        $phpmailer->CharSet = 'UTF-8';
        $phpmailer->SetLanguage("br", $path . "php/phpmailer/language/");

        // Conteudo do Email
        //$this->repositorio->buscarAprovados($this);
        $this->repositorio->buscarSelecao($this);
        $dados = $this->getVetor();

        $assunto = "Seleção de Candidato - " . $dados['TX_COD_SELECAO'][0] . ' - Efetivada';
        $titulo = "<strong>Seleção de Candidato - " . $dados['TX_COD_SELECAO'][0] . ' - Efetivada</strong>';
        $mensagem = "Foi efetivado uma <strong>Seleção de Candidato</strong> solicitado pelo órgao <strong>" . $dados['TX_ORGAO_ESTAGIO'][0] . " </strong> de código <strong>" . $dados['TX_COD_SELECAO'][0] . "</strong> em <strong>" . $dados['DT_ATUALIZACAO'][0]
                . "</strong> para sua análise e encaminhamento a agência de estágio através do <strong>Sistema de Gestão de Estágio Remunerado</strong> disponível em <a href=\"" . $url . "src/selecao/?s=1\">LINK</a>.";
        $html = $titulo . "<br /><br />" . $mensagem . " <br /><br /><br /><br /><br /><br />
        Desenvolvido pelo Departamento de Sistemas e Tecnologias da Informa&ccedil;&atilde;o - DSTI / 2009-" . date('Y') . "<br />
        Suporte: (92) 8842-7838 / 8855-1465 - sistemaspmm@pmm.am.gov.br<br />
        Secretaria Municipal de Administra&ccedil;&atilde;o - SEMAD";

        $phpmailer->Subject = $assunto;
        $phpmailer->Body = $html;
        $phpmailer->AltBody = $html;
        $phpmailer->SetFrom('sistemas.semad@pmm.am.gov.br', 'Sistemas PMM - Gestão de Estágio Remunerado');
        //$phpmailer->AddAttachment($pathArquivo . "solicitacao/oferta_" . $this->ID_OFERTA_VAGA . ".pdf", "Oferta_Vaga_" . $dados['TX_COD_SELECAO'][0] . ".pdf");

        $total = $this->repositorio->buscarEmails($this);

        if ($total) {
            $email = $this->getVetor();

            for ($i = 0; $i < $total; $i++) {
                if ($i == 0)
                    $phpmailer->AddAddress($email['TX_EMAIL'][$i]);
                else
                    $phpmailer->AddCC($email['TX_EMAIL'][$i]);
            }
            $phpmailer->Send();
        }
    }

    function enviarEmailAgencia() {

        global $path, $url, $pathArquivo;
        $phpmailer = new phpmailer_connect();
        $phpmailer->Priority = '1';
        $phpmailer->CharSet = 'UTF-8';
        $phpmailer->SetLanguage("br", $path . "php/phpmailer/language/");

        // Conteudo do Email
        $this->repositorio->buscarAprovados($this);
//        $dados = $this->getVetor();
//        $this->repositorio->buscarSelecao($this);
        $dados = $this->getVetor();


        $assunto = "Emição de TCE para Candidatos - " . $dados['TX_COD_SELECAO'][0] . ' - Efetivada';
        $titulo = "<strong>Seleção de Candidato - " . $dados['TX_COD_SELECAO'][0] . ' - Efetivada</strong>';
        $mensagem = "Foi efetivado uma <strong>Seleção de Candidato</strong> solicitado pelo órgao <strong>" . $dados['TX_ORGAO_ESTAGIO'][0] . " </strong> de código <strong>" . $dados['TX_COD_SELECAO'][0] . "</strong> em <strong>" . $dados['DT_ATUALIZACAO'][0]
                . "</strong> para sua análise e encaminhamento a agência de estágio através do <strong>Sistema de Gestão de Estágio Remunerado</strong> disponível em <a href=\"" . $url . "src/selecao/?s=1\">LINK</a>.";
        $html = $titulo . "<br /><br />" . $mensagem . " <br /><br /><br /><br /><br /><br />
        Desenvolvido pelo Departamento de Sistemas e Tecnologias da Informa&ccedil;&atilde;o - DSTI / 2009-" . date('Y') . "<br />
        Suporte: (92) 8842-7838 / 8855-1465 - sistemaspmm@pmm.am.gov.br<br />
        Secretaria Municipal de Administra&ccedil;&atilde;o - SEMAD";

        $phpmailer->Subject = $assunto;
        $phpmailer->Body = $html;
        $phpmailer->AltBody = $html;
        $phpmailer->SetFrom('sistemas.semad@pmm.am.gov.br', 'Sistemas PMM - Gestão de Estágio Remunerado');
        //$phpmailer->AddAttachment($pathArquivo . "solicitacao/oferta_" . $this->ID_OFERTA_VAGA . ".pdf", "Oferta_Vaga_" . $dados['TX_COD_SELECAO'][0] . ".pdf");

        $total = $this->repositorio->buscarEmailAgencia($this);

        if ($total) {
            $email = $this->getVetor();

            for ($i = 0; $i < $total; $i++) {
                if ($i == 0)
                    $phpmailer->AddAddress($email['TX_EMAIL'][$i]);
                else
                    $phpmailer->AddCC($email['TX_EMAIL'][$i]);
            }
            print_r($phpmailer);
            $phpmailer->Send();
        }
    }
}

?>
