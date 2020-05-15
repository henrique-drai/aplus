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
        headers: {
            "Authorization": localStorage.token
        },
        url: base_url + "api/leaveMyGroup/" + proj_id,
        data: {grupo_id: groupid},
        success: function(data) {
            showMyGroup(proj_id);
        },
        error: function(data) {
            console.log(data);
        }
    });
}