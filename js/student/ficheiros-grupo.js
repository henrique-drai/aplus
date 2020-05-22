$(document).ready(() => {
    $("#submit-file").on("click", function(e){
        if($("#file_submit")[0].files.length==0){
            $(".error-file").show();
            $(".default-file").hide()
            $(".success-file").hide();
            e.preventDefault();
        } else {
            e.preventDefault(); //TIRAR QUANDO O CODIGO DO PHP TIVER FEITO
            console.log("wohoo ficheiros a serem enviados");
            console.log($("#file_submit")[0].files);
        }
    })

    
});