$(document).ready(() => {
    getInfo(localStorage.grupo_id);

    // FALTA IR BUSCAR O NOME DO STUDENT PARA
    // APRESENTAR OS MEMBROS DO GRUPO

});



function getInfo(grupo_id){

    $.ajax({
        type: "GET",
        url: base_url + "student/api/getStudentsFromGroup",
        data: {id: grupo_id},
        success: function(data) {
            $("#groupName").append(grupo_id);

            if(data.length != 0){
                var students="";
                for(var i = 0; i < data.students.length; i++) {      
                    if(data.students[i].user_id != localStorage.user_id){
                        students+="<a id='" + data.students[i].user_id + "'>" + data.students[i].user_id + "- meter nome" + "</a>" + "<br>"
                    }
                }
                $(".membros").html(students);
            }
           else{
                $(".membros").append("Não existem grupos");
           }

        },
        error: function(data) {
            console.log("Erro na API:")
        }
    });
}


function getName(user_id){

    $.ajax({
        type: "GET",
        url: base_url + "student/api/getStudentsFromGroup",
        data: {id: grupo_id},
        success: function(data) {
            $("#groupName").append(grupo_id);

            if(data.length != 0){
                var students="";
                for(var i = 0; i < data.students.length; i++) {      
                    if(data.students[i].user_id != localStorage.user_id){
                        students+="<a id='" + data.students[i].user_id + "'>" + data.students[i].user_id + "- meter nome" + "</a>" + "<br>"
                    }
                }
                $(".membros").html(students);
            }
           else{
                $(".membros").html("Não existem grupos");
           }

        },
        error: function(data) {
            console.log(data);
            console.log("Erro na API:")
        }
    });
}


