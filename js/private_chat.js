$(document).ready(() => {

    if (page_name=="chat"){
        $("#search_text_chat").keyup(function(){
            var s = $(this).val();
            if(s!=''){
                getSearchTeaStu(s);
            }
            else{
                $(".chatList").remove();
            }
        })}
    
})

function getSearchTeaStu(query){
    console.log(query)
    $.ajax({
        type: "GET",
        headers: {"Authorization": localStorage.token},
        url: base_url + "api/getSearchTeaStu",
        data: {query: query},
        success: function(data){
            if(data.students != "no data"){
                $("#mens_erro_alunos").remove();
                makeUserList(data);
            }
            else{
                $(".adminTable").remove();
                $("#mens_erro_alunos").remove();
                var mensagem = "<h2 id='mens_erro_alunos'>Não existe nenhum aluno com o email, nome ou apelido indicado.</h2>";
                $("#msgStatus").append(mensagem);
            }
        },
        error: function(data) {
            var mensagem = "<h2 id='mens_erro_alunos'>Não é possivel apresentar os professores.</h2>";
            $("msgStatus").append(mensagem);
            $("#mens_erro_alunos").delay(2000).fadeOut();
        }
    })
}

function makeUserList(data){
    users= '';
    for (i=0;i<data.users.length;i++){
        users += '<li>' + data.users[i].name + '</li>';
    }
    var list = '<ul class="chatList" id="chatList">'+ users + '</ul>';
    $("#chat-container").html(list);    
}