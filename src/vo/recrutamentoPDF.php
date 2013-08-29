<?php
include "../../../php/define.php";
require_once "../../../php/fpdf/fpdf.php";
require_once $pathvo."recrutamentoVO.php";
//require_once $path."src/relatorios/recrutamento/arrays.php";
session_start();

class PDF extends FPDF{
	//Page Header
function Header(){
//		global $pathimg;
//		global $unidadeEstoque;
//		$tamFonte = !$this->tamFonte ? 17 : $this->tamFonte;
//		//Logotipo
//		$this->Image($pathimg.'topo/logoPrefeitura.gif',10,9,47,23);
//		//Fonte
//		$this->SetFont('Helvetica','B',$tamFonte);
//		//Calcula meio da pagina
//		$w = $this->GetStringWidth($this->titulo);
//		$this->SetY(15);
//		$this->SetX((250-$w)/2);
//		//$Titulo
//		$this->MultiCell(100,6,utf8_decode($this->titulo),0,'C',false);
//		$this->Image($pathimg.'topo/dsti.png',245,5,46);
//		$this->Ln(10);
//		$this->SetLineWidth('0.2');
//		$this->Cell(270,2,'','T',1,'L');
//	      // Cabe?alho Fixo
//        $this->Ln(3);
//		$this->SetFillColor(220);
//		$this->SetFont('Helvetica','B',7);
//		$this->SetLineWidth('0.3');
//		/*$w=array(20,30,50,70,50,50,
//                         20,30,10,20,10,
//                         20,30,10,20,10,
//                         20,30,10,20,10,
//                         20,30,10,20,10);*/
//		$h=5;
//		$b='';
//                
//                $this->Cell(20,3,'','LTR',0,'C','false');
//		$this->Cell(30,3,'','TR',0,'C','false');
//                $this->Cell(55,3,'','TR',0,'C','false');
//		$this->Cell(55,3,'','TR',0,'C','false');
//                $this->Cell(55,3,'','TR',0,'C','false');
//		$this->Cell(55,3,'','TR',1,'C','false');
//                
//                
//		$this->Cell(20,5,'','LR',0,'C','false');
//	        $this->Cell(30,5,'','R',0,'C','false');
//		$this->Cell(55,5,'VAGAS  CREDENCIADAS','R',0,'C','false');
//		$this->Cell(55,5,'VAGAS  ESTABELECIDAS (Termo Aditivo)','R',0,'C','false');
//		$this->Cell(55,5,'VAGAS  PREENCHIDAS','R',0,'C','false');
//		$this->Cell(55,5,'VAGAS  EM ABERTO','R',1,'C','false');
//        
//                               
//                $this->Cell(20,3,utf8_decode('AG / INT.'),'RL',0,'C','false');
//		$this->Cell(30,3,utf8_decode('ORGÃO'),'R',0,'C','false');
//                $this->Cell(55,3,'','BR',0,'C','false');
//		$this->Cell(55,3,'','BR',0,'C','false');
//                $this->Cell(55,3,'','BR',0,'C','false');
//		$this->Cell(55,3,'','BR',1,'C','false');
//                
//		$b='';
//		$this->Cell(20,5,'','RL',0,'C','false');
//		$this->Cell(30,5,'','R',0,'C','false');
//		$this->Cell(12,5,utf8_decode('NÍVEL'),'R',0,'C','false');
//                $this->Cell(31,5,utf8_decode('NÍVEL SUPERIOR'),'BR',0,'C','false');
//		$this->Cell(12,5,utf8_decode('TOTAL'),'R',0,'C','false');
//		//-----------
//                $this->Cell(12,5,utf8_decode('NÍVEL'),'R',0,'C','false');
//                $this->Cell(31,5,utf8_decode('NÍVEL SUPERIOR'),'BR',0,'C','false');
//		$this->Cell(12,5,utf8_decode('TOTAL'),'R',0,'C','false');
//                
//                $this->Cell(12,5,utf8_decode('NÍVEL'),'R',0,'C','false');
//                $this->Cell(31,5,utf8_decode('NÍVEL SUPERIOR'),'BR',0,'C','false');
//		$this->Cell(12,5,utf8_decode('TOTAL'),'R',0,'C','false');
//                
//                $this->Cell(12,5,utf8_decode('NÍVEL'),'BR',0,'C','false');
//                $this->Cell(31,5,utf8_decode('NÍVEL SUPERIOR'),'BR',0,'C','false');
//		$this->Cell(12,5,utf8_decode('TOTAL'),'R',1,'C','false');
//		
//                
//                $this->Cell(20,5,'','LBR',0,'C','false');
//		$this->Cell(30,5,'','RB',0,'C','false');
//		$this->Cell(12,5,utf8_decode('MÉDIO'),'BR',0,'C','false');
//		$this->Cell(10,5,'4h','RB',0,'C','false');
//		$this->Cell(10,5,'5h','RB',0,'C','false');
//		$this->Cell(11,5,'6h','RB',0,'C','false');
//                
//                $this->Cell(12,5,'','BR',0,'C','false');
//                $this->Cell(12,5,utf8_decode('MÉDIO'),'RB',0,'C','false');
//		$this->Cell(10,5,'4h','BR',0,'C','false');
//		$this->Cell(10,5,'5h','BR',0,'C','false');
//		$this->Cell(11,5,'6h','BR',0,'C','false');
//                
//                $this->Cell(12,5,'','RB',0,'C','false');
//                $this->Cell(12,5,utf8_decode('MÉDIO'),'RB',0,'C','false');
//		$this->Cell(10,5,'4h','BR',0,'C','false');
//		$this->Cell(10,5,'5h','BR',0,'C','false');
//		$this->Cell(11,5,'6h','BR',0,'C','false');
//                
//                $this->Cell(12,5,'','BR',0,'C','false');
//                $this->Cell(12,5,utf8_decode('MÉDIO'),'BR',0,'C','false');
//		$this->Cell(10,5,'4h','BR',0,'C','false');
//		$this->Cell(10,5,'5h','RB',0,'C','false');
//		$this->Cell(11,5,'6h','BR',0,'C','false');
//                $this->Cell(12,5,'','BR',1,'C','false');
		
}
	
function Footer(){

	//Position at 1.5 cm from bottom
	$this->SetY(-15);                                           
	//Helvetica italic 8
	$this->SetFont('Helvetica','I',8);
	//Page number
	$this->SetLineWidth('0.3');
	$this->Cell(192,4,'Desenvolvido pelo Departamento de Sistemas e Tecnologias da Informa��o - DSTI / 2009-'.date('Y'),'T',0,'L');
	$this->Cell(0,4,date('d/m/Y H:i:s'),'',1,'R');
	$this->Cell(275,4,'Suporte: (92) 8842-7838 / 8855-1465 - sistemaspmm@pmm.am.gov.br','',1,'L');
	$this->Cell(172,4,'http://semad.manaus.am.gov.br','',0,'L');
	$this->Cell(20,4,'P�gina '.$this->PageNo().' de {nb}','',0,'R');
}
/*	
function conteudo(){
	$VO = new quadro_vagasVO();                                                                   
	
	$VO->ID_QUADRO_VAGAS_ESTAGIO = $_SESSION['ID_QUADRO_VAGAS_ESTAGIO'];
        
    $totalItem = $VO->buscarItem();
                
    $this->SetFont('Helvetica','',9);
	$this->SetLineWidth('0.2');
	$w=array(15,80,22,25,25,25);
         
    if ($totalItem){
		$item = $VO->getVetor();
        $h=4;
		
        for($j=0; $j<$totalItem; $j++){
             $b='L';
                      
			  //Linha Final
			  ($item['TX_DESCRICAO'][$j] == $item['TX_DESCRICAO'][$j-1]) ? true : $this->Cell(192,0,'','T',1,'L');
			  
			  ($item['TX_DESCRICAO'][$j] == $item['TX_DESCRICAO'][$j-1]) ? $descricao = '' : $descricao = $item['TX_DESCRICAO'][$j];
			  $this->Cell($w[0],$h,utf8_decode($descricao),'L',0,'C');
                      
              $this->Cell($w[1],$h,utf8_decode($item['TX_GRUPO_CARGO'][$j]),$b,0,'C');
                      
              ($item['TX_DESCRICAO'][$j] == $item['TX_DESCRICAO'][$j-1] && $item['VALOR_EXTERIOR'][$j] == $item['VALOR_EXTERIOR'][$j-1]) ? $valorExterior = '' : $valorExterior = number_format($item['VALOR_EXTERIOR'][$j], 2,',', '.');
			  $this->Cell($w[2],$h,$valorExterior,$b,0,'C');
			  
			  ($item['TX_DESCRICAO'][$j] == $item['TX_DESCRICAO'][$j-1] && $item['VALOR_O_UNID'][$j] == $item['VALOR_O_UNID'][$j-1]) ? $valorUnid = '' : $valorUnid = number_format($item['VALOR_O_UNID'][$j],2, ',', '.');
			  $this->Cell($w[3],$h,$valorUnid,$b,0,'C');
			  
			  ($item['TX_DESCRICAO'][$j] == $item['TX_DESCRICAO'][$j-1] && $item['VALOR_MUNICIPIO'][$j] == $item['VALOR_MUNICIPIO'][$j-1]) ? $valorMinic = '' : $valorMinic = number_format($item['VALOR_MUNICIPIO'][$j],2, ',', '.');
			  $this->Cell($w[4],$h,$valorMinic,$b,0,'C');
			  
			  ($item['TX_DESCRICAO'][$j] == $item['TX_DESCRICAO'][$j-1] && $item['VALOR_ZONA_RURAL'][$j] == $item['VALOR_ZONA_RURAL'][$j-1]) ? $valorZR = '' : $valorZR = number_format($item['VALOR_ZONA_RURAL'][$j],2, ',', '.');
			  $this->Cell($w[5],$h,$valorZR,'LR',1,'C');
                      
         }
         $this->Cell(192,0,'','T',1,'L');
                 
                   
     }
        
}   */     
               
}
?>