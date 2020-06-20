// podem usar esta variável para se referirem a um URL no javascript
var base_url;
var page_name;
var role;
var user_info; //pode demorar algum tempo a chegar.
//se tiverem pressa, devem usar a seguinte linha no vosso código,
//para ter a certeza de que a user_info já está disponível:
// await setUserInfo()
const week_days = [
    {id:0, sigla:"dom", name:"Domingo"},
    {id:1, sigla:"seg", name:"Segunda-feira"},
    {id:2, sigla:"ter", name:"Terça-feira"},
    {id:3, sigla:"qua", name:"Quarta-feira"},
    {id:4, sigla:"qui", name:"Quinta-feira"},
    {id:5, sigla:"sex", name:"Sexta-feira"},
    {id:6, sigla:"sab", name:"Sábado"},
]

const global_months = [
    {id:0, sigla:"jan", name:"Janeiro"},
    {id:1, sigla:"fev", name:"Fevereiro"},
    {id:2, sigla:"mar", name:"Março"},
    {id:3, sigla:"abr", name:"Abril"},
    {id:4, sigla:"mai", name:"Maio"},
    {id:5, sigla:"jun", name:"Junho"},
    {id:6, sigla:"jul", name:"Julho"},
    {id:7, sigla:"ago", name:"Agosto"},
    {id:8, sigla:"set", name:"Setembro"},
    {id:9, sigla:"out", name:"Outubro"},
    {id:10, sigla:"nov", name:"Novembro"},
    {id:11, sigla:"dez", name:"Dezembro"},
]

function setBaseUrl(value) {
    base_url = value;
}

function setPageName(name) {
    page_name = name;
}

function setRole(role) {
    user_role = role;
}

function fileExists(url){
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status!=404;
}

function setUserInfo(){
    return $.ajax({
        type: "GET",
        url: base_url + "api/user",
        success: function(data) {
            user_info = JSON.parse(data)
            console.log("Fetched User...")
        },
        error: function(data) {
            console.log("Couldn't fetch current user.")
        }
    })
} 

function addDays(date, days) {
    var result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
}

function escapeHtml(unsafe) {
    return unsafe
         .replace(/&/g, "&amp;")
         .replace(/</g, "&lt;")
         .replace(/>/g, "&gt;")
         .replace(/"/g, "&quot;")
         .replace(/'/g, "&#039;");
 }