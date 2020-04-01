$(document).ready(() => {
    $("#register-anoletivo-submit").click(() => submitRegister())  
    setInterval(getAllSchoolYears, 2000);
    $("body").on("click", "#removeYearButton",() => popupVisible());
	
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


})

function popupVisible(){
    event.preventDefault();
    var linha = $(event.target).closest("tr");
    $('.cd-popup').addClass('is-visible');
    $("body").on('click', "#confirmRemove", function(){
        $('.cd-popup').removeClass('is-visible');
        deleteSchoolYear(linha);
        event.preventDefault();

    })
}

function getAllSchoolYears(){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllSchoolYears",
        success: function(data) {
            makeYearTable(data["schoolYears"])
        },
        error: function(data) {
            console.log("Erro na API:")
        }
    });
}

function deleteSchoolYear(linha){
    $.ajax({
        type: "DELETE",
        url: base_url + "admin/api/deleteSchoolYear",
        data: {inicio: linha.find("td:eq(0)").text()},
        success: function() {
            $("#msgStatus").text("Ano Letivo eliminado com Sucesso");
            $("#msgStatus").show().delay(2000).fadeOut();
        },
        error: function() {
            $("#msgStatus").text("Não foi possível eliminar o ano letivo");
            $("#msgStatus").show().delay(2000).fadeOut();
        }
    });
}

function makeYearTable(data){
    years = '';
    for (i=0; i<data.length; i++){
        json = data[i];
        years += '<tr>' +
            '<td>'+ json["inicio"] +'</td>' +
            '<td>'+ json["fim"] +'</td>' +
            '<td><input id="removeYearButton" class="remove" type="button" value="Eliminar"></td>' +
            '</tr>'
    }
   
    var table = '<table id="year_list">' +
        '<tr><th>Início</th>' +
        '<th>Fim</th>' + 
        '<th>Eliminar</th></tr>' +
        years + 
        '</table>'


    $("#years-container").html(table);    
}

    function submitRegister(){
        const data = {
            inicio:   $("#register-anoletivo-form input[name='anoLetivo']").val(),
            fim:    parseInt($("#register-anoletivo-form input[name='anoLetivo']").val())+1,
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
    