$(document).ready(() => {
    $("#submit-file-cadeira").on("click", function(e){
        if($("#file_submit").val() == ""){
            $(".error-file").show();
            $(".default-file").hide()
            $(".success-file").hide();
            e.preventDefault();
        } else {
            // e.preventDefault(); //TIRAR QUANDO O CODIGO DO PHP TIVER FEITO
            console.log("wohoo ficheiros a serem enviados");
            submit_ficheiro(cadeira, $("#file_submit").val().split('\\').pop());           
        }
    })

    
});