var cadeira


$(document).ready(() => {

    get_ficheiros(cadeira);

    
    function get_ficheiros(cadeira_id){
        const data = {
            cadeira_id : cadeira_id,
        }

        $.ajax({
            type: "GET",
            url: base_url + "api/getFicheirosCadeira/" + cadeira_id,
            data: data,
            success: function(data) {
                console.log(data.length);
                var base_link = base_url + "file/subject_files/" + cadeira_id + "/"; 
                var array = [];

                if(data.length == 0){
                    array.push("<p>Não existem ficheiros para mostrar</p>");
                } else {
                    for (i=0; i<data.length; i++){
                        array.push('<div class="file-row" id="file-row-student">'
                        + '<p><a target="_blank" href="'+base_link+data[i]["url"]+'">' + data[i]["url_original"] + '</a></p>'
                        + '</div><hr>')
                    }          
                }


                $("#container-ficheiros").pagination({
                    dataSource: array,
                    pageSize: 10,
                    pageNumber: 1,
                    callback: function(data, pagination) {
                        $("#show-files-div").html(data);
                    }
                })
            },
            error: function(data) {
                console.log("Erro na API - Submit File Para Area da Cadeira");
                console.log(data);
            }
        });
    }
    
});

function setCadeira(id){
    cadeira = id;
}