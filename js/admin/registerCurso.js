$(document).ready(() => {

    getAllfaculdades();
    $("#register-course-submit").click(() => submitRegister());

    $("#consultar_cursos_faculdade").change(function(){
        if($(this).val()!="Selecione uma Faculdade"){
            getAllCursosFaculdade($(this).val()); 
            $(".course_row").hide();
        }
        else{
            $(".course_row").hide();
        }
    }) ;

})


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
        collegeName:   $("#register-cursos-form select[name='faculdade']").val()
    }
   

    if (data.codCourse != "" && data.nameCourse != "" && data.descCourse != "" && data.collegeName != "Selecione uma Faculdade"){
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
                // $(".msg").remove();
                $("#semCurso").remove();
                if(data.courses.length>0){
                    for(i=0; i<data.courses.length; i++){
                        getCursos_Standard(data.courses[i].curso_standard_id, data.courses[i].id, data.courses[i].description);
 
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

    function getCursos_Standard(course_standard_id, curso_id, description){
        $.ajax({
            type: "GET",
            url: base_url + "admin/api/getCursoStandard",
            data: {course_standard_id},
            success: function(data) {
                $("#cursos_register_UnidCurricular").css("display", "block");
                $(".msg").remove();
                var linhas = '';
                linhas += '<tr class="course_row">' +
                                "<td>" + data.course.id + "</td>"
                                +"<td>" + data.course.name + "</td>"
                                +"<td>" + description + "</td>"
                                
                                + "</tr>"; 
            
                 $("#show_courses").append(linhas);
                
            },
            error: function(data) {
            }
        });
    }

    
