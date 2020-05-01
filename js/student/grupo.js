$(document).ready(() => {

    // dar set no id do grupo pelo url - ou seja - se o utilizador vier para esta pagina pelo link.

    var link = location.href.split("grupo");
    var id = link[1].replace("/","");
    localStorage.setItem("grupo_id", id);

    $("body").on("click", "#ratingmembros", function() {
        window.location = base_url + "app/student/memberRtg/" + localStorage.grupo_id;
    })
    
    $("body").on("click", "#ficheiros", function() {
     
        window.location = base_url + "app/student/grupos/ficheiros/" + localStorage.grupo_id;
    })

});