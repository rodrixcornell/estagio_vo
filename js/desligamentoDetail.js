$(document).ready(function(){
    
    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }
    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };
	
	function emptyHideLoader(){
        $('.fundo_pag').fadeOut(200);
		$("#msg").html('');
		$.getJSON('acoes.php?identifier=atualizarInf', atualizarInf);
			
			function atualizarInf(campo){
					$("#atualizacao").html(campo['DT_ATUALIZACAO'][0]);
					$("#func_atualizacao").html(campo['TX_FUNCIONARIO_ALT'][0]);
					$("#situacao").html(campo['TX_SITUACAO'][0]);
			}     		
    };

	function showLoaderForm(){
        $('.fundoForm').fadeIn(200);
    };
	
	function hideLoaderForm(){
        $('.fundoForm').fadeOut(200);
    };
	
    $('#DT_SOLICITACAO').setMask({
        mask:'99/99/9999'
    });

    $('#DT_DESLIGAMENTO').setMask({
        mask:'99/99/9999'
  });

    $('#DT_SOLICITACAO').datepicker({
        changeMonth: true,
        changeYear: true
    });

    $('#DT_DESLIGAMENTO').datepicker({
        changeMonth: true,
       changeYear: true
    });

	//Excluir Master
	$('#excluirMaster').click(function(){

		if ($('.icones').length){
			alert('Este registro não pode ser excluído pois possui dependentes.');
			return false;
		}else{
			resp = window.confirm('Tem certeza que deseja excluir este Registro?');
			if (!resp){
				return false;	
			}
		}
	
	});
		
});