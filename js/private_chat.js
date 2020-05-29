var chat_user_id=null;
var clicked_user="";
var refreshIntervalIdHistory='';
var refreshIntervalIdRecent='';


$(document).ready(() => {
    getChatLogs();
    refreshIntervalIdRecent = setInterval(function(){
        getChatLogs();
    }, 2000);

    if (page_name=="chat"){

        $("#search_text_chat").keyup(function(){
            var s = $(this).val();
            $(".chatList").remove();
            if(s.length!=0){
                clearInterval(refreshIntervalIdRecent);
                getSearchTeaStu(s);
            }
            else if(s.length==0){
                clearInterval(refreshIntervalIdRecent);
                getChatLogs();
                refreshIntervalIdRecent = setInterval(function(){
                    getChatLogs();
                }, 2000);            }
            
        })
    }
})

function setChatUserId(user_id){
    chat_user_id = user_id
}

function twoDigits(d) {
    if(0 <= d && d < 10) return "0" + d.toString();
    if(-10 < d && d < 0) return "-0" + (-1*d).toString();
    return d.toString();
}
Date.prototype.toMysqlFormat = function() {
    return this.getUTCFullYear() + "-" + twoDigits(1 + this.getUTCMonth()) + "-" + twoDigits(this.getUTCDate()) + " " + twoDigits(this.getUTCHours()+1) + ":" + twoDigits(this.getUTCMinutes()) + ":" + twoDigits(this.getUTCSeconds());
};

function bindLiClick(){
    $("li").click(function() {
        var id_sender = $(this).attr("user_id");
        clicked_user = id_sender;
        getChatHistory(id_sender);
        clearInterval(refreshIntervalId);

        refreshIntervalId = setInterval(function(){
            getChatHistory(id_sender);
        }, 2000);
    });
}

function bindEnterChat(){
    $('#write_msg').keydown(function (e){
        if(e.keyCode == 13){
            console.log(new Date().toMysqlFormat())
            sendMessage($('#write_msg').val(),new Date().toMysqlFormat());
            $('#write_msg').val("");

        }
    })
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
            $("#mens_erro_user").remove();
            makeUserListLastText(data);
        }
});
}

function makeUserListLastText(dataFromUser){
    users= '';
    console.log(dataFromUser)
    existingChats=[];
    for (i=0;i<dataFromUser.users.length;i++){
        users += '<li class="list-group-class" user_id='+ dataFromUser.users[i].id +'> <div class="list-chat">' +
         dataFromUser.users[i].name +' '+ dataFromUser.users[i].surname + '</div>'
        //  '<p>'+ dataFromUser.content[i].content +'</p></li>';
         
    }
    console.log(users)

    var list = '<h4>Recentes</h4><ul class="chatList" id="chatList">'+ users + '</ul>';
    $("#results-container").html(list);  
    bindLiClick()  
}

function getChatHistory(id_sender){
    $.ajax({
        type: "GET",
        url: base_url + "api/getChatHistory",
        data: {id_sender},
        success: function(data) {
            makeMsgHistory(data,id_sender);
            $(".headName").html('<div class="chatter"><h3>'+ data.user.name + ' ' + data.user.surname +'</h3></div>')
            $(".footSend").html('<div class="type-msg"><input type="text" id="write_msg" placeholder="Type a message"><img class="icon-send"src="http://localhost/aplus//images/icons/paper-airplane.png"> </div>')
            bindEnterChat()

}})};

function makeMsgHistory(data,id_sender){
    chatbox=''
    for (i=0;i<data.msg.length;i++){
        if(data.msg[i].id_sender == id_sender){
            chatbox+='<div class="received-msg"><div class="received-msg-width"><p>'+ data.msg[i].content +'</p><span class="time_date">'+ data.msg[i].date +'</span></div></div>'
        }
        else{
            chatbox+='<div class="sent-msg"><div class="sent-msg-width"><p>'+ data.msg[i].content +'</p><span  class="time_date">'+ data.msg[i].date +'</span></div></div>'
        }
    }
    $(".bodyChat").html( '<div class="msg-history">'+chatbox+'</div>')
    $(".msg-history").scrollTop($(".msg-history")[0].scrollHeight);
}

function makeUserList(dataFromUser){
    users= '';
    for (i=0;i<dataFromUser.users.length;i++){
        
        users += '<li class="list-group-class" user_id='+ dataFromUser.users[i].id +'> <div class="list-chat">' +
         dataFromUser.users[i].name +' '+ dataFromUser.users[i].surname + '</div></li>'
        //  <p>'+ getLastPrivateMsg(dataFromUser.users[i].content)
        //  "test"+'</p></li>';
    }
    var list = '<ul class="chatList" id="chatList">'+ users + '</ul>';
    $("#results-container").html(list);    
    bindLiClick()  
}

function sendMessage(msg, time){
    $.ajax({
        type: "POST",
        url: base_url + "api/sendMessage",
        data: {m:msg,id:clicked_user,t:time},
        success: function(data) {
            getChatHistory(clicked_user)
    
    }})};
