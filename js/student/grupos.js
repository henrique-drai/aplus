$(document).ready(() => {

    getAll(localStorage.user_id, "allGroups");

    $("body").on("click", ".groupMembros", function() {
        localStorage.setItem("grupo_id", $(this).attr("id"));
        window.location = base_url + "app/student/grupo/" + $(this).attr("id") ;
    })
    
    $("#status").change(function(){

        $(".grupos").html("")

        if($(this).val()=="ongoing"){
            getAll(localStorage.user_id, "ongoing")   
        }
        else if ($(this).val()=="terminated"){
            getAll(localStorage.user_id, "terminated")
        }
        else{
            getAll(localStorage.user_id, "allGroups")
        }
    }) ;

});

function getAll(user_id, status){
    $.ajax({
        type: "GET",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "api/getMyGroups",
        data: {id: user_id},
        success: function(data) {
            $(".grupos").empty();
            var grupos = "";
                
            console.log(data)
            if(data.grupo.length != 0){
               
                for(var i = 0; i < data.grupo.length; i++) {


                    if(status == "terminated"  && new Date(data.deadline[i])<Date.now()){

                        grupos+="<div class='groupMembros' id='" + data.grupo[i].grupo_id + "'>"
                        + "<div id='groupId'> Grupo: " + data.grupo[i].grupo_id  + "</div>"
                        + "<div id='subject'>" + data.subjName[i] + "</div>"
                        + "<div id='project'>" + data.info[i][0].nome   + "</div>"
                        + "<div id='statusOff'>Terminado</div>"         
                                                
                        
                    }

                    else if(status == "ongoing" && new Date(data.deadline[i])>=Date.now()){
                        grupos+="<div class='groupMembros' id='" + data.grupo[i].grupo_id + "'>"
                        + "<div id='groupId'> Grupo: " + data.grupo[i].grupo_id  + "</div>"
                        + "<div id='subject'>" + data.subjName[i] + "</div>"
                        + "<div id='project'>" + data.info[i][0].nome   + "</div>"
                        + "<div id='statusOn'>Em Curso</div>"
                    }

                    else if(status == "allGroups"){

                        grupos+="<div class='groupMembros' id='" + data.grupo[i].grupo_id + "'>"
                        + "<div id='groupId'> Grupo: " + data.grupo[i].grupo_id  + "</div>"
                        + "<div id='subject'>" + data.subjName[i] + "</div>"
                        + "<div id='project'>" + data.info[i][0].nome   + "</div>"
                        
                        if (new Date(data.deadline[i])<Date.now()){
                            grupos+= "<div id='statusOff'>Terminado</div>"         
                        }
                        else{
                            grupos+= "<div id='statusOn'>Em Curso</div>"                            
                        }
                    }
                   
                    grupos+= "</div>";
                   
                }
                $(".grupos").html(grupos);
           }
           else{
                $(".grupos").html("Não existem grupos");
           }
        },
        error: function(data) {
            console.log("Erro na API:")
            console.log(data)
        }
    });
}

