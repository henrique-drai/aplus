var chat_user_id=null;

$(document).ready(() => {
    getChatLogs();

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

function setChatUserId(user_id){
    chat_user_id = user_id
}

function bindLiClick(){
    $("li").click(function() {
        var id_sender = $(this).attr("user_id");
        getChatHistory(id_sender)
    });
}

function getSearchTeaStu(query){
    $.ajax({
        type: "GET",
        url: base_url + "api/getSearchTeaStu",
        data: {query: query},
        success: function(data){
            if(data.users != "no data"){
                $("#mens_erro_user").remove();
                makeUserList(data);                         //se fizer com a ultima mensagem vai demorar 10 segs a processar
            }
            else{
                $(".chatList").remove();
                $("#mens_erro_user").remove();
                var mensagem = "<p id='mens_erro_user'>Não existe nenhum utilizador com o email ou nome indicado.</p>";
                $("#msgStatus").append(mensagem);
            }
        },
        error: function(data) {
            var mensagem = "<p id='mens_erro_user'>Sem resultados...</p>";
            $("msgStatus").append(mensagem);
            $("#mens_erro_user").delay(2000).fadeOut();
        }
    })
}

function getChatLogs(){
    $.ajax({
        type: "GET",
        url: base_url + "api/getChatLogs",
        
        success: function(data) {
            // if(data.users != "no data"){
            // console.log(data)
            $("#mens_erro_user").remove();
            makeUserListLastText(data);
            // }
        }
});
}

function makeUserListLastText(dataFromUser){
    users= '';
    for (i=0;i<dataFromUser.users.length;i++){
        // getLastPrivateMsg(dataFromUser.users[i].id)
        users += '<li class="list-group-class" user_id='+ dataFromUser.users[i].id +'> <div class="list-chat">' +
         dataFromUser.users[i].name +' '+ dataFromUser.users[i].surname + '</div><p>'+ dataFromUser.content[i].content +'</p></li>';
         
    }
    var list = '<ul class="chatList" id="chatList">'+ users + '</ul>';
    $("#results-container").html(list);  
    bindLiClick()  
}

function getChatHistory(id_sender){
    $.ajax({
        type: "GET",
        url: base_url + "api/getChatHistory",
        data: {id_sender},
        success: function(data) {
            console.log(data);
}})};

function makeMsgHistory(data){

}

function incomingMsg(data){

}

function sentMsg(data){
    
}







// function getLastPrivateMsg(id_sender){
//     $.ajax({
//         type: "GET",
//         url: base_url + "api/getLastPrivateMsg",
//         data: {id_sender},
//         success: function(data) {
//             if(data.msg != "no data"){
//                 // console.log(data.msg[0].content)
//                 return (data.msg[0].content);
//             }else{
//                 console.log("123")
//                 return ' ';
//             }
//         }
//     })
// }

// function makeUserList(dataFromUser){
//     users= '';
//     for (i=0;i<dataFromUser.users.length;i++){
        
//         users += '<li class="list-group-class" user_id='+ dataFromUser.users[i].id +'> <div class="list-chat">' +
//          dataFromUser.users[i].name +' '+ dataFromUser.users[i].surname + '</div></li>'
//         //  <p>'+ getLastPrivateMsg(dataFromUser.users[i].content)
//         //  "test"+'</p></li>';
//     }
//     var list = '<ul class="chatList" id="chatList">'+ users + '</ul>';
//     $("#results-container").html(list);    
// }
