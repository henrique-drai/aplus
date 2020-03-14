// podem usar esta variável para se referirem a um URL no javascript
var base_url;
var page_name;
var user_info;

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
    $.ajax({
        type: "POST",
        url: base_url + "api/user/getInfo",
        data: {user_id: localStorage.user_id},
        success: function(data) {
            console.log(data)
            user_info = data
        },
        error: function(data) {
            console.log("Problema na API ao procurar o utilizador atual.")
        }
    })
} 