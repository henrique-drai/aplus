$(document).ready(() => {
    getInfo();
    setInterval(getInfo, 3000);

    $('body').on("click", "#create_post_button", function() {
        addPopup($(".threadName").text());
        $(".cd-popup").css('visibility', 'visible');
        $(".cd-popup").css('opacity', '1');
    })
    
    $('body').on("click", '#createPost-form-submit', function() {
        var desc = $("textarea").val();
        insertPost(desc);
        $(".cd-popup").css('visibility', 'hidden');
        $(".cd-popup").css('opacity', '0');
    })

    //open popup - REMOVER PUBLICAÇÃO
	$('body').on('click', '.remove', function(){
        localStorage.setItem("post_id", $(this).attr("id"));
        $(".cd-message").html("<p>Tem a certeza que deseja eliminar a publicação?</p>");
        $(".cd-buttons").html('').append("<li><a href='#' id='confirmRemove'>" +
            "Sim</a></li><li><a href='#' id='closeButton'>Não</a></li>");

        $(".cd-popup").css('visibility', 'visible');
        $(".cd-popup").css('opacity', '1');
    });
    
    //open popup - REMOVER THREAD
	$('body').on('click', '.remove_thread', function() {
        $(".cd-message").html("<p>Tem a certeza que deseja eliminar o tópico?</p>");
        $(".cd-buttons").html('').append("<li><a href='#' id='confirmRemoveThread'>" +
            "Sim</a></li><li><a href='#' id='closeButton'>Não</a></li>");

        $(".cd-popup").css('visibility', 'visible');
        $(".cd-popup").css('opacity', '1');
	});
	
	//close popup
	$('body').on('click', '.cd-popup', function(){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('#closeButton') ){
            event.preventDefault();
            $(this).css('visibility', 'hidden');
            $(this).css('opacity', '0');
		}
    });
    
    //confirmed delete do popup - REMOVER PUBLICAÇÃO
    $("body").on('click', '#confirmRemove', function(){    
        $.ajax({
            type: "DELETE",
            url: base_url + "api/removePost/" + localStorage.post_id,
            data: {user_id: localStorage.user_id, cadeira_id: localStorage.cadeira_id, role: localStorage.role},
            success: function(data) {
                window.location.reload();
            },
            error: function(data) {
                console.log("Erro na API - Confirm Remove Projeto")
                console.log(data)
            }
        });
    })

    //confirmed delete do popup - REMOVER THREAD
    $("body").on('click', '#confirmRemoveThread', function(){    
        $.ajax({
            type: "DELETE",
            url: base_url + "api/removeThread/" + localStorage.thread_id,
            data: {user_id: localStorage.user_id, cadeira_id: localStorage.cadeira_id, role: localStorage.role},
            success: function(data) {
                window.location = base_url + "foruns/forum/" + localStorage.forum_id;
            },
            error: function(data) {
                console.log("Erro na API - Confirm Remove Projeto")
                console.log(data)
            }
        });
    })
})

function addPopup(thread_name) {
    $(".cd-message").html(               
    "<form id='postForm' class='thread-form'  action='javascript:void(0)'></form>").append("<div class='createPost_inputs'><h2>Criar nova publicação</h2>" +
    "<h3>Tópico: " + thread_name + "</h3>" +
    "<label class='form-label'>Conteúdo:</label>" +
    "<textarea class='form-text-area' type='text' name='threadDescription' required></textarea>");
    
    $(".cd-buttons").html('').append("<li><a href='#' id='createPost-form-submit'>Criar Publicação</a></li>" +
    "<li><a href='#' id='closeButton'>Cancelar</a></li>");
}

function getInfo() {
    $.ajax({
        type: "GET",
        url: base_url + "api/getThread/" + localStorage.thread_id,
        success: function(data) {
            console.log(data);
            $(".threadName").empty();
            $(".add").empty();
            $(".threadDesc").empty();
            $(".remove_button").empty();
            $(".threads .post").remove();
            $(".threads p").remove();
            $(".threadName").append(data.info.title);
            $(".threadDesc").append(data.info.content);

            if(data.posts.length == 0) {
                $(".threads").append("<p>Não há nenhuma publicação neste tópico.</p>");

                $(".add").html("<input type='button' id='create_post_button' value='Criar nova publicação'>");
                    addPopup(data.info.title);
            } else {
                for(var i=0; i < data.posts.length; i++) {
                    $(".threads").append("<div class='post' id='" + data.posts[i].id + "'><div class='head'><p>" + data.users[i].name + " " + data.users[i].surname + "</p>" +
                        "<p>" + getDate(data.posts[i].date) + "</p></div><div class='content2'><p>" + data.posts[i].content + "</p></div></div>");

                        if(localStorage.user_id == data.users[i].id) {
                            $(".content2").last().append("<input id='" + data.posts[i].id + "' class='remove' type='button' value='Eliminar publicação'>");
                        }
                }

                if(localStorage.teachers_only == 0 || data.user.role == "teacher") {
                    $(".add").html("<input type='button' id='create_post_button' value='Criar nova publicação'>");
                    addPopup(data.info.title);
                }
            }

            if(data.user.role == "teacher") {
                $(".remove_button").append("<input class='remove_thread' type='button' value='Eliminar tópico'>");
            }
        },
        error: function(data) {
            console.log("Erro na API:")
            console.log(data)
        }
    })
}

function getDate(date){
    const diff = Date.now() - new Date(date);

    if (diff < 1000*60*60*24) {
        if(diff - 3600000 < 1000*60*60) {
            return "Há "+Math.round((diff - 3600000)/1000/60)+" minutos";
        } else {
            return "Há "+Math.floor(diff/1000/60/60)+" horas";
        }
    } else {
        return "Há "+Math.floor(diff/1000/60/60/24)+" dias";
    }
}

function insertPost(desc) {
    $.ajax({
        type: "POST",
        url: base_url + "api/insertPost",
        data: {
            thread_id: localStorage.thread_id,
            cadeira_id: localStorage.cadeira_id,
            role: localStorage.role,
            content: desc,
            date: new Date().toISOString().slice(0, 19).replace('T', ' '),
        },
        success: function(data) {
            getInfo(localStorage.getItem("thread_id"));
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