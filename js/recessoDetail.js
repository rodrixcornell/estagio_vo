$(document).ready(function(){
    $( "input[name=efetivar]" ).live('click', function() {
		
        resp = window.confirm('Tem certeza que deseja Efetivar este Recrutamento?');
        if (resp){
            showLoader();
            return true;
        }
        return false;
    });
    
});