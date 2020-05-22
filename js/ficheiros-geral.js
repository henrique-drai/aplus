$(document).ready(() => {
    $("#file_submit").on("change", function(){

        if ($("#file_submit").val() != ""){
            $(".success-file").html("Ficheiro Selecionado: " + $("#file_submit").val().split('\\').pop());
            $(".success-file").show();
            $(".default-file").hide();
            $(".error-file").hide();
        } else {
            $(".error-file").show();
            $(".default-file").hide()
            $(".success-file").hide();
        }
    })
});