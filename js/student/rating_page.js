var userId;
$(document).ready(() => {
    getInfo(localStorage.grupo_id);

  

    $("body").on("click", "a", function() {
        $(".overlay").css('visibility', 'visible');
        $(".overlay").css('opacity', '1');

        userId = $(this).attr('id');
    })
   
    $("body").on("click", ".close", function() {
        $(".overlay").css('visibility', 'hidden');
        $(".overlay").css('opacity', '0');

    })

    $("body").on("click", "#popup_button", function() {
        var rating = document.getElementById("rateUser").value;
        submitRating(rating, userId);
    })

    rating();

});


function submitRating(rating, user){


    $.ajax({
        type: "POST",
        url: base_url + "student/api/submitRating",
        data: {rating: rating, meuUser: localStorage.user_id, himUser: user, grupoId: localStorage.grupo_id},
        success: function(data) {
            console.log("Rating atribuido com sucesso")
        },
        error: function(data) {
            console.log("Erro na API:")
        }
    });
}



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

                    if(data.info[i].id != localStorage.user_id){
                        info+="<a id=" + data.info[i].id + ">" + data.info[i].id + " - " + data.info[i].name + "</a> <br>";
                    }
                   
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


function rating(){
    var elem = document.querySelector('input[type="range"]');

    var rangeValue = function(){
        var newValue = elem.value;
        var target = document.querySelector('.value');
        target.innerHTML = newValue;
    }

    elem.addEventListener("input", rangeValue);
}