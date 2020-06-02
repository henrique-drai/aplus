var col

$(document).ready(() => {


    getAllColleges();

    $("#register-college-submit").click(() => submitRegister())

    // setInterval(getAllColleges, 3000);

    //open popup
	$('body').on('click','.deleteCollege', function(event){
        event.preventDefault();
        col = $(event.target).closest("tr");
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
        deleteCollege(col);
    })

})

function getAllColleges(){
    $.ajax({
        type: "GET",
        url: base_url + "api/getAllColleges",            
        success: function(data) {
            $("#mens_sem_faculdades").remove();
            if(data.colleges.length>0){
                makeCollegeTable(data)
            }
            else{
                $("#mens_sem_faculdades").remove();
                var mensagem = "<h2 id='mens_sem_faculdades'>Não existe nenhuma faculdade</h2>";
                $("body").append(mensagem);
                $(".paginationjs").remove();
                $(".adminTable").css("display", "none");
            }

            const mq = window.matchMedia( "(max-width: 452px)" );

            if (mq.matches) {
                $('.adminTable tr').find('td:eq(0),th:eq(0)').remove();
                
            } 
            
            
        },
        error: function(data) {
            var mensagem = "<h2 id='mens_erro_faculdades'>Não é possivel apresentar as faculdades.</h2>";
            $("body").append(mensagem);
            $("#mens_erro_faculdades").delay(2000).fadeOut();
        },
    
    });
}

function makeCollegeTable(data){
    colleges=[]
    for (i=0; i<data.colleges.length; i++){
        colleges.push('<tr class="colleges">' +
            '<td>'+ data.colleges[i].name +'</td>' +
            '<td>'+ data.colleges[i].location +'</td>' +
            '<td>' + data.colleges[i].siglas + '</td>' +
            '<td><input class="deleteCollege" type="button" value="Eliminar"></td>' +
            '</tr>')
    }

    $('#college-container').pagination({
        dataSource: colleges,
        pageSize: 8,
        pageNumber: 1,
        callback: function(data, pagination) {
            $(".colleges").remove();
            $(".adminTable").append(data);
        }
    })   
   
    // var table = '<table class="adminTable" id="show_colleges">' +
    //     '<tr><th>Nome</th>' +
    //     '<th>Localização</th>' + 
    //     '<th>Siglas</th>' +
    //     '<th>Eliminar</th></tr>' +
    //     college + 
    //     '</table>'

    // $("#college-container").html(table);    
}


function deleteCollege(linha){
    $.ajax({
        type: "DELETE",
        url: base_url + "api/deleteCollege",
        data: {siglas: linha.find("td:eq(2)").text()},
        success: function() {
            $("#msgStatusDelete").text("Faculdade eliminada com Sucesso");
            $("#msgStatusDelete").show().delay(2000).fadeOut();
            getAllColleges();
        },
        error: function() {
            $("#msgErroDelete").text(" Não foi possivel eliminar a faculdade");
            $("#msgErroDelete").show().delay(2000).fadeOut();
        }
    });
}


function submitRegister(){
    const data = {
        nomefaculdade:   $("#register-faculdade-form input[name='nomefaculdade']").val(),
        morada:    $("#register-faculdade-form input[name='morada']").val(),
        siglas:    $("#register-faculdade-form input[name='siglas']").val(),
    }
    if(data.nomefaculdade!=="" && data.morada!=="" && data.siglas!==""){
        $.ajax({
            type: "POST",
            url: base_url + "api/registerCollege",
            data: data,
            success: function(data) {
                $("#msgStatus").text("Faculdade registada com Sucesso");
                $("#msgStatus").show().delay(2000).fadeOut();
                $("input[type='text']").val("");
                getAllColleges();
            },
            error: function(data) {
                $("#msgErro").text("Não foi possivel registar a faculdade");
                $("#msgErro").show().delay(2000).fadeOut();
            }
        });
    }
    else{
        $("#msgErro").text("É necessário preencher todos os campos.");
        $("#msgErro").show().delay(2000).fadeOut();
    }
}