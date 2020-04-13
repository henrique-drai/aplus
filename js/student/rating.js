$(document).ready(() => {
    // getGrupos(localStorage.user_id);

    $("body").on("click", "a", function() {
        localStorage.setItem("grupo_id", $(this).attr("id"));
        
        window.location = base_url + "app/student/group/" + $(this).attr("id") ;
    })
    

    getAll(localStorage.user_id);
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
                    grupos+="<a id='" + data.grupo[i].grupo_id 
                                + "'>" + "Grupo: " +  data.grupo[i].grupo_id 
                                +  " | Cadeira: " + data.info[i][0].nome 
                                + "</a>" + "<br>";
                    
                    // console.log(data.grupo[i].grupo_id)
                    // console.log(data.info[i][0].nome)
                    
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



// function getGrupos(user_id){
   
//     $.ajax({
//         type: "GET",
//         url: base_url + "student/api/getMyGroups",
//         data: {id: user_id},
//         success: function(data) {
//             $(".grupos").empty();
            
//             var grupos = "";
           
//             if(data.grupo.length != 0){
               
//                 for(var i = 0; i < data.grupo.length; i++) {
//                     grupos+="<a id='" + data.grupo[i].grupo_id + "'></a>" + "<br>";
//                     getNomeCadeira(data.grupo[i].grupo_id)
                    
//                 }
//                 $(".grupos").html(grupos);
//            }
//            else{
//                 $(".grupos").html("Não existem grupos");
//            }
//         },
//         error: function(data) {
//             console.log("Erro na API:")
//         }
//     });
    
// }

// function getNomeCadeira(grupo_id){

//     $.ajax({
//         type: "GET",
//         url: base_url + "student/api/getCadeiraGrupo",
//         data: {id: grupo_id},
//         success: function(data) {
//             $("#" + grupo_id).text("Grupo: " + grupo_id + " | Cadeira: " +  data.nome);

//         },
//         error: function(data) {
//             console.log("Erro na API:")
//         }
//     });
  
// }



