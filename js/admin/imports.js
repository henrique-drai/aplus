$(document).ready(() => {
    $("body").on('change', "#file_grupos_admin", function(){
        if($("#file_grupos_admin").val() != ""){
            $("#GruposCSVFile").text(escapeHtml($("#file_grupos_admin").val().split('\\').pop()));
            $("#file-img").attr('src',base_url+"images/icons/check-solid.png");
            //msg de sucesso - "enunciado adicionado com sucesso -> session php com o valor da msg"
        } else {
            $("#GruposCSVFile").text("Enviar ficheiro .csv");
            $("#file-img").attr('src',base_url+"images/icons/upload-solid.png");
            $("#error-popup").text("Selecione um ficheiro");
            $("#error-popup").show().delay(3000).fadeOut();
        }
    })

    $("#gruposImport").submit(function(e) {

        e.preventDefault();    
        var formData = new FormData(this);
        $.ajax({
            url: base_url + "api/importGroups",
            type: 'POST',
            headers: {"Authorization": localStorage.token},
            data: formData,
            success: function (data) {
                // $("#importSuccess").html("Ficheiro importado com sucesso");
                // $("#importSuccess").show().delay(2000).fadeOut();
                // $("#file").val("");
                // $("#name-enunciado-proj").text("Enviar ficheiro .csv");
                // $("#file-img").attr('src',base_url+"images/icons/upload-solid.png");
            },
            error: function(data) {
                $("#importError").html("Erro a importar ficheiro");
                $("#importError").show().delay(2000).fadeOut();
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

})

