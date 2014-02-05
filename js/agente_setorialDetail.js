$(document).ready(function(){
    
    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }
    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };
	
	function emptyHideLoader(){
        $('.fundo_pag').fadeOut(200);
		$("#ID_ORGAO_ESTAGIO option:first").attr('selected','selected');
       
		$.getJSON('acoes.php?identifier=atualizarInf', atualizarInf);
			function atualizarInf(campo){
					$("#atualizacao").html(campo['DT_ATULIZACAO'][0]);
					$("#funcionario").html(campo['TX_LOGIN_ATU'][0]);
			}     
		
    };
	
	$("#paginacao li").live('click', function(){
        showLoader();
        $("#tabelaUnidade").load('acoes.php?identifier=tabelaUnidade&PAGE='+this.id, hideLoader);
        return false;
    });

    // Inserção de Acesso
    $('#inserir').live('click', function(){
        if (!$('#ID_ORGAO_ESTAGIO').val()){
            alert('Para inserir escolha um Orgão Solicitante.');
            $('#ID_ORGAO_ESTAGIO').focus();
        }else{
            showLoader();
            $("#tabelaUnidade").load('acoes.php?identifier=inserirOrgao&ID_ORGAO_ESTAGIO='+$('#ID_ORGAO_ESTAGIO').val()+'&PAGE='+$('.selecionado').text(), emptyHideLoader);
        }
        return false;
    });
/*	
	$('#inserirTodos').live('click', function(){
		showLoader();
		$("#tabelaUnidadeConsumidora").load('acoes.php?identifier=inserirTodas', hideLoader);
        return false;
    });
*/
    //Exclusão de Acesso
    $('#excluir').live('click', function(){
        var href = $(this).attr('href');

        resp = window.confirm('Tem certeza que deseja excluir este Registro?');
        if (resp){
            showLoader();
            $("#tabelaUnidade").load('acoes.php?identifier=excluirOrgao&ID_ORGAO_ESTAGIO='+href+'&PAGE='+$('.selecionado').text(), emptyHideLoader);
        }
        return false;
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
	
	showLoader();
    $("#tabelaUnidade").load('acoes.php?identifier=tabelaUnidade', hideLoader);
});