$(document).ready(() => {
    getInfo(localStorage.getItem("thread_id"));

    $("#create_post_button").click(function() {
        //criar novo post
    })
})

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
            $(".threadName").append(data.info.title);
            $(".threadDesc").append(data.info.content);

            if(data.posts.length == 0) {
                $(".threads").append("<p>Não há nenhuma publicação neste tópico.</p>");
            } else {
                for(var i=0; i < data.posts.length; i++) {
                    $(".threads").append("<div class='post'><div class='head'><p>" + data.posts[i].user_id + "</p>" +
                        "<p>" + data.posts[i].date + "</p></div><div class='content'><p>" + data.posts[i].content + "</p></div></div>");
                }
            }
        },
        error: function(data) {
            console.log("Erro na API:")
            console.log(data)
        }
    })
}