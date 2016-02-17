<?php

include "../../../php/define.php";
require_once "../../../php/fpdf/fpdf.php";
require_once $pathvo . "quadro_vagasVO.php";
require_once $path . "src/relatorios/quadro_vagas/arrays.php";
session_start();

class PDF extends FPDF {

    //Page Header
    function Header() {
        global $pathimg;
        global $unidadeEstoque;
        $tamFonte = !$this->tamFonte ? 17 : $this->tamFonte;
        //Logotipo
        $this->Image($pathimg . 'topo/logoPrefeitura.gif', 10, 9, 47, 23);
        //Fonte
        $this->SetFont('Helvetica', 'B', $tamFonte);
        //Calcula meio da pagina
        $w = $this->GetStringWidth($this->titulo);
        $this->SetY(15);
        $this->SetX((250 - $w) / 2);
        //$Titulo
        $this->MultiCell(100, 6, utf8_decode($this->titulo), 0, 'C', false);
        $this->Image($pathimg . 'topo/dsti.png', 245, 5, 46);
        $this->Ln(10);
        $this->SetLineWidth('0.2');
        $this->Cell(270, 2, '', 'T', 1, 'L');
        // Cabe?alho Fixo
        $this->Ln(3);
        $this->SetFillColor(255);

        $this->SetFont('Helvetica', 'B', 7);
        $this->SetLineWidth('0.2');
        /* $w=array(20,30,50,70,50,50,
          20,30,10,20,10,
          20,30,10,20,10,
          20,30,10,20,10,
          20,30,10,20,10); */
        $h = 5;
        $b = '';

        $this->Cell(20, 5, '', 'TLR', 0, 'C');
        $this->Cell(30, 5, '', 'TR', 0, 'C');
        $this->Cell(55, 5, 'VAGAS  CREDENCIADAS', 'TR', 0, 'C');
        $this->Cell(55, 5, 'VAGAS  ESTABELECIDAS (Termo Aditivo)', 'TR', 0, 'C');
        $this->Cell(55, 5, 'VAGAS  PREENCHIDAS', 'TR', 0, 'C');
        $this->Cell(55, 5, 'VAGAS  EM ABERTO', 'TR', 1, 'C');


        $this->Cell(20, 5, utf8_decode('AG / INT.'), 'RL', 0, 'C');
        $this->Cell(30, 5, utf8_decode('ORGÃO'), 'R', 0, 'C');

        //----------
        $this->Cell(12, 5, utf8_decode('NÍVEL'), 'TR', 0, 'C');
        $this->Cell(31, 5, utf8_decode('NÍVEL SUPERIOR'), 'TR', 0, 'C');
        $this->Cell(12, 5, utf8_decode('TOTAL'), 'TR', 0, 'C');

        $this->Cell(12, 5, utf8_decode('NÍVEL'), 'TR', 0, 'C');
        $this->Cell(31, 5, utf8_decode('NÍVEL SUPERIOR'), 'TR', 0, 'C');
        $this->Cell(12, 5, utf8_decode('TOTAL'), 'TR', 0, 'C');

        $this->Cell(12, 5, utf8_decode('NÍVEL'), 'TR', 0, 'C');
        $this->Cell(31, 5, utf8_decode('NÍVEL SUPERIOR'), 'TR', 0, 'C');
        $this->Cell(12, 5, utf8_decode('TOTAL'), 'TR', 0, 'C');

        $this->Cell(12, 5, utf8_decode('NÍVEL'), 'TR', 0, 'C');
        $this->Cell(31, 5, utf8_decode('NÍVEL SUPERIOR'), 'TR', 0, 'C');
        $this->Cell(12, 5, utf8_decode('TOTAL'), 'TR', 1, 'C');


        $this->Cell(20, 5, '', 'LR', 0, 'C');
        $this->Cell(30, 5, '', 'R', 0, 'C');
        //----------
        $this->Cell(12, 5, utf8_decode('MÉDIO'), 'R', 0, 'C');
        $this->Cell(10, 5, '4h', 'TR', 0, 'C');
        $this->Cell(10, 5, '5h', 'TR', 0, 'C');
        $this->Cell(11, 5, '6h', 'TR', 0, 'C');
        $this->Cell(12, 5, '', 'R', 0, 'C');

        $this->Cell(12, 5, utf8_decode('MÉDIO'), 'R', 0, 'C');
        $this->Cell(10, 5, '4h', 'TR', 0, 'C');
        $this->Cell(10, 5, '5h', 'TR', 0, 'C');
        $this->Cell(11, 5, '6h', 'TR', 0, 'C');
        $this->Cell(12, 5, '', 'R', 0, 'C');

        $this->Cell(12, 5, utf8_decode('MÉDIO'), 'R', 0, 'C');
        $this->Cell(10, 5, '4h', 'TR', 0, 'C');
        $this->Cell(10, 5, '5h', 'TR', 0, 'C');
        $this->Cell(11, 5, '6h', 'TR', 0, 'C');
        $this->Cell(12, 5, '', 'R', 0, 'C');

        $this->Cell(12, 5, utf8_decode('MÉDIO'), 'R', 0, 'C');
        $this->Cell(10, 5, '4h', 'TR', 0, 'C');
        $this->Cell(10, 5, '5h', 'TR', 0, 'C');
        $this->Cell(11, 5, '6h', 'TR', 0, 'C');
        $this->Cell(12, 5, '', 'R', 1, 'C');
    }

    function Footer() {

        //Position at 1.5 cm from bottom
        $this->SetY(-15);
        //Helvetica italic 8
        $this->SetFont('Helvetica', 'I', 8);
        //Page number
        $this->SetLineWidth('0.3');
        $this->Cell(192, 4, utf8_decode('Desenvolvido pelo Departamento de Sistemas e Tecnologias da Informação - DSTI / 2009-') . date('Y'), 'T', 0, 'L');
        $this->Cell(0, 4, date('d/m/Y H:i:s'), '', 1, 'R');
        $this->Cell(275, 4, 'Suporte: (92) 8842-7838 / 8855-1465 - sistemaspmm@pmm.am.gov.br', '', 1, 'L');
        $this->Cell(172, 4, 'http://semad.manaus.am.gov.br', '', 0, 'L');
        $this->Cell(20, 4, utf8_decode('Página ') . $this->PageNo() . ' de {nb}', '', 0, 'R');
    }

    function Conteudo() {
        $VO = new quadro_vagasVO();

        $totalAgencia = $VO->pesquisarAgenciaestagio();

        if ($totalAgencia) {
            $agencias = $VO->getVetor();

            for ($j = 0; $j < $totalAgencia; $j++) {
                $totalOrgao = $VO->buscarOrgaoEstagio();
                //echo '<br/>'; print_r($agencias['ID_AGENCIA_ESTAGIO'][$j]); echo ' id<br/>';

                if ($totalOrgao) {
                    $orgaos = $VO->getVetor();

                    for ($l = 0; $l < $totalOrgao; $l++) {
                        $VO->ID_AGENCIA_ESTAGIO = $agencias['ID_AGENCIA_ESTAGIO'][$j];
                        $VO->ID_ORGAO_ESTAGIO = $orgaos['ID_ORGAO_ESTAGIO'][$l];
                        //echo '<br/>'; print_r($orgaos['ID_ORGAO_ESTAGIO'][$l]); echo ' id<br/>';

                        $VO->buscarQuadroVagas();

                        $quadro = $VO->getVetor();

                        $totalVagasMedio += $quadro['NB_VAGA_MEDIO'][0];
                        $totalVagas4h += $quadro['NB_VAGA_SUP4H'][0];
                        $totalVagas5h += $quadro['NB_VAGA_SUP5H'][0];
                        $totalVagas6h += $quadro['NB_VAGA_SUP6H'][0];
                        $totalVagas += $quadro['NB_VAGA_TOTAL'][0];

                        //echo '<br/>'; print_r($orgaos['TX_ORGAO_ESTAGIO'][$l]); echo ' tx<br/>'; print_r($quadro['NB_VAGA_MEDIO'][0]);
                        //echo '<br/>'; print_r($totalVagasMedio); echo ' t<br/>';

                        $this->SetFont('Helvetica', '', 9);
                        $this->SetLineWidth('0.2');
                        //$w=array(15,80,22,25,25,25);

                        $this->Cell(20, 5, $agencias['TX_AGENCIA_ESTAGIO'][$j], 'TLR', 0, 'C');
                        $this->Cell(30, 5, $orgaos['TX_ORGAO_ESTAGIO'][$l], 'TR', 0, 'L');
                        $this->Cell(12, 5, ($quadro['NB_VAGA_MEDIO'][0] != '') ? $quadro['NB_VAGA_MEDIO'][0] : '--', 'TR', 0, 'C');
                        $this->Cell(10, 5, ($quadro['NB_VAGA_SUP4H'][0] != '') ? $quadro['NB_VAGA_SUP4H'][0] : '--', 'TR', 0, 'C');
                        $this->Cell(10, 5, ($quadro['NB_VAGA_SUP5H'][0] != '') ? $quadro['NB_VAGA_SUP5H'][0] : '--', 'TR', 0, 'C');
                        $this->Cell(11, 5, ($quadro['NB_VAGA_SUP6H'][0] != '') ? $quadro['NB_VAGA_SUP6H'][0] : '--', 'TR', 0, 'C');
                        $this->Cell(12, 5, ($quadro['NB_VAGA_TOTAL'][0] != '') ? $quadro['NB_VAGA_TOTAL'][0] : '--', 'TR', 1, 'C');
                    }
                }
                $this->Cell(20, 5, '', 'TLR', 0, 'C');
                $this->Cell(30, 5, 'TOTAL', 'TR', 0, 'C');
                $this->Cell(12, 5, $totalVagasMedio, 'TR', 0, 'C');
                $this->Cell(10, 5, $totalVagas4h, 'TR', 0, 'C');
                $this->Cell(10, 5, $totalVagas5h, 'TR', 0, 'C');
                $this->Cell(11, 5, $totalVagas6h, 'TR', 0, 'C');
                $this->Cell(12, 5, $totalVagas, 'TR', 1, 'C');

                $totalGeralVagasMedio += $totalVagasMedio;
                $totalGeralVagas4h += $totalVagas4h;
                $totalGeralVagas5h += $totalVagas5h;
                $totalGeralVagas6h += $totalVagas6h;
                $totalGeralVagas += $totalVagas;
                $totalVagasMedio = 0;
                $totalVagas4h = 0;
                $totalVagas5h = 0;
                $totalVagas6h = 0;
                $totalVagas = 0;
            }

            //print_r($totalGeralVagasMedio); echo ' t<br/>';
        }
        //print_r($totalGeralVagasMedio); echo ' tt<br';
        $this->Cell(50, 5, 'TOTAL GERAL', 'TLRB', 0, 'C');
        $this->Cell(12, 5, $totalGeralVagasMedio, 'TRB', 0, 'C');
        $this->Cell(10, 5, $totalGeralVagas4h, 'TRB', 0, 'C');
        $this->Cell(10, 5, $totalGeralVagas5h, 'TRB', 0, 'C');
        $this->Cell(11, 5, $totalGeralVagas6h, 'TRB', 0, 'C');
        $this->Cell(12, 5, $totalGeralVagas, 'TRB', 1, 'C');
    }
}
?>