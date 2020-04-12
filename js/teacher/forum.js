$(document).ready(() => {
    getInfo(localStorage.getItem("forum_id"));
    getThreads();
    setInterval(getThreads, 3000); 

    $('#add_button').click(function() {
        $(".overlay").css('visibility', 'visible');
        $(".overlay").css('opacity', '1');
    });

    $('.close').click(function() {
        $(".overlay").css('visibility', 'hidden');
        $(".overlay").css('opacity', '0');
    })

    $('#popup_button').click(function() {
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
})

function getInfo(id) {
    $.ajax({
        type: "GET",
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "teacher/api/getForumInfo",
        data: {forum_id: id},
        success: function(data) {
            $(".forumName").empty();
            $(".forumDesc").empty();
            $(".forumName").append(data.info.name);
            $(".forumDesc").append(data.info.description);
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