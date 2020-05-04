$(document).ready(() => {

    $("body").on("click", "#ratingmembros", function() {
        window.location = base_url + "app/student/memberRtg/" + localStorage.grupo_id;
    })
    
    $("body").on("click", "#ficheiros", function() {
        localStorage.setItem("grupo_id", $(this).attr("id"));
        window.location = base_url + "app/student/grupos/grupo/ficheiros/" + $(this).attr("id") ;
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