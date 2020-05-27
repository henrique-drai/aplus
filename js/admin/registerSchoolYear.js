var ano

$(document).ready(() => {
    // $("#register-anoletivo-submit").click(() => submitRegister())
    
    // FAZER O MÉTODO submitNewDate
    $("body").on("click", "#insertYearButton", () => submitNewDate());
    
    getAllSchoolYears()  
    // setInterval(getAllSchoolYears, 2000);
    
    //open popup
	$('body').on('click','#removeYearButton', function(event){
        event.preventDefault();
        ano = $(event.target).closest("tr");
        $('.cd-popup').addClass('is-visible');
    });
    
	//close popup
	$('.cd-popup').on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') || $(event.target).is('#closeButton') ){
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
	});
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('.cd-popup').removeClass('is-visible');
	    }
    });
    $("body").on('click', "#confirmRemove", function(){
        $('.cd-popup').removeClass('is-visible');
        deleteSchoolYear(ano);
    })
})

function deleteSchoolYear(linha){
    $.ajax({
        type: "DELETE",
        url: base_url + "api/deleteSchoolYear",
        data: {inicio: linha.find("td:eq(0)").text()},
        success: function() {
            getAllSchoolYears();
            $("#msgStatus").text("Ano Letivo eliminado com Sucesso");
            $("#msgStatus").show().delay(2000).fadeOut();
        },
        error: function() {
            $("#msgErro").text("Não foi possível eliminar o ano letivo");
            $("#msgErro").show().delay(2000).fadeOut();
        }
    });
}

function getAllSchoolYears(){
    $.ajax({
        type: "GET",
        url: base_url + "api/getAllSchoolYears",
        success: function(data) {
            makeYearTable(data["schoolYears"])
        },
        error: function(data) {
            console.log("Erro na API:")
        }
    });
}


function makeYearTable(data){
    years = '<h2>Consultar Anos Letivos</h2>';
   
    for (i=0; i<data.length; i++){
        json = data[i];
        years += '<tr>' +
            '<td>'+ json["inicio"] +'</td>' +
            '<td>'+ json["fim"] +'</td>' +
            '<td><input id="removeYearButton" type="button" value="Eliminar"></td>' +
            '</tr>'
    }

    var table = '<table class="adminTable" id="year_list">' +
        '<tr><th>Início</th>' +
        '<th>Fim</th>' + 
        '<th></th></tr>' +
        years + 
        '</table>'


    $("#years-container").html(table);    
    lastBeginning = $('#year_list tr:last').find("td:eq(0)").text();
    lastEnd = $('#year_list tr:last').find("td:eq(1)").text();

    
   if (data.length!=0){
        var table2 = "<tr id='suggestedDate'>"
        
        + "<td>" + lastEnd + "</td>"
        + "<td>" + (parseInt(lastEnd)+1) + "</td>"
        + "<td> <input id='insertYearButton' type='button' value='Inserir'></td>"
        + "</tr>"     
    }
    else{
        currentYear = new Date().getFullYear();        

        var table2 = "<tr id='suggestedDate'>"
        + "<td>" + currentYear + "</td>"
        + "<td>" + (parseInt(currentYear)+1) + "</td>"
        + "<td> <input id='insertYearButton' type='button' value='Inserir'></td>"
        + "</tr>"   
    }
    $(".adminTable").append(table2); 

}

// function submitRegister(){
//     const data = {
//         inicio:   $("#register-anoletivo-form input[name='anoLetivo']").val(),
//         fim:    parseInt($("#register-anoletivo-form input[name='anoLetivo']").val())+1,
//     }
//     var currentTime = new Date()
//     if (data.inicio != ""){
//         if(data.inicio >= currentTime.getFullYear()){
//             $.ajax({
//                 type: "POST",
//                 url: base_url + "admin/api/registerSchoolYear",
//                 data: data,
//                 success: function(data) {
//                     getAllSchoolYears();
//                     $("#msgStatus").text("Ano Letivo registado com Sucesso");
//                     $("#msgStatus").show().delay(2000).fadeOut();
//                     $('#register-anoletivo-form')[0].reset();
    
//                 },
//                 error: function(data) {
        
//                     $("#msgStatus").text("Não foi possível adicionar o ano letivo");
//                     $("#msgStatus").show().delay(2000).fadeOut();
//                 }
                
        
//             });
//         }
//         else{
//             $("#msgStatus").text("O ano letivo precisa de ser superior ou igual ao ano atual.");
//             $("#msgStatus").show().delay(2000).fadeOut();
//         }   
//     }
//     else{
//         $("#msgStatus").text("É necessário preencher todos os campos");
//         $("#msgStatus").show().delay(2000).fadeOut();
//     }
// }
    


function submitNewDate(){

    const data = {
        inicio:   $('#year_list tr:last').find("td:eq(0)").text(),
        fim:   $('#year_list tr:last').find("td:eq(1)").text()
    }
    
    $.ajax({
        type: "POST",
        url: base_url + "api/registerSchoolYear",
        data: data,
        success: function(data) {
            getAllSchoolYears();
            $("#msgStatus").text("Ano Letivo registado com Sucesso");
            $("#msgStatus").show().delay(2000).fadeOut();
            // $('#register-anoletivo-form')[0].reset();

        },
        error: function(data) {

            $("#msgErro").text("Não foi possível adicionar o ano letivo");
            $("#msgErro").show().delay(2000).fadeOut();
        }
        
    });
  
}