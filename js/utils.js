// podem usar esta variável para se referirem a um URL no javascript
var base_url;
var page_name;

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