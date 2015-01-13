<?php
include "../../php/define.php";
require_once "../../php/fpdf/fpdf.php";
require_once $pathvo . "selecaoVO.php";
require_once $path . "src/selecao/arrays.php";
session_start();

class PDF extends FPDF {

    // A4 = 210x297
    // margem 10mm
    // área A4 = 190x277
    //Page Header
    function Header() {
        global $pathimg;
        $VO = new selecaoVO();
        $VO->ID_SELECAO_ESTAGIO = $_SESSION['ID_SELECAO_ESTAGIO'];
        $VO->buscarAgencia();
        $dados = $VO->getVetor();

        //Logotipo
        if ($dados['ID_AGENCIA_ESTAGIO'][0] == 62)
            $this->Image($pathimg . 'topo/ciee.png', 9, 4, 35, 15);
        else if ($dados['ID_AGENCIA_ESTAGIO'][0] == 2)
            $this->Image($pathimg . 'topo/iel.png', 10, 3, 40, 15);

        $this->Ln(12);
//        $this->SetFont('Helvetica', 'B', 12);
//        $this->Image($pathimg . 'topo/logoPrefeitura.gif', 155, 3, 47, 23);
//        $this->SetFillColor(220);
//        $this->MultiCell(192, 6, utf8_decode($this->titulo), 0, 'C', true);
//        $this->MultiCell(192, 6, utf8_decode('Lei nº 11.788/2008'), 'B', 'C', true);
//        $this->SetLineWidth('0.3');
        $this->Cell(190, 0, '', 1, 1, 1);
        $this->Ln(8);
    }

    function Footer() {
        //Position at 1.5 cm from bottom
        $this->SetY(-17);
        //Helvetica italic 8
        $this->SetFont('Helvetica', 'B', 9);
        //Page number
        //$this->SetLineWidth('0.3');
        //$this->Cell(20, 4, '', 1, 0);
        //$this->SetFillColor(255);
        $this->SetX(50);
        $this->MultiCell(110, 4, utf8_decode('IMPORTANTE: Para iniciar o estágio, o estudante tem que, obrigatoriamente, estar com o Termo de Compromisso de Estágio assinado pela Empresa e Escola. Sem este documento o estágio não estará sendo realizado em condições legais e seguras.'), 0, 'C', 0);
    }

    function Conteudo() {

        global $arrayMesExtenso;
        global $arrayCHSemanal;

        $VO = new selecaoVO();

        $VO->ID_SELECAO_ESTAGIO = $_SESSION['ID_SELECAO_ESTAGIO'];
        $VO->ID_PESSOA_ESTAGIARIO = $_REQUEST['ID_PESSOA_ESTAGIARIO'];

        $total = $VO->buscarAprovados();
        $total ? $dados = $VO->getVetor() : FALSE;
        //print_r($dados);

        $this->SetLineWidth('0.2');
        $this->SetFillColor(220);
        $this->SetFont('Helvetica', 'B', 7);
        $this->Cell(70, 4, utf8_decode('Ref.: Encaminhamento de Estudante - OE N°.'), 0, 0, 'L', 0);
        $this->SetFont('Helvetica', '', 9);
        $this->Cell(25, 4, utf8_decode('estágio'), 'B', 1, 'L', 0);

        $this->SetFont('Helvetica', 'I', 9);
        $this->Cell(140, 4, 'Empresa:', 0, 1, 'R', 0);
        $this->SetFont('Helvetica', '', 7);
        $this->Cell(125, 4, 'Prezado Senhor(es)(a):', 0, 0, 'L', 0);
        $this->Cell(0, 4, '', 0, 1, 'L', 1);
        $this->Cell(125, 4, utf8_decode('Conforme sua solicitação, estamos encaminhando o Estudante em:'), 0, 0, 'L', 0);
        $this->Cell(0, 4, '', 0, 1, 'L', 1);
        $this->Cell(125, 4, '', 0, 0, 'L', 0);
        $this->Cell(0, 4, '', 0, 1, 'L', 1);
        $this->SetFont('Helvetica', 'I', 9);
        $this->Cell(125, 4, utf8_decode('Nome: ' . $dados['TX_NOME'][0]), 0, 0, 'L', 0);
        $this->Cell(0, 4, '', 0, 1, 'L', 1);
        $this->Cell(125, 4, utf8_decode('Curso: ' . $dados['TX_CURSO_ESTAGIO'][0]), 0, 0, 'L', 0);
        $this->Cell(0, 4, '', 0, 1, 'L', 1);
        $this->Cell(125, 4, utf8_decode('Período/Ano: ' . $dados['NB_PERIODO_ANO'][0]), 0, 0, 'L', 0);
        $this->Cell(0, 4, '', 0, 1, 'L', 1);
        $this->Cell(125, 4, utf8_decode('Escola: ' . $dados['TX_INSTITUICAO_ENSINO'][0]), 0, 1, 'L', 0);
        $this->Ln();

        $this->SetFont('Helvetica', '', 7);
        $this->Cell(0, 4, utf8_decode('Caso este estudante seja aprovado para estagio, solicitamos preencher abaixo a Autorização para Elaboração do Acordo'), 0, 1, 'L', 0);
        $this->Cell(0, 4, utf8_decode('de Cooperação e Termo de Compromisso de Estágio.'), 0, 1, 'L', 0);
        $this->Cell(0, 4, utf8_decode('Qualquer Duvida ligar para o Fone 2101-4269.'), 0, 1, 'L', 0);
        $this->Cell(0, 4, utf8_decode('Favor ligar para o número de telefone mencionado acima e agendar a contratação do Estudante, que deverá comparecer ao'), 0, 1, 'L', 0);
        $this->Cell(82, 4, utf8_decode('CIEE munido da citada autorização, devidamente assinada pela Empresa,'), 0, 0, 'L', 0);
        $this->SetFont('Helvetica', 'IBU');
        $this->Cell(33, 4, utf8_decode('Declaração Escolar Original'), 0, 0, 'L', 0);
        $this->SetFont('Helvetica', 'I');
        $this->Cell(0, 4, utf8_decode(', xerox do RG e CPF.'), 0, 1, 'L', 0);
        $this->Cell(0, 4, utf8_decode('Estudantes menores de 18 anos, deverão comparecer com o responsável legal.'), 0, 1, 'L', 0);
        $this->Cell(104, 4, utf8_decode('Aguardamos o pronunciamento de V.Sª.'), 0, 0, 'L', 0);
        $this->SetFont('Helvetica', 'B');
        $this->Cell(19, 4, utf8_decode('ESTUDANTE:'), 0, 0, 'L', 0);
        $this->SetFont('Helvetica', '', 6);
        $this->Cell(0, 4, utf8_decode('se vovê for aprovado, deverá comparecer ao CIEE, na data marcada'), 0, 1, 'L', 0);
        $this->Cell(104, 4, utf8_decode(''), 0, 0, 'L', 0);
        $this->Cell(0, 4, utf8_decode('com a autorização para a elaboração do TCE, que deverá estar preenchida corretamente'), 0, 1, 'L', 0);
        $this->SetFont('Helvetica', '', 7);
        $this->Cell(30, 4, utf8_decode('Atenciosamente,'), 0, 0, 'L', 0);
        $this->Cell(74, 4, utf8_decode('RAQUEL ALBUQUERQUE'), 0, 0, 'L', 0);
        $this->SetFont('Helvetica', '', 6);
        $this->Cell(0, 4, utf8_decode('trazendo a Autorização e a Declaração Escolar com máxima urgência.'), 0, 1, 'L', 0);
        $this->SetFont('Helvetica', 'I', 7);
        $this->Cell(35, 4, utf8_decode(''), 0, 0, 'L', 0);
        $this->Cell(84, 4, utf8_decode('ATENDIMENTO'), 0, 0, 'L', 0);
        $this->SetFont('Helvetica', 'IB');
        $this->Cell(0, 4, utf8_decode('Não deixe essas Providência para última hora.'), 0, 1, 'L', 0);
        $this->SetFont('Helvetica', '', 5);
        $this->Cell(35, 4, utf8_decode(''), 0, 0, 'L', 0);
        $this->Cell(84, 4, utf8_decode('Seleção/Atendimento'), 0, 1, 'L', 0);
        $this->Ln(8);

        $this->SetFont('Helvetica', 'B', 7);
        $this->Cell(0, 4, utf8_decode('ATENDIMENTO AO ESTUDANTE'), 'B', 1, 'L', 0);
        $this->Cell(0, 4, utf8_decode('Ref.: Autorização para a Elaboração do Acordo de Cooperação e Termo de Compromisso de Estágio.'), 0, 1, 'L', 0);
        $this->Ln();

        $this->SetFont('Helvetica', '');
        $this->MultiCell(0, 4, utf8_decode('Conforme preceitua o Convêncio assinado com esta Empressa e o CIEE, autorizamos a preparação da documentoção referente ao Estágio do Estudante acima citado, nas condições abaixo:'), 0, 'J', 0);

        $this->Cell(27, 4, utf8_decode('1 - Hoirário de Estágio:'), 0, 0, 'L', 0);
        $this->Cell(12, 4, utf8_decode($dados['TX_HORA_INICIO'][0]), 0, 0, 'L', 0);
        $this->Cell(6, 4, utf8_decode('as'), 0, 0, 'L', 0);
        $this->Cell(0, 4, utf8_decode($dados['TX_HORA_FINAL'][0]), 0, 1, 'L', 0);

        $this->Cell(43, 4, utf8_decode('2 - Carga horária semanal de estágio:'), 0, 0, 'L', 0);
        $this->Cell(0, 4, utf8_decode($arrayCHSemanal[$dados['CS_CARGA_HORARIA'][0]]), 0, 1, 'L', 0);
        $this->Cell(14, 4, utf8_decode('3 - Estágio:'), 0, 0, 'L', 0);
        $this->Cell(20, 4, utf8_decode($dados['DT_INICIO'][0]), 0, 0, 'L', 0);
        $this->Cell(12, 4, utf8_decode('Término:'), 0, 0, 'L', 0);
        $this->Cell(0, 4, utf8_decode($dados['DT_FINAL'][0]), 0, 1, 'L', 0);

        $this->Cell(38, 4, utf8_decode('4 - Atividades iniciais de Estágio:'), 0, 1, 'L', 0);
        $this->MultiCell(0, 4, utf8_decode($dados['TX_ATIVIDADES'][0]), 0, 'J', 0);

        $this->Cell(33, 4, utf8_decode('5 - Bolsa-Auxílio mensal R$:'), 0, 0, 'L', 0);
        $this->Cell(0, 4, utf8_decode(number_format($dados['NB_VALOR'][0], 2, ',', '.')), 0, 1, 'L', 0);

        $this->Cell(29, 4, utf8_decode('6 - Unidade Concedente:'), 0, 0, 'L', 0);
        $this->Cell(0, 4, utf8_decode($dados['TX_UNIDADE_ORG'][0]), 0, 1, 'L', 0);
        $this->Cell(29, 4, utf8_decode('Local de Estágio:'), 0, 0, 'R', 0);
        $this->Cell(0, 4, utf8_decode($dados['TX_LOCAL_ESTAGIO'][0]), 0, 1, 'L', 0);

        $this->SetFont('Helvetica', 'B');
        $this->Cell(32, 4, utf8_decode('7 - Supervisor de Estágio:'), 0, 0, 'L', 0);
        $this->Cell(60, 4, utf8_decode($dados['TX_NOME_SUPERVISOR'][0]), 0, 0, 'L', 0);
        $this->Cell(10, 4, utf8_decode('Cargo:'), 0, 0, 'L', 0);
        $this->Cell(0, 4, utf8_decode($dados['TX_CARGO'][0]), 0, 1, 'L', 0);

        $this->Cell(18, 4, utf8_decode('8 - Formação:'), 0, 0, 'L', 0);
        $this->Cell(74, 4, utf8_decode($dados['TX_FORMACAO'][0]), 0, 0, 'L', 0);
        $this->Cell(0, 4, utf8_decode('Email:'), 0, 0, 'L', 0);
        $this->Cell(0, 4, utf8_decode($dados['TX_EMAIL'][0]), 0, 1, 'L', 0);

        $this->Cell(58, 4, utf8_decode('9 - Número do Registro no Cons. Regional (CR):'), 0, 0, 'L', 0);
        $this->Cell(0, 4, utf8_decode($dados['TX_CONSELHO'][0]), 0, 1, 'L', 0);

        $this->Cell(29, 4, utf8_decode('8 - Matricula Funcional:'), 0, 0, 'L', 0);
        $this->Cell(18, 4, utf8_decode($dados['TX_MATRICULA'][0]), 0, 0, 'L', 0);
        $this->Cell(25, 4, utf8_decode('Aux. Transporte R$:'), 0, 0, 'L', 0);
        $this->Cell(0, 4, utf8_decode(number_format($dados['NB_VALOR_TRANSPORTE'][0], 2, ',', '.')), 0, 1, 'L', 0);

        $this->Cell(38, 4, utf8_decode('11 - Departamento que atende:'), 0, 0, 'L', 0);
        $this->Cell(0, 4, utf8_decode($dados['TX_DEPARTAMENTO'][0]), 0, 1, 'L', 0);

        $this->Cell(70, 4, utf8_decode('12 - Período do Recesso Escolar Remunerado do Estágio:'), 0, 0, 'L', 0);
        $this->Cell(0, 4, utf8_decode(''), 0, 1, 'L', 0);
        $this->Ln(4);

        $this->SetFont('Helvetica', '');
        $this->Cell(0, 4, utf8_decode('Manaus, ' . date('d') . ' de ' . ucfirst($arrayMesExtenso[date('n')]) . ' de ' . date('Y')), 0, 1, 'L', 0);
        $this->Ln();

        $this->Cell(120, 4, utf8_decode(''), 0, 0, 'L', 0);
        $this->Cell(70, 4, utf8_decode(''), 'B', 1, 'L', 0);
        $this->Cell(120, 4, utf8_decode(''), 0, 0, 'L', 0);
        $this->Cell(70, 4, utf8_decode('Assinatura e Carimbo da Empresa'), 0, 1, 'C', 0);

        //print_r($dados);
//        $totalAgencia = $VO->pesquisarAgenciaestagio();
//
//        if ($totalAgencia) {
//            $agencias = $VO->getVetor();
//
//            for ($j = 0; $j < $totalAgencia; $j++) {
//                $totalOrgao = $VO->buscarOrgaoEstagio();
//                //echo '<br/>'; print_r($agencias['ID_AGENCIA_ESTAGIO'][$j]); echo ' id<br/>';
//
//                if ($totalOrgao) {
//                    $orgaos = $VO->getVetor();
//
//                    for ($l = 0; $l < $totalOrgao; $l++) {
//                        $VO->ID_AGENCIA_ESTAGIO = $agencias['ID_AGENCIA_ESTAGIO'][$j];
//                        $VO->ID_ORGAO_ESTAGIO = $orgaos['ID_ORGAO_ESTAGIO'][$l];
//                        //echo '<br/>'; print_r($orgaos['ID_ORGAO_ESTAGIO'][$l]); echo ' id<br/>';
//
//                        $VO->buscarQuadroVagas();
//
//                        $quadro = $VO->getVetor();
//
//                        $totalVagasMedio += $quadro['NB_VAGA_MEDIO'][0];
//                        $totalVagas4h += $quadro['NB_VAGA_SUP4H'][0];
//                        $totalVagas5h += $quadro['NB_VAGA_SUP5H'][0];
//                        $totalVagas6h += $quadro['NB_VAGA_SUP6H'][0];
//                        $totalVagas += $quadro['NB_VAGA_TOTAL'][0];
//
//                        //echo '<br/>'; print_r($orgaos['TX_ORGAO_ESTAGIO'][$l]); echo ' tx<br/>'; print_r($quadro['NB_VAGA_MEDIO'][0]);
//                        //echo '<br/>'; print_r($totalVagasMedio); echo ' t<br/>';
//
//                        $this->SetFont('Helvetica', '', 9);
//                        $this->SetLineWidth('0.2');
//                        //$w=array(15,80,22,25,25,25);
//
//                        $this->Cell(20, 4, $agencias['TX_AGENCIA_ESTAGIO'][$j], 'TLR', 0, 'C');
//                        $this->Cell(30, 4, $orgaos['TX_ORGAO_ESTAGIO'][$l], 'TR', 0, 'L');
//                        $this->Cell(12, 4, ($quadro['NB_VAGA_MEDIO'][0] != '') ? $quadro['NB_VAGA_MEDIO'][0] : '--', 'TR', 0, 'C');
//                        $this->Cell(10, 4, ($quadro['NB_VAGA_SUP4H'][0] != '') ? $quadro['NB_VAGA_SUP4H'][0] : '--', 'TR', 0, 'C');
//                        $this->Cell(10, 4, ($quadro['NB_VAGA_SUP5H'][0] != '') ? $quadro['NB_VAGA_SUP5H'][0] : '--', 'TR', 0, 'C');
//                        $this->Cell(11, 4, ($quadro['NB_VAGA_SUP6H'][0] != '') ? $quadro['NB_VAGA_SUP6H'][0] : '--', 'TR', 0, 'C');
//                        $this->Cell(12, 4, ($quadro['NB_VAGA_TOTAL'][0] != '') ? $quadro['NB_VAGA_TOTAL'][0] : '--', 'TR', 1, 'C');
//                    }
//                }
//                $this->Cell(20, 4, '', 'TLR', 0, 'C');
//                $this->Cell(30, 4, 'TOTAL', 'TR', 0, 'C');
//                $this->Cell(12, 4, $totalVagasMedio, 'TR', 0, 'C');
//                $this->Cell(10, 4, $totalVagas4h, 'TR', 0, 'C');
//                $this->Cell(10, 4, $totalVagas5h, 'TR', 0, 'C');
//                $this->Cell(11, 4, $totalVagas6h, 'TR', 0, 'C');
//                $this->Cell(12, 4, $totalVagas, 'TR', 1, 'C');
//
//                $totalGeralVagasMedio += $totalVagasMedio;
//                $totalGeralVagas4h += $totalVagas4h;
//                $totalGeralVagas5h += $totalVagas5h;
//                $totalGeralVagas6h += $totalVagas6h;
//                $totalGeralVagas += $totalVagas;
//                $totalVagasMedio = 0;
//                $totalVagas4h = 0;
//                $totalVagas5h = 0;
//                $totalVagas6h = 0;
//                $totalVagas = 0;
//            }
//
//            //print_r($totalGeralVagasMedio); echo ' t<br/>';
//        }
//        //print_r($totalGeralVagasMedio); echo ' tt<br';
//        $this->Cell(50, 4, 'TOTAL GERAL', 'TLRB', 0, 'C');
//        $this->Cell(12, 4, $totalGeralVagasMedio, 'TRB', 0, 'C');
//        $this->Cell(10, 4, $totalGeralVagas4h, 'TRB', 0, 'C');
//        $this->Cell(10, 4, $totalGeralVagas5h, 'TRB', 0, 'C');
//        $this->Cell(11, 4, $totalGeralVagas6h, 'TRB', 0, 'C');
//        $this->Cell(12, 4, $totalGeralVagas, 'TRB', 1, 'C');
    }
}
?>