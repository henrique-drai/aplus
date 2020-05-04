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

    checkClosedProject();

});



function checkClosedProject(){
    $.ajax({
        type: "GET",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "api/getProjectStatus",
        data: {grupo_id: localStorage.grupo_id},
        success: function(data) {
            
            // PARA TESTAR - SE QUISEREM
            // var ano = new Date(data.date)
            // var ano = new Date("03/05/2020")
            // var dataAtual = Date.now();

            // if(ano < Date.now()){
            //     $("#btnArea").append("<input id='ratingmembros' type='button' value='Rating Membros'>")
            // }

            if(new Date(data.date)<Date.now()){
                $("#btnArea").append("<input id='ratingmembros' type='button' value='Rating Membros'>")
            }

        },
        error: function(data) {
            console.log("Erro na API:")
        }
    });
    // console.log(localStorage.grupo_id)
}
