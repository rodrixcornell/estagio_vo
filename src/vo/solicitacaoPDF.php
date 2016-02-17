<?php

include "../../php/define.php";
require_once "../../php/fpdf/fpdf.php";
require_once $pathvo . "solicitacaoVO.php";
session_start();

class PDF extends FPDF {

    //Page Header

    function Header() {
        global $pathimg;
        $VO = new solicitacaoVO();
        $VO->ID_OFERTA_VAGA = $_SESSION['ID_OFERTA_VAGA'];
        $VO->buscarAgencia();
        $dados = $VO->getVetor();

        //Logotipo
        if ($dados['ID_AGENCIA_ESTAGIO'][0] == 62)
            $this->Image($pathimg . 'topo/ciee.png', 9, 4, 35, 15);
        else if ($dados['ID_AGENCIA_ESTAGIO'][0] == 2)
            $this->Image($pathimg . 'topo/iel.png', 10, 3, 40, 15);

        $this->Ln(12);
        $this->SetFont('Helvetica', 'B', 12);
        $this->Image($pathimg . 'topo/logoPrefeitura.gif', 155, 3, 47, 23);
        $this->SetFillColor(220);
        $this->MultiCell(192, 6, utf8_decode($this->titulo), 0, 'C', true);
        $this->MultiCell(192, 6, utf8_decode('Lei nº 11.788/2008'), 'B', 'C', true);
        $this->Ln();
    }

    function Footer() {
        /* //Position at 1.5 cm from bottom
          $this->SetY(-15);
          //Helvetica italic 8
          $this->SetFont('Helvetica', 'I', 8);
          //Page number
          $this->SetLineWidth('0.2');
          $this->Cell(260, 4, utf8_decode('Desenvolvido pelo Departamento de Sistemas e Tecnologias da Informação - DSTI / 2009-') . date('Y'), 'T', 0, 'L');
          $this->Cell(20, 4, date('d/m/Y H:i:s'), 'T', 1, 'R');
          $this->Cell(275, 4, 'Suporte: (92) 8842-7838 / 8855-1465 - sistemaspmm@pmm.am.gov.br', '', 1, 'L');
          $this->Cell(260, 4, 'http://semad.manaus.am.gov.br', '', 0, 'L');
          $this->Cell(20, 4, utf8_decode('Página ') . $this->PageNo() . ' de {nb}', '', 1, 'L'); */
    }

    function conteudo() {

        $VO = new solicitacaoVO();
        $VO->ID_OFERTA_VAGA = $_SESSION['ID_OFERTA_VAGA'];
        $VO->buscar();
        $dados = $VO->getVetor();

        if ($dados['ID_AGENCIA_ESTAGIO'] == 2) {
            $this->SetFont('Helvetica', 'BU', 9);
            $this->Cell(192, 5, utf8_decode('PARA USO DO IEL/AM:'), 0, 1, 'L');
            $this->SetFont('Helvetica', 'I', 8);
            $this->Cell(55, 6, utf8_decode('Nº REGISTRO:'), 'B', 0, 'L');
            $this->Cell(78, 6, utf8_decode('Nº OFERTA:'), 'B', 0, 'L');
            $this->Cell(35, 6, utf8_decode('DATA:         /         /'), 'LB', 0, 'L');
            $this->Cell(24, 6, utf8_decode('VISTO:'), 'L', 1, 'L');

            $this->Cell(168, 6, utf8_decode('RESPONSÁVEL PELO ATENDIMENTO:'), 'BR', 0, 'L');
            $this->Cell(24, 6, '', 'B', 1, 'L');
        }


        $this->SetFont('Helvetica', 'BU', 9);
        $this->Cell(192, 5, utf8_decode('PARA USO DA EMPRESA:'), 0, 1, 'L');

        //----------------------DADOS DA SOLICITANTE ---------------------//
        $this->SetFont('Helvetica', 'B', 9);
        $this->SetFillColor(79, 129, 189);
        $this->SetTextColor(255, 255, 255);
        $this->MultiCell(192, 6, utf8_decode('DADOS DA SOLICITANTE'), 'TB', 'C', true);

        $this->SetTextColor(0);
        $this->SetFont('Helvetica', '', 8);
        $this->Cell(43, 6, utf8_decode('ÓRGÃO PÚBLICO MUNICIPAL:'), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(109, 6, utf8_decode(substr(mb_strtoupper($dados['TX_ORGAO'][0]), 0, 63)), 'BR', 0, 'L');
        $this->SetFont('Helvetica', '', 8);
        $this->Cell(10, 6, utf8_decode('CNPJ:'), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(30, 6, utf8_decode(substr($dados['TX_CNPJ'][0], 0, 67)), 'B', 1, 'L');

        $this->SetFont('Helvetica', '', 8);
        $this->Cell(34, 6, utf8_decode('PESSOA DE CONTATO:'), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(86, 6, utf8_decode(substr(mb_strtoupper($dados['TX_PESSOA_CONTATO'][0]), 0, 50)), 'BR', 0, 'L');
        $this->SetFont('Helvetica', '', 8);
        $this->Cell(19, 6, utf8_decode('TELEFONE:'), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(53, 6, utf8_decode(substr(mb_strtoupper($dados['TX_TELEFONE'][0]), 0, 52)), 'B', 1, 'L');

        $this->SetFont('Helvetica', '', 8);
        $this->Cell(25, 6, utf8_decode('CARGO/FUNÇÃO:'), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(65, 6, utf8_decode(substr(mb_strtoupper($dados['TX_CARGO_FUNCAO'][0]), 0, 35)), 'BR', 0, 'L');
        $this->SetFont('Helvetica', '', 8);
        $this->Cell(11, 6, utf8_decode('EMAIL:'), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(91, 6, utf8_decode(mb_strtolower($dados['TX_EMAIL'][0])), 'B', 1, 'L');

        //----------------------INFORMACOES DA VAGA---------------------//
        $this->SetFont('Helvetica', 'B', 9);
        $this->SetFillColor(79, 129, 189);
        $this->SetTextColor(255, 255, 255);
        $this->MultiCell(192, 6, utf8_decode('INFORMAÇÕES DA VAGA'), 'TB', 'C', true);

        $this->SetTextColor(0);
        $this->SetFont('Helvetica', '', 8);
        $this->Cell(34, 6, utf8_decode('DATA DA SOLICITAÇÃO:'), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(158, 6, utf8_decode($dados['DT_ATUALIZACAO_REL'][0]), 'B', 1, 'L');
        $this->SetFont('Helvetica', '', 8);
        $this->Cell(45, 6, utf8_decode('ENDEREÇO PARA ENTREVISTA:'), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(147, 6, utf8_decode(substr(mb_strtoupper($dados['TX_ENDERECO'][0]), 0, 84)), 'B', 1, 'L');

        $this->SetFont('Helvetica', '', 8);
        $this->Cell(36, 6, utf8_decode('PONTO DE REFERÊNCIA:'), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(125, 6, utf8_decode(substr(mb_strtoupper($dados['TX_PONTO_REFERENCIA'][0]), 0, 71)), 'B', 0, 'L');
        $this->SetFont('Helvetica', '', 8);
        $this->Cell(17, 6, utf8_decode('Nº ONIBUS:'), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(14, 6, utf8_decode(substr(mb_strtoupper($dados['TX_NUM_ONIBUS'][0]), 0, 7)), 'B', 1, 'L');

        $this->SetFont('Helvetica', '', 8);
        $this->Cell(31, 6, utf8_decode('Nº TOTAL DE VAGAS:'), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(15, 6, utf8_decode($dados['NB_QUANTIDADE'][0]), 'BR', 0, 'L');
        $this->SetFont('Helvetica', '', 8);
        $this->Cell(89, 6, utf8_decode('Nº DE ALUNOS A SEREM ENCAMINHADOS PARA ENTREVISTA:'), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(57, 6, utf8_decode($dados['NB_QTDE_EMCAMINHADO'][0]), 'B', 1, 'L');

        $this->SetFont('Helvetica', '', 8);
        $this->Cell(38, 6, utf8_decode('DATA PARA ENTREVISTA:'), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(47, 6, utf8_decode($dados['DT_ENTREVISTA'][0]), 'BR', 0, 'L');
        $this->SetFont('Helvetica', '', 8);
        $this->Cell(39, 6, utf8_decode('HORÁRIO DA ENTREVISTA:'), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(68, 6, utf8_decode(substr(mb_strtoupper($dados['TX_HORARIO'][0]), 0, 38)), 'B', 1, 'L');

        $this->SetFont('Helvetica', '', 8);
        $this->Cell(47, 6, utf8_decode('DURAÇÃO DO ESTÁGIO (meses):'), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(8, 6, utf8_decode($dados['NB_DURACAO_ESTAGIO'][0]), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(137, 6, utf8_decode('(minimo de 06 meses e máximo de 24 meses, conforme Lei n.º 11.788/2008, art. 11).'), 'B', 1, 'L');

        //----------------------BENFICIOS AO ESTAGIARIO---------------------//
        $this->SetFont('Helvetica', 'B', 9);
        $this->SetFillColor(0);
        $this->SetTextColor(255, 255, 255);
        $this->MultiCell(192, 5, utf8_decode('BENEFÍCIOS AO ESTAGIÁRIO'), 'TB', 'C', true);

        $this->SetTextColor(0);
        $this->SetFont('Helvetica', '', 8);

        $this->Cell(32, 7, utf8_decode('VALOR DA BOLSA: R$'), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(18, 7, utf8_decode(number_format($dados['NB_VALOR'][0], 2, ',', '.')), 'BR', 0, 'L');
        $this->SetFont('Helvetica', '', 8);
        $this->Cell(142, 7, utf8_decode('BENEFÍCIOS:'), 'B', 0, 'L');
        $this->Ln(2);

        $this->SetX(82);
        $this->Cell(3, 3, 'X', 1, 0, 'C');
        $this->Cell(20, 3, utf8_decode('Transporte: R$ '), 0, 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(25, 3, utf8_decode(number_format($dados['NB_VALOR_TRANSPORTE'][0], 2, ',', '.')), 0, 0, 'L');

        $this->SetFont('Helvetica', '', 8);
        $this->Cell(3, 3, '', 1, 0, 'C');
        $this->Cell(40, 3, utf8_decode('Alimentação: R$'), 0, 0, 'L');

        $this->Cell(3, 3, '', 1, 0, 'C');
        $this->Cell(16, 3, utf8_decode('Assist. Médica'), 0, 0, 'L');
        $this->Ln(5);

        //----------------------REQUISITOS DA OFERTA---------------------//
        $this->SetFont('Helvetica', 'B', 9);
        $this->SetFillColor(0);
        $this->SetTextColor(255, 255, 255);
        $this->MultiCell(192, 5, utf8_decode('REQUISITOS DA OFERTA'), 'TB', 'C', true);

        $this->SetTextColor(0);
        $this->SetFont('Helvetica', '', 8);

        $this->Cell(192, 7, utf8_decode('NÍVEL DE ESCOLARIDADE:'), 'B', 0, 'L');

        $this->Ln(2);
        $this->SetX(55);

        $this->Cell(3, 3, ($dados['CS_ESCOLARIDADE'][0] == 1) ? 'X' : '', 1, 0, 'C');
        $this->Cell(30, 3, utf8_decode('Médio'), 0, 0, 'L');

        $this->Cell(3, 3, ($dados['CS_ESCOLARIDADE'][0] == 2) ? 'X' : '', 1, 0, 'C');
        $this->Cell(30, 3, utf8_decode('Técnico'), 0, 0, 'L');

        $this->Cell(3, 3, ($dados['CS_ESCOLARIDADE'][0] == 3) ? 'X' : '', 1, 0, 'C');
        $this->Cell(30, 3, utf8_decode('Superior'), 0, 0, 'L');

        $this->Cell(3, 3, ($dados['CS_ESCOLARIDADE'][0] == 4) ? 'X' : '', 1, 0, 'C');
        $this->Cell(30, 3, utf8_decode('Educação Especial'), 0, 0, 'L');

        $this->Ln(5);

        $this->Cell(29, 7, utf8_decode('CURSO DESEJADO:'), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(95, 7, utf8_decode(substr(mb_strtoupper($dados['TX_CURSO_ESTAGIO'][0]), 0, 54)), 'BR', 0, 'L');
        $this->SetFont('Helvetica', '', 8);
        $this->Cell(39, 7, utf8_decode('ANO/SEMESTRE/MÓDULO:'), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(29, 7, utf8_decode($dados['NB_SEMESTRE'][0]), 'B', 1, 'L');

        $this->SetFont('Helvetica', '', 8);
        $this->Cell(34, 7, utf8_decode('HORÁRIO DO ESTÁGIO:'), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(55, 7, utf8_decode($dados['TX_HORA_INICIO'][0] . ' A ' . $dados['TX_HORA_FINAL'][0]), 'B', 0, 'L');
        $this->SetFont('Helvetica', '', 8);
        $this->Cell(103, 7, utf8_decode('(conforme Lei 11.788/2008, art. 10).'), 'B', 1, 'L');

        $this->Cell(46, 7, utf8_decode('OUTROS HORÁRIOS (se houver):'), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(146, 7, utf8_decode(mb_strtoupper($dados['TX_OUTROS_HORARIOS'][0])), 'B', 1, 'L');

        //----------------------HABILIDADES DO ALUNO---------------------//
        $this->SetFont('Helvetica', 'B', 9);
        $this->SetFillColor(0);
        $this->SetTextColor(255, 255, 255);
        $this->MultiCell(192, 5, utf8_decode('HABILIDADES DO ALUNO'), 'TB', 'C', true);

        $this->SetTextColor(0);
        $this->SetFont('Helvetica', '', 8);


        $this->Cell(192, 7, utf8_decode('INFORMÁTICA BÁSICA:'), 'B', 0, 'L');

        $this->Ln(2);
        $this->SetX(55);

        $this->Cell(3, 3, ($dados['CS_WINDOWS'][0]) ? 'X' : '', 1, 0, 'C');
        $this->Cell(28, 3, utf8_decode('Windows'), 0, 0, 'L');

        $this->Cell(3, 3, ($dados['CS_WORD'][0]) ? 'X' : '', 1, 0, 'C');
        $this->Cell(28, 3, utf8_decode('Word'), 0, 0, 'L');

        $this->Cell(3, 3, ($dados['CS_EXCEL'][0]) ? 'X' : '', 1, 0, 'C');
        $this->Cell(28, 3, utf8_decode('Excel'), 0, 0, 'L');

        $this->Cell(3, 3, ($dados['CS_POWERPOINT'][0]) ? 'X' : '', 1, 0, 'C');
        $this->Cell(28, 3, utf8_decode('Power Point'), 0, 0, 'L');

        $this->Cell(3, 3, ($dados['CS_INTERNET'][0]) ? 'X' : '', 1, 0, 'C');
        $this->Cell(28, 3, utf8_decode('Internet'), 0, 0, 'L');

        $this->Ln(5);

        //------------

        $this->Cell(192, 7, utf8_decode('INFORMÁTICA AVANÇADA:'), 'B', 0, 'L');

        $this->Ln(2);
        $this->SetX(65);

        $this->Cell(3, 3, ($dados['CS_WINDOWS'][0]) ? 'X' : '', 1, 0, 'C');
        $this->Cell(30, 3, utf8_decode('Corel Draw'), 0, 0, 'L');

        $this->Cell(3, 3, ($dados['CS_WORD'][0]) ? 'X' : '', 1, 0, 'C');
        $this->Cell(30, 3, utf8_decode('Photoshop'), 0, 0, 'L');

        $this->Cell(3, 3, ($dados['CS_EXCEL'][0]) ? 'X' : '', 1, 0, 'C');
        $this->Cell(30, 3, utf8_decode('Web Design'), 0, 0, 'L');

        $this->Cell(3, 3, ($dados['CS_POWERPOINT'][0]) ? 'X' : '', 1, 0, 'C');
        $this->Cell(30, 3, utf8_decode('AutoCAD'), 0, 0, 'L');

        $this->Ln(5);

        //------------

        $this->Cell(192, 7, utf8_decode('LÍNGUA ESTRANGEIRA:'), 'B', 0, 'L');

        $this->Ln(2);
        $this->SetX(55);

        $this->Cell(3, 3, ($dados['CS_INGLES'][0]) ? 'X' : '', 1, 0, 'C');
        $this->Cell(20, 3, utf8_decode('Inglês'), 0, 0, 'L');

        $this->Cell(3, 3, ($dados['CS_ESPANHOL'][0]) ? 'X' : '', 1, 0, 'C');
        $this->Cell(20, 3, utf8_decode('Espanhol'), 0, 0, 'L');

        $this->Cell(3, 3, ($dados['CS_FRANCES'][0]) ? 'X' : '', 1, 0, 'C');
        $this->Cell(20, 3, utf8_decode('Francês'), 0, 0, 'L');

        $this->Cell(3, 3, ($dados['CS_ALEMAO'][0]) ? 'X' : '', 1, 0, 'C');
        $this->Cell(17, 3, utf8_decode('Alemão'), 0, 0, 'L');

        $this->Cell(13, 3, utf8_decode('OUTRA:'), 0, 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(68, 3, utf8_decode(substr(mb_strtoupper($dados['TX_OUTRAS_LINGUAS'][0]), 0, 26)), 0, 0, 'L');
        $this->SetFont('Helvetica', '', 8);
        $this->Ln(5);

        $this->Cell(58, 7, utf8_decode('OUTROS PRÉ-REQUISITOS DESEJÁVEIS:'), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(134, 7, utf8_decode(substr(mb_strtoupper($dados['TX_OUTROS_REQUISITOS'][0]), 0, 76)), 'B', 1, 'L');

        $this->SetFont('Helvetica', '', 8);
        $this->Cell(192, 7, utf8_decode('SEXO:'), 'B', 0, 'L');

        $this->Ln(2);
        $this->SetX(30);

        $this->Cell(3, 3, ($dados['CS_SEXO'][0] == 2) ? 'X' : '', 1, 0, 'C');
        $this->Cell(30, 3, utf8_decode('Feminimo'), 0, 0, 'L');

        $this->Cell(3, 3, ($dados['CS_SEXO'][0] == 1) ? 'X' : '', 1, 0, 'C');
        $this->Cell(30, 3, utf8_decode('Masculino'), 0, 0, 'L');

        $this->Ln(5);

        //----------------------PRINCIPAIS ATIVIDADES A SEREM DESEMPENHADAS PELO ESTAGIARIO---------------------//
        $this->SetFont('Helvetica', 'B', 9);
        $this->SetFillColor(0);
        $this->SetTextColor(255, 255, 255);
        $this->MultiCell(192, 5, utf8_decode('PRINCIPAIS ATIVIDADES A SEREM DESEMPENHADAS PELO ESTAGIÁRIO'), 'TB', 'C', true);

        $this->SetTextColor(0);
        $this->SetFont('Helvetica', 'B', 8);

        $this->MultiCell(192, 5, utf8_decode($dados['TX_ATIVIDADES'][0]), 'BT', 'L');
        $this->SetFont('Helvetica', '', 8);
        $this->Cell(26, 7, utf8_decode('OBSERVAÇÕES:'), 'B', 0, 'L');
        $this->SetFont('Helvetica', 'B', 8);
        $this->Cell(166, 7, utf8_decode(substr(mb_strtoupper($dados['TX_OBSERVACAO'][0]), 0, 93)), 'B', 1, 'L');

        $this->Ln(13);
        $this->Cell(45, 5);
        $this->SetFont('Helvetica', 'I', 8);
        $this->Cell(100, 5, utf8_decode('Carimbo e Assinatura do Agente Setorial ou Responsável'), 'T', 0, 'C');
    }

}

?>
