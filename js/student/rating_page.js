$(document).ready(() => {
    getInfo(localStorage.grupo_id);
});



function getInfo(grupo_id){

    $.ajax({
        type: "GET",
        url: base_url + "student/api/getStudentsFromGroup",
        data: {id: grupo_id},
        success: function(data) {
            $("#groupName").append(grupo_id);
            $("#cadeira").append(data.proj_name[0]['nome']);

            if(data.info.length != 0 ){
                var info ="";
                for(var i=0; i < data.info.length; i++) {
                   info+="<a>" + data.info[i].id + " - " + data.info[i].name + "</a> <br>";
                }  
                $(".membros").html(info);
            }
            else{
                $(".membros").html("Não existem membros no grupo");
            }
        },
        error: function(data) {
            console.log("Erro na API:")
        }
    });
}
