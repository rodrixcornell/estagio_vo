<?php
require_once "../../php/define.php";
require_once $path . "src/quadro_vagas/arrays.php";
require_once $pathvo . "quadro_vagasVO.php";



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
	    /*
	#####################################################################################################################
	################################################### TABELA ESTABELECIDAS #############################################
	#####################################################################################################################
    */


	$tabelaEstabelecida='<table id="tabela" align="center" style="margin-top:3px; collapse; border: solid 1px #CCC;">
							
							<tr bgcolor="#DDDDEE">
			                   	<th align="center" rowspan="2" width="100">AG. INT.</th>
		                    	<th align="center" rowspan="2" width="120">ÓRGÃO</th>
		                        <th align="center" rowspan="2" width="100">NÍVEL MÉDIO</th>
		                        <th align="center" colspan="3" width="240">NÍVEL SUPERIOR</th>
		                        <th align="center" rowspan="2" width="100">TOTAL</th>
		                    </tr>
		                    <tr bgcolor="#DDDDEE">
		                        <th align="center" width="80">4h</th>
		                        <th align="center" width="80">5h</th>
		                        <th align="center" width="80">6h</th>
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
                            	      <td align="center"  width="590" style="border: solid 1px #CCC; padding: 0; margin:0;">
                            	      	<table border="0" id="tabelaInterna" style="border: solid 0px #CCC; margin: 0;">
                            	      		';
       $VO->ID_AGENCIA_ESTAGIO_TABELA=$dadosAgentes['ID_AGENCIA_ESTAGIO'][$i];
       $totalUnidades = $VO->buscarQuadroVagasUnidades();

       for($j =0;$j<$totalUnidades;$j++){
	       	if($j%2==0){
	       		
	       		$cor="#FFFFFF";
	       	}
	       	else{
	       		$cor="#EEEEFF";
	       	}
       		$dadosUnidades = $VO->getVetor();
			$tabelaEstabelecida.='<tr bgcolor="'.$cor.'" onmouseover="mudarCor(this);" onmouseout="mudarCor(this)" style="">
									<td align="center"  width="119" style="border: solid 1px #CCC; padding: 0; margin:0;"> 
									'.$dadosUnidades['TX_ORGAO_ESTAGIO'][$j].'
                                    </td>
                                    <td align="center"  width="102" style="border: solid 1px #CCC; padding: 0; margin:0;">
									'.$dadosUnidades['VAGAS_NIVEL_MEDIO'][$j].'
                                    </td>
                                    <td align="center"  width="82" style="border: solid 1px #CCC; padding: 0; margin:0;"> 
									'.$dadosUnidades['VAGAS_SUP_4_HORAS'][$j].'
                                    </td>
                                    <td align="center"  width="82" style="border: solid 1px #CCC; padding: 0; margin:0;"> 
									'.$dadosUnidades['VAGAS_SUP_5_HORAS'][$j].'
                                    </td>
                                    <td align="center"  width="82" style="border: solid 1px #CCC; padding: 0; margin:0;"> 
									'.$dadosUnidades['VAGAS_SUP_6_HORAS'][$j].'
                                    </td>
                                    <td align="center"  width="97" style="font-weight:bold;border: solid 1px #CCC; padding: 0; margin:0;"bgcolor="#DDDDDD"> 
									'.$dadosUnidades['VAGAS_TOTAL'][$j].'
                                    </td>
                                </tr>';

                                $array[0]+=$dadosUnidades['VAGAS_NIVEL_MEDIO'][$j];
                                $array[1]+=$dadosUnidades['VAGAS_SUP_4_HORAS'][$j];
                                $array[2]+=$dadosUnidades['VAGAS_SUP_5_HORAS'][$j];
                                $array[3]+=$dadosUnidades['VAGAS_SUP_6_HORAS'][$j];
                                $array[4]+=$dadosUnidades['VAGAS_TOTAL'][$j];
           }      

           $tabelaEstabelecida.='<tr bgcolor="'.$cor.'" onmouseover="mudarCor(this);" onmouseout="mudarCor(this)" style="">
									<td align="center"  width="119" bgcolor="#DDDDDD"style="font-weight:bold;border: solid 1px #CCC; padding: 0; margin:0;"> 
									TOTAL
                                    </td>
                                    <td align="center"  width="102" style="font-weight:bold;border: solid 1px #CCC; padding: 0; margin:0;"bgcolor="#DDDDDD">
									'.$array[0].'
                                    </td>
                                    <td align="center"  width="82" style="font-weight:bold;border: solid 1px #CCC; padding: 0; margin:0;"bgcolor="#DDDDDD"> 
									'.$array[1].'
                                    </td>
                                    <td align="center"  width="82" style="font-weight:bold;border: solid 1px #CCC; padding: 0; margin:0;"bgcolor="#DDDDDD"> 
									'.$array[2].'
                                    </td>
                                    <td align="center"  width="82" style="font-weight:bold;border: solid 1px #CCC; padding: 0; margin:0;"bgcolor="#DDDDDD"> 
									'.$array[3].'
                                    </td>
                                    <td align="center"  width="97" style="font-weight:bold;border: solid 1px #CCC; padding: 0; margin:0;"bgcolor="#DDDDDD"> 
									'.$array[4].'
                                    </td>
                                </tr>';           	      		

           $tabelaEstabelecida.='</table>
                            	 </td>
		                         </tr>
		                         </table></td></tr>';
		                         unset($array);
    }		
    	
    $tabelaEstabelecida.=' </table>';

      /*
	#####################################################################################################################
	################################################### TABELA PREENCHIDA ################################################
	#####################################################################################################################
    */
    $tabelaPreenchida='<table id="tabela" align="center" style="margin-top:3px; collapse; border: solid 1px #CCC;">
							
							<tr bgcolor="#DDDDEE">
			                   	<th align="center" rowspan="2" width="100">AG. INT.</th>
		                    	<th align="center" rowspan="2" width="120">ÓRGÃO</th>
		                        <th align="center" rowspan="2" width="100">NÍVEL MÉDIO</th>
		                        <th align="center" colspan="3" width="240">NÍVEL SUPERIOR</th>
		                        <th align="center" rowspan="2" width="100">TOTAL</th>
		                    </tr>
		                    <tr bgcolor="#DDDDEE">
		                        <th align="center" width="80">4h</th>
		                        <th align="center" width="80">5h</th>
		                        <th align="center" width="80">6h</th>
		                    </tr>
		                    
		                    			

		                   ';
		                    
    // Trazer todos agentes de integração
	$totalAgentesIntegracao = $VO->buscarAgenteIntegracao();
	$dadosAgentes = $VO->getVetor();
    for($i = 0; $i < $totalAgentesIntegracao; $i++){


    	$tabelaPreenchida.='<tr style="border: solid 0px #CCC; padding: 0; margin: 0;">
		                    	<td colspan="7" style="border: solid 0px #CCC; padding: 0; margin:0;"> 
    						<table border="0" id="tabelaInterna" style="border: solid 0px #CCC; margin: 0;">
    							<tr bgcolor="#EEEEFF">
                            	      <td align="center" width="100px" style="border: solid 1px #CCC; padding: 0; margin:0;">'.$dadosAgentes['TX_AGENCIA_ESTAGIO'][$i].'
                            	      </td> 
                            	      <td align="center"  width="590" style="border: solid 1px #CCC; padding: 0; margin:0;">
                            	      	<table border="0" id="tabelaInterna" style="border: solid 0px #CCC; margin: 0;">
                            	      		';
       $VO->ID_AGENCIA_ESTAGIO_TABELA=$dadosAgentes['ID_AGENCIA_ESTAGIO'][$i];
       $totalUnidades = $VO->buscarQuadroVagasUnidades();

       for($j =0;$j<$totalUnidades;$j++){
	       	if($j%2==0){
	       		
	       		$cor="#FFFFFF";
	       	}
	       	else{
	       		$cor="#EEEEFF";
	       	}
       		$dadosUnidades = $VO->getVetor();
			$tabelaPreenchida.='<tr bgcolor="'.$cor.'" onmouseover="mudarCor(this);" onmouseout="mudarCor(this)" style="">
									<td align="center"  width="119" style="border: solid 1px #CCC; padding: 0; margin:0;"> 
									'.$dadosUnidades['TX_ORGAO_ESTAGIO'][$j].'
                                    </td>
                                    <td align="center"  width="102" style="border: solid 1px #CCC; padding: 0; margin:0;">
									'.$dadosUnidades['VAGAS_NIVEL_MEDIO'][$j].'
                                    </td>
                                    <td align="center"  width="82" style="border: solid 1px #CCC; padding: 0; margin:0;"> 
									'.$dadosUnidades['VAGAS_SUP_4_HORAS'][$j].'
                                    </td>
                                    <td align="center"  width="82" style="border: solid 1px #CCC; padding: 0; margin:0;"> 
									'.$dadosUnidades['VAGAS_SUP_5_HORAS'][$j].'
                                    </td>
                                    <td align="center"  width="82" style="border: solid 1px #CCC; padding: 0; margin:0;"> 
									'.$dadosUnidades['VAGAS_SUP_6_HORAS'][$j].'
                                    </td>
                                    <td align="center"  width="97" style="font-weight:bold;border: solid 1px #CCC; padding: 0; margin:0;"bgcolor="#DDDDDD"> 
									'.$dadosUnidades['VAGAS_TOTAL'][$j].'
                                    </td>
                                </tr>';

                                $array[0]+=$dadosUnidades['VAGAS_NIVEL_MEDIO'][$j];
                                $array[1]+=$dadosUnidades['VAGAS_SUP_4_HORAS'][$j];
                                $array[2]+=$dadosUnidades['VAGAS_SUP_5_HORAS'][$j];
                                $array[3]+=$dadosUnidades['VAGAS_SUP_6_HORAS'][$j];
                                $array[4]+=$dadosUnidades['VAGAS_TOTAL'][$j];
           }      

           $tabelaPreenchida.='<tr bgcolor="'.$cor.'" onmouseover="mudarCor(this);" onmouseout="mudarCor(this)" style="">
									<td align="center"  width="119" bgcolor="#DDDDDD"style="font-weight:bold;border: solid 1px #CCC; padding: 0; margin:0;"> 
									TOTAL
                                    </td>
                                    <td align="center"  width="102" style="font-weight:bold;border: solid 1px #CCC; padding: 0; margin:0;"bgcolor="#DDDDDD">
									'.$array[0].'
                                    </td>
                                    <td align="center"  width="82" style="font-weight:bold;border: solid 1px #CCC; padding: 0; margin:0;"bgcolor="#DDDDDD"> 
									'.$array[1].'
                                    </td>
                                    <td align="center"  width="82" style="font-weight:bold;border: solid 1px #CCC; padding: 0; margin:0;"bgcolor="#DDDDDD"> 
									'.$array[2].'
                                    </td>
                                    <td align="center"  width="82" style="font-weight:bold;border: solid 1px #CCC; padding: 0; margin:0;"bgcolor="#DDDDDD"> 
									'.$array[3].'
                                    </td>
                                    <td align="center"  width="97" style="font-weight:bold;border: solid 1px #CCC; padding: 0; margin:0;"bgcolor="#DDDDDD"> 
									'.$array[4].'
                                    </td>
                                </tr>';           	      		

           $tabelaPreenchida.='</table>
                            	 </td>
		                         </tr>
		                         </table></td></tr>';
		                         unset($array);
    }		
    	
    $tabelaPreenchida.=' </table>';


    /*
	#####################################################################################################################
	################################################### TABELA ABERTA ################################################
	#####################################################################################################################
    */

    $tabelaAberta='<table id="tabela" align="center" style="margin-top:3px; collapse; border: solid 1px #CCC;">
							
							<tr bgcolor="#DDDDEE">
			                   	<th align="center" rowspan="2" width="100">AG. INT.</th>
		                    	<th align="center" rowspan="2" width="120">ÓRGÃO</th>
		                        <th align="center" rowspan="2" width="100">NÍVEL MÉDIO</th>
		                        <th align="center" colspan="3" width="240">NÍVEL SUPERIOR</th>
		                        <th align="center" rowspan="2" width="100">TOTAL</th>
		                    </tr>
		                    <tr bgcolor="#DDDDEE">
		                        <th align="center" width="80">4h</th>
		                        <th align="center" width="80">5h</th>
		                        <th align="center" width="80">6h</th>
		                    </tr>
		                    
		                    			

		                   ';
		                    
    // Trazer todos agentes de integração
	$totalAgentesIntegracao = $VO->buscarAgenteIntegracao();
	$dadosAgentes = $VO->getVetor();
    for($i = 0; $i < $totalAgentesIntegracao; $i++){


    	$tabelaAberta.='<tr style="border: solid 0px #CCC; padding: 0; margin: 0;">
		                    	<td colspan="7" style="border: solid 0px #CCC; padding: 0; margin:0;"> 
    						<table border="0" id="tabelaInterna" style="border: solid 0px #CCC; margin: 0;">
    							<tr bgcolor="#EEEEFF">
                            	      <td align="center" width="100px" style="border: solid 1px #CCC; padding: 0; margin:0;">'.$dadosAgentes['TX_AGENCIA_ESTAGIO'][$i].'
                            	      </td> 
                            	      <td align="center"  width="590" style="border: solid 1px #CCC; padding: 0; margin:0;">
                            	      	<table border="0" id="tabelaInterna" style="border: solid 0px #CCC; margin: 0;">
                            	      		';
       $VO->ID_AGENCIA_ESTAGIO_TABELA=$dadosAgentes['ID_AGENCIA_ESTAGIO'][$i];
       $totalUnidades = $VO->buscarQuadroVagasUnidades();

       for($j =0;$j<$totalUnidades;$j++){
	       	if($j%2==0){
	       		
	       		$cor="#FFFFFF";
	       	}
	       	else{
	       		$cor="#EEEEFF";
	       	}
       		$dadosUnidades = $VO->getVetor();
			$tabelaAberta.='<tr bgcolor="'.$cor.'" onmouseover="mudarCor(this);" onmouseout="mudarCor(this)" style="">
									<td align="center"  width="119" style="border: solid 1px #CCC; padding: 0; margin:0;"> 
									'.$dadosUnidades['TX_ORGAO_ESTAGIO'][$j].'
                                    </td>
                                    <td align="center"  width="102" style="border: solid 1px #CCC; padding: 0; margin:0;">
									'.$dadosUnidades['VAGAS_NIVEL_MEDIO'][$j].'
                                    </td>
                                    <td align="center"  width="82" style="border: solid 1px #CCC; padding: 0; margin:0;"> 
									'.$dadosUnidades['VAGAS_SUP_4_HORAS'][$j].'
                                    </td>
                                    <td align="center"  width="82" style="border: solid 1px #CCC; padding: 0; margin:0;"> 
									'.$dadosUnidades['VAGAS_SUP_5_HORAS'][$j].'
                                    </td>
                                    <td align="center"  width="82" style="border: solid 1px #CCC; padding: 0; margin:0;"> 
									'.$dadosUnidades['VAGAS_SUP_6_HORAS'][$j].'
                                    </td>
                                    <td align="center"  width="97" style="font-weight:bold;border: solid 1px #CCC; padding: 0; margin:0;"bgcolor="#DDDDDD"> 
									'.$dadosUnidades['VAGAS_TOTAL'][$j].'
                                    </td>
                                </tr>';

                                $array[0]+=$dadosUnidades['VAGAS_NIVEL_MEDIO'][$j];
                                $array[1]+=$dadosUnidades['VAGAS_SUP_4_HORAS'][$j];
                                $array[2]+=$dadosUnidades['VAGAS_SUP_5_HORAS'][$j];
                                $array[3]+=$dadosUnidades['VAGAS_SUP_6_HORAS'][$j];
                                $array[4]+=$dadosUnidades['VAGAS_TOTAL'][$j];
           }      

           $tabelaAberta.='<tr bgcolor="'.$cor.'" onmouseover="mudarCor(this);" onmouseout="mudarCor(this)" style="">
									<td align="center"  width="119" bgcolor="#DDDDDD"style="font-weight:bold;border: solid 1px #CCC; padding: 0; margin:0;"> 
									TOTAL
                                    </td>
                                    <td align="center"  width="102" style="font-weight:bold;border: solid 1px #CCC; padding: 0; margin:0;"bgcolor="#DDDDDD">
									'.$array[0].'
                                    </td>
                                    <td align="center"  width="82" style="font-weight:bold;border: solid 1px #CCC; padding: 0; margin:0;"bgcolor="#DDDDDD"> 
									'.$array[1].'
                                    </td>
                                    <td align="center"  width="82" style="font-weight:bold;border: solid 1px #CCC; padding: 0; margin:0;"bgcolor="#DDDDDD"> 
									'.$array[2].'
                                    </td>
                                    <td align="center"  width="82" style="font-weight:bold;border: solid 1px #CCC; padding: 0; margin:0;"bgcolor="#DDDDDD"> 
									'.$array[3].'
                                    </td>
                                    <td align="center"  width="97" style="font-weight:bold;border: solid 1px #CCC; padding: 0; margin:0;"bgcolor="#DDDDDD"> 
									'.$array[4].'
                                    </td>
                                </tr>';           	      		

           $tabelaAberta.='</table>
                            	 </td>
		                         </tr>
		                         </table></td></tr>';
		                         unset($array);
    }		
    	
    $tabelaAberta.=' </table>';
	
}else     header("Location: " . $url . "src/" . $pasta . "/index.php");

$smarty->assign("tabelaEstabelecida",$tabelaEstabelecida);
$smarty->assign("tabelaAberta",$tabelaAberta); 
$smarty->assign("tabelaPreenchida",$tabelaPreenchida);    
$smarty->assign("current", $current);
$smarty->assign("pasta", $pasta);
$smarty->assign("dados", $dados);
$smarty->assign("titulopage", $titulopage);
$smarty->assign("arquivoCSS", $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("arquivoJS", $pasta . trim(ucfirst($nomeArquivo)));
$smarty->assign("nomeArquivo", $pasta . "/" . $nomeArquivo . ".tpl");
$smarty->display('index.tpl');
?>