$(document).ready(() => {
    getInfo(localStorage.getItem("thread_id"));

    $("#create_post_button").click(function() {
        $(".overlay").css('visibility', 'visible');
        $(".overlay").css('opacity', '1');
    })

    $('.close').click(function() {
        $(".overlay").css('visibility', 'hidden');
        $(".overlay").css('opacity', '0');
    })

    $('#popup_button').click(function() {
        var desc = $("textarea").val();
        insertPost(desc);
        $(".overlay").css('visibility', 'hidden');
        $(".overlay").css('opacity', '0');
    })

    //open popup - REMOVER POST
	$('body').on('click', '.remove', function(){
        localStorage.setItem("post_id", $(this).attr("id"));
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
            url: base_url + "teacher/api/removePost",
            data: {post_id: localStorage.post_id},
            success: function(data) {
                console.log("data");
                window.location.reload();
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

function getInfo(id) {
    $.ajax({
        type: "GET",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "teacher/api/getThreadInfo",
        data: {thread_id: id},
        success: function(data) {
            console.log(data);
            $(".threadName").empty();
            $(".threadDesc").empty();
            $(".threads .post").remove();
            $(".threadName").append(data.info.title);
            $(".threadDesc").append(data.info.content);

            if(data.posts.length == 0) {
                $(".threads").append("<p>Não há nenhuma publicação neste tópico.</p>");
            } else {
                for(var i=0; i < data.posts.length; i++) {
                    $(".threads").append("<div class='post' id='" + data.posts[i].id + "'><div class='head'><p>" + data.users[i].name + " " + data.users[i].surname + "</p>" +
                        "<p>Data: " + data.posts[i].date + "</p></div><div class='content2'><p>" + data.posts[i].content + "</p></div></div>");

                        if(localStorage.user_id == data.users[i].id) {
                            $(".content2").last().append("<input id='" + data.posts[i].id + "' class='remove' type='button' value='Eliminar post'>");
                        }
                }
            }
        },
        error: function(data) {
            console.log("Erro na API:")
            console.log(data)
        }
    })
}

function insertPost(desc) {
    $.ajax({
        type: "POST",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "teacher/api/insertPost",
        data: {
            thread_id: localStorage.thread_id,
            user_id: localStorage.user_id,
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