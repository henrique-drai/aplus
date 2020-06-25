var proj;

$(document).ready(() => {
    $('body').on('click', '.quitGroupButton', function(){
        var groupid = $(this).attr("id").split('"')[1];
        leaveGroup(groupid);
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

    $("body").on("click", ".entrarGroupButton", function(){
        var groupid = $(this).attr("id").split('"')[1];
        enterGroup(proj, groupid);
    })
});

function leaveGroup(groupid){
    $.ajax({
        type: "DELETE",
        url: base_url + "api/leaveMyGroup",
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
        projid:     proj_id,
        cadeiraid: localStorage.getItem("cadeira_id")
    }

    $.ajax({
        type: "POST",
        url: base_url + "api/criarGrupo/" + proj_id,
        data: data,
        success: function(data) {
            if(data.groupExist == true){
                $("#msgStatus").text("Já existe um grupo com o mesmo nome.");
                $("#msgStatus").show().delay(5000).fadeOut();
                showMyGroup(proj_id);
            }
            else{
                showMyGroup(proj_id);
            }
        },
        error: function(data) {
            $("#msgStatus").text("Não foi possivel criar o grupo");
            $("#msgStatus").show().delay(2000).fadeOut();
        }
    });

}

function enterGroup(proj_id, grupo_id){
    const data = {
        grupoid: grupo_id,
        projid:  proj_id,
        cadeiraid: localStorage.getItem("cadeira_id")
    }
    $.ajax({
        type: "POST",
        url: base_url + "api/entrarGrupo/" + proj_id,
        data: data,
        success: function(data) {
            if(data["grupo_aluno"]==""){
                $("#msgStatus").text("Não foi possivel entrar no grupo");
                $("#msgStatus").show().delay(5000).fadeOut();
                showMyGroup(proj_id);
            }
            else{
                showMyGroup(proj_id);
            }
        },
        error: function(data) {
            $("#msgStatus").text("Não foi possivel entrar no grupo");
            $("#msgStatus").show().delay(2000).fadeOut();
        }
    });
}

