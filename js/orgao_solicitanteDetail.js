$(document).ready(function(){
    
    function showLoader(){
        $('.fundo_pag').fadeIn(200);
    }
    function hideLoader(){
        $('.fundo_pag').fadeOut(200);
    };

	$("#paginacao li").live('click', function(){
        showLoader();
        $("#tabelaUnidade").load('acoes.php?identifier=tabelaUnidade&PAGE='+this.id, hideLoader);
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