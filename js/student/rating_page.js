var userId;
$(document).ready(() => {
    getInfo(localStorage.grupo_id);

    setInterval(function() {
        getInfo(localStorage.grupo_id);
      }, 7000);
  

    $("body").on("click", ".toClassifyMember", function() {
        $(".value").text(1)
        $("#rate").val(1)
        $("#namePopup").remove()
        $("#threadForm").prepend("<h3 id='namePopup'>Atribuir classificação -" +  $(this).text().split("-")[1] + "</h3>")
        $('#user_submit_rating').addClass('is-visible');
        userId = $(this).attr('id');
    })

    $('#user_submit_rating').on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('#closeButton') ){
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
    });

   
    $(document).keyup(function(event){
    	if(event.which=='27'){
            $("#user_submit_rating").removeClass('is-visible');
	    }
    });

    $("body").on("click", "#confirmRating", function() {
        var rating = document.getElementById("rate").value;
        submitRating(rating, userId);
        $("#user_submit_rating").removeClass('is-visible');
        getInfo(localStorage.grupo_id);
        // groupName(localStorage.grupo_id);
    })

    rating();

});

// function groupName(){
//     $.ajax({
//         type: "GET",
//         url: base_url + "api/submitRating",
//         data: {idGrup: rating, meuUser: localStorage.user_id, himUser: user, grupoId: localStorage.grupo_id},
//         success: function(data) {
//             getInfo(localStorage.grupo_id);
//         },
//         error: function(data) {
//             console.log("Erro na API:")
//         }
//     });
//     $("#groupName").html("Grupo: " + grupo_id);
// }


function submitRating(rating, user){

    $.ajax({
        type: "POST",
        url: base_url + "api/submitRating",
        data: {rating: rating, meuUser: localStorage.user_id, himUser: user, grupoId: localStorage.grupo_id},
        success: function(data) {
            getInfo(localStorage.grupo_id);
        },
        error: function(data) {
            console.log("Erro na API:")
        }
    });
}



function getInfo(grupo_id){

    $.ajax({
        type: "GET",
        url: base_url + "api/getStudentsFromGroup",
        data: {id: grupo_id, classificador: localStorage.user_id},
        success: function(data) {
            $("#cadeira").html("Projeto: " + data.proj_name[0]['nome']);

            $(".classified").empty()
            $(".notClassified").empty()

            console.log(data)

            if(data.class.length != 0 ){

                var info ="";
                for(var i=0; i < data.class.length; i++) {
                    if(data.class[i].id != localStorage.user_id){
                        info+="<p class='classifiedMember' id=" + data.class[i].id + ">" + data.class[i].id 
                                + " - " + data.class[i].name + " " + data.class[i].surname 
                                + " | " + data.rate[i] + " <i class='fa fa-star'></i>"
                                + "</p>";

                    
                        //SE DEPOIS QUISER METER AS FOTOS DOS USERS
                       
                        // info+= "<img src='http://localhost/aplus/uploads/profile/" + data.class[i].id + ".jpg'" + ">"
                       
                        //  info+="<img class='groupMemberImg  ' src='http://localhost/aplus/uploads/profile/" + "default"+ ".jpg'" + ">"
                        // + "<p class='classifiedMember' id=" + data.class[i].id + ">" + data.class[i].id 
                        // + " - " + data.class[i].name
                        // + " | " + data.rate[i] + " <i class='fa fa-star'></i>"
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
                                + data.notClass[i].id + " - " + data.notClass[i].name + " " + data.notClass[i].surname + "</p>";
                    }
                }
                $(".notClassified").html(info2)
            }
            else{
                $(".notClassified").html("Já se encontram classificados todos os membros do grupo");
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