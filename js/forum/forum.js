$(document).ready(() => {
    getInfo(localStorage.getItem("forum_id"), localStorage.user_id);
    getThreads();
    setInterval(getThreads, 3000); 

    $('body').on("click", '#add_button', function() {
        addPopup($(".forumName").text());
        $(".cd-popup").css('visibility', 'visible');
        $(".cd-popup").css('opacity', '1');
    });

    $('body').on("click", '#createThread-form-submit', function() {
        var name = $("input[type='text']").val();
        var desc = $("textarea").val();
        insertThread(name, desc);
        getThreads();
        $(".cd-popup").css('visibility', 'hidden');
        $(".cd-popup").css('opacity', '0');
    })

    $("body").on("click", ".thread_button", function() {
        localStorage.setItem("thread_id", $(this).attr("id"));
        window.location = base_url + "foruns/thread/" + $(this).attr("id");
    })

    //open popup - REMOVER FORUM
	$('body').on('click', '.remove', function(){
        $(".cd-message").html("<p>Tem a certeza que deseja eliminar o fórum?</p>");
        $("#actionButton").attr('id', 'confirmRemove')
        $(".cd-popup").css('visibility', 'visible');
        $(".cd-popup").css('opacity', '1');
	});
	
	//close popup
	$('body').on('click', '.cd-popup', function(){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('#closeButton') ){
            event.preventDefault();
            $(this).css('visibility', 'hidden');
            $(this).css('opacity', '1');
		}
    });
    
    //confirmed delete do popup - REMOVER FORUM
    $("body").on('click', '#confirmRemove', function(){    
        $.ajax({
            type: "DELETE",
            url: base_url + "api/removeForum/" + localStorage.forum_id,
            data: {cadeira_id: localStorage.cadeira_id, user_id: localStorage.user_id},
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

function addPopup(forum_name) {
    $(".cd-message").html(              
    "<form id='createThread' action='javascript:void(0)'></form>").append("<div class='createThread_inputs'><h2>Criar novo tópico</h2>" +
    "<h3>Forum: " + forum_name + "</h3>" +
    "<label class='form-label'>Assunto do tópico:</label><input class='form-input-text' type='text' name='threadName' required>" +
    "<label class='form-label'>Discussão:</label><textarea class='form-text-area' type='text' name='threadDescription' required>" + 
    "</textarea>");
    
    $(".cd-buttons").html('').append("<li><a href='#' id='createThread-form-submit'>" +
    "Criar Tópico</a></li><li><a href='#' id='closeButton'>Cancelar</a></li>");
}

function getInfo(id) {
    $.ajax({
        type: "GET",
        url: base_url + "api/getForumById/" + id,
        data: {cadeira_id: localStorage.cadeira_id, role: localStorage.role},
        success: function(data) {
            $(".forumName").empty();
            $(".forumDesc").empty();
            $(".forumName").append(data.info.name);
            $(".forumDesc").append(data.info.description);

            localStorage.setItem("teachers_only", data.info.teachers_only);

            if(data.user.role == "teacher") {
                $(".remove_button").append("<input class='remove' type='button' value='Eliminar fórum'>");
            }

            if(data.user.role == "teacher" || localStorage.teachers_only == 0) {
                $(".add").html("<input type='button' id='add_button' value='Criar Tópico'>");
                addPopup(data.info.name);
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
        url: base_url + "api/getAllByForumId/" + localStorage.forum_id,
        success: function(data) {
            linhas = [];
            $(".threadList").empty();
            if(data.threads.length == 0) {
                $(".threadTable p").remove();
                $(".threadTable").append("<p>Ainda não existem tópicos no fórum.</p>");
            } else {
                $(".threadTable p").remove();
                linhas.push("<tr>" +
                    "<th width='35%'>Assunto</th><th width='25%'>Criador</th>" +
                    "<th width='25%'>Data</th><th width='15%'>Mais informação</th></tr>");
                
                for(var i=0; i < data.threads.length; i++) {
                    linhas.push("<tr><td>" + data.threads[i].title +
                        "</td><td>" + data.criadores[i].name + " " +data.criadores[i].surname +
                        "</td><td>" + data.threads[i].date + "<td><input type='button' class='thread_button' id='" +
                        data.threads[i].id + "' value='Ver publicações'>");
                }

                $('.container2').pagination({
					dataSource: linhas,
					pageSize: 5,
					pageNumber: 1,
					callback: function(data, pagination) {
						$(".threadList").html(data);
					}
				})
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
        url: base_url + "api/insertThread",
        data: {
            role: localStorage.role,
            cadeira_id: localStorage.cadeira_id,
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