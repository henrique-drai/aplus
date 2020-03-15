// podem usar esta variável para se referirem a um URL no javascript
var base_url;
var page_name;
var user_info; //pode demorar algum tempo a chegar.
//se tiverem pressa, devem usar a seguinte linha no vosso código,
//para ter a certeza de que a user_info já está disponível:
//await setUserInfo()

function setBaseUrl(value) {
    base_url = value;
}

function setPageName(name) {
    page_name = name;
}




function fileExists(url){
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status!=404;
}


function setUserInfo(){
    return $.ajax({
        type: "POST",
        url: base_url + "user/api/getInfo",
        data: {user_id: localStorage.user_id},
        success: function(data) {
            console.log(JSON.parse(data))
            user_info = JSON.parse(data)
        },
        error: function(data) {
            console.log("Problema na API ao procurar o utilizador atual.")
        }
    })
} 