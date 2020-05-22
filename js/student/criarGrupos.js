var proj;

$(document).ready(() => {
    $('body').on('click', '.quitGroupButton', function(){
        var groupid = $(this).attr("id").split('"')[1];
        leaveGroup(proj, groupid);
    })

    $('body').on('click', '#criarGrupo_button', function(){
        if($("#criarGrupoName").css("display")=="none"){
            $("#criarGrupoh3").show();
            $("#criarGrupoName").show();
            $("#criarGrupoName").empty();
            $("#criarGrupoName").append('<p> Nome do Grupo</p>');
            $("#criarGrupoName").append("<input type='text' id='criarGrupoInput' placeholder='Nome do grupo'> <input type='submit' id='criarGrupoSubmit' value='Criar'>");
        }
        else{
            $("#criarGrupoName").hide();
        }
        
    })

    $("body").on('click', "#criarGrupoSubmit", function(){
        createGroup(proj);
    })
});

function leaveGroup(proj_id, groupid){
    $.ajax({
        type: "DELETE",
        url: base_url + "api/leaveMyGroup/" + proj_id,
        data: {grupo_id: groupid},
        success: function(data) {
            location.reload();
        },
        error: function(data) {
            var mensagem = "<h4 id='errogrupo'>Não foi possivel sair do grupo.</h2>";
            $(".myGroupDiv").append(mensagem);
            $("#errogrupo").delay(2000).fadeOut();
        }
    });
}

function createGroup(proj_id){

    const data = {
        nomeGrupo:  $("#criarGrupoInput").val(),
        projid:     proj_id
    }

    $.ajax({
        type: "POST",
        url: base_url + "api/criarGrupo/" + proj_id,
        data: data,
        success: function(data) {
            $("#criarGrupoName").hide();
            showMyGroup(proj_id)
        },
        error: function(data) {
            $("#msgStatus").text("Não foi possivel registar a faculdade");
            $("#msgStatus").show().delay(2000).fadeOut();
        }
    });

}

