<?php

require_once $pathvo."VO.php";
require_once $path."src/repositorio/RepositorioOferta_vaga.php";
require_once $pathvo . "solicitacaoPDF.php";
require_once $path."php/phpmailer_connect.php";

class oferta_vagaVO extends VO{

    function oferta_vagaVO(){
        return $this->repositorio = new RepositorioOferta_vaga();
    }

    function pesquisarOrgaoGestor(){
        return $this->repositorio->pesquisarOrgaoGestor($this);
    }

    function pesquisarOrgaoSolicitante(){
        return $this->repositorio->pesquisarOrgaoSolicitante($this);
    }

	function buscarAgenciaEstagio(){
        return $this->repositorio->buscarAgenciaEstagio($this);
    }

    function buscarQuadroVagasEstagio(){
        return $this->repositorio->buscarQuadroVagasEstagio($this);
    }

    function pesquisarTipoVaga(){
        return $this->repositorio->pesquisarTipoVaga($this);
    }

    function buscarQuantidade(){
        return $this->repositorio->buscarQuantidade($this);
    }

    function buscarCursos(){
        return $this->repositorio->buscarCursos($this);
    }

    function pesquisarVagasSolicitadas(){
        return $this->repositorio->pesquisarVagasSolicitadas($this);
    }

    function inserirVagasSolicitadas(){
        return $this->repositorio->inserirVagasSolicitadas($this);
    }

    function excluirVagasSolicitadas(){
        return $this->repositorio->excluirVagasSolicitadas($this);
    }

    function buscarVagasSolicitadas(){
        return $this->repositorio->buscarVagasSolicitadas($this);
    }

    function alterarVagasSolicitadas(){
        return $this->repositorio->alterarVagasSolicitadas($this);
    }

    function atualizarInf(){
        return $this->repositorio->atualizarInf($this);
    }

	function verificarRecrutamento(){
        return $this->repositorio->verificarRecrutamento($this);
    }

	function efetivarSolicitacao(){
        return $this->repositorio->efetivarSolicitacao($this);
    }

	function buscarQuadroVagas(){
        return $this->repositorio->buscarQuadroVagas($this);
    }

	function buscarTipoVaga(){
        return $this->repositorio->buscarTipoVaga($this);
    }

	function buscarNomeOrgao(){
        return $this->repositorio->buscarNomeOrgao($this);
    }

	function pesquisarValorBolsa(){
        return $this->repositorio->pesquisarValorBolsa($this);
    }

	function verficarGestor(){
        return $this->repositorio->verficarGestor($this);
    }

	function efetivarOferta(){
        return $this->repositorio->efetivarOferta($this);
    }

	function encaminharOferta(){
        return $this->repositorio->encaminharOferta($this);
    }

	function buscarAgencia(){
        return $this->repositorio->buscarAgencia($this);
    }

	function gerarPDF(){
		global $pathArquivo;
		$pdf = new PDF();
		$pdf->titulo = 'OFERTA DE VAGA PARA ESTÁGIO';
		$pdf->tamanho = '18';
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->conteudo();
		//$pdf->Output();
		$pdf->Output($pathArquivo.'solicitacao/oferta_'.$this->ID_OFERTA_VAGA.'.pdf', 'F');

    }


    function  enviarEmailEfetivado(){
		global $path, $url, $pathArquivo;
   		$phpmailer = new phpmailer_connect();
		$phpmailer->CharSet = 'UTF-8';
		$phpmailer->SetLanguage("br", $path."php/phpmailer/language/");

		$this->repositorio->buscarAgencia($this);
		$dados = $this->getVetor();

		$assunto  = "Oferta de Vaga - ".$dados['TX_CODIGO_OFERTA_VAGA'][0].' - Efetivada';
		$titulo   = "<strong>Oferta de Vaga - ".$dados['TX_CODIGO_OFERTA_VAGA'][0].' - Efetivada</strong>';
		$mensagem = "Foi efetivado uma Oferta de Vaga solicitado pelo órgao <strong>".$dados['TX_ORGAO_ESTAGIO'][0]." </strong> de código <strong>".$dados['TX_CODIGO_OFERTA_VAGA'][0]."</strong> em <strong>".$dados['DT_ATUALIZACAO'][0]."</strong> para sua análise e encaminhamento a agência de estágio através do <strong>Sistema de Gestão de Estágio Remunerado</strong> disponível em <a href=\"".$url."src/solicitacao/?s=1\">LINK</a>.";

		$html = $titulo."<br /><br />".$mensagem." <br /><br /><br /><br /><br /><br />
		Desenvolvido pelo Departamento de Sistemas e Tecnologias da Informa&ccedil;&atilde;o - DSTI / 2009-".date('Y')."<br />
		Suporte: (92) 8842-7838 / 8855-1465 - sistemaspmm@pmm.am.gov.br<br />
		Secretaria Municipal de Administra&ccedil;&atilde;o - SEMAD";


		$phpmailer->Subject = $assunto;
		$phpmailer->Body    = $html;
		$phpmailer->AltBody = $html;
		$phpmailer->SetFrom('sistemas.semad@pmm.am.gov.br', 'Sistemas PMM - Gestão de Estágio Remunerado');
		$phpmailer->AddAttachment($pathArquivo."solicitacao/oferta_".$this->ID_OFERTA_VAGA.".pdf", "Oferta_Vaga_".$dados['TX_CODIGO_OFERTA_VAGA'][0].".pdf");

		$total = $this->repositorio->buscarEmails($this);

		if ($total){
			$email = $this->getVetor();

			for($i=0; $i<$total; $i++){
				if($i==0)
					$phpmailer->AddAddress($email['TX_EMAIL'][$i]);
				else
					$phpmailer->AddCC($email['TX_EMAIL'][$i]);
			}

			$phpmailer->Send();
		}

    }

	function  enviarEmailAgencia(){
		global $path, $url, $pathArquivo;
   		$phpmailer = new phpmailer_connect();
		$phpmailer->CharSet = 'UTF-8';
		$phpmailer->SetLanguage("br", $path."php/phpmailer/language/");

		$this->repositorio->buscarAgencia($this);
		$dados = $this->getVetor();

		$this->ID_AGENCIA_ESTAGIO = $dados['ID_AGENCIA_ESTAGIO'][0];

		$assunto  = "Oferta de Vaga";
		$titulo   = "<strong>Oferta de Vaga </strong>";
		$mensagem = "Oferta de Vaga <br />
						Segue em anexo formulário de oferta de vaga.<br />
						Órgao: <strong>".$dados['TX_ORGAO_ESTAGIO'][0]." </strong> <br />
						Código: <strong>".$dados['TX_CODIGO_OFERTA_VAGA'][0]."</strong><br />
						Data: <strong>".$dados['DT_ATUALIZACAO'][0]."</strong>";

		$html = $titulo."<br /><br />".$mensagem." <br /><br /><br /><br /><br /><br />
		Desenvolvido pelo Departamento de Sistemas e Tecnologias da Informa&ccedil;&atilde;o - DSTI / 2009-".date('Y')."<br />
		Suporte: (92) 8842-7838 / 8855-1465 - sistemaspmm@pmm.am.gov.br<br />
		Secretaria Municipal de Administra&ccedil;&atilde;o - SEMAD";


		$phpmailer->Subject = $assunto;
		$phpmailer->Body    = $html;
		$phpmailer->AltBody = $html;
		$phpmailer->SetFrom('sistemas.semad@pmm.am.gov.br', 'Sistemas PMM - Gestão de Estágio Remunerado');
		$phpmailer->AddAttachment($pathArquivo."solicitacao/oferta_".$this->ID_OFERTA_VAGA.".pdf", "Oferta_Vaga_".$dados['TX_CODIGO_OFERTA_VAGA'][0].".pdf");

		$total = $this->repositorio->buscarEmailAgencia($this);

		if ($total){
			$email = $this->getVetor();

			for($i=0; $i<$total; $i++){
				if($i==0)
					$phpmailer->AddAddress($email['TX_EMAIL'][$i]);
				else
					$phpmailer->AddCC($email['TX_EMAIL'][$i]);
			}

			$phpmailer->Send();
		}

    }





}
?>
