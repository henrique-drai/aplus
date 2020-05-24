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
    });

    $('body').on('click', '.cd-popup', function(event){
		if($(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('#closeButton') ){
            event.preventDefault();
            $(".cd-popup").remove();
		}
    });
});


function makePopup(butID, msg){
    popup = '<div class="cd-popup" role="alert">' +
        '<div class="cd-popup-container">' +
        '<p>'+ msg +'</p>' +
        '<ul class="cd-buttons">' +
        '<li><a href="#" id="'+ butID +'">Sim</a></li>' +
        '<li><a href="#" id="closeButton">Não</a></li>' +
        '</ul>' +
        '<a class="cd-popup-close"></a>' +
        '</div></div>'

    $("#popups").append(popup);
    $(".cd-popup").css('opacity', '1');
    $(".cd-popup").css('visibility', 'visible');
}