$(document).ready(() => {
    getInfo(localStorage.getItem("forum_id"), localStorage.user_id);
    getThreads();
    setInterval(getThreads, 3000); 

    $('body').on("click", '#add_button', function() {
        $(".overlay").css('visibility', 'visible');
        $(".overlay").css('opacity', '1');
    });

    $('body').on("click", '.close', function() {
        $(".overlay").css('visibility', 'hidden');
        $(".overlay").css('opacity', '0');
    })

    $('body').on("click", '#popup_button', function() {
        var name = $("input[type='text']").val();
        var desc = $("textarea").val();
        insertThread(name, desc);
        getThreads();
        $(".overlay").css('visibility', 'hidden');
        $(".overlay").css('opacity', '0');
    })

    $("body").on("click", ".thread_button", function() {
        localStorage.setItem("thread_id", $(this).attr("id"));
        window.location = base_url + "foruns/thread/" + $(this).attr("id");
    })

    //open popup - REMOVER POST
	$('body').on('click', '.remove', function(){
        makePopup("confirmRemove", "Tem a certeza que deseja eliminar o projeto?");
	});
	
	//close popup - REMOVER POST
	$('body').on('click', '.cd-popup', function(){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('#closeButton') ){
            event.preventDefault();
            $(this).remove();
		}
    });
    
    //confirmed delete do popup - REMOVER POST
    $("body").on('click', '#confirmRemove', function(){    
        $.ajax({
            type: "DELETE",
            headers: {
                "Authorization": localStorage.token
            },
            url: base_url + "teacher/api/removeForum",
            data: {forum_id: localStorage.forum_id},
            success: function(data) {
                console.log("ok");
                window.location = base_url + "subjects/subject/" + localStorage.cadeira_code + "/" + localStorage.year;
            },
            error: function(data) {
                console.log("Erro na API - Confirm Remove Projeto")
                console.log(data)
            }
        });
    })
})

function makePopup(butID, msg){
    popup = '<div class="cd-popup" role="alert">' +
        '<div class="cd-popup-container">' +
        '<p>'+ msg +'</p>' +
        '<ul class="cd-buttons">' +
        '<li><a href="#" id="'+ butID +'">Sim</a></li>' +
        '<li><a href="#" id="closeButton">Não</a></li>' +
        '</ul>' +
        '<a class="cd-popup-close"></a>' +
        '</div></div>'

    $("#popups").html(popup);
}

function getInfo(id, user_id) {
    $.ajax({
        type: "GET",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "teacher/api/getForumInfo",
        data: {forum_id: id, user_id: user_id},
        success: function(data) {
            $(".forumName").empty();
            $(".forumDesc").empty();
            $(".forumName").append(data.info.name);
            $(".forumDesc").append(data.info.description);

            localStorage.setItem("teachers_only", data.info.teachers_only);

            if(data.user.role == "teacher") {
                $(".add").append("<input type='button' id='add_button' value='Criar Tópico'><div class='overlay'>" +
                    "<div class='popup'><a class='close' href='#'>&times;</a><div class='content'>" +
                    "<h2>Criar novo tópico</h2><form id='threadForm' class='thread-form'  action='javascript:void(0)'>" +
                    "<p><label class='form-label'>Nome do Fórum:</label><input class='form-input-text' type='text'" +
                    "name='threadName' required></p><p><label class='form-label'>Descrição:</label><textarea class='" +
                    "form-text-area' type='text' name='threadDescription' required></textarea></p><input type='button'" +
                    "id='popup_button' value='Criar'></form></div></div></div>");
            }
        },
        error: function(data) {
            console.log("Erro na API:")
            console.log(data)
        }
    })
}

function getThreads() {
    $.ajax({
        type: "GET",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "teacher/api/getThreads",
        data: {forum_id: localStorage.getItem("forum_id")},
        success: function(data) {
            $(".threadTable").empty();
            if(data.threads.length == 0) {
                $(".threadTable").append("<p>Ainda não existem tópicos no fórum.</p>");
            } else {
                $(".threadTable").append("<table class='threadList'><tr>" +
                    "<th width='35%'>Título</th><th width='25%'>Criador</th>" +
                    "<th width='25%'>Data</th><th width='15%'>Mais informação</th></tr></table>");
                
                for(var i=0; i < data.threads.length; i++) {
                    $(".threadList").append("<tr><td>" + data.threads[i].title +
                        "</td><td>" + data.criadores[i].name + " " +data.criadores[i].surname +
                        "</td><td>" + data.threads[i].date + "<td><input type='button' class='thread_button' id='" +
                        data.threads[i].id + "' value='Ver'>");
                }
            }
        },
        error: function(data) {
            console.log("Erro na API:")
            console.log(data)
        }
    })
}

function insertThread(name, desc) {
    $.ajax({
        type: "POST",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "teacher/api/insertThread",
        data: {
            user_id: localStorage.user_id,
            forum_id: localStorage.forum_id,
            title: name,
            content: desc,
            date: new Date().toISOString().slice(0, 19).replace('T', ' '),
        },
        success: function(data) {
            $(".message").fadeTo(2000, 1);
            setTimeout(function() {
                $(".message").fadeTo(2000, 0);
            }, 2000);
        },
        error: function(data) {
            console.log("Erro na API:")
            console.log(data)
        }
    })
}