$(document).ready(() => {
    $("#file_submit").on("change", function(){

        if ($("#file_submit")[0].files.length != 0){
            var str_files = 'Ficheiro(s) selecionados: ';
            for (i=0; i<$("#file_submit")[0].files.length; i++){
                str_files = str_files + $("#file_submit")[0].files[i].name

                //este if é um bocado estupido mas é para não ficar com "," no ultimo file
                if (i != $("#file_submit")[0].files.length-1){
                    str_files += ", "
                }
            }

            $(".success-file").html(str_files)
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