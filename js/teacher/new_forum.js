$(document).ready(() => {
    $("#closeError").click(function() {
        $(".message_error").fadeTo(2000, 0);
    })

    $("#createForumButton").click(function() {
        var name = $("input[name='forumName']").val();
        var desc = $("textarea[name='forumDescription']").val();
        var teachers_only = $("select").val();
        if(name != '' && desc != '') {
            insertForum(name, desc, (teachers_only == "Sim") ? 1 : 0);
        } else {
            $(".message_error").fadeTo(2000, 1);
        }
    })
})

function insertForum(name, desc, teachers_only) {
    $.ajax({
        type: "POST",
        url: base_url + "api/insertForum",
        data: {cadeira_id: localStorage.getItem("cadeira_id"),
               name: name, 
               desc: desc,
               teachers_only: teachers_only,
            },
        success: function(data) {
            localStorage.setItem("forum_id", data.forum_id);
            window.location = base_url + "foruns/forum/" + data.forum_id;
        },
        error: function(data) {
            console.log("Erro na API:")
            console.log(data)
        }
    })
}