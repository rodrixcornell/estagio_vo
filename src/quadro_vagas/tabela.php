<?php
require_once "../../php/define.php";
require_once $path . "src/quadro_vagas/arrays.php";
require_once $pathvo . "quadro_vagasVO.php";


echo 'smith';
$modulo = 78;
$programa = 9;
$pasta = 'quadro_vagas';
$current = 1;
$titulopage = 'Quadro de Vagas';

session_start();
require_once "../autenticacao/validaPermissao.php";

// Iniciando Instância
$VO = new quadro_vagasVO();

if ($_SESSION['ID_QUADRO_VAGAS_ESTAGIO']) {

	// Tabela de quadro de vagas estabelecidas
	$tabelaEstabelecida='<table id="tabela" align="center" style="margin-top:3px; collapse; border: solid 1px #CCC;">
							
							<tr bgcolor="#DDDDEE">
			                   	<th align="center" rowspan="2" width="100px">AG. INT.</th>
		                    	<th align="center" rowspan="2" width="120px">ÓRGÃO</th>
		                        <th align="center" rowspan="2" width="100px">NÍVEL MÉDIO</th>
		                        <th align="center" colspan="3" width="240px">NÍVEL SUPERIOR</th>
		                        <th align="center" rowspan="2" width="100px">TOTAL</th>
		                    </tr>
		                    <tr bgcolor="#DDDDEE">
		                        <th align="center" width="80px">4h</th>
		                        <th align="center" width="80px">5h</th>
		                        <th align="center" width="80px">6h</th>
		                    </tr>
		                    
		                    			

		                   ';
		                    
    // Trazer todos agentes de integração
	$totalAgentesIntegracao = $VO->buscarAgenteIntegracao();
	$dadosAgentes = $VO->getVetor();
    for($i = 0; $i < $totalAgentesIntegracao; $i++){


    	$tabelaEstabelecida.='<tr style="border: solid 0px #CCC; padding: 0; margin: 0;">
		                    	<td colspan="7" style="border: solid 0px #CCC; padding: 0; margin:0;"> 
    						<table border="0" id="tabelaInterna" style="border: solid 0px #CCC; margin: 0;">
    							<tr bgcolor="#EEEEFF">
                            	      <td align="center" width="100px" style="border: solid 1px #CCC; padding: 0; margin:0;">'.$dadosAgentes['TX_AGENCIA_ESTAGIO'][$i].'
                            	      </td> 
                            	      <td align="center" width="100px" style="border: solid 1px #CCC; padding: 0; margin:0;">
                            	      	<table border="0" id="tabelaInterna" style="border: solid 0px #CCC; margin: 0;">
                            	      		';
       $VO->ID_AGENCIA_ESTAGIO_TABELA=$dadosAgentes['ID_AGENCIA_ESTAGIO'][$i];
       $totalUnidades = $VO->buscarQuadroUnidades();

       for($j =0;$j<$totalUnidades;$j++){
	       	if($j%2==0){
	       		
	       		$cor="#FFFFFF";
	       	}
	       	else{
	       		$cor="#EEEEFF";
	       	}
       		$dadosUnidades = $VO->getVetor();
			$tabelaEstabelecida.='<tr bgcolor="'.$cor.'" onmouseover="mudarCor(this);" onmouseout="mudarCor(this)" style="">
									<td align="center"  width="119px" style="border: solid 1px #CCC; padding: 0; margin:0;"> 
									'.$dadosUnidades['TX_ORGAO_ESTAGIO'][$j].'
                                    </td>
                                </tr>';
           }                 	      		

             $tabelaEstabelecida.='	
                            	    </table>
                            	 </td>
                            </tr></table></td></tr>';
    }		
    	
    $tabelaEstabelecida.=' </table>';
	
}else     header("Location: " . $url . "src/" . $pasta . "/index.php");

$smarty->assign("tabelaEstabelecida",$tabelaEstabelecida);
$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("dados", $dados);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("arquivoCSS", $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("arquivoJS", $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>