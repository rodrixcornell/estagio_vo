$(document).ready(function(){

	$( "#efetivar" ).live('click', function() {
			resp = window.confirm('Tem certeza que deseja Efetivar esta Oferta de Vaga?');
			if (resp)
				$('#formEvetivar').submit();
			else
				return false;
    });
	
	$( "#encaminhar" ).live('click', function() {
			resp = window.confirm('Tem certeza que deseja Encaminhar esta Oferta de Vaga para a Agência de Estágio?');
			if (resp)
				$('#formEvetivar').submit();
			else
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
	
});