$(document).ready(() => {

    $("body").on("click", "#ratingmembros", function() {
        window.location = base_url + "app/student/memberRtg/" + localStorage.grupo_id;
    })
    
    $("body").on("click", "#ficheiros", function() {
        localStorage.setItem("grupo_id", $(this).attr("id"));
        window.location = base_url + "app/student/grupos/grupo/ficheiros/" + $(this).attr("id") ;
    })

});