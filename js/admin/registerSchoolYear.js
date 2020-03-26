$(document).ready(() => {
    $("#register-anoletivo-submit").click(() => submitRegister())  
})

function makeYearTable(data){
    years = '';
    for (i=0; i<data.length; i++){
        json = data[i];
        years += '<tr>' +
            '<td>'+ json["inicio"] +'</td>' +
            '<td>'+ json["fim"] +'</td>' +
            '<td><input id="removeEtapaButton" class="remove" type="button" value="Eliminar"></td>' +
            '</tr>'
    }
   
    var table = '<table id="year_list">' +
        '<tr><th>Início</th>' +
        '<th>Fim</th>' + 
        '<th>Eliminar</th></tr>' +
        etapas + 
        '</table>'


    $("#years-container").html(table);    
}

    function submitRegister(){
        const data = {
            inicio:   $("#register-anoletivo-form input[name='anoLetivo']").val(),
            fim:    $("#register-anoletivo-form input[name='anoLetivo']").val()+1,
        }
        var currentTime = new Date()
        
        if (data.inicio != ""){
            if(data.inicio >= currentTime.getFullYear()){
                $.ajax({
                    type: "POST",
                    url: base_url + "admin/api/registerSchoolYear",
                    data: data,
                    success: function(data) {
                        $("#msgStatus").text("Ano Letivo registado com Sucesso");
                        $("#msgStatus").show().delay(2000).fadeOut();
                        $('#register-anoletivo-form')[0].reset();
        
                    },
                    error: function(data) {
            
                        $("#msgStatus").text("Não foi possível adicionar o ano letivo");
                        $("#msgStatus").show().delay(2000).fadeOut();
                    }
                    
            
                });
            }
            else{
                $("#msgStatus").text("O ano letivo precisa de ser superior ou igual ao ano atual.");
                $("#msgStatus").show().delay(2000).fadeOut();
            }   
        }
        else{
            $("#msgStatus").text("É necessário preencher todos os campos");
            $("#msgStatus").show().delay(2000).fadeOut();
        }
    }
    
