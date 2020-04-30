$(document).ready(() => {
  
    getAll(localStorage.user_id);

    $("body").on("click", ".groupC", function() {
        localStorage.setItem("grupo_id", $(this).attr("id"));
        window.location = base_url + "app/student/group/" + $(this).attr("id") ;
    })
    

});



function getAll(user_id){
    $.ajax({
        type: "GET",
        url: base_url + "student/api/getMyGroups",
        data: {id: user_id},
        success: function(data) {
            $(".grupos").empty();
            var grupos = "";

            if(data.grupo.length != 0){
                for(var i = 0; i < data.grupo.length; i++) {
                    grupos+="<div class='groupC' id='" + data.grupo[i].grupo_id + "'>"
                                + "<div id='groupId'> Grupo: " + data.grupo[i].grupo_id  + "</div>"
                                        // + "<p id='textoG'>Grupo: " + data.grupo[i].grupo_id + "</p>" 
                                // + "</div>" 
                                + "<div id='subject'>" + data.subjName[i] + "</div>"
                                + "<div id='project'>" + data.info[i][0].nome   + "</div>"
                            + "</div>";
                }
                $(".grupos").html(grupos);
           }
           else{
                $(".grupos").html("Não existem grupos");
           }
        },
        error: function(data) {
            console.log("Erro na API:")
        }
    });
}




