var cso

$(document).ready(() => {

    getAllfaculdades();
    getAllSchoolYears();

    $("#register-course-submit").click(() => submitRegister());
    $("body").on("click", ".editCourse",() => displayEditCourse());
    $("body").on("click", "#editCourse-form-submit", () => editCourse());


    $("#consultar_cursos_faculdade").change(function(){
        if($(this).val()!="Selecione uma Faculdade"){
            getAllCursosFaculdade($(this).val()); 
            $(".course_row").hide();
        }
        else{
            $(".course_row").hide();
        }
    }) ;

        //open popup
	$('body').on('click','.deleteCourse', function(event){
        event.preventDefault();
        cso = $(event.target).closest("tr");
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
        deleteCourse(cso);
    })

})


function getAllSchoolYears(){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllSchoolYears",
        success: function(data) {
            linhas="";
            if(data.schoolYears.length>0){
                for(i=0; i<data.schoolYears.length>0;i++){
                    linhas += '<option class="ano_letivo" value=' + data.schoolYears[i].id +">" + data.schoolYears[i].inicio + '/' + data.schoolYears[i].fim + '</option>'; 
                }
                $("#consultar_anos_letivos").append(linhas);
            }
        },
        error: function(data) {
            console.log("Erro na API:")
        }
    });
}

function getAllfaculdades(){
    $.ajax({
        type: "GET",
        url: base_url + "admin/api/getAllFaculdadesUnidCurricular",
        success: function(data) {
            var linhas = '<option class="college_row">Selecione uma Faculdade</option>';
            if(data.colleges.length>0){
                for(i=0; i<data.colleges.length;i++){
                    linhas += '<option class="college_row" value=' + data.colleges[i].id +">" + data.colleges[i].name + '</option>'; 
                }
                $("#faculdades_register_UnidCurricular").append(linhas);
                $("#consultar_cursos_faculdade").append(linhas);
            }
        },
        error: function(data) {
        }
    });

}


function submitRegister(){
    const data = {
        codCourse:   $("#register-cursos-form input[name='codeCurso']").val(),
        nameCourse:    $("#register-cursos-form input[name='nomeCurso']").val(),
        descCourse:    $("#register-cursos-form input[name='descCurso']").val(),
        collegeId:   $("#register-cursos-form select[name='faculdade']").val(),
        academicYear:   $("#register-cursos-form select[name='academicYear']").val()
    }

    if (data.codCourse != "" && data.nameCourse != "" && data.descCourse != "" && data.collegeId != "Selecione uma Faculdade"){
        $.ajax({
            type: "POST",
            url: base_url + "admin/api/registerCurso",
            data: data,
            success: function(data) {
                $("#msgStatus").text("Curso registado com Sucesso");
                $("#msgStatus").show().delay(2000).fadeOut();
                $('#register-cursos-form')[0].reset();
            },
            error: function(data) {
                $("#msgStatus").text("Não foi possível adicionar o curso");
                $("#msgStatus").show().delay(2000).fadeOut();
            }
        });
    }
    else{
        $("#msgStatus").text("É necessário preencher todos os campos");
        $("#msgStatus").show().delay(2000).fadeOut();
    }
}


    function getAllCursosFaculdade(faculdade){
        $.ajax({
            type: "GET",
            url: base_url + "admin/api/getAllCursosFaculdade",
            data: {faculdade},
            success: function(data) {
                $(".course_row").remove();
                $("#semCurso").remove();
                if(data.courses.length>0){
                    for(i=0; i<data.courses.length; i++){
                      
                        var linhas = '';
                        linhas += '<tr class="course_row">' +
                                  "<td>" + data.courses[i].code + "</td>"
                                + "<td>" + data.courses[i].name   + "</td>"
                                + "<td>" + data.courses[i].ano_letivo_id + "</td>"
                                + "<td>" + data.courses[i].description + "</td>"
                                
                                + "<td><button class='editCourse' type='button'>Editar</button></td>"
                                + "<td><button class='deleteCourse' type='button'>Apagar</button></td>"
                                + "</tr>"; 
            
                    $("#show_courses").append(linhas);
 
                    }
                }
                else{
                    $("#show_courses").append("<tr id='semCurso'><td>Não existem cursos disponíveis</td></tr>");
                }
            },
            error: function(data) {
                // msgErro = "<p class='msgErro'> Não foi possivel registar a faculdade.</p>";
                // $("#register-faculdade-form").after(msgErro);
            }
        });
    }
    

function deleteCourse(linha){
    
    const data = {
        code:   linha.find("td:eq(0)").text(),
        idCollege:    $("select[name='consultarCadeirasporFaculdade']").val(),
    }

    $.ajax({
        type: "DELETE",
        url: base_url + "admin/api/deleteCourse",
        data: data,

        success: function() {
            getAllCursosFaculdade(data.idCollege);            
            $("#msgStatus").text("Curso eliminado com Sucesso");
            $("#msgStatus").show().delay(2000).fadeOut();
        },
        error: function() {
            $("#msgStatus").text("Erro a eliminar curso");
            $("#msgStatus").show().delay(2000).fadeOut();
        }
    });
}


    
codCourse = "";
function displayEditCourse(){
    var x = document.getElementById("editCourse-form").style.display;

    var linha = $(event.target).closest("tr");
    codCourse = linha.find("td:eq(0)").text();
    
    name = linha.find("td:eq(1)").text();   
    academicYear = linha.find("td:eq(2)").text();   
    description = linha.find("td:eq(3)").text();   

    // if(x=="block"){
    //     $("#editCourse-form").css("display", "none");
    // }
    // else{
    $("#editCourse-form").css("display", "block");

    $("#editCourse-form input[name='codCourse']").val(codCourse);
    $("#editCourse-form input[name='name']").val(name);
    $("#editCourse-form input[name='academicYear']").val(academicYear) ;
    $("#editCourse-form input[name='description']").val(description) ;
      
    // }

    
}


function editCourse(){
    
    const data = {
        code:     $("#editCourse-form input[name='codCourse']").val(),
        name:    $("#editCourse-form input[name='name']").val(),
        academicYear:    $("#editCourse-form input[name='academicYear']").val(),
        description:      $("#editCourse-form input[name='description']").val(),
        collegeId:      $('#consultar_cursos_faculdade :selected').val(),
        oldCurso: codCourse
    }

    $.ajax({
        type: "POST",
        url: base_url + "admin/api/editCourse",
        data: data,   
        success: function() {
            getAllCursosFaculdade(data.collegeId);
            $("#msgStatus").text("Curso editado com sucesso");
            $("#msgStatus").show().delay(2000).fadeOut();
            displayEditCourse();
        },
        error: function() {
            $("#msgStatus").text("Erro a editar curso");
            $("#msgStatus").show().delay(2000).fadeOut();
        }
    });

}