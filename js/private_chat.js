var chat_user_id=null;
var chatType=null;

var clicked_user="";
var clicked_group="";
var clicked_id="";
var nomeGrupo="";
var refreshIntervalIdHistory=null;
var refreshIntervalGroupIdHistory=null;
var refreshIntervalIdRecent='';
var refreshIntervalIdRecentGroup='';
var flagScroll=false;
var flagLimit=false;
var limit = 30;
var flagLoadedMsg =false;

$(document).ready(() => {
    loadAccordion()

    $(".bodyChat").scroll(function() {
        var heightFromTop = $(".bodyChat").scrollTop();
    
        if(heightFromTop == 0 ) {
            limit+=10
            flagLimit=true
        }
     
        });
        if(chat_user_id!=null&&chatType!=null){
            if(chatType=="p"){
                getChatHistory(chat_user_id,limit);
                clicked_user=chat_user_id;
                clicked_id=clicked_user

                refreshIntervalIdHistory = setInterval(function(){
                    getChatHistory(chat_user_id,limit);
                }, 3000);
                $('#write_msg').unbind("keydown");
                bindEnterChat() //######################################
            }
            else if(chatType=="g"){
                getChatGroupHistory(chat_user_id,limit);
                clicked_group=chat_user_id;
                clicked_id=clicked_group

                refreshIntervalGroupIdHistory = setInterval(function(){
                    getChatGroupHistory(chat_user_id,limit);
                }, 3000);
                $('#write_msg').unbind("keydown");
                bindEnterChatGroup();  //######################################
            }
        }else{
            loadRecentChat()   

        }
        $("#search_text_chat").keyup(function(){
            var s = $(this).val();
            $(".chatList").remove();
            if(s.length!=0){
                clearInterval(refreshIntervalIdRecent);
                clearInterval(refreshIntervalIdRecentGroups);

                getSearchTeaStu(s);
            }
            else if(s.length==0){
                setTimeout(function(){loadAccordion(); }, 1500);
                clearInterval(refreshIntervalIdRecent);
                clearInterval(refreshIntervalIdRecentGroups);

                // loadAccordion()
        
    }
})
    })

function setChatUserId(user_id){
    chat_user_id = user_id
}

function setChatType(Type){
    chatType = Type
}


function loadRecentChat(){   //quando nao há id de conversa no link
    $.ajax({
        type: "GET",
        url: base_url + "api/getLastConvo",
        success: function (data) {
                if(data[0].Type=="Privado" && data[0].ID!=null){
                    clicked_user=data[0].ID;
                    clicked_id=clicked_user
                    getChatHistory(data[0].ID,limit);
                    window.history.pushState('','','chat/p/'+data[0].ID)


                    refreshIntervalIdHistory = setInterval(function(){
                        getChatHistory(data[0].ID,limit);
                    }, 3000);
                    $('#write_msg').unbind("keydown");
                    bindEnterChat() //######################################
                }
                else if(data[0][0].Type=="Grupo" && data[0][0].ID!=null){
                    window.history.pushState('','','chat/g/'+data[0][0].ID)
                    clicked_group=data[0][0].ID;
                    clicked_id=clicked_group
                    nomeGrupo = "Projeto " + data[2] + " - Grupo " + data[1];
                    getChatGroupHistory(data[0][0].ID,limit);
                    refreshIntervalGroupIdHistory = setInterval(function(){
                        getChatGroupHistory(data[0][0].ID,limit);
                    }, 3000);
                    $('#write_msg').unbind("keydown");
                    bindEnterChatGroup();  //######################################
                }
        }
    })
}

function loadAccordion(){
    $("#privateChat").html('<div class="accordion"><h4>Conversas Recentes <div id="recentConvo"></div><i class="fa fa-plus mais"></i></h4></div><div id="private" class="panel"></div>');  
    $("#groupChat").html('<div class="accordion"><h4>Grupos Existentes <div id="groupsExi"></div><i class="fa fa-plus mais"></i></h4> </div><div id="group" class="panel"></div>');  
    bindButtonPrivateMsg()

    getGroups();
    getChatLogs();

    refreshIntervalIdRecentGroups = setInterval(function(){
        getGroups();
    }, 8000);
    refreshIntervalIdRecent = setInterval(function(){
        getChatLogs();
    }, 8000);
}

function twoDigits(d) {
    if(0 <= d && d < 10) return "0" + d.toString();
    if(-10 < d && d < 0) return "-0" + (-1*d).toString();
    return d.toString();
}
Date.prototype.toMysqlFormat = function() {
    return this.getUTCFullYear() + "-" + twoDigits(1 + this.getUTCMonth()) + "-" + twoDigits(this.getUTCDate()) + " " + meiaNoite(twoDigits(this.getUTCHours()+1)) + ":" + twoDigits(this.getUTCMinutes()) + ":" + twoDigits(this.getUTCSeconds());
};
function meiaNoite(hour){
    if(hour==24){
        return "00";
    }else {
        return hour;
    }
}

function bindPrivateChatLiClick(){
    $("#privateChat li").click(function() {
        
        clearInterval(refreshIntervalIdHistory);
        clearInterval(refreshIntervalGroupIdHistory);
        limit=30;
        $(".chatList li").removeClass("activeTwo")
        this.classList.toggle("activeTwo");
        console.log("click privado")
        flagScroll=false
        var id_sender = $(this).attr("user_id");
        clicked_user = id_sender;
        clicked_id=clicked_user;
        window.history.pushState('','','/aplus/app/chat/p/'+id_sender)

        getChatHistory(id_sender,limit);
        
        $('#write_msg').unbind("keydown");
        bindEnterChat() //######################################

        refreshIntervalIdHistory = setInterval(function(){
            getChatHistory(id_sender,limit);
        }, 3000);

    });
}

function bindGroupLiClick(){
    $("#group li").click(function() {
        clearInterval(refreshIntervalGroupIdHistory);
        clearInterval(refreshIntervalIdHistory);
        limit=30;
        $(".chatList li").removeClass("activeTwo")
        this.classList.toggle("activeTwo");
        console.log("click Grupo")
        flagScroll=false
        var id_group = $(this).attr("group_id");
        // var id_projecto = $(this).attr("projecto_id");
        window.history.pushState('','','/aplus/app/chat/g/'+id_group)

        clicked_group = id_group;
        clicked_id=clicked_group;
        nomeGrupo = $(this).text()

        getChatGroupHistory(id_group,limit);

        $('#write_msg').unbind("keydown");
        bindEnterChatGroup();  //######################################
        refreshIntervalGroupIdHistory = setInterval(function(){
            getChatGroupHistory(id_group,limit);
        }, 3000);

    });
}


function bindEnterChat(){ //######################################
    $('#write_msg').keydown(function (e){
        if(e.keyCode == 13){
            if(/\S/.test($('#write_msg').val())){
                sendMessage($('#write_msg').val(),new Date().toMysqlFormat());
                $('#write_msg').val("");
            }
        }
    })
    $('#icon-send').click(function(){
        if(/\S/.test($('#write_msg').val())){
            sendMessage($('#write_msg').val(),new Date().toMysqlFormat());
            $('#write_msg').val("");
        }
    })
}

function bindEnterChatGroup(){ //######################################
    $('#write_msg').keydown(function (e){
        if(e.keyCode == 13){
            if(/\S/.test($('#write_msg').val())){
                sendMessageGroup($('#write_msg').val(),new Date().toMysqlFormat());
                $('#write_msg').val("");
            }
        }
    })
    $('#icon-send').click(function(){
        if(/\S/.test($('#write_msg').val())){
            sendMessageGroup($('#write_msg').val(),new Date().toMysqlFormat());
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
    existingChats=[];
    var incr=0;
    var d = new Date();
    var miliseconds = d.getTime();
    // console.log(dataFromUser)
    for (i=0;i<dataFromUser.users.length;i++){
        var src=base_url+"uploads/profile/"+dataFromUser.users[i].id+dataFromUser.users[i].picture+"?"+miliseconds;
        if(dataFromUser.users[i].picture==""){
            src=base_url+"uploads/profile/default.jpg"
        }
        if(clicked_id==dataFromUser.users[i].id){
            users += '<li class="list-group-class activeTwo" user_id='+ dataFromUser.users[i].id +'> <div class="list-chat"><img src='+src+' class="chat_profile" alt="Profile Picture"></img>' +
            dataFromUser.users[i].name +' '+ dataFromUser.users[i].surname + '</div>'
           //  '<p>'+ dataFromUser.content[i].content +'</p></li>';
           incr++;

        }else{
            users += '<li class="list-group-class" user_id='+ dataFromUser.users[i].id +'> <div class="list-chat"><img src='+src+' class="chat_profile" alt="Profile Picture"></img>' +
            dataFromUser.users[i].name +' '+ dataFromUser.users[i].surname + '</div>'
           //  '<p>'+ dataFromUser.content[i].content +'</p></li>';
           incr++;
        }
        
         
    }
    $('#recentConvo').html('('+incr+')')

    if(users!=''){
        var list = '<ul class="chatList" id="chatList1">'+ users + '</ul>';
        $("#private").html(list);  
        bindPrivateChatLiClick()  
    }
    if(users==''){
        $("#private").html('<p class="mens_erro_conversas">Não tem conversas criadas</p>');  
    }
    
}

function bindButtonPrivateMsg(){
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        if($(this).find("i").hasClass("fa-plus")){
            $(this).find("i").removeClass("fa-plus").addClass("fa-minus")
        }else{
            $(this).find("i").removeClass("fa-minus").addClass("fa-plus")
        }
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
        } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
        } 
    });
    }
}

function getGroups(){
    $.ajax({
        type: "GET",
        url: base_url + "api/getGroups",
        success: function (data) {
            makeUserListGroups(data);
        }
    })
}

function makeUserListGroups(data){
    groups= '';
    cadeirasComum='';
 
    var incr = 0;
    for (i=0;i<data.length;i++){
        if(clicked_id==data[i][0].id){
            groups += '<li class="list-group-class activeTwo" projeto_id='+data[i][1][0].projeto_id+' group_id='+ data[i][0].id +'> <div class="list-chat">Projeto ' + data[i][1][0].nome+' - Grupo '+data[i][0].name + '</div>'
            //  '<p>'+ dataFromUser.content[i].content +'</p></li>';
            incr++;
            
        }else{
            groups += '<li class="list-group-class" projeto_id='+data[i][1][0].projeto_id+' group_id='+ data[i][0].id +'> <div class="list-chat">Projeto ' + data[i][1][0].nome+' - Grupo '+data[i][0].name + '</div>'
            //  '<p>'+ dataFromUser.content[i].content +'</p></li>';
            incr++;
        }
        
    }
    $('#groupsExi').html('('+incr+')');
    if(groups!=''){
        var list = '<ul class="chatList" id="chatList1">'+ groups + '</ul>';
        $("#group").html(list);  
        bindGroupLiClick();
    }

    if(groups==''){
        $("#group").html('<p class="mens_erro_conversas">Não tem grupos</p>');  
    }
}

function getChatHistory(id_sender,limit){
    $.ajax({
        type: "GET",
        url: base_url + "api/getChatHistory",
        data: {id_sender,limit},
        success: function(data) {
            makeMsgHistory(data,id_sender);
            $(".headName").html('<div class="chatter"><a class="profile_chat" href="'+ base_url +'app/profile/'+ data.user.id +'"><h3 class="memberName">'+ data.user.name + ' ' + data.user.surname +'</h3></a></div>')
            $(".type-msg").css("display","block")
            // href="'+ base_url +'app/profile/'+ data["users"][j]["id"] + '">'
            if(data.msg.length==limit && flagLimit){
                // console.log("123")
                flagLoadedMsg=true
                flagLimit=true
        
            }
            if(flagLoadedMsg){
                // console.log("flagtrue")
                // setTimeout(function(){ $(".bodyChat").scrollTop(700) }, 200);
                $(".bodyChat").scrollTop(700)
                flagLoadedMsg=false
            }
            if(flagScroll==false){
                // console.log("entra privado")
                setTimeout(function(){$(".bodyChat").scrollTop($(".bodyChat")[0].scrollHeight)},150);
                flagScroll=true;
            }
            
            

}})};

function makeMsgHistory(data,id_sender){
    chatbox=''
    if(data.msg){
        data.msg.reverse();
    }
    for (i=0;i<data.msg.length;i++){
        if(data.msg[i].id_sender == id_sender){
            chatbox+='<div class="received-msg"><div class="received-msg-width"><p>'+ data.msg[i].content +'</p><span class="time_date">'+ data.msg[i].date +'</span></div></div>'
        }
        else{
            chatbox+='<div class="sent-msg"><div class="sent-msg-width"><p>'+ data.msg[i].content +'</p><span  class="time_date">'+ data.msg[i].date +'</span></div></div>'
        }
    }
    $(".bodyChat").html( '<div class="msg-history">'+chatbox+'</div>')
}

function getChatGroupHistory(id_group,limit){
    $.ajax({
        type: "GET",
        url: base_url + "api/getChatGroupHistory",
        data: {id_group,limit},
        success: function(data) {
        //    console.log(nomeGrupo)
            makeGroupMsgHistory(data);
            nomeGrupo = "Projeto " + data[0] + " - Grupo " + data[1];

            $(".headName").html('<div class="chatter"><a href="'+ base_url +'app/profile/'+ data.user.id +'"><h3>'+ nomeGrupo +'</h3></a></div>')
            // bindEnterChatGroup()
            $(".type-msg").css("display","block")
            if(flagScroll==false){
                // console.log("entra grupo")
                setTimeout(function(){$(".bodyChat").scrollTop($(".bodyChat")[0].scrollHeight)},150);
                flagScroll=true;
            }
            
            if(data.msg.length==limit && flagLimit){
                // console.log("123")
                flagLoadedMsg=true
                flagLimit=false
        
            }
            if(flagLoadedMsg){
                setTimeout(function(){ $(".bodyChat").scrollTop(700) }, 200);
                flagLoadedMsg=false
            }
          
           
            

}})};

function makeGroupMsgHistory(data){
    chatbox=''
    if(data.msg){
        data.msg.reverse();
    }
    
    for (i=0;i<data.msg.length;i++ ){
        // console.log(data.msg[i])
        if(data.msg[i][0].user_id == data.me){
            chatbox+='<div class="sent-msg"><div class="sent-msg-width"><p>'+ data.msg[i][0].content +'</p><span  class="time_date">'+ data.msg[i][0].date +'</span></div></div>'
        }
        else{
            chatbox+='<div class="received-msg"><div class="received-msg-width"><span class="nameMsg">'+ data.msg[i][1].name + ' ' + data.msg[i][1].surname +'</span><p>'+ data.msg[i][0].content +'</p><span class="time_date">'+ data.msg[i][0].date +'</span></div></div>'
        }
    }
    $(".bodyChat").html( '<div class="msg-history">'+chatbox+'</div>')

    
}

function makeUserList(dataFromUser){
    users= '';
    var d = new Date();
    var miliseconds = d.getTime();
    console.log(dataFromUser)
    for (i=0;i<dataFromUser.users.length;i++){
        var src=base_url+"uploads/profile/"+dataFromUser.users[i].id+dataFromUser.users[i].picture+"?"+miliseconds;
        if(dataFromUser.users[i].picture==""){
            src=base_url+"uploads/profile/default.jpg"
        }
        users += '<li class="list-group-class" user_id='+ dataFromUser.users[i].id +'> <div class="list-chat"><img src='+src+' class="chat_profile" alt="Profile Picture"</img>' +
         dataFromUser.users[i].name +' '+ dataFromUser.users[i].surname + '</div></li>'
        //  <p>'+ getLastPrivateMsg(dataFromUser.users[i].content)
        //  "test"+'</p></li>';
    }
    var list = '<ul class="chatList" id="chatList">'+ users + '</ul>';
    $("#privateChat").html(list); 
    $("#groupChat").empty();   
    bindPrivateChatLiClick()  
}

function sendMessage(msg, time){
    $.ajax({
        type: "POST",
        url: base_url + "api/sendMessage",
        data: {m:msg,id:clicked_user,t:time},
        success: function() {
            flagScroll=false;
            getChatHistory(clicked_user,limit);
    
    }})};

function sendMessageGroup(msg, time){
    $.ajax({
        type: "POST",
        url: base_url + "api/sendMessageGroup",
        data: {m:msg,id:clicked_group,t:time},
        success: function() {
            flagScroll=false;
            getChatGroupHistory(clicked_group,limit);
    
    }})};
