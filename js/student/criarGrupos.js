var proj;

$(document).ready(() => {
    $('body').on('click', '.quitGroupButton', function(){
        var groupid = $(this).attr("id").split('"')[1];
        leaveGroup(proj, groupid);
    })

});

function leaveGroup(proj_id, groupid){
    $.ajax({
        type: "DELETE",
        url: base_url + "api/leaveMyGroup/" + proj_id,
        data: {grupo_id: groupid},
        success: function(data) {
            // showMyGroup(proj_id);
            location.reload();
        },
        error: function(data) {
            var mensagem = "<h4 id='errogrupo'>Não foi possivel sair do grupo.</h2>";
            $(".myGroupDiv").append(mensagem);
            $("#errogrupo").delay(2000).fadeOut();
        }
    });
}

