var userId;
$(document).ready(() => {
    getInfo(localStorage.grupo_id);

    // setInterval( getInfo(localStorage.grupo_id))

    setInterval(function() {
        getInfo(localStorage.grupo_id);
      }, 3000);
  

    $("body").on("click", ".toClassifyMember", function() {
        $(".overlay").css('visibility', 'visible');
        $(".overlay").css('opacity', '1');

        userId = $(this).attr('id');
    })
   
    $("body").on("click", ".close", function() {
        $(".overlay").css('visibility', 'hidden');
        $(".overlay").css('opacity', '0');
    })


    $(document).keyup(function(event){
    	if(event.which=='27'){
            $(".overlay").css('visibility', 'hidden');
            $(".overlay").css('opacity', '0');
	    }
    });

    $("body").on("click", "#popup_button", function() {
        var rating = document.getElementById("rate").value;
        submitRating(rating, userId);
        $(".overlay").css('visibility', 'hidden');
        $(".overlay").css('opacity', '0');
        getInfo(localStorage.grupo_id);
    })

    rating();

});


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
        data: {id: grupo_id},
        success: function(data) {
            $("#groupName").html("Grupo: " + grupo_id);
            $("#cadeira").html("Cadeira: " + data.proj_name[0]['nome']);

            $(".classified").empty()
            $(".notClassified").empty()

            if(data.class.length != 0 ){
                var info ="";
                for(var i=0; i < data.class.length; i++) {
                    console.log(data.class[i].name)
                    if(data.class[i].id != localStorage.user_id){
                        info+="<p class='notClassiedMember' id=" + data.class[i].id + ">" + data.class[i].id + " - " + data.class[i].name + "</p>";
                    }
                }
                $(".classified").html(info)
            }
            else{
                $(".classified").html("Não existem membros classificados no grupo")
            }

            // -1 para não contar com o nosso user que pertence ao grupo
            if(data.notClass.length-1 != 0 ){
                var info2 ="";
                for(var i=0; i < data.notClass.length; i++) {
                    if(data.notClass[i].id != localStorage.user_id){
                        info2+="<a class='toClassifyMember' id=" + data.notClass[i].id + ">" + data.notClass[i].id + " - " + data.notClass[i].name + "</a><br>";
                    }
                }
                $(".notClassified").html(info2)
            }
            else{
                $(".notClassified").html("Não existem membros não classificados no grupo");
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