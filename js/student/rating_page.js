var userId;
$(document).ready(() => {
    getInfo(localStorage.grupo_id);

    // setInterval(function() {
    //     getInfo(localStorage.grupo_id);
    //   }, 7000);
  

    $("body").on("click", ".toClassifyMember", function() {
        disappearRating();
        userId = $(this).attr('id');
    })
   
    $("body").on("click", ".close", function() {
        disappearRating("close");
    })

    $(document).keyup(function(event){
    	if(event.which=='27'){
            disappearRating("close");
	    }
    });

    $("body").on("click", "#popup_button", function() {
        var rating = document.getElementById("rate").value;
        submitRating(rating, userId);
        disappearRating("close");
        getInfo(localStorage.grupo_id);
    })

    rating();

});


function disappearRating(state="open"){
    if(state=="close"){
        $(".overlay").css('display', 'none');
        $(".overlay").css('visibility', 'hidden');
        $(".overlay").css('opacity', '0');
        $("#rate").val("1");
        $(".value").text("1");
    }
    else{
        $(".overlay").css('display', 'block');
        $(".overlay").css('visibility', 'visible');
        $(".overlay").css('opacity', '1');
    }
}

function submitRating(rating, user){

    $.ajax({
        type: "POST",
        url: base_url + "student/api/submitRating",
        data: {rating: rating, meuUser: localStorage.user_id, himUser: user, grupoId: localStorage.grupo_id},
        success: function(data) {
            getInfo(localStorage.grupo_id);
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
        data: {id: grupo_id, classificador: localStorage.user_id},
        success: function(data) {
            $("#groupName").html("Grupo: " + grupo_id);
            $("#cadeira").html("Cadeira: " + data.proj_name[0]['nome']);

            $(".classified").empty()
            $(".notClassified").empty()

            if(data.class.length != 0 ){
                var info ="";
                for(var i=0; i < data.class.length; i++) {
                    if(data.class[i].id != localStorage.user_id){
                        info+="<p class='classifiedMember' id=" + data.class[i].id + ">" + data.class[i].id 
                                + " - " + data.class[i].name
                                + " | Rate: " + data.rate[i]
                                + "</p>";

                    
                        //SE DEPOIS QUISER METER AS FOTOS DOS USERS
                       
                        // info+= "<img src='http://localhost/aplus/uploads/profile/" + data.class[i].id + ".jpg'" + ">"
                       
                        //  info+="<img src='http://localhost/aplus/uploads/profile/" + "default"+ ".jpg'" + ">"
                        // + "<p class='classifiedMember' id=" + data.class[i].id + ">" + data.class[i].id 
                        // + " - " + data.class[i].name
                        // + " | Rate: " + data.rate[i]
                        // + "</p>";

                    }   
                }
                $(".classified").html(info)
            }
            else{
                $(".classified").html("Ainda nenhum membro do grupo foi classificado")
            }

            if(data.notClass.length != 0 ){
                var info2 ="";
                for(var i=0; i < data.notClass.length; i++) {
                    if(data.notClass[i].id != localStorage.user_id){
                        info2+="<p class='toClassifyMember' id=" + data.notClass[i].id + ">"
                                + data.notClass[i].id + " - " + data.notClass[i].name + "</p>";
                    }
                }
                $(".notClassified").html(info2)
            }
            else{
                $(".notClassified").html("Todos os membros do grupo já foram classificados");
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